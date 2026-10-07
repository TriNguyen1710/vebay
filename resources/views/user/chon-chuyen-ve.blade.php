<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Chọn chuyến về - SkyGo</title>

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
            --warning: #d97706;
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

        .login-link,
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
                    rgba(0, 31, 58, 0.93),
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
            padding: 48px 20px 82px;
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
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            max-width: 1160px;

            margin: -48px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        /* =====================================================
           OUTBOUND CARD
        ===================================================== */

        .selected-card {
            background: white;

            border-radius: 14px;

            padding: 26px;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, 0.1);

            margin-bottom: 22px;
        }

        .selected-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            padding-bottom: 18px;
            margin-bottom: 20px;

            border-bottom: 1px solid #edf0f3;
        }

        .selected-header h2 {
            color: var(--primary);
            font-size: 21px;
            margin-bottom: 4px;
        }

        .selected-header p {
            color: var(--muted);
            font-size: 13px;
        }

        .complete-badge {
            padding: 7px 12px;

            border-radius: 20px;

            background: #e8f6ee;
            color: var(--success);

            font-size: 11px;
            font-weight: bold;
        }

        .selected-trip {
            display: grid;
            grid-template-columns: 130px 1fr 160px 160px;
            gap: 12px;
        }

        .info-box {
            padding: 15px;

            background: #f8fafc;

            border: 1px solid #e4e9ee;
            border-radius: 8px;
        }

        .info-label {
            display: block;

            color: var(--muted);

            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;

            margin-bottom: 6px;
        }

        .info-value {
            color: #263746;
            font-size: 14px;
            font-weight: bold;
        }

        .seat-value {
            color: var(--primary);
        }

        /* =====================================================
           RETURN SECTION
        ===================================================== */

        .return-section {
            background: white;

            border-radius: 14px;

            padding: 26px;

            box-shadow:
                0 6px 25px rgba(0, 0, 0, 0.07);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            margin-bottom: 22px;

            padding-bottom: 18px;

            border-bottom: 1px solid #edf0f3;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .direction-badge {
            min-width: 40px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 0 9px;

            background: #176a53;
            color: white;

            border-radius: 6px;

            font-size: 11px;
            font-weight: 800;
        }

        .section-title h2 {
            color: var(--primary);
            font-size: 21px;
            margin-bottom: 3px;
        }

        .section-title p {
            color: var(--muted);
            font-size: 13px;
        }

        .return-date {
            background: #edf6f2;
            color: #176a53;

            border-radius: 6px;

            padding: 8px 12px;

            font-size: 13px;
            font-weight: bold;
        }

        /* =====================================================
           FLIGHT LIST
        ===================================================== */

        .flight-list {
            display: grid;
            gap: 15px;
        }

        .flight-card {
            border: 1px solid var(--border);
            border-radius: 11px;

            padding: 19px 20px;

            display: grid;

            grid-template-columns:
                115px
                1fr
                185px
                125px;

            gap: 18px;

            align-items: center;

            transition: 0.2s;
        }

        .flight-card:hover {
            border-color: #b7cad9;

            box-shadow:
                0 6px 20px rgba(0, 59, 112, 0.08);

            transform: translateY(-1px);
        }

        .flight-code {
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        .flight-code small {
            display: block;

            margin-top: 4px;

            color: var(--muted);

            font-size: 10px;
            font-weight: normal;
        }

        /* =====================================================
           ROUTE
        ===================================================== */

        .route {
            display: grid;
            grid-template-columns: 1fr 85px 1fr;
            gap: 10px;
            align-items: center;
        }

        .airport:last-child {
            text-align: right;
        }

        .time {
            display: block;

            color: #111827;

            font-size: 21px;
            font-weight: 800;

            margin-bottom: 3px;
        }

        .city {
            display: block;

            color: var(--muted);

            font-size: 12px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .route-line {
            text-align: center;
        }

        .line {
            height: 2px;

            background: #cbd4dc;

            position: relative;

            margin-bottom: 5px;
        }

        .line::before,
        .line::after {
            content: "";

            width: 6px;
            height: 6px;

            position: absolute;
            top: -2px;

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
            color: #8a949e;
            font-size: 10px;
        }

        /* =====================================================
           PRICE
        ===================================================== */

        .prices {
            border-left: 1px solid #e7ebef;
            padding-left: 18px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 10px;

            margin-bottom: 8px;
        }

        .price-row:last-child {
            margin-bottom: 0;
        }

        .price-label {
            color: var(--muted);
            font-size: 11px;
        }

        .price {
            color: #b42318;
            font-size: 14px;
            font-weight: 800;
        }

        .vip-price {
            color: #8a6700;
        }

        /* =====================================================
           AVAILABILITY
        ===================================================== */

        .availability {
            text-align: right;
        }

        .seat-count {
            color: #374151;
            font-size: 12px;
            font-weight: bold;

            margin-bottom: 6px;
        }

        .status {
            display: inline-block;

            padding: 5px 8px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: bold;
        }

        .status.available {
            background: #e8f6ee;
            color: var(--success);
        }

        .status.warning {
            background: #fff3dc;
            color: var(--warning);
        }

        .status.full {
            background: #fdebed;
            color: var(--danger);
        }

        /* =====================================================
           ACTION
        ===================================================== */

        .flight-action {
            grid-column: 1 / -1;

            display: flex;
            justify-content: flex-end;

            border-top: 1px solid #edf0f3;

            padding-top: 14px;
        }

        .select-button {
            min-width: 170px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 11px 18px;

            border-radius: 6px;

            background: var(--primary);
            color: white;

            font-size: 13px;
            font-weight: bold;

            transition: 0.2s;
        }

        .select-button:hover {
            background: var(--primary-dark);
        }

        .disabled {
            color: #929ba4;
            font-size: 12px;
            font-weight: bold;
        }

        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            padding: 22px;

            background: #fff9e8;

            border: 1px dashed #dfbd5a;
            border-radius: 8px;

            color: #715a1a;

            text-align: center;
            font-size: 13px;
        }

        /* =====================================================
           BOTTOM
        ===================================================== */

        .bottom-actions {
            margin-top: 20px;

            display: flex;
            justify-content: space-between;
            align-items: center;
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

        @media (max-width: 1000px) {

            .nav-menu {
                display: none;
            }

            .selected-trip {
                grid-template-columns: 1fr 1fr;
            }

            .flight-card {
                grid-template-columns:
                    100px
                    1fr
                    170px;
            }

            .availability {
                grid-column: 1 / -1;
                text-align: left;

                padding-top: 12px;

                border-top: 1px solid #edf0f3;
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
                font-size: 30px;
            }

            .selected-header,
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .selected-trip {
                grid-template-columns: 1fr;
            }

            .flight-card {
                grid-template-columns: 1fr;
            }

            .route {
                grid-template-columns: 1fr;
            }

            .route-line {
                display: none;
            }

            .airport:last-child {
                text-align: left;
            }

            .prices {
                border-left: none;

                border-top: 1px solid #edf0f3;

                padding-left: 0;
                padding-top: 13px;
            }

            .availability {
                grid-column: auto;
            }

            .flight-action {
                grid-column: auto;
            }

            .select-button {
                width: 100%;
            }

            .bottom-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>

</head>

<body>

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
            Viet<span>Jet</span>
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

            @guest

                <a
                    href="{{ route('dang-nhap') }}"
                    class="login-link"
                >
                    Đăng nhập
                </a>

            @else

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

            @endguest

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
                Chọn chuyến về
            </span>

        </div>


        <h1>
            Chọn chuyến bay chiều về
        </h1>

        <p>
            Chiều đi đã được lựa chọn.
            Hãy chọn chuyến bay phù hợp cho hành trình trở về.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    {{-- ========================================================= --}}
    {{-- CHUYẾN ĐI ĐÃ CHỌN --}}
    {{-- ========================================================= --}}

    <section class="selected-card">

        <div class="selected-header">

            <div>

                <h2>
                    Chuyến đi đã chọn
                </h2>

                <p>
                    Thông tin chuyến bay và ghế chiều đi của bạn.
                </p>

            </div>


            <div class="complete-badge">
                Đã hoàn tất chiều đi
            </div>

        </div>


        <div class="selected-trip">

            <div class="info-box">

                <span class="info-label">
                    Mã chuyến
                </span>

                <span class="info-value">
                    {{ $flight->flight_code }}
                </span>

            </div>


            <div class="info-box">

                <span class="info-label">
                    Hành trình
                </span>

                <span class="info-value">

                    {{ $flight->departureAirport->city }}

                    →

                    {{ $flight->arrivalAirport->city }}

                </span>

            </div>


            <div class="info-box">

                <span class="info-label">
                    Ngày bay
                </span>

                <span class="info-value">

                    {{ $flight->flight_date->format('d/m/Y') }}

                </span>

            </div>


            <div class="info-box">

                <span class="info-label">
                    Ghế đã chọn
                </span>

                <span class="info-value seat-value">

                    {{ $seat->seat_number }}

                    -

                    {{
                        $seat->seat_class === 'vip'
                            ? 'VIP'
                            : 'Phổ thông'
                    }}

                </span>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- DANH SÁCH CHUYẾN VỀ --}}
    {{-- ========================================================= --}}

    <section class="return-section">

        <div class="section-header">

            <div class="section-title">

                <div class="direction-badge">
                    VỀ
                </div>


                <div>

                    <h2>
                        Chuyến bay chiều về
                    </h2>

                    <p>
                        Chọn một chuyến để tiếp tục chọn ghế chiều về.
                    </p>

                </div>

            </div>


            <div class="return-date">

                {{ \Carbon\Carbon::parse(
                    $returnDate
                )->format('d/m/Y') }}

            </div>

        </div>


        @if($returnFlights->count() > 0)

            <div class="flight-list">

                @foreach($returnFlights as $returnFlight)

                    @php

                        $totalSeats =
                            $returnFlight
                                ->flightSeats
                                ->count();

                        $bookedSeats =
                            $returnFlight
                                ->flightSeats
                                ->where(
                                    'status',
                                    'booked'
                                )
                                ->count();

                        $availableSeats =
                            $totalSeats - $bookedSeats;

                        $economyPrice =
                            (float) $returnFlight->price;

                        $vipPrice =
                            (float) $returnFlight->price
                            +
                            (float) $returnFlight->vip_surcharge;

                    @endphp


                    <div class="flight-card">

                        {{-- MÃ CHUYẾN --}}

                        <div class="flight-code">

                            {{ $returnFlight->flight_code }}

                            <small>
                                Mã chuyến bay
                            </small>

                        </div>


                        {{-- HÀNH TRÌNH --}}

                        <div class="route">

                            <div class="airport">

                                <span class="time">
                                    {{ $returnFlight->departure_time }}
                                </span>

                                <span class="city">
                                    {{ $returnFlight->departureAirport->city }}
                                </span>

                            </div>


                            <div class="route-line">

                                <div class="line"></div>

                                <span>
                                    Bay thẳng
                                </span>

                            </div>


                            <div class="airport">

                                <span class="time">
                                    {{ $returnFlight->arrival_time }}
                                </span>

                                <span class="city">
                                    {{ $returnFlight->arrivalAirport->city }}
                                </span>

                            </div>

                        </div>


                        {{-- GIÁ VÉ --}}

                        <div class="prices">

                            <div class="price-row">

                                <span class="price-label">
                                    Phổ thông
                                </span>

                                <span class="price">

                                    {{ number_format(
                                        $economyPrice,
                                        0,
                                        ',',
                                        '.'
                                    ) }} đ

                                </span>

                            </div>


                            <div class="price-row">

                                <span class="price-label">
                                    VIP
                                </span>

                                <span class="price vip-price">

                                    {{ number_format(
                                        $vipPrice,
                                        0,
                                        ',',
                                        '.'
                                    ) }} đ

                                </span>

                            </div>

                        </div>


                        {{-- GHẾ --}}

                        <div class="availability">

                            <div class="seat-count">

                                Còn {{ $availableSeats }}
                                / {{ $totalSeats }} ghế

                            </div>


                            @if($availableSeats == 0)

                                <span class="status full">
                                    Hết ghế
                                </span>

                            @elseif($availableSeats <= 20)

                                <span class="status warning">
                                    Sắp hết ghế
                                </span>

                            @else

                                <span class="status available">
                                    Còn ghế
                                </span>

                            @endif

                        </div>


                        {{-- THAO TÁC --}}

                        <div class="flight-action">

                            @if($availableSeats > 0)

                                <a
                                    href="{{ route(
                                        'seats.show',
                                        [
                                            'flight' => $returnFlight->id,
                                            'leg' => 'return',
                                        ]
                                    ) }}"
                                    class="select-button"
                                >
                                    Chọn chuyến về
                                </a>

                            @else

                                <span class="disabled">
                                    Chuyến bay hiện đã hết ghế
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty">
                Không tìm thấy chuyến bay chiều về phù hợp.
            </div>

        @endif

    </section>


    {{-- ========================================================= --}}
    {{-- QUAY LẠI --}}
    {{-- ========================================================= --}}

    <div class="bottom-actions">

        <a
            href="{{ route('flights.search.form') }}"
            class="back-button"
        >
            ← Quay lại tìm chuyến bay
        </a>


        <a
            href="{{ route('trang-chu') }}"
            class="back-button"
        >
            Trang chủ
        </a>

    </div>

</main>


{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer>

    <div class="footer-logo">
        Viet<span>Jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>

</html>