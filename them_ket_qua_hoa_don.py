from pathlib import Path
from datetime import datetime
import shutil


ROOT = Path.cwd()

CONTROLLER = ROOT / "app/Http/Controllers/BookingController.php"

PAYMENT = ROOT / "resources/views/user/thanh-toan.blade.php"

TICKET = ROOT / "resources/views/user/ve-dien-tu.blade.php"

PARTIAL = (
    ROOT
    / "resources/views/user/partials/ket-qua-hoa-don.blade.php"
)


HELPER = r'''
    private function receiptCheckReport(
        Booking $booking,
        array $ocr,
        bool $contentMatches,
        bool $amountMatches,
        bool $transactionUnused,
        bool $verified = false
    ): array {
        $expectedContent = $ocr['expected_content']
            ?? ('VJ ' . $booking->booking_code);

        $expectedAmount = (int) (
            $ocr['expected_amount'] ?? $booking->total_amount
        );

        $text = (string) ($ocr['text'] ?? '');

        $normalized = strtoupper(
            preg_replace(
                '/[^A-Za-z0-9]/',
                '',
                Str::ascii($text)
            )
        );

        $expected = strtoupper(
            preg_replace(
                '/[^A-Za-z0-9]/',
                '',
                $expectedContent
            )
        );

        $readContent = null;
        $length = strlen($expected);
        $map = ['O' => '0', 'S' => '5'];

        // Hiển thị đoạn OCR tìm được, không lấy nội dung yêu cầu
        // điền vào cột dữ liệu đọc từ hóa đơn.
        if ($length > 0 && $contentMatches) {
            for (
                $i = 0;
                $i <= strlen($normalized) - $length;
                $i++
            ) {
                $part = substr($normalized, $i, $length);

                if (
                    $part === $expected
                    || strtr($part, $map)
                        === strtr($expected, $map)
                    || levenshtein($expected, $part) <= 1
                ) {
                    $readContent = $part;
                    break;
                }
            }
        }

        // Khi không khớp, thử lấy nội dung theo nhãn trên bill.
        if ($readContent === null) {
            $lines = preg_split('/\R/u', $text) ?: [];

            foreach ($lines as $index => $line) {
                $plain = strtoupper(
                    trim(Str::ascii($line))
                );

                if (
                    preg_match(
                        '/^NOI\s+DUNG(?:\s+CHUYEN\s+(?:KHOAN|TIEN))?\s*[:\-]?\s*(.*)$/',
                        $plain,
                        $match
                    )
                ) {
                    $candidate = trim($match[1]);

                    if ($candidate === '') {
                        for (
                            $next = $index + 1;
                            $next < count($lines);
                            $next++
                        ) {
                            if (trim($lines[$next]) !== '') {
                                $candidate = trim($lines[$next]);
                                break;
                            }
                        }
                    }

                    $readContent = $candidate !== ''
                        ? $candidate
                        : null;

                    break;
                }
            }
        }

        $amounts = array_values(
            array_unique(
                array_map(
                    'intval',
                    array_filter(
                        $ocr['amounts'] ?? [],
                        'is_numeric'
                    )
                )
            )
        );

        return [
            'booking_id' => $booking->id,
            'expected_content' => $expectedContent,
            'expected_amount' => $expectedAmount,
            'read_content' => $readContent,
            'amounts' => $amounts,
            'content_matches' => $contentMatches,
            'amount_matches' => $amountMatches,
            'transaction_code' => $ocr['transaction_code'] ?? null,
            'transaction_unused' => $transactionUnused,
            'verified' => $verified,
            'ocr_text' => $text,
        ];
    }
'''


