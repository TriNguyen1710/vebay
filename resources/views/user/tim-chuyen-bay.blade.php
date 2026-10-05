<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tìm chuyến bay - SkyGo</title>

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
            --border: #dfe5ec;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        input,
        select,
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
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-group {
            display: flex;
            gap: 20px;
            align-items: center;
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
           PAGE BANNER
        ===================================================== */

        .page-banner {
            min-height: 270px;

            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, 0.90),
                    rgba(0, 59, 112, 0.42)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');

            background-size: cover;
            background-position: center;

            color: white;
        }

        .banner-inner {
            max-width: 1240px;
            margin: auto;
            padding: 58px 20px 105px;
        }

        .breadcrumb {
            display: flex;
            gap: 9px;
            align-items: center;

            margin-bottom: 20px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #f4cf58;
        }

        .breadcrumb span {
            color: #e5e7eb;
        }

        .page-banner h1 {
            font-size: 39px;
            margin-bottom: 10px;
        }

        .page-banner p {
            max-width: 600px;
            color: #e5edf5;
            font-size: 16px;
            line-height: 1.6;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            max-width: 1120px;
            margin: -68px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        .search-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;

            box-shadow:
                0 12px 40px rgba(0, 0, 0, 0.13);
        }

        .card-header {
            padding: 27px 30px;
            border-bottom: 1px solid #e8edf2;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 23px;
            margin-bottom: 5px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 14px;
        }

        .header-line {
            width: 55px;
            height: 4px;
            border-radius: 10px;
            background: var(--secondary);
        }

        .card-body {
            padding: 30px;
        }

        /* =====================================================
           TRIP TYPE
        ===================================================== */

        .trip-type-title {
            display: block;

            margin-bottom: 11px;

            color: #4b5563;
            font-size: 13px;
            font-weight: bold;

            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .trip-options {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
        }

        .trip-option {
            position: relative;
        }

        .trip-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .trip-option label {
            min-width: 145px;

            display: flex;
            justify-content: center;
            align-items: center;
            gap: 9px;

            padding: 11px 18px;

            border: 2px solid var(--border);
            border-radius: 30px;

            color: #4b5563;
            font-size: 14px;
            font-weight: bold;

            cursor: pointer;
            transition: 0.2s;
        }

        .trip-option label:hover {
            border-color: #9db9d1;
        }

        .trip-option input:checked + label {
            border-color: var(--primary);
            background: #edf6ff;
            color: var(--primary);
        }

        .radio-circle {
            width: 16px;
            height: 16px;

            border: 2px solid #9aa4b2;
            border-radius: 50%;

            position: relative;
        }

        .trip-option input:checked + label .radio-circle {
            border-color: var(--primary);
        }

        .trip-option input:checked + label .radio-circle::after {
            content: "";

            position: absolute;
            width: 8px;
            height: 8px;

            top: 2px;
            left: 2px;

            border-radius: 50%;
            background: var(--primary);
        }

        /* =====================================================
           FORM
        ===================================================== */

        .route-grid {
            display: grid;
            grid-template-columns: 1fr 58px 1fr;
            gap: 12px;
            align-items: end;

            margin-bottom: 23px;
        }

        .date-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            width: 100%;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;

            color: #374151;
            font-size: 14px;
            font-weight: bold;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            height: 55px;

            padding: 0 15px;

            border: 1px solid var(--border);
            border-radius: 8px;

            background: white;
            color: var(--text);

            font-size: 15px;

            outline: none;
            transition: 0.2s;
        }

        .form-control:hover {
            border-color: #aebdcc;
        }

        .form-control:focus {
            border-color: var(--primary);

            box-shadow:
                0 0 0 3px rgba(0, 59, 112, 0.09);
        }

        .swap-button {
            width: 46px;
            height: 46px;

            margin: 0 auto 5px;

            border: 1px solid var(--border);
            border-radius: 50%;

            background: white;
            color: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;
            transition: 0.2s;
        }

        .swap-button:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .swap-button svg {
            width: 21px;
            height: 21px;
        }

        .return-date {
            display: none;
        }

        /* =====================================================
           ERRORS
        ===================================================== */

        .errors {
            background: #f8d7da;
            border: 1px solid #f1aeb5;
            color: #842029;

            padding: 15px 18px;
            border-radius: 9px;
            margin-bottom: 25px;
        }

        .errors strong {
            display: block;
            margin-bottom: 7px;
        }

        .errors ul {
            padding-left: 20px;
        }

        .errors li {
            margin: 4px 0;
        }

        /* =====================================================
           FORM FOOTER
        ===================================================== */

        .form-footer {
            margin-top: 30px;
            padding-top: 25px;

            border-top: 1px solid #edf0f3;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .back-btn {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        .search-btn {
            min-width: 220px;

            border: none;
            border-radius: 8px;

            padding: 15px 25px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    #006ac1
                );

            color: white;
            font-size: 15px;
            font-weight: bold;

            cursor: pointer;
            transition: 0.2s;
        }

        .search-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 20px rgba(0, 59, 112, 0.22);
        }

        /* =====================================================
           BENEFITS
        ===================================================== */

        .benefits {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;

            margin-top: 25px;
        }

        .benefit {
            background: white;

            border: 1px solid #e5e9ee;
            border-radius: 12px;

            padding: 22px;
        }

        .benefit-number {
            color: var(--secondary);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;

            margin-bottom: 9px;
        }

        .benefit h3 {
            color: var(--primary);
            font-size: 15px;
            margin-bottom: 6px;
        }

        .benefit p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            background: #031d33;
            color: white;

            padding: 38px 20px;
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

        @media (max-width: 900px) {

            .nav-menu {
                display: none;
            }

            .benefits {
                grid-template-columns: 1fr;
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
                font-size: 31px;
            }

            .route-grid {
                grid-template-columns: 1fr;
            }

            .swap-button {
                transform: rotate(90deg);
                margin: 0 auto;
            }

            .date-grid {
                grid-template-columns: 1fr;
            }

            .card-header,
            .card-body {
                padding: 22px 18px;
            }

            .form-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .search-btn {
                width: 100%;
            }

            .back-btn {
                text-align: center;
            }
        }

        @media (max-width: 480px) {

            .trip-options {
                display: grid;
                grid-template-columns: 1fr;
            }

            .trip-option label {
                width: 100%;
            }

            .logo {
                font-size: 22px;
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
            <span>Đặt vé máy bay trực tuyến</span>
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

            <span>Tiếng Việt</span>

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

            <span>
                Đặt vé
            </span>

        </div>


        <h1>
            Tìm chuyến bay
        </h1>

        <p>
            Lựa chọn hành trình, ngày bay và điểm đến
            phù hợp với kế hoạch của bạn.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    <div class="search-card">

        <div class="card-header">

            <div>

                <h2>
                    Thông tin hành trình
                </h2>

                <p>
                    Chọn chuyến một chiều hoặc khứ hồi.
                </p>

            </div>

            <div class="header-line"></div>

        </div>


        <div class="card-body">

            {{-- ================================================= --}}
            {{-- THÔNG BÁO LỖI --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div class="errors">

                    <strong>
                        Vui lòng kiểm tra lại thông tin:
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <form
                action="{{ route('flights.search') }}"
                method="GET"
            >

                {{-- ================================================= --}}
                {{-- LOẠI HÀNH TRÌNH --}}
                {{-- ================================================= --}}

                <span class="trip-type-title">
                    Loại hành trình
                </span>


                <div class="trip-options">

                    <div class="trip-option">

                        <input
                            type="radio"
                            name="trip_type"
                            id="one_way"
                            value="one_way"

                            {{ old(
                                'trip_type',
                                request(
                                    'trip_type',
                                    'one_way'
                                )
                            ) === 'one_way'
                                ? 'checked'
                                : ''
                            }}
                        >

                        <label for="one_way">

                            <span class="radio-circle"></span>

                            Một chiều

                        </label>

                    </div>


                    <div class="trip-option">

                        <input
                            type="radio"
                            name="trip_type"
                            id="round_trip"
                            value="round_trip"

                            {{ old(
                                'trip_type',
                                request('trip_type')
                            ) === 'round_trip'
                                ? 'checked'
                                : ''
                            }}
                        >

                        <label for="round_trip">

                            <span class="radio-circle"></span>

                            Khứ hồi

                        </label>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ĐIỂM ĐI / ĐIỂM ĐẾN --}}
                {{-- ================================================= --}}

                <div class="route-grid">

                    <div class="form-group">

                        <label
                            for="departure_airport_id"
                            class="form-label"
                        >
                            Điểm khởi hành
                            <span class="required">*</span>
                        </label>

                        <select
                            name="departure_airport_id"
                            id="departure_airport_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Chọn sân bay đi
                            </option>


                            @foreach($airports as $airport)

                                <option
                                    value="{{ $airport->id }}"

                                    {{ old(
                                        'departure_airport_id',
                                        request(
                                            'departure_airport_id'
                                        )
                                    ) == $airport->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $airport->city }}
                                    -
                                    {{ $airport->name }}
                                    ({{ $airport->code }})

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- NÚT ĐỔI ĐIỂM ĐI / ĐẾN --}}
                    {{-- ================================================= --}}

                    <button
                        type="button"
                        class="swap-button"
                        id="swapAirports"
                        title="Đổi điểm đi và điểm đến"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <path
                                d="M7 7H20M20 7L16.5 3.5M20 7L16.5 10.5"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M17 17H4M4 17L7.5 13.5M4 17L7.5 20.5"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </button>


                    <div class="form-group">

                        <label
                            for="arrival_airport_id"
                            class="form-label"
                        >
                            Điểm đến
                            <span class="required">*</span>
                        </label>

                        <select
                            name="arrival_airport_id"
                            id="arrival_airport_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Chọn sân bay đến
                            </option>


                            @foreach($airports as $airport)

                                <option
                                    value="{{ $airport->id }}"

                                    {{ old(
                                        'arrival_airport_id',
                                        request(
                                            'arrival_airport_id'
                                        )
                                    ) == $airport->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $airport->city }}
                                    -
                                    {{ $airport->name }}
                                    ({{ $airport->code }})

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- NGÀY BAY --}}
                {{-- ================================================= --}}

                <div class="date-grid">

                    <div class="form-group">

                        <label
                            for="flight_date"
                            class="form-label"
                        >
                            Ngày đi
                            <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            name="flight_date"
                            id="flight_date"
                            class="form-control"

                            min="{{ date('Y-m-d') }}"

                            value="{{ old(
                                'flight_date',
                                request('flight_date')
                            ) }}"

                            required
                        >

                    </div>


                    <div
                        class="form-group return-date"
                        id="returnDateGroup"
                    >

                        <label
                            for="return_date"
                            class="form-label"
                        >
                            Ngày về
                            <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            name="return_date"
                            id="return_date"
                            class="form-control"

                            min="{{ date('Y-m-d') }}"

                            value="{{ old(
                                'return_date',
                                request('return_date')
                            ) }}"
                        >

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- BUTTON --}}
                {{-- ================================================= --}}

                <div class="form-footer">

                    <a
                        href="{{ route('trang-chu') }}"
                        class="back-btn"
                    >
                        ← Quay lại trang chủ
                    </a>


                    <button
                        type="submit"
                        class="search-btn"
                    >
                        Tìm chuyến bay
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- THÔNG TIN PHỤ --}}
    {{-- ========================================================= --}}

    <div class="benefits">

        <div class="benefit">

            <div class="benefit-number">
                01
            </div>

            <h3>
                Chọn ghế trực tuyến
            </h3>

            <p>
                Xem sơ đồ ghế và lựa chọn hạng ghế
                phù hợp trước khi đặt vé.
            </p>

        </div>


        <div class="benefit">

            <div class="benefit-number">
                02
            </div>

            <h3>
                Thanh toán tiện lợi
            </h3>

            <p>
                Hỗ trợ thanh toán bằng mã QR ngân hàng
                hoặc ví điện tử MoMo.
            </p>

        </div>


        <div class="benefit">

            <div class="benefit-number">
                03
            </div>

            <h3>
                Nhận diện khuôn mặt
            </h3>

            <p>
                Hỗ trợ xác minh thông tin hành khách
                trong quá trình kiểm tra vé.
            </p>

        </div>

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
       
    </p>

