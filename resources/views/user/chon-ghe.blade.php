<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Chọn ghế - SkyGo</title>

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
            --success: #13795b;

            --white: #ffffff;
            --page: #f5f7fa;

            --text: #1f2937;
            --muted: #6b7280;
            --border: #dfe4ea;

            --economy-border: #8aa8bf;
            --economy-bg: #ffffff;

            --vip-border: #c9a23a;
            --vip-bg: #fffdf5;

            --booked-border: #c8cdd2;
            --booked-bg: #e9ecef;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page);
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

        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            background: white;

            box-shadow:
                0 2px 12px rgba(0, 0, 0, 0.07);
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

        .login-link {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
            border: none;
            background: transparent;
            cursor: pointer;
            padding: 0;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .inline-login-overlay {
            position: fixed;
            inset: 0;
            background: rgba(3, 29, 51, 0.42);
            z-index: 4000;
            display: none;
        }

        .inline-login-overlay.show {
            display: block;
        }

        .inline-login-panel {
            position: fixed;
            top: 0;
            right: -440px;
            width: min(420px, 92vw);
            height: 100vh;
            background: white;
            z-index: 4100;
            box-shadow: -12px 0 35px rgba(0, 0, 0, 0.18);
            transition: right 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .inline-login-panel.show {
            right: 0;
        }

        .inline-login-header {
            padding: 24px 25px 18px;
            border-bottom: 1px solid #e7ebef;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .inline-login-header h3 {
            color: var(--primary);
            font-size: 22px;
            margin-bottom: 5px;
        }

        .inline-login-header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .inline-login-close {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border: 1px solid #dfe4ea;
            border-radius: 50%;
            background: white;
            color: #56616b;
            cursor: pointer;
            font-size: 20px;
            line-height: 1;
        }

        .inline-login-body {
            padding: 25px;
            overflow-y: auto;
        }

        .inline-login-note {
            padding: 13px 14px;
            margin-bottom: 20px;
            background: #fff9e8;
            border: 1px solid #ead58e;
            border-left: 4px solid var(--secondary);
            color: #665723;
            font-size: 13px;
            line-height: 1.55;
        }

        .inline-login-error {
            padding: 13px 14px;
            margin-bottom: 18px;
            background: #fdebed;
            border: 1px solid #efbcc2;
            color: #842029;
            font-size: 13px;
            line-height: 1.55;
        }

        .inline-form-group {
            margin-bottom: 17px;
        }

        .inline-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #374151;
            font-size: 13px;
            font-weight: bold;
        }

        .inline-form-control {
            width: 100%;
            height: 46px;
            padding: 0 13px;
            border: 1px solid #ccd4dc;
            border-radius: 7px;
            background: white;
            color: #202b35;
            font-size: 14px;
            outline: none;
        }

        .inline-form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.08);
        }

        .inline-login-submit {
            width: 100%;
            height: 47px;
            border: none;
            border-radius: 7px;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .inline-login-submit:hover {
            background: var(--primary-dark);
        }

        .inline-register-box {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #e7ebef;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        .inline-register-box button {
            color: var(--primary);
            border: 0;
            background: transparent;
            cursor: pointer;
            font: inherit;
            font-weight: bold;
            text-decoration: underline;
        }

        .inline-auth-switch {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .inline-auth-switch button {
            flex: 1;
            padding: 12px;
            border: 1px solid var(--primary);
            border-radius: 7px;
            color: var(--primary);
            background: white;
            font-weight: bold;
            cursor: pointer;
        }

        .inline-auth-switch button[aria-pressed="true"] {
            color: white;
            background: var(--primary);
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
            min-height: 215px;

            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, 0.94),
                    rgba(0, 59, 112, 0.56)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');

            background-size: cover;
            background-position: center;

            color: white;
        }

        .banner-inner {
            max-width: 1240px;
            margin: auto;

            padding: 45px 20px 75px;
        }

        .breadcrumb {
            display: flex;
            gap: 8px;
            align-items: center;

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
            font-size: 35px;
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
            max-width: 1120px;

            margin: -45px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        /* =====================================================
           FLIGHT CARD
        ===================================================== */

        .flight-card {
            background: white;

            border-radius: 12px;

            padding: 24px 26px;

            box-shadow:
                0 8px 28px rgba(0, 0, 0, 0.09);

            margin-bottom: 20px;
        }

        .flight-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;

            margin-bottom: 20px;
        }

        .flight-card-header h2 {
            color: var(--primary);

            font-size: 21px;
            margin-bottom: 4px;
        }

        .flight-card-header p {
            color: var(--muted);
            font-size: 13px;
        }

        .leg-badge {
            padding: 7px 12px;

            border-radius: 5px;

            background: var(--primary);
            color: white;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 0.4px;
        }

        .leg-badge.return {
            background: #176a53;
        }

        .flight-summary {
            display: grid;
            grid-template-columns: 150px 1fr 180px;
            gap: 12px;
        }

        .info-box {
            border: 1px solid #e4e9ee;

            padding: 14px 15px;

            background: #fafbfd;
        }

        .info-label {
            display: block;

            color: var(--muted);
            font-size: 10px;

            text-transform: uppercase;
            letter-spacing: 0.6px;

            margin-bottom: 5px;
        }

        .info-value {
            color: #263746;

            font-size: 15px;
            font-weight: bold;
        }

        /* =====================================================
           PRICE
        ===================================================== */

        .price-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;

            margin-top: 12px;
        }

        .fare-card {
            border: 1px solid #e1e6eb;

            padding: 14px 16px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            background: #ffffff;
        }

        .fare-vip {
            border-left: 4px solid #c9a23a;
        }

        .fare-economy {
            border-left: 4px solid var(--primary);
        }

        .fare-name {
            color: #485563;
            font-size: 13px;
            font-weight: bold;
        }

        .fare-price {
            color: #b42318;

            font-size: 17px;
            font-weight: 800;
        }

        /* =====================================================
           ERROR
        ===================================================== */

        .error {
            background: #fdebed;
            border: 1px solid #efbcc2;

            color: #842029;

            padding: 13px 15px;

            margin-bottom: 18px;
        }

        /* =====================================================
           SEAT SECTION
        ===================================================== */

        .seat-section {
            background: white;

            border-radius: 12px;

            padding: 26px;

            box-shadow:
                0 5px 22px rgba(0, 0, 0, 0.06);
        }

        .seat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;

            padding-bottom: 18px;
            margin-bottom: 18px;

            border-bottom: 1px solid #e7ebef;
        }

        .seat-header h2 {
            color: var(--primary);

            font-size: 21px;
            margin-bottom: 5px;
        }

        .seat-header p {
            color: var(--muted);
            font-size: 13px;
        }

        .seat-stats {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .stat {
            border: 1px solid #e1e6eb;

            background: #fafbfc;

            padding: 6px 9px;

            font-size: 11px;
            color: #555f68;
        }

        .stat strong {
            color: var(--primary);
        }

        /* =====================================================
           LEGEND
        ===================================================== */

        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;

            margin-bottom: 28px;

            font-size: 12px;
            color: #59636d;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-seat {
            width: 20px;
            height: 20px;

            border: 2px solid;
            border-radius: 3px;
        }

        .legend-vip {
            background: var(--vip-bg);
            border-color: var(--vip-border);
        }

        .legend-economy {
            background: white;
            border-color: var(--economy-border);
        }

        .legend-booked {
            background: var(--booked-bg);
            border-color: var(--booked-border);
        }

        .legend-selected {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* =====================================================
           CABIN
        ===================================================== */

        .cabin-container {
            max-width: 650px;
            margin: 0 auto;
        }

        .cabin {
            border-left: 1px solid #cfd6dd;
            border-right: 1px solid #cfd6dd;

            background: #fcfcfc;

            padding: 0 35px 35px;
        }

        .cabin-front {
            height: 65px;

            margin: 0 -35px 30px;

            border-top: 1px solid #cfd6dd;
            border-bottom: 1px solid #cfd6dd;

            background: #f2f4f6;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #707a83;

            font-size: 11px;
            font-weight: 700;

            letter-spacing: 1.5px;
        }

        .column-header {
            display: grid;

            grid-template-columns:
                46px 46px 46px
                45px
                34px
                45px
                46px 46px 46px;

            gap: 7px;

            justify-content: center;

            margin-bottom: 12px;

            color: #69737d;

            font-size: 11px;
            font-weight: 700;

            text-align: center;
        }

        .seat-zone-title {
            display: flex;
            align-items: center;
            gap: 12px;

            margin: 25px 0 15px;

            color: #59636d;

            font-size: 11px;
            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 1px;
        }

        .seat-zone-title::before,
        .seat-zone-title::after {
            content: "";

            flex: 1;
            height: 1px;

            background: #dfe4e9;
        }

        .seat-row {
            display: grid;

            grid-template-columns:
                46px 46px 46px
                45px
                34px
                45px
                46px 46px 46px;

            justify-content: center;
            align-items: center;

            gap: 7px;

            margin-bottom: 8px;
        }

        .row-number {
            grid-column: 5;

            color: #89929a;

            font-size: 11px;
            font-weight: bold;

            text-align: center;
        }

        .aisle-left,
        .aisle-right {
            height: 100%;
        }

        /* =====================================================
           SEAT
        ===================================================== */

        .seat-wrapper {
            position: relative;
        }

        .seat-wrapper input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .seat {
            width: 46px;
            height: 42px;

            border: 1.5px solid;

            border-radius: 4px;

            display: flex;
            align-items: center;
            justify-content: center;

            position: relative;

            background: white;

            cursor: pointer;

            font-size: 11px;
            font-weight: 700;

            transition: 0.15s;
        }

        .seat::before {
            content: "";

            position: absolute;

            left: 5px;
            right: 5px;
            bottom: 5px;

            height: 3px;

            background: currentColor;

            opacity: 0.17;

            border-radius: 1px;
        }

        .seat::after {
            content: "";

            position: absolute;

            top: 5px;
            left: 7px;
            right: 7px;

            height: 1px;

            background: currentColor;

            opacity: 0.12;
        }

        .seat-economy {
            background: var(--economy-bg);
            border-color: var(--economy-border);
            color: #436276;
        }

        .seat-vip {
            background: var(--vip-bg);
            border-color: var(--vip-border);
            color: #755d1b;
        }

        .seat-booked {
            background: var(--booked-bg);
            border-color: var(--booked-border);
            color: #a0a6ab;

            cursor: not-allowed;
        }

        .seat-wrapper input:not(:disabled) + .seat:hover {
            border-color: var(--primary);

            box-shadow:
                0 0 0 2px rgba(0, 59, 112, 0.08);
        }

        .seat-wrapper input:checked + .seat {
            background: var(--primary);
            border-color: var(--primary);
            color: white;

            box-shadow:
                0 0 0 3px rgba(0, 59, 112, 0.11);
        }

        .seat-class-text {
            display: none;
        }

        /* =====================================================
           SELECTED
        ===================================================== */

        .selected-info {
            display: none;

            margin-top: 24px;

            border: 1px solid #ceddd5;
            border-left: 4px solid var(--success);

            background: #f7fbf9;

            padding: 17px 18px;
        }

        .selected-title {
            color: #17643d;

            font-size: 13px;
            font-weight: bold;

            margin-bottom: 12px;
        }

        .selected-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .selected-label {
            display: block;

            color: #708078;

            font-size: 10px;

            text-transform: uppercase;

            margin-bottom: 4px;
        }

        .selected-value {
            color: #1d4934;

            font-size: 15px;
            font-weight: 800;
        }

        /* =====================================================
           ACTIONS
        ===================================================== */

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;

            margin-top: 25px;
            padding-top: 20px;

            border-top: 1px solid #e7ebef;
        }

        .back-button {
            color: var(--primary);

            font-size: 14px;
            font-weight: bold;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .continue-button {
            min-width: 270px;

            border: 0;
            border-radius: 6px;

            background: var(--primary);
            color: white;

            padding: 13px 20px;

            cursor: pointer;

            font-size: 14px;
            font-weight: bold;
        }

        .continue-button:hover {
            background: var(--primary-dark);
        }

        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            background: #031d33;
            color: white;

            padding: 34px 20px;

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

        @media (max-width: 850px) {

            .nav-menu {
                display: none;
            }

            .flight-summary,
            .price-grid {
                grid-template-columns: 1fr;
            }

            .seat-header {
                flex-direction: column;
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

            .cabin {
                padding-left: 10px;
                padding-right: 10px;
            }

            .cabin-front {
                margin-left: -10px;
                margin-right: -10px;
            }

            .column-header,
            .seat-row {
                grid-template-columns:
                    38px 38px 38px
                    20px
                    25px
                    20px
                    38px 38px 38px;

                gap: 4px;
            }

            .seat {
                width: 38px;
                height: 38px;

                font-size: 9px;
            }

            .selected-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .continue-button {
                width: 100%;
                min-width: 0;
            }

            .back-button {
                text-align: center;
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

                <button
                    type="button"
                    class="login-link inline-login-open"
                    id="openInlineLogin"
                >
                    Đăng nhập
                </button>

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
                Chọn ghế
            </span>

        </div>


        <h1>

            @if(
                ($tripType ?? 'one_way') === 'round_trip'
                &&
                ($leg ?? 'outbound') === 'return'
            )

                Chọn ghế chiều về

            @elseif(
                ($tripType ?? 'one_way') === 'round_trip'
            )

                Chọn ghế chiều đi

            @else

                Chọn ghế của bạn

            @endif

        </h1>


        <p>
            Chọn vị trí ghế phù hợp trước khi tiếp tục
            nhập thông tin hành khách.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    {{-- ========================================================= --}}
    {{-- THÔNG TIN CHUYẾN BAY --}}
    {{-- ========================================================= --}}

    <div class="flight-card">

        <div class="flight-card-header">

            <div>

                <h2>
                    Thông tin chuyến bay
                </h2>

                <p>
                    Kiểm tra lại hành trình trước khi chọn ghế.
                </p>

            </div>


            @if(($tripType ?? 'one_way') === 'round_trip')

                @if(($leg ?? 'outbound') === 'return')

                    <div class="leg-badge return">
                        KHỨ HỒI - CHIỀU VỀ
                    </div>

                @else

                    <div class="leg-badge">
                        KHỨ HỒI - CHIỀU ĐI
                    </div>

                @endif

            @else

                <div class="leg-badge">
                    MỘT CHIỀU
                </div>

            @endif

        </div>


        @if(session('error'))

            <div class="error">
                {{ session('error') }}
            </div>

        @endif


        @if($errors->any())

            <div class="error">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        <div class="flight-summary">

            <div class="info-box">

                <span class="info-label">
                    Chuyến bay
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

        </div>


        <div class="price-grid">

            <div class="fare-card fare-economy">

                <span class="fare-name">
                    Hạng Phổ thông
                </span>

                <span class="fare-price">

                    {{ number_format(
                        $economyPrice,
                        0,
                        ',',
                        '.'
                    ) }} đ

                </span>

            </div>


            <div class="fare-card fare-vip">

                <span class="fare-name">
                    Hạng VIP
                </span>

                <span class="fare-price">

                    {{ number_format(
                        $vipPrice,
                        0,
                        ',',
                        '.'
                    ) }} đ

                </span>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SƠ ĐỒ GHẾ --}}
    {{-- ========================================================= --}}

    <section class="seat-section">

        <div class="seat-header">

            <div>

                <h2>
                    Chọn vị trí ghế
                </h2>

                <p>
                    Ghế VIP nằm ở các hàng đầu tiên.
                    Ghế màu xám là ghế đã được đặt.
                </p>

            </div>


            <div class="seat-stats">

                <div class="stat">
                    Tổng
                    <strong>{{ $totalSeats }}</strong>
                </div>

                <div class="stat">
                    Đã đặt
                    <strong>{{ $bookedSeats }}</strong>
                </div>

                <div class="stat">
                    Còn trống
                    <strong>{{ $availableSeats }}</strong>
                </div>

            </div>

        </div>


        <div class="legend">

            <div class="legend-item">

                <div class="legend-seat legend-vip"></div>

                VIP

            </div>


            <div class="legend-item">

                <div class="legend-seat legend-economy"></div>

                Phổ thông

            </div>


            <div class="legend-item">

                <div class="legend-seat legend-booked"></div>

                Đã đặt

            </div>


            <div class="legend-item">

                <div class="legend-seat legend-selected"></div>

                Ghế đang chọn

            </div>

        </div>


        <form
            action="{{ route('seats.select', $flight->id) }}"
            method="POST"
        >

            @csrf


            <input
                type="hidden"
                name="leg"
                value="{{ $leg ?? 'one_way' }}"
            >


            @php

                $groupedSeats = $seats->groupBy(
                    function ($seat) {

                        preg_match(
                            '/(\d+)/',
                            $seat->seat_number,
                            $matches
                        );

                        return isset($matches[1])
                            ? (int) $matches[1]
                            : 0;
                    }
                );

            @endphp


            <div class="cabin-container">

                <div class="cabin">

                    <div class="cabin-front">
                        PHÍA TRƯỚC MÁY BAY
                    </div>


                    <div class="column-header">

                        <span>A</span>
                        <span>B</span>
                        <span>C</span>

                        <span></span>

                        <span>HÀNG</span>

                        <span></span>

                        <span>D</span>
                        <span>E</span>
                        <span>F</span>

                    </div>


                    @foreach(
                        $groupedSeats
                        as $rowNumber => $rowSeats
                    )

                        @if($rowNumber == 1)

                            <div class="seat-zone-title">
                                Hạng VIP
                            </div>

                        @endif


                        @if($rowNumber == 4)

                            <div class="seat-zone-title">
                                Hạng Phổ thông
                            </div>

                        @endif


                        @php
                            $leftSeats = $rowSeats->take(3);
                            $rightSeats = $rowSeats->slice(3);
                        @endphp


                        <div class="seat-row">

                            {{-- A B C --}}

                            @foreach($leftSeats as $seat)

                                <div class="seat-wrapper">

                                    @if(
                                        $seat->status
                                        ===
                                        'available'
                                    )

                                        <input
                                            type="radio"
                                            name="seat_id"
                                            id="seat{{ $seat->id }}"
                                            value="{{ $seat->id }}"

                                            data-number="{{
                                                $seat->seat_number
                                            }}"

                                            data-class="{{
                                                $seat->seat_class
                                            }}"

                                            data-price="{{
                                                $seat->seat_class === 'vip'
                                                    ? $vipPrice
                                                    : $economyPrice
                                            }}"
                                        >

                                        <label
                                            for="seat{{ $seat->id }}"

                                            class="seat {{
                                                $seat->seat_class === 'vip'
                                                    ? 'seat-vip'
                                                    : 'seat-economy'
                                            }}"
                                        >

                                            {{ $seat->seat_number }}

                                        </label>

                                    @else

                                        <div class="seat seat-booked">

                                            {{ $seat->seat_number }}

                                        </div>

                                    @endif

                                </div>

                            @endforeach


                            {{-- LỐI ĐI TRÁI --}}

                            <div class="aisle-left"></div>


                            {{-- SỐ HÀNG --}}

                            <div class="row-number">
                                {{ $rowNumber }}
                            </div>


                            {{-- LỐI ĐI PHẢI --}}

                            <div class="aisle-right"></div>


                            {{-- D E F --}}

                            @foreach($rightSeats as $seat)

                                <div class="seat-wrapper">

                                    @if(
                                        $seat->status
                                        ===
                                        'available'
                                    )

                                        <input
                                            type="radio"
                                            name="seat_id"
                                            id="seat{{ $seat->id }}"
                                            value="{{ $seat->id }}"

                                            data-number="{{
                                                $seat->seat_number
                                            }}"

                                            data-class="{{
                                                $seat->seat_class
                                            }}"

                                            data-price="{{
                                                $seat->seat_class === 'vip'
                                                    ? $vipPrice
                                                    : $economyPrice
                                            }}"
                                        >

                                        <label
                                            for="seat{{ $seat->id }}"

                                            class="seat {{
                                                $seat->seat_class === 'vip'
                                                    ? 'seat-vip'
                                                    : 'seat-economy'
                                            }}"
                                        >

                                            {{ $seat->seat_number }}

                                        </label>

                                    @else

                                        <div class="seat seat-booked">

                                            {{ $seat->seat_number }}

                                        </div>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- GHẾ ĐÃ CHỌN --}}
            {{-- ================================================= --}}

            <div
                id="selectedInfo"
                class="selected-info"
            >

                <div class="selected-title">
                    Ghế đã chọn
                </div>


                <div class="selected-grid">

                    <div>

                        <span class="selected-label">
                            Số ghế
                        </span>

                        <span
                            id="selectedSeat"
                            class="selected-value"
                        ></span>

                    </div>


                    <div>

                        <span class="selected-label">
                            Hạng ghế
                        </span>

                        <span
                            id="selectedClass"
                            class="selected-value"
                        ></span>

                    </div>


                    <div>

                        <span class="selected-label">
                            Giá vé
                        </span>

                        <span
                            id="selectedPrice"
                            class="selected-value"
                        ></span>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- BUTTON --}}
            {{-- ================================================= --}}

            <div class="actions">

                <a
                    href="{{ route('flights.search.form') }}"
                    class="back-button"
                >
                    ← Quay lại tìm chuyến bay
                </a>


                <button
                    type="submit"
                    class="continue-button"
                >

                    @if(
                        ($tripType ?? 'one_way') === 'round_trip'
                        &&
                        ($leg ?? 'outbound') === 'outbound'
                    )

                        Tiếp tục chọn chuyến về

                    @elseif(
                        ($tripType ?? 'one_way') === 'round_trip'
                        &&
                        ($leg ?? '') === 'return'
                    )

                        Tiếp tục nhập thông tin hành khách

                    @else

                        Tiếp tục nhập thông tin hành khách

                    @endif

                </button>

            </div>

        </form>

    </section>

