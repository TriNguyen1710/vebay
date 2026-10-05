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
                Tổng quan
            </a>

            <a
                href="{{ route('admin.airports.index') }}"
                class="menu-link"
            >
                Quản lý sân bay
            </a>

            <a
                href="{{ route('admin.aircraft.index') }}"
                class="menu-link"
            >
                Quản lý máy bay
            </a>

            <a
                href="{{ route('admin.flights.index') }}"
                class="menu-link"
            >
                Quản lý chuyến bay
            </a>

            <a
                href="{{ route('admin.bookings.index') }}"
                class="menu-link"
            >
                Quản lý vé
            </a>

            <a
                href="{{ route('admin.users.index') }}"
                class="menu-link"
            >
                Quản lý người dùng
            </a>

            <a
                href="{{ route('admin.statistics.index') }}"
                class="menu-link"
            >
                Thống kê chi tiết
            </a>

            <a
                href="{{ route('admin.settings.edit') }}"
                class="menu-link"
            >
                Quản lý đổi giá vé
            </a>

            <a
                href="{{ route('admin.refund-settings.edit') }}"
                class="menu-link active"
            >
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
