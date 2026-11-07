
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê vé - Nhân viên sân bay</title>

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
            --success: #168053;
            --danger: #dc3545;
            --warning: #d28a00;
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

        button, input, select {
            font-family: inherit;
        }

        /* ================================
           BỐ CỤC CHUNG
        ================================= */

        .employee-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 245px minmax(0, 1fr);
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
            overflow-y: auto;
        }

        .logo {
            display: block;
            padding: 0 10px;
            margin-bottom: 7px;
            color: white;
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1px;
            white-space: nowrap;
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
            transition: .2s;
        }

        .menu-link:hover,
        .menu-link.active {
            background: rgba(255,255,255,.1);
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
            color: var(--secondary);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 22px;
            border-top: 1px solid rgba(255,255,255,.1);
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
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 6px;
            background: rgba(255,255,255,.06);
            color: white;
            cursor: pointer;
            font-size: 11px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: var(--danger);
        }

        /* ================================
           PHẦN NỘI DUNG
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
            max-width: 1250px;
            margin: auto;
            padding: 30px;
        }

        /* ================================
           TIÊU ĐỀ
        ================================= */

        .page-heading {
            margin-bottom: 22px;
        }

        .page-heading h1 {
            color: var(--primary-dark);
            font-size: 23px;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        /* ================================
           KHUNG LỌC
        ================================= */

        .filter-box {
            padding: 19px 20px;
            margin-bottom: 24px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .filter-title {
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 700;
            color: var(--primary);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1fr 1.4fr auto;
            gap: 13px;
            align-items: end;
        }

        .filter-field label {
            display: block;
            margin-bottom: 7px;
            color: #43576b;
            font-size: 11px;
            font-weight: 700;
        }

        .filter-field input,
        .filter-field select {
            width: 100%;
            height: 40px;
            padding: 0 10px;
            background: white;
            border: 1px solid #d9e3ec;
            border-radius: 6px;
            color: #30495f;
            font-size: 12px;
        }

        .filter-button {
            height: 40px;
            padding: 0 17px;
            border: none;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .filter-button:hover {
            background: var(--primary-dark);
        }

        .filter-error {
            margin-top: 10px;
            color: var(--danger);
            font-size: 11px;
        }

        /* ================================
           TIÊU ĐỀ NHÓM
        ================================= */

        .section-heading {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 14px;
        }

        .section-line {
            width: 4px;
            height: 21px;
            border-radius: 6px;
            background: var(--secondary);
        }

        .section-heading h2 {
            color: var(--primary-dark);
            font-size: 15px;
        }

        /* ================================
           CÁC Ô THỐNG KÊ
        ================================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 15px;
            margin-bottom: 22px;
        }

        .stat-card {
            padding: 20px;
            min-height: 150px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .stat-title {
            margin-bottom: 13px;
            color: #586d80;
            font-size: 12px;
            font-weight: 700;
        }

        .stat-number {
            margin-bottom: 11px;
            color: var(--primary);
            font-size: 34px;
            font-weight: 800;
            line-height: 1;
        }

        .stat-description {
            color: #8292a0;
            font-size: 10px;
            line-height: 1.6;
        }

        .stat-card.green .stat-number {
            color: var(--success);
        }

        .stat-card.orange .stat-number {
            color: var(--warning);
        }

        .stat-card.red .stat-number {
            color: var(--danger);
        }

        /* ================================
           TÌNH TRẠNG THANH TOÁN
        ================================= */

        .status-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 23px;
        }

        .status-card {
            padding: 18px 20px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
        }

        .status-card .label {
            color: #586d80;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 11px;
        }

        .status-card .value {
            color: var(--primary);
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .status-card .note {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .info-note {
            padding: 13px 16px;
            margin-bottom: 24px;
            border: 1px solid #d5e5f2;
            border-left: 4px solid var(--primary);
            border-radius: 6px;
            background: #edf5fb;
            color: #355471;
            font-size: 11px;
            line-height: 1.7;
        }

        /* ================================
           BẢNG THỐNG KÊ
        ================================= */

        .table-box {
            padding: 20px;
            margin-bottom: 24px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
        }

        .table-description {
            margin-bottom: 16px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        thead {
            background: var(--primary-light);
        }

        th {
            padding: 13px 12px;
            color: var(--primary);
            text-align: left;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #ebeff3;
            color: #425563;
        }

        tbody tr:hover {
            background: #f8fbfe;
        }

        .number {
            font-weight: 700;
            color: var(--primary);
        }

        .green-text {
            color: var(--success);
            font-weight: 700;
        }

        .orange-text {
            color: var(--warning);
            font-weight: 700;
        }

        .red-text {
            color: var(--danger);
            font-weight: 700;
        }

        .detail-link {
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .detail-link:hover {
            text-decoration: underline;
        }

        .empty-data {
            padding: 28px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .footer {
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

        @media (max-width: 1150px) {
            .stats-grid {
                grid-template-columns: repeat(2,1fr);
            }

            .filter-form {
                grid-template-columns: repeat(2,1fr);
            }
        }

        @media (max-width: 900px) {
            .employee-layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .menu {
                grid-template-columns: repeat(2,1fr);
            }

            .main {
                margin-left: 0;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px;
            }

            .topbar {
                height: auto;
                padding: 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .menu,
            .stats-grid,
            .status-box,
            .filter-form {
                grid-template-columns: 1fr;
            }

            .footer {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>

<body>

<div class="employee-layout">

    <!-- ================================
         SIDEBAR
    ================================= -->

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
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                    </svg>
                </span>
                Danh sách chuyến bay
            </a>

            <a
                href="{{ route('profile.edit') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21v-2a8 8 0 0 1 16 0v2"/>
                    </svg>
                </span>
                Thông tin cá nhân
            </a>

            <a
                href="{{ route('nhanvien.tickets.statistics') }}"
                class="menu-link active"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 20V11"/>
                        <path d="M10 20V5"/>
                        <path d="M16 20V14"/>
                        <path d="M22 20V8"/>
                    </svg>
                </span>
                Thống kê vé
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="employee-info">
                <strong>{{ auth()->user()->name }}</strong>
                <span>Nhân viên sân bay</span>
            </div>

            <form
                action="{{ route('dang-xuat') }}"
                method="POST"
            >
                @csrf

                <button type="submit" class="logout-btn">
                    Đăng xuất
                </button>
            </form>

        </div>

    </aside>

    <!-- ================================
         MAIN
    ================================= -->

    <main class="main">

        <header class="topbar">

            <div class="topbar-left">
                <h2>Airport Operations</h2>
                <p>
                    Hệ thống hỗ trợ nghiệp vụ nhân viên sân bay
                </p>
            </div>

            <span class="employee-badge">
                NHÂN VIÊN
            </span>

        </header>

        <div class="content">

            <!-- TIÊU ĐỀ TRANG -->
            <div class="page-heading">

                <h1>Thống kê vé máy bay</h1>

                <p>
                    Xem nhanh số lượng vé và tình trạng
                    kiểm tra hành khách theo từng chuyến bay.
                </p>

            </div>

            <!-- ================================
                 BỘ LỌC
            ================================= -->

            <section class="filter-box">

                <h3 class="filter-title">
                    Chọn thời gian thống kê
                </h3>

                <form
                    method="GET"
                    action="{{ route('nhanvien.tickets.statistics') }}"
                >

                    <div class="filter-form">

                        <div class="filter-field">
                            <label for="from_date">
                                Từ ngày bay
                            </label>

                            <input
                                type="date"
                                id="from_date"
                                name="from_date"
                                value="{{ old('from_date', $fromDate) }}"
                            >
                        </div>

                        <div class="filter-field">
                            <label for="to_date">
                                Đến ngày bay
                            </label>

                            <input
                                type="date"
                                id="to_date"
                                name="to_date"
                                value="{{ old('to_date', $toDate) }}"
                            >
                        </div>

                        <div class="filter-field">
                            <label for="flight_id">
                                Chuyến bay
                            </label>

                            <select
                                name="flight_id"
                                id="flight_id"
                            >

                                <option value="">
                                    Tất cả chuyến bay
                                </option>

                                @foreach ($flights as $flight)
                                    <option
                                        value="{{ $flight->id }}"
                                        @selected(
                                            (string) $flightId ===
                                            (string) $flight->id
                                        )
                                    >
                                        {{ $flight->flight_code }}
                                        -
                                        {{ \Illuminate\Support\Carbon::parse($flight->flight_date)->format('d/m/Y') }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <button
                            type="submit"
                            class="filter-button"
                        >
                            Xem thống kê
                        </button>

                    </div>

                    @error('from_date')
                        <p class="filter-error">{{ $message }}</p>
                    @enderror

                    @error('to_date')
                        <p class="filter-error">{{ $message }}</p>
                    @enderror

                    @error('flight_id')
                        <p class="filter-error">{{ $message }}</p>
                    @enderror

                </form>

            </section>

            <!-- ================================
                 THỐNG KÊ CHÍNH
            ================================= -->

            <div class="section-heading">
                <div class="section-line"></div>
                <h2>Tình trạng vé</h2>
            </div>

            <section class="stats-grid">

                <!-- TỔNG SỐ VÉ -->
                <div class="stat-card">

                    <div class="stat-title">
                        Tổng số vé
                    </div>

                    <div class="stat-number">
                        {{ number_format($totalTickets, 0, ',', '.') }}
                    </div>

                    <div class="stat-description">
                        Toàn bộ vé của các chuyến bay
                        trong khoảng thời gian đã chọn.
                    </div>

                </div>

                <!-- ĐÃ KIỂM TRA -->
                <div class="stat-card green">

                    <div class="stat-title">
                        Đã kiểm tra
                    </div>

                    <div class="stat-number">
                        {{ number_format($usedTickets, 0, ',', '.') }}
                    </div>

                    <div class="stat-description">
                        Vé đã thanh toán và hành khách
                        đã được nhân viên xác nhận.
                    </div>

                </div>

                <!-- CHƯA KIỂM TRA -->
                <div class="stat-card orange">

                    <div class="stat-title">
                        Chưa kiểm tra
                    </div>

                    <div class="stat-number">
                        {{ number_format($activeTickets, 0, ',', '.') }}
                    </div>

                    <div class="stat-description">
                        Vé đã thanh toán, còn hiệu lực
                        nhưng chưa được kiểm tra.
                    </div>

                </div>

                <!-- ĐÃ HỦY -->
                <div class="stat-card red">

                    <div class="stat-title">
                        Vé đã hủy
                    </div>

                    <div class="stat-number">
                        {{ number_format($cancelledTickets, 0, ',', '.') }}
                    </div>

                    <div class="stat-description">
                        Những vé có trạng thái đã hủy
                        trong hệ thống.
                    </div>

                </div>

            </section>

            <!-- 
            <!-- ================================
                 THỐNG KÊ THEO NGÀY
            ================================= -->

            <div class="section-heading">
                <div class="section-line"></div>
                <h2>Số vé theo ngày bay</h2>
            </div>

            <section class="table-box">

                <p class="table-description">
                    Bảng dưới đây cho biết mỗi ngày bay có bao nhiêu
                    vé đã thanh toán, bao nhiêu vé đã kiểm tra
                    và bao nhiêu vé chưa kiểm tra.
                </p>

                <div class="table-responsive">

                    <table>

                        <thead>
                            <tr>
                                <th>Ngày bay</th>
                                <th>Vé đã thanh toán</th>
                                <th>Đã kiểm tra</th>
                                <th>Chưa kiểm tra</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($dailyStatistics as $item)

                                <tr>

                                    <td>
                                        {{ \Illuminate\Support\Carbon::parse($item->flight_day)->format('d/m/Y') }}
                                    </td>

                                    <td class="number">
                                        {{ number_format($item->total, 0, ',', '.') }}
                                    </td>

                                    <td class="green-text">
                                        {{ number_format($item->used_count, 0, ',', '.') }}
                                    </td>

                                    <td class="orange-text">
                                        {{ number_format($item->active_count, 0, ',', '.') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4">
                                        <div class="empty-data">
                                            Chưa có dữ liệu trong khoảng
                                            thời gian đã chọn.
                                        </div>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            <!-- ================================
                 THỐNG KÊ CHUYẾN BAY
            ================================= -->

            <div class="section-heading">
                <div class="section-line"></div>
                <h2>Chi tiết từng chuyến bay</h2>
            </div>

            <section class="table-box">

                <p class="table-description">
                    Mỗi dòng tương ứng một chuyến bay.
                    Chọn "Xem hành khách" để mở danh sách
                    hành khách của chuyến bay đó.
                </p>

                <div class="table-responsive">

                    <table>

                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã chuyến bay</th>
                                <th>Ngày bay</th>
                                <th>Tổng vé</th>
                                <th>Đã kiểm tra</th>
                                <th>Chưa kiểm tra</th>
                                <th>Đã hủy</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($flightStatistics as $index => $item)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="number">
                                        {{ $item->flight_code }}
                                    </td>

                                    <td>
                                        {{ \Illuminate\Support\Carbon::parse($item->flight_date)->format('d/m/Y') }}
                                    </td>

                                    <td class="number">
                                        {{ number_format($item->total_tickets, 0, ',', '.') }}
                                    </td>

                                    <td class="green-text">
                                        {{ number_format($item->used_tickets, 0, ',', '.') }}
                                    </td>

                                    <td class="orange-text">
                                        {{ number_format($item->active_tickets, 0, ',', '.') }}
                                    </td>

                                    <td class="red-text">
                                        {{ number_format($item->cancelled_tickets, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <a
                                            class="detail-link"
                                            href="{{ route('nhanvien.flights.passengers', $item->id) }}"
                                        >
                                            Xem hành khách
                                        </a>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8">
                                        <div class="empty-data">
                                            Không tìm thấy chuyến bay
                                            phù hợp với bộ lọc.
                                        </div>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            <!-- FOOTER -->
            <footer class="footer">

                <span>
                    SkyGo Airport Operations
                </span>

                <span>
                    Khu vực nhân viên sân bay
                </span>

            </footer>

        </div>

    </main>

</div>

</body>
</html>
