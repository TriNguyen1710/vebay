<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Quản lý vé - Vietjet Admin</title>

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
            --warning: #b88700;
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

        button,
        input,
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
            max-width: 1550px;
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

        .panel {
            margin-bottom: 20px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
            overflow: hidden;
        }

        .panel-header {
            min-height: 68px;
            padding: 17px 20px;
            border-bottom: 1px solid #e8edf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .panel-header h3 {
            margin-bottom: 4px;
            color: var(--primary);
            font-size: 14px;
        }

        .panel-header p {
            color: var(--muted);
            font-size: 9px;
        }

        .count-box {
            padding: 6px 10px;
            border-radius: 5px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 10px;
            font-weight: bold;
        }

        .filter-body {
            padding: 20px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr 1.4fr 1fr;
            gap: 14px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #465763;
            font-size: 10px;
            font-weight: bold;
        }

        .form-group input,
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

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.06);
        }

        .filter-actions {
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .btn-filter,
        .btn-reset {
            min-height: 39px;
            padding: 0 15px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .btn-filter {
            border: none;
            background: var(--secondary);
            color: var(--primary-dark);
            cursor: pointer;
        }

        .btn-filter:hover {
            background: #ffc31a;
        }

        .btn-reset {
            border: 1px solid var(--border);
            background: white;
            color: #687781;
        }

        .btn-reset:hover {
            background: #f6f8fa;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1750px;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 13px 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            color: #52616d;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        td {
            padding: 13px 12px;
            border-bottom: 1px solid #edf0f2;
            color: #435461;
            font-size: 10px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fbfcfd;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .booking-code,
        .ticket-code,
        .flight-code,
        .seat-number {
            color: var(--primary);
            font-weight: 800;
        }

        .user-name {
            display: block;
            margin-bottom: 4px;
            color: #344652;
            font-weight: 700;
        }

        .user-email {
            color: #8b969e;
            font-size: 9px;
        }

        .route-text {
            white-space: nowrap;
            color: #4d606d;
        }

        .price {
            white-space: nowrap;
            color: var(--primary-dark);
            font-weight: 800;
        }

        .baggage-text {
            white-space: nowrap;
            color: #465763;
            font-weight: 700;
        }

        .baggage-price {
            white-space: nowrap;
            color: #9b7200;
            font-weight: 800;
        }

        .order-total {
            white-space: nowrap;
            color: #b42318;
            font-weight: 800;
        }

        .date-text {
            white-space: nowrap;
            color: #64737e;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
        }

        .paid {
            background: #edf8f2;
            color: #17643d;
        }

        .unpaid {
            background: #fff8df;
            color: #806300;
        }

        .waiting-payment {
            background: #fff3cd;
            color: #7a5d00;
            border: 1px solid #ead58e;
        }

        .active {
            background: #edf8f2;
            color: #17643d;
        }

        .used {
            background: #f1f3f5;
            color: #66717a;
        }

        .cancelled {
            background: #fff0f1;
            color: #b02a37;
        }

        .pending {
            background: #f1f3f5;
            color: #66717a;
        }

        .vip {
            background: #fff7dc;
            color: #8b6800;
            border: 1px solid #ead68b;
        }

        .economy {
            background: #edf5fb;
            color: var(--primary);
        }

        .btn-view {
            min-height: 31px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #cddfe9;
            border-radius: 5px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 9px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn-view:hover {
            background: #dcecf6;
        }

        .empty {
            padding: 45px 20px;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
        }

        .bottom-actions {
            margin-top: 20px;
        }

        .bottom-back {
            color: var(--primary);
            font-size: 11px;
            font-weight: bold;
        }

        .bottom-back:hover {
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

        @media (max-width: 1250px) {
            .filter-grid {
                grid-template-columns: repeat(3, 1fr);
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

            .filter-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-filter,
            .btn-reset {
                width: 100%;
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
                class="menu-link active"
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
                    Quản lý vé hành khách
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
                        Quản lý vé
                    </h1>

                    <p>
                        Tìm kiếm, lọc và theo dõi từng vé
                        khách hàng đã đặt trong hệ thống.
                    </p>

                </div>

                <a
                    href="{{ route('admin.trang-chu') }}"
                    class="back-btn"
                >
                    ← Quay lại tổng quan
                </a>

            </div>

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h3>
                            Tìm kiếm và lọc vé
                        </h3>

                        <p>
                            Có thể kết hợp nhiều điều kiện
                            để tìm đúng vé cần quản lý.
                        </p>

                    </div>

                    <span class="count-box">
                        {{ $tickets->count() }} vé
                    </span>

                </div>

                <div class="filter-body">

                    <form
                        action="{{ route('admin.bookings.index') }}"
                        method="GET"
                    >

                        <div class="filter-grid">

                            <div class="form-group">

                                <label for="keyword">
                                    Tìm kiếm
                                </label>

                                <input
                                    type="text"
                                    id="keyword"
                                    name="keyword"
                                    value="{{ request('keyword') }}"
                                    placeholder="Mã đặt vé, mã vé, tên hành khách..."
                                >

                            </div>

                            <div class="form-group">

                                <label for="payment_status">
                                    Thanh toán
                                </label>

                                <select
                                    id="payment_status"
                                    name="payment_status"
                                >

                                    <option value="">
                                        Tất cả
                                    </option>

                                    <option
                                        value="paid"
                                        {{ request('payment_status') === 'paid' ? 'selected' : '' }}
                                    >
                                        Đã thanh toán
                                    </option>

                                    <option
                                        value="unpaid"
                                        {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}
                                    >
                                        Chưa thanh toán
                                    </option>

                                    <option
                                        value="waiting_confirmation"
                                        {{ request('payment_status') === 'waiting_confirmation' ? 'selected' : '' }}
                                    >
                                        Chờ Admin xác nhận
                                    </option>

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="ticket_status">
                                    Trạng thái vé
                                </label>

                                <select
                                    id="ticket_status"
                                    name="ticket_status"
                                >

                                    <option value="">
                                        Tất cả
                                    </option>

                                    <option
                                        value="pending"
                                        {{ request('ticket_status') === 'pending' ? 'selected' : '' }}
                                    >
                                        Chờ xác nhận
                                    </option>

                                    <option
                                        value="active"
                                        {{ request('ticket_status') === 'active' ? 'selected' : '' }}
                                    >
                                        Có hiệu lực
                                    </option>

                                    <option
                                        value="used"
                                        {{ request('ticket_status') === 'used' ? 'selected' : '' }}
                                    >
                                        Đã sử dụng
                                    </option>

                                    <option
                                        value="cancelled"
                                        {{ request('ticket_status') === 'cancelled' ? 'selected' : '' }}
                                    >
                                        Đã hủy
                                    </option>

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="seat_class">
                                    Hạng ghế
                                </label>

                                <select
                                    id="seat_class"
                                    name="seat_class"
                                >

                                    <option value="">
                                        Tất cả
                                    </option>

                                    <option
                                        value="vip"
                                        {{ request('seat_class') === 'vip' ? 'selected' : '' }}
                                    >
                                        VIP
                                    </option>

                                    <option
                                        value="economy"
                                        {{ request('seat_class') === 'economy' ? 'selected' : '' }}
                                    >
                                        Phổ thông
                                    </option>

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="flight_id">
                                    Chuyến bay
                                </label>

                                <select
                                    id="flight_id"
                                    name="flight_id"
                                >

                                    <option value="">
                                        Tất cả chuyến bay
                                    </option>

                                    @foreach($flights as $flight)

                                        <option
                                            value="{{ $flight->id }}"
                                            {{ (string) request('flight_id') === (string) $flight->id ? 'selected' : '' }}
                                        >
                                            {{ $flight->flight_code }}
                                            -
                                            {{ $flight->departureAirport->city }}
                                            →
                                            {{ $flight->arrivalAirport->city }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="flight_date">
                                    Ngày bay
                                </label>

                                <input
                                    type="date"
                                    id="flight_date"
                                    name="flight_date"
                                    value="{{ request('flight_date') }}"
                                >

                            </div>

                        </div>

                        <div class="filter-actions">

                            <button
                                type="submit"
                                class="btn-filter"
                            >
                                Tìm / Lọc
                            </button>

                            <a
                                href="{{ route('admin.bookings.index') }}"
                                class="btn-reset"
                            >
                                Đặt lại bộ lọc
                            </a>

                        </div>

                    </form>

                </div>

            </section>

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h3>
                            Danh sách vé
                        </h3>

                        <p>
                            Mỗi dòng tương ứng với một vé hành khách.
                        </p>

                    </div>

                    <span class="count-box">
                        {{ $tickets->count() }} vé
                    </span>

                </div>

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>Mã đặt vé</th>
                                <th>Khách đặt</th>
                                <th>Mã vé</th>
                                <th>Hành khách</th>
                                <th>Chuyến bay</th>
                                <th>Hành trình</th>
                                <th>Ghế</th>
                                <th>Hạng ghế</th>
                                <th>Giá vé</th>
                                <th>Hành lý ký gửi</th>
                                <th>Phí hành lý</th>
                                <th>Tổng đơn</th>
                                <th>Trạng thái vé</th>
                                <th>Thanh toán</th>
                                <th>Ngày đặt</th>
                                <th>Thao tác</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($tickets as $ticket)

                            @php
                                $booking = $ticket->booking;
                                $flight = $ticket->flight;
                            @endphp

                            <tr>

                                <td>

                                    <span class="booking-code">
                                        {{ $booking->booking_code ?? '-' }}
                                    </span>

                                </td>

                                <td>

                                    <span class="user-name">
                                        {{ $booking?->user?->name ?? 'Không xác định' }}
                                    </span>

                                    <span class="user-email">
                                        {{ $booking?->user?->email ?? '' }}
                                    </span>

                                </td>

                                <td>

                                    <span class="ticket-code">
                                        {{ $ticket->ticket_code }}
                                    </span>

                                </td>

                                <td>
                                    {{ $ticket->passenger_name }}
                                </td>

                                <td>

                                    <span class="flight-code">
                                        {{ $flight?->flight_code ?? '-' }}
                                    </span>

                                </td>

                                <td>

                                    @if(
                                        $flight &&
                                        $flight->departureAirport &&
                                        $flight->arrivalAirport
                                    )

                                        <span class="route-text">

                                            {{ $flight->departureAirport->city }}

                                            →

                                            {{ $flight->arrivalAirport->city }}

                                        </span>

                                    @else

                                        -

                                    @endif

                                </td>

                                <td>

                                    @if($ticket->flightSeat)

                                        <span class="seat-number">
                                            {{ $ticket->flightSeat->seat_number }}
                                        </span>

                                    @else

                                        -

                                    @endif

                                </td>

                                <td>

                                    @if($ticket->seat_class === 'vip')

                                        <span class="badge vip">
                                            VIP
                                        </span>

                                    @else

                                        <span class="badge economy">
                                            Phổ thông
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="price">

                                        {{ number_format(
                                            $ticket->price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ

                                    </span>

                                </td>

                                <td>

                                    <span class="baggage-text">

                                        @if((int) $ticket->baggage_weight > 0)
                                            {{ (int) $ticket->baggage_weight }} kg
                                        @else
                                            Không mua thêm
                                        @endif

                                    </span>

                                </td>

                                <td>

                                    <span class="baggage-price">

                                        {{ number_format(
                                            (float) $ticket->baggage_price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ

                                    </span>

                                </td>

                                <td>

                                    <span class="order-total">

                                        {{ number_format(
                                            (float) ($booking?->total_amount ?? 0),
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ

                                    </span>

                                </td>

                                <td>

                                    @if($ticket->ticket_status === 'active')

                                        <span class="badge active">
                                            Có hiệu lực
                                        </span>

                                    @elseif($ticket->ticket_status === 'used')

                                        <span class="badge used">
                                            Đã sử dụng
                                        </span>

                                    @elseif($ticket->ticket_status === 'cancelled')

                                        <span class="badge cancelled">
                                            Đã hủy
                                        </span>

                                    @else

                                        <span class="badge pending">
                                            Chờ xác nhận
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($booking?->payment_status === 'paid')

                                        <span class="badge paid">
                                            Đã thanh toán
                                        </span>

                                    @elseif($booking?->payment_status === 'waiting_confirmation')

                                        <span class="badge waiting-payment">
                                            Chờ xác nhận
                                        </span>

                                    @else

                                        <span class="badge unpaid">
                                            Chưa thanh toán
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="date-text">

                                        @if($booking?->created_at)

                                            {{ $booking->created_at
                                                ->timezone('Asia/Ho_Chi_Minh')
                                                ->format('d/m/Y H:i') }}

                                        @else

                                            -

                                        @endif

                                    </span>

                                </td>

                                <td>

                                    @if($booking)

                                        <a
                                            href="{{ route(
                                                'admin.bookings.show',
                                                $booking->id
                                            ) }}"
                                            class="btn-view"
                                        >
                                            Xem chi tiết
                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="16"
                                    class="empty"
                                >
                                    Không tìm thấy vé phù hợp.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            <div class="bottom-actions">

                <a
                    href="{{ route('admin.trang-chu') }}"
                    class="bottom-back"
                >
                    ← Quay lại trang quản trị
                </a>

            </div>

            <footer class="footer">

                <span>
                    Vietjet Administration
                </span>

                <span>
                    Quản lý vé
                </span>

            </footer>

        </div>

    </main>

</div>

</body>

</html>