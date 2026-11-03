@php
    // Khi được nhúng vào trang thanh toán: chỉ hiện nút gửi yêu cầu.
    // Khi controller mở trực tiếp: hiện trang gửi và xem kết quả.
    $buttonOnly = $paymentReviewButtonOnly ?? false;
@endphp

@if($buttonOnly)
    @if(
        auth()->check()
        && auth()->user()->role === 'user'
        && (int) $booking->user_id === (int) auth()->id()
        && $booking->payment_status !== 'paid'
        && (int) data_get(session('receipt_check'), 'booking_id', 0) === (int) $booking->id
    )
        <section
            style="margin:18px 0;padding:20px;border:1px solid #dbe4ed;border-radius:10px;background:#fff"
        >
            <strong style="color:#003b70">
                Bạn đã chuyển tiền nhưng hóa đơn chưa được xác nhận?
            </strong>

            <p style="font-size:13px;line-height:1.7;margin:10px 0">
                Gửi yêu cầu để admin kiểm tra giao dịch với đơn đặt vé.
                Bạn không cần chuyển tiền lại.
            </p>

            <a
                href="{{ route('payment-reviews.customer', $booking->id) }}"
                style="display:inline-block;padding:12px 18px;border-radius:6px;background:#003b70;color:white;font-size:13px;font-weight:bold;text-decoration:none"
            >
                Yêu cầu kiểm tra thanh toán
            </a>
        </section>
    @endif
