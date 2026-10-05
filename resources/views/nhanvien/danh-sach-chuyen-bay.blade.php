<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Danh sách chuyến bay - Vietjet Nhân viên</title>

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

        button,
        input,
        select {
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
            font-size: 27px;
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
            max-width: 1500px;
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
            max-width: 760px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
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

        .filter-card {
            margin-bottom: 16px;
            padding: 18px 20px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .filter-header {
            margin-bottom: 14px;
        }

        .filter-header h3 {
            margin-bottom: 4px;
            color: var(--primary);
            font-size: 13px;
        }

        .filter-header p {
            color: var(--muted);
            font-size: 9px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: minmax(230px, 1fr) 170px 170px 190px auto auto;
            gap: 10px;
        }

        .filter-form input,
        .filter-form select {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #d5dee5;
            border-radius: 6px;
            background: white;
            color: #394b58;
            font-size: 10px;
        }

        .filter-form input:focus,
        .filter-form select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.06);
        }

        .search-btn,
        .reset-btn {
            min-height: 43px;
            padding: 0 17px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .search-btn {
            border: none;
            background: var(--secondary);
            color: var(--primary-dark);
            cursor: pointer;
        }

        .search-btn:hover {
            background: #ffc31a;
        }

        .reset-btn {
            border: 1px solid var(--border);
            background: white;
            color: var(--primary);
        }

        .reset-btn:hover {
            background: #f6f8fa;
        }

        .summary-grid {
            margin-bottom: 16px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .summary-card {
            padding: 17px 18px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .summary-title {
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .summary-value {
            color: var(--primary);
            font-size: 24px;
            font-weight: 800;
        }

        .summary-note {
            margin-top: 5px;
            color: #9aa4aa;
            font-size: 8px;
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
            white-space: nowrap;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1400px;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 12px 11px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            color: #52616d;
            font-size: 8px;
            font-weight: 800;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 13px 11px;
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

        .flight-code {
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .route-city {
            display: block;
            margin-bottom: 4px;
            color: var(--primary-dark);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .route-code {
            color: var(--muted);
            font-size: 8px;
            white-space: nowrap;
        }

        .flight-date {
            font-weight: 700;
            white-space: nowrap;
        }

        .flight-time {
            white-space: nowrap;
        }

        .departure-time {
            color: var(--primary-dark);
            font-weight: 800;
        }

        .aircraft-code {
            display: block;
            margin-bottom: 4px;
            color: var(--primary-dark);
            font-weight: 800;
        }

        .aircraft-name {
            color: var(--muted);
            font-size: 8px;
        }

        .passenger-count {
            color: var(--primary);
            font-weight: 800;
            white-space: nowrap;
        }

        .passenger-count small {
            color: var(--muted);
            font-size: 8px;
            font-weight: 600;
        }

        .checked-count,
        .unchecked-count {
            min-width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 9px;
            font-weight: 800;
        }

        .checked-count {
            background: #edf8f2;
            color: #17643d;
        }

        .unchecked-count {
            background: #fff8df;
            color: #765d00;
        }

        .unchecked-count.zero {
            background: #edf8f2;
            color: #17643d;
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

        .status-open {
            background: #edf8f2;
            color: #17643d;
        }

        .status-closed {
            background: #f0f2f4;
            color: #68747c;
        }

        .status-cancelled {
            background: #fff0f1;
            color: #b02a37;
        }

        .status-completed {
            background: var(--primary-light);
            color: var(--primary);
        }

        .time-urgent {
            background: #fff0f1;
            color: #a92733;
        }

        .time-soon {
            background: #fff8df;
            color: #765d00;
        }

        .time-normal {
            background: #edf8f2;
            color: #17643d;
        }

        .time-departed {
            background: #f0f2f4;
            color: #68747c;
        }

        .time-detail {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 8px;
            white-space: nowrap;
        }

        .view-btn {
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

        .view-btn:hover {
            background: var(--primary-dark);
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
            stroke-width: 1.7;
        }

        .empty h3 {
            margin-bottom: 7px;
            color: var(--primary-dark);
            font-size: 14px;
        }

        .empty p {
            margin-bottom: 13px;
            color: var(--muted);
            font-size: 9px;
        }

        .empty a {
            color: var(--primary);
            font-size: 9px;
            font-weight: bold;
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
            .filter-form {
                grid-template-columns: 1fr 1fr;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .search-btn,
            .reset-btn {
                width: 100%;
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
        }

        @media (max-width: 700px) {
            .content {
                padding: 20px 15px 35px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-form {
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

<div class="employee-layout">

    <aside class="sidebar">

        <a
            href="{{ route('nhanvien.trang-chu') }}"
            class="logo"
        >
            Viet<span>jet</span>
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
                    Vietjet Airport Operations
                </h2>

                <p>
                    Theo dõi chuyến bay và tình trạng hành khách
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
                        Danh sách chuyến bay
                    </h1>

                    <p>
                        Theo dõi số lượng hành khách thực tế,
                        tình trạng kiểm tra và thời gian còn lại
                        trước giờ khởi hành của từng chuyến.
                    </p>
                </div>

                <a
                    href="{{ route('nhanvien.trang-chu') }}"
                    class="back-btn"
                >
                    ← Quay lại trang nhân viên
                </a>

            </div>

            <section class="filter-card">

                <div class="filter-header">
                    <h3>
                        Tìm kiếm chuyến bay
                    </h3>

                    <p>
                        Chọn ngày để xem đúng các chuyến của ngày đó,
                        sau đó có thể lọc tiếp theo buổi.
                    </p>
                </div>

                <form
                    action="{{ route('nhanvien.flights.index') }}"
                    method="GET"
                    class="filter-form"
                >

                    <input
                        type="text"
                        name="keyword"
                        value="{{ $keyword ?? '' }}"
                        placeholder="Mã chuyến, sân bay hoặc thành phố..."
                    >

                    <input
                        type="date"
                        name="flight_date"
                        value="{{ $flightDate ?? '' }}"
                    >

                    <select name="time_period">

                        <option value="">
                            -- Cả ngày --
                        </option>

                        <option
                            value="morning"
                            {{ ($timePeriod ?? '') === 'morning' ? 'selected' : '' }}
                        >
                            Buổi sáng
                        </option>

                        <option
                            value="afternoon"
                            {{ ($timePeriod ?? '') === 'afternoon' ? 'selected' : '' }}
                        >
                            Buổi chiều
                        </option>

                        <option
                            value="evening"
                            {{ ($timePeriod ?? '') === 'evening' ? 'selected' : '' }}
                        >
                            Buổi tối
                        </option>

                    </select>

                    <select name="status">

                        <option value="">
                            -- Tất cả trạng thái --
                        </option>

                        <option
                            value="open"
                            {{ ($status ?? '') === 'open' ? 'selected' : '' }}
                        >
                            Đang mở
                        </option>

                        <option
                            value="closed"
                            {{ ($status ?? '') === 'closed' ? 'selected' : '' }}
                        >
                            Đã đóng
                        </option>

                        <option
                            value="cancelled"
                            {{ ($status ?? '') === 'cancelled' ? 'selected' : '' }}
                        >
                            Đã hủy
                        </option>

                        <option
                            value="completed"
                            {{ ($status ?? '') === 'completed' ? 'selected' : '' }}
                        >
                            Hoàn thành
                        </option>

                    </select>

                    <button
                        type="submit"
                        class="search-btn"
                    >
                        Lọc chuyến
                    </button>

                    <a
                        href="{{ route('nhanvien.flights.index') }}"
                        class="reset-btn"
                    >
                        Hôm nay
                    </a>

                </form>

            </section>

            @php
                $totalFlights = $flights->count();

                $openFlights = $flights
                    ->where('status', 'open')
                    ->count();

                $totalUnchecked = $flights
                    ->sum('unchecked_passengers_count');
            @endphp

            <div class="summary-grid">

                <div class="summary-card">
                    <div class="summary-title">
                        Tổng chuyến đang hiển thị
                    </div>

                    <div class="summary-value">
                        {{ $totalFlights }}
                    </div>

                    <div class="summary-note">
                        Theo điều kiện lọc hiện tại
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Chuyến đang mở
                    </div>

                    <div class="summary-value">
                        {{ $openFlights }}
                    </div>

                    <div class="summary-note">
                        Có thể tiếp tục phục vụ hành khách
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Hành khách chưa kiểm tra
                    </div>

                    <div class="summary-value">
                        {{ $totalUnchecked }}
                    </div>

                    <div class="summary-note">
                        Cần thực hiện nhận diện và xác nhận
                    </div>
                </div>

            </div>

            <section class="panel">

                <div class="panel-header">

                    <div>
                        <h3>
                            Danh sách chuyến bay
                        </h3>

                        <p>
                            Theo dõi số hành khách và mở danh sách
                            chi tiết của từng chuyến bay.
                        </p>
                    </div>

                    <span class="count-box">
                        {{ $flights->count() }} chuyến
                    </span>

                </div>

                @if($flights->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã chuyến</th>
                                    <th>Hành trình</th>
                                    <th>Ngày bay</th>
                                    <th>Giờ bay</th>
                                    <th>Máy bay</th>
                                    <th>Hành khách</th>
                                    <th>Đã kiểm tra</th>
                                    <th>Chưa kiểm tra</th>
                                    <th>Thời gian</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($flights as $flight)

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
                                        <span class="route-city">
                                            {{ $flight->departureAirport->city ?? '---' }}
                                            →
                                            {{ $flight->arrivalAirport->city ?? '---' }}
                                        </span>

                                        <span class="route-code">
                                            {{ $flight->departureAirport->code ?? '---' }}
                                            →
                                            {{ $flight->arrivalAirport->code ?? '---' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="flight-date">
                                            {{ \Carbon\Carbon::parse(
                                                $flight->flight_date
                                            )->format('d/m/Y') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="flight-time">
                                            <span class="departure-time">
                                                {{ substr(
                                                    $flight->departure_time,
                                                    0,
                                                    5
                                                ) }}
                                            </span>

                                            -

                                            {{ substr(
                                                $flight->arrival_time,
                                                0,
                                                5
                                            ) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="aircraft-code">
                                            {{ $flight->aircraft->code ?? '---' }}
                                        </span>

                                        @if($flight->aircraft)
                                            <span class="aircraft-name">
                                                {{ $flight->aircraft->name ?? '' }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="passenger-count">
                                            {{ $flight->total_passengers_count }}

                                            /

                                            {{ $flight->total_seats_count }}

                                            <small>
                                                khách
                                            </small>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="checked-count">
                                            {{ $flight->checked_passengers_count }}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="unchecked-count
                                            {{ $flight->unchecked_passengers_count == 0
                                                ? 'zero'
                                                : '' }}"
                                        >
                                            {{ $flight->unchecked_passengers_count }}
                                        </span>
                                    </td>

                                    <td>

                                        @if($flight->time_warning === 'departed')

                                            <span class="badge time-departed">
                                                Đã qua giờ
                                            </span>

                                        @elseif($flight->time_warning === 'urgent')

                                            <span class="badge time-urgent">
                                                Sắp khởi hành
                                            </span>

                                            @if($flight->minutes_until_departure >= 0)

                                                <span class="time-detail">
                                                    Còn khoảng
                                                    {{ $flight->minutes_until_departure }}
                                                    phút
                                                </span>

                                            @endif

                                        @elseif($flight->time_warning === 'soon')

                                            <span class="badge time-soon">
                                                Còn dưới 3 giờ
                                            </span>

                                            @if($flight->minutes_until_departure >= 0)

                                                @php
                                                    $hours = floor(
                                                        $flight->minutes_until_departure / 60
                                                    );

                                                    $minutes =
                                                        $flight->minutes_until_departure % 60;
                                                @endphp

                                                <span class="time-detail">
                                                    Còn

                                                    @if($hours > 0)
                                                        {{ $hours }} giờ
                                                    @endif

                                                    @if($minutes > 0)
                                                        {{ $minutes }} phút
                                                    @endif
                                                </span>

                                            @endif

                                        @else

                                            <span class="badge time-normal">
                                                Bình thường
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($flight->status === 'open')

                                            <span class="badge status-open">
                                                Đang mở
                                            </span>

                                        @elseif($flight->status === 'closed')

                                            <span class="badge status-closed">
                                                Đã đóng
                                            </span>

                                        @elseif($flight->status === 'cancelled')

                                            <span class="badge status-cancelled">
                                                Đã hủy
                                            </span>

                                        @elseif($flight->status === 'completed')

                                            <span class="badge status-completed">
                                                Hoàn thành
                                            </span>

                                        @else

                                            <span class="badge status-closed">
                                                {{ $flight->status }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        <a
                                            href="{{ route(
                                                'nhanvien.flights.passengers',
                                                $flight->id
                                            ) }}"
                                            class="view-btn"
                                        >
                                            Xem hành khách
                                        </a>
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
                                <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                            </svg>
                        </div>

                        <h3>
                            Không tìm thấy chuyến bay
                        </h3>

                        <p>
                            Không có chuyến bay phù hợp
                            với ngày và điều kiện lọc hiện tại.
                        </p>

                        <a href="{{ route('nhanvien.flights.index') }}">
                            Hiện tất cả chuyến bay
                        </a>

                    </div>

                @endif

            </section>

            <div class="bottom-back">
                <a href="{{ route('nhanvien.trang-chu') }}">
                    ← Quay lại trang nhân viên
                </a>
            </div>

            <footer class="footer">
                <span>
                    Vietjet Airport Operations
                </span>

                <span>
                    Danh sách chuyến bay
                </span>
            </footer>

        </div>

    </main>

</div>

</body>

</html>