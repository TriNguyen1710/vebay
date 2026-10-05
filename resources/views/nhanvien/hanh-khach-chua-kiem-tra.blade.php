<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Hành khách chưa kiểm tra - Vietjet</title>

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
            --warning-bg: #fff8df;
            --warning-border: #ead99a;
            --warning-text: #755c00;
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

        .disabled-link {
            opacity: 0.45;
            pointer-events: none;
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
            max-width: 750px;
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
            grid-template-columns:
                minmax(250px, 1.3fr)
                minmax(300px, 1fr)
                auto
                auto;
            gap: 10px;
            align-items: end;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #53636e;
            font-size: 9px;
            font-weight: bold;
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

        .summary {
            margin-bottom: 16px;
            padding: 13px 15px;
            border: 1px solid #d4e3ed;
            border-left: 4px solid var(--primary);
            border-radius: 6px;
            background: var(--primary-light);
            color: #526b7a;
            font-size: 10px;
        }

        .summary strong {
            color: var(--primary);
            font-size: 13px;
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
            background: #fff8df;
            color: #7a6000;
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
            min-width: 1580px;
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

        .ticket-code {
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .passenger-name {
            display: block;
            margin-bottom: 4px;
            color: var(--primary-dark);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .phone {
            color: var(--muted);
            font-size: 8px;
            white-space: nowrap;
        }

        .flight-code {
            color: var(--primary);
            font-weight: 800;
            white-space: nowrap;
        }

        .route {
            color: var(--primary-dark);
            font-weight: 700;
            white-space: nowrap;
        }

        .date,
        .time {
            white-space: nowrap;
        }

        .date {
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

        .status-unchecked {
            background: #fff8df;
            color: #7a6000;
        }

        .actions {
            min-width: 135px;
            display: grid;
            gap: 6px;
        }

        .remind-btn,
        .face-btn {
            width: 100%;
            min-height: 31px;
            padding: 0 9px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
        }

        .remind-btn {
            background: var(--secondary);
            color: var(--primary-dark);
        }

        .remind-btn:hover {
            background: #ffc31a;
        }

        .face-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: white;
        }

        .face-btn:hover {
            background: var(--primary-dark);
        }

        .face-unavailable {
            width: 100%;
            min-height: 31px;
            padding: 0 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            background: #e8ecef;
            color: #7b858d;
            font-size: 8px;
            font-weight: bold;
            cursor: not-allowed;
            white-space: nowrap;
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
            background: #edf8f2;
            color: var(--success);
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

            .filter-form {
                grid-template-columns: 1fr 1fr;
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
                class="menu-link active"
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
                class="menu-link"
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
                    Kiểm tra và hỗ trợ hành khách trước chuyến bay
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
                        Hành khách chưa kiểm tra
                    </h1>

                    <p>
                        Danh sách hành khách có vé đã thanh toán
                        nhưng chưa được nhân viên xác nhận.
                        Nhân viên cần nhận diện khuôn mặt hành khách
                        trước khi xác nhận hoàn tất kiểm tra.
                    </p>

                </div>

                <a
                    href="{{ route('nhanvien.trang-chu') }}"
                    class="back-btn"
                >
                    ← Quay lại trang nhân viên
                </a>

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

            <section class="filter-card">

                <div class="filter-header">

                    <h3>
                        Tìm kiếm và lọc hành khách
                    </h3>

                    <p>
                        Có thể tìm bằng mã vé, mã đặt vé,
                        tên hành khách, CCCD và lọc theo chuyến bay.
                    </p>

                </div>

                <form
                    action="{{ route('nhanvien.passengers.unchecked') }}"
                    method="GET"
                    class="filter-form"
                >

                    <div class="form-group">

                        <label for="keyword">
                            Từ khóa
                        </label>

                        <input
                            type="text"
                            id="keyword"
                            name="keyword"
                            value="{{ $keyword ?? '' }}"
                            placeholder="Mã vé, mã đặt vé, tên, CCCD..."
                        >

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
                                -- Tất cả chuyến bay --
                            </option>

                            @foreach($flights as $flight)

                                <option
                                    value="{{ $flight->id }}"
                                    {{ (string) ($flightId ?? '') === (string) $flight->id
                                        ? 'selected'
                                        : '' }}
                                >

                                    {{ $flight->flight_code }}

                                    -

                                    {{ optional($flight->departureAirport)->code }}

                                    →

                                    {{ optional($flight->arrivalAirport)->code }}

                                    -

                                    {{ \Carbon\Carbon::parse(
                                        $flight->flight_date
                                    )->format('d/m/Y') }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="search-btn"
                    >
                        Tìm kiếm
                    </button>

                    <a
                        href="{{ route('nhanvien.passengers.unchecked') }}"
                        class="reset-btn"
                    >
                        Đặt lại
                    </a>

                </form>

            </section>

            <div class="summary">

                Tổng hành khách chưa kiểm tra:

                <strong>
                    {{ $tickets->count() }}
                </strong>

            </div>

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h3>
                            Danh sách hành khách cần kiểm tra
                        </h3>

                        <p>
                            Chọn nhận diện khuôn mặt để kiểm tra
                            hành khách trước khi xác nhận.
                        </p>

                    </div>

                    <span class="count-box">
                        {{ $tickets->count() }} chưa kiểm tra
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
                                    <th>Chuyến bay</th>
                                    <th>Hành trình</th>
                                    <th>Ngày bay</th>
                                    <th>Giờ bay</th>
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

                                        @if($ticket->phone)

                                            <span class="phone">
                                                SĐT: {{ $ticket->phone }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $ticket->identity_number ?? '---' }}
                                    </td>

                                    <td>

                                        <span class="flight-code">
                                            {{ optional($ticket->flight)->flight_code ?? '---' }}
                                        </span>

                                    </td>

                                    <td>

                                        <span class="route">

                                            {{ optional(
                                                optional($ticket->flight)->departureAirport
                                            )->code ?? '---' }}

                                            →

                                            {{ optional(
                                                optional($ticket->flight)->arrivalAirport
                                            )->code ?? '---' }}

                                        </span>

                                    </td>

                                    <td>

                                        @if($ticket->flight)

                                            <span class="date">

                                                {{ \Carbon\Carbon::parse(
                                                    $ticket->flight->flight_date
                                                )->format('d/m/Y') }}

                                            </span>

                                        @else

                                            ---

                                        @endif

                                    </td>

                                    <td>

                                        @if($ticket->flight)

                                            <span class="time">

                                                {{ \Carbon\Carbon::parse(
                                                    $ticket->flight->departure_time
                                                )->format('H:i') }}

                                            </span>

                                        @else

                                            ---

                                        @endif

                                    </td>

                                    <td>

                                        <span class="seat-number">

                                            {{ optional(
                                                $ticket->flightSeat
                                            )->seat_number ?? '---' }}

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

                                        <span class="badge status-unchecked">
                                            Chưa kiểm tra
                                        </span>

                                    </td>

                                    <td>

                                        <div class="actions">

                                            <form
                                                action="{{ route(
                                                    'nhanvien.tickets.remind',
                                                    $ticket->id
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="remind-btn"
                                                    onclick="return confirm(
                                                        'Gửi nhắc nhở cho hành khách {{ $ticket->passenger_name }}?'
                                                    )"
                                                >
                                                    Gửi nhắc nhở
                                                </button>

                                            </form>

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

                                                <div class="face-unavailable">
                                                    Chưa có ảnh khuôn mặt
                                                </div>

                                            @endif

                                        </div>

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
                                <path d="M5 12l4 4L19 6"/>
                            </svg>

                        </div>

                        <h3>
                            Không có hành khách cần kiểm tra
                        </h3>

                        <p>
                            Hiện tại không có hành khách nào
                            phù hợp với điều kiện tìm kiếm
                            hoặc tất cả đã được xác nhận.
                        </p>

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
                    Hành khách chưa kiểm tra
                </span>

            </footer>

        </div>

    </main>

</div>

</body>

</html>