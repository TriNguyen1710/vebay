<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Xác nhận đặt vé - SkyGo</title>

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

        button {
            font-family: inherit;
        }

        /* =====================================================
           TOP BAR
        ===================================================== */

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
            align-items: center;
            justify-content: space-between;
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

        /* =====================================================
           HEADER
        ===================================================== */

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

        /* =====================================================
           BANNER
        ===================================================== */

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
            max-width: 650px;

            color: #e3ebf3;

            font-size: 15px;
            line-height: 1.6;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            max-width: 1100px;

            margin: -48px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        /* =====================================================
           STEPS
        ===================================================== */

        .steps {
            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 22px;
        }

        .step {
            display: flex;
            align-items: center;
        }

        .step-number {
            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

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
            width: 50px;
            height: 1px;

            margin: 0 12px;

            background: #ccd4db;
        }

        /* =====================================================
           LAYOUT
        ===================================================== */

        .booking-layout {
            display: grid;
            grid-template-columns: 1fr 350px;
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

        .card-header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .card-header h2 {
            color: var(--primary);

            font-size: 20px;

            margin-bottom: 4px;
        }

        .card-header p {
            color: var(--muted);

            font-size: 12px;
            line-height: 1.5;
        }

        .card-body {
            padding: 22px 24px;
        }

        .trip-badge {
            padding: 7px 11px;

            border-radius: 20px;

            background: var(--primary);
            color: white;

            font-size: 10px;
            font-weight: 800;

            white-space: nowrap;
        }

        /* =====================================================
           FLIGHT
        ===================================================== */

        .flight-block + .flight-block {
            margin-top: 25px;
            padding-top: 25px;

            border-top: 1px solid #e5eaee;
        }

        .flight-title {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 18px;
        }

        .direction {
            min-width: 38px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 0 8px;

            border-radius: 5px;

            background: var(--primary);
            color: white;

            font-size: 10px;
            font-weight: 800;
        }

        .direction.return {
            background: #176a53;
        }

        .flight-title h3 {
            color: #344657;
            font-size: 16px;
        }

        .route-display {
            display: grid;
            grid-template-columns: 1fr 100px 1fr;

            align-items: center;
            gap: 15px;

            padding: 18px;

            margin-bottom: 16px;

            background: #f8fafc;

            border: 1px solid #e3e9ee;
            border-radius: 8px;
        }

        .airport:last-child {
            text-align: right;
        }

        .airport-city {
            display: block;

            color: var(--primary);

            font-size: 17px;
            font-weight: 800;

            margin-bottom: 4px;
        }

        .airport-time {
            color: #4d5d6b;
            font-size: 12px;
        }

        .route-line {
            text-align: center;
        }

        .line {
            position: relative;

            height: 2px;

            background: #c6d1da;

            margin-bottom: 6px;
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
            color: #8b949c;
            font-size: 9px;
        }

        /* =====================================================
           DETAILS
        ===================================================== */

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .detail-box {
            padding: 12px;

            border: 1px solid #e5eaee;
            border-radius: 6px;
        }

        .detail-label {
            display: block;

            color: var(--muted);

            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;

            margin-bottom: 5px;
        }

        .detail-value {
            color: #344657;

            font-size: 12px;
            font-weight: bold;
        }

        .seat {
            color: var(--primary);
            font-size: 15px;
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

        /* =====================================================
           PASSENGER
        ===================================================== */

        .passenger-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .passenger-row {
            padding: 14px 0;

            border-bottom: 1px solid #edf0f3;
        }

        .passenger-row:nth-child(odd) {
            padding-right: 20px;
        }

        .passenger-row:nth-child(even) {
            padding-left: 20px;

            border-left: 1px solid #edf0f3;
        }

        .passenger-label {
            display: block;

            color: var(--muted);

            font-size: 10px;

            margin-bottom: 5px;
        }

        .passenger-value {
            color: #263746;

            font-size: 13px;
            font-weight: bold;

            word-break: break-word;
        }

        /* =====================================================
           PAYMENT SUMMARY
        ===================================================== */

        .payment-card {
            position: sticky;
            top: 20px;
        }

        .payment-header {
            padding: 22px 23px;

            background: var(--primary);
            color: white;
        }

        .payment-header h2 {
            font-size: 19px;
            margin-bottom: 5px;
        }

        .payment-header p {
            color: #d7e5ef;

            font-size: 11px;
            line-height: 1.5;
        }

        .payment-body {
            padding: 22px 23px;
        }

        .payment-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 12px 0;

            border-bottom: 1px solid #edf0f3;
        }

        .payment-row span:first-child {
            color: var(--muted);
            font-size: 12px;
        }

        .payment-row strong {
            color: #344657;
            font-size: 12px;
        }

        .total-area {
            margin-top: 20px;

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

            margin-bottom: 7px;
        }

        .total-price {
            color: #b42318;

            font-size: 25px;
            font-weight: 800;
        }

        .payment-note {
            margin-top: 14px;

            color: #7a848c;

            font-size: 10px;
            line-height: 1.5;
        }

        /* =====================================================
           BUTTON
        ===================================================== */

        .continue-button {
            width: 100%;

            border: none;
            border-radius: 6px;

            margin-top: 20px;
            padding: 14px 18px;

            background: var(--primary);
            color: white;

            cursor: pointer;

            font-size: 14px;
            font-weight: bold;

            transition: 0.2s;
        }

        .continue-button:hover {
            background: var(--primary-dark);
        }

        .secure-text {
            margin-top: 9px;

            color: #8a939b;

            font-size: 9px;
            text-align: center;

            line-height: 1.5;
        }

        /* =====================================================
           BACK
        ===================================================== */

        .bottom-actions {
            margin-top: 4px;
        }

        .back-button {
            color: var(--primary);

            font-size: 14px;
            font-weight: bold;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

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

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 950px) {

            .nav-menu {
                display: none;
            }

            .booking-layout {
                grid-template-columns: 1fr;
            }

            .payment-card {
                position: static;
            }
        }

        @media (max-width: 700px) {

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

            .card-header-flex {
                flex-direction: column;
                align-items: flex-start;
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

            .detail-grid {
                grid-template-columns: 1fr 1fr;
            }

            .passenger-grid {
                grid-template-columns: 1fr;
            }

            .passenger-row:nth-child(odd),
            .passenger-row:nth-child(even) {
                padding-left: 0;
                padding-right: 0;
                border-left: none;
            }
        }

        @media (max-width: 450px) {

            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>

<body>

@php

    $tripType = $tripType ?? 'one_way';

    $carryOn = \App\Models\BaggagePackage::where('type', 'carry_on')
        ->where('status', true)
        ->first();

    $selectedPrice = 0;
    $baggage = session('baggage', []);
    $baggageWeight = (int) ($baggage['weight'] ?? 0);
    $baggagePrice = (float) ($baggage['price'] ?? 0);
    $oneWayTotal = 0;

    if ($tripType !== 'round_trip') {

        $selectedPrice =
            $seat->seat_class === 'vip'
                ? (
                    (float) $flight->price
                    +
                    (float) $flight->vip_surcharge
                )
                : (float) $flight->price;

        $oneWayTotal =
            $selectedPrice + $baggagePrice;
    }

    $outboundPrice = 0;
    $returnPrice = 0;
    $outboundBaggage = session('baggage.outbound', []);
    $returnBaggage = session('baggage.return', []);
    $outboundBaggageWeight = (int) ($outboundBaggage['weight'] ?? 0);
    $outboundBaggagePrice = (float) ($outboundBaggage['price'] ?? 0);
    $returnBaggageWeight = (int) ($returnBaggage['weight'] ?? 0);
    $returnBaggagePrice = (float) ($returnBaggage['price'] ?? 0);
    $totalBaggagePrice = 0;
    $totalPrice = 0;

    if ($tripType === 'round_trip') {

        $outboundPrice =
            $outboundSeat->seat_class === 'vip'
                ? (
                    (float) $outboundFlight->price
                    +
                    (float) $outboundFlight->vip_surcharge
                )
                : (float) $outboundFlight->price;

        $returnPrice =
            $returnSeat->seat_class === 'vip'
                ? (
                    (float) $returnFlight->price
                    +
                    (float) $returnFlight->vip_surcharge
                )
                : (float) $returnFlight->price;

        $totalBaggagePrice =
            $outboundBaggagePrice + $returnBaggagePrice;

        $totalPrice =
            $outboundPrice
            + $returnPrice
            + $totalBaggagePrice;
    }

@endphp


{{-- ========================================================= --}}
{{-- TOP BAR --}}
{{-- ========================================================= --}}

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


{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

<header class="header">

    <nav class="navbar">

        <a
            href="{{ route('trang-chu') }}"
            class="logo"
        >
            Sky<span>Go</span>
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


{{-- ========================================================= --}}
{{-- BANNER --}}
{{-- ========================================================= --}}

<section class="page-banner">

    <div class="banner-inner">

        <div class="breadcrumb">

            <a href="{{ route('trang-chu') }}">
                Trang chủ
            </a>

            <span>/</span>

            <a href="{{ route('flights.search.form') }}">
                Đặt vé
            </a>

            <span>/</span>

            <span>
                Xác nhận đặt vé
            </span>

        </div>


        <h1>
            Xác nhận thông tin đặt vé
        </h1>


        <p>
            Kiểm tra lại hành trình, thông tin hành khách và
            chi phí trước khi chuyển sang bước thanh toán.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    {{-- ========================================================= --}}
    {{-- STEPS --}}
    {{-- ========================================================= --}}

    <div class="steps">

        <div class="step done">

            <div class="step-number">
                1
            </div>

            <div class="step-text">
                Chọn chuyến
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step done">

            <div class="step-number">
                2
            </div>

            <div class="step-text">
                Chọn ghế
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step done">

            <div class="step-number">
                3
            </div>

            <div class="step-text">
                Hành khách
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step done">

            <div class="step-number">
                4
            </div>

            <div class="step-text">
                Hành lý
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step done">

            <div class="step-number">
                5
            </div>

            <div class="step-text">
                Khuôn mặt
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step active">

            <div class="step-number">
                6
            </div>

            <div class="step-text">
                Xác nhận
            </div>

        </div>

    </div>


    <div class="booking-layout">

        {{-- ===================================================== --}}
        {{-- LEFT --}}
        {{-- ===================================================== --}}

        <div>

            {{-- ================================================= --}}
            {{-- FLIGHT INFORMATION --}}
            {{-- ================================================= --}}

            <section class="card">

                <div class="card-header">

                    <div class="card-header-flex">

                        <div>

                            <h2>
                                Thông tin hành trình
                            </h2>

                            <p>
                                Chuyến bay và ghế bạn đã lựa chọn.
                            </p>

                        </div>


                        <div class="trip-badge">

                            @if($tripType === 'round_trip')
                                KHỨ HỒI
                            @else
                                MỘT CHIỀU
                            @endif

                        </div>

                    </div>

                </div>


                <div class="card-body">

                    {{-- ============================================= --}}
                    {{-- ROUND TRIP --}}
                    {{-- ============================================= --}}

                    @if($tripType === 'round_trip')

                        {{-- OUTBOUND --}}

                        <div class="flight-block">

                            <div class="flight-title">

                                <div class="direction">
                                    ĐI
                                </div>

                                <h3>
                                    Chiều đi
                                </h3>

                            </div>


                            <div class="route-display">

                                <div class="airport">

                                    <span class="airport-city">
                                        {{ $outboundFlight->departureAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($outboundFlight->departure_time, 0, 5) }}
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
                                        {{ $outboundFlight->arrivalAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($outboundFlight->arrival_time, 0, 5) }}
                                    </span>

                                </div>

                            </div>


                            <div class="detail-grid">

                                <div class="detail-box">

                                    <span class="detail-label">
                                        Mã chuyến
                                    </span>

                                    <span class="detail-value">
                                        {{ $outboundFlight->flight_code }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Ngày bay
                                    </span>

                                    <span class="detail-value">
                                        {{ $outboundFlight->flight_date->format('d/m/Y') }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Ghế
                                    </span>

                                    <span class="detail-value seat">
                                        {{ $outboundSeat->seat_number }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Hạng ghế
                                    </span>

                                    <span
                                        class="detail-value
                                        {{
                                            $outboundSeat->seat_class === 'vip'
                                                ? 'vip'
                                                : 'economy'
                                        }}"
                                    >

                                        {{
                                            $outboundSeat->seat_class === 'vip'
                                                ? 'VIP'
                                                : 'Phổ thông'
                                        }}

                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- RETURN --}}

                        <div class="flight-block">

                            <div class="flight-title">

                                <div class="direction return">
                                    VỀ
                                </div>

                                <h3>
                                    Chiều về
                                </h3>

                            </div>


                            <div class="route-display">

                                <div class="airport">

                                    <span class="airport-city">
                                        {{ $returnFlight->departureAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($returnFlight->departure_time, 0, 5) }}
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
                                        {{ $returnFlight->arrivalAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($returnFlight->arrival_time, 0, 5) }}
                                    </span>

                                </div>

                            </div>


                            <div class="detail-grid">

                                <div class="detail-box">

                                    <span class="detail-label">
                                        Mã chuyến
                                    </span>

                                    <span class="detail-value">
                                        {{ $returnFlight->flight_code }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Ngày bay
                                    </span>

                                    <span class="detail-value">
                                        {{ $returnFlight->flight_date->format('d/m/Y') }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Ghế
                                    </span>

                                    <span class="detail-value seat">
                                        {{ $returnSeat->seat_number }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Hạng ghế
                                    </span>

                                    <span
                                        class="detail-value
                                        {{
                                            $returnSeat->seat_class === 'vip'
                                                ? 'vip'
                                                : 'economy'
                                        }}"
                                    >

                                        {{
                                            $returnSeat->seat_class === 'vip'
                                                ? 'VIP'
                                                : 'Phổ thông'
                                        }}

                                    </span>

                                </div>

                            </div>

                        </div>


                    {{-- ============================================= --}}
                    {{-- ONE WAY --}}
                    {{-- ============================================= --}}

                    @else

                        <div class="flight-block">

                            <div class="flight-title">

                                <div class="direction">
                                    ĐI
                                </div>

                                <h3>
                                    Chuyến bay
                                </h3>

                            </div>


                            <div class="route-display">

                                <div class="airport">

                                    <span class="airport-city">
                                        {{ $flight->departureAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($flight->departure_time, 0, 5) }}
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
                                        {{ $flight->arrivalAirport->city }}
                                    </span>

                                    <span class="airport-time">
                                        {{ substr($flight->arrival_time, 0, 5) }}
                                    </span>

                                </div>

                            </div>


                            <div class="detail-grid">

                                <div class="detail-box">

                                    <span class="detail-label">
                                        Mã chuyến
                                    </span>

                                    <span class="detail-value">
                                        {{ $flight->flight_code }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Ngày bay
                                    </span>

                                    <span class="detail-value">
                                        {{ $flight->flight_date->format('d/m/Y') }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Ghế
                                    </span>

                                    <span class="detail-value seat">
                                        {{ $seat->seat_number }}
                                    </span>

                                </div>


                                <div class="detail-box">

                                    <span class="detail-label">
                                        Hạng ghế
                                    </span>

                                    <span
                                        class="detail-value
                                        {{
                                            $seat->seat_class === 'vip'
                                                ? 'vip'
                                                : 'economy'
                                        }}"
                                    >

                                        {{
                                            $seat->seat_class === 'vip'
                                                ? 'VIP'
                                                : 'Phổ thông'
                                        }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- PASSENGER --}}
            {{-- ================================================= --}}

            <section class="card">

                <div class="card-header">

                    <h2>
                        Thông tin hành khách
                    </h2>

                    <p>
                        Thông tin sẽ được sử dụng để phát hành vé điện tử.
                    </p>

                </div>


                <div class="card-body">

                    <div class="passenger-grid">

                        <div class="passenger-row">

                            <span class="passenger-label">
                                Họ và tên
                            </span>

                            <span class="passenger-value">
                                {{ $passenger['full_name'] }}
                            </span>

                        </div>


                        <div class="passenger-row">

                            <span class="passenger-label">
                                Ngày sinh
                            </span>

                            <span class="passenger-value">

                                {{ \Carbon\Carbon::parse(
                                    $passenger['date_of_birth']
                                )->format('d/m/Y') }}

                            </span>

                        </div>


                        <div class="passenger-row">

                            <span class="passenger-label">
                                Giới tính
                            </span>

                            <span class="passenger-value">

                                @if($passenger['gender'] === 'nam')

                                    Nam

                                @elseif($passenger['gender'] === 'nu')

                                    Nữ

                                @else

                                    Khác

                                @endif

                            </span>

                        </div>


                        <div class="passenger-row">

                            <span class="passenger-label">
                                CCCD / Hộ chiếu
                            </span>

                            <span class="passenger-value">
                                {{ $passenger['identity_number'] }}
                            </span>

                        </div>


                        <div class="passenger-row">

                            <span class="passenger-label">
                                Số điện thoại
                            </span>

                            <span class="passenger-value">
                                {{ $passenger['phone'] }}
                            </span>

                        </div>


                        <div class="passenger-row">

                            <span class="passenger-label">
                                Email
                            </span>

                            <span class="passenger-value">
                                {{ $passenger['email'] }}
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            <section class="card">

                <div class="card-header">

                    <h2>
                        Thông tin hành lý
                    </h2>

                    <p>
                        Hành lý xách tay miễn phí và hành lý ký gửi bạn đã chọn.
                    </p>

                </div>


                <div class="card-body">

                    <div class="passenger-grid">

                        <div class="passenger-row">

                            <span class="passenger-label">
                                Hành lý xách tay
                            </span>

                            <span class="passenger-value">
                                @if($carryOn)
                                    {{ $carryOn->weight }} kg - Đã bao gồm trong vé
                                @else
                                    Theo chính sách hiện hành
                                @endif
                            </span>

                        </div>


                        @if($tripType === 'round_trip')

                            <div class="passenger-row">

                                <span class="passenger-label">
                                    Hành lý ký gửi chiều đi
                                </span>

                                <span class="passenger-value">
                                    @if($outboundBaggageWeight > 0)
                                        {{ $outboundBaggageWeight }} kg -
                                        {{ number_format($outboundBaggagePrice, 0, ',', '.') }} đ
                                    @else
                                        Không mua thêm
                                    @endif
                                </span>

                            </div>


                            <div class="passenger-row">

                                <span class="passenger-label">
                                    Hành lý ký gửi chiều về
                                </span>

                                <span class="passenger-value">
                                    @if($returnBaggageWeight > 0)
                                        {{ $returnBaggageWeight }} kg -
                                        {{ number_format($returnBaggagePrice, 0, ',', '.') }} đ
                                    @else
                                        Không mua thêm
                                    @endif
                                </span>

                            </div>


                            <div class="passenger-row">

                                <span class="passenger-label">
                                    Tổng phí hành lý ký gửi
                                </span>

                                <span class="passenger-value price">
                                    {{ number_format($totalBaggagePrice, 0, ',', '.') }} đ
                                </span>

                            </div>

                        @else

                            <div class="passenger-row">

                                <span class="passenger-label">
                                    Hành lý ký gửi
                                </span>

                                <span class="passenger-value">
                                    @if($baggageWeight > 0)
                                        {{ $baggageWeight }} kg
                                    @else
                                        Không mua thêm
                                    @endif
                                </span>

                            </div>


                            <div class="passenger-row">

                                <span class="passenger-label">
                                    Phí hành lý ký gửi
                                </span>

                                <span class="passenger-value price">
                                    {{ number_format($baggagePrice, 0, ',', '.') }} đ
                                </span>

                            </div>

                        @endif

                    </div>

                </div>

            </section>

        </div>


        {{-- ===================================================== --}}
        {{-- RIGHT PAYMENT SUMMARY --}}
        {{-- ===================================================== --}}

        <aside class="card payment-card">

            <div class="payment-header">

                <h2>
                    Chi tiết thanh toán
                </h2>

                <p>
                    Kiểm tra tổng chi phí trước khi tiếp tục.
                </p>

            </div>


            <div class="payment-body">

                @if($tripType === 'round_trip')

                    <div class="payment-row">

                        <span>
                            Giá chiều đi
                        </span>

                        <strong>

                            {{ number_format(
                                $outboundPrice,
                                0,
                                ',',
                                '.'
                            ) }} đ

                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Giá chiều về
                        </span>

                        <strong>

                            {{ number_format(
                                $returnPrice,
                                0,
                                ',',
                                '.'
                            ) }} đ

                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Hành lý chiều đi
                        </span>

                        <strong>
                            @if($outboundBaggageWeight > 0)
                                {{ $outboundBaggageWeight }} kg -
                                {{ number_format($outboundBaggagePrice, 0, ',', '.') }} đ
                            @else
                                Không mua thêm
                            @endif
                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Hành lý chiều về
                        </span>

                        <strong>
                            @if($returnBaggageWeight > 0)
                                {{ $returnBaggageWeight }} kg -
                                {{ number_format($returnBaggagePrice, 0, ',', '.') }} đ
                            @else
                                Không mua thêm
                            @endif
                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Tổng phí hành lý
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


                    <div class="payment-row">

                        <span>
                            Loại hành trình
                        </span>

                        <strong>
                            Khứ hồi
                        </strong>

                    </div>


                    <div class="total-area">

                        <span class="total-label">
                            Tổng thanh toán
                        </span>

                        <div class="total-price">

                            {{ number_format(
                                $totalPrice,
                                0,
                                ',',
                                '.'
                            ) }} đ

                        </div>

                    </div>

                @else

                    <div class="payment-row">

                        <span>
                            Hạng ghế
                        </span>

                        <strong>

                            {{
                                $seat->seat_class === 'vip'
                                    ? 'VIP'
                                    : 'Phổ thông'
                            }}

                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Giá vé
                        </span>

                        <strong>

                            {{ number_format(
                                $selectedPrice,
                                0,
                                ',',
                                '.'
                            ) }} đ

                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Hành lý ký gửi
                        </span>

                        <strong>
                            @if($baggageWeight > 0)
                                {{ $baggageWeight }} kg
                            @else
                                Không mua thêm
                            @endif
                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Phí hành lý
                        </span>

                        <strong>
                            {{ number_format(
                                $baggagePrice,
                                0,
                                ',',
                                '.'
                            ) }} đ
                        </strong>

                    </div>


                    <div class="payment-row">

                        <span>
                            Loại hành trình
                        </span>

                        <strong>
                            Một chiều
                        </strong>

                    </div>


                    <div class="total-area">

                        <span class="total-label">
                            Tổng thanh toán
                        </span>

                        <div class="total-price">

                            {{ number_format(
                                $oneWayTotal,
                                0,
                                ',',
                                '.'
                            ) }} đ

                        </div>

                    </div>

                @endif


                <p class="payment-note">
                    Sau khi xác nhận, hệ thống sẽ tạo mã đặt chỗ
                    và chuyển bạn đến trang chọn phương thức thanh toán.
                </p>


                <form
                    action="{{ route('booking.store') }}"
                    method="POST"
                >

                    @csrf


                    <button
                        type="submit"
                        class="continue-button"
                    >
                        Xác nhận và tiếp tục thanh toán
                    </button>

                </form>


                <p class="secure-text">
                    Vui lòng kiểm tra kỹ thông tin hành khách
                    trước khi tiếp tục.
                </p>

            </div>

        </aside>

    </div>


    {{-- ========================================================= --}}
    {{-- BACK --}}
    {{-- ========================================================= --}}

    <div class="bottom-actions">

        <a
            href="{{ route('face.create') }}"
            class="back-button"
        >
            ← Quay lại bước quét khuôn mặt
        </a>

    </div>

</main>


{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer>

    <div class="footer-logo">
        Sky<span>Go</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>

</html>