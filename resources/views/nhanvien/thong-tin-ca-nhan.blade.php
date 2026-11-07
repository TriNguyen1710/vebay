<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Thông tin cá nhân nhân viên - VietJet</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #003b70;
            --dark: #00294f;
            --background: #f3f6f9;
            --border: #dfe6eb;
            --muted: #74818c;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: #243746;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 245px;
            padding: 26px 16px;
            background: var(--dark);
            display: flex;
            flex-direction: column;
            color: white;
            overflow-y: auto;
        }

        .logo {
            color: white;
            font-size: 29px;
            font-weight: 800;
            padding: 0 10px;
        }

        .logo span {
            color: #f4b400;
        }

        .employee-label {
            padding: 8px 11px 30px;
            color: #8ca5b6;
            font-size: 10px;
        }

        .menu-title {
            padding: 0 11px;
            margin-bottom: 10px;
            color: #7895aa;
            font-size: 10px;
            letter-spacing: 1px;
        }

        nav {
            display: grid;
            gap: 4px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 44px;
            padding: 14px 13px;
            border-radius: 7px;
            color: #cad9e4;
            font-size: 12px;
            font-weight: 600;
        }

        .menu-icon {
            width: 17px;
            height: 17px;
            display: flex;
            flex-shrink: 0;
        }

        .menu-icon svg,
        .button-icon {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .menu-link.active .menu-icon {
            color: #f4b400;
        }

        .menu-link:hover,
        .menu-link.active {
            background: rgba(255, 255, 255, .1);
            color: white;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        .employee-info {
            padding: 0 11px 16px;
        }

        .employee-info strong {
            display: block;
            margin-bottom: 5px;
            font-size: 12px;
            overflow-wrap: anywhere;
        }

        .employee-info span {
            color: #8fa5b5;
            font-size: 10px;
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 6px;
            background: rgba(255, 255, 255, .06);
            color: white;
            cursor: pointer;
        }

        main {
            margin-left: 245px;
            min-height: 100vh;
        }

        .topbar {
            padding: 22px 30px;
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .topbar h1 {
            color: var(--primary);
            font-size: 22px;
            margin-bottom: 5px;
        }

        .topbar p {
            color: var(--muted);
            font-size: 12px;
        }

        .content {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            align-items: start;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 25px;
        }

        h2 {
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 12px;
        }

        .note {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        dl {
            display: grid;
            gap: 0;
        }

        .info-row {
            padding: 15px 0;
            border-bottom: 1px solid #edf1f5;
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        dt {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 6px;
        }

        dd {
            font-size: 14px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .info-row label {
            font-size: 12px;
            font-weight: normal;
            margin-bottom: 0;
        }

        .field {
            margin-bottom: 20px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5df;
            border-radius: 6px;
            font: inherit;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            outline: 2px solid #bedcf3;
            border-color: var(--primary);
        }

        .save-btn {
            padding: 13px 20px;
            background: var(--primary);
            color: white;
            border: 0;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .save-btn,
        .logout-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .button-icon {
            flex-shrink: 0;
        }

        .save-btn:disabled {
            opacity: .6;
            cursor: wait;
        }

        .profile-actions {
            margin-top: 20px;
        }

        .success,
        .error {
            padding: 14px 16px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        .success {
            background: #eaf7f0;
            color: #146c43;
            border: 1px solid #b8dfc8;
        }

        .error {
            background: #fdebed;
            color: #842029;
            border: 1px solid #efbec4;
        }

        .field-error {
            color: #b42318;
            font-size: 12px;
            margin-top: 7px;
            line-height: 1.5;
            font-weight: normal;
        }

        .password-toggle {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: normal;
            cursor: pointer;
        }

        .password-toggle input {
            width: auto;
        }

        .back {
            display: inline-block;
            margin-top: 24px;
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
        }

        @media(max-width: 1000px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 750px) {
            .sidebar {
                position: relative;
                width: 100%;
            }

            main {
                margin-left: 0;
            }

            .content {
                padding: 20px 15px;
            }

            .topbar {
                padding: 20px;
            }

            .sidebar-bottom {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

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

    <nav>
        <a
            href="{{ route('nhanvien.trang-chu') }}"
            class="menu-link"
        >
            <span class="menu-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                </svg>
            </span>

            <span>Tổng quan</span>
        </a>

        <a
            href="{{ route('nhanvien.tickets.index') }}"
            class="menu-link"
        >
            <span class="menu-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <path d="M4 5h16v14H4z"/>
                    <path d="M8 9h8M8 13h5"/>
                </svg>
            </span>

            <span>Tra cứu vé</span>
        </a>

        <a
            href="{{ route('nhanvien.passengers.unchecked') }}"
            class="menu-link"
        >
            <span class="menu-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="8" r="4"/>
                    <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                    <path d="M16 11a4 4 0 0 1 5 4"/>
                </svg>
            </span>

            <span>Hành khách chưa kiểm tra</span>
        </a>

        <a
            href="{{ route('nhanvien.flights.index') }}"
            class="menu-link"
        >
            <span class="menu-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                </svg>
            </span>

            <span>Danh sách chuyến bay</span>
        </a>

        <a
            href="{{ route('profile.edit') }}"
            class="menu-link active"
            aria-current="page"
        >
            <span class="menu-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21v-2a8 8 0 0 1 16 0v2"/>
                </svg>
            </span>

            <span>Thông tin cá nhân</span>
        </a>
    </nav>
<a
    href="{{ route('nhanvien.tickets.statistics') }}"
    class="menu-link"
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
    <div class="sidebar-bottom">
        <div class="employee-info">
            <strong>{{ $user->name }}</strong>
            <span>Nhân viên sân bay</span>
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
                <svg
                    class="button-icon"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M9 4H4v16h5"/>
                    <path d="M14 8l4 4-4 4"/>
                    <path d="M8 12h10"/>
                </svg>

                <span>Đăng xuất</span>
            </button>
        </form>
    </div>
</aside>

<main>
    <header class="topbar">
        <h1>Thông tin cá nhân</h1>

        <p>
            Xem thông tin tài khoản nhân viên
            và thay đổi mật khẩu đăng nhập.
        </p>
    </header>

    <div class="content">
        @if(session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any() || $errors->employeeProfile->any() || $errors->employeePassword->any())
            <div class="error" role="alert">
                Lưu chưa thành công.
                Vui lòng kiểm tra các mục được báo lỗi bên dưới.
            </div>
        @endif

        <div class="grid">
            <section class="card">
                <h2>Thông tin tài khoản</h2>

                <p class="note">
                    Bạn có thể cập nhật ngày sinh và giới tính.
                    Các thông tin khác do admin quản lý.
                </p>

                <form
                    id="profileForm"
                    action="{{ route('profile.update') }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <input
                        type="hidden"
                        name="employee_action"
                        value="profile"
                    >

                    <dl>
                        <div class="info-row">
                            <dt>Họ và tên</dt>
                            <dd>{{ $user->name }}</dd>
                        </div>

                        <div class="info-row">
                            <dt>Email đăng nhập</dt>
                            <dd>{{ $user->email }}</dd>
                        </div>

                        <div class="info-row">
                            <dt>Số điện thoại</dt>
                            <dd>
                                {{ $user->phone ?: 'Chưa cập nhật' }}
                            </dd>
                        </div>

                        <div class="info-row">
                            <dt>
                                <label for="date_of_birth">
                                    Ngày sinh
                                </label>
                            </dt>

                            <dd>
                                <input
                                    id="date_of_birth"
                                    name="date_of_birth"
                                    type="date"
                                    value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}"
                                    max="{{ now()->subDay()->format('Y-m-d') }}"
                                    required
                                >

                                @error('date_of_birth', 'employeeProfile')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </dd>
                        </div>

                        <div class="info-row">
                            <dt>
                                <label for="gender">
                                    Giới tính
                                </label>
                            </dt>

                            <dd>
                                <select
                                    id="gender"
                                    name="gender"
                                    required
                                >
                                    <option value="">
                                        Chọn giới tính
                                    </option>

                                    <option
                                        value="nam"
                                        @selected(old('gender', $user->gender) === 'nam')
                                    >
                                        Nam
                                    </option>

                                    <option
                                        value="nu"
                                        @selected(old('gender', $user->gender) === 'nu')
                                    >
                                        Nữ
                                    </option>

                                    <option
                                        value="khac"
                                        @selected(old('gender', $user->gender) === 'khac')
                                    >
                                        Khác
                                    </option>
                                </select>

                                @error('gender', 'employeeProfile')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </dd>
                        </div>

                        <div class="info-row">
                            <dt>Vai trò</dt>
                            <dd>Nhân viên sân bay</dd>
                        </div>

                        <div class="info-row">
                            <dt>Ngày tạo tài khoản</dt>
                            <dd>
                                {{ $user->created_at?->format('d/m/Y H:i') ?? '---' }}
                            </dd>
                        </div>

                        <div class="info-row">
                            <dt>Xác nhận tài khoản</dt>
                            <dd>
                                {{ $user->employee_account_confirmed_at ? 'Đã xác nhận' : 'Chưa xác nhận' }}
                            </dd>
                        </div>
                    </dl>

                    <div class="profile-actions">
                        <button
                            id="saveProfile"
                            type="submit"
                            class="save-btn"
                        >
                            <svg
                                class="button-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M5 3h12l4 4v14H3V3z"/>
                                <path d="M7 3v6h10V3"/>
                                <path d="M7 21v-8h10v8"/>
                            </svg>

                            <span class="button-label">
                                Lưu thông tin
                            </span>
                        </button>
                    </div>
                </form>
            </section>

            <section class="card">
                <h2>Đổi mật khẩu</h2>

                <p class="note">
                    Mật khẩu mới phải có ít nhất 6 ký tự
                    và khác mật khẩu hiện tại.
                </p>

                <form
                    id="passwordForm"
                    action="{{ route('profile.update') }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <input
                        type="hidden"
                        name="employee_action"
                        value="password"
                    >

                    <div class="field">
                        <label for="employeeLogin">
                            Tài khoản đăng nhập
                        </label>

                        <input
                            id="employeeLogin"
                            name="username"
                            type="email"
                            value="{{ $user->email }}"
                            autocomplete="username"
                            readonly
                        >
                    </div>

                    <div class="field">
                        <label for="current_password">
                            Mật khẩu hiện tại
                        </label>

                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            autocomplete="current-password"
                            required
                        >

                        @error('current_password', 'employeePassword')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">
                            Mật khẩu mới
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            minlength="6"
                            autocomplete="new-password"
                            required
                        >

                        @error('password', 'employeePassword')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">
                            Xác nhận mật khẩu mới
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            minlength="6"
                            autocomplete="new-password"
                            required
                        >
                    </div>

                    <label class="password-toggle">
                        <input
                            id="showPasswords"
                            type="checkbox"
                        >

                        Hiện mật khẩu
                    </label>

                    <button
                        id="savePassword"
                        type="submit"
                        class="save-btn"
                    >
                        <svg
                            class="button-icon"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <rect
                                x="4"
                                y="10"
                                width="16"
                                height="11"
                                rx="2"
                            />

                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                            <path d="M12 14v3"/>
                        </svg>

                        <span class="button-label">
                            Đổi mật khẩu
                        </span>
                    </button>
                </form>
            </section>
        </div>

        <a
            class="back"
            href="{{ route('nhanvien.trang-chu') }}"
        >
            ← Quay lại tổng quan
        </a>
    </div>
</main>

<script>
    const showPasswords = document.getElementById(
        'showPasswords'
    );

    const passwordFields = [
        'current_password',
        'password',
        'password_confirmation'
    ];

    showPasswords.addEventListener('change', function () {
        passwordFields.forEach(function (id) {
            document.getElementById(id).type =
                showPasswords.checked
                    ? 'text'
                    : 'password';
        });
    });

    const forms = [
        {
            form: 'profileForm',
            button: 'saveProfile',
            label: 'Lưu thông tin'
        },
        {
            form: 'passwordForm',
            button: 'savePassword',
            label: 'Đổi mật khẩu'
        }
    ];

    forms.forEach(function (item) {
        document.getElementById(
            item.form
        ).addEventListener('submit', function () {
            const button = document.getElementById(
                item.button
            );

            button.disabled = true;

            button.querySelector(
                '.button-label'
            ).textContent = 'Đang cập nhật...';
        });
    });

    window.addEventListener('pageshow', function () {
        forms.forEach(function (item) {
            const button = document.getElementById(
                item.button
            );

            button.disabled = false;

            button.querySelector(
                '.button-label'
            ).textContent = item.label;
        });
    });
</script>

</body>
</html>