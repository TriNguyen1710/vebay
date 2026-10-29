@if(
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
