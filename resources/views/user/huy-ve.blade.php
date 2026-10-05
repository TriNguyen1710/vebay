<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Hủy vé - SkyGo</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #003b70;
            --primary-dark: #00294f;
            --secondary: #f4b400;
            --danger: #dc3545;
            --background: #f3f6f9;
            --white: #ffffff;
            --text: #243746;
            --muted: #74818c;
            --border: #dfe6eb;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        button,
        input {
            font-family: inherit;
        }

        .header {
            background: var(--primary-dark);
            color: white;
        }

        .header-inner {
            max-width: 1050px;
            min-height: 72px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            color: white;
            font-size: 27px;
            font-weight: 800;
        }

        .logo span {
            color: var(--secondary);
        }

        .back-link {
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .main {
            max-width: 850px;
            margin: 35px auto 60px;
            padding: 0 20px;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(20, 45, 65, 0.07);
            overflow: hidden;
        }

        .card-header {
            padding: 23px 25px;
            background: #fff7f7;
            border-bottom: 1px solid #efd5d7;
        }

        .card-header h1 {
            margin-bottom: 7px;
            color: var(--danger);
            font-size: 23px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .body {
            padding: 25px;
        }

        .ticket-summary {
            margin-bottom: 22px;
            padding: 17px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #f8fafc;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .label {
            display: block;
            margin-bottom: 5px;
            color: var(--muted);
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .value {
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: bold;
        }

        .refund-highlight {
            margin-bottom: 22px;
            padding: 16px;
            border: 1px solid #ead58e;
            border-left: 4px solid var(--secondary);
            border-radius: 7px;
            background: #fffaf0;
        }

        .refund-highlight strong {
            display: block;
            margin-bottom: 6px;
            color: var(--primary-dark);
            font-size: 14px;
        }

        .refund-highlight p {
            color: #655b43;
            font-size: 10px;
            line-height: 1.6;
        }

        .form-title {
            margin-bottom: 14px;
            color: var(--primary);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #42515e;
            font-size: 10px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #d5dee5;
            border-radius: 6px;
            color: #394b58;
            font-size: 11px;
        }

        .error {
            margin-top: 5px;
            color: var(--danger);
            font-size: 9px;
        }

        .notice {
            margin: 18px 0;
            padding: 13px 14px;
            border-radius: 6px;
            background: #edf5fb;
            color: #38546a;
            font-size: 10px;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 22px;
        }

        .btn {
            min-height: 42px;
            padding: 0 18px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-back {
            border: 1px solid var(--border);
            background: white;
            color: var(--primary);
        }

        .btn-cancel {
            border: none;
            background: var(--danger);
            color: white;
        }

        @media (max-width: 650px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header class="header">
    <div class="header-inner">

        <a
            href="{{ route('trang-chu') }}"
            class="logo"
        >
            Sky<span>Go</span>
        </a>

        <a
            href="{{ route('tickets.mine') }}"
            class="back-link"
        >
            ← Quay lại Vé của tôi
        </a>

    </div>
</header>

<main class="main">

    <section class="card">

        <div class="card-header">

            <h1>
                Hủy vé
            </h1>

            <p>
                Khi xác nhận hủy, ghế sẽ được giải phóng ngay
                và hệ thống tạo yêu cầu hoàn theo tỷ lệ hiện hành do Admin thiết lập.
            </p>

        </div>

        <div class="body">

            <div class="ticket-summary">

                <div class="summary-grid">

                    <div>
                        <span class="label">
                            Mã vé
                        </span>

                        <span class="value">
                            {{ $ticket->ticket_code }}
                        </span>
                    </div>

                    <div>
                        <span class="label">
                            Hành khách
                        </span>

                        <span class="value">
                            {{ $ticket->passenger_name }}
                        </span>
                    </div>

                    <div>
                        <span class="label">
                            Chuyến bay
                        </span>

                        <span class="value">
                            {{ $ticket->flight->flight_code }}
                            ·
                            {{ $ticket->flight->departureAirport->city }}
                            →
                            {{ $ticket->flight->arrivalAirport->city }}
                        </span>
                    </div>

                    <div>
                        <span class="label">
                            Ngày giờ bay
                        </span>

                        <span class="value">
                            {{ $ticket->flight->flight_date->format('d/m/Y') }}
                            ·
                            {{ substr($ticket->flight->departure_time, 0, 5) }}
                        </span>
                    </div>

                    <div>
                        <span class="label">
                            Giá vé
                        </span>

                        <span class="value">
                            {{ number_format(
                                $ticket->price,
                                0,
                                ',',
                                '.'
                            ) }} đ
                        </span>
                    </div>

                    <div>
                        <span class="label">
                            Ghế
                        </span>

                        <span class="value">
                            {{ $ticket->flightSeat->seat_number }}
                        </span>
                    </div>

                </div>

            </div>

            <div class="refund-highlight">

                <strong>
                    Số tiền dự kiến hoàn:
                    {{ number_format(
                        $refundAmount,
                        0,
                        ',',
                        '.'
                    ) }} đ
                </strong>

                <p>
                    Số tiền này bằng {{ rtrim(rtrim(number_format((float) $refundPercentage, 2, '.', ''), '0'), '.') }}% giá vé.
                    Đây là luồng mô phỏng, hệ thống lưu yêu cầu hoàn tiền
                    và Admin xác nhận sau khi xử lý hoàn tiền cho khách.
                </p>

            </div>

            <h2 class="form-title">
                Thông tin tài khoản nhận hoàn tiền
            </h2>

            <form
                action="{{ route(
                    'ticket.cancel.submit',
                    $ticket->id
                ) }}"
                method="POST"
                onsubmit="return confirm(
                    'Bạn chắc chắn muốn hủy vé này? Ghế sẽ được giải phóng ngay.'
                );"
            >
                @csrf

                <div class="form-group">
                    <label>
                        Tên ngân hàng
                    </label>

                    <input
                        type="text"
                        name="refund_bank_name"
                        value="{{ old('refund_bank_name') }}"
                        placeholder="Ví dụ: Vietcombank"
                    >

                    @error('refund_bank_name')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Số tài khoản
                    </label>

                    <input
                        type="text"
                        name="refund_account_number"
                        value="{{ old('refund_account_number') }}"
                        placeholder="Nhập số tài khoản nhận tiền"
                    >

                    @error('refund_account_number')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Tên chủ tài khoản
                    </label>

                    <input
                        type="text"
                        name="refund_account_name"
                        value="{{ old('refund_account_name') }}"
                        placeholder="Nhập đúng tên chủ tài khoản"
                    >

                    @error('refund_account_name')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="notice">
                    Sau khi gửi yêu cầu, vé chuyển sang trạng thái
                    <strong>Đã hủy</strong>, ghế được mở lại và
                    yêu cầu hoàn tiền chuyển sang
                    <strong>Chờ Admin xác nhận</strong>.
                </div>

                <div class="actions">

                    <a
                        href="{{ route('tickets.mine') }}"
                        class="btn btn-back"
                    >
                        Quay lại
                    </a>

                    <button
                        type="submit"
                        class="btn btn-cancel"
                    >
                        Xác nhận hủy vé
                    </button>

                </div>

            </form>

        </div>

    </section>

</main>

</body>
</html>