</main>



@guest
<div
    class="inline-login-overlay"
    id="inlineLoginOverlay"
></div>

<aside
    class="inline-login-panel"
    id="inlineLoginPanel"
    aria-hidden="true"
>
    <div class="inline-login-header">
        <div>
            <h3 id="inlineAuthTitle">Đăng nhập để tiếp tục</h3>
            <p>
                Đăng nhập hoặc đăng ký ngay tại đây. Chuyến bay và ghế bạn đã chọn
                vẫn được giữ nguyên.
            </p>
        </div>

        <button
            type="button"
            class="inline-login-close"
            id="closeInlineLogin"
            aria-label="Đóng"
        >
            ×
        </button>
    </div>

    <div class="inline-login-body">
        <div class="inline-login-note">
            Sau khi đăng nhập hoặc đăng ký thành công, hệ thống sẽ tiếp tục sang bước
            nhập thông tin hành khách mà không yêu cầu bạn chọn lại chuyến bay.
        </div>

        <div class="inline-auth-switch" role="group" aria-label="Chọn đăng nhập hoặc đăng ký">
            <button type="button" data-inline-auth="login" aria-pressed="true" aria-controls="inlineLoginContent">Đăng nhập</button>
            <button type="button" data-inline-auth="register" aria-pressed="false" aria-controls="inlineRegisterContent">Đăng ký</button>
        </div>

        <div id="inlineLoginContent">
        @if($errors->inlineLogin->any())
            <div class="inline-login-error">
                @foreach($errors->inlineLogin->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form
            action="{{ route('dang-nhap.tai-cho') }}"
            method="POST"
        >
            @csrf

            <div class="inline-form-group">
                <label for="inline_email">
                    Email
                </label>

                <input
                    type="email"
                    id="inline_email"
                    name="email"
                    class="inline-form-control"
                    value="{{ old('email') }}"
                    placeholder="Nhập email"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="inline-form-group">
                <label for="inline_password">
                    Mật khẩu
                </label>

                <input
                    type="password"
                    id="inline_password"
                    name="password"
                    class="inline-form-control"
                    placeholder="Nhập mật khẩu"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button
                type="submit"
                class="inline-login-submit"
            >
                Đăng nhập và tiếp tục
            </button>
        </form>

        <div class="inline-register-box">
            Chưa có tài khoản?
            <button type="button" data-inline-auth="register">Đăng ký ngay</button>
        </div>
        </div>

        <div id="inlineRegisterContent" hidden>
            @if($errors->inlineRegister->any())
                <div class="inline-login-error" role="alert">
                    @foreach($errors->inlineRegister->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('dang-ky.store') }}" method="POST">
                @csrf
                <input type="hidden" name="inline_register" value="1">

                <div class="inline-form-group">
                    <label for="inline_register_name">Họ và tên</label>
                    <input type="text" id="inline_register_name" name="name" class="inline-form-control"
                        value="{{ old('name') }}" autocomplete="name" maxlength="255" required>
                </div>

                <div class="inline-form-group">
                    <label for="inline_register_email">Email</label>
                    <input type="email" id="inline_register_email" name="email" class="inline-form-control"
                        value="{{ old('email') }}" autocomplete="email" required>
                </div>

                <div class="inline-form-group">
                    <label for="inline_register_date_of_birth">Ngày sinh</label>
                    <input type="date" id="inline_register_date_of_birth" name="date_of_birth" class="inline-form-control"
                        value="{{ old('date_of_birth') }}" max="{{ now()->subDay()->toDateString() }}" autocomplete="bday" required>
                </div>

                <div class="inline-form-group">
                    <label for="inline_register_gender">Giới tính</label>
                    <select id="inline_register_gender" name="gender" class="inline-form-control" required>
                        <option value="">Chọn giới tính</option>
                        <option value="nam" @selected(old('gender') === 'nam')>Nam</option>
                        <option value="nu" @selected(old('gender') === 'nu')>Nữ</option>
                        <option value="khac" @selected(old('gender') === 'khac')>Khác</option>
                    </select>
                </div>

                <div class="inline-form-group">
                    <label for="inline_register_phone">Số điện thoại</label>
                    <input type="tel" id="inline_register_phone" name="phone" class="inline-form-control"
                        value="{{ old('phone') }}" autocomplete="tel" maxlength="20" required>
                </div>

                <div class="inline-form-group">
                    <label for="inline_register_password">Mật khẩu</label>
                    <input type="password" id="inline_register_password" name="password" class="inline-form-control"
                        autocomplete="new-password" minlength="4" placeholder="Ít nhất 4 ký tự" required>
                </div>

                <div class="inline-form-group">
                    <label for="inline_register_password_confirmation">Xác nhận mật khẩu</label>
                    <input type="password" id="inline_register_password_confirmation" name="password_confirmation"
                        class="inline-form-control" autocomplete="new-password" minlength="4" required>
                </div>

                <button type="submit" class="inline-login-submit">Đăng ký và tiếp tục</button>
            </form>

            <div class="inline-register-box">
                Đã có tài khoản?
                <button type="button" data-inline-auth="login">Đăng nhập</button>
            </div>
        </div>
    </div>
