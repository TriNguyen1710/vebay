<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Vietjet</title>

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
            --white: #ffffff;
            --background: #f3f6f9;
            --text: #22313f;
            --muted: #74818c;
            --border: #dfe6eb;
            --success: #198754;
            --danger: #dc3545;
            --warning: #d69e00;
        }

        body {
            margin: 0;
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

        .admin-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 245px 1fr;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 245px;
            background: var(--primary-dark);
            color: white;
            display: flex;
            flex-direction: column;
            padding: 26px 16px;
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

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .menu-link.active {
            background: rgba(255, 255, 255, 0.11);
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
            color: var(--primary);
            font-size: 19px;
            margin-bottom: 3px;
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

        .content {
            max-width: 1450px;
            margin: auto;
            padding: 28px 30px 45px;
        }

        .page-heading {
            margin-bottom: 23px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
        }

        .page-heading h1 {
            color: #243746;
            font-size: 24px;
            margin-bottom: 6px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 11px;
        }

        .today {
            color: var(--muted);
            font-size: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-icon {
            width: 37px;
            height: 37px;
            border-radius: 7px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .stat-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: bold;
        }

        .stat-value {
            color: var(--primary-dark);
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .stat-description {
            color: #8d989f;
            font-size: 9px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.55fr 0.75fr;
            gap: 20px;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .panel-header {
            padding: 19px 21px;
            border-bottom: 1px solid #e8edf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .panel-header h3 {
            color: var(--primary);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .panel-header p {
            color: var(--muted);
            font-size: 9px;
        }

        .panel-body {
            padding: 21px;
        }

        .revenue-box {
            min-height: 210px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .revenue-label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 8px;
        }

        .revenue-value {
            color: var(--primary-dark);
            font-size: 37px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .revenue-note {
            color: var(--success);
            font-size: 10px;
            font-weight: bold;
        }

        .revenue-line {
            margin-top: 30px;
            height: 7px;
            border-radius: 20px;
            background: #edf1f4;
            overflow: hidden;
        }

        .revenue-line-fill {
            width: 72%;
            height: 100%;
            background: linear-gradient(90deg, var(--primary), #1e76aa);
        }

        .summary-list {
            display: grid;
        }

        .summary-row {
            min-height: 58px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #edf0f2;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .summary-mark {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
        }

        .summary-row:nth-child(2) .summary-mark {
            background: var(--secondary);
        }

        .summary-row:nth-child(3) .summary-mark {
            background: var(--success);
        }

        .summary-row:nth-child(4) .summary-mark {
            background: #7a6fd0;
        }

        .summary-name {
            color: #425361;
            font-size: 11px;
        }

        .summary-value {
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: bold;
        }

        .bottom-grid {
            margin-top: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .status-list {
            display: grid;
            gap: 12px;
        }

        .status-item {
            padding: 14px;
            border: 1px solid #e4e9ed;
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .status-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-color {
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        .status-paid {
            background: var(--success);
        }

        .status-unpaid {
            background: var(--warning);
        }

        .status-name {
            color: #53626e;
            font-size: 10px;
            font-weight: bold;
        }

        .status-number {
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: bold;
        }

        .flight-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .flight-stat {
            padding: 18px 15px;
            background: #f8fafc;
            border: 1px solid #e4e9ed;
            border-radius: 7px;
            text-align: center;
        }

        .flight-stat strong {
            display: block;
            margin-bottom: 6px;
            color: var(--primary);
            font-size: 22px;
        }

        .flight-stat span {
            color: var(--muted);
            font-size: 9px;
        }

        .footer {
            margin-top: 28px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            color: #919ca4;
            font-size: 9px;
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 1150px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .admin-layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .menu {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .stats-grid,
            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .menu {
                grid-template-columns: 1fr;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .flight-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@php
    $totalAirports = \App\Models\Airport::count();

    $totalAircraft = \App\Models\Aircraft::count();

    $totalFlights = \App\Models\Flight::count();

    $totalBookings = \App\Models\Booking::count();

    $totalTickets = \App\Models\Ticket::count();

    $totalCustomers = \App\Models\User::where('role', 'user')->count();

    $totalEmployees = \App\Models\User::where('role', 'nhanvien')->count();

    $paidBookings = \App\Models\Booking::where(
        'payment_status',
        'paid'
    )->count();

    $unpaidBookings = \App\Models\Booking::where(
        'payment_status',
        'unpaid'
    )->count();

    $totalRevenue = \App\Models\Booking::where(
        'payment_status',
        'paid'
    )->sum('total_amount');

    $todayFlights = \App\Models\Flight::whereDate(
        'flight_date',
        now()->timezone('Asia/Ho_Chi_Minh')->toDateString()
    )->count();

    $openFlights = \App\Models\Flight::where(
        'status',
        'open'
    )->count();

    $completedFlights = \App\Models\Flight::where(
        'status',
        'completed'
    )->count();

    $cancelledFlights = \App\Models\Flight::where(
        'status',
        'cancelled'
    )->count();
@endphp

<div class="admin-layout">

    <aside class="sidebar">

        <a href="{{ route('admin.trang-chu') }}" class="logo">
            Viet<span>jet</span>
        </a>

        <div class="menu-title">
            QUẢN LÝ HỆ THỐNG
        </div>

        <nav class="menu">

            <a
                href="{{ route('admin.trang-chu') }}"
                class="menu-link active"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
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
                        <path d="M3 21h18" />
                        <path d="M6 21V9l6-4 6 4v12" />
                        <path d="M9 13h6" />
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
                        <path d="M2 16l20-5-20-5 3 5-3 5z" />
                    </svg>
                </span>

                Quản lý máy bay
            </a>

            <a
                href="{{ route('admin.flights.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2" />
                        <path d="M8 3v4M16 3v4M3 10h18" />
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
                        <path d="M4 4h16v16H4z" />
                        <path d="M8 8h8M8 12h8M8 16h5" />
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
                        <circle cx="9" cy="8" r="4" />
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2" />
                        <path d="M16 11a4 4 0 0 1 5 4" />
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
                        <rect x="5" y="7" width="14" height="13" rx="2" />
                        <path d="M9 7V5a3 3 0 0 1 6 0v2" />
                        <path d="M8 11h8" />
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
                        <path d="M4 20V10" />
                        <path d="M10 20V4" />
                        <path d="M16 20v-7" />
                        <path d="M22 20V7" />
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
                        <path d="M4 6h10" />
                        <path d="M18 6h2" />
                        <circle cx="16" cy="6" r="2" />
                        <path d="M4 12h2" />
                        <path d="M10 12h10" />
                        <circle cx="8" cy="12" r="2" />
                        <path d="M4 18h8" />
                        <path d="M16 18h4" />
                        <circle cx="14" cy="18" r="2" />
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
                        <path d="M4 7h16v10H4z" />
                        <path d="M8 11h8" />
                        <path d="M12 8v6" />
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

    <main class="main">

        <header class="topbar">

            <div class="topbar-left">
                <h2>
                    Vietjet Administration
                </h2>

                <p>
                    Hệ thống quản trị đặt vé máy bay
                </p>
            </div>

            <span class="admin-badge">
                ADMIN
            </span>

        </header>

        <div class="content">

            <div class="page-heading">

                <div>
                    <h1>
                        Tổng quan hệ thống
                    </h1>

                    <p>
                        Theo dõi tình hình hoạt động của hệ thống Vietjet.
                    </p>
                </div>

                <div class="today">
                    {{ now()
                        ->timezone('Asia/Ho_Chi_Minh')
                        ->format('d/m/Y') }}
                </div>

            </div>

            <section class="stats-grid">

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            DOANH THU
                        </span>

                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2v20M17 6H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                        </div>

                    </div>

                    <div class="stat-value">
                        {{ number_format(
                            $totalRevenue,
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                    <div class="stat-description">
                        VNĐ từ các đơn đã thanh toán
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            ĐƠN ĐẶT VÉ
                        </span>

                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16v16H4z" />
                                <path d="M8 8h8M8 12h8" />
                            </svg>
                        </div>

                    </div>

                    <div class="stat-value">
                        {{ $totalBookings }}
                    </div>

                    <div class="stat-description">
                        Tổng số đơn đặt vé
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            VÉ ĐÃ TẠO
                        </span>

                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 6h18v12H3z" />
                                <path d="M8 6v12" />
                            </svg>
                        </div>

                    </div>

                    <div class="stat-value">
                        {{ $totalTickets }}
                    </div>

                    <div class="stat-description">
                        Tổng vé trong hệ thống
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            KHÁCH HÀNG
                        </span>

                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 21a8 8 0 0 1 16 0" />
                            </svg>
                        </div>

                    </div>

                    <div class="stat-value">
                        {{ $totalCustomers }}
                    </div>

                    <div class="stat-description">
                        Tài khoản khách hàng
                    </div>

                </div>

            </section>

            <section class="dashboard-grid">

                <div class="panel">

                    <div class="panel-header">
                        <div>
                            <h3>
                                Tổng doanh thu
                            </h3>

                            <p>
                                Doanh thu từ các đơn đã thanh toán thành công
                            </p>
                        </div>
                    </div>

                    <div class="panel-body revenue-box">

                        <div class="revenue-label">
                            Tổng doanh thu hiện tại
                        </div>

                        <div class="revenue-value">

                            {{ number_format(
                                $totalRevenue,
                                0,
                                ',',
                                '.'
                            ) }}

                            <span
                                style="
                                    font-size: 13px;
                                    font-weight: 600;
                                "
                            >
                                VNĐ
                            </span>

                        </div>

                        <div class="revenue-note">
                            {{ $paidBookings }} đơn đã thanh toán
                        </div>

                        <div class="revenue-line">
                            <div class="revenue-line-fill"></div>
                        </div>

                    </div>

                </div>

                <div class="panel">

                    <div class="panel-header">
                        <div>
                            <h3>
                                Hệ thống
                            </h3>

                            <p>
                                Dữ liệu hiện có
                            </p>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="summary-list">

                            <div class="summary-row">

                                <div class="summary-left">
                                    <span class="summary-mark"></span>

                                    <span class="summary-name">
                                        Sân bay
                                    </span>
                                </div>

                                <span class="summary-value">
                                    {{ $totalAirports }}
                                </span>

                            </div>

                            <div class="summary-row">

                                <div class="summary-left">
                                    <span class="summary-mark"></span>

                                    <span class="summary-name">
                                        Máy bay
                                    </span>
                                </div>

                                <span class="summary-value">
                                    {{ $totalAircraft }}
                                </span>

                            </div>

                            <div class="summary-row">

                                <div class="summary-left">
                                    <span class="summary-mark"></span>

                                    <span class="summary-name">
                                        Chuyến bay
                                    </span>
                                </div>

                                <span class="summary-value">
                                    {{ $totalFlights }}
                                </span>

                            </div>

                            <div class="summary-row">

                                <div class="summary-left">
                                    <span class="summary-mark"></span>

                                    <span class="summary-name">
                                        Nhân viên
                                    </span>
                                </div>

                                <span class="summary-value">
                                    {{ $totalEmployees }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="bottom-grid">

                <div class="panel">

                    <div class="panel-header">
                        <div>
                            <h3>
                                Trạng thái thanh toán
                            </h3>

                            <p>
                                Tình trạng các đơn đặt vé
                            </p>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="status-list">

                            <div class="status-item">

                                <div class="status-left">
                                    <span class="status-color status-paid"></span>

                                    <span class="status-name">
                                        Đã thanh toán
                                    </span>
                                </div>

                                <span class="status-number">
                                    {{ $paidBookings }}
                                </span>

                            </div>

                            <div class="status-item">

                                <div class="status-left">
                                    <span class="status-color status-unpaid"></span>

                                    <span class="status-name">
                                        Chưa thanh toán
                                    </span>
                                </div>

                                <span class="status-number">
                                    {{ $unpaidBookings }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="panel">

                    <div class="panel-header">
                        <div>
                            <h3>
                                Tình hình chuyến bay
                            </h3>

                            <p>
                                Tổng quan trạng thái chuyến
                            </p>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="flight-stats">

                            <div class="flight-stat">
                                <strong>
                                    {{ $todayFlights }}
                                </strong>

                                <span>
                                    Chuyến hôm nay
                                </span>
                            </div>

                            <div class="flight-stat">
                                <strong>
                                    {{ $openFlights }}
                                </strong>

                                <span>
                                    Đang mở bán
                                </span>
                            </div>

                            <div class="flight-stat">
                                <strong>
                                    {{ $completedFlights }}
                                </strong>

                                <span>
                                    Đã hoàn thành
                                </span>
                            </div>

                            <div class="flight-stat">
                                <strong>
                                    {{ $cancelledFlights }}
                                </strong>

                                <span>
                                    Đã hủy
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <footer class="footer">

                <span>
                    Vietjet Administration
                </span>

                <span>
                    Hệ thống đặt vé máy bay
                </span>

            </footer>

        </div>

    </main>

</div>

</body>
</html>