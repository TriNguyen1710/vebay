
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Thanh toán - Vietjet</title>

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
            --success: #198754;
            --white: #ffffff;
            --light: #f4f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dfe6ed;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        button,
        input {
            font-family: inherit;
        }

        .top-bar {
            background: var(--primary-dark);
            color: white;
            font-size: 13px;
        }

        .top-bar-inner {
            max-width: 1240px;
            min-height: 36px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a {
            color: white;
            opacity: .9;
        }

        .header {
            background: white;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
        }

        .navbar {
            max-width: 1240px;
            min-height: 76px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo {
            color: var(--primary);
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .nav-menu {
            display: flex;
            align-items: center;
        }

        .nav-link {
            padding: 27px 15px;
            color: #293241;
            font-size: 15px;
            font-weight: 600;
            border-bottom: 3px solid transparent;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
            border-bottom-color: var(--secondary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-name {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .logout-btn {
            border: none;
            background: var(--danger);
            color: white;
            padding: 9px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .page-banner {
            min-height: 225px;
            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, .94),
                    rgba(0, 59, 112, .53)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .banner-inner {
            max-width: 1240px;
            margin: auto;
            padding: 47px 20px 82px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 17px;
            font-size: 13px;
        }

        .breadcrumb a {
            color: #ffd356;
        }

        .breadcrumb span {
            color: #e5ebf0;
        }

        .page-banner h1 {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .page-banner p {
            color: #e3ebf3;
            font-size: 15px;
            line-height: 1.6;
            max-width: 650px;
        }

        .main {
            max-width: 1100px;
            margin: -48px auto 70px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 22px;
        }

        .step {
            display: flex;
            align-items: center;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dce3e9;
            color: #66717b;
            font-size: 12px;
            font-weight: bold;
        }

        .step.done .step-number {
            background: #176a53;
            color: white;
        }

        .step.active .step-number {
            background: var(--primary);
            color: white;
        }

        .step-text {
            margin-left: 7px;
            color: #737d86;
            font-size: 11px;
            font-weight: bold;
        }

        .step.active .step-text {
            color: var(--primary);
        }

        .step-line {
            width: 45px;
            height: 1px;
            margin: 0 10px;
            background: #ccd4db;
        }

        .alert-error,
        .alert-success {
            padding: 13px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-error {
            background: #fdebed;
            border: 1px solid #efbec4;
            color: #842029;
        }

        .alert-success {
            background: #edf8f2;
            border: 1px solid #badfc9;
            color: #17643d;
        }

        .payment-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 340px;
            gap: 22px;
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 7px 28px rgba(0, 0, 0, .08);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .card-header {
            padding: 22px 24px 18px;
            border-bottom: 1px solid #e8edf1;
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 5px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .card-body {
            padding: 22px 24px;
        }

        .booking-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .booking-code-label {
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 5px;
        }

        .booking-code {
            color: var(--primary);
            font-size: 21px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .trip-badge {
            background: var(--primary);
            color: white;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 800;
        }

        .booking-status {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        .status-box {
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #e4e9ee;
            border-radius: 7px;
        }

        .status-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 5px;
        }

        .status-value {
            color: #344657;
            font-size: 12px;
            font-weight: bold;
        }

        .status-value.unpaid {
            color: var(--danger);
        }

        .ticket {
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .ticket:last-child {
            margin-bottom: 0;
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid #edf0f3;
        }

        .ticket-code {
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        .direction {
            min-width: 38px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 8px;
            border-radius: 5px;
            background: var(--primary);
            color: white;
            font-size: 9px;
            font-weight: 800;
        }

        .direction.return {
            background: #176a53;
        }

        .route-display {
            display: grid;
            grid-template-columns: 1fr 90px 1fr;
            align-items: center;
            gap: 12px;
            padding: 14px;
            margin-bottom: 15px;
            background: #f8fafc;
            border: 1px solid #e4e9ee;
            border-radius: 7px;
        }

        .airport:last-child {
            text-align: right;
        }

        .airport-city {
            display: block;
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .airport-time {
            color: #64717c;
            font-size: 11px;
        }

        .route-line {
            text-align: center;
        }

        .line {
            height: 2px;
            background: #c9d3dc;
            margin-bottom: 5px;
        }

        .route-line span {
            color: #8a949d;
            font-size: 9px;
        }

        .ticket-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
        }

        .ticket-info {
            padding: 11px;
            border: 1px solid #e5eaee;
            border-radius: 6px;
        }

        .ticket-label {
            display: block;
            color: var(--muted);
            font-size: 9px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .ticket-value {
            display: block;
            color: #344657;
            font-size: 12px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .vip {
            color: #8a6700;
        }

        .economy {
            color: var(--primary);
        }

        .price {
            color: #b42318;
        }

        .summary-card {
            position: sticky;
            top: 20px;
        }

        .summary-header {
            padding: 22px 23px;
            background: var(--primary);
            color: white;
        }

        .summary-header h2 {
            font-size: 19px;
            margin-bottom: 5px;
        }

        .summary-header p {
            color: #d8e5ef;
            font-size: 11px;
        }

        .summary-body {
            padding: 22px 23px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #edf0f3;
        }

        .summary-row span {
            color: var(--muted);
            font-size: 11px;
        }

        .summary-row strong {
            color: #344657;
            font-size: 11px;
            text-align: right;
        }

        .total-box {
            margin-top: 18px;
            padding: 17px;
            background: #fff9e8;
            border: 1px solid #ead795;
            border-left: 4px solid var(--secondary);
            border-radius: 6px;
        }

        .total-label {
            display: block;
            color: #665723;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .total {
            color: #b42318;
            font-size: 25px;
            font-weight: 800;
        }

        /*
         * CHỈ GIỮ PHƯƠNG THỨC QR NGÂN HÀNG.
         */
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .payment-option {
            border: 2px solid var(--primary);
            border-radius: 9px;
            padding: 18px;
            background: #f5faff;
        }

        .method-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            border-radius: 7px;
            background: #edf5fb;
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
        }

        .payment-title {
            display: block;
            color: #273847;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .payment-option p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.5;
        }

        .payment-content {
            display: block;
            margin-top: 20px;
            border-top: 1px solid #e8edf1;
            padding-top: 22px;
        }

        .payment-box {
            background: #f8fafc;
            border: 1px solid #e0e6eb;
            border-radius: 9px;
            padding: 22px;
        }

        .payment-box-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .payment-box-header h3 {
            color: var(--primary);
            font-size: 17px;
            margin-bottom: 5px;
        }

        .payment-box-header p {
            color: var(--muted);
            font-size: 11px;
        }

        .qr-layout {
            display: grid;
            grid-template-columns: 270px minmax(0, 1fr);
            gap: 25px;
            align-items: center;
        }

        .qr-wrapper {
            text-align: center;
        }

        .qr-image {
            width: 245px;
            max-width: 100%;
            background: white;
            border: 1px solid #dce3e8;
            border-radius: 8px;
            padding: 8px;
        }

        .qr-caption {
            margin-top: 8px;
            color: var(--muted);
            font-size: 10px;
        }

        .bank-info {
            background: white;
            border: 1px solid #e0e6eb;
            border-radius: 7px;
            padding: 4px 16px;
        }

        .bank-row {
            display: grid;
            grid-template-columns: 135px minmax(0, 1fr);
            gap: 10px;
            padding: 11px 0;
            border-bottom: 1px solid #edf0f3;
        }

        .bank-row:last-child {
            border-bottom: none;
        }

        .bank-row strong {
            color: var(--muted);
            font-size: 10px;
            font-weight: normal;
        }

        .copy-value {
            color: #273847;
            font-size: 12px;
            font-weight: bold;
            word-break: break-word;
        }

        .bank-row .price {
            font-size: 13px;
            font-weight: 800;
        }

        .note {
            margin-top: 16px;
            padding: 12px 14px;
            background: #edf5fb;
            border-left: 3px solid var(--primary);
            color: #506472;
            font-size: 11px;
            line-height: 1.6;
        }

        .warning {
            margin-top: 20px;
            padding: 13px 15px;
            background: #fff9e8;
            border: 1px solid #ead795;
            border-left: 4px solid var(--secondary);
            color: #70622f;
            font-size: 11px;
            line-height: 1.6;
        }

        .pay-button {
            width: 100%;
            margin-top: 18px;
            padding: 14px 18px;
            border: none;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .pay-button:hover {
            background: var(--primary-dark);
        }

        .bottom-actions {
            margin-top: 5px;
        }

        .back-button {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        footer {
            background: #031d33;
            color: white;
            padding: 35px 20px;
            text-align: center;
        }

        .footer-logo {
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .footer-logo span {
            color: var(--secondary);
        }

        footer p {
            color: #aebdca;
            font-size: 13px;
        }

        @media (max-width: 950px) {
            .nav-menu {
                display: none;
            }

            .payment-layout {
                grid-template-columns: 1fr;
            }

            .summary-card {
                position: static;
            }
        }

        @media (max-width: 750px) {
            .top-bar {
                display: none;
            }

            .steps {
                display: none;
            }

            .page-banner h1 {
                font-size: 29px;
            }

            .ticket-grid {
                grid-template-columns: 1fr 1fr;
            }

            .qr-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .booking-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .booking-status,
            .route-display,
            .ticket-grid {
                grid-template-columns: 1fr;
            }

            .route-line {
                display: none;
            }

            .airport:last-child {
                text-align: left;
            }

            .bank-row {
                grid-template-columns: 1fr;
                gap: 4px;
            }
        }
    </style>
</head>

<body>

@php
    /*
    |--------------------------------------------------------------------------
    | THÔNG TIN NGÂN HÀNG — GIỮ NGUYÊN
    |--------------------------------------------------------------------------
    */
    $bankCode = 'Vietcombank';
    $bankAccount = '1029213953';
    $bankOwner = 'NGUYEN MINH TRI';

    /*
    |--------------------------------------------------------------------------
    | KIỂM TRA HÀNH TRÌNH — GIỮ NGUYÊN
    |--------------------------------------------------------------------------
    */
    $directions = $booking->tickets
        ->map(function ($ticket) {
            return
                $ticket->flight->departure_airport_id
                . ':'
                . $ticket->flight->arrival_airport_id;
        })
        ->unique();

    $isRoundTrip = $directions->count() > 1
        && $booking->tickets->contains(
            function ($ticket) use ($directions) {
                $reverseDirection =
                    $ticket->flight->arrival_airport_id
                    . ':'
                    . $ticket->flight->departure_airport_id;

                return $directions->contains(
                    $reverseDirection
                );
            }
        );

    /*
    |--------------------------------------------------------------------------
    | NỘI DUNG CHUYỂN KHOẢN — GIỮ NGUYÊN
    |--------------------------------------------------------------------------
    */
    $transferContent =
        'VJ ' . $booking->booking_code;

    /*
    |--------------------------------------------------------------------------
    | VIETQR — TUYỆT ĐỐI KHÔNG CHIA 1000
    |--------------------------------------------------------------------------
    |
    | VietQR luôn sử dụng tiền VNĐ thật.
    | Ví dụ:
    |
    | CSDL:       20000
    | VietQR:     20000 VNĐ
    | Giao diện:  20 nghìn đồng
    |
    */
    $vietQrUrl =
        'https://img.vietqr.io/image/'
        . $bankCode
        . '-'
        . $bankAccount
        . '-compact2.png'
        . '?amount='
        . (int) $booking->total_amount
        . '&addInfo='
        . urlencode($transferContent)
        . '&accountName='
        . urlencode($bankOwner);

    /*
    |--------------------------------------------------------------------------
    | GIÁ GỐC — GIỮ NGUYÊN VNĐ
    |--------------------------------------------------------------------------
    */
    $totalTicketPrice =
        (float) $booking->tickets->sum('price');

    $totalBaggagePrice =
        (float) $booking->tickets->sum(
            'baggage_price'
        );

    $carryOn =
        \App\Models\BaggagePackage::where(
            'type',
            'carry_on'
        )
        ->where('status', true)
        ->first();

    /*
    |--------------------------------------------------------------------------
    | THÔNG TIN HÀNH KHÁCH — GIỮ NGUYÊN
    |--------------------------------------------------------------------------
    */
    $passengerGroups = $booking->tickets->groupBy(
        function ($ticket) {
            return implode('|', [
                $ticket->passenger_name,
                (string) $ticket->date_of_birth,
                $ticket->identity_number,
                $ticket->email,
            ]);
        }
    );

    $passengerCount = $passengerGroups->count();

    /*
    |--------------------------------------------------------------------------
    | PHẦN MỚI: CHỈ ĐỊNH DẠNG HIỂN THỊ NGHÌN ĐỒNG
    |--------------------------------------------------------------------------
    |
    | Hàm này KHÔNG thay đổi giá trị CSDL,
    | KHÔNG thay đổi VietQR,
    | KHÔNG thay đổi dữ liệu đưa vào OCR.
    |
    | Ví dụ:
    |   5000    => 5
    |   10000   => 10
    |   20000   => 20
    |   5500    => 5,5
    |   1250000 => 1.250
    |
    */
    $formatThousands = function ($amount) {
        $value = number_format(
            ((float) $amount) / 1000,
            3,
            ',',
            '.'
        );

        return rtrim(
            rtrim($value, '0'),
            ','
        );
    };
@endphp

{{-- ===================================================== --}}
{{-- TOP BAR --}}
{{-- ===================================================== --}}

<div class="top-bar">
    <div class="top-bar-inner">

        <div class="top-group">
            <span>
                Website đặt vé máy bay trực tuyến
            </span>

            <span>
                Hỗ trợ: 1900 6868
            </span>
        </div>

        <div class="top-group">
            @auth
                <a href="{{ route('profile.edit') }}">
                    Thông tin cá nhân
                </a>

                <a href="{{ route('notifications.index') }}">
                    Thông báo
                </a>
            @endauth
        </div>

    </div>
</div>

{{-- ===================================================== --}}
{{-- HEADER --}}
{{-- ===================================================== --}}

<header class="header">

    <nav class="navbar">

        <a
            href="{{ route('trang-chu') }}"
            class="logo"
        >
            Viet<span>jet</span>
        </a>

        <div class="nav-menu">

            <a
                href="{{ route('trang-chu') }}"
                class="nav-link"
            >
                Trang chủ
            </a>

            <a
                href="{{ route('flights.search.form') }}"
                class="nav-link active"
            >
                Đặt vé
            </a>

            @auth
                <a
                    href="{{ route('tickets.mine') }}"
                    class="nav-link"
                >
                    Lịch sử vé
                </a>

                <a
                    href="{{ route('notifications.index') }}"
                    class="nav-link"
                >
                    Thông báo
                </a>
            @endauth

            <a
                href="{{ route('contact') }}"
                class="nav-link"
            >
                Liên hệ
            </a>

        </div>

        <div class="nav-actions">

            @auth
                <span class="user-name">
                    {{ auth()->user()->name }}
                </span>

                <form
                    action="{{ route('dang-xuat') }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="logout-btn"
                    >
                        Đăng xuất
                    </button>
                </form>
            @endauth

        </div>

    </nav>

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

            <span>
                Thanh toán
            </span>

        </div>

        <h1>
            Thanh toán vé máy bay
        </h1>

        <p>
            Thanh toán bằng VietQR và tải ảnh hóa đơn
            để hệ thống tự động kiểm tra giao dịch.
        </p>

    </div>

</section>

{{-- ===================================================== --}}
{{-- MAIN --}}
{{-- ===================================================== --}}

<main class="main">

    {{-- CÁC BƯỚC ĐẶT VÉ --}}

    <div class="steps">

        <div class="step done">
            <div class="step-number">1</div>
            <div class="step-text">Chọn chuyến</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">2</div>
            <div class="step-text">Chọn ghế</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">3</div>
            <div class="step-text">Hành khách</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">4</div>
            <div class="step-text">Hành lý</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">5</div>
            <div class="step-text">Khuôn mặt</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">6</div>
            <div class="step-text">Xác nhận</div>
        </div>

        <div class="step-line"></div>

        <div class="step active">
            <div class="step-number">7</div>
            <div class="step-text">Thanh toán</div>
        </div>

    </div>

    {{-- THÔNG BÁO THÀNH CÔNG --}}

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- THÔNG BÁO LỖI --}}

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    {{--
    |--------------------------------------------------------------------------
    | GIỮ NGUYÊN PHẦN KẾT QUẢ ĐỌC HÓA ĐƠN OCR
    |--------------------------------------------------------------------------
    |
    | KHÔNG XÓA.
    | KHÔNG SỬA.
    |
    --}}

    @include(
        'user.partials.ket-qua-hoa-don',
        ['receiptCheck' => session('receipt_check')]
    )

    <div class="payment-layout">

        {{-- ================================================= --}}
        {{-- CỘT TRÁI --}}
        {{-- ================================================= --}}

        <div>

            {{-- ============================================= --}}
            {{-- THÔNG TIN ĐẶT VÉ --}}
            {{-- ============================================= --}}

            <section class="card">

                <div class="card-header">
                    <h2>
                        Thông tin đặt vé
                    </h2>

                    <p>
                        Mã đặt chỗ và trạng thái hiện tại của đơn.
                    </p>
                </div>

                <div class="card-body">

                    <div class="booking-top">

                        <div>
                            <div class="booking-code-label">
                                Mã đặt vé
                            </div>

                            <div class="booking-code">
                                {{ $booking->booking_code }}
                            </div>
                        </div>

                        <div class="trip-badge">
                            {{ $isRoundTrip ? 'KHỨ HỒI' : 'MỘT CHIỀU' }}
                        </div>

                    </div>

                    <div class="booking-status">

                        <div class="status-box">

                            <span class="status-label">
                                Trạng thái đặt vé
                            </span>

                            <span class="status-value">

                                @if($booking->payment_status === 'paid')

                                    @if($booking->booking_status === 'confirmed')
                                        Đã xác nhận
                                    @else
                                        Chờ Admin xác nhận
                                    @endif

                                @elseif($booking->payment_status === 'waiting_confirmation')

                                    Chờ Admin xác nhận

                                @else

                                    Chờ thanh toán

                                @endif

                            </span>

                        </div>

                        <div class="status-box">

                            <span class="status-label">
                                Trạng thái thanh toán
                            </span>

                            <span class="status-value {{ $booking->payment_status === 'paid' ? '' : 'unpaid' }}">

                                @if($booking->payment_status === 'paid')

                                    Đã thanh toán

                                @elseif($booking->payment_status === 'waiting_confirmation')

                                    Chờ xác nhận thanh toán

                                @else

                                    Chưa thanh toán

                                @endif

                            </span>

                        </div>

                    </div>

                </div>

            </section>

            {{-- ============================================= --}}
            {{-- THÔNG TIN VÉ --}}
            {{-- ============================================= --}}

            <section class="card">

                <div class="card-header">

                    <h2>
                        Thông tin vé
                    </h2>

                    <p>
                        Kiểm tra chuyến bay, hành khách và số ghế
                        trước khi thanh toán.
                    </p>

                </div>

                <div class="card-body">

                    @foreach($booking->tickets as $index => $ticket)

                        @php
                            $ticketIsReturn = $isRoundTrip
                                && $ticket->flight->departure_airport_id
                                    !== $booking->tickets->first()
                                        ->flight->departure_airport_id;
                        @endphp

                        <div class="ticket">

                            <div class="ticket-header">

                                <div>
                                    <span class="ticket-label">
                                        Mã vé
                                    </span>

                                    <div class="ticket-code">
                                        {{ $ticket->ticket_code }}
                                    </div>
                                </div>

                                @if($isRoundTrip)

                                    <div class="direction {{ $ticketIsReturn ? 'return' : '' }}">

                                        {{ $ticketIsReturn ? 'VỀ' : 'ĐI' }}

                                    </div>

                                @endif

                            </div>

                            <div class="route-display">

                                <div class="airport">

                                    <span class="airport-city">
                                        {{ $ticket->flight->departureAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($ticket->flight->departure_time, 0, 5) }}
                                    </span>

                                </div>

                                <div class="route-line">
                                    <div class="line"></div>
                                    <span>Bay thẳng</span>
                                </div>

                                <div class="airport">

                                    <span class="airport-city">
                                        {{ $ticket->flight->arrivalAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($ticket->flight->arrival_time, 0, 5) }}
                                    </span>

                                </div>

                            </div>

                            <div class="ticket-grid">

                                {{-- HÀNH KHÁCH --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Hành khách
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->passenger_name }}
                                    </span>

                                </div>

                                {{-- CHUYẾN BAY --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Chuyến bay
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->flight->flight_code }}
                                    </span>

                                </div>

                                {{-- NGÀY BAY --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Ngày bay
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->flight->flight_date->format('d/m/Y') }}
                                    </span>

                                </div>

                                {{-- GHẾ --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Ghế
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->flightSeat->seat_number }}
                                    </span>

                                </div>

                                {{-- HẠNG GHẾ --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Hạng ghế
                                    </span>

                                    <span class="ticket-value {{ $ticket->seat_class === 'vip' ? 'vip' : 'economy' }}">

                                        {{ $ticket->seat_class === 'vip' ? 'VIP' : 'Phổ thông' }}

                                    </span>

                                </div>

                                {{--
                                | GIÁ VÉ:
                                | Chỉ chia 1000 khi HIỂN THỊ.
                                --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Giá vé
                                    </span>

                                    <span class="ticket-value price">
                                        {{ $formatThousands($ticket->price) }}
                                        nghìn đồng
                                    </span>

                                </div>

                                {{-- HÀNH LÝ KÝ GỬI --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Hành lý ký gửi
                                    </span>

                                    <span class="ticket-value">

                                        @if((int) $ticket->baggage_weight > 0)

                                            {{ (int) $ticket->baggage_weight }} kg

                                        @else

                                            Không mua thêm

                                        @endif

                                    </span>

                                </div>

                                {{--
                                | PHÍ HÀNH LÝ:
                                | Chỉ chia 1000 khi HIỂN THỊ.
                                --}}

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Phí hành lý
                                    </span>

                                    <span class="ticket-value price">
                                        {{ $formatThousands($ticket->baggage_price) }}
                                        nghìn đồng
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>

            {{-- ============================================= --}}
            {{-- THÔNG TIN HÀNH KHÁCH --}}
            {{-- ============================================= --}}

            <section class="card">

                <div class="card-header">

                    <h2>
                        Thông tin hành khách
                    </h2>

                    <p>
                        Hiển thị thông tin cuối cùng của từng
                        hành khách đã được lưu vào đơn đặt vé.
                    </p>

                </div>

                <div class="card-body">

                    @foreach($passengerGroups as $personTickets)

                        @php
                            $person = $personTickets->first();
                        @endphp

                        <div class="ticket">

                            <div class="ticket-header">

                                <div>

                                    <span class="ticket-label">
                                        Hành khách {{ $loop->iteration }}
                                    </span>

                                    <div class="ticket-code">
                                        {{ $person->passenger_name }}
                                    </div>

                                </div>

                            </div>

                            <div class="ticket-grid">

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Họ và tên
                                    </span>

                                    <span class="ticket-value">
                                        {{ $person->passenger_name }}
                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Ngày sinh
                                    </span>

                                    <span class="ticket-value">

                                        @if($person->date_of_birth)

                                            {{ \Carbon\Carbon::parse($person->date_of_birth)->format('d/m/Y') }}

                                        @else

                                            —

                                        @endif

                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Giới tính
                                    </span>

                                    <span class="ticket-value">

                                        {{
                                            [
                                                'nam' => 'Nam',
                                                'nu' => 'Nữ',
                                                'khac' => 'Khác'
                                            ][$person->gender ?? '']
                                            ?? ($person->gender ?? '—')
                                        }}

                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        CCCD / Hộ chiếu
                                    </span>

                                    <span class="ticket-value">
                                        {{ $person->identity_number }}
                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Số điện thoại
                                    </span>

                                    <span class="ticket-value">
                                        {{ $person->phone }}
                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Email
                                    </span>

                                    <span class="ticket-value">
                                        {{ $person->email }}
                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Số ghế
                                    </span>

                                    <span class="ticket-value">

                                        {{
                                            $personTickets
                                                ->map(function ($t) {
                                                    return $t->flightSeat->seat_number;
                                                })
                                                ->implode(', ')
                                        }}

                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Số vé của hành khách
                                    </span>

                                    <span class="ticket-value">
                                        {{ $personTickets->count() }} vé
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endforeach

                   

                </div>

            </section>

            {{-- ============================================= --}}
            {{-- THÔNG TIN HÀNH LÝ --}}
            {{-- ============================================= --}}

            <section class="card">

                <div class="card-header">

                    <h2>
                        Thông tin hành lý
                    </h2>

                    <p>
                        Chi tiết hành lý được lưu theo từng vé
                        trong đơn đặt chỗ.
                    </p>

                </div>

                <div class="card-body">

                    @if($carryOn)

                        <div
                            class="status-box"
                            style="margin-bottom:15px;"
                        >

                            <span class="status-label">
                                Hành lý xách tay
                            </span>

                            <span class="status-value">

                                {{ $carryOn->weight }} kg
                                — Đã bao gồm trong vé

                            </span>

                        </div>

                    @endif

                    @foreach($booking->tickets as $ticket)

                        <div class="ticket">

                            <div class="ticket-header">

                                <div>

                                    <span class="ticket-label">
                                        Hành khách
                                    </span>

                                    <div class="ticket-code">
                                        {{ $ticket->passenger_name }}
                                    </div>

                                </div>

                                <div class="direction">
                                    {{ $ticket->flight->flight_code }}
                                </div>

                            </div>

                            <div class="ticket-grid">

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Hành lý ký gửi
                                    </span>

                                    <span class="ticket-value">

                                        @if((int) $ticket->baggage_weight > 0)

                                            {{ (int) $ticket->baggage_weight }} kg

                                        @else

                                            Không mua thêm

                                        @endif

                                    </span>

                                </div>

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Phí hành lý
                                    </span>

                                    <span class="ticket-value price">

                                        {{ $formatThousands($ticket->baggage_price) }}
                                        nghìn đồng

                                    </span>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>

            {{-- ============================================= --}}
            {{-- THANH TOÁN QR NGÂN HÀNG --}}
            {{-- ============================================= --}}

            <section class="card">

                <div class="card-header">

                    <h2>

                        @if($booking->payment_status === 'paid')

                            Trạng thái đặt vé

                        @elseif($booking->payment_status === 'waiting_confirmation')

                            Trạng thái xác nhận thanh toán

                        @else

                            Thanh toán bằng QR ngân hàng

                        @endif

                    </h2>

                    <p>

                        @if($booking->payment_status === 'paid')

                            Thanh toán đã hoàn tất.

                        @elseif($booking->payment_status === 'waiting_confirmation')

                            Yêu cầu thanh toán đang chờ xác nhận.

                        @else

                            Quét VietQR và tải ảnh hóa đơn
                            để hệ thống kiểm tra tự động.

                        @endif

                    </p>

                </div>

                <div class="card-body">

                    {{-- ĐÃ THANH TOÁN --}}

                    @if($booking->payment_status === 'paid')

                        <div
                            class="warning"
                            style="margin-top:0;"
                        >

                            @if($booking->booking_status === 'confirmed')

                                <strong>
                                    Thanh toán thành công.
                                    Vé đã được xác nhận.
                                </strong>

                                <p>
                                    Vé của bạn đã có hiệu lực
                                    và có thể được nhân viên tra cứu.
                                </p>

                            @else

                                <strong>
                                    Đã thanh toán — đang chờ
                                    Admin xác nhận vé.
                                </strong>

                                <p>
                                    Thanh toán đã được ghi nhận.
                                </p>

                            @endif

                        </div>

                        <div
                            class="bottom-actions"
                            style="margin-top:18px;"
                        >

                            <a
                                href="{{ route('tickets.mine') }}"
                                class="back-button"
                            >
                                Xem vé của tôi
                            </a>

                        </div>

                    {{-- CHỜ ADMIN XÁC NHẬN --}}

                    @elseif($booking->payment_status === 'waiting_confirmation')

                        <div
                            class="warning"
                            style="margin-top:0;"
                        >

                            <strong>
                                Đang chờ Admin xác nhận thanh toán.
                            </strong>

                            <p>
                                Đây là trạng thái thanh toán cũ.
                                Admin sẽ kiểm tra và xác nhận.
                            </p>

                        </div>

                        <div
                            class="bottom-actions"
                            style="margin-top:18px;"
                        >

                            <a
                                href="{{ route('tickets.mine') }}"
                                class="back-button"
                            >
                                Xem vé của tôi
                            </a>

                        </div>

                    {{-- CHƯA THANH TOÁN --}}

                    @else

                        <div class="payment-methods">

                            <div class="payment-option">

                                <div class="method-icon">
                                    QR
                                </div>

                                <span class="payment-title">
                                    QR ngân hàng
                                </span>

                                <p>
                                    Quét VietQR bằng ứng dụng ngân hàng
                                    trên điện thoại.
                                </p>

                            </div>

                        </div>

                        <div
                            id="qr_bank"
                            class="payment-content"
                        >

                            <div class="payment-box">

                                <div class="payment-box-header">

                                    <h3>
                                        Thanh toán bằng QR ngân hàng
                                    </h3>

                                    <p>
                                        Sử dụng ứng dụng ngân hàng
                                        hỗ trợ VietQR để quét mã.
                                    </p>

                                </div>

                                <div class="qr-layout">

                                    {{-- MÃ QR --}}

                                    <div class="qr-wrapper">

                                        {{--
                                        | KHÔNG ĐỔI QR.
                                        | $vietQrUrl vẫn chứa
                                        | tổng tiền VNĐ thật.
                                        --}}

                                        <img
                                            src="{{ $vietQrUrl }}"
                                            alt="Mã QR thanh toán ngân hàng"
                                            class="qr-image"
                                        >

                                        <div class="qr-caption">
                                            Quét mã bằng ứng dụng ngân hàng
                                        </div>

                                    </div>

                                    {{-- THÔNG TIN CHUYỂN KHOẢN --}}

                                    <div>

                                        <div class="bank-info">

                                            {{-- NGÂN HÀNG --}}

                                            <div class="bank-row">

                                                <strong>
                                                    Ngân hàng
                                                </strong>

                                                <span class="copy-value">
                                                    {{ $bankCode }}
                                                </span>

                                            </div>

                                            {{-- SỐ TÀI KHOẢN --}}

                                            <div class="bank-row">

                                                <strong>
                                                    Số tài khoản
                                                </strong>

                                                <span class="copy-value">
                                                    {{ $bankAccount }}
                                                </span>

                                            </div>

                                            {{-- CHỦ TÀI KHOẢN --}}

                                            <div class="bank-row">

                                                <strong>
                                                    Chủ tài khoản
                                                </strong>

                                                <span class="copy-value">
                                                    {{ $bankOwner }}
                                                </span>

                                            </div>

                                            {{--
                                            |--------------------------------------------------------------------------
                                            | SỐ TIỀN HIỂN THỊ THEO NGHÌN ĐỒNG
                                            |--------------------------------------------------------------------------
                                            |
                                            | Ví dụ:
                                            | 20000 VNĐ -> 20
                                            |
                                            --}}

                                            <div class="bank-row">

                                                <strong>
                                                    Số tiền
                                                </strong>

                                                <span class="copy-value price">

                                                    {{ $formatThousands($booking->total_amount) }}

                                                </span>

                                            </div>

                                            {{--
                                            |--------------------------------------------------------------------------
                                            | ĐƠN VỊ TIỀN TỆ THEO YÊU CẦU CÔ GIÁO
                                            |--------------------------------------------------------------------------
                                            --}}

                                            <div class="bank-row">

                                                <strong>
                                                    Đơn vị
                                                </strong>

                                                <span class="copy-value">
                                                    Nghìn đồng
                                                </span>

                                            </div>

                                            {{-- NỘI DUNG CHUYỂN KHOẢN --}}

                                            <div class="bank-row">

                                                <strong>
                                                    Nội dung
                                                </strong>

                                                <span class="copy-value">
                                                    {{ $transferContent }}
                                                </span>

                                            </div>

                                        </div>

                                        <div class="note">

                                            Mã QR đã chứa sẵn số tiền
                                            và nội dung chuyển khoản.

                                            Số tiền bên trên được hiển thị
                                            theo đơn vị nghìn đồng.

                                            Khi quét QR, ngân hàng sẽ sử dụng
                                            số tiền VNĐ thực tế.

                                            Vui lòng kiểm tra lại trước
                                            khi xác nhận giao dịch.

                                        </div>

                                    </div>

                                </div>

                                {{--
                                |--------------------------------------------------------------------------
                                | FORM GỬI HÓA ĐƠN OCR — GIỮ NGUYÊN
                                |--------------------------------------------------------------------------
                                |
                                | Không đổi:
                                | - payment.pay
                                | - POST
                                | - multipart/form-data
                                | - @csrf
                                | - payment_method = qr_bank
                                | - payment_receipt
                                | - Kiểu ảnh jpg/jpeg/png
                                | - Nút gửi hóa đơn
                                |
                                --}}

                                <form
                                    action="{{ route('payment.pay', $booking->id) }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                    onsubmit="
                                        return confirm(
                                            'Gửi hóa đơn để hệ thống tự động kiểm tra thanh toán?'
                                        );
                                    "
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="payment_method"
                                        value="qr_bank"
                                    >

                                    <div
                                        style="
                                            margin-top:18px;
                                            padding:16px;
                                            background:white;
                                            border:1px solid #e0e6eb;
                                            border-radius:7px;
                                        "
                                    >

                                        <label
                                            for="payment_receipt"
                                            style="
                                                display:block;
                                                color:#273847;
                                                font-size:13px;
                                                font-weight:bold;
                                                margin-bottom:8px;
                                            "
                                        >
                                            Tải ảnh hóa đơn chuyển khoản
                                        </label>

                                        <input
                                            type="file"
                                            id="payment_receipt"
                                            name="payment_receipt"
                                            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                            required
                                            style="
                                                width:100%;
                                                padding:10px;
                                                border:1px solid #dfe6ed;
                                                border-radius:6px;
                                                background:#f8fafc;
                                            "
                                        >

                                        <div
                                            style="
                                                margin-top:8px;
                                                color:#6b7280;
                                                font-size:11px;
                                                line-height:1.5;
                                            "
                                        >

                                            Sau khi chuyển khoản thành công,
                                            hãy tải ảnh hóa đơn.

                                            Hệ thống sẽ tự động kiểm tra
                                            mã đặt vé, mã giao dịch
                                            và số tiền thanh toán.

                                        </div>

                                        @error('payment_receipt')

                                            <div
                                                style="
                                                    margin-top:8px;
                                                    color:#dc3545;
                                                    font-size:11px;
                                                "
                                            >

                                                {{ $message }}

                                            </div>

                                        @enderror

                                    </div>

                                    <button
                                        type="submit"
                                        class="pay-button"
                                    >

                                        Gửi hóa đơn và kiểm tra thanh toán

                                    </button>

                                </form>

                            </div>

                        </div>

                    @endif

                </div>

            </section>

        </div>

        {{-- ================================================= --}}
        {{-- CỘT PHẢI: TÓM TẮT THANH TOÁN --}}
        {{-- ================================================= --}}

        <aside class="card summary-card">

            <div class="summary-header">

                <h2>
                    Tóm tắt thanh toán
                </h2>

                <p>
                    Thông tin đơn đặt vé của bạn.
                </p>

            </div>

            <div class="summary-body">

                {{-- NGÀY ĐẶT --}}

                <div class="summary-row">

                    <span>
                        Ngày đặt
                    </span>

                    <strong>
                        {{ $booking->created_at->format('d/m/Y H:i') }}
                    </strong>

                </div>

                {{-- NỘI DUNG CHUYỂN KHOẢN --}}

                <div class="summary-row">

                    <span>
                        Nội dung
                    </span>

                    <strong>
                        {{ $transferContent }}
                    </strong>

                </div>

                {{-- MÃ ĐẶT VÉ --}}

                <div class="summary-row">

                    <span>
                        Mã đặt vé
                    </span>

                    <strong>
                        {{ $booking->booking_code }}
                    </strong>

                </div>

                {{-- SỐ HÀNH KHÁCH --}}

                <div class="summary-row">

                    <span>
                        Số hành khách
                    </span>

                    <strong>
                        {{ $passengerCount }} người
                    </strong>

                </div>

                {{-- SỐ VÉ --}}

                <div class="summary-row">

                    <span>
                        Số vé
                    </span>

                    <strong>
                        {{ $booking->tickets->count() }} vé
                    </strong>

                </div>

                {{-- HÀNH TRÌNH --}}

                <div class="summary-row">

                    <span>
                        Hành trình
                    </span>

                    <strong>
                        {{ $isRoundTrip ? 'Khứ hồi' : 'Một chiều' }}
                    </strong>

                </div>

                {{--
                | TỔNG GIÁ VÉ:
                | Hiển thị nghìn đồng.
                --}}

                <div class="summary-row">

                    <span>
                        Tổng giá vé
                    </span>

                    <strong>

                        {{ $formatThousands($totalTicketPrice) }}
                        nghìn đồng

                    </strong>

                </div>

                {{--
                | PHÍ HÀNH LÝ:
                | Hiển thị nghìn đồng.
                --}}

                <div class="summary-row">

                    <span>
                        Phí hành lý
                    </span>

                    <strong>

                        {{ $formatThousands($totalBaggagePrice) }}
                        nghìn đồng

                    </strong>

                </div>

                {{-- TRẠNG THÁI THANH TOÁN --}}

                <div class="summary-row">

                    <span>
                        Trạng thái
                    </span>

                    <strong style="color:#dc3545;">

                        @if($booking->payment_status === 'paid')

                            Đã thanh toán

                        @elseif($booking->payment_status === 'waiting_confirmation')

                            Chờ xác nhận thanh toán

                        @else

                            Chưa thanh toán

                        @endif

                    </strong>

                </div>

                {{--
                |--------------------------------------------------------------------------
                | TỔNG THANH TOÁN HIỂN THỊ THEO NGHÌN ĐỒNG
                |--------------------------------------------------------------------------
                |
                | Chỉ thay cách trình bày.
                | $booking->total_amount không bị cập nhật.
                |
                --}}

                <div class="total-box">

                    <span class="total-label">
                        Tổng thanh toán (nghìn đồng)
                    </span>

                    <div class="total">

                        {{ $formatThousands($booking->total_amount) }}
                        nghìn đồng

                    </div>

                </div>

            </div>

        </aside>

    </div>

    {{-- QUAY LẠI TRANG CHỦ --}}

    <div class="bottom-actions">

        <a
            href="{{ route('trang-chu') }}"
            class="back-button"
        >
            ← Quay lại trang chủ
        </a>

    </div>

</main>

{{-- ===================================================== --}}
{{-- FOOTER --}}
{{-- ===================================================== --}}

<footer>

    <div class="footer-logo">
        Viet<span>jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>
</html>