</aside>
@endguest

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


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

    const seats =
        document.querySelectorAll(
            'input[name="seat_id"]'
        );

    const selectedInfo =
        document.getElementById(
            'selectedInfo'
        );

    const selectedSeat =
        document.getElementById(
            'selectedSeat'
        );

    const selectedClass =
        document.getElementById(
            'selectedClass'
        );

    const selectedPrice =
        document.getElementById(
            'selectedPrice'
        );


    seats.forEach(function (seat) {

        seat.addEventListener(
            'change',
            function () {

                const seatNumber =
                    this.dataset.number;

                const seatClass =
                    this.dataset.class;

                const price =
                    parseInt(
                        this.dataset.price
                    ) || 0;


                selectedSeat.textContent =
                    seatNumber;


                selectedClass.textContent =
                    seatClass === 'vip'
                        ? 'VIP'
                        : 'Phổ thông';


                selectedPrice.textContent =
                    new Intl.NumberFormat(
                        'vi-VN'
                    ).format(price)
                    + ' đ';


                selectedInfo.style.display =
                    'block';

            }
        );

    });


    const openInlineLogin =
        document.getElementById('openInlineLogin');

    const closeInlineLogin =
        document.getElementById('closeInlineLogin');

    const inlineLoginPanel =
        document.getElementById('inlineLoginPanel');

    const inlineLoginOverlay =
        document.getElementById('inlineLoginOverlay');


    let inlineAuthMode = @json($errors->inlineRegister->any() ? 'register' : 'login');

    function setInlineAuthMode(mode, focusInput = true) {
        if (!inlineLoginPanel) {
            return;
        }

        inlineAuthMode = mode === 'register' ? 'register' : 'login';
        const registering = inlineAuthMode === 'register';

        document.getElementById('inlineLoginContent').hidden = registering;
        document.getElementById('inlineRegisterContent').hidden = !registering;
        document.getElementById('inlineAuthTitle').textContent = registering
            ? 'Đăng ký để tiếp tục'
            : 'Đăng nhập để tiếp tục';

        document.querySelectorAll('.inline-auth-switch button').forEach(function (button) {
            button.setAttribute('aria-pressed', String(button.dataset.inlineAuth === inlineAuthMode));
        });

        if (focusInput) {
            document.getElementById(registering ? 'inline_register_name' : 'inline_email').focus();
        }
    }

    document.querySelectorAll('[data-inline-auth]').forEach(function (button) {
        button.addEventListener('click', function () {
            setInlineAuthMode(button.dataset.inlineAuth);
        });
    });

    setInlineAuthMode(inlineAuthMode, false);

    function showInlineLogin() {

        if (!inlineLoginPanel || !inlineLoginOverlay) {
            return;
        }

        inlineLoginPanel.classList.add('show');
        inlineLoginOverlay.classList.add('show');
        inlineLoginPanel.setAttribute('aria-hidden', 'false');

        const emailInput = document.getElementById(
            inlineAuthMode === 'register' ? 'inline_register_name' : 'inline_email'
        );

        if (emailInput) {
            setTimeout(function () {
                emailInput.focus();
            }, 200);
        }
    }


    function hideInlineLogin() {

        if (!inlineLoginPanel || !inlineLoginOverlay) {
            return;
        }

        inlineLoginPanel.classList.remove('show');
        inlineLoginOverlay.classList.remove('show');
        inlineLoginPanel.setAttribute('aria-hidden', 'true');
    }


    if (openInlineLogin) {
        openInlineLogin.addEventListener(
            'click',
            showInlineLogin
        );
    }


    if (closeInlineLogin) {
        closeInlineLogin.addEventListener(
            'click',
            hideInlineLogin
        );
    }


    if (inlineLoginOverlay) {
        inlineLoginOverlay.addEventListener(
            'click',
            hideInlineLogin
        );
    }


    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {
                hideInlineLogin();
            }

        }
    );


    @if(
        session('show_inline_login')
        ||
        (
            session('error')
            ===
            'Bạn cần đăng nhập để tiếp tục nhập thông tin hành khách.'
        )
        ||
        $errors->inlineLogin->any()
        ||
        $errors->inlineRegister->any()
    )

        showInlineLogin();

    @endif

</script>

</body>

</html>