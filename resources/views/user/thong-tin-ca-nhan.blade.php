<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Thông tin cá nhân </title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #003b70;
            --primary-dark: #00294f;
            --secondary: #f4b400;
            --success: #198754;
            --danger: #dc3545;
            --white: #ffffff;
            --light: #f4f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dfe6ed;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
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

        /* =====================================================
           TOP BAR
        ===================================================== */

        .top-bar {
            background: var(--primary-dark);
            color: white;
            font-size: 13px;
        }

        .top-bar-inner {
            max-width: 1240px;
            min-height: 36px;
            margin: auto;
            padding: 0 20px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a {
            color: white;
            opacity: 0.9;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            background: white;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .navbar {
            max-width: 1240px;
            min-height: 76px;
            margin: auto;
            padding: 0 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 30px;
        }

        .logo {
            color: var(--primary);

            font-size: 27px;
            font-weight: 800;

            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .nav-menu {
            display: flex;
            align-items: center;
        }

        .nav-link {
            padding: 27px 15px;

            color: #293241;

            font-size: 15px;
            font-weight: 600;

            border-bottom: 3px solid transparent;

            transition: 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
            border-bottom-color: var(--secondary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-name {
            color: var(--primary);

            font-size: 14px;
            font-weight: bold;
        }

        .logout-btn {
            border: none;

            background: var(--danger);
            color: white;

            padding: 9px 14px;
            border-radius: 6px;

            cursor: pointer;
            font-weight: bold;
        }

        /* =====================================================
           BANNER
        ===================================================== */

        .page-banner {
            min-height: 230px;

            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, 0.95),
                    rgba(0, 59, 112, 0.52)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=85');

            background-size: cover;
            background-position: center;

            color: white;
        }

        .banner-inner {
            max-width: 1240px;
            margin: auto;

            padding: 47px 20px 82px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 17px;

            font-size: 13px;
        }

        .breadcrumb a {
            color: #ffd356;
        }

        .breadcrumb span {
            color: #e5ebf0;
        }

        .page-banner h1 {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .page-banner p {
            max-width: 650px;

            color: #e3ebf3;

            font-size: 15px;
            line-height: 1.6;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            max-width: 980px;

            margin: -48px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        /* =====================================================
           LAYOUT
        ===================================================== */

        .profile-layout {
            display: grid;
            grid-template-columns: 280px 1fr;

            gap: 22px;

            align-items: start;
        }

        .card {
            background: white;

            border-radius: 14px;

            box-shadow:
                0 7px 28px rgba(0, 0, 0, 0.08);

            overflow: hidden;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .profile-sidebar {
            padding: 26px 22px;
        }

        .avatar {
            width: 86px;
            height: 86px;

            margin: 0 auto 15px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--primary);
            color: white;

            font-size: 28px;
            font-weight: 800;
        }

        .profile-name {
            text-align: center;

            color: var(--primary);

            font-size: 17px;
            font-weight: 800;

            margin-bottom: 5px;
        }

        .profile-email {
            text-align: center;

            color: var(--muted);

            font-size: 11px;

            word-break: break-word;
        }

        .sidebar-divider {
            height: 1px;

            background: #e8edf1;

            margin: 22px 0;
        }

        .sidebar-item {
            display: block;

            padding: 11px 12px;

            border-radius: 6px;

            color: #3f5060;

            font-size: 12px;
            font-weight: bold;

            margin-bottom: 5px;
        }

        .sidebar-item.active {
            background: #edf5fb;
            color: var(--primary);
        }

        .sidebar-item:hover {
            background: #f4f7f9;
        }

        /* =====================================================
           FORM CARD
        ===================================================== */

        .form-header {
            padding: 24px 26px 19px;

            border-bottom: 1px solid #e8edf1;
        }

        .form-header h2 {
            color: var(--primary);

            font-size: 21px;

            margin-bottom: 5px;
        }

        .form-header p {
            color: var(--muted);

            font-size: 12px;
            line-height: 1.5;
        }

        .form-body {
            padding: 25px 26px 28px;
        }

        /* =====================================================
           ALERTS
        ===================================================== */

        .success {
            padding: 13px 15px;

            margin-bottom: 18px;

            background: #edf8f2;

            border: 1px solid #badfc9;
            border-left: 4px solid var(--success);

            border-radius: 7px;

            color: #17643d;

            font-size: 12px;
        }

        .error-box {
            padding: 13px 15px;

            margin-bottom: 18px;

            background: #fdebed;

            border: 1px solid #efbec4;
            border-left: 4px solid var(--danger);

            border-radius: 7px;

            color: #842029;

            font-size: 12px;
        }

        /* =====================================================
           SECTION
        ===================================================== */

        .section-title {
            color: #344657;

            font-size: 14px;
            font-weight: 800;

            margin-bottom: 16px;
        }

        .section-note {
            color: var(--muted);

            font-size: 11px;
            line-height: 1.6;

            margin-top: -8px;
            margin-bottom: 18px;
        }

        .divider {
            border: none;
            border-top: 1px solid #e4e9ee;

            margin: 28px 0;
        }

        /* =====================================================
           FORM
        ===================================================== */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;

            color: #425261;

            font-size: 11px;
            font-weight: bold;

            margin-bottom: 7px;
        }

        .required {
            color: var(--danger);
        }

        input {
            width: 100%;

            padding: 11px 12px;

            border: 1px solid #cfd8df;
            border-radius: 6px;

            background: white;
            color: #243746;

            font-size: 13px;

            transition: 0.2s;
        }

        input:focus {
            outline: none;

            border-color: var(--primary);

            box-shadow:
                0 0 0 3px rgba(0, 59, 112, 0.08);
        }

        .error-text {
            color: var(--danger);

            font-size: 10px;

            margin-top: 6px;
        }

        /* =====================================================
           PASSWORD AREA
        ===================================================== */

        .password-area {
            padding: 18px;

            background: #f8fafc;

            border: 1px solid #e2e8ed;
            border-radius: 8px;
        }

        /* =====================================================
           BUTTON
        ===================================================== */

        .form-actions {
            display: flex;
            justify-content: flex-end;

            margin-top: 24px;
        }

        .save-button {
            border: none;

            padding: 12px 21px;

            background: var(--primary);
            color: white;

            border-radius: 6px;

            cursor: pointer;

            font-size: 13px;
            font-weight: bold;

            transition: 0.2s;
        }

        .save-button:hover {
            background: var(--primary-dark);
        }

        /* =====================================================
           BACK
        ===================================================== */

        .bottom-actions {
            margin-top: 20px;
        }

        .back-button {
            color: var(--primary);

            font-size: 14px;
            font-weight: bold;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            background: #031d33;
            color: white;

            padding: 35px 20px;

            text-align: center;
        }

        .footer-logo {
            font-size: 23px;
            font-weight: 800;

            margin-bottom: 7px;
        }

        .footer-logo span {
            color: var(--secondary);
        }

        footer p {
            color: #aebdca;
            font-size: 13px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 850px) {

            .nav-menu {
                display: none;
            }

            .profile-layout {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                text-align: center;
            }

        }

        @media (max-width: 650px) {

            .top-bar {
                display: none;
            }

            .navbar {
                min-height: 65px;
            }

            .user-name {
                display: none;
            }

            .page-banner h1 {
                font-size: 29px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-actions {
                display: block;
            }

            .save-button {
                width: 100%;
            }

        }

    </style>

</head>


<body>

{{-- ========================================================= --}}
{{-- TOP BAR --}}
{{-- ========================================================= --}}

<div class="top-bar">

    <div class="top-bar-inner">

        <div class="top-group">

            <span>
                Website đặt vé máy bay trực tuyến
            </span>

            <span>
                Hỗ trợ: 1900 6868
            </span>

        </div>


        <div class="top-group">

            @auth

                <a href="{{ route('profile.edit') }}">
                    Thông tin cá nhân
                </a>

                <a href="{{ route('notifications.index') }}">
                    Thông báo
                </a>

            @endauth

            <span>
                Tiếng Việt
            </span>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

<header class="header">

    <nav class="navbar">

        <a
            href="{{ route('trang-chu') }}"
            class="logo"
        >
            Viet<span>Jet</span>
        </a>


        <div class="nav-menu">

            <a
                href="{{ route('trang-chu') }}"
                class="nav-link"
            >
                Trang chủ
            </a>

            <a
                href="{{ route('flights.search.form') }}"
                class="nav-link"
            >
                Đặt vé
            </a>

            <a
                href="{{ route('tickets.mine') }}"
                class="nav-link"
            >
                Vé của tôi
            </a>

            <a
                href="{{ route('notifications.index') }}"
                class="nav-link"
            >
                Thông báo
            </a>

            <a
                href="{{ route('profile.edit') }}"
                class="nav-link active"
            >
                Tài khoản
            </a>

        </div>


        <div class="nav-actions">

            @auth

                <span class="user-name">
                    {{ auth()->user()->name }}
                </span>


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

            @endauth

        </div>

    </nav>

</header>


{{-- ========================================================= --}}
{{-- BANNER --}}
{{-- ========================================================= --}}

<section class="page-banner">

    <div class="banner-inner">

        <div class="breadcrumb">

            <a href="{{ route('trang-chu') }}">
                Trang chủ
            </a>

            <span>/</span>

            <span>
                Thông tin cá nhân
            </span>

        </div>


        <h1>
            Thông tin cá nhân
        </h1>


        <p>
            Quản lý thông tin tài khoản và cập nhật
            mật khẩu đăng nhập của bạn.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    <div class="profile-layout">

        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <aside class="card profile-sidebar">

            <div class="avatar">

                {{ strtoupper(
                    mb_substr(
                        $user->name,
                        0,
                        1,
                        'UTF-8'
                    )
                ) }}

            </div>


            <div class="profile-name">
                {{ $user->name }}
            </div>


            <div class="profile-email">
                {{ $user->email }}
            </div>


            <div class="sidebar-divider"></div>


            <a
                href="{{ route('profile.edit') }}"
                class="sidebar-item active"
            >
                Thông tin cá nhân
            </a>


            <a
                href="{{ route('tickets.mine') }}"
                class="sidebar-item"
            >
                Vé của tôi
            </a>


            <a
                href="{{ route('notifications.index') }}"
                class="sidebar-item"
            >
                Thông báo
            </a>

        </aside>


        {{-- ===================================================== --}}
        {{-- FORM --}}
        {{-- ===================================================== --}}

        <section class="card">

            <div class="form-header">

                <h2>
                    Cập nhật tài khoản
                </h2>

                <p>
                    Chỉnh sửa họ tên, email hoặc thay đổi mật khẩu
                    đăng nhập của bạn.
                </p>

            </div>


            <div class="form-body">

                {{-- ================================================= --}}
                {{-- SUCCESS --}}
                {{-- ================================================= --}}

                @if(session('success'))

                    <div class="success">
                        {{ session('success') }}
                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- ERROR --}}
                {{-- ================================================= --}}

                @if($errors->any())

                    <div class="error-box">

                        <strong>
                            Vui lòng kiểm tra lại thông tin đã nhập.
                        </strong>

                    </div>

                @endif


                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    {{-- ================================================= --}}
                    {{-- BASIC INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="section-title">
                        Thông tin tài khoản
                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label for="name">
                                Họ và tên
                                <span class="required">*</span>
                            </label>


                            <input
                                type="text"
                                id="name"
                                name="name"

                                value="{{ old(
                                    'name',
                                    $user->name
                                ) }}"

                                required
                            >


                            @error('name')

                                <div class="error-text">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="email">
                                Email
                                <span class="required">*</span>
                            </label>


                            <input
                                type="email"
                                id="email"
                                name="email"

                                value="{{ old(
                                    'email',
                                    $user->email
                                ) }}"

                                required
                            >


                            @error('email')

                                <div class="error-text">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="date_of_birth">
                                Ngày sinh
                                <span class="required">*</span>
                            </label>


                            <input
                                type="date"
                                id="date_of_birth"
                                name="date_of_birth"

                                value="{{ old(
    'date_of_birth',
    $user->date_of_birth?->format('Y-m-d')
) }}"

                                required
                            >


                            @error('date_of_birth')

                                <div class="error-text">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="gender">
                                Giới tính
                                <span class="required">*</span>
                            </label>


                            <select
                                id="gender"
                                name="gender"
                                required
                            >
                                <option value="">-- Chọn giới tính --</option>
                                <option value="nam" {{ old('gender', $user->gender) === 'nam' ? 'selected' : '' }}>Nam</option>
                                <option value="nu" {{ old('gender', $user->gender) === 'nu' ? 'selected' : '' }}>Nữ</option>
                                <option value="khac" {{ old('gender', $user->gender) === 'khac' ? 'selected' : '' }}>Khác</option>
                            </select>


                            @error('gender')

                                <div class="error-text">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="form-group full">

                            <label for="phone">
                                Số điện thoại
                                <span class="required">*</span>
                            </label>


                            <input
                                type="text"
                                id="phone"
                                name="phone"

                                value="{{ old(
                                    'phone',
                                    $user->phone
                                ) }}"

                                required
                            >


                            @error('phone')

                                <div class="error-text">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <hr class="divider">


                    {{-- ================================================= --}}
                    {{-- PASSWORD --}}
                    {{-- ================================================= --}}

                    <div class="section-title">
                        Đổi mật khẩu
                    </div>


                    <p class="section-note">
                        Nếu bạn không muốn thay đổi mật khẩu,
                        hãy để trống toàn bộ các ô bên dưới.
                    </p>


                    <div class="password-area">

                        <div class="form-group">

                            <label for="current_password">
                                Mật khẩu hiện tại
                            </label>


                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                autocomplete="current-password"
                            >


                            @error('current_password')

                                <div class="error-text">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="form-grid">

                            <div class="form-group">

                                <label for="password">
                                    Mật khẩu mới
                                </label>


                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    autocomplete="new-password"
                                >


                                @error('password')

                                    <div class="error-text">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="password_confirmation">
                                    Xác nhận mật khẩu mới
                                </label>


                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                >

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ACTION --}}
                    {{-- ================================================= --}}

                    <div class="form-actions">

                        <button
                            type="submit"
                            class="save-button"
                        >
                            Lưu thay đổi
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </div>


    {{-- ========================================================= --}}
    {{-- BACK --}}
    {{-- ========================================================= --}}

    <div class="bottom-actions">

        <a
            href="{{ route('trang-chu') }}"
            class="back-button"
        >
            ← Quay lại trang chủ
        </a>

    </div>

</main>


{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer>

    <div class="footer-logo">
        Viet<span>Jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>

</html>