</footer>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

    const oneWay =
        document.getElementById('one_way');

    const roundTrip =
        document.getElementById('round_trip');

    const returnDateGroup =
        document.getElementById('returnDateGroup');

    const returnDate =
        document.getElementById('return_date');

    const flightDate =
        document.getElementById('flight_date');

    const departureAirport =
        document.getElementById('departure_airport_id');

    const arrivalAirport =
        document.getElementById('arrival_airport_id');

    const swapButton =
        document.getElementById('swapAirports');


    /*
    |--------------------------------------------------------------------------
    | HIỂN THỊ NGÀY VỀ
    |--------------------------------------------------------------------------
    */

    function updateTripType() {

        if (roundTrip.checked) {

            returnDateGroup.style.display =
                'block';

            returnDate.required =
                true;

        } else {

            returnDateGroup.style.display =
                'none';

            returnDate.required =
                false;

            returnDate.value =
                '';
        }
    }


    oneWay.addEventListener(
        'change',
        updateTripType
    );


    roundTrip.addEventListener(
        'change',
        updateTripType
    );


    /*
    |--------------------------------------------------------------------------
    | NGÀY VỀ >= NGÀY ĐI
    |--------------------------------------------------------------------------
    */

    function updateReturnMinDate() {

        if (!flightDate.value) {
            return;
        }


        returnDate.min =
            flightDate.value;


        if (
            returnDate.value
            &&
            returnDate.value < flightDate.value
        ) {

            returnDate.value =
                '';
        }
    }


    flightDate.addEventListener(
        'change',
        updateReturnMinDate
    );


    /*
    |--------------------------------------------------------------------------
    | ĐỔI ĐIỂM ĐI / ĐẾN
    |--------------------------------------------------------------------------
    */

    swapButton.addEventListener(
        'click',
        function () {

            const departureValue =
                departureAirport.value;


            departureAirport.value =
                arrivalAirport.value;


            arrivalAirport.value =
                departureValue;

        }
    );


    /*
    |--------------------------------------------------------------------------
    | KHỞI TẠO
    |--------------------------------------------------------------------------
    */

    updateTripType();

    updateReturnMinDate();

</script>

</body>
</html>