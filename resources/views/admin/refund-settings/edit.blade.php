<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Quản lý hoàn vé - Vietjet Admin</title>

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

        .menu-link.active {
            color: var(--secondary);
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
            max-width: 920px;
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

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: 0 4px 16px rgba(20, 45, 65, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--border);
        }

        .card-header h2 {
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 16px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .card-body {
            padding: 22px;
        }

        .current-box {
            margin-bottom: 20px;
            padding: 15px 16px;
            border-left: 4px solid var(--secondary);
            background: #f8fafc;
        }

        .current-box span {
            display: block;
            margin-bottom: 5px;
            color: var(--muted);
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .current-box strong {
            color: var(--primary);
            font-size: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #42515e;
            font-size: 11px;
            font-weight: bold;
        }

        .input-wrap {
            max-width: 360px;
            display: flex;
        }

        .input-wrap input {
            flex: 1;
            min-width: 0;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #d5dee5;
            border-right: none;
            border-radius: 6px 0 0 6px;
            color: #394b58;
            font-size: 12px;
        }

        .input-wrap span {
            width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d5dee5;
            border-radius: 0 6px 6px 0;
            background: #f4f7f9;
            color: var(--primary);
            font-size: 12px;
            font-weight: bold;
        }

        .hint {
            margin-top: 7px;
            color: var(--muted);
            font-size: 9px;
        }

        .error {
            margin-top: 6px;
            color: var(--danger);
            font-size: 9px;
        }

        .actions {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #edf0f2;
            display: flex;
            gap: 10px;
        }

        .btn-save,
        .btn-cancel {
            min-height: 40px;
            padding: 0 16px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .btn-save {
            border: none;
            background: var(--secondary);
            color: var(--primary-dark);
            cursor: pointer;
        }

        .btn-cancel {
            border: 1px solid var(--border);
            background: white;
            color: var(--primary);
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 10px;
            line-height: 1.6;
        }

        .alert-success {
            background: #edf8f2;
            border: 1px solid #badfc9;
            color: #17643d;
        }

        .note {
            margin-top: 18px;
            color: var(--muted);
            font-size: 9px;
            line-height: 1.7;
        }

        @media (max-width: 900px) {
            .admin-layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
            }

            .main {
                grid-column: auto;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .page-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .input-wrap {
                max-width: none;
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
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
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
                href="{{ route('admin.baggage.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="7" width="14" height="13" rx="2"/>
                        <path d="M9 7V5a3 3 0 0 1 6 0v2"/>
                        <path d="M8 11h8"/>
                    </svg>
                </span>
                Quản lý hành lý
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

            <a
                href="{{ route('admin.refund-settings.edit') }}"
                class="menu-link active"
            >
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
                    Quản lý chính sách hoàn vé
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
                        Quản lý hoàn vé
                    </h1>

                    <p>
                        Thiết lập tỷ lệ phần trăm hoàn tiền
                        khi khách hàng hủy vé.
                    </p>
                </div>

                <a
                    href="{{ route('admin.trang-chu') }}"
                    class="back-btn"
                >
                    ← Quay lại
                </a>

            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <section class="card">

                <div class="card-header">

                    <h2>
                        Tỷ lệ hoàn tiền
                    </h2>

                    <p>
                        Tỷ lệ này chỉ áp dụng cho các yêu cầu
                        hủy vé mới sau khi cài đặt được lưu.
                    </p>

                </div>

                <div class="card-body">

                    <div class="current-box">

                        <span>
                            Tỷ lệ hoàn hiện tại
                        </span>

                        <strong>
                            {{ rtrim(
                                rtrim(
                                    number_format(
                                        (float) $refundPercentage,
                                        2,
                                        '.',
                                        ''
                                    ),
                                    '0'
                                ),
                                '.'
                            ) }}%
                        </strong>

                    </div>

                    <form
                        action="{{ route(
                            'admin.refund-settings.update'
                        ) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="form-group">

                            <label for="refund_percentage">
                                Nhập tỷ lệ hoàn tiền mới
                            </label>

                            <div class="input-wrap">

                                <input
                                    id="refund_percentage"
                                    type="number"
                                    name="refund_percentage"
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    value="{{ old(
                                        'refund_percentage',
                                        $refundPercentage
                                    ) }}"
                                    required
                                >

                                <span>
                                    %
                                </span>

                            </div>

                            <div class="hint">
                                Chỉ được nhập từ 0% đến 100%.
                            </div>

                            @error('refund_percentage')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="actions">

                            <button
                                type="submit"
                                class="btn-save"
                            >
                                Lưu thay đổi
                            </button>

                            <a
                                href="{{ route(
                                    'admin.trang-chu'
                                ) }}"
                                class="btn-cancel"
                            >
                                Hủy
                            </a>

                        </div>

                    </form>

                    <div class="note">
                        Ví dụ: giá vé 1.500.000đ và tỷ lệ hoàn là 60%
                        thì khách được hoàn 900.000đ.
                        Số tiền hoàn của vé đã hủy trước đó
                        không bị thay đổi khi Admin chỉnh tỷ lệ mới.
                    </div>

                </div>

            </section>

        </div>

    </main>

</div>

</body>
</html>