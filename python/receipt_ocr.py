import sys
import json
import re
import unicodedata
import socket
import urllib.error
import urllib.request

from http.server import BaseHTTPRequestHandler, HTTPServer
from pathlib import Path


def remove_accents(text):
    text = unicodedata.normalize("NFD", text)

    return "".join(
        char
        for char in text
        if unicodedata.category(char) != "Mn"
    )


def normalize_text(text):
    text = remove_accents(text)
    text = text.upper()

    return text


def normalize_code(text):
    return re.sub(
        r"[^A-Z0-9]",
        "",
        normalize_text(text)
    )


def extract_transaction_code(text):
    normalized = normalize_text(text)

    patterns = [
        r"MA\s*GIAO\s*DICH\s*[:\-]?\s*([A-Z0-9\-]{6,})",
        r"MA\s*THAM\s*CHIEU\s*[:\-]?\s*([A-Z0-9\-]{6,})",
        r"TRANSACTION\s*ID\s*[:\-]?\s*([A-Z0-9\-]{6,})",
        r"TRANSACTION\s*CODE\s*[:\-]?\s*([A-Z0-9\-]{6,})",
        r"REFERENCE\s*(?:NO|NUMBER)?\s*[:\-]?\s*([A-Z0-9\-]{6,})",
        r"REF\s*(?:NO)?\s*[:\-]?\s*([A-Z0-9\-]{6,})",
    ]

    for pattern in patterns:
        match = re.search(
            pattern,
            normalized,
            re.IGNORECASE
        )

        if match:
            return normalize_code(
                match.group(1)
            )

    return None


def extract_amounts(text):
    normalized = normalize_text(text)

    amounts = []

    patterns = [
        r"([0-9]{1,3}(?:[.,\s][0-9]{3})+)\s*(?:VND|VNĐ|D|Đ)",
        r"(?:VND|VNĐ)\s*[\r\n\s]*([0-9]{1,3}(?:[.,\s][0-9]{3})+)",
        r"(?:SO\s*TIEN|AMOUNT|TONG\s*TIEN)\s*[:\-]?\s*([0-9][0-9.,\s]*)",
    ]

    for pattern in patterns:
        matches = re.findall(
            pattern,
            normalized,
            re.IGNORECASE
        )

        for value in matches:
            digits = re.sub(
                r"[^0-9]",
                "",
                value
            )

            if digits:
                amount = int(digits)

                if amount > 0:
                    amounts.append(amount)

    return list(set(amounts))


def prepare_image(image_path):
    import cv2

    image = cv2.imread(image_path)

    if image is None:
        raise Exception("Khong the doc anh hoa don.")

    height, width = image.shape[:2]

    max_width = 800

    if width > max_width:
        scale = max_width / width

        new_width = int(width * scale)
        new_height = int(height * scale)

        image = cv2.resize(
            image,
            (new_width, new_height),
            interpolation=cv2.INTER_AREA
        )

    return image


DEFAULT_MODEL_PATH = r"C:\Users\tring\.EasyOCR\model"

SERVICE_HOST = "127.0.0.1"

SERVICE_PORT = 8766

SERVICE_URL = f"http://{SERVICE_HOST}:{SERVICE_PORT}/ocr"

RECEIPT_DIRECTORY = (
    Path(__file__).resolve().parent.parent
    / "storage"
    / "app"
    / "public"
    / "payment_receipts"
).resolve()


def create_reader(model_path):
    # Chỉ nạp EasyOCR khi cần khởi tạo bộ đọc.
    # Chế độ gửi yêu cầu sang dịch vụ không cần nạp EasyOCR.
    import easyocr

    return easyocr.Reader(
        ["vi", "en"],
        gpu=False,
        model_storage_directory=model_path,
        download_enabled=False,
        verbose=False
    )


def read_receipt(reader, image_path):
    image = prepare_image(image_path)

    results = reader.readtext(
        image,
        detail=0,
        paragraph=False,
        decoder="greedy",
        beamWidth=1,
        batch_size=1,
        workers=0,
        canvas_size=1600,
        mag_ratio=1.0
    )

    raw_text = "\n".join(results)

    return {
        "success": True,
        "text": raw_text,
        "normalized_text": normalize_text(raw_text),
        "transaction_code": extract_transaction_code(raw_text),
        "amounts": extract_amounts(raw_text)
    }


