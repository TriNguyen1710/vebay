<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lịch sử check-in - VietJet</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f3f6f9;
            color: #243746;
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            text-decoration: none;
            color: #003b70;
        }

        /* KHUNG TRÁI GIỐNG TRANG CHỦ ADMIN */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 245px;
            padding: 26px 16px;
            background: #00294f;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 20;
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
            color: #f4b400;
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
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .menu-link.active .menu-icon {
            color: #f4b400;
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

        .page {
            margin-left: 245px;
            min-width: 0;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 30px;
            background: white;
            border-bottom: 1px solid #dfe6eb;
        }

        .topbar strong {
            color: #003b70;
            font-size: 18px;
        }

        .topbar p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        main {
            max-width: 1800px;
            margin: 28px auto 60px;
            padding: 0 30px;
        }

        h1 {
            color: #003b70;
            font-size: 27px;
            margin-bottom: 8px;
        }

        h2 {
            color: #003b70;
            font-size: 19px;
            margin: 0 0 18px;
        }

        .intro {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        .card {
            background: white;
            border: 1px solid #dfe6eb;
            border-radius: 11px;
            padding: 23px;
            margin-top: 22px;
        }

        .filters {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 16px;
        }

        .field {
            min-width: 165px;
        }

        .flight-field {
            flex: 1 1 310px;
            max-width: 520px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5df;
            border-radius: 6px;
            background: white;
            color: #243746;
            font: inherit;
            font-size: 13px;
            min-height: 42px;
        }

        button,
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 12px 17px;
            border: 0;
            border-radius: 6px;
            background: #003b70;
            color: white;
            font-family: inherit;
            font-weight: bold;
            font-size: 13px;
            cursor: pointer;
            min-height: 42px;
        }

        .secondary {
            color: #003b70;
            background: #edf5fb;
        }

        .button svg,
        button svg {
            width: 17px;
            height: 17px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .sidebar .logout {
            width: 100%;
            min-height: 0;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.06);
            color: white;
            font-size: 11px;
            font-weight: bold;
        }

        .sidebar .logout:hover {
            background: #dc3545;
            border-color: #dc3545;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 22px;
        }

        .stat {
            padding: 20px;
            border: 1px solid #dfe6eb;
            border-radius: 9px;
            background: white;
        }

        .stat span {
            display: block;
            color: #64748b;
            font-size: 13px;
        }

        .stat strong {
            display: block;
            margin-top: 8px;
            font-size: 28px;
            color: #003b70;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .details-table {
            min-width: 1100px;
        }

        .flights-table {
            min-width: 1450px;
        }

        th {
            background: #edf5fb;
            color: #003b70;
            text-align: left;
            white-space: nowrap;
        }

        td,
        th {
            padding: 14px 12px;
            border-bottom: 1px solid #e5eaf0;
            vertical-align: top;
        }

        td {
            line-height: 1.6;
        }

        .time {
            white-space: nowrap;
        }

        .check-in-time {
            font-weight: bold;
            color: #146c43;
        }

        .code {
            white-space: nowrap;
            font-weight: bold;
            color: #003b70;
        }

        .aircraft-cell {
            min-width: 160px;
        }

        .capacity {
            white-space: nowrap;
            font-weight: bold;
            color: #003b70;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 5px;
            background: #eaf7f0;
            color: #146c43;
            white-space: nowrap;
        }

        .muted {
            font-size: 12px;
            color: #64748b;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 22px;
            flex-wrap: wrap;
            font-size: 13px;
        }

        .error,
        .success {
            padding: 15px;
            margin-top: 20px;
            border-radius: 7px;
            font-size: 14px;
            line-height: 1.6;
        }

        .error {
            background: #fdebed;
            color: #842029;
        }

        .success {
            background: #eaf7f0;
            color: #146c43;
        }

        @media (max-width: 1000px) {
            main {
                padding: 0 18px;
            }

            .topbar {
                padding: 18px;
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .page {
                margin-left: 0;
            }

            .menu {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sidebar-bottom {
                margin-top: 22px;
            }
        }

        @media (max-width: 700px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-wrap: wrap;
            }

            main {
                padding: 0 14px;
            }

            h1 {
                font-size: 23px;
            }

            .card {
                padding: 16px;
            }

            .field,
            .flight-field {
                width: 100%;
                max-width: none;
                flex: 1 1 100%;
            }
        }

        @media (max-width: 650px) {
            .menu {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
@php
    $historyRoute = $isAdmin
        ? 'admin.check-ins.index'
        : 'nhanvien.check-ins.index';

    $dashboardRoute = $isAdmin
        ? 'admin.trang-chu'
        : 'nhanvien.trang-chu';

    $adminMenu = [
        ['admin.trang-chu', 'Tổng quan', 'grid'],
        ['admin.airports.index', 'Quản lý sân bay', 'building'],
        ['admin.aircraft.index', 'Quản lý máy bay', 'plane'],
        ['admin.flights.index', 'Quản lý chuyến bay', 'calendar'],
        ['admin.bookings.index', 'Quản lý vé', 'ticket'],
        ['admin.users.index', 'Quản lý người dùng', 'users'],
        ['admin.employees.index', 'Quản lý nhân viên', 'users'],
        ['admin.payment-reviews.index', 'Đối soát thanh toán', 'payment'],
        ['admin.check-ins.index', 'Lịch sử check-in', 'clock'],
        ['admin.baggage.index', 'Quản lý hành lý', 'bag'],
        ['admin.statistics.index', 'Thống kê chi tiết', 'chart'],
        ['admin.settings.edit', 'Quản lý đổi giá vé', 'settings'],
        ['admin.refund-settings.edit', 'Quản lý hoàn vé', 'ticket'],
    ];

    $employeeMenu = [
        ['nhanvien.trang-chu', 'Tổng quan', 'grid'],
        ['nhanvien.tickets.index', 'Tra cứu vé', 'ticket'],
        ['nhanvien.passengers.unchecked', 'Hành khách chưa kiểm tra', 'users'],
        ['nhanvien.flights.index', 'Chuyến bay', 'plane'],
        ['profile.edit', 'Thông tin cá nhân', 'users'],
    ];

    $menuItems = $isAdmin ? $adminMenu : $employeeMenu;
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    width="0"
    height="0"
    aria-hidden="true"
    style="position:absolute;overflow:hidden"
>
    <defs>
        <symbol id="icon-grid" viewBox="0 0 24 24">
            <path d="M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z"/>
        </symbol>

        <symbol id="icon-building" viewBox="0 0 24 24">
            <path d="M5 21V7l7-4 7 4v14M3 21h18M9 9h1M14 9h1M9 13h1M14 13h1M10 21v-4h4v4"/>
        </symbol>

        <symbol id="icon-plane" viewBox="0 0 24 24">
            <path d="m3 10 18 2-18 8 3-7-3-3ZM6 13l15-1"/>
        </symbol>

        <symbol id="icon-calendar" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="16" rx="2"/>
            <path d="M8 3v4M16 3v4M3 10h18"/>
        </symbol>

        <symbol id="icon-ticket" viewBox="0 0 24 24">
            <path d="M4 4h16v16H4zM8 8h8M8 12h8M8 16h5"/>
        </symbol>

        <symbol id="icon-payment" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <path d="M3 9h18M7 14h3"/>
        </symbol>

        <symbol id="icon-users" viewBox="0 0 24 24">
            <circle cx="9" cy="8" r="4"/>
            <path d="M3 21v-2a6 6 0 0 1 12 0v2M16 11a4 4 0 0 1 5 4"/>
        </symbol>

        <symbol id="icon-clock" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </symbol>

        <symbol id="icon-bag" viewBox="0 0 24 24">
            <rect x="5" y="7" width="14" height="13" rx="2"/>
            <path d="M9 7V5a3 3 0 0 1 6 0v2M8 11h8"/>
        </symbol>

        <symbol id="icon-chart" viewBox="0 0 24 24">
            <path d="M4 20V10M10 20V4M16 20v-7M22 20V7"/>
        </symbol>

        <symbol id="icon-settings" viewBox="0 0 24 24">
            <path d="M3 7h10M17 7h4M3 17h4M11 17h10"/>
            <circle cx="15" cy="7" r="2"/>
            <circle cx="9" cy="17" r="2"/>
        </symbol>
    </defs>
</svg>

<aside class="sidebar">
    <a class="logo" href="{{ route($dashboardRoute) }}">
        Viet<span>jet</span>
    </a>

    <div class="menu-title">
        {{ $isAdmin ? 'QUẢN LÝ HỆ THỐNG' : 'CHỨC NĂNG NHÂN VIÊN' }}
    </div>

    <nav class="menu" aria-label="Menu chức năng">
        @foreach($menuItems as [$menuRoute, $menuLabel, $menuIcon])
            <a
                href="{{ route($menuRoute) }}"
                class="menu-link {{ $menuRoute === $historyRoute ? 'active' : '' }}"
                @if($menuRoute === $historyRoute)
                    aria-current="page"
                @endif
            >
                <span class="menu-icon">
                    <svg aria-hidden="true">
                        <use href="#icon-{{ $menuIcon }}"></use>
                    </svg>
                </span>

                <span>{{ $menuLabel }}</span>
            </a>
        @endforeach
    </nav>

    <div class="sidebar-bottom">
        <div class="admin-info">
            <strong>{{ auth()->user()->name }}</strong>

            <span>
                {{ $isAdmin ? 'Quản trị viên hệ thống' : 'Nhân viên' }}
            </span>
        </div>

        <form action="{{ route('dang-xuat') }}" method="POST">
            @csrf

            <button type="submit" class="logout">
                Đăng xuất
            </button>
        </form>
    </div>
</aside>

<div class="page">
    <header class="topbar">
        <div>
            <strong>
                {{ $isAdmin ? 'VietJet Administration' : 'VietJet Staff' }}
            </strong>

            <p>Theo dõi thông tin check-in hành khách</p>
        </div>

        <a class="button secondary" href="{{ route($dashboardRoute) }}">
            ← Quay lại tổng quan
        </a>
    </header>

    <main>
        <h1>
            {{ $isAdmin ? 'Lịch sử check-in của nhân viên' : 'Lịch sử check-in của tôi' }}
        </h1>

        <p class="intro">
            Theo dõi ngày giờ đặt vé, thời điểm check-in,
            nhân viên thực hiện và thông tin chuyến bay.
            Thời gian hiển thị theo giờ Việt Nam.
        </p>

        @if(session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="card">
            <h2>Lọc lịch sử</h2>

            <form
                method="GET"
                action="{{ route($historyRoute) }}"
                class="filters"
            >
                <div class="field">
                    <label for="date">Ngày check-in</label>

                    <input
                        id="date"
                        type="date"
                        name="date"
                        value="{{ $date }}"
                    >
                </div>

                @if($isAdmin)
                    <div class="field">
                        <label for="employee_id">Nhân viên</label>

                        <select id="employee_id" name="employee_id">
                            <option value="">Tất cả nhân viên</option>

                            @foreach($employees as $employee)
                                <option
                                    value="{{ $employee->id }}"
                                    @selected((string) $employeeId === (string) $employee->id)
                                >
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="field flight-field">
                    <label for="flight_id">Chuyến bay</label>

                    <select id="flight_id" name="flight_id">
                        <option value="">Tất cả chuyến bay</option>

                        @foreach($flights as $flight)
                            <option
                                value="{{ $flight->id }}"
                                @selected((string) $flightId === (string) $flight->id)
                            >
                                {{ $flight->flight_code }}
                                |
                                {{ $flight->departureAirport?->city ?? '---' }}
                                →
                                {{ $flight->arrivalAirport?->city ?? '---' }}
                                |
                                {{ $flight->flight_date?->format('d/m/Y') ?? '---' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="method">Cách xác thực</label>

                    <select id="method" name="method">
                        <option value="">Tất cả</option>

                        <option value="face" @selected($method === 'face')>
                            Khuôn mặt
                        </option>

                        <option value="manual" @selected($method === 'manual')>
                            Thủ công
                        </option>
                    </select>
                </div>

                <button type="submit">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 4h18l-7 8v7l-4 2v-9z"/>
                    </svg>

                    Lọc
                </button>

                <a class="button secondary" href="{{ route($historyRoute) }}">
                    Hôm nay
                </a>

                <a
                    class="button secondary"
                    href="{{ route($historyRoute, ['date' => '']) }}"
                >
                    Tất cả ngày
                </a>
            </form>
        </section>

        <div class="stats">
            <div class="stat">
                <span>Tổng lượt check-in theo bộ lọc</span>
                <strong>{{ $records->total() }}</strong>
            </div>

            <div class="stat">
                <span>Xác thực khuôn mặt</span>
                <strong>{{ $summary->sum('face_total') }}</strong>
            </div>

            <div class="stat">
                <span>Kiểm tra thủ công</span>
                <strong>{{ $summary->sum('manual_total') }}</strong>
            </div>
        </div>

        @if($isAdmin)
            <section class="card">
                <h2>Tổng hợp theo nhân viên</h2>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nhân viên</th>
                                <th>Tổng lượt</th>
                                <th>Khuôn mặt</th>
                                <th>Thủ công</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($summary as $item)
                                <tr>
                                    <td>{{ $item->employee_name }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ $item->face_total }}</td>
                                    <td>{{ $item->manual_total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty">
                                        Chưa có lượt check-in phù hợp.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        <section class="card">
            <h2>Chi tiết check-in</h2>

            <div class="table-wrap">
                <table class="details-table">
                    <thead>
                        <tr>
                            <th>Ngày giờ đặt vé</th>
                            <th>Ngày giờ check-in</th>
                            <th>Nhân viên</th>
                            <th>Hành khách</th>
                            <th>Mã vé</th>
                            <th>Mã đặt vé</th>
                            <th>Cách xác thực</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($records as $record)
                            @php
                                $bookedAt = $bookingTimes->get($record->booking_id);
                            @endphp

                            <tr>
                                <td class="time">
                                    @if($bookedAt)
                                        {{ \Carbon\Carbon::parse($bookedAt, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                                    @else
                                        <span class="muted">Chưa có dữ liệu</span>
                                    @endif
                                </td>

                                <td class="time check-in-time">
                                    {{ \Carbon\Carbon::parse($record->checked_in_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                                </td>

                                <td>{{ $record->employee_name }}</td>
                                <td>{{ $record->passenger_name }}</td>
                                <td class="code">{{ $record->ticket_code }}</td>
                                <td class="code">{{ $record->booking_code }}</td>

                                <td>
                                    <span class="badge">
                                        {{ $record->verification_method === 'face' ? 'Khuôn mặt' : 'Thủ công' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">
                                    Chưa có lượt check-in phù hợp với bộ lọc.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="card">
            <h2>Thông tin chuyến bay của các vé đã check-in</h2>

            <p class="intro">
                Đối chiếu bằng mã vé với bảng chi tiết check-in phía trên.
                Bảng này hiển thị các vé thuộc trang hiện tại.
            </p>

            <div class="table-wrap">
                <table class="flights-table">
                    <thead>
                        <tr>
                            <th>Mã vé</th>
                            <th>Hành khách</th>
                            <th>Mã chuyến bay</th>
                            <th>Máy bay</th>
                            <th>Tổng số ghế</th>
                            <th>Hành trình</th>
                            <th>Ngày bay</th>
                            <th>Giờ khởi hành</th>
                            <th>Giờ đến</th>
                            <th>Ghế hành khách</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($records as $record)
                            @php
                                $ticket = $tickets->get($record->ticket_id);
                                $recordFlight = $ticket?->flight;

                                // Tránh hiển thị nhầm chuyến nếu dữ liệu vé
                                // đã được đổi sang mã chuyến khác sau đó.
                                if (
                                    $recordFlight
                                    && $recordFlight->flight_code !== $record->flight_code
                                ) {
                                    $recordFlight = null;
                                }

                                $aircraft = $recordFlight?->aircraft;
                            @endphp

                            <tr>
                                <td class="code">
                                    {{ $record->ticket_code }}
                                </td>

                                <td>{{ $record->passenger_name }}</td>

                                <td class="code">
                                    {{ $record->flight_code }}
                                </td>

                                <td class="aircraft-cell">
                                    @if($aircraft)
                                        <strong>
                                            {{ $aircraft->name ?? 'Chưa có tên máy bay' }}
                                        </strong>

                                        <br>

                                        <span class="muted">
                                            Mã máy bay:
                                            {{ $aircraft->code ?? '---' }}
                                        </span>
                                    @else
                                        <span class="muted">
                                            Chưa có dữ liệu máy bay
                                        </span>
                                    @endif
                                </td>

                                <td class="capacity">
                                    @if($aircraft && $aircraft->total_seats !== null)
                                        {{ number_format((int) $aircraft->total_seats, 0, ',', '.') }}
                                        ghế
                                    @else
                                        <span class="muted">Chưa có dữ liệu</span>
                                    @endif
                                </td>

                                <td>
                                    @if($recordFlight)
                                        <strong>
                                            {{ $recordFlight->departureAirport?->city ?? '---' }}
                                            →
                                            {{ $recordFlight->arrivalAirport?->city ?? '---' }}
                                        </strong>

                                        <br>

                                        <span class="muted">
                                            {{ $recordFlight->departureAirport?->name ?? '---' }}
                                            →
                                            {{ $recordFlight->arrivalAirport?->name ?? '---' }}
                                        </span>
                                    @else
                                        <span class="muted">
                                            Chưa có dữ liệu chuyến bay
                                        </span>
                                    @endif
                                </td>

                                <td class="time">
                                    {{ $recordFlight?->flight_date?->format('d/m/Y') ?? '---' }}
                                </td>

                                <td class="time">
                                    {{ $recordFlight?->departure_time ? substr((string) $recordFlight->departure_time, 0, 5) : '---' }}
                                </td>

                                <td class="time">
                                    {{ $recordFlight?->arrival_time ? substr((string) $recordFlight->arrival_time, 0, 5) : '---' }}
                                </td>

                                <td>
                                    <span class="badge">
                                        {{ $record->seat_number ?? '---' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty">
                                    Chưa có thông tin chuyến bay phù hợp với bộ lọc.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        @if($records->hasPages())
            <div class="pagination">
                <div>
                    @if($records->previousPageUrl())
                        <a
                            class="button secondary"
                            href="{{ $records->previousPageUrl() }}"
                        >
                            ← Trang trước
                        </a>
                    @endif
                </div>

                <span>
                    Trang {{ $records->currentPage() }}
                    / {{ $records->lastPage() }}
                </span>

                <div>
                    @if($records->nextPageUrl())
                        <a
                            class="button secondary"
                            href="{{ $records->nextPageUrl() }}"
                        >
                            Trang sau →
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <p class="intro">
            Chỉ hiển thị những lượt check-in được ghi nhận
            sau khi bổ sung chức năng lịch sử.
            Ngày giờ đặt vé lấy từ đơn đặt vé.
            Hành trình, lịch bay và máy bay lấy từ dữ liệu hiện tại.
            Tổng số ghế là sức chứa máy bay, không phải số ghế còn trống.
        </p>
    </main>
</div>
</body>
</html>