PARTIAL_TEXT = r'''@if(
    is_array($receiptCheck ?? null)
    && (int) ($receiptCheck['booking_id'] ?? 0) === (int) $booking->id
)
<section
    class="receipt-report"
    aria-label="Kết quả kiểm tra hóa đơn"
>
    <style>
        .receipt-report {
            margin: 22px 0;
            padding: 22px;
            background: #fff;
            border: 1px solid #dbe4ed;
            border-radius: 12px;
            color: #243746;
            box-shadow: 0 4px 16px #003b7008;
            font-family: Arial, sans-serif;
        }

        .receipt-report h2 {
            margin: 0 0 8px;
            color: #003b70;
            font-size: 20px;
        }

        .receipt-report p {
            font-size: 13px;
            line-height: 1.7;
            margin: 8px 0;
        }

        .receipt-report .rr-scroll {
            overflow-x: auto;
            margin-top: 16px;
        }

        .receipt-report table {
            width: 100%;
            min-width: 640px;
            border-collapse: collapse;
            font-size: 13px;
        }

        .receipt-report th,
        .receipt-report td {
            text-align: left;
            padding: 13px 12px;
            border-bottom: 1px solid #e3eaf0;
            vertical-align: top;
            line-height: 1.6;
        }

        .receipt-report th {
            background: #edf5fb;
            color: #003b70;
            white-space: nowrap;
        }

        .receipt-report .rr-ok {
            color: #146c43;
            font-weight: bold;
        }

        .receipt-report .rr-no {
            color: #b42318;
            font-weight: bold;
        }

        .receipt-report .rr-result {
            padding: 14px;
            margin-top: 16px;
            border-radius: 7px;
            background: #fff4e5;
            color: #854d0e;
        }

        .receipt-report .rr-result.success {
            background: #eaf7f0;
            color: #146c43;
        }

        .receipt-report details {
            margin-top: 15px;
            font-size: 13px;
        }

        .receipt-report summary {
            cursor: pointer;
            color: #003b70;
            font-weight: bold;
        }

        .receipt-report pre {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            background: #f5f8fb;
            border-radius: 6px;
            padding: 14px;
            max-height: 300px;
            overflow: auto;
            font-size: 12px;
            line-height: 1.7;
        }

        .receipt-report .rr-note {
            color: #64748b;
            font-size: 12px;
        }
    </style>

    <h2>Kết quả kiểm tra hóa đơn</h2>

    <p>
        Đối chiếu thông tin hóa đơn với đơn đặt vé
        {{ $booking->booking_code }}.
    </p>

    <div class="rr-scroll">
        <table>
            <thead>
                <tr>
                    <th>Thông tin</th>
                    <th>Theo đơn đặt vé</th>
                    <th>Dữ liệu đối chiếu</th>
                    <th>Kết quả</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        <strong>Số tiền</strong>
                    </td>

                    <td>
                        {{ number_format($receiptCheck['expected_amount'], 0, ',', '.') }}đ
                    </td>

                    <td>
                        @forelse($receiptCheck['amounts'] as $readAmount)
                            <div>
                                {{ number_format($readAmount, 0, ',', '.') }}đ
                            </div>
                        @empty
                            Chưa đọc được số tiền
                        @endforelse
                    </td>

                    <td
                        class="{{ $receiptCheck['amount_matches'] ? 'rr-ok' : 'rr-no' }}"
                    >
                        {{ $receiptCheck['amount_matches'] ? '✓ Khớp số tiền' : (count($receiptCheck['amounts']) ? 'Không khớp số tiền' : 'Chưa xác minh được') }}
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Nội dung chuyển khoản</strong>
                    </td>

                    <td>
                        {{ $receiptCheck['expected_content'] }}
                    </td>

                    <td>
                        {{ $receiptCheck['read_content'] ?? 'Chưa tách được nội dung; xem văn bản OCR bên dưới.' }}
                    </td>

                    <td
                        class="{{ $receiptCheck['content_matches'] ? 'rr-ok' : 'rr-no' }}"
                    >
                        {{ $receiptCheck['content_matches'] ? '✓ Đạt đối chiếu nội dung' : 'Không tìm thấy nội dung khớp' }}
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Mã giao dịch</strong>
                    </td>

                    <td>
                        Phải có mã và không dùng lại cho đơn khác
                    </td>

                    <td>
                        {{ $receiptCheck['transaction_code'] ?: 'Chưa đọc được mã giao dịch' }}
                    </td>

                    <td
                        class="{{ $receiptCheck['transaction_code'] && $receiptCheck['transaction_unused'] ? 'rr-ok' : 'rr-no' }}"
                    >
                        @if(!$receiptCheck['transaction_code'])
                            Chưa xác minh được
                        @elseif($receiptCheck['verified'])
                            ✓ Đã ghi nhận cho đơn này
                        @elseif($receiptCheck['transaction_unused'])
                            ✓ Chưa sử dụng
                        @else
                            Mã giao dịch đã được sử dụng
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div
        class="rr-result {{ $receiptCheck['verified'] ? 'success' : '' }}"
        role="status"
    >
        @if($receiptCheck['verified'])
            <strong>✓ Thanh toán thành công</strong>

            <p>
                Hệ thống đã chấp nhận hóa đơn và ghi nhận
                thanh toán cho đơn đặt vé này.
            </p>
        @else
            <strong>Chưa xác minh được thanh toán</strong>

            <p>
                Kiểm tra các mục phía trên và chọn lại ảnh
                hóa đơn nếu cần. Kết quả này chưa kết luận
                giao dịch ngân hàng của bạn thất bại.
            </p>
        @endif
    </div>

    <details>
        <summary>Xem văn bản OCR đọc từ hóa đơn</summary>

        <pre>{{ $receiptCheck['ocr_text'] ?: 'Chưa đọc được văn bản.' }}</pre>
    </details>

    <p class="rr-note">
        OCR có thể bỏ khoảng trắng hoặc nhầm ký tự.
        Kết quả nội dung dùng quy tắc đối chiếu hiện có
        của hệ thống. Khi hóa đơn có nhiều số tiền,
        hệ thống hiển thị các giá trị đã trích xuất.
    </p>
</section>
@endif
'''


