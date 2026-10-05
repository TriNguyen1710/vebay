<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Hành khách chuyến bay - SkyGo</title>

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

        .employee-layout {
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
            margin-bottom: 7px;
            color: white;
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .employee-label {
            padding: 0 11px;
            margin-bottom: 31px;
            color: #8ca5b6;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
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

        .employee-info {
            padding: 0 11px 16px;
        }

        .employee-info strong {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .employee-info span {
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

        .employee-badge {
            padding: 7px 11px;
            border: 1px solid #cbdce7;
            border-radius: 5px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 10px;
            font-weight: bold;
        }

        .content {
            max-width: 1350px;
            margin: auto;
            padding: 28px 30px 45px;
        }

        .page-heading {
            margin-bottom: 20px;
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
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .back-btn:hover {
            background: #f6f8fa;
        }

        .flight-card {
            margin-bottom: 18px;
            padding: 22px 24px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .flight-top {
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .flight-code-label {
            margin-bottom: 5px;
            color: var(--muted);
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .flight-code {
            color: var(--primary);
            font-size: 22px;
            font-weight: 800;
        }

        .flight-status {
            padding: 6px 9px;
            border-radius: 5px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 8px;
            font-weight: bold;
        }

        .route-box {
            padding: 17px 18px;
            border: 1px solid #e4eaee;
            border-radius: 8px;
            background: #f9fbfc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
        }

        .airport {
            flex: 1;
        }

        .airport.right {
            text-align: right;
        }

        .airport-code {
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
            min-width: 160px;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .route-line::before,
        .route-line::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #cdd9e0;
        }

        .route-line svg {
            width: 19px;
            height: 19px;
            fill: none;
            stroke: var(--primary);
            stroke-width: 1.7;
        }

        .flight-details {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .detail-item {
            padding: 12px 14px;
            border: 1px solid #e7ecef;
            border-radius: 7px;
            background: #fbfcfd;
        }

        .detail-label {
            margin-bottom: 5px;
            color: var(--muted);
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .detail-value {
            color: #394b58;
            font-size: 15px;
            font-weight: 800;
        }

        .detail-note {
            margin-top: 4px;
            color: var(--muted);
            font-size: 8px;
        }

        .statistics {
            margin-top: 12px;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .stat-card {
            padding: 15px 14px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
        }

        .stat-label {
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 8px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .stat-value {
            color: var(--primary);
            font-size: 22px;
            font-weight: 800;
        }

        .stat-unit {
            margin-left: 3px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 600;
        }

        .stat-card.checked .stat-value {
            color: var(--success);
        }

        .stat-card.unchecked .stat-value {
            color: #9b7200;
        }

        .stat-card.available .stat-value {
            color: #52616d;
        }

        .alert {
            margin-bottom: 16px;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 10px;
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
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
            overflow: hidden;
        }

        .panel-header {
            min-height: 64px;
            padding: 16px 19px;
            border-bottom: 1px solid #e8edf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .panel-header h3 {
            margin-bottom: 4px;
            color: var(--primary);
            font-size: 13px;
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
            font-size: 9px;
            font-weight: bold;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1120px;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 12px 13px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            color: #52616d;
            font-size: 8px;
            font-weight: 800;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 14px 13px;
            border-bottom: 1px solid #edf0f2;
            color: #435461;
            font-size: 9px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fbfcfd;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .ticket-code {
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
        }

        .passenger-name {
            color: var(--primary-dark);
            font-size: 10px;
            font-weight: 700;
        }

        .seat-number {
            min-width: 32px;
            padding: 5px 8px;
            display: inline-flex;
            justify-content: center;
            border: 1px solid #cedde7;
            border-radius: 4px;
            background: #f7fafc;
            color: var(--primary);
            font-weight: 800;
        }

        .baggage-weight {
            color: var(--primary-dark);
            font-weight: 800;
            white-space: nowrap;
        }

        .baggage-price {
            color: #9b7200;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge {
            padding: 5px 8px;
            display: inline-flex;
            align-items: center;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-vip {
            background: #fff8df;
            color: #856700;
            border: 1px solid #ead58e;
        }

        .badge-economy {
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid #c8dce8;
        }

        .status-active {
            background: #fff8df;
            color: #7a6000;
        }

        .status-used {
            background: #edf8f2;
            color: #17643d;
        }

        .status-other {
            background: #f0f2f4;
            color: #68747c;
        }

        .face-btn {
            min-height: 31px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            background: var(--primary);
            color: white;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
        }

        .face-btn:hover {
            background: var(--primary-dark);
        }

        .no-face {
            color: var(--muted);
            font-size: 8px;
            font-weight: 600;
        }

        .empty {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-icon svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.6;
        }

        .empty h3 {
            margin-bottom: 7px;
            color: var(--primary-dark);
            font-size: 14px;
        }

        .empty p {
            color: var(--muted);
            font-size: 9px;
        }

        .bottom-back {
            margin-top: 20px;
        }

        .bottom-back a {
            color: var(--primary);
            font-size: 10px;
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

        @media (max-width: 1100px) {
            .statistics {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .employee-layout {
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

            .flight-details {
                grid-template-columns: repeat(2, 1fr);
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

            .route-box {
                align-items: stretch;
                flex-direction: column;
            }

            .airport.right {
                text-align: left;
            }

            .route-line {
                min-width: 0;
                width: 100%;
            }

            .flight-details,
            .statistics {
                grid-template-columns: 1fr;
            }

            .panel-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .menu {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@php
    $totalSeats = $flight->aircraft->total_seats ?? 0;

    if ($totalSeats <= 0 && $flight->aircraft) {
        $totalSeats =
            ($flight->aircraft->rows ?? 0)
            * ($flight->aircraft->seats_per_row ?? 0);
    }

    $totalPassengers = $tickets
        ->whereIn('ticket_status', ['active', 'used'])
        ->count();

    $checkedPassengers = $tickets
        ->where('ticket_status', 'used')
        ->count();

    $uncheckedPassengers = $tickets
        ->where('ticket_status', 'active')
        ->count();

    $availableSeats = max(
        0,
        $totalSeats - $totalPassengers
    );
@endphp

<div class="employee-layout">

    <aside class="sidebar">

        <a
            href="{{ route('nhanvien.trang-chu') }}"
            class="logo"
        >
            Sky<span>Go</span>
        </a>

        <div class="employee-label">
            Khu vực nhân viên sân bay
        </div>

        <div class="menu-title">
            NGHIỆP VỤ
        </div>

        <nav class="menu">

            <a
                href="{{ route('nhanvien.trang-chu') }}"
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
                href="{{ route('nhanvien.tickets.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 5h16v14H4z"/>
                        <path d="M8 9h8"/>
                        <path d="M8 13h5"/>
                    </svg>
                </span>

                Tra cứu vé
            </a>

            <a
                href="{{ route('nhanvien.passengers.unchecked') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                        <path d="M16 11a4 4 0 0 1 5 4"/>
                    </svg>
                </span>

                Hành khách chưa kiểm tra
            </a>

            <a
                href="{{ route('nhanvien.flights.index') }}"
                class="menu-link active"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                    </svg>
                </span>

                Danh sách chuyến bay
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="employee-info">
                <strong>
                    {{ auth()->user()->name }}
                </strong>

                <span>
                    Nhân viên sân bay
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
                    SkyGo Airport Operations
                </h2>

                <p>
                    Kiểm tra hành khách theo từng chuyến bay
                </p>
            </div>

            <span class="employee-badge">
                NHÂN VIÊN
            </span>

        </header>

        <div class="content">

            <div class="page-heading">

                <div>
                    <h1>
                        Hành khách chuyến bay
                    </h1>

                    <p>
                        Thông tin số lượng hành khách và danh sách hành khách
                        thuộc chuyến {{ $flight->flight_code }}.
                    </p>
                </div>

                <a
                    href="{{ route('nhanvien.flights.index') }}"
                    class="back-btn"
                >
                    ← Quay lại danh sách chuyến bay
                </a>

            </div>

            <section class="flight-card">

                <div class="flight-top">

                    <div>
                        <div class="flight-code-label">
                            Mã chuyến bay
                        </div>

                        <div class="flight-code">
                            {{ $flight->flight_code }}
                        </div>
                    </div>

                    <span class="flight-status">
                        THÔNG TIN CHUYẾN
                    </span>

                </div>

                <div class="route-box">

                    <div class="airport">
                        <div class="airport-code">
                            {{ $flight->departureAirport->code ?? '---' }}
                        </div>

                        <div class="airport-city">
                            {{ $flight->departureAirport->city ?? '---' }}
                        </div>
                    </div>

                    <div class="route-line">
                        <svg viewBox="0 0 24 24">
                            <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                        </svg>
                    </div>

                    <div class="airport right">
                        <div class="airport-code">
                            {{ $flight->arrivalAirport->code ?? '---' }}
                        </div>

                        <div class="airport-city">
                            {{ $flight->arrivalAirport->city ?? '---' }}
                        </div>
                    </div>

                </div>

                <div class="flight-details">

                    <div class="detail-item">
                        <div class="detail-label">
                            Ngày bay
                        </div>

                        <div class="detail-value">
                            {{ \Carbon\Carbon::parse(
                                $flight->flight_date
                            )->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            Giờ khởi hành
                        </div>

                        <div class="detail-value">
                            {{ substr(
                                $flight->departure_time,
                                0,
                                5
                            ) }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            Máy bay
                        </div>

                        <div class="detail-value">
                            {{ $flight->aircraft->code ?? '---' }}
                        </div>

                        <div class="detail-note">
                            {{ $flight->aircraft->name ?? 'Không có thông tin' }}
                        </div>
                    </div>

                </div>

                <div class="statistics">

                    <div class="stat-card">
                        <div class="stat-label">
                            Sức chứa máy bay
                        </div>

                        <span class="stat-value">
                            {{ $totalSeats }}
                        </span>

                        <span class="stat-unit">
                            hành khách
                        </span>
                    </div>

                    <div class="stat-card">
                        <div class="stat-label">
                            Đã đặt vé
                        </div>

                        <span class="stat-value">
                            {{ $totalPassengers }}
                        </span>

                        <span class="stat-unit">
                            hành khách
                        </span>
                    </div>

                    <div class="stat-card available">
                        <div class="stat-label">
                            Ghế còn trống
                        </div>

                        <span class="stat-value">
                            {{ $availableSeats }}
                        </span>

                        <span class="stat-unit">
                            ghế
                        </span>
                    </div>

                    <div class="stat-card checked">
                        <div class="stat-label">
                            Đã kiểm tra
                        </div>

                        <span class="stat-value">
                            {{ $checkedPassengers }}
                        </span>

                        <span class="stat-unit">
                            hành khách
                        </span>
                    </div>

                    <div class="stat-card unchecked">
                        <div class="stat-label">
                            Chưa kiểm tra
                        </div>

                        <span class="stat-value">
                            {{ $uncheckedPassengers }}
                        </span>

                        <span class="stat-unit">
                            hành khách
                        </span>
                    </div>

                </div>

            </section>

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
                            Danh sách hành khách
                        </h3>

                        <p>
                            Theo dõi ghế và trạng thái kiểm tra
                            của từng hành khách trên chuyến bay.
                        </p>
                    </div>

                    <span class="count-box">
                        {{ $totalPassengers }} hành khách
                    </span>

                </div>

                @if($tickets->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>Mã vé</th>
                                    <th>Hành khách</th>
                                    <th>CCCD / Hộ chiếu</th>
                                    <th>Ghế</th>
                                    <th>Hạng</th>
                                    <th>Hành lý ký gửi</th>
                                    <th>Phí hành lý</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($tickets as $ticket)

                                <tr>

                                    <td>
                                        <span class="ticket-code">
                                            {{ $ticket->ticket_code }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="passenger-name">
                                            {{ $ticket->passenger_name }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $ticket->identity_number ?? '---' }}
                                    </td>

                                    <td>
                                        <span class="seat-number">
                                            {{ $ticket->flightSeat->seat_number ?? '---' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($ticket->seat_class === 'vip')

                                            <span class="badge badge-vip">
                                                VIP
                                            </span>

                                        @else

                                            <span class="badge badge-economy">
                                                Phổ thông
                                            </span>

                                        @endif
                                    </td>


                                    <td>

                                        <span class="baggage-weight">

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
                                        @if($ticket->ticket_status === 'used')

                                            <span class="badge status-used">
                                                Đã kiểm tra
                                            </span>

                                        @elseif($ticket->ticket_status === 'active')

                                            <span class="badge status-active">
                                                Chưa kiểm tra
                                            </span>

                                        @else

                                            <span class="badge status-other">
                                                {{ $ticket->ticket_status }}
                                            </span>

                                        @endif
                                    </td>

                                    <td>
                                        @if($ticket->ticket_status === 'active')

                                            @if($ticket->face_image)

                                                <a
                                                    href="{{ route(
                                                        'nhanvien.tickets.face',
                                                        $ticket->id
                                                    ) }}"
                                                    class="face-btn"
                                                >
                                                    Nhận diện khuôn mặt
                                                </a>

                                            @else

                                                <span class="no-face">
                                                    Chưa có ảnh khuôn mặt
                                                </span>

                                            @endif

                                        @else

                                            ---

                                        @endif
                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty">

                        <div class="empty-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="9" cy="8" r="4"/>
                                <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                            </svg>
                        </div>

                        <h3>
                            Chưa có hành khách
                        </h3>

                        <p>
                            Chưa có hành khách đã thanh toán
                            trên chuyến bay này.
                        </p>

                    </div>

                @endif

            </section>

            <div class="bottom-back">
                <a href="{{ route('nhanvien.flights.index') }}">
                    ← Quay lại danh sách chuyến bay
                </a>
            </div>

            <footer class="footer">
                <span>
                    SkyGo Airport Operations
                </span>

                <span>
                    Hành khách chuyến {{ $flight->flight_code }}
                </span>
            </footer>

        </div>

    </main>

</div>

</body>

</html>