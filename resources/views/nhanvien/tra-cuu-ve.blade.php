<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tra cứu vé -  Nhân viên</title>

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
        input {
            font-family: inherit;
        }

        /* ================================
           LAYOUT
        ================================= */

        .employee-layout {
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

        /* ================================
           SIDEBAR BOTTOM
        ================================= */

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

        /* ================================
           MAIN
        ================================= */

        .main {
            grid-column: 2;

            min-width: 0;
        }

        /* ================================
           TOPBAR
        ================================= */

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

        /* ================================
           CONTENT
        ================================= */

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
            max-width: 720px;

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

        /* ================================
           ALERT
        ================================= */

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

        /* ================================
           SEARCH
        ================================= */

        .search-card {
            margin-bottom: 16px;

            padding: 18px 20px;

            border: 1px solid var(--border);
            border-radius: 9px;

            background: white;

            box-shadow:
                0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .search-header {
            margin-bottom: 14px;
        }

        .search-header h3 {
            margin-bottom: 4px;

            color: var(--primary);

            font-size: 13px;
        }

        .search-header p {
            color: var(--muted);

            font-size: 9px;
        }

        .search-form {
            display: flex;

            gap: 9px;
        }

        .search-input-wrap {
            position: relative;

            flex: 1;
        }

        .search-icon {
            position: absolute;

            top: 50%;
            left: 13px;

            width: 16px;
            height: 16px;

            transform: translateY(-50%);

            color: #87949d;
        }

        .search-icon svg {
            width: 16px;
            height: 16px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .search-form input {
            width: 100%;
            height: 43px;

            padding: 0 13px 0 40px;

            border: 1px solid #d5dee5;
            border-radius: 6px;

            background: white;

            color: #394b58;

            font-size: 10px;
        }

        .search-form input:focus {
            outline: none;

            border-color: var(--primary);

            box-shadow:
                0 0 0 3px rgba(0, 59, 112, 0.06);
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

        /* ================================
           SUMMARY
        ================================= */

        .summary {
            margin-bottom: 16px;

            padding: 12px 15px;

            border: 1px solid #d4e3ed;
            border-left: 4px solid var(--primary);
            border-radius: 6px;

            background: var(--primary-light);

            color: #526b7a;

            font-size: 10px;
        }

        .summary strong {
            color: var(--primary);

            font-size: 12px;
        }

        /* ================================
           TABLE PANEL
        ================================= */

        .panel {
            background: white;

            border: 1px solid var(--border);
            border-radius: 10px;

            box-shadow:
                0 3px 12px rgba(20, 45, 65, 0.04);

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

        /* ================================
           TABLE
        ================================= */

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }

        table {
            width: 100%;

            min-width: 1520px;

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

            white-space: nowrap;

            text-transform: uppercase;
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

        /* ================================
           TICKET INFO
        ================================= */

        .ticket-code {
            margin-bottom: 4px;

            color: var(--primary);

            font-size: 10px;
            font-weight: 800;

            white-space: nowrap;
        }

        .booking-code {
            color: var(--muted);

            font-size: 8px;

            white-space: nowrap;
        }

        .passenger-name {
            margin-bottom: 4px;

            color: var(--primary-dark);

            font-size: 10px;
            font-weight: 700;

            white-space: nowrap;
        }

        .passenger-phone {
            color: var(--muted);

            font-size: 8px;
        }

        .flight-code {
            color: var(--primary);

            font-weight: 800;
        }

        .route-code {
            display: block;

            margin-bottom: 3px;

            color: var(--primary-dark);

            font-weight: 800;

            white-space: nowrap;
        }

        .route-city {
            color: var(--muted);

            font-size: 8px;

            white-space: nowrap;
        }

        .flight-date {
            color: #435461;

            font-weight: 700;

            white-space: nowrap;
        }

        .flight-time {
            display: block;

            margin-top: 3px;

            color: var(--muted);

            font-size: 8px;
        }

        .seat-number {
            min-width: 31px;

            padding: 5px 7px;

            display: inline-flex;
            justify-content: center;

            border: 1px solid #cedde7;
            border-radius: 4px;

            background: #f7fafc;

            color: var(--primary);

            font-weight: 800;
        }

        .price {
            color: #364c59;

            font-weight: 700;

            white-space: nowrap;
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

        /* ================================
           BADGES
        ================================= */

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

        .status-cancelled {
            background: #fff0f1;

            color: #b02a37;
        }

        .status-pending {
            background: #f0f2f4;

            color: #68747c;
        }

        /* ================================
           ACTIONS
        ================================= */

        .confirm-btn,
        .done-btn {
            min-height: 31px;

            padding: 0 10px;

            border-radius: 5px;

            font-size: 8px;
            font-weight: bold;

            white-space: nowrap;
        }

        .confirm-btn {
            border: none;

            background: var(--success);

            color: white;

            cursor: pointer;
        }

        .confirm-btn:hover {
            background: #157347;
        }

        .done-btn {
            border: 1px solid #bddfc9;

            background: #edf8f2;

            color: #17643d;
        }

        /* ================================
           EMPTY
        ================================= */

        .empty {
            padding: 52px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 48px;
            height: 48px;

            margin: 0 auto 14px;

            border-radius: 50%;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-icon svg {
            width: 23px;
            height: 23px;

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
            margin-bottom: 13px;

            color: var(--muted);

            font-size: 9px;
        }

        .empty a {
            color: var(--primary);

            font-size: 9px;
            font-weight: bold;
        }

        /* ================================
           FOOTER
        ================================= */

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

        /* ================================
           RESPONSIVE
        ================================= */

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
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .main {
                margin-left: 0;
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

            .search-form {
                flex-direction: column;
            }

            .search-btn,
            .reset-btn {
                width: 100%;
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

    {{-- ========================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================= --}}

    <aside class="sidebar">

        <a
            href="{{ route('nhanvien.trang-chu') }}"
            class="logo"
        >
            Viet<span>Jet</span>
        </a>

        <div class="employee-label">
            Khu vực nhân viên sân bay
        </div>

        <div class="menu-title">
            NGHIỆP VỤ
        </div>

        <nav class="menu">

            {{-- TỔNG QUAN --}}
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

            {{-- TRA CỨU VÉ --}}
            <a
                href="{{ route('nhanvien.tickets.index') }}"
                class="menu-link active"
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

            {{-- HÀNH KHÁCH --}}
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

            {{-- FLIGHT --}}
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

            {{-- FACE --}}
            

        </nav>

        {{-- EMPLOYEE INFO --}}
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


    {{-- ========================= --}}
    {{-- MAIN --}}
    {{-- ========================= --}}

    <main class="main">

        {{-- TOPBAR --}}
        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    
                </h2>

                <p>
                    Tra cứu và xác nhận thông tin vé hành khách
                </p>

            </div>

            <span class="employee-badge">
                NHÂN VIÊN
            </span>

        </header>


        <div class="content">

            {{-- ========================= --}}
            {{-- PAGE HEADING --}}
            {{-- ========================= --}}

            <div class="page-heading">

                <div>

                    <h1>
                        Tra cứu vé
                    </h1>

                    <p>
                        Danh sách các vé đã thanh toán.
                        Có thể tìm kiếm bằng mã vé,
                        mã đặt vé, tên hành khách hoặc CCCD / Hộ chiếu.
                    </p>

                </div>

                <a
                    href="{{ route('nhanvien.trang-chu') }}"
                    class="back-btn"
                >
                    ← Quay lại trang nhân viên
                </a>

            </div>


            {{-- ========================= --}}
            {{-- ALERT --}}
            {{-- ========================= --}}

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


            {{-- ========================= --}}
            {{-- SEARCH --}}
            {{-- ========================= --}}

            <section class="search-card">

                <div class="search-header">

                    <h3>
                        Tìm kiếm vé
                    </h3>

                    <p>
                        Nhập một trong các thông tin
                        để lọc danh sách vé.
                    </p>

                </div>

                <form
                    action="{{ route('nhanvien.tickets.search') }}"
                    method="GET"
                    class="search-form"
                >

                    <div class="search-input-wrap">

                        <span class="search-icon">

                            <svg viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="M20 20l-4-4"/>
                            </svg>

                        </span>

                        <input
                            type="text"
                            name="keyword"

                            value="{{ $keyword ?? '' }}"

                            placeholder="Nhập mã vé, mã đặt vé, tên hành khách hoặc CCCD..."
                        >

                    </div>

                    <button
                        type="submit"
                        class="search-btn"
                    >
                        Tìm kiếm
                    </button>

                    <a
                        href="{{ route('nhanvien.tickets.index') }}"
                        class="reset-btn"
                    >
                        Hiện tất cả
                    </a>

                </form>

            </section>


            {{-- ========================= --}}
            {{-- SUMMARY --}}
            {{-- ========================= --}}

            <div class="summary">

                Tổng số vé đang hiển thị:

                <strong>
                    {{ $tickets->count() }}
                </strong>

            </div>


            {{-- ========================= --}}
            {{-- TABLE --}}
            {{-- ========================= --}}

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h3>
                            Danh sách vé hành khách
                        </h3>

                        <p>
                            Chỉ hiển thị các vé thuộc
                            đơn đặt vé đã thanh toán.
                        </p>

                    </div>

                    <span class="count-box">
                        {{ $tickets->count() }} vé
                    </span>

                </div>


                @if($tickets->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>STT</th>

                                    <th>Mã vé</th>

                                    <th>Hành khách</th>

                                    <th>CCCD / Hộ chiếu</th>

                                    <th>Chuyến bay</th>

                                    <th>Hành trình</th>

                                    <th>Ngày bay</th>

                                    <th>Ghế</th>

                                    <th>Hạng</th>

                                    <th>Giá vé</th>

                                    <th>Hành lý ký gửi</th>

                                    <th>Phí hành lý</th>

                                    <th>Trạng thái</th>

                                    <th>Thao tác</th>

                                </tr>

                            </thead>

                            <tbody>

                            @foreach($tickets as $ticket)

                                <tr>

                                    {{-- STT --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- TICKET CODE --}}
                                    <td>

                                        <div class="ticket-code">

                                            {{ $ticket->ticket_code }}

                                        </div>

                                        <div class="booking-code">

                                            Mã đặt:
                                            {{ $ticket->booking->booking_code ?? '---' }}

                                        </div>

                                    </td>

                                    {{-- PASSENGER --}}
                                    <td>

                                        <div class="passenger-name">

                                            {{ $ticket->passenger_name }}

                                        </div>

                                        @if($ticket->phone)

                                            <div class="passenger-phone">

                                                {{ $ticket->phone }}

                                            </div>

                                        @endif

                                    </td>

                                    {{-- IDENTITY --}}
                                    <td>

                                        {{ $ticket->identity_number ?? '---' }}

                                    </td>

                                    {{-- FLIGHT --}}
                                    <td>

                                        <span class="flight-code">

                                            {{ $ticket->flight->flight_code ?? '---' }}

                                        </span>

                                    </td>

                                    {{-- ROUTE --}}
                                    <td>

                                        <span class="route-code">

                                            {{ $ticket->flight->departureAirport->code ?? '---' }}

                                            →

                                            {{ $ticket->flight->arrivalAirport->code ?? '---' }}

                                        </span>

                                        <span class="route-city">

                                            {{ $ticket->flight->departureAirport->city ?? '---' }}

                                            →

                                            {{ $ticket->flight->arrivalAirport->city ?? '---' }}

                                        </span>

                                    </td>

                                    {{-- DATE --}}
                                    <td>

                                        @if($ticket->flight)

                                            <span class="flight-date">

                                                {{ \Carbon\Carbon::parse(
                                                    $ticket->flight->flight_date
                                                )->format('d/m/Y') }}

                                            </span>

                                            <span class="flight-time">

                                                {{
                                                    substr(
                                                        $ticket->flight->departure_time,
                                                        0,
                                                        5
                                                    )
                                                }}

                                            </span>

                                        @else

                                            ---

                                        @endif

                                    </td>

                                    {{-- SEAT --}}
                                    <td>

                                        <span class="seat-number">

                                            {{ $ticket->flightSeat->seat_number ?? '---' }}

                                        </span>

                                    </td>

                                    {{-- CLASS --}}
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

                                    {{-- PRICE --}}
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

                                    {{-- STATUS --}}
                                    <td>

                                        @if($ticket->ticket_status === 'active')

                                            <span class="badge status-active">
                                                Chưa kiểm tra
                                            </span>

                                        @elseif($ticket->ticket_status === 'used')

                                            <span class="badge status-used">
                                                Đã kiểm tra
                                            </span>

                                        @elseif($ticket->ticket_status === 'cancelled')

                                            <span class="badge status-cancelled">
                                                Đã hủy
                                            </span>

                                        @else

                                            <span class="badge status-pending">

                                                {{ $ticket->ticket_status }}

                                            </span>

                                        @endif

                                    </td>

                                    {{-- ACTION --}}
                                    <td>

                                        @if($ticket->ticket_status === 'active')

                                            <form
                                                action="{{ route(
                                                    'nhanvien.tickets.confirm',
                                                    $ticket->id
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="confirm-btn"

                                                    onclick="return confirm(
                                                        'Xác nhận hành khách {{ $ticket->passenger_name }} đã được kiểm tra?'
                                                    )"
                                                >
                                                    Xác nhận
                                                </button>

                                            </form>

                                        @elseif($ticket->ticket_status === 'used')

                                            <button
                                                type="button"
                                                class="done-btn"
                                                disabled
                                            >
                                                Đã kiểm tra
                                            </button>

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
                                <circle cx="11" cy="11" r="7"/>
                                <path d="M20 20l-4-4"/>
                            </svg>

                        </div>

                        <h3>
                            Không tìm thấy vé
                        </h3>

                        <p>
                            Thử nhập mã vé, mã đặt vé,
                            tên hành khách hoặc CCCD khác.
                        </p>

                        <a href="{{ route('nhanvien.tickets.index') }}">
                            Hiện toàn bộ vé
                        </a>

                    </div>

                @endif

            </section>


            {{-- ========================= --}}
            {{-- BACK --}}
            {{-- ========================= --}}

            <div class="bottom-back">

                <a href="{{ route('nhanvien.trang-chu') }}">
                    ← Quay lại trang nhân viên
                </a>

            </div>


            <footer class="footer">

                <span>
                   
                </span>

                <span>
                    Tra cứu vé hành khách
                </span>

            </footer>

        </div>

    </main>

</div>

</body>

</html>