@else
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kiểm tra thanh toán - VietJet</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f3f6fa;
            color: #263849;
            font: 14px Arial, sans-serif;
        }

        a {
            color: #003b70;
            text-decoration: none;
        }

        button,
        input,
        textarea {
            font: inherit;
        }

        .header {
            background: #00294f;
            color: white;
        }

        .header-inner {
            max-width: 1200px;
            margin: auto;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .logo {
            color: white;
            font-size: 30px;
            font-weight: 800;
            font-style: italic;
            letter-spacing: -1px;
        }

        .logo span {
            color: #ffc107;
        }

        .header-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-links a {
            color: #e1edf7;
            font-size: 13px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 28px 24px 45px;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 20px;
            color: #8090a1;
            font-size: 12px;
        }

        .breadcrumb a {
            color: #60768c;
        }

        h1 {
            margin: 0 0 10px;
            color: #173b5a;
            font-size: 26px;
        }

        h2 {
            margin: 0 0 20px;
            color: #003b70;
            font-size: 18px;
        }

        p {
            line-height: 1.8;
        }

        .description {
            margin: 0 0 24px;
            color: #718296;
            font-size: 13px;
        }

        .card {
            margin-bottom: 22px;
            padding: 24px;
            border: 1px solid #dfe7ef;
            border-radius: 12px;
            background: white;
            box-shadow: 0 3px 14px #193e6005;
        }

        .booking-info {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .info-item {
            padding: 16px;
            border: 1px solid #e2ebf3;
            border-radius: 8px;
            background: #f8fbfe;
        }

        .info-item span {
            display: block;
            margin-bottom: 9px;
            color: #74879a;
            font-size: 12px;
        }

        .info-item strong {
            color: #003b70;
            font-size: 15px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .notice,
        .success,
        .errors,
        .pending-notice {
            margin-bottom: 20px;
            padding: 15px 16px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.8;
        }

        .notice {
            border-color: #f2dfb7;
            background: #fff7e9;
            color: #855b13;
        }

        .success {
            border-color: #cbe7d7;
            background: #edf9f2;
            color: #146c43;
        }

        .errors {
            border-color: #f2d1d1;
            background: #fff0f0;
            color: #a12620;
        }

        .pending-notice {
            border-color: #d4e5f4;
            background: #edf5fc;
            color: #315d80;
        }

        .pending-notice p {
            margin: 8px 0 0;
        }

        label {
            display: block;
            margin: 18px 0 9px;
            color: #52677b;
            font-size: 13px;
            font-weight: 700;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd9e5;
            border-radius: 7px;
            background: white;
            color: #263849;
            font-size: 13px;
        }

        input:focus,
        textarea:focus {
            outline: 2px solid #c5dcef;
            outline-offset: 1px;
        }

        input[type=file] {
            background: #f8fbfe;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .muted {
            color: #75869a;
            font-size: 12px;
        }

        .buttons {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .button,
        button {
            min-height: 41px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 16px;
            border: 1px solid transparent;
            border-radius: 7px;
            background: #003b70;
            color: white;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;
            cursor: pointer;
        }

        .button:hover,
        button:hover {
            background: #002d56;
        }

        .secondary {
            border-color: #d5e0eb;
            background: white;
            color: #335a7a;
        }

        .secondary:hover {
            background: #edf4fa;
        }

        .scroll {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            font-size: 13px;
        }

        th,
        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e6edf3;
            text-align: left;
            vertical-align: top;
            line-height: 1.7;
        }

        th {
            background: #f0f6fb;
            color: #536d84;
            font-size: 12px;
            white-space: nowrap;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .nowrap {
            white-space: nowrap;
        }

        .message-cell {
            min-width: 180px;
            max-width: 300px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .result-cell {
            min-width: 200px;
            max-width: 320px;
            overflow-wrap: anywhere;
        }

        .badge {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 6px;
            background: #edf2f7;
            color: #52677b;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge.pending {
            background: #fff3dc;
            color: #93600a;
        }

        .badge.approved {
            background: #e9f7ef;
            color: #167346;
        }

        .badge.rejected {
            background: #fdeeee;
            color: #b42318;
        }

        .bill-link {
            font-weight: 700;
            white-space: nowrap;
        }

        .empty {
            padding: 30px 15px;
            text-align: center;
            color: #7b8b9b;
        }

        @media (max-width: 750px) {
            .container {
                padding: 22px 14px;
            }

            .header-inner {
                padding: 18px;
            }

            .card {
                padding: 18px;
            }

            .booking-info {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
@php
    $statusLabels = [
        'pending' => 'Chờ xử lý',
        'approved' => 'Đã duyệt',
        'rejected' => 'Đã từ chối',
    ];

    $hasPendingReview = $reviews->contains('status', 'pending');
@endphp

<header class="header">
    <div class="header-inner">
        <a class="logo" href="{{ route('trang-chu') }}">
            Viet<span>Jet</span>
        </a>

        <nav class="header-links" aria-label="Menu khách hàng">
            <a href="{{ route('trang-chu') }}">Trang chủ</a>
            <a href="{{ route('tickets.mine') }}">Lịch sử vé</a>
        </nav>
    </div>
</header>

<main class="container">
    <nav class="breadcrumb" aria-label="Đường dẫn">
        <a href="{{ route('trang-chu') }}">Trang chủ</a>
        <span>/</span>
        <a href="{{ route('tickets.mine') }}">Lịch sử vé</a>
        <span>/</span>
        <span>Kiểm tra thanh toán</span>
    </nav>

    <h1>Yêu cầu kiểm tra thanh toán</h1>

    <p class="description">
        Gửi hóa đơn và lời nhắn để admin kiểm tra thanh toán
        cho đơn đặt vé của bạn.
    </p>

    @if(session('success'))
        <div class="success" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="errors" role="alert">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="card">
        <h2>Thông tin đơn đặt vé</h2>

        <div class="booking-info">
            <div class="info-item">
                <span>Mã đặt vé</span>
                <strong>{{ $booking->booking_code }}</strong>
            </div>

            <div class="info-item">
                <span>Số tiền đơn</span>
                <strong>
                    {{ number_format($booking->total_amount, 0, ',', '.') }}đ
                </strong>
            </div>

            <div class="info-item">
                <span>Trạng thái thanh toán</span>
                <strong>
                    {{ $booking->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa xác minh thanh toán' }}
                </strong>
            </div>
        </div>

        @if($booking->payment_status === 'paid')
            <div class="success">
                Đơn đặt vé đã được ghi nhận thanh toán.
                Bạn có thể xem vé điện tử bên dưới.
            </div>

            <div class="buttons">
                <a class="button" href="{{ route('ticket.show', $booking->id) }}">
                    Xem vé điện tử
                </a>

                <a class="button secondary" href="{{ route('tickets.mine') }}">
                    Lịch sử vé
                </a>
            </div>
        @else
            <div class="notice">
                Gửi yêu cầu không gia hạn giữ ghế.
                Nếu đơn đã hết hạn hoặc đã hủy, admin cần xử lý ghế
                hoặc hoàn tiền riêng. Bạn không cần chuyển tiền lại.
            </div>

            @if(!$hasPendingReview)
                <form
                    method="POST"
                    action="{{ route('payment-reviews.store', $booking->id) }}"
                    enctype="multipart/form-data"
                >
                    @csrf

                    @if($hasReceipt)
                        <p>
                            Hệ thống đang giữ hóa đơn bạn vừa tải.
                            Bạn có thể gửi lại hóa đơn này hoặc chọn ảnh khác
                            bên dưới.
                        </p>
                    @endif

                    <label for="receipt">
                        {{ $hasReceipt ? 'Chọn hóa đơn khác nếu cần' : 'Ảnh hóa đơn chuyển khoản' }}
                    </label>

                    <input
                        id="receipt"
                        name="receipt"
                        type="file"
                        accept="image/jpeg,image/png"
                        @required(!$hasReceipt)
                    >

                    <p class="muted">Ảnh JPG hoặc PNG, tối đa 5MB.</p>

                    <label for="message">Lời nhắn cho admin</label>

                    <textarea
                        id="message"
                        name="message"
                        required
                        minlength="3"
                        maxlength="1000"
                        placeholder="Ví dụ: Tôi đã chuyển tiền nhưng ghi nhầm nội dung. Nhờ admin kiểm tra giúp."
                    >{{ old('message') }}</textarea>

                    <div class="buttons">
                        <button type="submit">
                            Gửi yêu cầu kiểm tra thanh toán
                        </button>

                        <a
                            class="button secondary"
                            href="{{ route('tickets.mine') }}"
                        >
                            Lịch sử vé
                        </a>
                    </div>
                </form>
            @else
                <div class="pending-notice" role="status">
                    <strong>Yêu cầu của bạn đang chờ admin xử lý.</strong>

                    <p>
                        Kết quả sẽ hiển thị tại bảng bên dưới và trong
                        thông báo. Bạn không cần gửi thêm yêu cầu
                        hoặc chuyển tiền lại.
                    </p>
                </div>

                <div class="buttons">
                    <a
                        class="button secondary"
                        href="{{ route('payment-reviews.customer', $booking->id) }}"
                    >
                        Làm mới kết quả
                    </a>

                    <a
                        class="button secondary"
                        href="{{ route('tickets.mine') }}"
                    >
                        Lịch sử vé
                    </a>
                </div>
            @endif
        @endif
    </section>

    <section class="card">
        <h2>Các yêu cầu của đơn này</h2>

        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th>Yêu cầu</th>
                        <th>Ngày gửi</th>
                        <th>Hóa đơn</th>
                        <th>Lời nhắn</th>
                        <th>Trạng thái</th>
                        <th>Kết quả từ admin</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>#{{ $review->id }}</td>

                            <td class="nowrap">
                                {{ \Carbon\Carbon::parse($review->created_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                            </td>

                            <td>
                                <a
                                    class="bill-link"
                                    href="{{ route('payment-reviews.image', $review->id) }}"
                                    target="_blank"
                                    rel="noopener"
                                >
                                    Xem hóa đơn
                                </a>
                            </td>

                            <td class="message-cell">{{ $review->message }}</td>

                            <td>
                                <span class="badge {{ $review->status }}">
                                    {{ $statusLabels[$review->status] ?? $review->status }}
                                </span>
                            </td>

                            <td class="result-cell">
                                {{ $review->reviewer_note ?? 'Chưa có kết quả' }}

                                @if($review->reviewed_at)
                                    <br>

                                    <span class="muted">
                                        {{ \Carbon\Carbon::parse($review->reviewed_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Chưa có yêu cầu kiểm tra thanh toán.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>
@endif