def replace_once(source, old, new):
    if source.count(old) != 1:
        raise RuntimeError(
            "Không tìm thấy đúng một vị trí cần thêm. "
            "Chương trình dừng để bảo vệ code cũ."
        )

    return source.replace(old, new, 1)


def prepare():
    for path in (CONTROLLER, PAYMENT, TICKET):
        if not path.is_file():
            raise RuntimeError(
                "Không tìm thấy file: " + str(path)
            )

    originals = {
        path: path.read_bytes()
        for path in (CONTROLLER, PAYMENT, TICKET)
    }

    controller, payment, ticket = [
        originals[path]
        .decode("utf-8-sig")
        .replace("\r\n", "\n")
        for path in (CONTROLLER, PAYMENT, TICKET)
    ]

    if "receiptCheckReport(" in controller or PARTIAL.exists():
        raise RuntimeError(
            "Đã có phần kết quả hóa đơn. Không chạy lặp lại."
        )

    marker = "            if (!$transactionCode) {"

    addition = '''            $receiptCheck = $this->receiptCheckReport(
                $booking,
                $ocr,
                $hasCorrectContent,
                $hasCorrectAmount,
                $transactionCode && !Payment::where('receipt_transaction_code', $transactionCode)->exists()
            );

'''

    controller = replace_once(
        controller,
        marker,
        addition + marker
    )

    errors = [
        (
            "Không đọc được mã giao dịch trên hóa đơn. "
            "Vui lòng sử dụng ảnh hóa đơn rõ hơn."
        ),
        (
            "Mã giao dịch này đã được sử dụng "
            "cho một thanh toán khác."
        ),
        (
            "Hóa đơn không hợp lệ. "
            "Nội dung chuyển khoản không đúng."
        ),
        (
            "Hóa đơn không hợp lệ. "
            "Số tiền chuyển khoản không đúng."
        ),
    ]

    for message in errors:
        old = (
            "                    '"
            + message
            + "'\n                );"
        )

        new = (
            "                    '"
            + message
            + "'\n                )"
            + "->with('receipt_check', $receiptCheck);"
        )

        controller = replace_once(controller, old, new)

    old = """                    'error',
                    $e->getMessage()
                );
        }
    }

    public function ticket"""

    new = """                    'error',
                    $e->getMessage()
                )->with('receipt_check', isset($receiptCheck) ? $receiptCheck : [
                    'booking_id' => $booking->id,
                    'expected_content' => 'VJ ' . $booking->booking_code,
                    'expected_amount' => (int) $booking->total_amount,
                    'read_content' => null,
                    'amounts' => [],
                    'content_matches' => false,
                    'amount_matches' => false,
                    'transaction_code' => null,
                    'transaction_unused' => false,
                    'verified' => false,
                    'ocr_text' => '',
                ]);
        }
    }

    public function ticket"""

    controller = replace_once(controller, old, new)

    old = """        return view(
            'user.ve-dien-tu',
            compact('booking')
        );"""

    new = """        $receiptCheck = null;

        $payment = Payment::where('booking_id', $booking->id)
            ->where('payment_status', 'paid')
            ->where('payment_method', 'bank_transfer')
            ->orderByDesc('id')
            ->first();

        if (
            $payment
            && $payment->ocr_text
            && $payment->receipt_content
            && $payment->receipt_amount !== null
            && $payment->receipt_transaction_code
        ) {
            $receiptCheck = $this->receiptCheckReport(
                $booking,
                [
                    'text' => $payment->ocr_text,
                    'amounts' => [(int) $payment->receipt_amount],
                    'transaction_code' => $payment->receipt_transaction_code,
                    'expected_content' => $payment->receipt_content,
                    'expected_amount' => (int) $payment->amount,
                ],
                true,
                (int) $payment->receipt_amount === (int) $payment->amount,
                true,
                true
            );
        }

        return view(
            'user.ve-dien-tu',
            compact('booking', 'receiptCheck')
        );"""

    controller = replace_once(controller, old, new)

    marker = "    public function ticket(Booking $booking)"

    controller = replace_once(
        controller,
        marker,
        HELPER + "\n" + marker
    )

    marker = '    <div class="payment-layout">'

    payment = replace_once(
        payment,
        marker,
        (
            "    @include('user.partials.ket-qua-hoa-don', "
            "['receiptCheck' => session('receipt_check')])\n\n"
            + marker
        )
    )

    marker = '    <section class="booking-summary">'

    ticket = replace_once(
        ticket,
        marker,
        "    @include('user.partials.ket-qua-hoa-don')\n\n"
        + marker
    )

    changed = {
        CONTROLLER: controller,
        PAYMENT: payment,
        TICKET: ticket,
        PARTIAL: PARTIAL_TEXT,
    }

    return originals, changed


