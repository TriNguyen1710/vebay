<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Liên hệ - VietJet</title>

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
            --danger: #e2231a;
            --light: #f5f7fa;
            --white: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        /* ================= HEADER ================= */

        .header {
            background: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .navbar {
            max-width: 1240px;
            margin: auto;
            min-height: 76px;
            padding: 0 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo {
            font-size: 30px;
            font-weight: 800;
            color: var(--primary);
            white-space: nowrap;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-link {
            color: #293241;
            padding: 27px 14px;
            font-weight: 600;
            font-size: 15px;
            border-bottom: 3px solid transparent;
        }

        .nav-link:hover {
            color: var(--primary);
            border-bottom-color: var(--secondary);
        }

        .nav-link.active {
            color: var(--primary);
            border-bottom-color: var(--secondary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-login,
        .btn-register {
            padding: 10px 17px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 700;
        }

        .btn-login {
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-register {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-name {
            font-size: 14px;
            font-weight: bold;
            color: var(--primary);
        }

        .logout-btn {
            border: 0;
            cursor: pointer;
            color: white;
            background: var(--danger);
            padding: 9px 13px;
            border-radius: 7px;
            font-weight: bold;
        }

        /* ================= BANNER ================= */

        .contact-banner {
            background:
                linear-gradient(
                    90deg,
                    rgba(0, 41, 79, 0.96),
                    rgba(0, 91, 159, 0.82)
                );

            min-height: 310px;

            display: flex;
            align-items: center;
        }

        .banner-container {
            width: 100%;
            max-width: 1240px;
            margin: auto;
            padding: 60px 20px;
            color: white;
        }

        .banner-small {
            color: var(--secondary);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .banner-container h1 {
            font-size: 44px;
            margin-bottom: 15px;
        }

        .banner-container p {
            max-width: 700px;
            color: #e3edf5;
            font-size: 17px;
            line-height: 1.7;
        }

        /* ================= CONTACT ================= */

        .contact-section {
            padding: 70px 20px;
        }

        .contact-container {
            max-width: 1240px;
            margin: auto;
        }

        .contact-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-heading h2 {
            color: var(--primary);
            font-size: 32px;
            margin-bottom: 10px;
        }

        .contact-heading p {
            max-width: 680px;
            margin: auto;
            color: var(--muted);
            line-height: 1.7;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .contact-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 32px 26px;

            box-shadow: 0 8px 25px rgba(0, 59, 112, 0.08);

            transition: 0.25s;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 35px rgba(0, 59, 112, 0.14);
        }

        .contact-icon {
            width: 55px;
            height: 55px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: #edf6ff;
            color: var(--primary);

            font-size: 25px;
            margin-bottom: 20px;
        }

        .contact-card h3 {
            color: var(--primary);
            margin-bottom: 12px;
            font-size: 19px;
        }

        .contact-card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .contact-value {
            color: #202631 !important;
            font-weight: bold;
            font-size: 16px !important;
        }

        /* ================= SUPPORT ================= */

        .support-box {
            margin-top: 45px;

            background: var(--primary-dark);
            color: white;

            border-radius: 16px;
            padding: 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }

        .support-box h3 {
            font-size: 23px;
            margin-bottom: 8px;
        }

        .support-box p {
            color: #c8d6e1;
            line-height: 1.7;
        }

        .support-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 160px;
            min-height: 48px;

            padding: 0 20px;

            background: var(--secondary);
            color: #202020;

            border-radius: 8px;

            font-weight: 800;
            white-space: nowrap;
        }

        .support-button:hover {
            opacity: 0.9;
        }

        /* ================= FOOTER ================= */

        footer {
            background: #031d33;
            color: white;
            padding-top: 45px;
        }

        .footer-container {
            max-width: 1240px;
            margin: auto;

            padding: 0 20px 35px;

            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 50px;
        }

        .footer-logo {
            color: white;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer-logo span {
            color: var(--secondary);
        }

        .footer-description {
            color: #b8c6d3;
            max-width: 420px;
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 16px;
        }

        .footer-links {
            display: grid;
            gap: 10px;
        }

        .footer-links a {
            color: #b8c6d3;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 18px 20px;
            text-align: center;
            color: #9bacbb;
            font-size: 13px;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 900px) {

            .nav-menu {
                display: none;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .support-box {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .banner-container h1 {
                font-size: 35px;
            }
        }

    </style>

</head>

<body>


<!-- ================= HEADER ================= -->

<header class="header">

    <nav class="navbar">

        <a href="{{ route('trang-chu') }}" class="logo">
            Viet<span>Jet</span>
        </a>


        <div class="nav-menu">

            <a href="{{ route('trang-chu') }}" class="nav-link">
                Trang chủ
            </a>

            <a href="{{ route('flights.search.form') }}" class="nav-link">
                Đặt vé
            </a>

            @auth

                <a href="{{ route('tickets.mine') }}" class="nav-link">
                    Vé của tôi
                </a>

                <a href="{{ route('notifications.index') }}" class="nav-link">
                    Thông báo
                </a>

            @endauth


            <a href="{{ route('contact') }}" class="nav-link active">
                Liên hệ
            </a>

        </div>


        <div class="nav-actions">

            @guest

                <a href="{{ route('dang-nhap') }}" class="btn-login">
                    Đăng nhập
                </a>

                <a href="{{ route('dang-ky') }}" class="btn-register">
                    Đăng ký
                </a>

            @else

                <div class="user-area">

                    <span class="user-name">
                        {{ auth()->user()->name }}
                    </span>

                    <form action="{{ route('dang-xuat') }}" method="POST">

                        @csrf

                        <button type="submit" class="logout-btn">
                            Đăng xuất
                        </button>

                    </form>

                </div>

            @endguest

        </div>

    </nav>

</header>



<!-- ================= BANNER ================= -->

<section class="contact-banner">

    <div class="banner-container">

        <div class="banner-small">
            HỖ TRỢ KHÁCH HÀNG
        </div>

        <h1>Liên hệ với VietJet</h1>

        <p>
            Chúng tôi luôn sẵn sàng hỗ trợ bạn về việc đặt vé,
            chuyến bay, hành lý và thông tin hành khách.
        </p>

    </div>

</section>



<!-- ================= CONTACT ================= -->

<section class="contact-section">

    <div class="contact-container">

        <div class="contact-heading">

            <h2>Liên hệ hỗ trợ</h2>

            <p>
                Khi cần hỗ trợ về đặt vé, chuyến bay, hành lý
                hoặc thông tin hành khách, bạn có thể liên hệ
                với VietJet qua các kênh dưới đây.
            </p>

        </div>


        <div class="contact-grid">


            <!-- HOTLINE -->

            <div class="contact-card">

                <div class="contact-icon">
                    ☎
                </div>

                <h3>Tổng đài hỗ trợ</h3>

                <p class="contact-value">
                    1900 6868
                </p>

                <p>
                    Liên hệ tổng đài khi bạn cần được hỗ trợ trực tiếp.
                </p>

            </div>



            <!-- EMAIL -->

            <div class="contact-card">

                <div class="contact-icon">
                    ✉
                </div>

                <h3>Email hỗ trợ</h3>

                <p class="contact-value">
                    hotro@vietjet.vn
                </p>

                <p>
                    Gửi yêu cầu hỗ trợ và thông tin cần giải đáp qua email.
                </p>

            </div>



            <!-- TIME -->

            <div class="contact-card">

                <div class="contact-icon">
                    ◷
                </div>

                <h3>Thời gian hỗ trợ</h3>

                <p class="contact-value">
                    08:00 - 22:00
                </p>

                <p>
                    Thứ Hai đến Chủ Nhật.
                </p>

            </div>

        </div>



        <!-- SUPPORT -->

        <div class="support-box">

            <div>

                <h3>Bạn cần hỗ trợ đặt vé?</h3>

                <p>
                    Tìm chuyến bay phù hợp và bắt đầu quá trình
                    đặt vé trực tuyến ngay trên website.
                </p>

            </div>


            <a
                href="{{ route('flights.search.form') }}"
                class="support-button"
            >
                Đặt vé ngay
            </a>

        </div>

    </div>

</section>



<!-- ================= FOOTER ================= -->

<footer>

    <div class="footer-container">


        <div>

            <div class="footer-logo">
                Viet<span>Jet</span>
            </div>

            <p class="footer-description">
                Website đặt vé máy bay VietJet tích hợp nhận diện khuôn mặt,
                hỗ trợ khách hàng đặt vé và quản lý hành trình trực tuyến.
            </p>

        </div>



        <div>

            <div class="footer-title">
                Chức năng
            </div>

            <div class="footer-links">

                <a href="{{ route('trang-chu') }}">
                    Trang chủ
                </a>

                <a href="{{ route('flights.search.form') }}">
                    Đặt vé
                </a>

                @auth

                    <a href="{{ route('tickets.mine') }}">
                        Vé của tôi
                    </a>

                    <a href="{{ route('notifications.index') }}">
                        Thông báo
                    </a>

                @endauth

            </div>

        </div>



        <div>

            <div class="footer-title">
                Hỗ trợ
            </div>

            <div class="footer-links">

                @auth

                    <a href="{{ route('profile.edit') }}">
                        Thông tin cá nhân
                    </a>

                @endauth

                <a href="{{ route('contact') }}">
                    Liên hệ
                </a>

            </div>

        </div>

    </div>


    <div class="copyright">
        © {{ date('Y') }} VietJet - Website đặt vé máy bay.
    </div>

</footer>


</body>

</html>