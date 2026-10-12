<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sửa nhân viên - Vietjet</title>

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
            overflow-y: auto;
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
            stroke-linecap: round;
            stroke-linejoin: round;
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
            max-width: 1000px;
            margin: auto;
            padding: 28px 30px 45px;
        }

        .page-heading {
            margin-bottom: 23px;
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

        .form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
            overflow: hidden;
        }

        .form-header {
            padding: 19px 21px;
            border-bottom: 1px solid #e8edf1;
        }

        .form-header h3 {
            color: var(--primary);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .form-header p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.5;
        }

        .employee-summary {
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 7px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .employee-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .employee-summary strong {
            display: block;
            color: var(--primary);
            font-size: 11px;
            margin-bottom: 3px;
        }

        .employee-summary span {
            color: var(--muted);
            font-size: 10px;
        }

        .form-body {
            padding: 25px 21px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #425361;
            font-size: 11px;
            font-weight: bold;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            height: 42px;
            padding: 0 13px;
            border: 1px solid #ccd8e0;
            border-radius: 6px;
            background: white;
            color: var(--text);
            font-size: 12px;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.06);
        }

        .form-control.error {
            border-color: var(--danger);
        }

        .error-message {
            display: block;
            margin-top: 6px;
            color: var(--danger);
            font-size: 10px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 70px;
        }

        .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--primary);
            cursor: pointer;
            font-size: 10px;
            font-weight: bold;
        }

        .password-section {
            margin-top: 5px;
            padding-top: 20px;
            border-top: 1px solid #e6ebef;
        }

        .password-title {
            margin-bottom: 16px;
        }

        .password-title h4 {
            color: var(--primary);
            font-size: 12px;
            margin-bottom: 5px;
        }

        .password-title p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .info-box {
            padding: 14px 15px;
            border: 1px solid #d7e6f0;
            border-radius: 7px;
            background: var(--primary-light);
            color: #63717c;
            font-size: 10px;
            line-height: 1.7;
        }

        .info-box strong {
            color: var(--primary);
        }

        .form-footer {
            padding: 17px 21px;
            border-top: 1px solid #e8edf1;
            background: #fafbfc;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .cancel-btn {
            min-height: 38px;
            padding: 0 17px;
            border: 1px solid #ccd8e0;
            border-radius: 6px;
            background: white;
            color: #53626e;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
        }

        .cancel-btn:hover {
            background: #f2f5f7;
        }

        .submit-btn {
            min-height: 38px;
            padding: 0 18px;
            border: none;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font-size: 11px;
            font-weight: bold;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
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

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-footer {
                flex-direction: column-reverse;
            }

            .cancel-btn,
            .submit-btn {
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
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                    </svg>
                </span>
                Tổng quan
            </a>

            <a href="{{ route('admin.airports.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21h18"></path>
                        <path d="M6 21V9l6-4 6 4v12"></path>
                        <path d="M9 13h6"></path>
                    </svg>
                </span>
                Quản lý sân bay
            </a>

            <a href="{{ route('admin.aircraft.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"></path>
                    </svg>
                </span>
                Quản lý máy bay
            </a>

            <a href="{{ route('admin.flights.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M8 3v4M16 3v4M3 10h18"></path>
                    </svg>
                </span>
                Quản lý chuyến bay
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z"></path>
                        <path d="M8 8h8M8 12h8M8 16h5"></path>
                    </svg>
                </span>
                Quản lý vé
            </a>

            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"></circle>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"></path>
                        <path d="M16 11a4 4 0 0 1 5 4"></path>
                    </svg>
                </span>
                Quản lý người dùng
            </a>

            <a href="{{ route('admin.employees.index') }}" class="menu-link active">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"></path>
                        <path d="M17 8v6"></path>
                        <path d="M14 11h6"></path>
                    </svg>
                </span>
                Quản lý nhân viên
            </a>

            <a href="{{ route('admin.baggage.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="7" width="14" height="13" rx="2"></rect>
                        <path d="M9 7V5a3 3 0 0 1 6 0v2"></path>
                        <path d="M8 11h8"></path>
                    </svg>
                </span>
                Quản lý hành lý
            </a>

            <a href="{{ route('admin.statistics.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 20V10"></path>
                        <path d="M10 20V4"></path>
                        <path d="M16 20v-7"></path>
                        <path d="M22 20V7"></path>
                    </svg>
                </span>
                Thống kê chi tiết
            </a>

            <a href="{{ route('admin.settings.edit') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 6h10"></path>
                        <path d="M18 6h2"></path>
                        <circle cx="16" cy="6" r="2"></circle>
                        <path d="M4 12h2"></path>
                        <path d="M10 12h10"></path>
                        <circle cx="8" cy="12" r="2"></circle>
                        <path d="M4 18h8"></path>
                        <path d="M16 18h4"></path>
                        <circle cx="14" cy="18" r="2"></circle>
                    </svg>
                </span>
                Quản lý đổi giá vé
            </a>

            <a href="{{ route('admin.refund-settings.edit') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h16v10H4z"></path>
                        <path d="M8 11h8"></path>
                        <path d="M12 8v6"></path>
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
                <h1>Sửa nhân viên</h1>
                <p>Cập nhật thông tin và tài khoản đăng nhập của nhân viên.</p>
            </div>

            <form
                action="{{ route('admin.employees.update', $user->id) }}"
                method="POST"
                class="form-card"
            >
                @csrf
                @method('PUT')

                <div class="form-header">

                    <h3>Thông tin nhân viên</h3>

                    <p>
                        Cập nhật thông tin nhân viên trong hệ thống.
                    </p>

                    <div class="employee-summary">

                        <div class="employee-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div>
                            <strong>{{ $user->name }}</strong>
                            <span>{{ $user->email }}</span>
                        </div>

                    </div>

                </div>

                <div class="form-body">

                    <div class="form-group">

                        <label for="name">
                            Họ và tên
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="form-control @error('name') error @enderror"
                            placeholder="Nhập họ và tên"
                        >

                        @error('name')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-row">

                        <div class="form-group">

                            <label for="email">
                                Gmail / Email đăng nhập
                                <span class="required">*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="form-control @error('email') error @enderror"
                                placeholder="Nhập email"
                            >

                            @error('email')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label for="phone">
                                Số điện thoại
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone', $user->phone) }}"
                                class="form-control @error('phone') error @enderror"
                                placeholder="Nhập số điện thoại"
                            >

                            @error('phone')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>

                    <div class="password-section">

                        <div class="password-title">

                            <h4>Đổi mật khẩu</h4>

                            <p>
                                Nếu không muốn thay đổi mật khẩu của nhân viên,
                                hãy để trống hai ô bên dưới.
                            </p>

                        </div>

                        <div class="form-row">

                            <div class="form-group">

                                <label for="password">
                                    Mật khẩu mới
                                </label>

                                <div class="password-wrapper">

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control @error('password') error @enderror"
                                        placeholder="Để trống nếu không đổi"
                                        autocomplete="new-password"
                                    >

                                    <button
                                        type="button"
                                        class="show-password"
                                        onclick="togglePassword('password', this)"
                                    >
                                        Hiện
                                    </button>

                                </div>

                                @error('password')
                                    <span class="error-message">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">

                                <label for="password_confirmation">
                                    Xác nhận mật khẩu mới
                                </label>

                                <div class="password-wrapper">

                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Nhập lại mật khẩu mới"
                                        autocomplete="new-password"
                                    >

                                    <button
                                        type="button"
                                        class="show-password"
                                        onclick="togglePassword('password_confirmation', this)"
                                    >
                                        Hiện
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="info-box">
                        <strong>Lưu ý:</strong>
                        Email là tài khoản nhân viên sử dụng để đăng nhập.
                        Nếu đổi mật khẩu, mật khẩu mới sẽ được mã hóa trước khi
                        lưu vào hệ thống.
                    </div>

                </div>

                <div class="form-footer">

                    <a
                        href="{{ route('admin.employees.index') }}"
                        class="cancel-btn"
                    >
                        Hủy
                    </a>

                    <button
                        type="submit"
                        class="submit-btn"
                    >
                        Lưu thay đổi
                    </button>

                </div>

            </form>

            <footer class="footer">
                <span>Vietjet Administration</span>
                <span>Hệ thống đặt vé máy bay</span>
            </footer>

        </div>

    </main>

</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);

        if (input.type === 'password') {
            input.type = 'text';
            button.textContent = 'Ẩn';
        } else {
            input.type = 'password';
            button.textContent = 'Hiện';
        }
    }
</script>

</body>

</html>