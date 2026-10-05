<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sửa chuyến bay - SkyGo Admin</title>

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

            padding: 30px;
        }

        .page-heading {
            margin-bottom: 22px;

            display: flex;
            justify-content: space-between;
            align-items: center;

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
            background: #f7f9fb;
        }

        /* ================================
           FORM CARD
        ================================= */

        .form-card {
            max-width: 980px;

            margin: auto;

            background: white;

            border: 1px solid var(--border);
            border-radius: 12px;

            box-shadow:
                0 6px 24px rgba(20, 45, 65, 0.07);

            overflow: hidden;
        }

        .form-header {
            padding: 24px 28px 20px;

            border-bottom: 1px solid #e8edf1;
        }

        .form-accent {
            width: 44px;
            height: 4px;

            margin-bottom: 13px;

            border-radius: 10px;

            background: var(--secondary);
        }

        .form-header h2 {
            margin-bottom: 6px;

            color: var(--primary);

            font-size: 19px;
        }

        .form-header p {
            color: var(--muted);

            font-size: 10px;
            line-height: 1.6;
        }

        .form-body {
            padding: 28px;
        }

        /* ================================
           CURRENT FLIGHT
        ================================= */

        .current-flight {
            margin-bottom: 22px;

            padding: 14px 16px;

            border: 1px solid #d4e4ee;
            border-left: 4px solid var(--primary);
            border-radius: 7px;

            background: var(--primary-light);

            color: #526b7a;

            font-size: 10px;
            line-height: 1.6;
        }

        .current-flight strong {
            color: var(--primary);

            font-size: 11px;
        }

        /* ================================
           ERROR
        ================================= */

        .error-box {
            margin-bottom: 22px;

            padding: 13px 15px;

            border-radius: 7px;

            background: #fff2f3;

            border: 1px solid #f0c1c6;
            border-left: 4px solid var(--danger);

            color: #8b2732;

            font-size: 11px;
            line-height: 1.7;
        }

        .error-box strong {
            display: block;

            margin-bottom: 5px;
        }

        /* ================================
           FORM
        ================================= */

        .form-grid {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            color: #425361;

            font-size: 11px;
            font-weight: bold;
        }

        .required {
            color: var(--danger);
        }

        input,
        select {
            width: 100%;
            height: 45px;

            padding: 0 13px;

            border: 1px solid #d5dee5;
            border-radius: 7px;

            background: white;
            color: #344653;

            font-size: 12px;

            transition: 0.2s;
        }

        input:focus,
        select:focus {
            outline: none;

            border-color: var(--primary);

            box-shadow:
                0 0 0 3px rgba(0, 59, 112, 0.07);
        }

        .field-note {
            margin-top: 6px;

            color: #929ca4;

            font-size: 9px;
            line-height: 1.5;
        }

        /* ================================
           SECTIONS
        ================================= */

        .section-box {
            grid-column: 1 / -1;

            padding: 18px;

            border: 1px solid #e2e8ed;
            border-radius: 8px;

            background: #f9fbfc;
        }

        .section-title {
            margin-bottom: 17px;

            color: var(--primary);

            font-size: 11px;
            font-weight: 800;
        }

        .section-grid {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 18px;
        }

        /* ================================
           PRICE PREVIEW
        ================================= */

        .price-preview {
            margin-top: 20px;

            padding: 17px 18px;

            border: 1px solid #ead89e;
            border-radius: 8px;

            background: #fffaf0;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;
        }

        .price-preview-text strong {
            display: block;

            margin-bottom: 4px;

            color: #765b00;

            font-size: 11px;
        }

        .price-preview-text span {
            color: #8d8160;

            font-size: 9px;
        }

        .price-preview-value {
            text-align: right;
        }

        .price-preview-value span {
            display: block;

            margin-bottom: 3px;

            color: #9a8a5c;

            font-size: 8px;
            font-weight: bold;
        }

        .price-preview-value strong {
            color: #9b7200;

            font-size: 20px;
        }

        /* ================================
           ACTIONS
        ================================= */

        .form-actions {
            margin-top: 28px;

            padding-top: 22px;

            border-top: 1px solid #e8edf1;

            display: flex;
            justify-content: flex-end;
            align-items: center;

            gap: 10px;
        }

        .cancel-btn {
            min-height: 42px;

            padding: 0 18px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--border);
            border-radius: 6px;

            background: white;

            color: #596874;

            font-size: 11px;
            font-weight: bold;
        }

        .cancel-btn:hover {
            background: #f6f8fa;
        }

        .save-btn {
            min-height: 42px;

            padding: 0 22px;

            border: none;
            border-radius: 6px;

            background: var(--secondary);

            color: var(--primary-dark);

            cursor: pointer;

            font-size: 11px;
            font-weight: 800;
        }

        .save-btn:hover {
            background: #ffc31a;
        }

        /* ================================
           BOTTOM
        ================================= */

        .bottom-back {
            max-width: 980px;

            margin: 20px auto 0;
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
            max-width: 980px;

            margin: 28px auto 0;

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
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .form-grid,
            .section-grid {
                grid-template-columns: 1fr;
            }

            .section-box {
                grid-column: auto;
            }

            .price-preview {
                align-items: flex-start;
                flex-direction: column;
            }

            .price-preview-value {
                text-align: left;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .cancel-btn,
            .save-btn {
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

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <a
            href="{{ route('admin.trang-chu') }}"
            class="logo"
        >
            Sky<span>Go</span>
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
                    SkyGo Administration
                </h2>

                <p>
                    Quản lý lịch bay và giá vé
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
                        Chỉnh sửa chuyến bay
                    </h1>

                    <p>
                        Cập nhật hành trình, lịch bay,
                        máy bay và giá vé.
                    </p>

                </div>

                <a
                    href="{{ route('admin.flights.index') }}"
                    class="back-btn"
                >
                    ← Quay lại danh sách
                </a>

            </div>

            <section class="form-card">

                <div class="form-header">

                    <div class="form-accent"></div>

                    <h2>
                        Thông tin chuyến bay
                    </h2>

                    <p>
                        Chỉnh sửa các thông tin cần thiết
                        và nhấn lưu thay đổi.
                    </p>

                </div>

                <div class="form-body">

                    {{-- CHUYẾN BAY HIỆN TẠI --}}
                    <div class="current-flight">

                        Đang chỉnh sửa chuyến bay:

                        <strong>
                            {{ $flight->flight_code }}

                            -

                            {{ $flight->departureAirport->city }}

                            →

                            {{ $flight->arrivalAirport->city }}
                        </strong>

                    </div>

                    {{-- ERROR --}}
                    @if($errors->any())

                        <div class="error-box">

                            <strong>
                                Vui lòng kiểm tra lại thông tin.
                            </strong>

                            @foreach($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    @endif

                    <form
                        action="{{ route(
                            'admin.flights.update',
                            $flight->id
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')

                        <div class="form-grid">

                            {{-- MÃ CHUYẾN --}}
                            <div class="form-group">

                                <label for="flight_code">
                                    Mã chuyến bay
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="flight_code"
                                    name="flight_code"

                                    value="{{ old(
                                        'flight_code',
                                        $flight->flight_code
                                    ) }}"

                                    required
                                >

                                <div class="field-note">
                                    Mã nhận diện chuyến bay trong hệ thống.
                                </div>

                            </div>

                            {{-- MÁY BAY --}}
                            <div class="form-group">

                                <label for="aircraft_id">
                                    Máy bay
                                    <span class="required">*</span>
                                </label>

                                <select
                                    id="aircraft_id"
                                    name="aircraft_id"

                                    required
                                >

                                    <option value="">
                                        -- Chọn máy bay --
                                    </option>

                                    @foreach($aircraft as $item)

                                        <option
                                            value="{{ $item->id }}"

                                            {{ old(
                                                'aircraft_id',
                                                $flight->aircraft_id
                                            ) == $item->id
                                                ? 'selected'
                                                : '' }}
                                        >
                                            {{ $item->code }}
                                            -
                                            {{ $item->name }}
                                            -
                                            {{ $item->total_seats }} ghế
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            {{-- HÀNH TRÌNH --}}
                            <div class="section-box">

                                <div class="section-title">
                                    Hành trình
                                </div>

                                <div class="section-grid">

                                    <div class="form-group">

                                        <label for="departure_airport_id">
                                            Sân bay đi
                                            <span class="required">*</span>
                                        </label>

                                        <select
                                            id="departure_airport_id"
                                            name="departure_airport_id"

                                            required
                                        >

                                            <option value="">
                                                -- Chọn sân bay đi --
                                            </option>

                                            @foreach($airports as $airport)

                                                <option
                                                    value="{{ $airport->id }}"

                                                    {{ old(
                                                        'departure_airport_id',
                                                        $flight->departure_airport_id
                                                    ) == $airport->id
                                                        ? 'selected'
                                                        : '' }}
                                                >
                                                    {{ $airport->city }}
                                                    -
                                                    {{ $airport->name }}
                                                    ({{ $airport->code }})
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label for="arrival_airport_id">
                                            Sân bay đến
                                            <span class="required">*</span>
                                        </label>

                                        <select
                                            id="arrival_airport_id"
                                            name="arrival_airport_id"

                                            required
                                        >

                                            <option value="">
                                                -- Chọn sân bay đến --
                                            </option>

                                            @foreach($airports as $airport)

                                                <option
                                                    value="{{ $airport->id }}"

                                                    {{ old(
                                                        'arrival_airport_id',
                                                        $flight->arrival_airport_id
                                                    ) == $airport->id
                                                        ? 'selected'
                                                        : '' }}
                                                >
                                                    {{ $airport->city }}
                                                    -
                                                    {{ $airport->name }}
                                                    ({{ $airport->code }})
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                            </div>

                            {{-- LỊCH BAY --}}
                            <div class="section-box">

                                <div class="section-title">
                                    Lịch bay
                                </div>

                                <div class="section-grid">

                                    <div class="form-group">

                                        <label for="flight_date">
                                            Ngày bay
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="date"
                                            id="flight_date"
                                            name="flight_date"

                                            value="{{ old(
                                                'flight_date',
                                                $flight->flight_date->format('Y-m-d')
                                            ) }}"

                                            required
                                        >

                                    </div>

                                    <div></div>

                                    <div class="form-group">

                                        <label for="departure_time">
                                            Giờ khởi hành
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="time"
                                            id="departure_time"
                                            name="departure_time"

                                            value="{{ old(
                                                'departure_time',
                                                substr(
                                                    $flight->departure_time,
                                                    0,
                                                    5
                                                )
                                            ) }}"

                                            required
                                        >

                                    </div>

                                    <div class="form-group">

                                        <label for="arrival_time">
                                            Giờ đến
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="time"
                                            id="arrival_time"
                                            name="arrival_time"

                                            value="{{ old(
                                                'arrival_time',
                                                substr(
                                                    $flight->arrival_time,
                                                    0,
                                                    5
                                                )
                                            ) }}"

                                            required
                                        >

                                    </div>

                                </div>

                            </div>

                            {{-- GIÁ VÉ --}}
                            <div class="section-box">

                                <div class="section-title">
                                    Giá vé
                                </div>

                                <div class="section-grid">

                                    <div class="form-group">

                                        <label for="price">
                                            Giá vé Phổ thông
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="number"
                                            id="price"
                                            name="price"

                                            min="0"
                                            step="1000"

                                            value="{{ old(
                                                'price',
                                                $flight->price
                                            ) }}"

                                            required
                                        >

                                    </div>

                                    <div class="form-group">

                                        <label for="vip_surcharge">
                                            Phụ thu VIP
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="number"
                                            id="vip_surcharge"
                                            name="vip_surcharge"

                                            min="0"
                                            step="1000"

                                            value="{{ old(
                                                'vip_surcharge',
                                                $flight->vip_surcharge
                                            ) }}"

                                            required
                                        >

                                    </div>

                                </div>

                                <div class="price-preview">

                                    <div class="price-preview-text">

                                        <strong>
                                            Giá ghế VIP
                                        </strong>

                                        <span>
                                            Giá VIP =
                                            Giá Phổ thông + Phụ thu VIP
                                        </span>

                                    </div>

                                    <div class="price-preview-value">

                                        <span>
                                            GIÁ VIP SAU KHI CẬP NHẬT
                                        </span>

                                        <strong id="vipPricePreview">
                                            0 đ
                                        </strong>

                                    </div>

                                </div>

                            </div>

                            {{-- TRẠNG THÁI --}}
                            <div class="section-box">

                                <div class="section-title">
                                    Trạng thái chuyến bay
                                </div>

                                <div class="form-group">

                                    <label for="status">
                                        Trạng thái
                                        <span class="required">*</span>
                                    </label>

                                    <select
                                        id="status"
                                        name="status"

                                        required
                                    >

                                        <option
                                            value="open"

                                            {{ old(
                                                'status',
                                                $flight->status
                                            ) === 'open'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Đang mở bán
                                        </option>

                                        <option
                                            value="closed"

                                            {{ old(
                                                'status',
                                                $flight->status
                                            ) === 'closed'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Đóng bán
                                        </option>

                                        <option
                                            value="cancelled"

                                            {{ old(
                                                'status',
                                                $flight->status
                                            ) === 'cancelled'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Đã hủy
                                        </option>

                                        <option
                                            value="completed"

                                            {{ old(
                                                'status',
                                                $flight->status
                                            ) === 'completed'
                                                ? 'selected'
                                                : '' }}
                                        >
                                            Hoàn thành
                                        </option>

                                    </select>

                                    <div class="field-note">
                                        Trạng thái này quyết định
                                        khả năng đặt vé của chuyến bay.
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <a
                                href="{{ route('admin.flights.index') }}"
                                class="cancel-btn"
                            >
                                Hủy
                            </a>

                            <button
                                type="submit"
                                class="save-btn"
                            >
                                Lưu thay đổi
                            </button>

                        </div>

                    </form>

                </div>

            </section>

            <div class="bottom-back">

                <a href="{{ route('admin.flights.index') }}">
                    ← Quay lại quản lý chuyến bay
                </a>

            </div>

            <footer class="footer">

                <span>
                    SkyGo Administration
                </span>

                <span>
                    Chỉnh sửa chuyến bay
                </span>

            </footer>

        </div>

    </main>

</div>

<script>
    const priceInput =
        document.getElementById('price');

    const vipInput =
        document.getElementById('vip_surcharge');

    const vipPreview =
        document.getElementById('vipPricePreview');

    function updateVipPrice() {

        const economyPrice =
            parseInt(priceInput.value) || 0;

        const surcharge =
            parseInt(vipInput.value) || 0;

        const vipPrice =
            economyPrice + surcharge;

        vipPreview.textContent =
            new Intl.NumberFormat(
                'vi-VN'
            ).format(vipPrice) + ' đ';
    }

    priceInput.addEventListener(
        'input',
        updateVipPrice
    );

    vipInput.addEventListener(
        'input',
        updateVipPrice
    );

    updateVipPrice();
</script>

</body>

</html>