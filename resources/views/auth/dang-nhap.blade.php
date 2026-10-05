<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Đăng nhập </title>

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

            --success: #198754;
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

            min-height: 650px;

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
                    rgba(0, 19, 35, 0.38),
                    transparent 48%
                );

            pointer-events: none;
        }

        .visual > * {
            position: relative;
            z-index: 2;
        }

        /* =====================================================
           LOGO
        ===================================================== */

        .brand {
            display: inline-block;

            width: fit-content;

            color: white;

            font-size: 33px;
            font-weight: 800;

            letter-spacing: -1.2px;
        }

        .brand span {
            color: var(--secondary);
        }

        /* =====================================================
           VISUAL CONTENT
        ===================================================== */

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
            max-width: 480px;

            font-size: 43px;
            line-height: 1.13;

            margin-bottom: 18px;

            letter-spacing: -0.8px;
        }

        .visual-description {
            max-width: 450px;

            color: #e3edf4;

            font-size: 14px;
            line-height: 1.75;
        }

        /* =====================================================
           BENEFITS
        ===================================================== */

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

        /* =====================================================
           BACK
        ===================================================== */

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

        /* =====================================================
           HEADING
        ===================================================== */

        .form-accent {
            width: 46px;
            height: 4px;

            margin-bottom: 16px;

            border-radius: 10px;

            background: var(--secondary);
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .small-title {
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
            max-width: 390px;

            color: var(--muted);

            font-size: 12px;
            line-height: 1.65;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .success-box {
            margin-bottom: 20px;

            padding: 13px 14px;

            border-radius: 8px;

            background: #edf8f2;

            border: 1px solid #bcdcca;
            border-left: 4px solid var(--success);

            color: #17643d;

            font-size: 11px;
            line-height: 1.6;
        }

        .error-box {
            margin-bottom: 20px;

            padding: 13px 14px;

            border-radius: 8px;

            background: #fff2f3;

            border: 1px solid #f1c6ca;
            border-left: 4px solid var(--danger);

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

        .form-group {
            margin-bottom: 18px;
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

        input {
            width: 100%;

            height: 47px;

            padding: 0 13px;

            border: 1px solid var(--border);
            border-radius: 8px;

            background: white;

            color: #273846;

            font-size: 13px;

            transition: 0.2s;
        }

        input::placeholder {
            color: #a5afb6;
        }

        input:focus {
            outline: none;

            border-color: var(--primary-soft);

            box-shadow:
                0 0 0 3px rgba(0, 91, 150, 0.08);
        }

        /* =====================================================
           PASSWORD
        ===================================================== */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 72px;
        }

        .toggle-password {
            position: absolute;

            top: 50%;
            right: 12px;

            transform: translateY(-50%);

            border: none;
            background: transparent;

            color: var(--primary);

            font-size: 10px;
            font-weight: 800;

            cursor: pointer;
        }

        /* =====================================================
           BUTTON
        ===================================================== */

        .submit-btn {
            width: 100%;
            height: 48px;

            border: none;
            border-radius: 8px;

            margin-top: 6px;

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
           REGISTER
        ===================================================== */

        .register-box {
            margin-top: 25px;

            padding-top: 21px;

            border-top: 1px solid #e8edf1;

            text-align: center;

            color: var(--muted);

            font-size: 12px;
        }

        .register-box a {
            color: var(--primary);

            font-weight: 800;
        }

        .register-box a:hover {
            text-decoration: underline;
        }

        .note {
            margin-top: 17px;

            text-align: center;

            color: #96a1a9;

            font-size: 10px;
            line-height: 1.55;
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
        {{-- LEFT --}}
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
                    WELCOME TO VIETJET
                </span>


                <h1>
                    Chào mừng bạn trở lại với VietJet
                </h1>


                <p class="visual-description">
                    Đăng nhập để tiếp tục hành trình,
                    quản lý vé và theo dõi những thông tin
                    quan trọng liên quan đến chuyến bay của bạn.
                </p>


                <div class="benefits">

                    <div class="benefit">

                        <span class="benefit-line"></span>

                        <span>
                            Tìm kiếm và đặt chuyến bay trực tuyến
                        </span>

                    </div>


                    <div class="benefit">

                        <span class="benefit-line"></span>

                        <span>
                            Quản lý vé điện tử trong tài khoản
                        </span>

                    </div>


                    <div class="benefit">

                        <span class="benefit-line"></span>

                        <span>
                            Theo dõi thông báo và hành trình của bạn
                        </span>

                    </div>

                </div>

            </div>


            <div class="visual-bottom">
                Website đặt vé máy bay tích hợp nhận diện khuôn mặt
            </div>

        </section>


        {{-- ===================================================== --}}
        {{-- RIGHT --}}
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
                    Đăng nhập
                </h2>


                <p>
                    Nhập thông tin tài khoản để tiếp tục
                    sử dụng các dịch vụ trên VietJet.
                </p>

            </div>


            {{-- ================================================= --}}
            {{-- SUCCESS --}}
            {{-- ================================================= --}}

            @if(session('success'))

                <div class="success-box">
                    {{ session('success') }}
                </div>

            @endif


            {{-- ================================================= --}}
            {{-- ERROR --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div class="error-box">

                    <strong>
                        Không thể đăng nhập.
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
                action="{{ route('dang-nhap.xu-ly') }}"
                method="POST"
            >

                @csrf


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


                <div class="form-group">

                    <label for="password">
                        Mật khẩu
                        <span class="required">*</span>
                    </label>


                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"

                            placeholder="Nhập mật khẩu"

                            autocomplete="current-password"

                            required
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            id="togglePassword"
                        >
                            HIỆN
                        </button>

                    </div>

                </div>


                <button
                    type="submit"
                    class="submit-btn"
                >
                    Đăng nhập
                </button>

            </form>


            {{-- ================================================= --}}
            {{-- REGISTER --}}
            {{-- ================================================= --}}

            <div class="register-box">

                Chưa có tài khoản?

                <a href="{{ route('dang-ky') }}">
                    Đăng ký ngay
                </a>

            </div>


            <div class="note">
                Đăng nhập để quản lý vé, hành trình và
                các thông báo liên quan đến chuyến bay.
            </div>

        </section>

    </div>

</div>


<script>

    const togglePassword =
        document.getElementById('togglePassword');

    const passwordInput =
        document.getElementById('password');


    togglePassword.addEventListener('click', function () {

        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            togglePassword.textContent = 'ẨN';

        } else {

            passwordInput.type = 'password';

            togglePassword.textContent = 'HIỆN';

        }

    });

</script>


</body>

</html>