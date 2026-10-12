import sys
import json
import re
import unicodedata
import easyocr
import cv2


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

    image_path = sys.argv[1]

    model_path = (
        sys.argv[2]
        if len(sys.argv) >= 3
        else r"C:\Users\tring\.EasyOCR\model"
    )

    try:
        image = prepare_image(image_path)

        reader = easyocr.Reader(
            ["vi", "en"],
            gpu=False,
            model_storage_directory=model_path,
            download_enabled=False,
            verbose=False
        )

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

        transaction_code = extract_transaction_code(
            raw_text
        )

        amounts = extract_amounts(
            raw_text
        )

        print(
            json.dumps(
                {
                    "success": True,
                    "text": raw_text,
                    "normalized_text": normalize_text(
                        raw_text
                    ),
                    "transaction_code": transaction_code,
                    "amounts": amounts
                },
                ensure_ascii=False
            )
        )

    except Exception as e:
        print(
            json.dumps(
                {
                    "success": False,
                    "message": str(e)
                },
                ensure_ascii=False
            )
        )


if __name__ == "__main__":
    main()