def call_running_service(image_path):
    payload = json.dumps({
        "image_path": str(
            Path(image_path).resolve()
        )
    }).encode("utf-8")

    request = urllib.request.Request(
        SERVICE_URL,
        data=payload,
        headers={
            "Content-Type": "application/json"
        },
        method="POST"
    )

    # Không sử dụng proxy hệ thống cho kết nối nội bộ.
    opener = urllib.request.build_opener(
        urllib.request.ProxyHandler({})
    )

    try:
        with opener.open(
            request,
            timeout=280
        ) as response:
            result = json.loads(
                response.read().decode("utf-8")
            )

        if not isinstance(result, dict):
            raise ValueError(
                "Dich vu OCR tra ve du lieu khong hop le."
            )

        return result

    except urllib.error.HTTPError as error:
        raise RuntimeError(
            f"Dich vu OCR tra ve loi HTTP {error.code}."
        ) from error

    except urllib.error.URLError as error:
        # Nếu chưa bật dịch vụ thì dùng cách đọc cũ.
        # Không chạy OCR lần nữa khi yêu cầu đã bị timeout.
        if isinstance(
            error.reason,
            ConnectionRefusedError
        ):
            return None

        raise RuntimeError(
            f"Khong the ket noi dich vu OCR: {error.reason}"
        ) from error

    except (TimeoutError, socket.timeout) as error:
        raise RuntimeError(
            "Dich vu OCR xu ly qua lau. Vui long thu lai sau."
        ) from error


def run_service(model_path):
    class ReceiptHandler(BaseHTTPRequestHandler):
        def send_json(self, data, status=200):
            payload = json.dumps(
                data,
                ensure_ascii=False
            ).encode("utf-8")

            self.send_response(status)

            self.send_header(
                "Content-Type",
                "application/json; charset=utf-8"
            )

            self.send_header(
                "Content-Length",
                str(len(payload))
            )

            self.end_headers()

            self.wfile.write(payload)

        def do_GET(self):
            if self.path != "/health":
                self.send_json(
                    {
                        "success": False,
                        "message": "Not found"
                    },
                    404
                )

                return

            self.send_json({
                "success": True,
                "message": "OCR ready"
            })

        def do_POST(self):
            if self.path != "/ocr":
                self.send_json(
                    {
                        "success": False,
                        "message": "Not found"
                    },
                    404
                )

                return

            try:
                length = int(
                    self.headers.get(
                        "Content-Length",
                        "0"
                    )
                )

                if length <= 0 or length > 16384:
                    raise ValueError(
                        "Yeu cau OCR khong hop le."
                    )

                data = json.loads(
                    self.rfile.read(length).decode("utf-8")
                )

                image_path = Path(
                    data["image_path"]
                ).resolve()

                # Chỉ cho phép đọc ảnh trong thư mục hóa đơn
                # của project hiện tại.
                if not image_path.is_relative_to(
                    RECEIPT_DIRECTORY
                ):
                    raise ValueError(
                        "Duong dan anh hoa don khong hop le."
                    )

                if not image_path.is_file():
                    raise ValueError(
                        "Khong tim thay anh hoa don."
                    )

                result = read_receipt(
                    self.server.ocr_reader,
                    str(image_path)
                )

                self.send_json(result)

            except Exception as error:
                self.send_json({
                    "success": False,
                    "message": str(error)
                })

        def log_message(self, format, *args):
            return

    # Xử lý lần lượt bằng một reader đã được nạp sẵn.
    with HTTPServer(
        (SERVICE_HOST, SERVICE_PORT),
        ReceiptHandler
    ) as server:
        print(
            "Dang nap mo hinh EasyOCR, vui long cho...",
            flush=True
        )

        server.ocr_reader = create_reader(
            model_path
        )

        print(
            f"OCR SAN SANG tai http://{SERVICE_HOST}:{SERVICE_PORT}",
            flush=True
        )

        print(
            "Giu cua so nay mo. Nhan Ctrl+C de dung.",
            flush=True
        )

        try:
            server.serve_forever()

        except KeyboardInterrupt:
            print(
                "\nDa dung dich vu OCR.",
                flush=True
            )


def main():
    if len(sys.argv) < 2:
        print(
            json.dumps(
                {
                    "success": False,
                    "message": "Khong co duong dan anh."
                },
                ensure_ascii=False
            )
        )

        return

    if sys.argv[1] == "--serve":
        model_path = (
            sys.argv[2]
            if len(sys.argv) >= 3
            else DEFAULT_MODEL_PATH
        )

        try:
            run_service(model_path)

        except Exception as error:
            print(
                f"Khong khoi dong duoc OCR: {error}",
                file=sys.stderr
            )

            sys.exit(1)

        return

    image_path = sys.argv[1]

    model_path = (
        sys.argv[2]
        if len(sys.argv) >= 3
        else DEFAULT_MODEL_PATH
    )

    try:
        result = call_running_service(
            image_path
        )

        if result is None:
            # Giữ cách đọc cũ làm dự phòng
            # nếu chưa bật dịch vụ OCR.
            reader = create_reader(
                model_path
            )

            result = read_receipt(
                reader,
                image_path
            )

        print(
            json.dumps(
                result,
                ensure_ascii=False
            )
        )

    except Exception as error:
        print(
            json.dumps(
                {
                    "success": False,
                    "message": str(error)
                },
                ensure_ascii=False
            )
        )


if __name__ == "__main__":
    main()