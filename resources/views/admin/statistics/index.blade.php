<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Thống kê - Vietjet Admin</title>

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
            --warning: #b88700;
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

        button,
        select {
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

        .content {
            max-width: 1450px;
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

        .section-heading {
            margin: 28px 0 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-line {
            width: 4px;
            height: 24px;
            border-radius: 10px;
            background: var(--secondary);
        }

        .section-heading h2 {
            color: var(--primary-dark);
            font-size: 16px;
        }

        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .stat-card {
            min-height: 112px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .stat-label {
            margin-bottom: 11px;
            color: var(--muted);
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .stat-number {
            color: var(--primary);
            font-size: 27px;
            font-weight: 800;
            line-height: 1.2;
        }

        .stat-number.revenue {
            color: var(--success);
            font-size: 22px;
        }

        .stat-number.vip {
            color: #a57900;
        }

        .stat-subtext {
            margin-top: 7px;
            color: #9aa3aa;
            font-size: 8px;
        }

        .filter-card {
            margin-top: 24px;
            padding: 20px 22px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .filter-header {
            margin-bottom: 17px;
        }

        .filter-header h3 {
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 14px;
        }

        .filter-header p {
            color: var(--muted);
            font-size: 9px;
        }

        .filter-form {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .form-group {
            min-width: 190px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #4c5d69;
            font-size: 10px;
            font-weight: bold;
        }

        .form-group select {
            width: 100%;
            height: 42px;
            padding: 0 11px;
            border: 1px solid #d6dfe5;
            border-radius: 6px;
            background: white;
            color: #394b58;
            font-size: 10px;
        }

        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.06);
        }

        .filter-btn {
            min-height: 42px;
            padding: 0 18px;
            border: none;
            border-radius: 6px;
            background: var(--secondary);
            color: var(--primary-dark);
            cursor: pointer;
            font-size: 10px;
            font-weight: 800;
        }

        .filter-btn:hover {
            background: #ffc31a;
        }

        .monthly-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
        }

        .charts-grid {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .chart-card {
            min-width: 0;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .chart-header {
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .chart-header h3 {
            color: var(--primary);
            font-size: 13px;
        }

        .chart-year {
            padding: 5px 8px;
            border-radius: 4px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 8px;
            font-weight: bold;
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 330px;
        }

        .note {
            margin-top: 20px;
            padding: 14px 16px;
            border: 1px solid #cfe0eb;
            border-left: 4px solid var(--primary);
            border-radius: 7px;
            background: var(--primary-light);
            color: #425c6d;
            font-size: 10px;
            line-height: 1.6;
        }

        .note strong {
            color: var(--primary);
        }

        .bottom-back {
            margin-top: 22px;
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

        @media (max-width: 1200px) {
            .statistics-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .monthly-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 950px) {
            .charts-grid {
                grid-template-columns: 1fr;
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

            .menu {
                grid-template-columns: repeat(2, 1fr);
            }

            .main {
                margin-left: 0;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .page-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .statistics-grid,
            .monthly-grid {
                grid-template-columns: 1fr;
            }

            .filter-form {
                display: block;
            }

            .form-group {
                width: 100%;
                min-width: 0;
                margin-bottom: 12px;
            }

            .filter-btn {
                width: 100%;
            }

            .chart-container {
                height: 290px;
            }

            .menu {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>

<body>

<div class="admin-layout">

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
                class="menu-link"
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
                class="menu-link active"
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

    <main class="main">

        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    Vietjet Administration
                </h2>

                <p>
                    Theo dõi hoạt động và doanh thu hệ thống
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
                        Thống kê hệ thống
                    </h1>

                    <p>
                        Theo dõi tình hình đặt vé,
                        số lượng khách hàng và doanh thu Vietjet.
                    </p>

                </div>

                <a
                    href="{{ route('admin.trang-chu') }}"
                    class="back-btn"
                >
                    ← Quay lại tổng quan
                </a>

            </div>

            <div class="section-heading">

                <div class="section-line"></div>

                <h2>
                    Tổng quan hệ thống
                </h2>

            </div>

            <div class="statistics-grid">

                <div class="stat-card">

                    <div class="stat-label">
                        Tổng khách hàng
                    </div>

                    <div class="stat-number">
                        {{ number_format($totalUsers) }}
                    </div>

                    <div class="stat-subtext">
                        Tài khoản khách hàng
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Tổng chuyến bay
                    </div>

                    <div class="stat-number">
                        {{ number_format($totalFlights) }}
                    </div>

                    <div class="stat-subtext">
                        Chuyến bay trong hệ thống
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Tổng đơn đặt vé
                    </div>

                    <div class="stat-number">
                        {{ number_format($totalBookings) }}
                    </div>

                    <div class="stat-subtext">
                        Tổng số booking
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Tổng số vé
                    </div>

                    <div class="stat-number">
                        {{ number_format($totalTickets) }}
                    </div>

                    <div class="stat-subtext">
                        Vé đã được tạo
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Đơn đã thanh toán
                    </div>

                    <div class="stat-number">
                        {{ number_format($paidBookings) }}
                    </div>

                    <div class="stat-subtext">
                        Booking thanh toán thành công
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Tổng doanh thu
                    </div>

                    <div class="stat-number revenue">
                        {{ number_format(
                            $totalRevenue,
                            0,
                            ',',
                            '.'
                        ) }} đ
                    </div>

                    <div class="stat-subtext">
                        Chỉ tính đơn đã thanh toán
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Tổng vé VIP
                    </div>

                    <div class="stat-number vip">
                        {{ number_format($vipTickets) }}
                    </div>

                    <div class="stat-subtext">
                        Vé hạng VIP
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Tổng vé Phổ thông
                    </div>

                    <div class="stat-number">
                        {{ number_format($economyTickets) }}
                    </div>

                    <div class="stat-subtext">
                        Vé hạng Phổ thông
                    </div>

                </div>

            </div>

            <div class="filter-card">

                <div class="filter-header">

                    <h3>
                        Thống kê theo tháng
                    </h3>

                    <p>
                        Chọn tháng và năm để xem
                        số liệu kinh doanh trong từng giai đoạn.
                    </p>

                </div>

                <form
                    action="{{ route('admin.statistics.index') }}"
                    method="GET"
                    class="filter-form"
                >

                    <div class="form-group">

                        <label for="month">
                            Tháng
                        </label>

                        <select
                            id="month"
                            name="month"
                        >

                            @for(
                                $month = 1;
                                $month <= 12;
                                $month++
                            )

                                <option
                                    value="{{ $month }}"
                                    {{ $selectedMonth == $month
                                        ? 'selected'
                                        : '' }}
                                >
                                    Tháng {{ $month }}
                                </option>

                            @endfor

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="year">
                            Năm
                        </label>

                        <select
                            id="year"
                            name="year"
                        >

                            @foreach($years as $year)

                                <option
                                    value="{{ $year }}"
                                    {{ $selectedYear == $year
                                        ? 'selected'
                                        : '' }}
                                >
                                    {{ $year }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="filter-btn"
                    >
                        Xem thống kê
                    </button>

                </form>

            </div>

            <div class="section-heading">

                <div class="section-line"></div>

                <h2>
                    Kết quả tháng
                    {{ $selectedMonth }}/{{ $selectedYear }}
                </h2>

            </div>

            <div class="monthly-grid">

                <div class="stat-card">

                    <div class="stat-label">
                        Đơn đã thanh toán
                    </div>

                    <div class="stat-number">
                        {{ number_format($monthlyPaidBookings) }}
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Số vé
                    </div>

                    <div class="stat-number">
                        {{ number_format($monthlyTickets) }}
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Vé VIP
                    </div>

                    <div class="stat-number vip">
                        {{ number_format($monthlyVipTickets) }}
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Vé Phổ thông
                    </div>

                    <div class="stat-number">
                        {{ number_format($monthlyEconomyTickets) }}
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-label">
                        Doanh thu tháng
                    </div>

                    <div class="stat-number revenue">
                        {{ number_format(
                            $monthlyRevenue,
                            0,
                            ',',
                            '.'
                        ) }} đ
                    </div>

                </div>

            </div>

            <div class="section-heading">

                <div class="section-line"></div>

                <h2>
                    Biểu đồ thống kê
                </h2>

            </div>

            <div class="charts-grid">

                <section class="chart-card">

                    <div class="chart-header">

                        <h3>
                            Doanh thu 12 tháng
                        </h3>

                        <span class="chart-year">
                            {{ $selectedYear }}
                        </span>

                    </div>

                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>

                </section>

                <section class="chart-card">

                    <div class="chart-header">

                        <h3>
                            Số vé theo tháng
                        </h3>

                        <span class="chart-year">
                            {{ $selectedYear }}
                        </span>

                    </div>

                    <div class="chart-container">
                        <canvas id="ticketChart"></canvas>
                    </div>

                </section>

            </div>

            <div class="note">

                <strong>Lưu ý:</strong>

                Doanh thu trong hệ thống chỉ tính
                các đơn đặt vé có trạng thái
                <strong>Đã thanh toán</strong>.

            </div>

            <div class="bottom-back">

                <a href="{{ route('admin.trang-chu') }}">
                    ← Quay lại trang quản trị
                </a>

            </div>

            <footer class="footer">

                <span>
                    Vietjet Administration
                </span>

                <span>
                    Thống kê hệ thống
                </span>

            </footer>

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const monthLabels = [
        'Tháng 1',
        'Tháng 2',
        'Tháng 3',
        'Tháng 4',
        'Tháng 5',
        'Tháng 6',
        'Tháng 7',
        'Tháng 8',
        'Tháng 9',
        'Tháng 10',
        'Tháng 11',
        'Tháng 12'
    ];

    const revenueData = @json($monthlyRevenueChart);

    const revenueCanvas =
        document.getElementById('revenueChart');

    new Chart(
        revenueCanvas,
        {
            type: 'bar',

            data: {
                labels: monthLabels,

                datasets: [
                    {
                        label: 'Doanh thu (VNĐ)',
                        data: revenueData,
                        backgroundColor: 'rgba(0, 59, 112, 0.72)',
                        borderColor: '#003b70',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },

                    y: {
                        beginAtZero: true,

                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },

                        ticks: {
                            font: {
                                size: 9
                            },

                            callback: function(value) {
                                return new Intl.NumberFormat(
                                    'vi-VN'
                                ).format(value) + ' đ';
                            }
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Doanh thu: '
                                    + new Intl.NumberFormat(
                                        'vi-VN'
                                    ).format(context.raw)
                                    + ' đ';
                            }
                        }
                    }
                }
            }
        }
    );

    const ticketData = @json($monthlyTicketChart);

    const ticketCanvas =
        document.getElementById('ticketChart');

    new Chart(
        ticketCanvas,
        {
            type: 'line',

            data: {
                labels: monthLabels,

                datasets: [
                    {
                        label: 'Số vé',
                        data: ticketData,
                        borderColor: '#003b70',
                        backgroundColor: 'rgba(0, 59, 112, 0.08)',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#f4b400',
                        pointBorderColor: '#003b70',
                        fill: true,
                        tension: 0.25
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },

                    y: {
                        beginAtZero: true,

                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },

                        ticks: {
                            precision: 0,

                            font: {
                                size: 9
                            }
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        }
    );
</script>

</body>
</html>