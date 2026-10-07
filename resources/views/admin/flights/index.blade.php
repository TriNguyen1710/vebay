<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Quản lý chuyến bay - Vietjet Admin</title>

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
            --info: #1677a3;
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

        .page-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .btn {
            min-height: 38px;
            padding: 0 15px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-back {
            border: 1px solid var(--border);
            background: white;
            color: var(--primary);
        }

        .btn-back:hover {
            background: #f6f8fa;
        }

        .btn-add {
            border: none;
            background: var(--secondary);
            color: var(--primary-dark);
        }

        .btn-add:hover {
            background: #ffc31a;
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 11px;
            line-height: 1.6;
        }

        .alert-success {
            background: #edf8f2;
            border: 1px solid #badfc9;
            border-left: 4px solid var(--success);
            color: #17643d;
        }

        .alert-error {
            background: #fff0f1;
            border: 1px solid #efc0c5;
            border-left: 4px solid var(--danger);
            color: #a52a36;
        }

        .panel {
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

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1500px;
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

        .flight-code {
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
        }

        .aircraft-name {
            color: #3f5260;
            line-height: 1.5;
        }

        .route-main {
            margin-bottom: 4px;
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .route-city {
            color: var(--muted);
            font-size: 9px;
            white-space: nowrap;
        }

        .date-value {
            white-space: nowrap;
            font-weight: 600;
        }

        .time-value {
            white-space: nowrap;
            color: var(--primary);
            font-weight: 700;
        }

        .price-group {
            min-width: 130px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            line-height: 1.8;
        }

        .price-row span {
            color: var(--muted);
            font-size: 9px;
        }

        .price-row strong {
            color: var(--primary-dark);
            font-size: 10px;
            white-space: nowrap;
        }

        .price-row.vip-price span,
        .price-row.vip-price strong {
            color: #9a7200;
        }

        .seat-stats {
            min-width: 95px;
        }

        .seat-line {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            line-height: 1.8;
        }

        .seat-line span {
            color: var(--muted);
            font-size: 9px;
        }

        .seat-line strong {
            font-size: 10px;
        }

        .seat-total {
            color: var(--primary-dark);
        }

        .seat-booked {
            color: var(--danger);
        }

        .seat-available {
            color: var(--success);
        }

        .seat-empty {
            color: var(--muted);
            font-size: 9px;
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

        .seat-none {
            background: #f1f3f5;
            color: #69747d;
        }

        .seat-full {
            background: #fff0f1;
            color: #b02a37;
        }

        .seat-low {
            background: #fff7dc;
            color: #836400;
        }

        .seat-good {
            background: #edf8f2;
            color: #17643d;
        }

        .status-open {
            background: #edf8f2;
            color: #17643d;
        }

        .status-closed {
            background: #fff7dc;
            color: #806300;
        }

        .status-completed {
            background: var(--primary-light);
            color: var(--primary);
        }

        .status-cancelled {
            background: #fff0f1;
            color: #b02a37;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .actions form {
            margin: 0;
        }

        .action-btn {
            height: 32px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
            line-height: 1;
        }

        .btn-seat {
            min-width: 78px;
            border: 1px solid #bfd9e4;
            background: #eef8fc;
            color: var(--info);
        }

        .btn-seat:hover {
            background: #dff1f8;
        }

        .btn-edit,
        .btn-delete {
            width: 55px;
            padding: 0;
        }

        .btn-edit {
            border: 1px solid #d3b64d;
            background: #fff7d6;
            color: #765800;
        }

        .btn-edit:hover {
            background: #ffed9e;
            border-color: #c6a62f;
        }

        .btn-delete {
            border: 1px solid #e7b8bd;
            background: #fff0f1;
            color: #b02a37;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fddfe2;
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
                align-items: flex-start;
                flex-direction: column;
            }

            .page-actions {
                width: 100%;
            }

            .page-actions .btn {
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

    <main class="main">

        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    Vietjet Administration
                </h2>

                <p>
                    Quản lý lịch bay và tình trạng ghế
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
                        Quản lý chuyến bay
                    </h1>

                    <p>
                        Theo dõi chuyến bay, giá vé,
                        ghế trống và trạng thái mở bán.
                    </p>

                </div>

                <div class="page-actions">

                    <a
                        href="{{ route('admin.trang-chu') }}"
                        class="btn btn-back"
                    >
                        ← Quay lại
                    </a>

                    <a
                        href="{{ route('admin.flights.create') }}"
                        class="btn btn-add"
                    >
                        + Thêm chuyến bay
                    </a>

                </div>

            </div>

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif

            @if(session('error'))

                <div class="alert alert-error">
                    {{ session('error') }}
                </div>

            @endif

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h3>
                            Danh sách chuyến bay
                        </h3>

                        <p>
                            Quản lý lịch bay, máy bay,
                            giá vé và sơ đồ ghế.
                        </p>

                    </div>

                    <span class="count-box">
                        {{ $flights->count() }} chuyến bay
                    </span>

                </div>

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>STT</th>
                                <th>Mã chuyến</th>
                                <th>Máy bay</th>
                                <th>Hành trình</th>
                                <th>Ngày bay</th>
                                <th>Giờ</th>
                                <th>Giá vé</th>
                                <th>Ghế</th>
                                <th>Tình trạng ghế</th>
                                <th>Trạng thái chuyến</th>
                                <th>Thao tác</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($flights as $flight)

                            @php
                                $totalSeats = $flight->flightSeats->count();

                                $bookedSeats = $flight->flightSeats
                                    ->where('status', 'booked')
                                    ->count();

                                $availableSeats = $flight->flightSeats
                                    ->where('status', 'available')
                                    ->count();

                                if ($totalSeats === 0) {
                                    $seatStatus = 'Chưa tạo ghế';
                                    $seatStatusClass = 'seat-none';
                                } elseif ($availableSeats === 0) {
                                    $seatStatus = 'Hết ghế';
                                    $seatStatusClass = 'seat-full';
                                } elseif ($availableSeats <= 20) {
                                    $seatStatus = 'Sắp hết ghế';
                                    $seatStatusClass = 'seat-low';
                                } else {
                                    $seatStatus = 'Còn ghế';
                                    $seatStatusClass = 'seat-good';
                                }
                            @endphp

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <span class="flight-code">
                                        {{ $flight->flight_code }}
                                    </span>
                                </td>

                                <td>

                                    <div class="aircraft-name">

                                        <strong>
                                            {{ $flight->aircraft->code }}
                                        </strong>

                                        <br>

                                        {{ $flight->aircraft->name }}

                                    </div>

                                </td>

                                <td>

                                    <div class="route-main">
                                        {{ $flight->departureAirport->code }}
                                        →
                                        {{ $flight->arrivalAirport->code }}
                                    </div>

                                    <div class="route-city">
                                        {{ $flight->departureAirport->city }}
                                        →
                                        {{ $flight->arrivalAirport->city }}
                                    </div>

                                </td>

                                <td>

                                    <span class="date-value">
                                        {{ \Carbon\Carbon::parse(
                                            $flight->flight_date
                                        )->format('d/m/Y') }}
                                    </span>

                                </td>

                                <td>

                                    <span class="time-value">
                                        {{ substr(
                                            $flight->departure_time,
                                            0,
                                            5
                                        ) }}

                                        →

                                        {{ substr(
                                            $flight->arrival_time,
                                            0,
                                            5
                                        ) }}
                                    </span>

                                </td>

                                <td>

                                    <div class="price-group">

                                        <div class="price-row">

                                            <span>
                                                Phổ thông
                                            </span>

                                            <strong>
                                                {{ number_format(
                                                    $flight->price,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}đ
                                            </strong>

                                        </div>

                                        <div class="price-row vip-price">

                                            <span>
                                                VIP
                                            </span>

                                            <strong>
                                                {{ number_format(
                                                    $flight->vip_price,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}đ
                                            </strong>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    @if($totalSeats > 0)

                                        <div class="seat-stats">

                                            <div class="seat-line">

                                                <span>
                                                    Tổng
                                                </span>

                                                <strong class="seat-total">
                                                    {{ $totalSeats }}
                                                </strong>

                                            </div>

                                            <div class="seat-line">

                                                <span>
                                                    Đã đặt
                                                </span>

                                                <strong class="seat-booked">
                                                    {{ $bookedSeats }}
                                                </strong>

                                            </div>

                                            <div class="seat-line">

                                                <span>
                                                    Còn
                                                </span>

                                                <strong class="seat-available">
                                                    {{ $availableSeats }}
                                                </strong>

                                            </div>

                                        </div>

                                    @else

                                        <span class="seat-empty">
                                            Chưa tạo
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="badge {{ $seatStatusClass }}">
                                        {{ $seatStatus }}
                                    </span>

                                </td>

                                <td>

                                    @if($flight->status === 'open')

                                        <span class="badge status-open">
                                            Đang mở bán
                                        </span>

                                    @elseif($flight->status === 'closed')

                                        <span class="badge status-closed">
                                            Đã đóng
                                        </span>

                                    @elseif($flight->status === 'completed')

                                        <span class="badge status-completed">
                                            Hoàn thành
                                        </span>

                                    @else

                                        <span class="badge status-cancelled">
                                            Đã hủy
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route(
                                                'admin.flight-seats.index',
                                                $flight->id
                                            ) }}"
                                            class="action-btn btn-seat"
                                        >
                                            Sơ đồ ghế
                                        </a>

                                        <a
                                            href="{{ route(
                                                'admin.flights.edit',
                                                $flight->id
                                            ) }}"
                                            class="action-btn btn-edit"
                                        >
                                            Sửa
                                        </a>

                                        <form
                                            action="{{ route(
                                                'admin.flights.destroy',
                                                $flight->id
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa chuyến bay này?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn btn-delete"
                                            >
                                                Xóa
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="11"
                                    class="empty"
                                >
                                    Chưa có chuyến bay nào.
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
                    Quản lý chuyến bay
                </span>

            </footer>

        </div>

    </main>

</div>

</body>

</html>