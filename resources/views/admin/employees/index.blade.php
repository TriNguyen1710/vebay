<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý nhân viên - Vietjet</title>

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
            margin: 0;
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
            background: var(--primary-dark);
            color: white;
            display: flex;
            flex-direction: column;
            padding: 26px 16px;
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
            color: var(--primary);
            font-size: 19px;
            margin-bottom: 3px;
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
            max-width: 1450px;
            margin: auto;
            padding: 28px 30px 45px;
        }

        .page-heading {
            margin-bottom: 23px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
        }

        .page-heading h1 {
            color: #243746;
            font-size: 24px;
            margin-bottom: 6px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 11px;
        }

        .add-btn {
            min-height: 39px;
            padding: 0 17px;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: var(--primary-dark);
        }

        .alert-success {
            padding: 13px 16px;
            margin-bottom: 18px;
            border: 1px solid #b8dfc7;
            border-radius: 7px;
            background: #eaf7ef;
            color: var(--success);
            font-size: 11px;
            font-weight: 600;
        }

        .search-box {
            padding: 18px;
            margin-bottom: 18px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            height: 39px;
            padding: 0 13px;
            border: 1px solid #ccd8e0;
            border-radius: 6px;
            outline: none;
            color: var(--text);
            background: white;
            font-size: 11px;
        }

        .search-input:focus {
            border-color: var(--primary);
        }

        .search-btn {
            height: 39px;
            padding: 0 18px;
            border: none;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font-size: 11px;
            font-weight: bold;
        }

        .search-btn:hover {
            background: var(--primary-dark);
        }

        .reset-btn {
            height: 39px;
            padding: 0 18px;
            border: 1px solid #ccd8e0;
            border-radius: 6px;
            background: white;
            color: #53626e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
        }

        .reset-btn:hover {
            background: #f5f8fa;
        }

        .table-card {
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
        }

        .table-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            color: var(--primary);
            font-size: 14px;
        }

        .table-header span {
            color: var(--muted);
            font-size: 10px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 13px 15px;
            background: #f7f9fb;
            border-bottom: 1px solid var(--border);
            color: #61717d;
            font-size: 10px;
            font-weight: bold;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #edf0f2;
            color: #425361;
            font-size: 11px;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fafcfd;
        }

        .employee-id {
            color: var(--muted);
            font-weight: bold;
        }

        .employee-name {
            color: var(--primary-dark);
            font-weight: bold;
        }

        .employee-email {
            color: #53626e;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 20px;
            background: #e9f7ef;
            color: var(--success);
            font-size: 9px;
            font-weight: bold;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--success);
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .edit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 31px;
            padding: 0 11px;
            border: 1px solid #b9cedc;
            border-radius: 5px;
            color: var(--primary);
            background: white;
            font-size: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .edit-btn:hover {
            background: var(--primary-light);
        }

        .delete-form {
            margin: 0;
        }

        .delete-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 31px;
            padding: 0 11px;
            border: 1px solid #e3a7ac;
            border-radius: 5px;
            color: var(--danger);
            background: white;
            font-size: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .delete-btn:hover {
            background: #fff0f1;
            border-color: var(--danger);
        }

        .empty {
            padding: 40px 20px;
            color: var(--muted);
            text-align: center;
        }

        .footer {
            margin-top: 28px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            color: #919ca4;
            font-size: 9px;
            display: flex;
            justify-content: space-between;
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

            .main {
                margin-left: 0;
            }

            .menu {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .menu {
                grid-template-columns: 1fr;
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
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                    </svg>
                </span>
                Tổng quan
            </a>

            <a href="{{ route('admin.airports.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21h18" />
                        <path d="M6 21V9l6-4 6 4v12" />
                        <path d="M9 13h6" />
                    </svg>
                </span>
                Quản lý sân bay
            </a>

            <a href="{{ route('admin.aircraft.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z" />
                    </svg>
                </span>
                Quản lý máy bay
            </a>

            <a href="{{ route('admin.flights.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2" />
                        <path d="M8 3v4M16 3v4M3 10h18" />
                    </svg>
                </span>
                Quản lý chuyến bay
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z" />
                        <path d="M8 8h8M8 12h8M8 16h5" />
                    </svg>
                </span>
                Quản lý vé
            </a>

            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4" />
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2" />
                        <path d="M16 11a4 4 0 0 1 5 4" />
                    </svg>
                </span>
                Quản lý người dùng
            </a>

            <a href="{{ route('admin.employees.index') }}" class="menu-link active">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="7" r="4" />
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2" />
                        <path d="M17 8v6" />
                        <path d="M14 11h6" />
                    </svg>
                </span>
                Quản lý nhân viên
            </a>

            <a href="{{ route('admin.baggage.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="7" width="14" height="13" rx="2" />
                        <path d="M9 7V5a3 3 0 0 1 6 0v2" />
                        <path d="M8 11h8" />
                    </svg>
                </span>
                Quản lý hành lý
            </a>

            <a href="{{ route('admin.statistics.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 20V10" />
                        <path d="M10 20V4" />
                        <path d="M16 20v-7" />
                        <path d="M22 20V7" />
                    </svg>
                </span>
                Thống kê chi tiết
            </a>

            <a href="{{ route('admin.settings.edit') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 6h10" />
                        <path d="M18 6h2" />
                        <circle cx="16" cy="6" r="2" />
                        <path d="M4 12h2" />
                        <path d="M10 12h10" />
                        <circle cx="8" cy="12" r="2" />
                        <path d="M4 18h8" />
                        <path d="M16 18h4" />
                        <circle cx="14" cy="18" r="2" />
                    </svg>
                </span>
                Quản lý đổi giá vé
            </a>

            <a href="{{ route('admin.refund-settings.edit') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h16v10H4z" />
                        <path d="M8 11h8" />
                        <path d="M12 8v6" />
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
                <p>Hệ thống quản trị đặt vé máy bay</p>
            </div>

            <span class="admin-badge">
                ADMIN
            </span>

        </header>

        <div class="content">

            <div class="page-heading">

                <div>
                    <h1>Quản lý nhân viên</h1>
                    <p>Quản lý tài khoản và thông tin nhân viên.</p>
                </div>

                <a
                    href="{{ route('admin.employees.create') }}"
                    class="add-btn"
                >
                    + Thêm nhân viên
                </a>

            </div>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="search-box">

                <form
                    action="{{ route('admin.employees.index') }}"
                    method="GET"
                    class="search-form"
                >

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="search-input"
                        placeholder="Tìm theo tên, Gmail hoặc số điện thoại..."
                    >

                    <button
                        type="submit"
                        class="search-btn"
                    >
                        Tìm kiếm
                    </button>

                    @if(request('search'))
                        <a
                            href="{{ route('admin.employees.index') }}"
                            class="reset-btn"
                        >
                            Xóa tìm kiếm
                        </a>
                    @endif

                </form>

            </div>

            <div class="table-card">

                <div class="table-header">

                    <h3>Danh sách nhân viên</h3>

                    <span>
                        Tổng: {{ $employees->count() }} nhân viên
                    </span>

                </div>

                <div class="table-responsive">

                    <table>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>HỌ TÊN</th>
                                <th>GMAIL / TÀI KHOẢN</th>
                                <th>SỐ ĐIỆN THOẠI</th>
                                <th>TRẠNG THÁI</th>
                                <th>THAO TÁC</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($employees as $employee)

                                <tr>

                                    <td class="employee-id">
                                        #{{ $employee->id }}
                                    </td>

                                    <td class="employee-name">
                                        {{ $employee->name }}
                                    </td>

                                    <td class="employee-email">
                                        {{ $employee->email }}
                                    </td>

                                    <td>
                                        {{ $employee->phone ?: 'Chưa có' }}
                                    </td>

                                    <td>
                                        <span class="status">
                                            <span class="status-dot"></span>
                                            Hoạt động
                                        </span>
                                    </td>

                                    <td>

                                        <div class="action-buttons">

                                            <a
                                                href="{{ route('admin.employees.edit', $employee->id) }}"
                                                class="edit-btn"
                                            >
                                                Sửa
                                            </a>

                                            <form
                                                action="{{ route('admin.employees.destroy', $employee->id) }}"
                                                method="POST"
                                                class="delete-form"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhân viên {{ $employee->name }} không?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="delete-btn"
                                                >
                                                    Xóa
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="empty">
                                        Chưa có nhân viên nào.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <footer class="footer">
                <span>Vietjet Administration</span>
                <span>Hệ thống đặt vé máy bay</span>
            </footer>

        </div>

    </main>

</div>

</body>

</html>