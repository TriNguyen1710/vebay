<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Đăng ký </title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #003b70;
            --primary-dark: #002846;
            --primary-soft: #0b5d96;

            --secondary: #f6b800;
            --secondary-dark: #d89f00;

            --white: #ffffff;
            --light: #eef4f8;

            --text: #1d2c38;
            --muted: #6f7d88;

            --border: #dbe4ea;

            --danger: #dc3545;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #eaf1f6 0%,
                    #f8fafc 55%,
                    #edf3f7 100%
                );

            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        input,
        select,
        button {
            font-family: inherit;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 35px 20px;
        }

        .auth-shell {
            width: 100%;
            max-width: 1180px;

            min-height: 680px;

            display: grid;
            grid-template-columns: 1.05fr 0.95fr;

            background: white;

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 22px 60px rgba(16, 44, 67, 0.16);
        }

        /* =====================================================
           LEFT
        ===================================================== */

        .visual {
            position: relative;

            padding: 42px 46px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    rgba(0, 36, 67, 0.97),
                    rgba(0, 59, 112, 0.68)
                ),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1600&q=88');

            background-size: cover;
            background-position: center;
        }

        .visual::after {
            content: "";

            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    to top,
                    rgba(0, 19, 35, 0.35),
                    transparent 45%
                );

            pointer-events: none;
        }

        .visual > * {
            position: relative;
            z-index: 2;
        }

        .brand {
            display: inline-block;

            color: white;

            font-size: 33px;
            font-weight: 800;

            letter-spacing: -1.2px;
        }

        .brand span {
            color: var(--secondary);
        }

        .visual-main {
            max-width: 500px;

            margin-bottom: 40px;
        }

        .eyebrow {
            display: inline-block;

            margin-bottom: 18px;

            padding: 7px 12px;

            border-radius: 20px;

            background: rgba(255, 255, 255, 0.12);

            border:
                1px solid rgba(255, 255, 255, 0.22);

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1.1px;
        }

        .visual h1 {
            font-size: 43px;
            line-height: 1.13;

            margin-bottom: 18px;

            letter-spacing: -0.8px;
        }

        .visual p {
            max-width: 450px;

            color: #e3edf4;

            font-size: 14px;
            line-height: 1.75;
        }

        .benefits {
            margin-top: 30px;

            display: grid;
            gap: 13px;
        }

        .benefit {
            display: flex;
            align-items: center;

            gap: 11px;

            color: #f3f8fb;

            font-size: 13px;
        }

        .benefit-line {
            width: 26px;
            height: 2px;

            flex-shrink: 0;

            background: var(--secondary);
        }

        .visual-bottom {
            color: #c5d5df;

            font-size: 11px;
        }

        /* =====================================================
           RIGHT
        ===================================================== */

        .form-side {
            padding: 44px 50px;

            display: flex;
            flex-direction: column;
            justify-content: center;

            background:
                linear-gradient(
                    180deg,
                    #ffffff 0%,
                    #fbfcfd 100%
                );
        }

        .mobile-logo {
            display: none;

            color: var(--primary);

            font-size: 28px;
            font-weight: 800;

            margin-bottom: 24px;
        }

        .mobile-logo span {
            color: var(--secondary);
        }

        .back {
            display: inline-flex;
            align-items: center;

            width: fit-content;

            margin-bottom: 26px;

            color: var(--primary);

            font-size: 12px;
            font-weight: 700;
        }

        .back:hover {
            text-decoration: underline;
        }

        .form-heading {
            margin-bottom: 26px;
        }

        .form-heading .small-title {
            color: var(--secondary-dark);

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1.1px;

            margin-bottom: 8px;
        }

        .form-heading h2 {
            color: var(--primary-dark);

            font-size: 31px;

            margin-bottom: 9px;

            letter-spacing: -0.4px;
        }

        .form-heading p {
            max-width: 380px;

            color: var(--muted);

            font-size: 12px;
            line-height: 1.65;
        }

        /* =====================================================
           ERROR
        ===================================================== */

        .error-box {
            margin-bottom: 20px;

            padding: 13px 14px;

            border-radius: 8px;

            background: #fff2f3;

            border:
                1px solid #f1c6ca;

            border-left:
                4px solid var(--danger);

            color: #8b2430;

            font-size: 11px;
            line-height: 1.6;
        }

        .error-box strong {
            display: block;

            margin-bottom: 4px;
        }

        /* =====================================================
           FORM
        ===================================================== */

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 15px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;

            margin-bottom: 7px;

            color: #374956;

            font-size: 11px;
            font-weight: 700;
        }

        .required {
            color: var(--danger);
        }

        input,
        select {
            width: 100%;

            height: 45px;

            padding: 0 13px;

            border:
                1px solid var(--border);

            border-radius: 8px;

            background: #fff;

            color: #273846;

            font-size: 13px;

            transition: 0.2s;
        }

        input::placeholder {
            color: #a5afb6;
        }

        input:focus,
        select:focus {
            outline: none;

            border-color: var(--primary-soft);

            box-shadow:
                0 0 0 3px rgba(0, 91, 150, 0.08);
        }

        /* =====================================================
           BUTTON
        ===================================================== */

        .submit-btn {
            width: 100%;

            height: 48px;

            border: none;
            border-radius: 8px;

            margin-top: 5px;

            background: var(--secondary);

            color: var(--primary-dark);

            cursor: pointer;

            font-size: 13px;
            font-weight: 800;

            letter-spacing: 0.2px;

            transition: 0.2s;
        }

        .submit-btn:hover {
            background: #ffc519;

            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(246, 184, 0, 0.25);
        }

        /* =====================================================
           LOGIN
        ===================================================== */

        .login-box {
            margin-top: 24px;

            padding-top: 20px;

            border-top:
                1px solid #e8edf1;

            text-align: center;

            color: var(--muted);

            font-size: 12px;
        }

        .login-box a {
            color: var(--primary);

            font-weight: 800;
        }

        .login-box a:hover {
            text-decoration: underline;
        }

        .note {
            margin-top: 16px;

            text-align: center;

            color: #96a1a9;

            font-size: 10px;
            line-height: 1.5;
        }

        /* =====================================================
           DECOR
        ===================================================== */

        .form-accent {
            width: 46px;
            height: 4px;

            margin-bottom: 16px;

            border-radius: 10px;

            background: var(--secondary);
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .auth-shell {
                max-width: 620px;

                grid-template-columns: 1fr;

                min-height: auto;
            }

            .visual {
                display: none;
            }

            .form-side {
                padding: 38px 34px;
            }

            .mobile-logo {
                display: block;
            }

        }

        @media (max-width: 520px) {

            .page {
                padding: 0;
            }

            .auth-shell {
                min-height: 100vh;

                border-radius: 0;
            }

            .form-side {
                padding: 28px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-heading h2 {
                font-size: 27px;
            }

        }

    </style>

</head>


<body>

<div class="page">

    <div class="auth-shell">

        {{-- ===================================================== --}}
        {{-- LEFT VISUAL --}}
        {{-- ===================================================== --}}

        <section class="visual">

            <a
                href="{{ route('trang-chu') }}"
                class="brand"
            >
                Viet<span>Jet</span>
            </a>


            <div class="visual-main">

                <span class="eyebrow">
                    VIETJET MEMBER
                </span>


                <h1>
                    Hành trình của bạn bắt đầu từ đây
                </h1>


                <p>
                    Tạo tài khoản VietJet để đặt vé nhanh hơn,
                    quản lý hành trình và theo dõi các thông tin
                    quan trọng của chuyến bay.
                </p>


                <div class="benefits">

                    <div class="benefit">

                        <span class="benefit-line"></span>

                        <span>
                            Quản lý vé và hành trình trong một tài khoản
                        </span>

                    </div>


                    <div class="benefit">

                        <span class="benefit-line"></span>

                        <span>
                            Theo dõi thông báo liên quan đến chuyến bay
                        </span>

                    </div>


                    <div class="benefit">

                        <span class="benefit-line"></span>

                        <span>
                            Trải nghiệm quy trình đặt vé trực tuyến tiện lợi
                        </span>

                    </div>

                </div>

            </div>


            <div class="visual-bottom">
                Website đặt vé máy bay tích hợp nhận diện khuôn mặt
            </div>

        </section>


        {{-- ===================================================== --}}
        {{-- FORM SIDE --}}
        {{-- ===================================================== --}}

        <section class="form-side">

            <a
                href="{{ route('trang-chu') }}"
                class="mobile-logo"
            >
                Viet<span>Jet</span>
            </a>


            <a
                href="{{ route('trang-chu') }}"
                class="back"
            >
                ← Quay lại trang chủ
            </a>


            <div class="form-accent"></div>


            <div class="form-heading">

                <div class="small-title">
                    TÀI KHOẢN VIETJET
                </div>


                <h2>
                    Đăng ký tài khoản
                </h2>


                <p>
                    Tạo tài khoản để sử dụng các chức năng
                    đặt vé và quản lý hành trình trên VietJet.
                </p>

            </div>


            {{-- ================================================= --}}
            {{-- ERRORS --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div class="error-box">

                    <strong>
                        Vui lòng kiểm tra lại thông tin.
                    </strong>


                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <form
                action="{{ url('/dang-ky') }}"
                method="POST"
            >

                @csrf


                <div class="form-group">

                    <label for="name">
                        Họ và tên
                        <span class="required">*</span>
                    </label>


                    <input
                        type="text"
                        id="name"
                        name="name"

                        value="{{ old('name') }}"

                        placeholder="Nhập họ và tên"

                        autocomplete="name"

                        required
                    >

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

                        value="{{ old('email') }}"

                        placeholder="Nhập địa chỉ email"

                        autocomplete="email"

                        required
                    >

                </div>



                <div class="form-row">

                    <div class="form-group">

                        <label for="date_of_birth">
                            Ngày sinh
                            <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            id="date_of_birth"
                            name="date_of_birth"
                            value="{{ old('date_of_birth') }}"
                            max="{{ date('Y-m-d', strtotime('-1 day')) }}"
                            required
                        >

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
                            <option value="">Chọn giới tính</option>
                            <option value="nam" {{ old('gender') === 'nam' ? 'selected' : '' }}>Nam</option>
                            <option value="nu" {{ old('gender') === 'nu' ? 'selected' : '' }}>Nữ</option>
                            <option value="khac" {{ old('gender') === 'khac' ? 'selected' : '' }}>Khác</option>
                        </select>

                    </div>

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
                        value="{{ old('phone') }}"
                        placeholder="Nhập số điện thoại"
                        autocomplete="tel"
                        maxlength="20"
                        required
                    >

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label for="password">
                            Mật khẩu
                            <span class="required">*</span>
                        </label>


                        <input
                            type="password"
                            id="password"
                            name="password"

                            placeholder="Nhập mật khẩu"

                            autocomplete="new-password"

                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="password_confirmation">
                            Xác nhận mật khẩu
                            <span class="required">*</span>
                        </label>


                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"

                            placeholder="Nhập lại mật khẩu"

                            autocomplete="new-password"

                            required
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    class="submit-btn"
                >
                    Tạo tài khoản
                </button>

            </form>


            <div class="login-box">

                Bạn đã có tài khoản?

                <a href="{{ route('dang-nhap') }}">
                    Đăng nhập
                </a>

            </div>


            <div class="note">
                Bằng việc tạo tài khoản, bạn có thể sử dụng
                các chức năng đặt vé và quản lý hành trình trên VietJet.
            </div>

        </section>

    </div>

</div>

</body>

</html>