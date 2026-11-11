
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thanh toán đổi vé - Vietjet</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #003b70;
            --primary-dark: #00294f;
            --primary-light: #edf5fc;
            --secondary: #f4b400;
            --success: #198754;
            --danger: #dc3545;
            --background: #f3f6fa;
            --white: #ffffff;
            --text: #243746;
            --muted: #70808e;
            --border: #dfe6ed;
        }

        body {
            min-height: 100vh;
            background: var(--background);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        /* HEADER */

        .header {
            background: var(--primary-dark);
            color: white;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .10);
        }

        .header-inner {
            max-width: 1160px;
            margin: 0 auto;
            min-height: 76px;
            padding: 0 24px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 29px;
            font-weight: 800;
            color: white;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-note {
            font-size: 12px;
            color: #cbdce9;
        }

        .back {
            color: white;
            font-size: 13px;
            font-weight: 700;
            transition: color .2s;
        }

        .back:hover {
            color: var(--secondary);
        }

        /* BANNER */

        .page-banner {
            min-height: 228px;

            background:
                linear-gradient(
                    100deg,
                    rgba(0, 35, 67, .96),
                    rgba(0, 59, 112, .78)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');

            background-size: cover;
            background-position: center;
            color: white;
        }

        .banner-inner {
            max-width: 1160px;
            margin: auto;
            padding: 36px 24px 85px;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 9px;
            margin-bottom: 18px;
            font-size: 12px;
        }

        .breadcrumb a {
            color: #ffd35b;
        }

        .breadcrumb span {
            color: #d7e5ef;
        }

        .page-title {
            font-size: 33px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .page-description {
            color: #dce8f2;
            font-size: 13px;
            line-height: 1.7;
            max-width: 680px;
        }

        /* MAIN */

        .main {
            max-width: 1090px;
            margin: -51px auto 70px;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        /* STEPS */

        .steps-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;

            padding: 19px 24px;
            margin-bottom: 20px;

            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;

            box-shadow: 0 5px 23px rgba(20, 45, 65, .06);
        }

        .step {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .step-number {
            width: 32px;
            height: 32px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            background: #edf1f5;
            color: #7b8792;
            font-size: 12px;
            font-weight: 800;
        }

        .step.done .step-number {
            background: #e6f6ee;
            color: var(--success);
        }

        .step.active .step-number {
            background: var(--primary);
            color: white;
        }

        .step-text {
            font-size: 12px;
            font-weight: 700;
            color: #6e7b86;
        }

        .step.done .step-text,
        .step.active .step-text {
            color: var(--primary);
        }

        .step-line {
            width: 40px;
            height: 1px;
            background: #d5dfe6;
        }

        /* GENERAL CARD */

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;

            box-shadow: 0 7px 28px rgba(20, 45, 65, .065);
            margin-bottom: 21px;
        }

        .card-header {
            padding: 23px 26px 19px;
            border-bottom: 1px solid #edf0f3;
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .card-body {
            padding: 24px 26px;
        }

        /* PASSENGER SUMMARY */

        .passenger-strip {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr;
            gap: 15px;

            background: #f7fafc;
            padding: 18px 22px;
            border-bottom: 1px solid #e7edf2;
        }

        .strip-item {
            padding-right: 14px;
            border-right: 1px solid #e2e8ed;
        }

        .strip-item:last-child {
            border: none;
        }

        .strip-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .strip-value {
            display: block;
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        /* FLIGHT COMPARISON */

        .comparison {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 48px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
        }

        .flight-box {
            border: 1px solid #dce5ec;
            background: #f8fafc;
            border-radius: 10px;
            overflow: hidden;
            min-width: 0;
        }

        .flight-box.new {
            border-color: #ebce7a;
            background: #fffdf6;
        }

        .flight-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;

            padding: 13px 17px;
            background: #eef3f7;
            border-bottom: 1px solid #e1e9ef;
        }

        .flight-box.new .flight-heading {
            background: #fff4d6;
            border-bottom-color: #f0dfa6;
        }

        .box-label {
            color: #516675;
            font-size: 11px;
            font-weight: 800;
        }

        .flight-badge {
            padding: 5px 8px;
            border-radius: 5px;
            background: white;
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
        }

        .flight-content {
            padding: 20px 18px;
        }

        .flight-code {
            color: var(--primary);
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 17px;
        }

        .flight-route {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 42px minmax(0, 1fr);
            gap: 8px;
            align-items: center;
            margin-bottom: 17px;
        }

        .flight-airport:last-child {
            text-align: right;
        }

        .flight-city {
            font-size: 15px;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .flight-time {
            margin-top: 5px;
            color: #546777;
            font-size: 12px;
            font-weight: 700;
        }

        .mini-route {
            text-align: center;
            color: var(--primary);
            font-size: 20px;
        }

        .flight-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid #e4eaf0;
        }

        .flight-detail-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 5px;
        }

        .flight-detail-value {
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
        }

        .seat-tag {
            display: inline-block;
            background: #e9f3fa;
            border: 1px solid #c9dfea;
            color: var(--primary);
            border-radius: 5px;
            padding: 4px 9px;
        }

        .flight-box.new .seat-tag {
            background: #fff3d1;
            border-color: #e9d28c;
        }

        .comparison-arrow {
            width: 42px;
            height: 42px;
            background: #e9f1f8;
            border-radius: 50%;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
        }

        /* PRICING */

        .price-table {
            width: 100%;
            border-collapse: collapse;
        }

        .price-table td {
            padding: 15px 5px;
            border-bottom: 1px solid #edf0f3;
            font-size: 13px;
        }

        .price-table td:first-child {
            color: #526170;
        }

        .price-table td:last-child {
            color: #253b4b;
            text-align: right;
            font-weight: 800;
        }

        .price-table tr:last-child td {
            border-bottom: none;
        }

        .fee-highlight td {
            color: var(--primary) !important;
            font-weight: 800;
        }

        .total-box {
            margin-top: 15px;
            padding: 21px 22px;

            background: #fff8e5;
            border: 1px solid #eedb9d;
            border-left: 4px solid var(--secondary);
            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .total-label {
            color: #695720;
            font-size: 13px;
            font-weight: 800;
        }

        .total-description {
            color: #948258;
            font-size: 11px;
            margin-top: 4px;
        }

        .total-price {
            color: #b42318;
            font-size: 27px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* NOTICE */

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 13px;

            padding: 16px 19px;
            background: #eef6fc;
            border: 1px solid #cfe0ec;
            border-left: 4px solid var(--primary);
            border-radius: 9px;

            color: #3b596c;
            font-size: 12px;
            line-height: 1.8;

            margin-bottom: 20px;
        }

        .notice-icon {
            width: 25px;
            height: 25px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-size: 13px;
            font-weight: bold;
        }

        /* BANK PAYMENT */

        .payment-method-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .payment-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            border-radius: 9px;
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
        }

        .payment-method-title h3 {
            font-size: 17px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 3px;
        }

        .payment-method-title p {
            font-size: 11px;
            color: var(--muted);
        }

        .bank-payment-box {
            background: #f8fafc;
            border: 1px solid #e0e7ed;
            border-radius: 11px;
            padding: 24px;
        }

        .qr-layout {
            display: grid;
            grid-template-columns: 275px minmax(0, 1fr);
            align-items: start;
            gap: 27px;
        }

        .qr-box {
            text-align: center;
        }

        .qr-card {
            border: 1px solid #dce4eb;
            border-radius: 10px;
            background: white;
            padding: 12px;
        }

        .qr-title {
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .qr-box img {
            width: 100%;
            max-width: 240px;
            display: block;
            margin: auto;
            border-radius: 6px;
        }

        .qr-caption {
            margin-top: 11px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .transfer-info {
            background: white;
            border: 1px solid #dfe6ec;
            border-radius: 9px;
            padding: 5px 18px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 135px minmax(0, 1fr);
            gap: 12px;
            align-items: center;

            padding: 14px 0;
            border-bottom: 1px solid #edf0f3;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--muted);
            font-size: 11px;
        }

        .info-value {
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .info-value.amount {
            color: #b42318;
            font-size: 19px;
        }

        .info-value.transfer-content {
            color: var(--primary);
            letter-spacing: 0.5px;
        }

        /* PAYMENT SUMMARY */

        .payment-summary {
            margin-top: 17px;
            padding: 14px 16px;
            border-radius: 8px;
            background: #eaf4fb;
            border: 1px solid #cbdfea;
            color: #3b596c;
            font-size: 12px;
            line-height: 1.7;
        }

        /* ACTIONS */

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            border: none;
            border-radius: 7px;
            padding: 14px 22px;
            min-height: 46px;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            transition: .2s;
        }

        .btn-back {
            border: 1px solid #d5e0e8;
            background: white;
            color: var(--primary);
        }

        .btn-back:hover {
            background: #f2f6f9;
        }

        .btn-pay {
            background: var(--success);
            color: white;
            box-shadow: 0 5px 15px rgba(25, 135, 84, .14);
        }

        .btn-pay:hover {
            background: #146c43;
        }

        .btn-pay:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .confirmation-note {
            margin-top: 12px;
            color: #7a8793;
            font-size: 11px;
            line-height: 1.6;
            text-align: right;
        }

        /* FOOTER */

        .footer {
            background: #031d33;
            padding: 30px 20px;
            text-align: center;
            color: white;
            margin-top: 60px;
        }

        .footer-logo {
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .footer-logo span {
            color: var(--secondary);
        }

        .footer p {
            font-size: 12px;
            color: #aebdca;
        }

        /* RESPONSIVE */

        @media (max-width: 880px) {
            .qr-layout {
                grid-template-columns: 1fr;
            }

            .qr-box {
                max-width: 300px;
                margin: auto;
            }
        }

        @media (max-width: 760px) {
            .header-note {
                display: none;
            }

            .steps-card {
                gap: 8px;
                padding: 15px;
            }

            .step-line {
                width: 20px;
            }

            .step-text {
                font-size: 10px;
            }

            .comparison {
                grid-template-columns: 1fr;
            }

            .comparison-arrow {
                margin: auto;
                transform: rotate(90deg);
            }

            .passenger-strip {
                grid-template-columns: 1fr 1fr;
            }

            .strip-item:nth-child(2) {
                border: none;
            }

            .strip-item:last-child {
                grid-column: 1 / -1;
                padding-top: 12px;
                border-top: 1px solid #e2e8ed;
            }
        }

        @media (max-width: 560px) {
            .header-inner {
                padding: 0 16px;
            }

            .logo {
                font-size: 25px;
            }

            .back {
                font-size: 11px;
            }

            .page-title {
                font-size: 27px;
            }

            .main {
                padding: 0 12px;
            }

            .card-header,
            .card-body {
                padding: 19px 16px;
            }

            .steps-card {
                gap: 5px;
            }

            .step {
                justify-content: center;
            }

            .step-number {
                width: 28px;
                height: 28px;
            }

            .step-text {
                display: none;
            }

            .step-line {
                flex: 1;
                width: auto;
            }

            .flight-content {
                padding: 16px;
            }

            .bank-payment-box {
                padding: 15px;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 5px;
                padding: 11px 0;
            }

            .total-box {
                flex-direction: column;
                align-items: flex-start;
            }

            .total-price {
                font-size: 25px;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }

            .confirmation-note {
                text-align: center;
            }
        }
    </style>
</head>

<body>

@php
    /*
    |--------------------------------------------------------------------------
    | THÔNG TIN NGÂN HÀNG
    |--------------------------------------------------------------------------
    |
    | Giữ nguyên dữ liệu của file bạn gửi.
    | Không tự ý sửa số tài khoản hoặc chủ tài khoản.
    |
    */

    $bankCode = 'Vietcombank';
    $bankAccount = '1029213953';
    $bankOwner = 'NGUYEN MINH TRI';

    /*
    |--------------------------------------------------------------------------
    | NỘI DUNG CHUYỂN KHOẢN
    |--------------------------------------------------------------------------
    |
    | Giữ nguyên định dạng cũ để không ảnh hưởng
    | phần xử lý đổi vé.
    |
    */

    $transferContent = 'DOIVE' . $ticket->ticket_code;

    /*
    |--------------------------------------------------------------------------
    | MÃ VIETQR
    |--------------------------------------------------------------------------
    |
    | Số tiền truyền vào QR là VNĐ thật.
    | Không chia 1000 tại đây.
    |
    */

    $qrUrl =
        'https://img.vietqr.io/image/'
        . $bankCode
        . '-'
        . $bankAccount
        . '-compact2.png'
        . '?amount='
        . intval($amountToPay)
        . '&addInfo='
        . urlencode($transferContent)
        . '&accountName='
        . urlencode($bankOwner);

    /*
    |--------------------------------------------------------------------------
    | PHÍ ĐỔI VÉ
    |--------------------------------------------------------------------------
    |
    | Lấy từ dữ liệu mà BookingController truyền tới.
    | Không đặt cố định 100.000 hay 10.000 tại giao diện.
    |
    */

    $changeFee = max(
        0,
        (float) $amountToPay - (float) $fareDifference
    );
@endphp

{{-- ====================================================== --}}
{{-- HEADER --}}
{{-- ====================================================== --}}

<header class="header">

    <div class="header-inner">

        <a
            href="{{ route('trang-chu') }}"
            class="logo"
        >
            Viet<span>jet</span>
        </a>

        <div class="header-right">

            <span class="header-note">
                Dịch vụ đổi chuyến bay
            </span>

            <a
                href="{{ route('ticket.change.flight', $ticket->id) }}"
                class="back"
            >
                ← Quay lại
            </a>

        </div>

    </div>

</header>

{{-- ====================================================== --}}
{{-- BANNER --}}
{{-- ====================================================== --}}

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

            <a href="{{ route('ticket.change.flight', $ticket->id) }}">
                Đổi chuyến bay
            </a>

            <span>/</span>

            <span>
                Thanh toán đổi vé
            </span>

        </div>

        <h1 class="page-title">
            Thanh toán đổi vé
        </h1>

        <p class="page-description">
            Kiểm tra chuyến bay mới, số ghế và khoản phí đổi vé
            trước khi xác nhận hoàn tất thay đổi hành trình.
        </p>

    </div>

</section>

{{-- ====================================================== --}}
{{-- MAIN --}}
{{-- ====================================================== --}}

<main class="main">

    {{-- ================================================== --}}
    {{-- TIẾN TRÌNH ĐỔI VÉ --}}
    {{-- ================================================== --}}

    <div class="steps-card">

        <div class="step done">
            <span class="step-number">✓</span>
            <span class="step-text">
                Chọn chuyến
            </span>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <span class="step-number">✓</span>
            <span class="step-text">
                Chọn ghế
            </span>
        </div>

        <div class="step-line"></div>

        <div class="step active">
            <span class="step-number">3</span>
            <span class="step-text">
                Thanh toán
            </span>
        </div>

    </div>

    {{-- ================================================== --}}
    {{-- THÔNG BÁO LỖI --}}
    {{-- ================================================== --}}

    @if(session('error'))

        <div class="notice" style="background:#fff1f2;border-color:#f1bdc5;border-left-color:#dc3545;color:#a02d39;">
            <div class="notice-icon" style="background:#dc3545;">
                !
            </div>

            <div>
                {{ session('error') }}
            </div>
        </div>

    @endif

    @if($errors->any())

        <div class="notice" style="background:#fff1f2;border-color:#f1bdc5;border-left-color:#dc3545;color:#a02d39;">
            <div class="notice-icon" style="background:#dc3545;">
                !
            </div>

            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>

    @endif

    {{-- ================================================== --}}
    {{-- THÔNG TIN CHUYẾN BAY --}}
    {{-- ================================================== --}}

    <section class="card">

        <div class="card-header">

            <h2>
                Thay đổi hành trình
            </h2>

            <p>
                Chuyến bay hiện tại và chuyến bay mới bạn đã chọn.
            </p>

        </div>

        {{-- THÔNG TIN HÀNH KHÁCH --}}

        <div class="passenger-strip">

            <div class="strip-item">

                <span class="strip-label">
                    Hành khách
                </span>

                <span class="strip-value">
                    {{ $ticket->passenger_name }}
                </span>

            </div>

            <div class="strip-item">

                <span class="strip-label">
                    Mã vé
                </span>

                <span class="strip-value">
                    {{ $ticket->ticket_code }}
                </span>

            </div>

            <div class="strip-item">

                <span class="strip-label">
                    Hạng ghế hiện tại
                </span>

                <span class="strip-value">
                    {{ $ticket->seat_class === 'vip' ? 'VIP' : 'Phổ thông' }}
                </span>

            </div>

        </div>

        <div class="card-body">

            <div class="comparison">

                {{-- ====================================== --}}
                {{-- CHUYẾN BAY HIỆN TẠI --}}
                {{-- ====================================== --}}

                <div class="flight-box">

                    <div class="flight-heading">

                        <span class="box-label">
                            CHUYẾN BAY HIỆN TẠI
                        </span>

                        <span class="flight-badge">
                            Đang sử dụng
                        </span>

                    </div>

                    <div class="flight-content">

                        <div class="flight-code">
                            {{ $ticket->flight->flight_code }}
                        </div>

                        <div class="flight-route">

                            <div class="flight-airport">

                                <div class="flight-city">
                                    {{ $ticket->flight->departureAirport->city }}
                                </div>

                                <div class="flight-time">
                                    {{ substr($ticket->flight->departure_time, 0, 5) }}
                                </div>

                            </div>

                            <div class="mini-route">
                                ✈
                            </div>

                            <div class="flight-airport">

                                <div class="flight-city">
                                    {{ $ticket->flight->arrivalAirport->city }}
                                </div>

                                <div class="flight-time">
                                    {{ substr($ticket->flight->arrival_time, 0, 5) }}
                                </div>

                            </div>

                        </div>

                        <div class="flight-bottom">

                            <div>
                                <span class="flight-detail-label">
                                    Ngày bay
                                </span>

                                <span class="flight-detail-value">
                                    {{ $ticket->flight->flight_date->format('d/m/Y') }}
                                </span>
                            </div>

                            <div>
                                <span class="flight-detail-label">
                                    Số ghế
                                </span>

                                <span class="flight-detail-value seat-tag">
                                    {{ $ticket->flightSeat->seat_number }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- MŨI TÊN CHUYỂN ĐỔI --}}

                <div class="comparison-arrow">
                    →
                </div>

                {{-- ====================================== --}}
                {{-- CHUYẾN BAY MỚI --}}
                {{-- ====================================== --}}

                <div class="flight-box new">

                    <div class="flight-heading">

                        <span class="box-label">
                            CHUYẾN BAY MỚI
                        </span>

                        <span class="flight-badge">
                            Đã chọn
                        </span>

                    </div>

                    <div class="flight-content">

                        <div class="flight-code">
                            {{ $flight->flight_code }}
                        </div>

                        <div class="flight-route">

                            <div class="flight-airport">

                                <div class="flight-city">
                                    {{ $flight->departureAirport->city }}
                                </div>

                                <div class="flight-time">
                                    {{ substr($flight->departure_time, 0, 5) }}
                                </div>

                            </div>

                            <div class="mini-route">
                                ✈
                            </div>

                            <div class="flight-airport">

                                <div class="flight-city">
                                    {{ $flight->arrivalAirport->city }}
                                </div>

                                <div class="flight-time">
                                    {{ substr($flight->arrival_time, 0, 5) }}
                                </div>

                            </div>

                        </div>

                        <div class="flight-bottom">

                            <div>
                                <span class="flight-detail-label">
                                    Ngày bay
                                </span>

                                <span class="flight-detail-value">
                                    {{ $flight->flight_date->format('d/m/Y') }}
                                </span>
                            </div>

                            <div>
                                <span class="flight-detail-label">
                                    Số ghế mới
                                </span>

                                <span class="flight-detail-value seat-tag">
                                    {{ $seat->seat_number }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- ================================================== --}}
    {{-- CHI TIẾT PHÍ ĐỔI VÉ --}}
    {{-- ================================================== --}}

    <section class="card">

        <div class="card-header">

            <h2>
                Chi tiết thanh toán
            </h2>

            <p>
                Khoản phí phát sinh được tính theo chuyến bay mới
                và phí đổi vé do hệ thống áp dụng.
            </p>

        </div>

        <div class="card-body">

            <table class="price-table">

                <tr>
                    <td>
                        Giá vé hiện tại
                    </td>

                    <td>
                        {{ number_format($ticket->price, 0, ',', '.') }} đ
                    </td>
                </tr>

                <tr>
                    <td>
                        Giá vé chuyến mới
                    </td>

                    <td>
                        {{ number_format($newPrice, 0, ',', '.') }} đ
                    </td>
                </tr>

                <tr>
                    <td>
                        Chênh lệch giá vé cần trả
                    </td>

                    <td>
                        {{ number_format($fareDifference, 0, ',', '.') }} đ
                    </td>
                </tr>

                <tr class="fee-highlight">
                    <td>
                        Phí đổi vé
                    </td>

                    <td>
                        {{ number_format($changeFee, 0, ',', '.') }} đ
                    </td>
                </tr>

            </table>

            <div class="total-box">

                <div>

                    <div class="total-label">
                        Tổng tiền cần thanh toán thêm
                    </div>

                    <div class="total-description">
                        Bao gồm chênh lệch giá vé và phí đổi chuyến
                    </div>

                </div>

                <div class="total-price">
                    {{ number_format($amountToPay, 0, ',', '.') }} đ
                </div>

            </div>

        </div>

    </section>

    {{-- ================================================== --}}
    {{-- THÔNG BÁO GIỮ GHẾ --}}
    {{-- ================================================== --}}

    <div class="notice">

        <div class="notice-icon">
            i
        </div>

        <div>
            <strong>
                Thông tin quan trọng
            </strong>

            <p>
                Vé và ghế hiện tại vẫn được giữ nguyên trong quá trình
                chọn chuyến và thanh toán đổi vé.

                Hệ thống chỉ cập nhật chuyến bay mới và giải phóng
                ghế cũ sau khi bước xác nhận đổi vé được thực hiện.
            </p>
        </div>

    </div>

    {{-- ================================================== --}}
    {{-- THANH TOÁN VIETQR --}}
    {{-- ================================================== --}}

    <section class="card">

        <div class="card-header">

            <h2>
                Thanh toán bằng QR ngân hàng
            </h2>

            <p>
                Sử dụng ứng dụng ngân hàng hỗ trợ VietQR
                để chuyển khoản phí đổi vé.
            </p>

        </div>

        <div class="card-body">

            <div class="payment-method-title">

                <div class="payment-icon">
                    QR
                </div>

                <div>

                    <h3>
                        Chuyển khoản ngân hàng
                    </h3>

                    <p>
                        Quét mã QR hoặc chuyển khoản theo thông tin bên dưới.
                    </p>

                </div>

            </div>

            <div class="bank-payment-box">

                <div class="qr-layout">

                    {{-- ================================== --}}
                    {{-- MÃ VIETQR --}}
                    {{-- ================================== --}}

                    <div class="qr-box">

                        <div class="qr-card">

                            <div class="qr-title">
                                Mã VietQR thanh toán đổi vé
                            </div>

                            <img
                                src="{{ $qrUrl }}"
                                alt="Mã VietQR thanh toán đổi vé"
                            >

                        </div>

                        <div class="qr-caption">
                            Mở ứng dụng ngân hàng và quét mã QR.
                        </div>

                    </div>

                    {{-- ================================== --}}
                    {{-- THÔNG TIN CHUYỂN KHOẢN --}}
                    {{-- ================================== --}}

                    <div>

                        <div class="transfer-info">

                            <div class="info-row">

                                <div class="info-label">
                                    Ngân hàng
                                </div>

                                <div class="info-value">
                                    MB Bank
                                </div>

                            </div>

                            <div class="info-row">

                                <div class="info-label">
                                    Số tài khoản
                                </div>

                                <div class="info-value">
                                    {{ $bankAccount }}
                                </div>

                            </div>

                            <div class="info-row">

                                <div class="info-label">
                                    Chủ tài khoản
                                </div>

                                <div class="info-value">
                                    {{ $bankOwner }}
                                </div>

                            </div>

                            <div class="info-row">

                                <div class="info-label">
                                    Số tiền
                                </div>

                                <div class="info-value amount">
                                    {{ number_format($amountToPay, 0, ',', '.') }} đ
                                </div>

                            </div>

                            <div class="info-row">

                                <div class="info-label">
                                    Đơn vị
                                </div>

                                <div class="info-value">
                                    Nghìn đồng (hiển thị quy đổi:
                                    {{ number_format($amountToPay / 1000, 0, ',', '.') }})
                                </div>

                            </div>

                            <div class="info-row">

                                <div class="info-label">
                                    Nội dung chuyển khoản
                                </div>

                                <div class="info-value transfer-content">
                                    {{ $transferContent }}
                                </div>

                            </div>

                        </div>

                        <div class="payment-summary">
                            <strong>
                                Lưu ý:
                            </strong>

                            Vui lòng kiểm tra số tiền và nội dung chuyển khoản
                            trong ứng dụng ngân hàng trước khi thực hiện.
                        </div>

                    </div>

                </div>

            </div>

            {{-- ============================================ --}}
            {{-- FORM XÁC NHẬN ĐỔI VÉ --}}
            {{-- ============================================ --}}
            {{--
                GIỮ NGUYÊN:
                - route ticket.change.pay
                - ID vé đang đổi
                - method POST
                - @csrf
                - nút xác nhận
            --}}

            <form
                action="{{ route('ticket.change.pay', $ticket->id) }}"
                method="POST"
                onsubmit="return confirm('Bạn xác nhận đã thanh toán phí đổi vé?')"
            >
                @csrf

                <div class="actions">

                    <a
                        href="{{ route('ticket.change.flight', $ticket->id) }}"
                        class="btn btn-back"
                    >
                        ← Quay lại chọn chuyến
                    </a>

                    <button
                        type="submit"
                        class="btn btn-pay"
                    >
                        Tôi đã thanh toán
                    </button>

                </div>

                <p class="confirmation-note">
                    Hãy kiểm tra kỹ thông tin giao dịch trước khi xác nhận.
                </p>

            </form>

        </div>

    </section>

</main>

{{-- ====================================================== --}}
{{-- FOOTER --}}
{{-- ====================================================== --}}

<footer class="footer">

    <div class="footer-logo">
        Viet<span>jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp chức năng đổi chuyến bay.
    </p>

</footer>

</body>
</html>