def main():
    originals, changed = prepare()

    backup = ROOT / (
        "backup_receipt_report_"
        + datetime.now().strftime("%Y%m%d_%H%M%S_%f")
    )

    # Chỉ sửa sau khi đã kiểm tra đủ vị trí và sao lưu.
    for path in originals:
        destination = backup / path.relative_to(ROOT)

        destination.parent.mkdir(
            parents=True,
            exist_ok=True
        )

        shutil.copy2(path, destination)

    try:
        for path, content in changed.items():
            path.parent.mkdir(
                parents=True,
                exist_ok=True
            )

            with path.open(
                "w",
                encoding="utf-8",
                newline=""
            ) as handle:
                handle.write(
                    content.replace("\n", "\r\n")
                )

    except Exception:
        # Nếu ghi file lỗi thì khôi phục ba file ban đầu.
        for path, data in originals.items():
            path.write_bytes(data)

        if PARTIAL.exists():
            PARTIAL.unlink()

        raise

    print("Đã thêm bảng kết quả kiểm tra hóa đơn.")
    print("Bản sao code cũ: " + str(backup))
    print("Tiếp theo chạy: php artisan optimize:clear")


if __name__ == "__main__":
    try:
        main()

    except Exception as error:
        print("DỪNG: " + str(error))
        raise SystemExit(1)