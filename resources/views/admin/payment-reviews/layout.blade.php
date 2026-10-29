<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Xử lý thanh toán - VietJet')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f3f6fa;
            color: #263849;
            font: 14px Arial, sans-serif;
        }

        a {
            color: #003b70;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        svg.icon {
            width: 19px;
            height: 19px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.7;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 240px;
            background: #00294f;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 30;
        }

        .logo {
            display: block;
            padding: 30px 24px;
            color: white;
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .logo span {
            color: #f4b400;
        }

        .menu-title {
            padding: 5px 24px 15px;
            color: #8eabc3;
            font-size: 10px;
            letter-spacing: 1.6px;
        }

        .menu {
            padding: 0 12px 22px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 12px;
            margin-bottom: 5px;
            border-radius: 7px;
            color: #dce9f4;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.45;
            transition: background .15s, color .15s;
        }

        .menu-link:hover {
            background: #133d61;
            color: white;
        }

        .menu-link.active {
            background: #20496c;
            color: #ffc107;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 20px;
            border-top: 1px solid #244865;
        }

        .account-name {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .account-role {
            color: #a7bfd2;
            font-size: 11px;
        }

        .sidebar-bottom .logout {
            width: 100%;
            min-height: 36px;
            margin-top: 16px;
            background: #123c60;
            border: 1px solid #365875;
            color: #e3edf5;
        }

        .page {
            margin-left: 240px;
            min-width: 0;
        }

        .topbar {
            min-height: 78px;
            padding: 18px 30px;
            background: white;
            border-bottom: 1px solid #e0e7ee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .topbar-title {
            display: block;
            color: #003b70;
            font-size: 18px;
        }

        .topbar-subtitle {
            display: block;
            margin-top: 6px;
            color: #718296;
            font-size: 11px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .role-label {
            padding: 8px 11px;
            border: 1px solid #d3e4f2;
            border-radius: 6px;
            background: #f0f7fc;
            color: #003b70;
            font-size: 10px;
            font-weight: 800;
        }

        .content {
            max-width: 1700px;
            padding: 30px;
            margin: auto;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            color: #8090a1;
            font-size: 12px;
        }

        .breadcrumb a {
            color: #64798d;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0 0 9px;
            color: #173b5a;
            font-size: 27px;
            letter-spacing: -.5px;
        }

        h2 {
            margin: 0 0 15px;
            color: #003b70;
            font-size: 18px;
        }

        p {
            line-height: 1.7;
        }

        .page-description {
            margin: 0;
            color: #718296;
            font-size: 13px;
            line-height: 1.7;
        }

        .card {
            margin-bottom: 22px;
            padding: 23px;
            border: 1px solid #dfe7ef;
            border-radius: 12px;
            background: white;
            box-shadow: 0 3px 14px #193e6004;
        }

        .card-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #003b70;
            font-size: 16px;
            font-weight: 700;
        }

        .card-title .icon {
            color: #47799f;
        }

        .muted {
            color: #75869a;
            font-size: 12px;
        }

        .button,
        button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 41px;
            padding: 11px 16px;
            border: 1px solid transparent;
            border-radius: 7px;
            background: #003b70;
            color: white;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.4;
            cursor: pointer;
            transition: background .15s;
        }

        .button:hover,
        button:hover {
            background: #002d56;
        }

        .button .icon,
        button .icon {
            width: 16px;
            height: 16px;
        }

        .secondary {
            background: white;
            color: #335a7a;
            border-color: #dbe5ee;
        }

        .secondary:hover {
            background: #f3f7fb;
        }

        .danger {
            background: #b42318;
        }

        .danger:hover {
            background: #941d14;
        }

        .buttons {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filters {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 16px;
        }

        .filter-field {
            flex: 1 1 240px;
            max-width: 400px;
        }

        .filter-status {
            flex: 0 1 230px;
        }

        label {
            display: block;
            margin: 12px 0 8px;
            color: #52677b;
            font-size: 12px;
            font-weight: 700;
        }

        .filters label {
            margin-top: 0;
        }

        input:not([type=checkbox]),
        select,
        textarea {
            width: 100%;
            max-width: 100%;
            padding: 11px 12px;
            border: 1px solid #d2dde8;
            border-radius: 7px;
            background: white;
            color: #263849;
            font-size: 13px;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #729dbf;
            box-shadow: 0 0 0 3px #eaf2f9;
        }

        input::placeholder,
        textarea::placeholder {
            color: #98a5b3;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input[type=checkbox] {
            width: 17px;
            height: 17px;
            vertical-align: middle;
        }

        .checkbox {
            line-height: 1.8;
        }

        .filter-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 20px;
            padding-top: 17px;
            border-top: 1px solid #edf1f5;
        }

        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border: 1px solid #e0e8ef;
            border-radius: 7px;
            color: #64788c;
            font-size: 12px;
        }

        .filter-chip.active {
            background: #edf5fc;
            border-color: #cfe1f0;
            color: #003b70;
            font-weight: 700;
        }

        .filter-chip .icon {
            width: 15px;
            height: 15px;
        }

        .count {
            display: inline-flex;
            align-items: center;
            padding: 7px 10px;
            border-radius: 6px;
            background: #edf5fc;
            color: #003b70;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .scroll {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th,
        td {
            padding: 16px 13px;
            border-bottom: 1px solid #e6edf3;
            text-align: left;
            vertical-align: middle;
            line-height: 1.6;
        }

        th {
            background: #f0f6fb;
            color: #536d84;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fbfdff;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .requests-table {
            min-width: 920px;
        }

        .request-code {
            color: #75879a;
            font-size: 12px;
            font-weight: 700;
        }

        .booking-code {
            color: #003b70;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .customer {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 33px;
            height: 33px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #edf4fa;
            color: #3d698c;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .customer-name {
            font-size: 12px;
            font-weight: 600;
        }

        .money {
            color: #173b5a;
            font-weight: 800;
            white-space: nowrap;
        }

        .date {
            color: #445d73;
            font-size: 12px;
            white-space: nowrap;
        }

        .time-detail {
            display: block;
            margin-top: 3px;
            color: #8a98a7;
            font-size: 11px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 6px;
            background: #fff5e5;
            color: #9b650a;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge .icon {
            width: 14px;
            height: 14px;
        }

        .approved {
            background: #eaf7ef;
            color: #19824d;
        }

        .rejected {
            background: #fceeee;
            color: #bd3b36;
        }

        .detail-button {
            min-height: 34px;
            padding: 8px 11px;
            background: #eef5fb;
            color: #003b70;
            border-color: #d9e7f3;
            font-size: 11px;
            white-space: nowrap;
        }

        .detail-button:hover {
            background: #e0edf8;
        }

        .empty {
            padding: 45px 20px;
            text-align: center;
            color: #7b8b9b;
        }

        .empty .icon {
            display: block;
            width: 33px;
            height: 33px;
            margin: 0 auto 12px;
            color: #9db4c7;
        }

        .success,
        .errors,
        .notice {
            margin-bottom: 18px;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.7;
        }

        .success {
            background: #eaf7f0;
            color: #146c43;
        }

        .errors {
            background: #fdebed;
            color: #842029;
        }

        .notice {
            background: #fff4e5;
            color: #854d0e;
        }

        .grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 20px;
        }

        .bill {
            width: 100%;
            max-height: 650px;
            object-fit: contain;
            border: 1px solid #e3eaf0;
            border-radius: 8px;
        }

        .nowrap {
            white-space: nowrap;
        }

        pre {
            max-height: 220px;
            overflow: auto;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            font-size: 12px;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #e6edf3;
            font-size: 12px;
        }

        .decision {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e3eaf0;
        }

        .user .page {
            margin-left: 0;
        }

        .user .content {
            max-width: 1200px;
        }

        .user .topbar {
            background: #00294f;
            color: white;
        }

        .user .topbar a {
            color: white;
        }

        .user .logo {
            padding: 0;
            font-size: 25px;
        }

        @media(max-width: 1100px) {
            .content {
                padding: 24px 20px;
            }

            .topbar {
                padding: 18px 20px;
            }

            .page-heading {
                align-items: flex-start;
            }
        }

        @media(max-width: 850px) {
            .sidebar {
                position: static;
                width: 100%;
            }

            .logo {
                padding: 20px 24px;
            }

            .menu-title,
            .sidebar-bottom {
                display: none;
            }

            .menu {
                display: flex;
                gap: 6px;
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .menu-link {
                flex-shrink: 0;
                margin: 0;
                white-space: nowrap;
            }

            .page {
                margin-left: 0;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 22px 14px;
            }

            .topbar {
                padding: 16px 14px;
                flex-wrap: wrap;
            }

            .page-heading {
                flex-direction: column;
                gap: 14px;
            }

            h1 {
                font-size: 23px;
            }

            .card {
                padding: 18px;
            }

            .filter-field,
            .filter-status {
                max-width: none;
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body class="{{ auth()->user()->role === 'admin' ? 'admin' : 'user' }}">
<svg
    xmlns="http://www.w3.org/2000/svg"
    width="0"
    height="0"
    aria-hidden="true"
    style="position:absolute;overflow:hidden"
>
    <defs>
        <symbol id="pr-search" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 5 5"/>
        </symbol>

        <symbol id="pr-filter" viewBox="0 0 24 24">
            <path d="M3 4h18l-7 8v7l-4 2v-9z"/>
        </symbol>

        <symbol id="pr-refresh" viewBox="0 0 24 24">
            <path d="M20 7v5h-5M4 17v-5h5"/>
            <path d="M6 7a7 7 0 0 1 12-1l2 3M4 15l2 3a7 7 0 0 0 12-1"/>
        </symbol>

        <symbol id="pr-eye" viewBox="0 0 24 24">
            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
            <circle cx="12" cy="12" r="3"/>
        </symbol>

        <symbol id="pr-clock" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </symbol>

        <symbol id="pr-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="pr-close" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m9 9 6 6M15 9l-6 6"/>
        </symbol>

        <symbol id="pr-list" viewBox="0 0 24 24">
            <rect x="4" y="3" width="16" height="18" rx="2"/>
            <path d="M8 8h8M8 12h8M8 16h5"/>
        </symbol>

        <symbol id="pr-arrow" viewBox="0 0 24 24">
            <path d="M19 12H5m6-6-6 6 6 6"/>
        </symbol>
    </defs>
</svg>

@if(auth()->user()->role === 'admin')
    @php
        $menus = [
            [
                'admin.trang-chu',
                'Tổng quan',
                'M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z',
            ],
            [
                'admin.airports.index',
                'Quản lý sân bay',
                'M4 21V8l8-5 8 5v13M2 21h20M8 9h1M15 9h1M8 13h1M15 13h1M10 21v-4h4v4',
            ],
            [
                'admin.aircraft.index',
                'Quản lý máy bay',
                'm3 10 18 2-18 8 3-7-3-3ZM6 13l15-1M10 11 8 5',
            ],
            [
                'admin.flights.index',
                'Quản lý chuyến bay',
                'M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2ZM8 3v4M16 3v4M3 10h18M8 14h3M8 17h6',
            ],
            [
                'admin.bookings.index',
                'Quản lý vé',
                'M3 5h18v5a2 2 0 0 0 0 4v5H3v-5a2 2 0 0 0 0-4V5ZM15 5v3M15 11v2M15 16v3',
            ],
            [
                'admin.users.index',
                'Quản lý người dùng',
                'M15 21v-2a6 6 0 0 0-12 0v2M9 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM17 4a4 4 0 0 1 0 8M21 21v-2a6 6 0 0 0-4-5',
            ],
            [
                'admin.employees.index',
                'Quản lý nhân viên',
                'M5 5h14v16H5V5ZM9 5V3h6v2M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM8 18a4 4 0 0 1 8 0',
            ],
            [
                'admin.check-ins.index',
                'Lịch sử check-in',
                'M12 3a9 9 0 1 0 9 9 9 9 0 0 0-9-9ZM12 7v5l3 2',
            ],
            [
                'admin.payment-reviews.index',
                'Xử lý thanh toán',
                'M3 5h18v14H3V5ZM3 9h18M7 14h3m4 0 2 2 4-4',
            ],
            [
                'admin.baggage.index',
                'Quản lý hành lý',
                'M5 7h14v13H5V7ZM9 7V4h6v3M9 11v5M15 11v5M8 20v2M16 20v2',
            ],
            [
                'admin.statistics.index',
                'Thống kê chi tiết',
                'M4 3v18h17M8 17v-5M13 17V8M18 17V5',
            ],
            [
                'admin.settings.edit',
                'Quản lý đổi giá vé',
                'M3 6h4M11 6h10M3 12h10M17 12h4M3 18h4M11 18h10M7 3v6M13 9v6M7 15v6',
            ],
            [
                'admin.refund-settings.edit',
                'Quản lý hoàn vé',
                'M8 7H4V3M4 7a9 9 0 1 1-1 9M12 7v10M15 9h-4a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4H9',
            ],
        ];
    @endphp

    <aside class="sidebar">
        <a class="logo" href="{{ route('admin.trang-chu') }}">
            Viet<span>Jet</span>
        </a>

        <div class="menu-title">QUẢN LÝ HỆ THỐNG</div>

        <nav class="menu" aria-label="Menu admin">
            @foreach($menus as [$menuRoute, $menuName, $menuPath])
                <a
                    class="menu-link {{ $menuRoute === 'admin.payment-reviews.index' ? 'active' : '' }}"
                    href="{{ route($menuRoute) }}"
                    @if($menuRoute === 'admin.payment-reviews.index')
                        aria-current="page"
                    @endif
                >
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="{{ $menuPath }}"/>
                    </svg>

                    {{ $menuName }}
                </a>
            @endforeach
        </nav>

        <div class="sidebar-bottom">
            <strong class="account-name">
                {{ auth()->user()->name }}
            </strong>

            <span class="account-role">Quản trị viên hệ thống</span>

            <form method="POST" action="{{ route('dang-xuat') }}">
                @csrf

                <button type="submit" class="logout">
                    Đăng xuất
                </button>
            </form>
        </div>
    </aside>
@endif

<div class="page">
    <header class="topbar">
        @if(auth()->user()->role === 'admin')
            <div>
                <strong class="topbar-title">
                    VietJet Administration
                </strong>

                <span class="topbar-subtitle">
                    Tiếp nhận và xử lý yêu cầu kiểm tra thanh toán
                </span>
            </div>

            <div class="topbar-actions">
                <a
                    class="button secondary"
                    href="{{ route('admin.bookings.index') }}"
                >
                    <svg class="icon" aria-hidden="true">
                        <use href="#pr-arrow"></use>
                    </svg>
                    Quản lý vé
                </a>

                <span class="role-label">ADMIN</span>
            </div>
        @else
            <a class="logo" href="{{ route('trang-chu') }}">
                Viet<span>Jet</span>
            </a>

            <a href="{{ route('tickets.mine') }}">Vé của tôi</a>
        @endif
    </header>

    <main class="content">
        @if(session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="errors" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>