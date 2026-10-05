<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Vé điện tử</title>

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
            --success: #198754;
            --danger: #dc3545;
            --light: #f4f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dfe6ed;
            --white: #ffffff;
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
            min-height: 230px;

            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, 0.95),
                    rgba(0, 59, 112, 0.52)
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
            max-width: 1050px;

            margin: -48px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        /* =====================================================
           SUCCESS
        ===================================================== */

        .success-box {
            display: flex;
            align-items: center;
            gap: 14px;

            padding: 18px 20px;

            margin-bottom: 20px;

            background: #edf8f2;

            border: 1px solid #badfc9;
            border-left: 4px solid var(--success);

            border-radius: 8px;
        }

        .success-mark {
            width: 34px;
            height: 34px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--success);
            color: white;

            font-size: 17px;
            font-weight: bold;
        }

        .success-content strong {
            display: block;

            color: #17643d;

            font-size: 14px;

            margin-bottom: 3px;
        }

        .success-content p {
            color: #4f725f;
            font-size: 12px;
        }

        /* =====================================================
           BOOKING SUMMARY
        ===================================================== */

        .booking-summary {
            background: white;

            border-radius: 14px;

            box-shadow:
                0 7px 28px rgba(0, 0, 0, 0.08);

            overflow: hidden;

            margin-bottom: 22px;
        }

        .booking-summary-header {
            background: var(--primary);
            color: white;

            padding: 22px 25px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
        }

        .booking-summary-header h2 {
            font-size: 19px;
            margin-bottom: 4px;
        }

        .booking-summary-header p {
            color: #d9e6ef;
            font-size: 11px;
        }

        .trip-type {
            padding: 7px 12px;

            background: rgba(255, 255, 255, 0.13);

            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;

            font-size: 10px;
            font-weight: 800;

            white-space: nowrap;
        }

        .booking-summary-body {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr;

            padding: 22px 25px;
        }

        .summary-item {
            padding: 3px 20px;

            border-right: 1px solid #e8edf1;
        }

        .summary-item:first-child {
            padding-left: 0;
        }

        .summary-item:last-child {
            border-right: none;
        }

        .summary-label {
            display: block;

            color: var(--muted);

            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;

            margin-bottom: 7px;
        }

        .booking-code {
            color: var(--primary);

            font-size: 20px;
            font-weight: 800;

            letter-spacing: 1px;
        }

        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 4px;

            font-size: 10px;
            font-weight: 800;
        }

        .status.success {
            background: #e9f7ef;
            color: #17643d;

            border: 1px solid #c5e6d2;
        }

        .status.pending {
            background: #fff8e4;
            color: #79641d;

            border: 1px solid #ebdaa1;
        }

        .status.cancelled {
            background: #fdebed;
            color: #842029;

            border: 1px solid #efc3c8;
        }

        .status.used {
            background: #eef0f2;
            color: #59636c;

            border: 1px solid #d7dde1;
        }

        /* =====================================================
           TICKET WRAPPER
        ===================================================== */

        .ticket-wrapper {
            margin-bottom: 24px;
        }

        .ticket-label-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 10px;
        }

        .ticket-label-top h2 {
            color: var(--primary);
            font-size: 17px;
        }

        .direction {
            min-width: 40px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 0 9px;

            border-radius: 5px;

            background: var(--primary);
            color: white;

            font-size: 9px;
            font-weight: 800;
        }

        .direction.return {
            background: #176a53;
        }

        /* =====================================================
           BOARDING PASS
        ===================================================== */

        .boarding-pass {
            display: grid;
            grid-template-columns: 1fr 230px;

            background: white;

            border: 1px solid #dce3e8;
            border-radius: 12px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.07);

            overflow: hidden;
        }

        .boarding-main {
            min-width: 0;
        }

        .ticket-brand {
            min-height: 61px;

            padding: 0 23px;

            background: var(--primary);
            color: white;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .ticket-logo {
            font-size: 21px;
            font-weight: 800;
        }

        .ticket-logo span {
            color: var(--secondary);
        }

        .ticket-type-text {
            color: #d9e5ee;

            font-size: 10px;
            font-weight: bold;

            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* =====================================================
           ROUTE
        ===================================================== */

        .flight-route {
            display: grid;
            grid-template-columns: 1fr 150px 1fr;

            align-items: center;
            gap: 20px;

            padding: 28px 25px 24px;

            border-bottom: 1px solid #edf0f3;
        }

        .route-airport:last-child {
            text-align: right;
        }

        .city {
            color: var(--primary);

            font-size: 24px;
            font-weight: 800;

            margin-bottom: 5px;
        }

        .time {
            color: #344657;

            font-size: 17px;
            font-weight: bold;

            margin-bottom: 4px;
        }

        .date {
            color: var(--muted);
            font-size: 10px;
        }

        .flight-path {
            text-align: center;
        }

        .path-line {
            position: relative;

            height: 2px;

            background: #bccbd6;

            margin-bottom: 8px;
        }

        .path-line::before,
        .path-line::after {
            content: "";

            position: absolute;
            top: -3px;

            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: var(--primary);
        }

        .path-line::before {
            left: 0;
        }

        .path-line::after {
            right: 0;
        }

        .flight-path span {
            color: #85929d;

            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        /* =====================================================
           DETAILS
        ===================================================== */

        .ticket-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);

            padding: 8px 25px 20px;
        }

        .detail-item {
            padding: 14px 15px 10px 0;
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
            color: #293b4b;

            font-size: 12px;
            font-weight: 800;

            word-break: break-word;
        }

        .seat-number {
            color: var(--primary);
            font-size: 17px;
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
           TICKET SIDE
        ===================================================== */

        .boarding-side {
            position: relative;

            background: #f8fafc;

            border-left: 1px dashed #aebbc5;

            padding: 22px 20px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .boarding-side::before,
        .boarding-side::after {
            content: "";

            position: absolute;
            left: -10px;

            width: 19px;
            height: 19px;

            border-radius: 50%;

            background: var(--light);
        }

        .boarding-side::before {
            top: -10px;
        }

        .boarding-side::after {
            bottom: -10px;
        }

        .side-label {
            display: block;

            color: var(--muted);

            font-size: 9px;
            text-transform: uppercase;

            margin-bottom: 5px;
        }

        .side-code {
            color: var(--primary);

            font-size: 18px;
            font-weight: 800;

            word-break: break-word;
        }

        .side-row {
            margin-top: 18px;
        }

        .side-value {
            color: #344657;

            font-size: 12px;
            font-weight: bold;
        }

        .barcode {
            height: 55px;

            margin-top: 20px;

            background:
                repeating-linear-gradient(
                    90deg,
                    #1e2933 0,
                    #1e2933 2px,
                    transparent 2px,
                    transparent 5px,
                    #1e2933 5px,
                    #1e2933 6px,
                    transparent 6px,
                    transparent 9px
                );

            opacity: 0.8;
        }

        .barcode-text {
            margin-top: 5px;

            text-align: center;

            color: #6e7982;

            font-size: 8px;
            letter-spacing: 1px;
        }

        /* =====================================================
           TOTAL
        ===================================================== */

        .total-card {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            background: white;

            padding: 23px 25px;

            border-radius: 12px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.06);

            margin-top: 26px;
        }

        .total-title {
            color: #344657;

            font-size: 13px;
            font-weight: bold;
        }

        .total-note {
            color: var(--muted);

            font-size: 10px;

            margin-top: 4px;
        }

        .total {
            color: #b42318;

            font-size: 26px;
            font-weight: 800;

            white-space: nowrap;
        }

        /* =====================================================
           ACTIONS
        ===================================================== */

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;

            margin-top: 22px;
        }

        .primary-button {
            display: inline-block;

            padding: 12px 17px;

            background: var(--primary);
            color: white;

            border-radius: 6px;

            font-size: 13px;
            font-weight: bold;

            transition: 0.2s;
        }

        .primary-button:hover {
            background: var(--primary-dark);
        }

        .secondary-button {
            display: inline-block;

            padding: 11px 17px;

            background: white;
            color: var(--primary);

            border: 1px solid #b9cbd9;
            border-radius: 6px;

            font-size: 13px;
            font-weight: bold;

            transition: 0.2s;
        }

        .secondary-button:hover {
            background: #f1f6fa;
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

        @media (max-width: 800px) {

            .nav-menu {
                display: none;
            }

            .boarding-pass {
                grid-template-columns: 1fr;
            }

            .boarding-side {
                border-left: none;
                border-top: 1px dashed #aebbc5;
            }

            .boarding-side::before,
            .boarding-side::after {
                display: none;
            }

            .booking-summary-body {
                grid-template-columns: 1fr;
            }

            .summary-item {
                padding: 13px 0;

                border-right: none;
                border-bottom: 1px solid #edf0f3;
            }

            .summary-item:last-child {
                border-bottom: none;
            }
        }

        @media (max-width: 650px) {

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

            .booking-summary-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .flight-route {
                grid-template-columns: 1fr;
            }

            .flight-path {
                display: none;
            }

            .route-airport:last-child {
                text-align: left;
            }

            .ticket-details {
                grid-template-columns: 1fr 1fr;
            }

            .total-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .primary-button,
            .secondary-button {
                text-align: center;
            }
        }

        @media (max-width: 450px) {

            .ticket-details {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>

<body>

@php

    /*
     * Một chiều:
     * Booking có 1 Ticket.
     *
     * Khứ hồi:
     * Booking có 2 Ticket.
     */

    $isRoundTrip =
        $booking->tickets->count() === 2;

    $carryOn =
        \App\Models\BaggagePackage::where('type', 'carry_on')
            ->where('status', true)
            ->first();

    $totalTicketPrice =
        (float) $booking->tickets->sum('price');

    $totalBaggagePrice =
        (float) $booking->tickets->sum('baggage_price');

@endphp


{{-- ========================================================= --}}
{{-- TOP BAR --}}
{{-- ========================================================= --}}

<div class="top-bar">

    <div class="top-bar-inner">

        <div class="top-group">

            <span>
               
            </span>

            <span>
                
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
                class="nav-link"
            >
                Đặt vé
            </a>

            @auth

                <a
                    href="{{ route('tickets.mine') }}"
                    class="nav-link active"
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

            <span>
                Vé điện tử
            </span>

        </div>


        <h1>
            Vé điện tử của bạn
        </h1>


        <p>
            Đặt vé đã hoàn tất. Bạn có thể kiểm tra hành trình,
            ghế ngồi và trạng thái vé tại đây.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    {{-- ========================================================= --}}
    {{-- SUCCESS --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div class="success-box">

            <div class="success-mark">
                ✓
            </div>


            <div class="success-content">

                <strong>
                    Thanh toán thành công
                </strong>

                <p>
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- BOOKING SUMMARY --}}
    {{-- ========================================================= --}}

    <section class="booking-summary">

        <div class="booking-summary-header">

            <div>

                <h2>
                    Thông tin đặt vé
                </h2>

                <p>
                    Thông tin chung của đơn đặt vé SkyGo.
                </p>

            </div>


            <div class="trip-type">

                @if($isRoundTrip)
                    VÉ KHỨ HỒI
                @else
                    VÉ MỘT CHIỀU
                @endif

            </div>

        </div>


        <div class="booking-summary-body">

            <div class="summary-item">

                <span class="summary-label">
                    Mã đặt vé
                </span>

                <div class="booking-code">
                    {{ $booking->booking_code }}
                </div>

            </div>


            <div class="summary-item">

                <span class="summary-label">
                    Trạng thái đặt vé
                </span>


                @if($booking->booking_status === 'confirmed')

                    <span class="status success">
                        Đã xác nhận
                    </span>

                @elseif($booking->booking_status === 'cancelled')

                    <span class="status cancelled">
                        Đã hủy
                    </span>

                @else

                    <span class="status pending">
                        Chờ xử lý
                    </span>

                @endif

            </div>


            <div class="summary-item">

                <span class="summary-label">
                    Thanh toán
                </span>


                @if($booking->payment_status === 'paid')

                    <span class="status success">
                        Đã thanh toán
                    </span>

                @else

                    <span class="status pending">
                        Chưa thanh toán
                    </span>

                @endif

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- TICKETS --}}
    {{-- ========================================================= --}}

    @foreach($booking->tickets as $index => $ticket)

        <section class="ticket-wrapper">

            <div class="ticket-label-top">

                <h2>

                    @if($isRoundTrip)

                        @if($index === 0)
                            Vé chiều đi
                        @else
                            Vé chiều về
                        @endif

                    @else
                        Vé máy bay
                    @endif

                </h2>


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


            <div class="boarding-pass">

                {{-- ================================================= --}}
                {{-- MAIN TICKET --}}
                {{-- ================================================= --}}

                <div class="boarding-main">

                    <div class="ticket-brand">

                        <div class="ticket-logo">
                            Viet<span>Jet</span>
                        </div>

                        <div class="ticket-type-text">
                            Electronic Ticket
                        </div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- ROUTE --}}
                    {{-- ============================================= --}}

                    <div class="flight-route">

                        <div class="route-airport">

                            <div class="city">
                                {{ $ticket->flight->departureAirport->city }}
                            </div>

                            <div class="time">

                                {{ substr(
                                    $ticket->flight->departure_time,
                                    0,
                                    5
                                ) }}

                            </div>

                            <div class="date">
                                {{ $ticket->flight->flight_date->format('d/m/Y') }}
                            </div>

                        </div>


                        <div class="flight-path">

                            <div class="path-line"></div>

                            <span>
                                {{ $ticket->flight->flight_code }}
                            </span>

                        </div>


                        <div class="route-airport">

                            <div class="city">
                                {{ $ticket->flight->arrivalAirport->city }}
                            </div>

                            <div class="time">

                                {{ substr(
                                    $ticket->flight->arrival_time,
                                    0,
                                    5
                                ) }}

                            </div>

                            <div class="date">
                                {{ $ticket->flight->flight_date->format('d/m/Y') }}
                            </div>

                        </div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- DETAILS --}}
                    {{-- ============================================= --}}

                    <div class="ticket-details">

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
                                Chuyến bay
                            </span>

                            <span class="detail-value">
                                {{ $ticket->flight->flight_code }}
                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Máy bay
                            </span>

                            <span class="detail-value">
                                {{ $ticket->flight->aircraft->name }}
                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Ghế
                            </span>

                            <span class="detail-value seat-number">
                                {{ $ticket->flightSeat->seat_number }}
                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Hạng ghế
                            </span>


                            @if($ticket->seat_class === 'vip')

                                <span class="detail-value vip">
                                    VIP
                                </span>

                            @else

                                <span class="detail-value economy">
                                    Phổ thông
                                </span>

                            @endif

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Giá vé
                            </span>

                            <span class="detail-value price">

                                {{ number_format(
                                    $ticket->price,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ

                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Hành lý xách tay
                            </span>

                            <span class="detail-value">
                                @if($carryOn)
                                    {{ $carryOn->weight }} kg - Bao gồm
                                @else
                                    Theo chính sách hiện hành
                                @endif
                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Hành lý ký gửi
                            </span>

                            <span class="detail-value">
                                @if((int) $ticket->baggage_weight > 0)
                                    {{ (int) $ticket->baggage_weight }} kg
                                @else
                                    Không mua thêm
                                @endif
                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Phí hành lý
                            </span>

                            <span class="detail-value price">

                                {{ number_format(
                                    (float) $ticket->baggage_price,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ

                            </span>

                        </div>


                        <div class="detail-item">

                            <span class="detail-label">
                                Tổng vé + hành lý
                            </span>

                            <span class="detail-value price">

                                {{ number_format(
                                    (float) $ticket->price
                                    + (float) $ticket->baggage_price,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SIDE TICKET --}}
                {{-- ================================================= --}}

                <div class="boarding-side">

                    <div>

                        <span class="side-label">
                            Mã vé
                        </span>

                        <div class="side-code">
                            {{ $ticket->ticket_code }}
                        </div>


                        <div class="side-row">

                            <span class="side-label">
                                Hành khách
                            </span>

                            <div class="side-value">
                                {{ $ticket->passenger_name }}
                            </div>

                        </div>


                        <div class="side-row">

                            <span class="side-label">
                                Ghế
                            </span>

                            <div class="side-value">
                                {{ $ticket->flightSeat->seat_number }}
                            </div>

                        </div>


                        <div class="side-row">

                            <span class="side-label">
                                Hành lý ký gửi
                            </span>

                            <div class="side-value">
                                @if((int) $ticket->baggage_weight > 0)
                                    {{ (int) $ticket->baggage_weight }} kg
                                @else
                                    Không mua thêm
                                @endif
                            </div>

                        </div>


                        <div class="side-row">

                            <span class="side-label">
                                Trạng thái vé
                            </span>


                            @if($ticket->ticket_status === 'active')

                                <span class="status success">
                                    Có hiệu lực
                                </span>

                            @elseif($ticket->ticket_status === 'used')

                                <span class="status used">
                                    Đã sử dụng
                                </span>

                            @elseif($ticket->ticket_status === 'cancelled')

                                <span class="status cancelled">
                                    Đã hủy
                                </span>

                            @else

                                <span class="status pending">
                                    Chờ xử lý
                                </span>

                            @endif

                        </div>

                    </div>


                    <div>

                        <div class="barcode"></div>

                        <div class="barcode-text">
                            {{ $ticket->ticket_code }}
                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endforeach


    {{-- ========================================================= --}}
    {{-- TOTAL --}}
    {{-- ========================================================= --}}

    <section class="total-card">

        <div>

            <div class="total-title">

                @if($isRoundTrip)
                    Tổng thanh toán 2 chiều
                @else
                    Tổng thanh toán
                @endif

            </div>

            <div class="total-note">
                Giá vé:
                {{ number_format($totalTicketPrice, 0, ',', '.') }} đ
                · Phí hành lý:
                {{ number_format($totalBaggagePrice, 0, ',', '.') }} đ
            </div>

        </div>


        <div class="total">

            {{ number_format(
                $booking->total_amount,
                0,
                ',',
                '.'
            ) }} đ

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- ACTIONS --}}
    {{-- ========================================================= --}}

    <div class="actions">

        <a
            href="{{ route('tickets.mine') }}"
            class="primary-button"
        >
            Xem vé của tôi
        </a>


        <a
            href="{{ route('trang-chu') }}"
            class="secondary-button"
        >
            ← Về trang chủ
        </a>

    </div>

</main>


{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer>

    <div class="footer-logo">
        <span></span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>

</html>