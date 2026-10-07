<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý hành lý - Vietjet Admin</title>

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
            --white: #ffffff;
            --background: #f3f6f9;
            --text: #22313f;
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
            background: var(--white);
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
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
            padding: 30px 0 50px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 24px;
        }

        .page-heading h1 {
            color: var(--primary-dark);
            font-size: 27px;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
        }

        .breadcrumb {
            color: var(--muted);
            font-size: 11px;
        }

        .breadcrumb a {
            color: var(--primary);
            font-weight: bold;
        }

        .message {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
        }

        .message-success {
            color: #146c43;
            background: #dff5e8;
            border: 1px solid #b8e7ca;
        }

        .message-error {
            color: #842029;
            background: #f8d7da;
            border: 1px solid #f1aeb5;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .card-header {
            padding: 19px 22px;
            border-bottom: 1px solid #e8edf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .card-title-wrap h2 {
            color: var(--primary);
            font-size: 16px;
            margin-bottom: 5px;
        }

        .card-title-wrap p {
            color: var(--muted);
            font-size: 10px;
        }

        .card-body {
            padding: 22px;
        }

        .carry-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            max-width: 760px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #465764;
            font-size: 11px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #cdd8df;
            border-radius: 6px;
            background: white;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.08);
        }

        .carry-note {
            margin-top: 16px;
            padding: 13px 15px;
            background: var(--primary-light);
            border-left: 3px solid var(--primary);
            border-radius: 5px;
            color: #536778;
            font-size: 11px;
            line-height: 1.6;
        }

        .form-actions {
            margin-top: 18px;
        }

        .btn {
            min-height: 38px;
            padding: 0 16px;
            border: 0;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-yellow {
            background: var(--secondary);
            color: #2d2500;
        }

        .btn-yellow:hover {
            background: #dca200;
        }

        .btn-edit {
            background: #e9f2f8;
            color: var(--primary);
            border: 1px solid #cadde9;
        }

        .btn-edit:hover {
            background: #dcebf4;
        }

        .btn-delete {
            background: #fff0f0;
            color: var(--danger);
            border: 1px solid #f1c5c8;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f7f9fb;
        }

        th {
            padding: 13px 15px;
            color: #526371;
            font-size: 10px;
            font-weight: bold;
            text-align: left;
            white-space: nowrap;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 15px;
            color: #3c4c59;
            font-size: 12px;
            border-bottom: 1px solid #edf0f2;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fbfcfd;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .package-name {
            color: var(--primary-dark);
            font-weight: bold;
        }

        .weight-value {
            font-weight: bold;
            color: #425463;
        }

        .price-value {
            color: #b42318;
            font-weight: bold;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .status::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-on {
            background: #e7f7ed;
            color: #157347;
        }

        .status-on::before {
            background: #198754;
        }

        .status-off {
            background: #fbe9eb;
            color: #b02a37;
        }

        .status-off::before {
            background: #dc3545;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .actions form {
            margin: 0;
        }

        .empty {
            padding: 35px 15px;
            text-align: center;
            color: var(--muted);
        }

        .empty strong {
            display: block;
            color: #526371;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .empty span {
            font-size: 11px;
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

        @media (max-width: 768px) {
            .content {
                width: min(100% - 24px, 1180px);
            }

            .page-heading,
            .card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carry-grid {
                grid-template-columns: 1fr;
            }

            .card-body {
                padding: 18px;
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

        <a href="{{ route('admin.trang-chu') }}" class="logo">
            Viet<span>jet</span>
        </a>

        <div class="menu-title">
            QUẢN LÝ HỆ THỐNG
        </div>

        <nav class="menu">

            <a href="{{ route('admin.trang-chu') }}" class="menu-link">
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

            <a href="{{ route('admin.airports.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21h18"/>
                        <path d="M6 21V9l6-4 6 4v12"/>
                        <path d="M9 13h6"/>
                    </svg>
                </span>
                Quản lý sân bay
            </a>

            <a href="{{ route('admin.aircraft.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                    </svg>
                </span>
                Quản lý máy bay
            </a>

            <a href="{{ route('admin.flights.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M8 3v4M16 3v4M3 10h18"/>
                    </svg>
                </span>
                Quản lý chuyến bay
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z"/>
                        <path d="M8 8h8M8 12h8M8 16h5"/>
                    </svg>
                </span>
                Quản lý vé
            </a>

            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                        <path d="M16 11a4 4 0 0 1 5 4"/>
                    </svg>
                </span>
                Quản lý người dùng
            </a>

            <a href="{{ route('admin.baggage.index') }}" class="menu-link active">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="7" width="14" height="13" rx="2"/>
                        <path d="M9 7V5a3 3 0 0 1 6 0v2"/>
                        <path d="M8 11h8"/>
                    </svg>
                </span>
                Quản lý hành lý
            </a>

            <a href="{{ route('admin.statistics.index') }}" class="menu-link">
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

            <a href="{{ route('admin.settings.edit') }}" class="menu-link">
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

            <a href="{{ route('admin.refund-settings.edit') }}" class="menu-link">
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
                <strong>{{ auth()->user()->name }}</strong>
                <span>Quản trị viên hệ thống</span>
            </div>

            <form action="{{ route('dang-xuat') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    Đăng xuất
                </button>
            </form>

        </div>

    </aside>

    <main class="main">

        <header class="topbar">

            <div class="topbar-left">
                <h2>Vietjet Administration</h2>
                <p>Quản lý hành lý và các gói hành lý ký gửi</p>
            </div>

            <span class="admin-badge">
                ADMIN
            </span>

        </header>

        <div class="content">

            <div class="page-heading">

                <div>

                    <h1>Quản lý hành lý</h1>

                    <p>
                        Quản lý hành lý xách tay miễn phí và các gói hành lý ký gửi.
                    </p>

                </div>

                <div class="breadcrumb">
                    <a href="{{ route('admin.trang-chu') }}">
                        Trang quản trị
                    </a>
                    /
                    Hành lý
                </div>

            </div>

            @if(session('success'))

                <div class="message message-success">
                    {{ session('success') }}
                </div>

            @endif

            @if($errors->any())

                <div class="message message-error">

                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach

                </div>

            @endif

            <section class="card">

                <div class="card-header">

                    <div class="card-title-wrap">

                        <h2>Hành lý xách tay</h2>

                        <p>
                            Thiết lập số kg hành lý xách tay miễn phí đi kèm vé.
                        </p>

                    </div>

                    @if($carryOn?->status ?? true)

                        <span class="status status-on">
                            Đang bật
                        </span>

                    @else

                        <span class="status status-off">
                            Đang tắt
                        </span>

                    @endif

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('admin.baggage.carry-on.update') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="carry-grid">

                            <div class="form-group">

                                <label for="carry_on_weight">
                                    Số kg miễn phí
                                </label>

                                <input
                                    type="number"
                                    id="carry_on_weight"
                                    name="weight"
                                    class="form-control"
                                    min="0"
                                    max="100"
                                    value="{{ old('weight', $carryOn?->weight ?? 7) }}"
                                    required
                                >

                            </div>

                            <div class="form-group">

                                <label for="carry_on_status">
                                    Trạng thái
                                </label>

                                <select
                                    id="carry_on_status"
                                    name="status"
                                    class="form-control"
                                    required
                                >

                                    <option
                                        value="1"
                                        @selected((string) old('status', $carryOn?->status ?? 1) === '1')
                                    >
                                        Bật
                                    </option>

                                    <option
                                        value="0"
                                        @selected((string) old('status', $carryOn?->status ?? 1) === '0')
                                    >
                                        Tắt
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="carry-note">
                            Hành lý xách tay được bao gồm miễn phí trong vé.
                            Khách hàng không cần thanh toán thêm cho phần hành lý này.
                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary">
                                Lưu thay đổi
                            </button>

                        </div>

                    </form>

                </div>

            </section>

            <section class="card">

                <div class="card-header">

                    <div class="card-title-wrap">

                        <h2>Hành lý ký gửi</h2>

                        <p>
                            Tạo và quản lý các gói hành lý ký gửi mà khách hàng có thể mua thêm.
                        </p>

                    </div>

                    <a
                        href="{{ route('admin.baggage.checked.create') }}"
                        class="btn btn-yellow"
                    >
                        Thêm gói hành lý
                    </a>

                </div>

                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>
                                <th>Tên gói</th>
                                <th>Khối lượng</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($checkedPackages as $package)

                            <tr>

                                <td>

                                    <span class="package-name">
                                        {{ $package->name }}
                                    </span>

                                </td>

                                <td>

                                    <span class="weight-value">
                                        {{ $package->weight }} kg
                                    </span>

                                </td>

                                <td>

                                    <span class="price-value">
                                        {{ number_format($package->price, 0, ',', '.') }}đ
                                    </span>

                                </td>

                                <td>

                                    @if($package->status)

                                        <span class="status status-on">
                                            Đang bật
                                        </span>

                                    @else

                                        <span class="status status-off">
                                            Đang tắt
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('admin.baggage.checked.edit', $package) }}"
                                            class="btn btn-edit"
                                        >
                                            Sửa
                                        </a>

                                        <form
                                            action="{{ route('admin.baggage.checked.destroy', $package) }}"
                                            method="POST"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa gói hành lý này không?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                            >
                                                Xóa
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5">

                                    <div class="empty">

                                        <strong>
                                            Chưa có gói hành lý ký gửi
                                        </strong>

                                        <span>
                                            Bấm "Thêm gói hành lý" để tạo gói đầu tiên.
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    </main>

</div>

</body>

</html>