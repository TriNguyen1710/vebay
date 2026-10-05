<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Quản lý người dùng - Vietjet Admin</title>

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
            --warning: #b88700;
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

        .content {
            max-width: 1350px;
            margin: auto;
            padding: 28px 30px 45px;
        }

        .page-heading {
            margin-bottom: 22px;
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

        .page-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .btn {
            min-height: 38px;
            padding: 0 15px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .btn-back {
            border: 1px solid var(--border);
            background: white;
            color: var(--primary);
        }

        .btn-back:hover {
            background: #f6f8fa;
        }

        .btn-add {
            border: none;
            background: var(--secondary);
            color: var(--primary-dark);
        }

        .btn-add:hover {
            background: #ffc31a;
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 11px;
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

        .summary-grid {
            margin-bottom: 18px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .summary-card {
            min-height: 90px;
            padding: 15px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
        }

        .summary-label {
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .summary-number {
            color: var(--primary);
            font-size: 23px;
            font-weight: 800;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
            overflow: hidden;
        }

        .panel-header {
            min-height: 68px;
            padding: 17px 20px;
            border-bottom: 1px solid #e8edf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .panel-header h3 {
            margin-bottom: 4px;
            color: var(--primary);
            font-size: 14px;
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
            font-size: 10px;
            font-weight: bold;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 13px 14px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            color: #52616d;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #edf0f2;
            color: #435461;
            font-size: 10px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fbfcfd;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .user-name {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 700;
        }

        .user-email {
            color: #657580;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-you {
            background: var(--primary-light);
            color: var(--primary);
        }

        .role-admin {
            background: #fff0f1;
            color: #b02a37;
        }

        .role-employee {
            background: var(--primary-light);
            color: var(--primary);
        }

        .role-customer {
            background: #edf8f2;
            color: #17643d;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: nowrap;
        }

        .actions form {
            margin: 0;
        }

        .action-btn {
            height: 32px;
            min-width: 58px;
            padding: 0 11px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
            line-height: 1;
        }

        .btn-edit {
            border: 1px solid #d3b64d;
            background: #fff7d6;
            color: #765800;
        }

        .btn-edit:hover {
            background: #ffed9e;
            border-color: #c6a62f;
        }

        .btn-delete {
            border: 1px solid #e7b8bd;
            background: #fff0f1;
            color: #b02a37;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fddfe2;
        }

        .btn-disabled {
            min-width: 92px;
            border: 1px solid #d9dfe3;
            background: #f1f3f5;
            color: #90999f;
            cursor: not-allowed;
        }

        .empty {
            padding: 45px 20px;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
        }

        .bottom-back {
            margin-top: 20px;
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
            margin-top: 28px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            color: #919ca4;
            font-size: 9px;
        }

        @media (max-width: 1000px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
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

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-actions {
                width: 100%;
            }

            .page-actions .btn {
                flex: 1;
            }

            .summary-grid {
                grid-template-columns: 1fr;
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

        <a
            href="{{ route('admin.trang-chu') }}"
            class="logo"
        >
            Viet<span>jet</span>
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
                class="menu-link"
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
                class="menu-link active"
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

            <a
                href="{{ route('admin.settings.edit') }}"
                class="menu-link"
            >
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

    <main class="main">

        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    Vietjet Administration
                </h2>

                <p>
                    Quản lý tài khoản và phân quyền người dùng
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
                        Quản lý người dùng
                    </h1>

                    <p>
                        Theo dõi tài khoản khách hàng,
                        nhân viên sân bay và quản trị viên.
                    </p>

                </div>

                <div class="page-actions">

                    <a
                        href="{{ route('admin.trang-chu') }}"
                        class="btn btn-back"
                    >
                        ← Quay lại
                    </a>

                    <a
                        href="{{ route('admin.users.create') }}"
                        class="btn btn-add"
                    >
                        + Thêm tài khoản
                    </a>

                </div>

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

            @php
                $adminCount = $users
                    ->where('role', 'admin')
                    ->count();

                $employeeCount = $users
                    ->where('role', 'nhanvien')
                    ->count();

                $customerCount = $users
                    ->where('role', 'user')
                    ->count();
            @endphp

            <div class="summary-grid">

                <div class="summary-card">

                    <div class="summary-label">
                        Tổng tài khoản
                    </div>

                    <div class="summary-number">
                        {{ $users->count() }}
                    </div>

                </div>

                <div class="summary-card">

                    <div class="summary-label">
                        Quản trị viên
                    </div>

                    <div class="summary-number">
                        {{ $adminCount }}
                    </div>

                </div>

                <div class="summary-card">

                    <div class="summary-label">
                        Nhân viên sân bay
                    </div>

                    <div class="summary-number">
                        {{ $employeeCount }}
                    </div>

                </div>

                <div class="summary-card">

                    <div class="summary-label">
                        Khách hàng
                    </div>

                    <div class="summary-number">
                        {{ $customerCount }}
                    </div>

                </div>

            </div>

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h3>
                            Danh sách tài khoản
                        </h3>

                        <p>
                            Quản lý thông tin tài khoản
                            và loại quyền truy cập hệ thống.
                        </p>

                    </div>

                    <span class="count-box">
                        {{ $users->count() }} tài khoản
                    </span>

                </div>

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Loại tài khoản</th>
                                <th>Thao tác</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($users as $user)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    <div class="user-name">

                                        {{ $user->name }}

                                        @if(auth()->id() === $user->id)

                                            <span class="badge badge-you">
                                                Bạn
                                            </span>

                                        @endif

                                    </div>

                                </td>

                                <td>

                                    <span class="user-email">
                                        {{ $user->email }}
                                    </span>

                                </td>

                                <td>

                                    @if($user->role === 'admin')

                                        <span class="badge role-admin">
                                            Quản trị viên
                                        </span>

                                    @elseif($user->role === 'nhanvien')

                                        <span class="badge role-employee">
                                            Nhân viên sân bay
                                        </span>

                                    @else

                                        <span class="badge role-customer">
                                            Khách hàng
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route(
                                                'admin.users.edit',
                                                $user->id
                                            ) }}"
                                            class="action-btn btn-edit"
                                        >
                                            Sửa
                                        </a>

                                        @if(auth()->id() !== $user->id)

                                            <form
                                                action="{{ route(
                                                    'admin.users.destroy',
                                                    $user->id
                                                ) }}"
                                                method="POST"
                                                onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-btn btn-delete"
                                                >
                                                    Xóa
                                                </button>

                                            </form>

                                        @else

                                            <button
                                                type="button"
                                                class="action-btn btn-disabled"
                                                disabled
                                            >
                                                Không thể xóa
                                            </button>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="empty"
                                >
                                    Chưa có tài khoản nào.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            <div class="bottom-back">

                <a href="{{ route('admin.trang-chu') }}">
                    ← Quay lại trang quản trị
                </a>

            </div>

            <footer class="footer">

                <span>
                    Vietjet Administration
                </span>

                <span>
                    Quản lý người dùng
                </span>

            </footer>

        </div>

    </main>

</div>

</body>

</html>