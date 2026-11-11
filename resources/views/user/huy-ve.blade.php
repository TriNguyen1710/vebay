
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hủy vé máy bay - Vietjet</title>

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
            --danger-dark: #b4232f;
            --background: #f3f6fa;
            --white: #ffffff;
            --text: #243746;
            --muted: #74818c;
            --border: #dfe6eb;
            --success: #198754;
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

        /* HEADER */

        .header {
            background: var(--primary-dark);
            color: white;
            box-shadow: 0 3px 15px rgba(0,0,0,0.12);
        }

        .header-inner {
            max-width: 1100px;
            min-height: 76px;
            margin: auto;
            padding: 0 22px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .logo {
            color: white;
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .back-link {
            color: #dbe8f2;
            font-size: 13px;
            font-weight: bold;
            transition: 0.2s;
        }

        .back-link:hover {
            color: var(--secondary);
        }

        /* BANNER */

        .page-banner {
            min-height: 220px;
            background:
                linear-gradient(
                    105deg,
                    rgba(0, 35, 67, 0.96),
                    rgba(0, 59, 112, 0.80)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');

            background-size: cover;
            background-position: center;
            color: white;
        }

        .banner-inner {
            max-width: 1100px;
            margin: auto;
            padding: 37px 22px 80px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 17px;
            font-size: 12px;
        }

        .breadcrumb a {
            color: #ffd56a;
        }

        .breadcrumb span {
            color: #dae7f1;
        }

        .banner-inner h1 {
            font-size: 31px;
            margin-bottom: 10px;
            font-weight: 800;
        }

        .banner-inner p {
            color: #dce9f3;
            font-size: 13px;
            line-height: 1.7;
            max-width: 650px;
        }

        /* MAIN */

        .main {
            max-width: 970px;
            margin: -52px auto 70px;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(20, 45, 65, 0.09);
            overflow: hidden;
        }

        .card-header {
            padding: 25px 29px;
            background: white;
            border-bottom: 1px solid #e8edf1;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .card-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;
            background: #fff0f1;
            color: var(--danger);
            font-size: 23px;
            font-weight: bold;
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 22px;
            font-weight: 800;
        }

        .card-header p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            margin-left: 57px;
        }

        .card-body {
            padding: 27px 29px 30px;
        }

        /* SECTION */

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 15px;
        }

        .section-title {
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        .section-subtitle {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
            line-height: 1.5;
        }

        .ticket-badge {
            background: #edf5fb;
            color: var(--primary);
            border: 1px solid #c9ddeb;
            padding: 7px 11px;
            font-size: 10px;
            font-weight: 800;
            border-radius: 6px;
        }

        /* TICKET SUMMARY */

        .ticket-summary {
            margin-bottom: 24px;
            background: #f9fbfd;
            border: 1px solid #dfe7ed;
            border-radius: 11px;
            overflow: hidden;
        }

        .ticket-top {
            background: var(--primary);
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .ticket-top-logo {
            font-size: 19px;
            font-weight: 800;
        }

        .ticket-top-logo span {
            color: var(--secondary);
        }

        .ticket-top-text {
            font-size: 10px;
            color: #d7e5f0;
            letter-spacing: 1px;
            font-weight: bold;
        }

        /* FLIGHT ROUTE */

        .flight-route {
            display: grid;
            grid-template-columns: 1fr 150px 1fr;
            align-items: center;
            gap: 16px;
            padding: 26px 23px;
            background: #fff;
            border-bottom: 1px solid #e8edf1;
        }

        .airport:last-child {
            text-align: right;
        }

        .airport-label {
            color: #8a98a3;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .airport-city {
            color: var(--primary);
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .airport-time {
            color: #40566a;
            font-size: 13px;
            font-weight: bold;
        }

        .flight-middle {
            text-align: center;
        }

        .flight-symbol {
            color: var(--primary);
            font-size: 21px;
            margin-bottom: 8px;
        }

        .flight-line {
            height: 2px;
            background: #bfd1de;
            position: relative;
            margin-bottom: 9px;
        }

        .flight-line::before,
        .flight-line::after {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--primary);
            position: absolute;
            top: -2px;
        }

        .flight-line::before {
            left: 0;
        }

        .flight-line::after {
            right: 0;
        }

        .flight-code {
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
        }

        .ticket-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            padding: 12px 22px 18px;
            gap: 8px 18px;
        }

        .detail-item {
            padding: 12px 0;
        }

        .detail-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .detail-value {
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 800;
            word-break: break-word;
        }

        .detail-value.price {
            color: #b42318;
        }

        .seat-tag {
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        /* REFUND */

        .refund-highlight {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 20px;

            padding: 22px 24px;
            margin-bottom: 27px;

            background: #fffaf0;
            border: 1px solid #ead58e;
            border-left: 5px solid var(--secondary);
            border-radius: 10px;
        }

        .refund-label {
            color: #6d5a24;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .refund-percentage {
            color: #8c6c19;
            font-size: 12px;
            line-height: 1.6;
        }

        .refund-amount {
            color: #b42318;
            font-size: 27px;
            font-weight: 800;
            white-space: nowrap;
        }

        .refund-help {
            color: #786d55;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 10px;
        }

        /* FORM */

        .form-section {
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 23px;
            margin-bottom: 20px;
        }

        .form-section-header {
            margin-bottom: 21px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e8edf1;
        }

        .form-title {
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .form-description {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #364b5c;
            font-size: 12px;
            font-weight: 700;
        }

        .required {
            color: var(--danger);
        }

        .form-group input {
            width: 100%;
            height: 47px;
            padding: 0 14px;
            background: #fff;
            border: 1px solid #d5dee5;
            border-radius: 7px;
            outline: none;
            color: #273b4b;
            font-size: 13px;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0,59,112,0.10);
        }

        .form-group input::placeholder {
            color: #a0abb4;
        }

        .error {
            margin-top: 7px;
            color: var(--danger);
            font-size: 11px;
        }

        .error-summary {
            padding: 14px 16px;
            margin-bottom: 20px;
            border: 1px solid #f1bcc3;
            background: #fff1f2;
            border-radius: 7px;
            color: #9d2331;
            font-size: 12px;
            line-height: 1.6;
        }

        /* NOTICES */

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 11px;

            padding: 15px 17px;
            margin: 20px 0;

            border-radius: 8px;
            background: #edf5fb;
            border: 1px solid #cfdeea;

            color: #38546a;
            font-size: 12px;
            line-height: 1.7;
        }

        .notice-icon {
            flex-shrink: 0;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
        }

        .warning-box {
            padding: 16px 18px;
            margin-top: 15px;
            background: #fff4f4;
            border: 1px solid #f0c7cb;
            border-left: 4px solid var(--danger);
            border-radius: 8px;
        }

        .warning-title {
            color: #a72b37;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .warning-box p {
            color: #79545b;
            font-size: 11px;
            line-height: 1.7;
        }

        /* ACTIONS */

        .actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
        }

        .btn {
            min-height: 46px;
            padding: 0 22px;
            border-radius: 7px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-back {
            border: 1px solid #d2dee6;
            background: #fff;
            color: var(--primary);
        }

        .btn-back:hover {
            background: #f0f5f9;
        }

        .btn-cancel {
            border: none;
            background: var(--danger);
            color: #fff;
            box-shadow: 0 4px 13px rgba(220,53,69,0.16);
        }

        .btn-cancel:hover {
            background: var(--danger-dark);
        }

        /* FOOTER */

        .footer {
            margin-top: 55px;
            background: #031d33;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        .footer-logo {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .footer-logo span {
            color: var(--secondary);
        }

        .footer p {
            color: #b3c2ce;
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 750px) {
            .flight-route {
                grid-template-columns: 1fr 80px 1fr;
            }

            .airport-city {
                font-size: 19px;
            }

            .ticket-details {
                grid-template-columns: repeat(2, 1fr);
            }

            .refund-highlight {
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .refund-amount {
                font-size: 25px;
            }
        }

        @media (max-width: 520px) {
            .header-inner {
                padding: 0 16px;
            }

            .logo {
                font-size: 24px;
            }

            .back-link {
                font-size: 10px;
            }

            .banner-inner h1 {
                font-size: 25px;
            }

            .main {
                padding: 0 12px;
            }

            .card-header {
                padding: 20px;
            }

            .card-header p {
                margin-left: 0;
            }

            .card-body {
                padding: 20px 15px;
            }

            .flight-route {
                grid-template-columns: 1fr;
                gap: 16px;
                text-align: center;
                padding: 20px;
            }

            .airport:last-child {
                text-align: center;
            }

            .flight-middle {
                padding: 0 25%;
            }

            .ticket-details {
                grid-template-columns: repeat(2, 1fr);
                padding: 12px 17px;
            }

            .refund-highlight {
                padding: 18px;
            }

            .form-section {
                padding: 17px;
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

{{-- ===================================================== --}}
{{-- HEADER VIETJET --}}
{{-- ===================================================== --}}

<header class="header">
    <div class="header-inner">

        <a
            href="{{ route('trang-chu') }}"
            class="logo"
        >
            Viet<span>jet</span>
        </a>

        <a
            href="{{ route('tickets.mine') }}"
            class="back-link"
        >
            ← Quay lại lịch sử vé
        </a>

    </div>
</header>

{{-- ===================================================== --}}
{{-- BANNER --}}
{{-- ===================================================== --}}

<section class="page-banner">

    <div class="banner-inner">

        <div class="breadcrumb">
            <a href="{{ route('trang-chu') }}">
                Trang chủ
            </a>

            <span>/</span>

            <a href="{{ route('tickets.mine') }}">
                Lịch sử vé
            </a>

            <span>/</span>

            <span>Hủy vé</span>
        </div>

        <h1>Yêu cầu hủy vé</h1>

        <p>
            Kiểm tra thông tin chuyến bay và số tiền dự kiến hoàn
            trước khi xác nhận hủy vé.
        </p>

    </div>

</section>

{{-- ===================================================== --}}
{{-- MAIN --}}
{{-- ===================================================== --}}

<main class="main">

    <section class="card">

        {{-- ============================================== --}}
        {{-- HEADER CARD --}}
        {{-- ============================================== --}}

        <div class="card-header">

            <div class="card-title">
                <div class="card-icon">
                    ×
                </div>

                <h2>
                    Xác nhận thông tin hủy vé
                </h2>
            </div>

            <p>
                Bạn đang thực hiện yêu cầu hủy cho một vé cụ thể.
                Nếu trong đơn có nhiều hành khách,
                các vé còn lại không bị hủy theo thao tác này.
            </p>

        </div>

        <div class="card-body">

            {{-- ========================================== --}}
            {{-- THÔNG TIN VÉ --}}
            {{-- ========================================== --}}

            <div class="section-heading">

                <div>
                    <h3 class="section-title">
                        Thông tin vé cần hủy
                    </h3>

                    <p class="section-subtitle">
                        Kiểm tra mã vé, hành khách và lịch bay.
                    </p>
                </div>

                <span class="ticket-badge">
                    {{ $ticket->ticket_code }}
                </span>

            </div>

            <div class="ticket-summary">

                {{-- HEADER VÉ --}}

                <div class="ticket-top">

                    <div class="ticket-top-logo">
                        Viet<span>jet</span>
                    </div>

                    <div class="ticket-top-text">
                        ELECTRONIC TICKET
                    </div>

                </div>

                {{-- HÀNH TRÌNH --}}

                <div class="flight-route">

                    <div class="airport">

                        <div class="airport-label">
                            Điểm khởi hành
                        </div>

                        <div class="airport-city">
                            {{ $ticket->flight->departureAirport->city }}
                        </div>

                        <div class="airport-time">
                            {{ substr($ticket->flight->departure_time, 0, 5) }}
                        </div>

                    </div>

                    <div class="flight-middle">

                        <div class="flight-symbol">
                            ✈
                        </div>

                        <div class="flight-line"></div>

                        <div class="flight-code">
                            {{ $ticket->flight->flight_code }}
                        </div>

                    </div>

                    <div class="airport">

                        <div class="airport-label">
                            Điểm đến
                        </div>

                        <div class="airport-city">
                            {{ $ticket->flight->arrivalAirport->city }}
                        </div>

                        <div class="airport-time">
                            {{ substr($ticket->flight->arrival_time, 0, 5) }}
                        </div>

                    </div>

                </div>

                {{-- CHI TIẾT VÉ --}}

                <div class="ticket-details">

                    <div class="detail-item">
                        <span class="detail-label">
                            Mã vé
                        </span>

                        <span class="detail-value">
                            {{ $ticket->ticket_code }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">
                            Hành khách
                        </span>

                        <span class="detail-value">
                            {{ $ticket->passenger_name }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">
                            Số ghế
                        </span>

                        <span class="seat-tag">
                            {{ $ticket->flightSeat->seat_number }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">
                            Ngày bay
                        </span>

                        <span class="detail-value">
                            {{ $ticket->flight->flight_date->format('d/m/Y') }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">
                            Hạng ghế
                        </span>

                        <span class="detail-value">
                            {{ $ticket->seat_class === 'vip' ? 'VIP' : 'Phổ thông' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">
                            Giá vé
                        </span>

                        <span class="detail-value price">
                            {{
                                number_format(
                                    $ticket->price,
                                    0,
                                    ',',
                                    '.'
                                )
                            }} đ
                        </span>
                    </div>

                </div>

            </div>

            {{-- ========================================== --}}
            {{-- SỐ TIỀN HOÀN --}}
            {{-- ========================================== --}}

            <div class="refund-highlight">

                <div>
                    <div class="refund-label">
                        Số tiền dự kiến hoàn
                    </div>

                    <div class="refund-percentage">
                        Tỷ lệ hoàn tiền hiện tại:
                        <strong>
                            {{
                                rtrim(
                                    rtrim(
                                        number_format(
                                            (float) $refundPercentage,
                                            2,
                                            '.',
                                            ''
                                        ),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}%
                        </strong>
                    </div>

                    <p class="refund-help">
                        Số tiền được tính từ giá vé và tỷ lệ hoàn tiền
                        do Admin thiết lập. Đây là số tiền dự kiến,
                        chưa phải giao dịch chuyển khoản hoàn tiền.
                    </p>
                </div>

                <div class="refund-amount">
                    {{
                        number_format(
                            $refundAmount,
                            0,
                            ',',
                            '.'
                        )
                    }} đ
                </div>

            </div>

            {{-- ========================================== --}}
            {{-- LỖI FORM --}}
            {{-- ========================================== --}}

            @if($errors->any())

                <div class="error-summary">
                    <strong>
                        Vui lòng kiểm tra lại thông tin:
                    </strong>

                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>

            @endif

            @if(session('error'))
                <div class="error-summary">
                    {{ session('error') }}
                </div>
            @endif

            {{-- ========================================== --}}
            {{-- FORM YÊU CẦU HỦY VÉ --}}
            {{-- ========================================== --}}

            {{--
                GIỮ NGUYÊN:
                - route ticket.cancel.submit
                - $ticket->id
                - POST
                - @csrf
                - refund_bank_name
                - refund_account_number
                - refund_account_name

                KHÔNG THAY LOGIC HỦY VÉ.
            --}}

            <form
                action="{{ route('ticket.cancel.submit', $ticket->id) }}"
                method="POST"
                onsubmit="return confirm('Bạn chắc chắn muốn hủy vé này? Ghế sẽ được giải phóng ngay.');"
            >
                @csrf

                <div class="form-section">

                    <div class="form-section-header">

                        <h3 class="form-title">
                            Thông tin tài khoản nhận hoàn tiền
                        </h3>

                        <p class="form-description">
                            Nhập chính xác thông tin ngân hàng
                            để Admin xử lý yêu cầu hoàn tiền.
                        </p>

                    </div>

                    {{-- TÊN NGÂN HÀNG --}}

                    <div class="form-group">

                        <label for="refund_bank_name">
                            Tên ngân hàng
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="refund_bank_name"
                            name="refund_bank_name"
                            value="{{ old('refund_bank_name') }}"
                            placeholder="Ví dụ: Vietcombank, MB Bank, BIDV..."
                            maxlength="100"
                            autocomplete="off"
                            required
                        >

                        @error('refund_bank_name')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- SỐ TÀI KHOẢN --}}

                    <div class="form-group">

                        <label for="refund_account_number">
                            Số tài khoản ngân hàng
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="refund_account_number"
                            name="refund_account_number"
                            value="{{ old('refund_account_number') }}"
                            placeholder="Nhập số tài khoản nhận tiền"
                            maxlength="50"
                            inputmode="numeric"
                            autocomplete="off"
                            required
                        >

                        @error('refund_account_number')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- TÊN CHỦ TÀI KHOẢN --}}

                    <div class="form-group">

                        <label for="refund_account_name">
                            Tên chủ tài khoản
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="refund_account_name"
                            name="refund_account_name"
                            value="{{ old('refund_account_name') }}"
                            placeholder="Nhập đúng họ và tên chủ tài khoản"
                            maxlength="100"
                            autocomplete="off"
                            required
                        >

                        @error('refund_account_name')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- ====================================== --}}
                {{-- THÔNG BÁO QUY TRÌNH HOÀN TIỀN --}}
                {{-- ====================================== --}}

                <div class="notice">

                    <div class="notice-icon">
                        i
                    </div>

                    <div>
                        Sau khi gửi yêu cầu, vé sẽ chuyển sang
                        trạng thái <strong>Đã hủy</strong>.

                        Ghế sẽ được mở lại và thông tin hoàn tiền
                        được gửi đến Admin.

                        Trạng thái hoàn tiền sẽ hiển thị là
                        <strong>Chờ Admin xác nhận</strong>
                        cho đến khi được xử lý.
                    </div>

                </div>

                {{-- CẢNH BÁO --}}

                <div class="warning-box">

                    <div class="warning-title">
                        Lưu ý trước khi hủy vé
                    </div>

                    <p>
                        Việc hủy vé sẽ giải phóng ghế đang chọn.
                        Bạn nên kiểm tra chính xác mã vé
                        và tên hành khách trước khi tiếp tục.

                        Với đơn nhiều hành khách, thao tác này
                        chỉ áp dụng cho vé đang được hiển thị.
                    </p>

                </div>

                {{-- ====================================== --}}
                {{-- NÚT XÁC NHẬN --}}
                {{-- ====================================== --}}

                <div class="actions">

                    <a
                        href="{{ route('tickets.mine') }}"
                        class="btn btn-back"
                    >
                        Quay lại lịch sử vé
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

{{-- ===================================================== --}}
{{-- FOOTER --}}
{{-- ===================================================== --}}

<footer class="footer">

    <div class="footer-logo">
        Viet<span>jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>
</html>
