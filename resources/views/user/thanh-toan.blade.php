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
            --momo: #a50064;
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
            opacity: 0.9;
        }

        

        .header {
            background: white;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
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

            transition: 0.2s;
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
                    rgba(0, 31, 58, 0.94),
                    rgba(0, 59, 112, 0.53)
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

            grid-template-columns: 1fr 340px;

            gap: 22px;

            align-items: start;
        }

        .card {
            background: white;

            border-radius: 14px;

            box-shadow:
                0 7px 28px rgba(0, 0, 0, 0.08);

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

            position: relative;

            background: #c9d3dc;

            margin-bottom: 5px;
        }

        .line::before,
        .line::after {
            content: "";

            position: absolute;
            top: -2px;

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: var(--primary);
        }

        .line::before {
            left: 0;
        }

        .line::after {
            right: 0;
        }

        .route-line span {
            color: #8a949d;
            font-size: 9px;
        }

        .ticket-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            color: #344657;

            font-size: 12px;
            font-weight: bold;
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

        

        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 14px;
        }

        .payment-option {
            position: relative;

            border: 2px solid #e0e6eb;
            border-radius: 9px;

            padding: 18px;

            cursor: pointer;

            transition: 0.2s;

            background: white;
        }

        .payment-option:hover {
            border-color: #9bbbd1;
        }

        .payment-option.selected {
            border-color: var(--primary);
            background: #f5faff;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
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

        .method-icon.momo {
            background: var(--momo);
            color: white;
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
            display: none;

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
            grid-template-columns: 270px 1fr;

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
            grid-template-columns: 135px 1fr;

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

        

        .momo-box {
            max-width: 600px;
            margin: auto;
        }

        .momo-logo {
            width: 65px;
            height: 65px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 12px;

            border-radius: 13px;

            background: var(--momo);
            color: white;

            font-size: 16px;
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

            transition: 0.2s;
        }

        .pay-button:hover {
            background: var(--primary-dark);
        }

        .pay-button.momo {
            background: var(--momo);
        }

        .pay-button.momo:hover {
            background: #850052;
        }

        

        .bottom-actions {
            margin-top: 5px;
        }

        .back-button {
            color: var(--primary);

            font-size: 14px;
            font-weight: bold;
        }

        .back-button:hover {
            text-decoration: underline;
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

            .navbar {
                min-height: 65px;
            }

            .user-name {
                display: none;
            }

            .page-banner h1 {
                font-size: 29px;
            }

            .steps {
                display: none;
            }

            .payment-methods {
                grid-template-columns: 1fr;
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

            .booking-status {
                grid-template-columns: 1fr;
            }

            .route-display {
                grid-template-columns: 1fr;
            }

            .route-line {
                display: none;
            }

            .airport:last-child {
                text-align: left;
            }

            .ticket-grid {
                grid-template-columns: 1fr;
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

    

    $bankCode = 'VIETCOMBANK';

    $bankAccount = '1029213953';

    $bankOwner = 'NGUYEN MINH TRI';

    $momoPhone = '0769707943';

    $momoOwner = 'NGUYEN MINH TRI';


    

    $isRoundTrip =
        $booking->tickets->count() === 2;


    

    $transferContent =
        $booking->booking_code;


    

    $vietQrUrl =
        'https://img.vietqr.io/image/'
        .
        $bankCode
        .
        '-'
        .
        $bankAccount
        .
        '-compact2.png'
        .
        '?amount='
        .
        (int) $booking->total_amount
        .
        '&addInfo='
        .
        urlencode($transferContent)
        .
        '&accountName='
        .
        urlencode($bankOwner);

    $totalTicketPrice =
        (float) $booking->tickets->sum('price');

    $totalBaggagePrice =
        (float) $booking->tickets->sum('baggage_price');

    $carryOn =
        \App\Models\BaggagePackage::where('type', 'carry_on')
            ->where('status', true)
            ->first();

@endphp






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

            <span>
                Tiếng Việt
            </span>

        </div>

    </div>

</div>






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
                    Vé của tôi
                </a>

                <a
                    href="{{ route('notifications.index') }}"
                    class="nav-link"
                >
                    Thông báo
                </a>

            @endauth

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
            Chọn phương thức thanh toán phù hợp và hoàn tất
            đặt vé của bạn.
        </p>

    </div>

</section>






<main class="main">

    
    
    

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


    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert-error">
            {{ session('error') }}
        </div>

    @endif


    <div class="payment-layout">

        
        
        

        <div>

            
            
            

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

                            @if($isRoundTrip)
                                KHỨ HỒI
                            @else
                                MỘT CHIỀU
                            @endif

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


            
            
            

            <section class="card">

                <div class="card-header">

                    <h2>
                        Thông tin vé
                    </h2>

                    <p>
                        Kiểm tra thông tin chuyến bay trước khi thanh toán.
                    </p>

                </div>


                <div class="card-body">

                    @foreach($booking->tickets as $index => $ticket)

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

                                    @if($index === 0)

                                        <div class="direction">
                                            ĐI
                                        </div>

                                    @else

                                        <div class="direction return">
                                            VỀ
                                        </div>

                                    @endif

                                @endif

                            </div>


                            <div class="route-display">

                                <div class="airport">

                                    <span class="airport-city">
                                        {{ $ticket->flight->departureAirport->city }}
                                    </span>

                                    <span class="airport-time">

                                        {{ substr(
                                            $ticket->flight->departure_time,
                                            0,
                                            5
                                        ) }}

                                    </span>

                                </div>


                                <div class="route-line">

                                    <div class="line"></div>

                                    <span>
                                        Bay thẳng
                                    </span>

                                </div>


                                <div class="airport">

                                    <span class="airport-city">
                                        {{ $ticket->flight->arrivalAirport->city }}
                                    </span>

                                    <span class="airport-time">

                                        {{ substr(
                                            $ticket->flight->arrival_time,
                                            0,
                                            5
                                        ) }}

                                    </span>

                                </div>

                            </div>


                            <div class="ticket-grid">

                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Hành khách
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->passenger_name }}
                                    </span>

                                </div>


                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Chuyến bay
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->flight->flight_code }}
                                    </span>

                                </div>


                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Ngày bay
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->flight->flight_date->format('d/m/Y') }}
                                    </span>

                                </div>


                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Ghế
                                    </span>

                                    <span class="ticket-value">
                                        {{ $ticket->flightSeat->seat_number }}
                                    </span>

                                </div>


                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Hạng ghế
                                    </span>

                                    <span
                                        class="ticket-value
                                        {{
                                            $ticket->seat_class === 'vip'
                                                ? 'vip'
                                                : 'economy'
                                        }}"
                                    >

                                        {{
                                            $ticket->seat_class === 'vip'
                                                ? 'VIP'
                                                : 'Phổ thông'
                                        }}

                                    </span>

                                </div>


                                <div class="ticket-info">

                                    <span class="ticket-label">
                                        Giá vé
                                    </span>

                                    <span class="ticket-value price">

                                        {{ number_format(
                                            $ticket->price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ

                                    </span>

                                </div>


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
                                        {{ number_format(
                                            (float) $ticket->baggage_price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>


            
            
            

            <section class="card">

                <div class="card-header">

                    <h2>
                        Thông tin hành lý
                    </h2>

                    <p>
                        Chi tiết hành lý được lưu theo từng vé trong đơn đặt chỗ.
                    </p>

                </div>


                <div class="card-body">

                    @if($carryOn)

                        <div class="status-box" style="margin-bottom: 15px;">

                            <span class="status-label">
                                Hành lý xách tay
                            </span>

                            <span class="status-value">
                                {{ $carryOn->weight }} kg - Đã bao gồm trong vé
                            </span>

                        </div>

                    @endif


                    @foreach($booking->tickets as $index => $ticket)

                        <div class="ticket" style="margin-bottom: {{ $loop->last ? '0' : '15px' }};">

                            <div class="ticket-header">

                                <div>

                                    <span class="ticket-label">
                                        @if($isRoundTrip)
                                            {{ $index === 0 ? 'Chiều đi' : 'Chiều về' }}
                                        @else
                                            Chuyến bay
                                        @endif
                                    </span>

                                    <div class="ticket-code">
                                        {{ $ticket->flight->flight_code }}
                                    </div>

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
                                        {{ number_format(
                                            (float) $ticket->baggage_price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>


            <section class="card">

                <div class="card-header">

                    <h2>
                        @if($booking->payment_status === 'paid')
                            Trạng thái đặt vé
                        @elseif($booking->payment_status === 'waiting_confirmation')
                            Trạng thái xác nhận thanh toán
                        @else
                            Chọn phương thức thanh toán
                        @endif
                    </h2>

                    <p>
                        @if($booking->payment_status === 'paid')
                            Thanh toán đã hoàn tất.
                        @elseif($booking->payment_status === 'waiting_confirmation')
                            Yêu cầu thanh toán của bạn đã được gửi tới Admin.
                        @else
                            Chọn một phương thức để hiển thị
                            hướng dẫn thanh toán tương ứng.
                        @endif
                    </p>

                </div>


                <div class="card-body">

                    @if($booking->payment_status === 'paid')

                        <div class="warning" style="margin-top:0;">
                            @if($booking->booking_status === 'confirmed')
                                <strong>Thanh toán thành công. Vé đã được xác nhận.</strong><br>
                                Vé của bạn đã có hiệu lực và có thể được nhân viên tra cứu.
                            @else
                                <strong>Đã thanh toán - đang chờ Admin xác nhận vé.</strong><br>
                                Thanh toán của bạn đã được ghi nhận. Sau khi Admin xác nhận,
                                vé sẽ chuyển sang trạng thái có hiệu lực và nhân viên mới có thể tra cứu.
                            @endif
                        </div>

                        <div class="bottom-actions" style="margin-top:18px;">
                            <a
                                href="{{ route('tickets.mine') }}"
                                class="back-button"
                            >
                                Xem vé của tôi
                            </a>
                        </div>

                    @elseif($booking->payment_status === 'waiting_confirmation')

                        <div class="warning" style="margin-top:0;">
                            <strong>Đang chờ Admin xác nhận thanh toán.</strong><br>
                            Đây là trạng thái thanh toán cũ. Admin sẽ kiểm tra và xác nhận.
                        </div>

                        <div class="bottom-actions" style="margin-top:18px;">
                            <a
                                href="{{ route('tickets.mine') }}"
                                class="back-button"
                            >
                                Xem vé của tôi
                            </a>
                        </div>

                    @else

                    <div class="payment-methods">

                        

                        <label
                            class="payment-option"
                            id="option_qr_bank"
                        >

                            <input
                                type="radio"
                                name="payment_method_selector"
                                value="qr_bank"

                                onchange="
                                    showPaymentMethod('qr_bank')
                                "
                            >


                            <div class="method-icon">
                                QR
                            </div>


                            <span class="payment-title">
                                QR ngân hàng
                            </span>


                            <p>
                                Quét VietQR bằng ứng dụng
                                ngân hàng trên điện thoại.
                            </p>

                        </label>


                        

                        <label
                            class="payment-option"
                            id="option_momo"
                        >

                            <input
                                type="radio"
                                name="payment_method_selector"
                                value="momo"

                                onchange="
                                    showPaymentMethod('momo')
                                "
                            >


                            <div class="method-icon momo">
                                M
                            </div>


                            <span class="payment-title">
                                Ví MoMo
                            </span>


                            <p>
                                Thanh toán bằng ví điện tử
                                MoMo theo thông tin bên dưới.
                            </p>

                        </label>

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

                                <div class="qr-wrapper">

                                    <img
                                        src="{{ $vietQrUrl }}"

                                        alt="Mã QR thanh toán ngân hàng"

                                        class="qr-image"
                                    >


                                    <div class="qr-caption">
                                        Quét mã bằng ứng dụng ngân hàng
                                    </div>

                                </div>


                                <div>

                                    <div class="bank-info">

                                        <div class="bank-row">

                                            <strong>
                                                Ngân hàng
                                            </strong>

                                            <span class="copy-value">
                                                {{ $bankCode }}
                                            </span>

                                        </div>


                                        <div class="bank-row">

                                            <strong>
                                                Số tài khoản
                                            </strong>

                                            <span class="copy-value">
                                                {{ $bankAccount }}
                                            </span>

                                        </div>


                                        <div class="bank-row">

                                            <strong>
                                                Chủ tài khoản
                                            </strong>

                                            <span class="copy-value">
                                                {{ $bankOwner }}
                                            </span>

                                        </div>


                                        <div class="bank-row">

                                            <strong>
                                                Số tiền
                                            </strong>

                                            <span class="price">

                                                {{ number_format(
                                                    $booking->total_amount,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }} đ

                                            </span>

                                        </div>


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

                                        Mã QR đã chứa sẵn số tiền và
                                        nội dung chuyển khoản.

                                        Vui lòng kiểm tra lại trước
                                        khi xác nhận giao dịch.

                                    </div>

                                </div>

                            </div>


                            <form
                                action="{{ route(
                                    'payment.pay',
                                    $booking->id
                                ) }}"

                                method="POST"

                                onsubmit="
                                    return confirm(
                                        'Bạn xác nhận đã thanh toán và gửi yêu cầu để Admin kiểm tra?'
                                    );
                                "
                            >

                                @csrf


                                <input
                                    type="hidden"
                                    name="payment_method"
                                    value="qr_bank"
                                >


                                <button
                                    type="submit"
                                    class="pay-button"
                                >
                                    Tôi đã thanh toán bằng QR - Gửi xác nhận
                                </button>

                            </form>

                        </div>

                    </div>


                    
                    
                    

                    <div
                        id="momo"
                        class="payment-content"
                    >

                        <div class="payment-box momo-box">

                            <div class="momo-logo">
                                MoMo
                            </div>


                            <div class="payment-box-header">

                                <h3>
                                    Thanh toán bằng MoMo
                                </h3>

                                <p>
                                    Chuyển đúng số tiền và nội dung
                                    theo thông tin bên dưới.
                                </p>

                            </div>


                            <div class="bank-info">

                                <div class="bank-row">

                                    <strong>
                                        Số MoMo
                                    </strong>

                                    <span class="copy-value">
                                        {{ $momoPhone }}
                                    </span>

                                </div>


                                <div class="bank-row">

                                    <strong>
                                        Người nhận
                                    </strong>

                                    <span class="copy-value">
                                        {{ $momoOwner }}
                                    </span>

                                </div>


                                <div class="bank-row">

                                    <strong>
                                        Số tiền
                                    </strong>

                                    <span class="price">

                                        {{ number_format(
                                            $booking->total_amount,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ

                                    </span>

                                </div>


                                <div class="bank-row">

                                    <strong>
                                        Nội dung
                                    </strong>

                                    <span class="copy-value">
                                        {{ $booking->booking_code }}
                                    </span>

                                </div>

                            </div>


                            <div class="note">

                                Mở ứng dụng MoMo và thực hiện
                                chuyển tiền theo đúng thông tin trên.

                            </div>


                            <form
                                action="{{ route(
                                    'payment.pay',
                                    $booking->id
                                ) }}"

                                method="POST"

                                onsubmit="
                                    return confirm(
                                        'Bạn xác nhận đã thanh toán và gửi yêu cầu để Admin kiểm tra?'
                                    );
                                "
                            >

                                @csrf


                                <input
                                    type="hidden"
                                    name="payment_method"
                                    value="momo"
                                >


                                <button
                                    type="submit"
                                    class="pay-button momo"
                                >
                                    Tôi đã thanh toán bằng MoMo - Gửi xác nhận
                                </button>

                            </form>

                        </div>

                    </div>


                    
                    @endif

                </div>

            </section>

        </div>


        
        
        

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

                <div class="summary-row">

                    <span>
                        Mã đặt vé
                    </span>

                    <strong>
                        {{ $booking->booking_code }}
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Số vé
                    </span>

                    <strong>
                        {{ $booking->tickets->count() }}
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Hành trình
                    </span>

                    <strong>

                        @if($isRoundTrip)
                            Khứ hồi
                        @else
                            Một chiều
                        @endif

                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Tổng giá vé
                    </span>

                    <strong>
                        {{ number_format(
                            $totalTicketPrice,
                            0,
                            ',',
                            '.'
                        ) }} đ
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Phí hành lý
                    </span>

                    <strong>
                        {{ number_format(
                            $totalBaggagePrice,
                            0,
                            ',',
                            '.'
                        ) }} đ
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Trạng thái
                    </span>

                    <strong style="color: #dc3545;">
                        @if($booking->payment_status === 'paid')
                            Đã thanh toán
                        @elseif($booking->payment_status === 'waiting_confirmation')
                            Chờ xác nhận thanh toán
                        @else
                            Chưa thanh toán
                        @endif
                    </strong>

                </div>


                <div class="total-box">

                    <span class="total-label">
                        Tổng thanh toán
                    </span>

                    <div class="total">

                        {{ number_format(
                            $booking->total_amount,
                            0,
                            ',',
                            '.'
                        ) }} đ

                    </div>

                </div>

            </div>

        </aside>

    </div>


    <div class="bottom-actions">

        <a
            href="{{ route('trang-chu') }}"
            class="back-button"
        >
            ← Quay lại trang chủ
        </a>

    </div>

</main>






<footer>

    <div class="footer-logo">
        Viet<span>jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>


<script>

    function showPaymentMethod(method) {

        const qrBank =
            document.getElementById('qr_bank');

        const momo =
            document.getElementById('momo');

        const optionQr =
            document.getElementById('option_qr_bank');

        const optionMomo =
            document.getElementById('option_momo');


        qrBank.style.display = 'none';

        momo.style.display = 'none';


        optionQr.classList.remove('selected');

        optionMomo.classList.remove('selected');


        if (method === 'qr_bank') {

            qrBank.style.display = 'block';

            optionQr.classList.add('selected');

        }


        if (method === 'momo') {

            momo.style.display = 'block';

            optionMomo.classList.add('selected');

        }

    }

</script>

</body>

</html>