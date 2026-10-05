<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Kết quả chuyến bay - SkyGo</title>

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
            --border: #e1e7ee;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
        }

        a {
            text-decoration: none;
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
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a {
            color: white;
            opacity: 0.9;
        }

        .top-bar a:hover {
            opacity: 1;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            background: white;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .navbar {
            max-width: 1240px;
            min-height: 76px;
            margin: auto;
            padding: 0 20px;

            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .login-link {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
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
            min-height: 250px;

            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, 0.91),
                    rgba(0, 59, 112, 0.46)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');

            background-size: cover;
            background-position: center;

            color: white;
        }

        .banner-inner {
            max-width: 1240px;
            margin: auto;
            padding: 55px 20px 95px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 20px;

            font-size: 14px;
        }

        .breadcrumb a {
            color: #ffd356;
        }

        .breadcrumb span {
            color: #e4eaf0;
        }

        .page-banner h1 {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .page-banner p {
            max-width: 620px;

            color: #e5edf5;

            line-height: 1.6;
            font-size: 16px;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            max-width: 1180px;

            margin: -58px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        /* =====================================================
           SEARCH SUMMARY
        ===================================================== */

        .summary-card {
            background: white;

            border-radius: 15px;

            padding: 25px 28px;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, 0.11);

            margin-bottom: 24px;
        }

        .summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            margin-bottom: 20px;
        }

        .summary-title h2 {
            color: var(--primary);
            font-size: 22px;
            margin-bottom: 5px;
        }

        .summary-title p {
            color: var(--muted);
            font-size: 14px;
        }

        .change-search {
            padding: 10px 16px;

            border: 1px solid var(--primary);
            border-radius: 7px;

            color: var(--primary);

            font-size: 14px;
            font-weight: bold;

            transition: 0.2s;
        }

        .change-search:hover {
            background: var(--primary);
            color: white;
        }

        .trip-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .summary-item {
            background: #f7faff;

            border: 1px solid #e2ebf4;
            border-radius: 10px;

            padding: 15px;
        }

        .summary-label {
            display: block;

            color: var(--muted);
            font-size: 12px;

            margin-bottom: 5px;
        }

        .summary-value {
            display: block;

            color: var(--primary);

            font-size: 16px;
            font-weight: bold;
        }

        /* =====================================================
           FLIGHT SECTION
        ===================================================== */

        .flight-section {
            background: white;

            border-radius: 15px;

            padding: 26px;

            box-shadow:
                0 7px 25px rgba(0, 0, 0, 0.07);

            margin-bottom: 25px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            margin-bottom: 22px;

            padding-bottom: 17px;

            border-bottom: 1px solid #edf0f3;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .direction-badge {
            min-width: 38px;
            height: 38px;

            padding: 0 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: var(--primary);
            color: white;

            font-size: 12px;
            font-weight: 800;
        }

        .section-heading h2 {
            color: var(--primary);

            font-size: 21px;
            margin-bottom: 3px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 13px;
        }

        .date-label {
            padding: 8px 12px;

            border-radius: 7px;

            background: #eef5fb;
            color: var(--primary);

            font-size: 13px;
            font-weight: bold;
        }

        /* =====================================================
           FLIGHT CARDS
        ===================================================== */

        .flight-list {
            display: grid;
            gap: 16px;
        }

        .flight-card {
            border: 1px solid var(--border);
            border-radius: 13px;

            padding: 20px;

            display: grid;
            grid-template-columns:
                120px
                1fr
                170px
                145px;

            gap: 20px;
            align-items: center;

            transition: 0.2s;
        }

        .flight-card:hover {
            border-color: #b9cfe1;

            box-shadow:
                0 7px 22px rgba(0, 59, 112, 0.08);

            transform: translateY(-2px);
        }

        .flight-code {
            color: var(--primary);

            font-size: 17px;
            font-weight: 800;
        }

        .flight-code small {
            display: block;

            margin-top: 4px;

            color: var(--muted);

            font-size: 11px;
            font-weight: normal;
        }

        .route-info {
            display: grid;
            grid-template-columns: 1fr 80px 1fr;
            gap: 12px;
            align-items: center;
        }

        .airport {
            min-width: 0;
        }

        .airport:last-child {
            text-align: right;
        }

        .flight-time {
            display: block;

            color: #111827;

            font-size: 23px;
            font-weight: 800;

            margin-bottom: 3px;
        }

        .airport-name {
            display: block;

            color: var(--muted);

            font-size: 13px;

            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .route-line {
            text-align: center;
        }

        .route-line-bar {
            width: 100%;
            height: 2px;

            background: #cbd5df;

            position: relative;

            margin-bottom: 6px;
        }

        .route-line-bar::before,
        .route-line-bar::after {
            content: "";

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: var(--primary);

            position: absolute;
            top: -3px;
        }

        .route-line-bar::before {
            left: 0;
        }

        .route-line-bar::after {
            right: 0;
        }

        .route-line span {
            color: var(--muted);
            font-size: 11px;
        }

        .price-box {
            text-align: right;
        }

        .price-label {
            display: block;

            color: var(--muted);
            font-size: 12px;

            margin-bottom: 4px;
        }

        .price {
            color: var(--danger);

            font-size: 20px;
            font-weight: 800;
        }

        .price small {
            font-size: 12px;
            font-weight: normal;
        }

        .seat-box {
            text-align: right;
        }

        .seat-count {
            font-size: 14px;
            font-weight: bold;

            margin-bottom: 6px;
        }

        .status {
            display: inline-block;

            padding: 5px 9px;
            border-radius: 20px;

            font-size: 11px;
            font-weight: bold;
        }

        .status.available {
            background: #e7f7ef;
            color: var(--success);
        }

        .status.warning {
            background: #fff4dc;
            color: var(--warning);
        }

        .status.full {
            background: #fde9eb;
            color: var(--danger);
        }

        .action-box {
            grid-column: 1 / -1;

            display: flex;
            justify-content: flex-end;

            padding-top: 16px;

            border-top: 1px solid #edf0f3;
        }

        .select-button {
            min-width: 165px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 11px 18px;

            border-radius: 7px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    #006ac1
                );

            color: white;

            font-size: 14px;
            font-weight: bold;

            transition: 0.2s;
        }

        .select-button:hover {
            transform: translateY(-1px);

            box-shadow:
                0 6px 16px rgba(0, 59, 112, 0.2);
        }

        .disabled {
            color: #8a949f;

            font-size: 13px;
            font-weight: bold;
        }

        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            border: 1px dashed #e1b94c;

            background: #fff9e9;

            padding: 24px;

            border-radius: 10px;

            text-align: center;

            color: #725a17;
            font-size: 14px;
        }

        /* =====================================================
           BOTTOM
        ===================================================== */

        .bottom-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 15px;
        }

        .back-home {
            color: var(--primary);

            font-size: 14px;
            font-weight: bold;
        }

        .back-home:hover {
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

            margin-bottom: 8px;
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

            .flight-card {
                grid-template-columns: 100px 1fr 150px;
            }

            .seat-box {
                grid-column: 1 / -1;

                text-align: left;

                padding-top: 12px;

                border-top: 1px solid #edf0f3;
            }
        }

        @media (max-width: 760px) {

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
                font-size: 31px;
            }

            .summary-top,
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .trip-summary {
                grid-template-columns: 1fr;
            }

            .flight-card {
                grid-template-columns: 1fr;
            }

            .route-info {
                grid-template-columns: 1fr;
            }

            .airport:last-child {
                text-align: left;
            }

            .route-line {
                display: none;
            }

            .price-box,
            .seat-box {
                text-align: left;
            }

            .seat-box {
                grid-column: auto;
            }

            .action-box {
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

        <div class="top-bar-group">

            <span>
                Website đặt vé máy bay trực tuyến
            </span>

            <span>
                Hỗ trợ: 1900 6868
            </span>

        </div>


        <div class="top-bar-group">

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
                Kết quả chuyến bay
            </span>

        </div>


        <h1>
            Chọn chuyến bay
        </h1>

        <p>
            Xem các chuyến bay phù hợp với hành trình
            và lựa chọn chuyến bạn muốn tiếp tục đặt vé.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    {{-- ========================================================= --}}
    {{-- THÔNG TIN TÌM KIẾM --}}
    {{-- ========================================================= --}}

    <div class="summary-card">

        <div class="summary-top">

            <div class="summary-title">

                <h2>
                    Thông tin hành trình
                </h2>

                <p>
                    Kiểm tra lại thông tin trước khi chọn chuyến bay.
                </p>

            </div>


            <a
                href="{{ route('flights.search.form') }}"
                class="change-search"
            >
                Thay đổi tìm kiếm
            </a>

        </div>


        <div class="trip-summary">

            <div class="summary-item">

                <span class="summary-label">
                    Hành trình
                </span>

                <span class="summary-value">

                    @if(($tripType ?? 'one_way') === 'round_trip')
                        Khứ hồi
                    @else
                        Một chiều
                    @endif

                </span>

            </div>


            <div class="summary-item">

                <span class="summary-label">
                    Ngày đi
                </span>

                <span class="summary-value">

                    {{ \Carbon\Carbon::parse(
                        $flightDate
                    )->format('d/m/Y') }}

                </span>

            </div>


            @if(($tripType ?? 'one_way') === 'round_trip')

                <div class="summary-item">

                    <span class="summary-label">
                        Ngày về
                    </span>

                    <span class="summary-value">

                        {{ \Carbon\Carbon::parse(
                            $returnDate
                        )->format('d/m/Y') }}

                    </span>

                </div>

            @else

                <div class="summary-item">

                    <span class="summary-label">
                        Trạng thái
                    </span>

                    <span class="summary-value">
                        Sẵn sàng chọn chuyến
                    </span>

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CHUYẾN ĐI --}}
    {{-- ========================================================= --}}

    <section class="flight-section">

        <div class="section-header">

            <div class="section-heading">

                <div class="direction-badge">
                    ĐI
                </div>

                <div>

                    <h2>
                        Chuyến đi
                    </h2>

                    <p>
                        Chọn chuyến bay cho chiều khởi hành.
                    </p>

                </div>

            </div>


            <div class="date-label">

                {{ \Carbon\Carbon::parse(
                    $flightDate
                )->format('d/m/Y') }}

            </div>

        </div>


        @if($outboundFlights->count() > 0)

            <div class="flight-list">

                @foreach($outboundFlights as $flight)

                    @php

                        $totalSeats =
                            $flight->flightSeats->count();

                        $bookedSeats =
                            $flight->flightSeats
                                ->where(
                                    'status',
                                    'booked'
                                )
                                ->count();

                        $availableSeats =
                            $totalSeats - $bookedSeats;

                    @endphp


                    <div class="flight-card">

                        {{-- MÃ CHUYẾN --}}

                        <div class="flight-code">

                            {{ $flight->flight_code }}

                            <small>
                                Mã chuyến bay
                            </small>

                        </div>


                        {{-- HÀNH TRÌNH --}}

                        <div class="route-info">

                            <div class="airport">

                                <span class="flight-time">
                                    {{ $flight->departure_time }}
                                </span>

                                <span class="airport-name">
                                    {{ $flight->departureAirport->city }}
                                </span>

                            </div>


                            <div class="route-line">

                                <div class="route-line-bar"></div>

                                <span>
                                    Bay thẳng
                                </span>

                            </div>


                            <div class="airport">

                                <span class="flight-time">
                                    {{ $flight->arrival_time }}
                                </span>

                                <span class="airport-name">
                                    {{ $flight->arrivalAirport->city }}
                                </span>

                            </div>

                        </div>


                        {{-- GIÁ --}}

                        <div class="price-box">

                            <span class="price-label">
                                Giá từ
                            </span>

                            <div class="price">

                                {{ number_format(
                                    $flight->price,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                                <small>đ</small>

                            </div>

                        </div>


                        {{-- GHẾ --}}

                        <div class="seat-box">

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


                        {{-- BUTTON --}}

                        <div class="action-box">

                            @if($availableSeats > 0)

                                <a
                                    href="{{ route(
                                        'seats.show',
                                        [
                                            'flight' => $flight->id,
                                            'leg' => 'outbound',
                                        ]
                                    ) }}"
                                    class="select-button"
                                >
                                    Chọn chuyến đi
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

                Không tìm thấy chuyến đi phù hợp với ngày
                và hành trình bạn đã chọn.

            </div>

        @endif

    </section>


    {{-- ========================================================= --}}
    {{-- CHUYẾN VỀ --}}
    {{-- ========================================================= --}}

    @if(($tripType ?? 'one_way') === 'round_trip')

        <section class="flight-section">

            <div class="section-header">

                <div class="section-heading">

                    <div class="direction-badge">
                        VỀ
                    </div>

                    <div>

                        <h2>
                            Chuyến về
                        </h2>

                        <p>
                            Chọn chuyến bay cho chiều trở về.
                        </p>

                    </div>

                </div>


                <div class="date-label">

                    {{ \Carbon\Carbon::parse(
                        $returnDate
                    )->format('d/m/Y') }}

                </div>

            </div>


            @if($returnFlights->count() > 0)

                <div class="flight-list">

                    @foreach($returnFlights as $flight)

                        @php

                            $totalSeats =
                                $flight->flightSeats->count();

                            $bookedSeats =
                                $flight->flightSeats
                                    ->where(
                                        'status',
                                        'booked'
                                    )
                                    ->count();

                            $availableSeats =
                                $totalSeats - $bookedSeats;

                        @endphp


                        <div class="flight-card">

                            <div class="flight-code">

                                {{ $flight->flight_code }}

                                <small>
                                    Mã chuyến bay
                                </small>

                            </div>


                            <div class="route-info">

                                <div class="airport">

                                    <span class="flight-time">
                                        {{ $flight->departure_time }}
                                    </span>

                                    <span class="airport-name">
                                        {{ $flight->departureAirport->city }}
                                    </span>

                                </div>


                                <div class="route-line">

                                    <div class="route-line-bar"></div>

                                    <span>
                                        Bay thẳng
                                    </span>

                                </div>


                                <div class="airport">

                                    <span class="flight-time">
                                        {{ $flight->arrival_time }}
                                    </span>

                                    <span class="airport-name">
                                        {{ $flight->arrivalAirport->city }}
                                    </span>

                                </div>

                            </div>


                            <div class="price-box">

                                <span class="price-label">
                                    Giá từ
                                </span>

                                <div class="price">

                                    {{ number_format(
                                        $flight->price,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                    <small>đ</small>

                                </div>

                            </div>


                            <div class="seat-box">

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


                            <div class="action-box">

                                @if($availableSeats > 0)

                                    <a
                                        href="{{ route(
                                            'seats.show',
                                            [
                                                'flight' => $flight->id,
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

                    Không tìm thấy chuyến về phù hợp với ngày
                    và hành trình bạn đã chọn.

                </div>

            @endif

        </section>

    @endif


    {{-- ========================================================= --}}
    {{-- QUAY LẠI --}}
    {{-- ========================================================= --}}

    <div class="bottom-actions">

        <a
            href="{{ route('flights.search.form') }}"
            class="back-home"
        >
            ← Quay lại tìm chuyến
        </a>


        <a
            href="{{ route('trang-chu') }}"
            class="back-home"
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
        Sky<span>Go</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>

</html>