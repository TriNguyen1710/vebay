
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin hành khách - Vietjet</title>

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
        input,
        select {
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
            max-width: 650px;
            color: #e3ebf3;
            font-size: 15px;
            line-height: 1.6;
        }

        .main {
            max-width: 1120px;
            margin: -48px auto 70px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

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

        .step.active .step-number {
            background: var(--primary);
            color: white;
        }

        .step.done .step-number {
            background: #176a53;
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

        .card {
            background: white;
            border-radius: 14px;
            padding: 26px;
            box-shadow: 0 7px 28px rgba(0, 0, 0, .08);
            margin-bottom: 22px;
        }

        .card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            padding-bottom: 18px;
            margin-bottom: 20px;
            border-bottom: 1px solid #edf0f3;
        }

        .card-header h2,
        .form-card-header h2 {
            color: var(--primary);
            font-size: 22px;
            margin-bottom: 5px;
        }

        .card-header p,
        .form-card-header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .trip-badge {
            padding: 7px 12px;
            background: var(--primary);
            color: white;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .alert-error {
            background: #fdebed;
            border: 1px solid #efbec4;
            color: #842029;
            padding: 13px 15px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-error ul {
            margin: 8px 0 0 18px;
        }

        .flight-section {
            margin-top: 22px;
        }

        .flight-section + .flight-section {
            border-top: 1px solid #e8edf1;
            margin-top: 25px;
            padding-top: 25px;
        }

        .flight-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .direction {
            min-width: 37px;
            height: 34px;
            padding: 0 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            background: var(--primary);
            color: white;
            font-size: 10px;
            font-weight: 800;
        }

        .direction.return {
            background: #176a53;
        }

        .flight-heading h3 {
            color: var(--primary);
            font-size: 17px;
        }

        .flight-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .info-box {
            padding: 14px 15px;
            background: #f8fafc;
            border: 1px solid #e4e9ee;
            border-radius: 7px;
        }

        .info-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 5px;
        }

        .info-value {
            color: #263746;
            font-size: 14px;
            font-weight: bold;
        }

        .price {
            color: #b42318;
            font-size: 15px;
            font-weight: 800;
        }

        .total-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-top: 22px;
            padding: 17px 18px;
            background: #fff9e8;
            border: 1px solid #ecd994;
            border-left: 4px solid var(--secondary);
            border-radius: 7px;
        }

        .total-box span {
            color: #665723;
            font-size: 13px;
        }

        .total-price {
            color: #b42318;
            font-size: 20px;
            font-weight: 800;
            white-space: nowrap;
        }

        .form-card {
            padding: 0;
            overflow: hidden;
        }

        .form-card-header {
            padding: 25px 27px 20px;
            border-bottom: 1px solid #e8edf1;
        }

        .form-body {
            padding: 26px 27px 28px;
        }

        .roundtrip-note {
            margin-bottom: 22px;
            padding: 12px 14px;
            background: #f2f7fb;
            border-left: 3px solid var(--primary);
            color: #52606d;
            font-size: 13px;
            line-height: 1.5;
        }

        .form-section-title {
            color: #354657;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin: 22px 0 17px;
        }

        .form-section-title:first-child {
            margin-top: 0;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            color: #374151;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            height: 45px;
            padding: 0 13px;
            border: 1px solid #ccd4dc;
            border-radius: 6px;
            background: white;
            color: #202b35;
            font-size: 14px;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, .08);
        }

        .file-control {
            height: auto;
            min-height: 48px;
            padding: 9px 10px;
        }

        .upload-box {
            padding: 18px;
            background: #f8fbfe;
            border: 1px dashed #9eb5ca;
            border-radius: 9px;
        }

        .upload-box strong {
            display: block;
            color: var(--primary);
            font-size: 14px;
            margin-bottom: 7px;
        }

        .field-note {
            display: block;
            color: #8a9299;
            font-size: 11px;
            margin-top: 6px;
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding-top: 21px;
            border-top: 1px solid #e8edf1;
        }

        .back-button {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .continue-button {
            min-width: 260px;
            border: none;
            border-radius: 6px;
            padding: 13px 20px;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .continue-button:hover {
            background: var(--primary-dark);
        }

        /* PHẦN MỚI: NHÓM HÀNH KHÁCH */

        .passenger-card {
            margin-bottom: 25px;
            border: 1px solid #dce6ef;
            border-radius: 10px;
            overflow: hidden;
            background: white;
        }

        .passenger-card-heading {
            padding: 17px 20px;
            background: #f2f7fc;
            border-bottom: 1px solid #dce6ef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .passenger-card-heading h3 {
            color: var(--primary);
            font-size: 17px;
        }

        .passenger-card-body {
            padding: 20px;
        }

        .passenger-seat-label {
            display: inline-block;
            padding: 7px 12px;
            color: #176a53;
            background: #e8f7f0;
            border: 1px solid #c8ead7;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .passenger-summary {
            padding: 12px 15px;
            margin-bottom: 20px;
            background: #eef5fb;
            border-left: 3px solid var(--primary);
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
        }

        .old-image-note {
            margin-top: 10px;
            padding: 10px 12px;
            background: #e9f7ef;
            border: 1px solid #c6e7d2;
            border-radius: 6px;
            font-size: 12px;
            color: #176a53;
        }

        .old-image-note a {
            color: #005caa;
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

        @media (max-width: 850px) {
            .nav-menu {
                display: none;
            }

            .flight-grid {
                grid-template-columns: 1fr 1fr;
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

            .card-header,
            .total-box,
            .form-actions {
                flex-direction: column;
                align-items: flex-start;
            }

            .flight-grid,
            .form-row {
                grid-template-columns: 1fr;
            }

            .continue-button {
                width: 100%;
                min-width: 0;
            }

            .back-button {
                width: 100%;
                text-align: center;
            }

            .steps {
                display: none;
            }

            .passenger-card-body {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

{{-- TOP BAR --}}

<div class="top-bar">
    <div class="top-bar-inner">

        <div class="top-group">
            <span>Website đặt vé máy bay trực tuyến</span>
            <span>Hỗ trợ: 1900 6868</span>
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

            <a
                href="{{ route('flights.search.form') }}"
                class="nav-link active"
            >
                Đặt vé
            </a>

            @auth
                <a href="{{ route('tickets.mine') }}" class="nav-link">
                    Lịch sử vé
                </a>

                <a href="{{ route('notifications.index') }}" class="nav-link">
                    Thông báo
                </a>
            @endauth

            <a href="{{ route('contact') }}" class="nav-link">
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

                    <button type="submit" class="logout-btn">
                        Đăng xuất
                    </button>
                </form>
            @endauth

        </div>

    </nav>
</header>

{{-- BANNER --}}

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

            <span>Thông tin hành khách</span>

        </div>

        <h1>Thông tin hành khách</h1>

        <p>
            Nhập chính xác thông tin và hình ảnh CCCD
            của từng hành khách để tiếp tục bước chọn hành lý.
        </p>

    </div>

</section>

{{-- MAIN --}}

<main class="main">

    {{-- THANH TIẾN TRÌNH --}}

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

        <div class="step active">
            <div class="step-number">3</div>
            <div class="step-text">Hành khách</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
            <div class="step-number">4</div>
            <div class="step-text">Hành lý</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
            <div class="step-number">5</div>
            <div class="step-text">Khuôn mặt</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
            <div class="step-number">6</div>
            <div class="step-text">Thanh toán</div>
        </div>

    </div>

    {{-- THÔNG TIN HÀNH TRÌNH --}}

    <section class="card">

        <div class="card-header">

            <div>
                <h2>Hành trình đã chọn</h2>

                <p>
                    Kiểm tra chuyến bay và các ghế
                    trước khi nhập thông tin hành khách.
                </p>
            </div>

            <div class="trip-badge">
                @if(($tripType ?? 'one_way') === 'round_trip')
                    KHỨ HỒI
                @else
                    MỘT CHIỀU
                @endif
            </div>

        </div>

        {{-- HIỂN THỊ LỖI --}}

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <strong>Vui lòng kiểm tra lại:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="passenger-summary">
            Số lượng hành khách:
            {{ $passengerCount }} người
            — {{ $passengerCount }} vé mỗi chiều
        </div>

        @php
            /*
             * Tính tổng tiền từ tất cả ghế đã chọn.
             * Tổng này chưa bao gồm hành lý.
             */
            $totalPrice = 0;

            if ($tripType === 'round_trip') {
                foreach ($outboundSeats as $selectedSeat) {
                    $totalPrice +=
                        (float) $outboundFlight->price
                        +
                        (
                            $selectedSeat->seat_class === 'vip'
                                ? (float) $outboundFlight->vip_surcharge
                                : 0
                        );
                }

                foreach ($returnSeats as $selectedSeat) {
                    $totalPrice +=
                        (float) $returnFlight->price
                        +
                        (
                            $selectedSeat->seat_class === 'vip'
                                ? (float) $returnFlight->vip_surcharge
                                : 0
                        );
                }
            } else {
                foreach ($seats as $selectedSeat) {
                    $totalPrice +=
                        (float) $flight->price
                        +
                        (
                            $selectedSeat->seat_class === 'vip'
                                ? (float) $flight->vip_surcharge
                                : 0
                        );
                }
            }
        @endphp

        {{-- CHIỀU ĐI --}}

        <div class="flight-section">

            <div class="flight-heading">
                <div class="direction">ĐI</div>

                <h3>
                    {{ $tripType === 'round_trip'
                        ? 'Chuyến đi'
                        : 'Chuyến bay' }}
                </h3>
            </div>

            @php
                $displayOutboundFlight =
                    $tripType === 'round_trip'
                        ? $outboundFlight
                        : $flight;

                $displayOutboundSeats =
                    $tripType === 'round_trip'
                        ? $outboundSeats
                        : $seats;
            @endphp

            <div class="flight-grid">

                <div class="info-box">
                    <span class="info-label">Mã chuyến</span>

                    <span class="info-value">
                        {{ $displayOutboundFlight->flight_code }}
                    </span>
                </div>

                <div class="info-box">
                    <span class="info-label">Hành trình</span>

                    <span class="info-value">
                        {{ $displayOutboundFlight->departureAirport->city }}
                        →
                        {{ $displayOutboundFlight->arrivalAirport->city }}
                    </span>
                </div>

                <div class="info-box">
                    <span class="info-label">Ngày bay</span>

                    <span class="info-value">
                        {{ $displayOutboundFlight->flight_date->format('d/m/Y') }}
                    </span>
                </div>

                <div class="info-box">
                    <span class="info-label">Giờ đi</span>

                    <span class="info-value">
                        {{ $displayOutboundFlight->departure_time }}
                    </span>
                </div>

                <div class="info-box">
                    <span class="info-label">
                        Các ghế chiều đi
                    </span>

                    <span class="info-value">
                        {{ $displayOutboundSeats
                            ->pluck('seat_number')
                            ->implode(', ') }}
                    </span>
                </div>

                <div class="info-box">
                    <span class="info-label">
                        Số lượng ghế
                    </span>

                    <span class="info-value">
                        {{ $displayOutboundSeats->count() }} ghế
                    </span>
                </div>

            </div>

        </div>

        {{-- CHIỀU VỀ --}}

        @if($tripType === 'round_trip')

            <div class="flight-section">

                <div class="flight-heading">
                    <div class="direction return">VỀ</div>
                    <h3>Chuyến về</h3>
                </div>

                <div class="flight-grid">

                    <div class="info-box">
                        <span class="info-label">
                            Mã chuyến
                        </span>

                        <span class="info-value">
                            {{ $returnFlight->flight_code }}
                        </span>
                    </div>

                    <div class="info-box">
                        <span class="info-label">
                            Hành trình
                        </span>

                        <span class="info-value">
                            {{ $returnFlight->departureAirport->city }}
                            →
                            {{ $returnFlight->arrivalAirport->city }}
                        </span>
                    </div>

                    <div class="info-box">
                        <span class="info-label">
                            Ngày bay
                        </span>

                        <span class="info-value">
                            {{ $returnFlight->flight_date->format('d/m/Y') }}
                        </span>
                    </div>

                    <div class="info-box">
                        <span class="info-label">
                            Giờ đi
                        </span>

                        <span class="info-value">
                            {{ $returnFlight->departure_time }}
                        </span>
                    </div>

                    <div class="info-box">
                        <span class="info-label">
                            Các ghế chiều về
                        </span>

                        <span class="info-value">
                            {{ $returnSeats
                                ->pluck('seat_number')
                                ->implode(', ') }}
                        </span>
                    </div>

                    <div class="info-box">
                        <span class="info-label">
                            Số lượng ghế
                        </span>

                        <span class="info-value">
                            {{ $returnSeats->count() }} ghế
                        </span>
                    </div>

                </div>

            </div>

        @endif

        {{-- TỔNG TIỀN --}}

        <div class="total-box">

            <span>
                Tổng tiền dự kiến cho
                {{ $passengerCount }} hành khách
                {{ $tripType === 'round_trip'
                    ? '(cả chiều đi và chiều về)'
                    : '(một chiều)' }}
            </span>

            <strong class="total-price">
                {{ number_format(
                    $totalPrice,
                    0,
                    ',',
                    '.'
                ) }} đ
            </strong>

        </div>

    </section>

    {{-- FORM THÔNG TIN HÀNH KHÁCH --}}

    <section class="card form-card">

        <div class="form-card-header">

            <h2>Thông tin hành khách</h2>

            <p>
                Vui lòng nhập thông tin trùng khớp
                với CCCD hoặc hộ chiếu của từng hành khách.
            </p>

        </div>

        <div class="form-body">

            @if($tripType === 'round_trip')
                <div class="roundtrip-note">
                    Mỗi hành khách sử dụng cùng một bộ
                    thông tin cá nhân cho
                    <strong>
                        cả chuyến đi và chuyến về
                    </strong>.
                </div>
            @endif

            <form
                action="{{ route('passenger.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                {{-- HIỂN THỊ 1–5 FORM HÀNH KHÁCH --}}

                @for($i = 0; $i < $passengerCount; $i++)

                    @php
                        $person = $passengers[$i] ?? [];

                        $outboundSeatForPerson =
                            $tripType === 'round_trip'
                                ? $outboundSeats->values()->get($i)
                                : $seats->values()->get($i);

                        $returnSeatForPerson =
                            $tripType === 'round_trip'
                                ? $returnSeats->values()->get($i)
                                : null;

                        $namePrefix = "passengers[{$i}]";
                    @endphp

                    <div class="passenger-card">

                        {{-- TIÊU ĐỀ TỪNG HÀNH KHÁCH --}}

                        <div class="passenger-card-heading">

                            <h3>
                                Hành khách {{ $i + 1 }}
                            </h3>

                            <div>
                                <span class="passenger-seat-label">
                                    Ghế đi:
                                    {{ $outboundSeatForPerson->seat_number }}

                                    @if($returnSeatForPerson)
                                        | Ghế về:
                                        {{ $returnSeatForPerson->seat_number }}
                                    @endif
                                </span>
                            </div>

                        </div>

                        <div class="passenger-card-body">

                            {{-- THÔNG TIN CÁ NHÂN --}}

                            <div class="form-section-title">
                                Thông tin cá nhân
                            </div>

                            <div class="form-group">

                                <label for="full_name_{{ $i }}">
                                    Họ và tên hành khách
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="full_name_{{ $i }}"
                                    name="{{ $namePrefix }}[full_name]"
                                    class="form-control"
                                    placeholder="Ví dụ: Nguyễn Văn An"
                                    value="{{ old(
                                        "passengers.$i.full_name",
                                        $person['full_name'] ?? ''
                                    ) }}"
                                    maxlength="255"
                                    required
                                >

                            </div>

                            <div class="form-row">

                                <div class="form-group">

                                    <label for="date_of_birth_{{ $i }}">
                                        Ngày sinh
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        id="date_of_birth_{{ $i }}"
                                        name="{{ $namePrefix }}[date_of_birth]"
                                        class="form-control"
                                        value="{{ old(
                                            "passengers.$i.date_of_birth",
                                            $person['date_of_birth'] ?? ''
                                        ) }}"
                                        max="{{ now()->subDay()->format('Y-m-d') }}"
                                        required
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="gender_{{ $i }}">
                                        Giới tính
                                        <span class="required">*</span>
                                    </label>

                                    @php
                                        $selectedGender = old(
                                            "passengers.$i.gender",
                                            $person['gender'] ?? ''
                                        );
                                    @endphp

                                    <select
                                        id="gender_{{ $i }}"
                                        name="{{ $namePrefix }}[gender]"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">
                                            Chọn giới tính
                                        </option>

                                        <option
                                            value="nam"
                                            @selected($selectedGender === 'nam')
                                        >
                                            Nam
                                        </option>

                                        <option
                                            value="nu"
                                            @selected($selectedGender === 'nu')
                                        >
                                            Nữ
                                        </option>

                                        <option
                                            value="khac"
                                            @selected($selectedGender === 'khac')
                                        >
                                            Khác
                                        </option>

                                    </select>

                                </div>

                            </div>

                            {{-- SỐ CCCD --}}

                            <div class="form-group">

                                <label for="identity_number_{{ $i }}">
                                    Số CCCD hoặc hộ chiếu
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="identity_number_{{ $i }}"
                                    name="{{ $namePrefix }}[identity_number]"
                                    class="form-control"
                                    placeholder="Nhập số giấy tờ tùy thân"
                                    value="{{ old(
                                        "passengers.$i.identity_number",
                                        $person['identity_number'] ?? ''
                                    ) }}"
                                    maxlength="30"
                                    required
                                >

                            </div>

                            {{-- HÌNH ẢNH CCCD --}}

                            <div class="form-section-title">
                                Hình ảnh CCCD
                            </div>

                            <div class="form-group upload-box">

                                <strong>
                                    Tải hình ảnh CCCD của
                                    hành khách {{ $i + 1 }}
                                </strong>

                                <input
                                    type="file"
                                    id="cccd_image_{{ $i }}"
                                    name="{{ $namePrefix }}[cccd_image]"
                                    class="form-control file-control"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    {{ empty($person['cccd_image'])
                                        ? 'required'
                                        : '' }}
                                >

                                <span class="field-note">
                                    Hỗ trợ JPG, JPEG, PNG, WEBP.
                                    Dung lượng tối đa 5MB.
                                </span>

                                @if(!empty($person['cccd_image']))

                                    <div class="old-image-note">

                                        Đã có ảnh CCCD trước đó.

                                        <a
                                            href="{{ asset($person['cccd_image']) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Xem ảnh
                                        </a>

                                        — Bạn có thể chọn ảnh khác
                                        nếu muốn thay thế.

                                    </div>

                                @endif

                            </div>

                            {{-- THÔNG TIN LIÊN HỆ --}}

                            <div class="form-section-title">
                                Thông tin liên hệ
                            </div>

                            <div class="form-row">

                                <div class="form-group">

                                    <label for="phone_{{ $i }}">
                                        Số điện thoại
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="phone_{{ $i }}"
                                        name="{{ $namePrefix }}[phone]"
                                        class="form-control"
                                        placeholder="Nhập số điện thoại"
                                        value="{{ old(
                                            "passengers.$i.phone",
                                            $person['phone'] ?? ''
                                        ) }}"
                                        maxlength="20"
                                        required
                                    >

                                </div>

                                <div class="form-group">

                                    <label for="email_{{ $i }}">
                                        Email
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="email_{{ $i }}"
                                        name="{{ $namePrefix }}[email]"
                                        class="form-control"
                                        placeholder="example@email.com"
                                        value="{{ old(
                                            "passengers.$i.email",
                                            $person['email'] ?? ''
                                        ) }}"
                                        maxlength="255"
                                        required
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                @endfor

                {{-- NÚT QUAY LẠI VÀ TIẾP TỤC --}}

                <div class="form-actions">

                    @if($tripType === 'round_trip')

                        <a
                            href="{{ route('seats.show', [
                                'flight' => $returnFlight->id,
                                'leg' => 'return'
                            ]) }}"
                            class="back-button"
                        >
                            ← Quay lại chọn ghế chiều về
                        </a>

                    @else

                        <a
                            href="{{ route('seats.show', $flight->id) }}"
                            class="back-button"
                        >
                            ← Quay lại chọn ghế
                        </a>

                    @endif

                    <button
                        type="submit"
                        class="continue-button"
                    >
                        Tiếp tục chọn hành lý
                    </button>

                </div>

            </form>

        </div>

    </section>

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
