
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả chuyến bay - Vietjet</title>

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
            --danger: #e2231a;
            --success: #198754;
            --warning: #d97706;
            --light: #f4f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dfe7f0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
            line-height: 1.5;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
            cursor: pointer;
        }

        /* TOP BAR */

        .top-bar {
            background: var(--primary-dark);
            color: white;
            font-size: 13px;
        }

        .top-bar-inner {
            max-width: 1380px;
            min-height: 36px;
            margin: auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .top-bar-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a {
            color: white;
        }

        /* HEADER */

        .header {
            background: white;
            box-shadow: 0 3px 15px rgba(0,0,0,.08);
            position: relative;
            z-index: 30;
        }

        .navbar {
            max-width: 1380px;
            min-height: 76px;
            margin: auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            color: var(--primary);
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -1px;
            white-space: nowrap;
        }

        .logo span {
            color: var(--secondary);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .nav-link {
            padding: 27px 14px;
            color: #293241;
            font-size: 14px;
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

        .login-link,
        .user-name {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .logout-btn {
            padding: 9px 14px;
            border: none;
            border-radius: 7px;
            background: var(--danger);
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        /* BANNER */

        .page-banner {
            min-height: 265px;
            background:
                linear-gradient(
                    90deg,
                    rgba(0,31,58,.93),
                    rgba(0,59,112,.48)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .banner-inner {
            max-width: 1380px;
            margin: auto;
            padding: 47px 24px 110px;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            font-size: 13px;
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
            font-weight: 800;
        }

        .page-banner p {
            max-width: 650px;
            color: #e5edf5;
            font-size: 15px;
            line-height: 1.65;
        }

        /* MAIN */

        .main {
            width: 100%;
            max-width: 1360px;
            margin: -64px auto 70px;
            padding: 0 24px;
            position: relative;
            z-index: 10;
        }

        /* THÔNG TIN HÀNH TRÌNH */

        .summary-card {
            background: white;
            border: 1px solid #ebeff4;
            border-radius: 16px;
            padding: 26px 30px;
            box-shadow: 0 12px 35px rgba(0,33,72,.10);
            margin-bottom: 24px;
        }

        .summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .summary-title h2 {
            color: var(--primary);
            font-size: 23px;
            margin-bottom: 5px;
        }

        .summary-title p {
            color: var(--muted);
            font-size: 13px;
        }

        .change-search {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 41px;
            padding: 0 16px;
            border: 1px solid var(--primary);
            border-radius: 8px;
            color: var(--primary);
            background: white;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .change-search:hover {
            background: var(--primary);
            color: white;
        }

        .trip-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .summary-item {
            min-height: 82px;
            padding: 16px 18px;
            background: #f7faff;
            border: 1px solid #e2ebf4;
            border-radius: 11px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .summary-label {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 12px;
        }

        .summary-value {
            display: block;
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        /* DANH SÁCH CHUYẾN BAY */

        .flight-section {
            background: white;
            border: 1px solid #e9eef5;
            border-radius: 16px;
            padding: 27px 30px 30px;
            box-shadow: 0 7px 26px rgba(0,33,72,.06);
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 18px;
            margin-bottom: 22px;
            border-bottom: 1px solid #e9eef3;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .direction-badge {
            width: 43px;
            height: 43px;
            min-width: 43px;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
        }

        .direction-badge.return-badge {
            background: #0068ad;
        }

        .section-heading h2 {
            color: var(--primary);
            font-size: 23px;
            margin-bottom: 3px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 13px;
        }

        .section-date {
            padding: 9px 14px;
            border-radius: 8px;
            background: #eef5fb;
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .flight-list {
            display: grid;
            gap: 16px;
        }

        .flight-card {
            display: grid;
            grid-template-columns:
                minmax(100px, .8fr)
                minmax(280px, 2.5fr)
                minmax(110px, .9fr)
                minmax(135px, 1fr)
                minmax(155px, 1.2fr);
            gap: 18px;
            align-items: center;
            padding: 22px 24px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: white;
            transition: .2s;
        }

        .flight-card:hover {
            border-color: #b9cfe1;
            box-shadow: 0 8px 25px rgba(0,59,112,.09);
            transform: translateY(-2px);
        }

        .flight-code {
            color: var(--primary);
            font-size: 18px;
            font-weight: 800;
            white-space: nowrap;
        }

        .flight-code small {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
            font-weight: normal;
        }

        .route-info {
            min-width: 0;
            display: grid;
            grid-template-columns:
                minmax(0,1fr)
                70px
                minmax(0,1fr);
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
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .airport-name {
            display: block;
            color: var(--muted);
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .route-line {
            text-align: center;
        }

        .route-line-bar {
            width: 100%;
            height: 2px;
            position: relative;
            background: #cbd5df;
            margin-bottom: 8px;
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
            font-size: 10px;
            white-space: nowrap;
        }

        .price-box,
        .seat-box {
            text-align: right;
        }

        .price-label {
            display: block;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 5px;
        }

        .price {
            color: var(--danger);
            font-size: 20px;
            font-weight: 800;
            white-space: nowrap;
        }

        .price small {
            font-size: 12px;
            font-weight: normal;
        }

        .seat-count {
            color: #24364b;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
            white-space: nowrap;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status.available {
            color: var(--success);
            background: #e7f7ef;
        }

        .status.warning {
            color: var(--warning);
            background: #fff4dc;
        }

        .status.full {
            color: var(--danger);
            background: #fde9eb;
        }

        .action-box {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            min-width: 0;
        }

        .select-button {
            min-height: 43px;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 12px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), #006ac1);
            color: white;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
        }

        .select-button:hover {
            background: linear-gradient(135deg, var(--primary-dark), #00549a);
        }

        .disabled {
            color: #87929e;
            font-size: 12px;
            font-weight: bold;
        }

        .not-enough-seats {
            display: inline-block;
            padding: 9px 10px;
            border-radius: 8px;
            background: #fde9eb;
            border: 1px solid #f3c4ca;
            color: var(--danger);
            font-size: 11px;
            font-weight: bold;
        }

        /* ===================================
           CHUYẾN VỀ: CHỈ XEM, CHƯA ĐƯỢC CHỌN
        =================================== */

        .return-preview .flight-card {
            grid-template-columns:
                minmax(100px, .8fr)
                minmax(280px, 2.5fr)
                minmax(110px, .9fr)
                minmax(135px, 1fr);
        }

        .return-preview .action-box {
            display: none !important;
        }

        .return-info {
            margin: -4px 0 18px;
            padding: 12px 15px;
            border: 1px solid #dbe7f5;
            border-radius: 9px;
            background: #f3f8fe;
            color: #174a76;
            font-size: 13px;
            font-weight: 600;
        }

        /* EMPTY */

        .empty {
            padding: 28px;
            border: 1px dashed #e1b94c;
            border-radius: 10px;
            background: #fff9e9;
            text-align: center;
            color: #725a17;
            font-size: 14px;
        }

        .bottom-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        .back-home {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .back-home:hover {
            text-decoration: underline;
        }

        /* FOOTER */

        footer {
            padding: 36px 20px;
            background: #031d33;
            color: white;
            text-align: center;
        }

        .footer-logo {
            margin-bottom: 8px;
            font-size: 23px;
            font-weight: 800;
        }

        .footer-logo span {
            color: var(--secondary);
        }

        footer p {
            color: #aebdca;
            font-size: 13px;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .flight-card,
            .return-preview .flight-card {
                grid-template-columns:
                    105px minmax(240px,1fr) 120px 135px;
            }

            .action-box {
                grid-column: 1 / -1;
                padding-top: 14px;
                border-top: 1px solid #edf0f3;
            }

            .select-button {
                width: auto;
                min-width: 175px;
            }
        }

        @media (max-width: 950px) {
            .nav-menu {
                display: none;
            }

            .trip-summary {
                grid-template-columns: repeat(2,minmax(0,1fr));
            }

            .flight-card,
            .return-preview .flight-card {
                grid-template-columns:
                    minmax(100px,.7fr)
                    minmax(240px,2fr)
                    minmax(120px,1fr);
            }

            .seat-box {
                grid-column: 1 / span 2;
                text-align: left;
                padding-top: 12px;
                border-top: 1px solid #edf0f3;
            }

            .action-box {
                grid-column: 3;
                padding-top: 12px;
            }

            .select-button {
                width: 100%;
                min-width: 0;
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

            .banner-inner {
                padding: 40px 18px 95px;
            }

            .main {
                padding: 0 12px;
                margin-top: -55px;
            }

            .summary-card {
                padding: 20px 16px;
            }

            .summary-top,
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .trip-summary {
                grid-template-columns: repeat(2,minmax(0,1fr));
                gap: 10px;
            }

            .summary-item {
                padding: 12px;
                min-height: 75px;
            }

            .summary-value {
                font-size: 13px;
            }

            .flight-section {
                padding: 20px 14px;
            }

            .flight-card,
            .return-preview .flight-card {
                grid-template-columns: 1fr;
                gap: 15px;
                padding: 18px;
            }

            .flight-code,
            .route-info,
            .price-box,
            .seat-box,
            .action-box {
                grid-column: 1 / -1;
            }

            .route-info {
                grid-template-columns:
                    minmax(0,1fr) 50px minmax(0,1fr);
            }

            .flight-time {
                font-size: 19px;
            }

            .price-box,
            .seat-box {
                text-align: left;
            }

            .seat-box {
                border-top: 0;
                padding-top: 0;
            }

            .action-box {
                padding-top: 14px;
                border-top: 1px solid #edf0f3;
            }

            .select-button {
                width: 100%;
            }

            .bottom-actions {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 400px) {
            .trip-summary {
                grid-template-columns: 1fr;
            }

            .change-search {
                width: 100%;
            }
        }
    </style>
</head>

<body>

{{-- TOP BAR --}}

<div class="top-bar">
    <div class="top-bar-inner">

        <div class="top-bar-group">
            <span>Website đặt vé máy bay trực tuyến</span>
            <span>Hỗ trợ: 1900 6868</span>
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
        </div>

    </div>
</div>

{{-- HEADER --}}

<header class="header">
    <nav class="navbar">

        <a href="{{ route('trang-chu') }}" class="logo">
            Viet<span>jet</span>
        </a>

        <div class="nav-menu">
            <a href="{{ route('trang-chu') }}" class="nav-link">
                Trang chủ
            </a>

            <a href="{{ route('flights.search.form') }}"
               class="nav-link active">
                Đặt vé
            </a>

            @auth
                <a href="{{ route('tickets.mine') }}" class="nav-link">
                    Lịch sử vé
                </a>

                <a href="{{ route('notifications.index') }}"
                   class="nav-link">
                    Thông báo
                </a>
            @endauth

            <a href="{{ route('contact') }}" class="nav-link">
                Liên hệ
            </a>
        </div>

        <div class="nav-actions">
            @guest
                <a href="{{ route('dang-nhap') }}" class="login-link">
                    Đăng nhập
                </a>
            @else
                <span class="user-name">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('dang-xuat') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Đăng xuất
                    </button>
                </form>
            @endguest
        </div>

    </nav>
</header>

{{-- BANNER --}}

<section class="page-banner">
    <div class="banner-inner">

        <div class="breadcrumb">
            <a href="{{ route('trang-chu') }}">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('flights.search.form') }}">Đặt vé</a>
            <span>/</span>
            <span>Kết quả chuyến bay</span>
        </div>

        <h1>Chọn chuyến bay</h1>

        <p>
            Xem các chuyến bay phù hợp với hành trình của bạn.
            Chọn chuyến đi trước, sau đó hoàn tất ghế
            để tiếp tục chọn chuyến về.
        </p>

    </div>
</section>

{{-- MAIN --}}

<main class="main">

    @php
        $requiredSeats = (int) (
            $passengerCount
            ?? session('flight_search.passenger_count', 1)
        );

        $requiredSeats = max(1, min(5, $requiredSeats));

        $isRoundTrip = ($tripType ?? 'one_way') === 'round_trip';

        /*
         * Chỉ được true nếu Controller xác nhận
         * đã hoàn tất chọn ghế chuyến đi.
         */
        $canSelectReturn = (bool) ($canSelectReturn ?? false);
    @endphp

    {{-- THÔNG TIN HÀNH TRÌNH --}}

    <div class="summary-card">

        <div class="summary-top">

            <div class="summary-title">
                <h2>Thông tin hành trình</h2>
                <p>
                    Kiểm tra lại thông tin trước khi chọn chuyến bay.
                </p>
            </div>

            <a href="{{ route('flights.search.form') }}"
               class="change-search">
                Thay đổi tìm kiếm
            </a>

        </div>

        <div class="trip-summary">

            <div class="summary-item">
                <span class="summary-label">Hành trình</span>
                <span class="summary-value">
                    {{ $isRoundTrip ? 'Khứ hồi' : 'Một chiều' }}
                </span>
            </div>

            <div class="summary-item">
                <span class="summary-label">Ngày đi</span>
                <span class="summary-value">
                    {{ \Carbon\Carbon::parse($flightDate)->format('d/m/Y') }}
                </span>
            </div>

            <div class="summary-item">
                @if($isRoundTrip)
                    <span class="summary-label">Ngày về</span>
                    <span class="summary-value">
                        {{ \Carbon\Carbon::parse($returnDate)->format('d/m/Y') }}
                    </span>
                @else
                    <span class="summary-label">Trạng thái</span>
                    <span class="summary-value">Sẵn sàng chọn chuyến</span>
                @endif
            </div>

            <div class="summary-item">
                <span class="summary-label">Số lượng vé</span>
                <span class="summary-value">{{ $requiredSeats }} vé</span>
            </div>

        </div>
    </div>

    {{-- ===================================
         BƯỚC 1: CHỌN CHUYẾN ĐI
    =================================== --}}

    <section class="flight-section">

        <div class="section-header">
            <div class="section-heading">

                <div class="direction-badge">ĐI</div>

                <div>
                    <h2>Chuyến đi</h2>
                    <p>Chọn chuyến bay cho chiều khởi hành.</p>
                </div>

            </div>

            <div class="section-date">
                {{ \Carbon\Carbon::parse($flightDate)->format('d/m/Y') }}
            </div>
        </div>

        @if($outboundFlights->count() > 0)

            <div class="flight-list">

                @foreach($outboundFlights as $flight)

                    @php
                        $totalSeats = $flight->flightSeats->count();

                        $availableSeats = $flight->flightSeats
                            ->where('status', 'available')
                            ->count();

                        $hasEnoughSeats =
                            $availableSeats >= $requiredSeats;
                    @endphp

                    <div class="flight-card">

                        {{-- MÃ CHUYẾN --}}

                        <div class="flight-code">
                            {{ $flight->flight_code }}
                            <small>Mã chuyến bay</small>
                        </div>

                        {{-- THỜI GIAN VÀ ĐƯỜNG BAY --}}

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
                                <span>Bay thẳng</span>
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
                            <span class="price-label">Giá từ</span>
                            <div class="price">
                                {{ number_format($flight->price, 0, ',', '.') }}
                                <small>đ</small>
                            </div>
                        </div>

                        {{-- GHẾ TRỐNG --}}

                        <div class="seat-box">

                            <div class="seat-count">
                                Còn {{ $availableSeats }}
                                / {{ $totalSeats }} ghế
                            </div>

                            @if($availableSeats === 0)
                                <span class="status full">Hết ghế</span>
                            @elseif(!$hasEnoughSeats)
                                <span class="status full">Không đủ ghế</span>
                            @elseif($availableSeats <= 20)
                                <span class="status warning">Sắp hết ghế</span>
                            @else
                                <span class="status available">Còn ghế</span>
                            @endif

                        </div>

                        {{-- NÚT CHỌN CHUYẾN ĐI VẪN HIỆN --}}

                        <div class="action-box">

                            @if($hasEnoughSeats)

                                <a
                                    href="{{ route('seats.show', [
                                        'flight' => $flight->id,
                                        'leg' => 'outbound'
                                    ]) }}"
                                    class="select-button"
                                >
                                    Chọn chuyến đi
                                </a>

                            @elseif($availableSeats === 0)

                                <span class="disabled">
                                    Chuyến bay đã hết ghế
                                </span>

                            @else

                                <span class="not-enough-seats">
                                    Không đủ {{ $requiredSeats }} ghế
                                    (chỉ còn {{ $availableSeats }})
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

    {{-- ===================================
         BƯỚC 2: CHUYẾN VỀ
         CHỈ HIỆN NÚT KHI ĐƯỢC CHO PHÉP
    =================================== --}}

    @if($isRoundTrip)

        <section class="flight-section {{ !$canSelectReturn ? 'return-preview' : '' }}">

            <div class="section-header">

                <div class="section-heading">

                    <div class="direction-badge return-badge">
                        VỀ
                    </div>

                    <div>
                        <h2>Chuyến về</h2>
                        <p>
                            Xem các chuyến bay cho chiều trở về.
                        </p>
                    </div>

                </div>

                <div class="section-date">
                    {{ \Carbon\Carbon::parse($returnDate)->format('d/m/Y') }}
                </div>

            </div>

            {{-- THÔNG BÁO KHI CHƯA CHỌN XONG CHIỀU ĐI --}}

            @if(!$canSelectReturn)
                <div class="return-info">
                    Chuyến về chỉ để tham khảo.
                    Vui lòng chọn chuyến đi và hoàn tất chọn ghế
                    chiều đi trước khi chọn chuyến về.
                </div>
            @endif

            @if($returnFlights->count() > 0)

                <div class="flight-list">

                    @foreach($returnFlights as $flight)

                        @php
                            $totalSeats = $flight->flightSeats->count();

                            $availableSeats = $flight->flightSeats
                                ->where('status', 'available')
                                ->count();

                            $hasEnoughSeats =
                                $availableSeats >= $requiredSeats;
                        @endphp

                        <div class="flight-card">

                            {{-- MÃ CHUYẾN --}}

                            <div class="flight-code">
                                {{ $flight->flight_code }}
                                <small>Mã chuyến bay</small>
                            </div>

                            {{-- GIỜ BAY --}}

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
                                    <span>Bay thẳng</span>
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

                            {{-- GIÁ VÉ --}}

                            <div class="price-box">
                                <span class="price-label">Giá từ</span>

                                <div class="price">
                                    {{ number_format($flight->price, 0, ',', '.') }}
                                    <small>đ</small>
                                </div>
                            </div>

                            {{-- SỐ GHẾ TRỐNG --}}

                            <div class="seat-box">

                                <div class="seat-count">
                                    Còn {{ $availableSeats }}
                                    / {{ $totalSeats }} ghế
                                </div>

                                @if($availableSeats === 0)
                                    <span class="status full">Hết ghế</span>
                                @elseif(!$hasEnoughSeats)
                                    <span class="status full">Không đủ ghế</span>
                                @elseif($availableSeats <= 20)
                                    <span class="status warning">Sắp hết ghế</span>
                                @else
                                    <span class="status available">Còn ghế</span>
                                @endif

                            </div>

                            {{-- ======================================
                                 QUAN TRỌNG:
                                 CHƯA XONG CHUYẾN ĐI => KHÔNG CÓ NÚT
                            ====================================== --}}

                            @if($canSelectReturn)

                                <div class="action-box">

                                    @if($hasEnoughSeats)

                                        <a
                                            href="{{ route('seats.show', [
                                                'flight' => $flight->id,
                                                'leg' => 'return'
                                            ]) }}"
                                            class="select-button"
                                        >
                                            Chọn chuyến về
                                        </a>

                                    @elseif($availableSeats === 0)

                                        <span class="disabled">
                                            Chuyến bay đã hết ghế
                                        </span>

                                    @else

                                        <span class="not-enough-seats">
                                            Không đủ {{ $requiredSeats }} ghế
                                            (chỉ còn {{ $availableSeats }})
                                        </span>

                                    @endif

                                </div>

                            @endif

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

    {{-- QUAY LẠI --}}

    <div class="bottom-actions">

        <a href="{{ route('flights.search.form') }}"
           class="back-home">
            ← Quay lại tìm chuyến
        </a>

        <a href="{{ route('trang-chu') }}"
           class="back-home">
            Trang chủ
        </a>

    </div>

</main>

{{-- FOOTER --}}

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
