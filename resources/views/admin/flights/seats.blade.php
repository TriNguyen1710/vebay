<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sơ đồ ghế chuyến bay - Vietjet Admin</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #003b70;
            --primary-dark: #00294f;
            --primary-light: #edf5fb;

            --secondary: #f4b400;

            --background: #f3f6f9;
            --white: #ffffff;

            --text: #243746;
            --muted: #74818c;
            --border: #dfe6eb;

            --success: #198754;
            --danger: #dc3545;
        }

        body {
            min-height: 100vh;

            font-family: Arial, Helvetica, sans-serif;

            background: var(--background);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        /* ================================
           LAYOUT
        ================================= */

        .admin-layout {
            min-height: 100vh;

            display: grid;
            grid-template-columns: 245px 1fr;
        }

        /* ================================
           SIDEBAR
        ================================= */

        .sidebar {
            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            width: 245px;

            padding: 26px 16px;

            display: flex;
            flex-direction: column;

            background: var(--primary-dark);
            color: white;
        }

        .logo {
            display: block;

            padding: 0 10px;
            margin-bottom: 34px;

            color: white;

            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .menu-title {
            padding: 0 11px;
            margin-bottom: 10px;

            color: #7895aa;

            font-size: 9px;
            font-weight: bold;
            letter-spacing: 1.3px;
        }

        .menu {
            display: grid;
            gap: 4px;
        }

        .menu-link {
            min-height: 44px;

            padding: 0 13px;

            border-radius: 7px;

            display: flex;
            align-items: center;

            gap: 12px;

            color: #cad9e4;

            font-size: 12px;
            font-weight: 600;

            transition: 0.2s;
        }

        .menu-link:hover,
        .menu-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-icon {
            width: 17px;
            height: 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
        }

        .menu-icon svg {
            width: 17px;
            height: 17px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .menu-link.active .menu-icon {
            color: var(--secondary);
        }

        /* ================================
           SIDEBAR BOTTOM
        ================================= */

        .sidebar-bottom {
            margin-top: auto;

            padding-top: 22px;

            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-info {
            padding: 0 11px 16px;
        }

        .admin-info strong {
            display: block;

            margin-bottom: 4px;

            font-size: 12px;
        }

        .admin-info span {
            color: #8fa5b5;
            font-size: 10px;
        }

        .logout-btn {
            width: 100%;

            padding: 10px;

            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 6px;

            background: rgba(255, 255, 255, 0.06);

            color: white;

            cursor: pointer;

            font-size: 11px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: var(--danger);
            border-color: var(--danger);
        }

        /* ================================
           MAIN
        ================================= */

        .main {
            grid-column: 2;
            min-width: 0;
        }

        .topbar {
            height: 70px;

            padding: 0 30px;

            background: white;

            border-bottom: 1px solid var(--border);

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-left h2 {
            margin-bottom: 3px;

            color: var(--primary);

            font-size: 19px;
        }

        .topbar-left p {
            color: var(--muted);

            font-size: 10px;
        }

        .admin-badge {
            padding: 7px 11px;

            border: 1px solid #cbdce7;
            border-radius: 5px;

            background: var(--primary-light);

            color: var(--primary);

            font-size: 10px;
            font-weight: bold;
        }

        /* ================================
           CONTENT
        ================================= */

        .content {
            max-width: 1250px;

            margin: auto;

            padding: 28px 30px 45px;
        }

        .page-heading {
            margin-bottom: 22px;

            display: flex;
            justify-content: space-between;
            align-items: flex-end;

            gap: 20px;
        }

        .page-heading h1 {
            margin-bottom: 6px;

            color: var(--text);

            font-size: 24px;
        }

        .page-heading p {
            color: var(--muted);

            font-size: 11px;
        }

        .back-btn {
            min-height: 38px;

            padding: 0 15px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--border);
            border-radius: 6px;

            background: white;

            color: var(--primary);

            font-size: 11px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #f6f8fa;
        }

        /* ================================
           FLIGHT INFO
        ================================= */

        .flight-card {
            margin-bottom: 18px;

            padding: 20px 22px;

            border: 1px solid var(--border);
            border-radius: 10px;

            background: white;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 25px;

            box-shadow:
                0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .flight-code {
            margin-bottom: 7px;

            color: var(--primary);

            font-size: 17px;
            font-weight: 800;
        }

        .flight-aircraft {
            color: var(--muted);

            font-size: 10px;
        }

        .route {
            display: flex;
            align-items: center;

            gap: 16px;
        }

        .airport {
            min-width: 70px;
        }

        .airport:last-child {
            text-align: right;
        }

        .airport-code {
            display: block;

            margin-bottom: 4px;

            color: var(--primary-dark);

            font-size: 18px;
            font-weight: 800;
        }

        .airport-city {
            color: var(--muted);

            font-size: 9px;
        }

        .route-line {
            width: 110px;

            display: flex;
            align-items: center;

            gap: 7px;
        }

        .route-line span {
            flex: 1;

            height: 1px;

            background: #b9c8d2;
        }

        .route-plane {
            width: 18px;
            height: 18px;

            color: var(--primary);
        }

        .route-plane svg {
            width: 18px;
            height: 18px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        /* ================================
           STATS
        ================================= */

        .stats-grid {
            margin-bottom: 18px;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 14px;
        }

        .stat-card {
            padding: 17px 18px;

            border: 1px solid var(--border);
            border-radius: 8px;

            background: white;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 15px;
        }

        .stat-label {
            color: var(--muted);

            font-size: 9px;
            font-weight: bold;
        }

        .stat-number {
            color: var(--primary-dark);

            font-size: 23px;
            font-weight: 800;
        }

        .stat-card.available {
            border-left: 4px solid var(--success);
        }

        .stat-card.booked {
            border-left: 4px solid var(--danger);
        }

        .stat-card.total {
            border-left: 4px solid var(--primary);
        }

        .stat-card.available .stat-number {
            color: var(--success);
        }

        .stat-card.booked .stat-number {
            color: var(--danger);
        }

        /* ================================
           SEAT PANEL
        ================================= */

        .seat-panel {
            background: white;

            border: 1px solid var(--border);
            border-radius: 11px;

            box-shadow:
                0 4px 16px rgba(20, 45, 65, 0.05);

            overflow: hidden;
        }

        .seat-panel-header {
            padding: 18px 22px;

            border-bottom: 1px solid #e8edf1;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;
        }

        .seat-panel-header h2 {
            margin-bottom: 5px;

            color: var(--primary);

            font-size: 15px;
        }

        .seat-panel-header p {
            color: var(--muted);

            font-size: 9px;
        }

        /* ================================
           LEGEND
        ================================= */

        .legend {
            display: flex;
            align-items: center;

            gap: 18px;
        }

        .legend-item {
            display: flex;
            align-items: center;

            gap: 7px;

            color: #64747f;

            font-size: 9px;
            font-weight: bold;
        }

        .legend-box {
            width: 21px;
            height: 17px;

            border-radius: 4px;
        }

        .legend-available {
            background: white;

            border: 2px solid #7daf95;
        }

        .legend-booked {
            background: #eceff1;

            border: 2px solid #c6ccd1;
        }

        /* ================================
           AIRCRAFT CABIN
        ================================= */

        .seat-panel-body {
            padding: 30px 20px 36px;

            overflow-x: auto;
        }

        .aircraft-cabin {
            width: fit-content;
            min-width: 470px;

            margin: auto;

            padding: 28px 32px 32px;

            border: 1px solid #d8e0e6;
            border-radius: 90px 90px 28px 28px;

            background:
                linear-gradient(
                    180deg,
                    #fafcfd 0%,
                    #ffffff 18%,
                    #ffffff 100%
                );

            position: relative;
        }

        .cockpit {
            margin: 0 auto 25px;

            width: 170px;

            padding-bottom: 14px;

            border-bottom: 1px solid #d7e0e6;

            text-align: center;

            color: #929da5;

            font-size: 8px;
            font-weight: bold;
            letter-spacing: 0.7px;
        }

        /* ================================
           COLUMN HEADER
        ================================= */

        .seat-columns {
            margin-bottom: 10px;

            display: grid;

            grid-template-columns:
                46px 46px 46px
                42px
                34px
                42px
                46px 46px 46px;

            gap: 7px;

            justify-content: center;
            align-items: center;
        }

        .column-label {
            text-align: center;

            color: #7e8a93;

            font-size: 9px;
            font-weight: 800;
        }

        .row-label-header {
            text-align: center;

            color: #a0a9af;

            font-size: 7px;
            font-weight: bold;
        }

        /* ================================
           ROWS
        ================================= */

        .seat-row {
            margin-bottom: 8px;

            display: grid;

            grid-template-columns:
                46px 46px 46px
                42px
                34px
                42px
                46px 46px 46px;

            gap: 7px;

            justify-content: center;
            align-items: center;
        }

        .seat {
            width: 46px;
            height: 40px;

            border-radius: 5px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 9px;
            font-weight: 800;

            transition: 0.15s;
        }

        .seat-available {
            background: #ffffff;

            border: 2px solid #8db49c;

            color: #356247;
        }

        .seat-available:hover {
            background: #f0f8f3;

            transform: translateY(-1px);
        }

        .seat-booked {
            background: #eceff1;

            border: 2px solid #c5ccd1;

            color: #8c969d;
        }

        .seat-number-row {
            width: 34px;

            text-align: center;

            color: var(--primary-dark);

            font-size: 9px;
            font-weight: 800;
        }

        .aisle-space {
            width: 42px;

            text-align: center;

            color: #a7afb5;

            font-size: 7px;
        }

        /* ================================
           EMPTY
        ================================= */

        .empty {
            padding: 45px 20px;

            text-align: center;

            color: var(--muted);

            font-size: 11px;
        }

        /* ================================
           BOTTOM
        ================================= */

        .bottom-back {
            margin-top: 20px;
        }

        .bottom-back a {
            color: var(--primary);

            font-size: 11px;
            font-weight: bold;
        }

        .bottom-back a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 28px;

            padding-top: 18px;

            border-top: 1px solid var(--border);

            display: flex;
            justify-content: space-between;

            color: #919ca4;

            font-size: 9px;
        }

        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 900px) {

            .admin-layout {
                display: block;
            }

            .sidebar {
                position: relative;

                width: 100%;
                height: auto;
            }

            .menu {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .main {
                margin-left: 0;
            }

            .flight-card {
                align-items: flex-start;
                flex-direction: column;
            }

        }

        @media (max-width: 700px) {

            .content {
                padding: 20px 15px 35px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .seat-panel-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .route {
                width: 100%;
            }

            .route-line {
                flex: 1;
            }

            .menu {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

<div class="admin-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <a
            href="{{ route('admin.trang-chu') }}"
            class="logo"
        >
            Viet<span>jet</span>
        </a>

        <div class="menu-title">
            QUẢN LÝ HỆ THỐNG
        </div>

        <nav class="menu">

            <a
                href="{{ route('admin.trang-chu') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                    </svg>
                </span>

                Tổng quan
            </a>

            <a
                href="{{ route('admin.airports.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21h18"/>
                        <path d="M6 21V9l6-4 6 4v12"/>
                        <path d="M9 13h6"/>
                    </svg>
                </span>

                Quản lý sân bay
            </a>

            <a
                href="{{ route('admin.aircraft.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                    </svg>
                </span>

                Quản lý máy bay
            </a>

            <a
                href="{{ route('admin.flights.index') }}"
                class="menu-link active"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        />
                        <path d="M8 3v4M16 3v4M3 10h18"/>
                    </svg>
                </span>

                Quản lý chuyến bay
            </a>

            <a
                href="{{ route('admin.bookings.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z"/>
                        <path d="M8 8h8M8 12h8M8 16h5"/>
                    </svg>
                </span>

                Quản lý vé
            </a>

            <a
                href="{{ route('admin.users.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                        <path d="M16 11a4 4 0 0 1 5 4"/>
                    </svg>
                </span>

                Quản lý người dùng
            </a>

            <a
                href="{{ route('admin.baggage.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="7" width="14" height="13" rx="2"/>
                        <path d="M9 7V5a3 3 0 0 1 6 0v2"/>
                        <path d="M8 11h8"/>
                    </svg>
                </span>

                Quản lý hành lý
            </a>

            <a
                href="{{ route('admin.statistics.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 20V10"/>
                        <path d="M10 20V4"/>
                        <path d="M16 20v-7"/>
                        <path d="M22 20V7"/>
                    </svg>
                </span>

                Thống kê chi tiết
            </a>

            <a
                href="{{ route('admin.settings.edit') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h10"/>
                        <path d="M18 7h2"/>
                        <circle cx="16" cy="7" r="2"/>
                        <path d="M4 12h2"/>
                        <path d="M10 12h10"/>
                        <circle cx="8" cy="12" r="2"/>
                        <path d="M4 17h7"/>
                        <path d="M15 17h5"/>
                        <circle cx="13" cy="17" r="2"/>
                    </svg>
                </span>

                Quản lý đổi giá vé
            </a>

            <a
                href="{{ route('admin.refund-settings.edit') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h16v10H4z"/>
                        <path d="M8 11h8"/>
                        <path d="M12 8v6"/>
                    </svg>
                </span>

                Quản lý hoàn vé
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="admin-info">

                <strong>
                    {{ auth()->user()->name }}
                </strong>

                <span>
                    Quản trị viên hệ thống
                </span>

            </div>

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

        </div>

    </aside>

    {{-- MAIN --}}
    <main class="main">

        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    Vietjet Administration
                </h2>

                <p>
                    Quản lý sơ đồ ghế chuyến bay
                </p>

            </div>

            <span class="admin-badge">
                ADMIN
            </span>

        </header>

        <div class="content">

            {{-- PAGE HEADING --}}
            <div class="page-heading">

                <div>

                    <h1>
                        Sơ đồ ghế chuyến bay
                    </h1>

                    <p>
                        Theo dõi tình trạng ghế
                        trống và ghế đã được đặt.
                    </p>

                </div>

                <a
                    href="{{ route('admin.flights.index') }}"
                    class="back-btn"
                >
                    ← Quay lại danh sách
                </a>

            </div>

            {{-- FLIGHT --}}
            <section class="flight-card">

                <div>

                    <div class="flight-code">
                        Chuyến bay {{ $flight->flight_code }}
                    </div>

                    <div class="flight-aircraft">

                        Máy bay:

                        <strong>
                            {{ $flight->aircraft->code }}
                            -
                            {{ $flight->aircraft->name }}
                        </strong>

                    </div>

                </div>

                <div class="route">

                    <div class="airport">

                        <span class="airport-code">
                            {{ $flight->departureAirport->code }}
                        </span>

                        <span class="airport-city">
                            {{ $flight->departureAirport->city }}
                        </span>

                    </div>

                    <div class="route-line">

                        <span></span>

                        <div class="route-plane">

                            <svg viewBox="0 0 24 24">
                                <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                            </svg>

                        </div>

                        <span></span>

                    </div>

                    <div class="airport">

                        <span class="airport-code">
                            {{ $flight->arrivalAirport->code }}
                        </span>

                        <span class="airport-city">
                            {{ $flight->arrivalAirport->city }}
                        </span>

                    </div>

                </div>

            </section>

            {{-- STATISTICS --}}
            <div class="stats-grid">

                <div class="stat-card total">

                    <div class="stat-label">
                        TỔNG SỐ GHẾ
                    </div>

                    <div class="stat-number">
                        {{ $totalSeats }}
                    </div>

                </div>

                <div class="stat-card available">

                    <div class="stat-label">
                        GHẾ CÒN TRỐNG
                    </div>

                    <div class="stat-number">
                        {{ $availableSeats }}
                    </div>

                </div>

                <div class="stat-card booked">

                    <div class="stat-label">
                        GHẾ ĐÃ ĐẶT
                    </div>

                    <div class="stat-number">
                        {{ $bookedSeats }}
                    </div>

                </div>

            </div>

            {{-- SEAT PANEL --}}
            <section class="seat-panel">

                <div class="seat-panel-header">

                    <div>

                        <h2>
                            Sơ đồ khoang hành khách
                        </h2>

                        <p>
                            Sơ đồ thể hiện trạng thái
                            hiện tại của từng ghế.
                        </p>

                    </div>

                    <div class="legend">

                        <div class="legend-item">

                            <span
                                class="legend-box legend-available"
                            ></span>

                            Còn trống

                        </div>

                        <div class="legend-item">

                            <span
                                class="legend-box legend-booked"
                            ></span>

                            Đã đặt

                        </div>

                    </div>

                </div>

                <div class="seat-panel-body">

                    @php

                        $groupedSeats = $seats->groupBy(
                            function ($seat) {
                                return intval(
                                    $seat->seat_number
                                );
                            }
                        );

                    @endphp

                    @if($groupedSeats->count() > 0)

                        <div class="aircraft-cabin">

                            <div class="cockpit">
                                PHÍA TRƯỚC MÁY BAY
                            </div>

                            {{-- COLUMN LABELS --}}
                            <div class="seat-columns">

                                <div class="column-label">
                                    A
                                </div>

                                <div class="column-label">
                                    B
                                </div>

                                <div class="column-label">
                                    C
                                </div>

                                <div></div>

                                <div class="row-label-header">
                                    HÀNG
                                </div>

                                <div></div>

                                <div class="column-label">
                                    D
                                </div>

                                <div class="column-label">
                                    E
                                </div>

                                <div class="column-label">
                                    F
                                </div>

                            </div>

                            @foreach(
                                $groupedSeats as $row => $rowSeats
                            )

                                @php

                                    $sortedSeats =
                                        $rowSeats
                                            ->sortBy(
                                                'seat_number'
                                            )
                                            ->values();

                                    $leftSeats =
                                        $sortedSeats
                                            ->take(3);

                                    $rightSeats =
                                        $sortedSeats
                                            ->slice(3, 3);

                                @endphp

                                <div class="seat-row">

                                    {{-- LEFT --}}
                                    @foreach($leftSeats as $seat)

                                        <div
                                            class="
                                                seat
                                                {{
                                                    $seat->status === 'booked'
                                                        ? 'seat-booked'
                                                        : 'seat-available'
                                                }}
                                            "
                                            title="
                                                @if($seat->seat_type === 'window')
                                                    Ghế cửa sổ
                                                @elseif($seat->seat_type === 'aisle')
                                                    Ghế lối đi
                                                @else
                                                    Ghế giữa
                                                @endif
                                            "
                                        >
                                            {{ $seat->seat_number }}
                                        </div>

                                    @endforeach

                                    {{-- BỔ SUNG Ô TRỐNG
                                         NẾU HÀNG ÍT HƠN 3 GHẾ TRÁI --}}
                                    @for(
                                        $i = $leftSeats->count();
                                        $i < 3;
                                        $i++
                                    )

                                        <div></div>

                                    @endfor

                                    <div class="aisle-space">
                                        Lối đi
                                    </div>

                                    <div class="seat-number-row">
                                        {{ $row }}
                                    </div>

                                    <div class="aisle-space">
                                        Lối đi
                                    </div>

                                    {{-- RIGHT --}}
                                    @foreach($rightSeats as $seat)

                                        <div
                                            class="
                                                seat
                                                {{
                                                    $seat->status === 'booked'
                                                        ? 'seat-booked'
                                                        : 'seat-available'
                                                }}
                                            "
                                            title="
                                                @if($seat->seat_type === 'window')
                                                    Ghế cửa sổ
                                                @elseif($seat->seat_type === 'aisle')
                                                    Ghế lối đi
                                                @else
                                                    Ghế giữa
                                                @endif
                                            "
                                        >
                                            {{ $seat->seat_number }}
                                        </div>

                                    @endforeach

                                    {{-- BỔ SUNG Ô TRỐNG
                                         NẾU HÀNG ÍT HƠN 3 GHẾ PHẢI --}}
                                    @for(
                                        $i = $rightSeats->count();
                                        $i < 3;
                                        $i++
                                    )

                                        <div></div>

                                    @endfor

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="empty">
                            Chuyến bay này chưa có dữ liệu ghế.
                        </div>

                    @endif

                </div>

            </section>

            <div class="bottom-back">

                <a href="{{ route('admin.flights.index') }}">
                    ← Quay lại quản lý chuyến bay
                </a>

            </div>

            <footer class="footer">

                <span>
                    Vietjet Administration
                </span>

                <span>
                    Sơ đồ ghế
                    {{ $flight->flight_code }}
                </span>

            </footer>

        </div>

    </main>

</div>

</body>

</html>