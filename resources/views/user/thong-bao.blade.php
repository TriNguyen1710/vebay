<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Thông báo - VietJet</title>

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

        button {
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
            max-width: 1000px;

            margin: -48px auto 70px;
            padding: 0 20px;

            position: relative;
            z-index: 10;
        }

        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-card {
            background: white;

            padding: 23px 25px;

            margin-bottom: 20px;

            border-radius: 14px;

            box-shadow:
                0 7px 28px rgba(0, 0, 0, 0.08);

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;
        }

        .page-card h2 {
            color: var(--primary);

            font-size: 20px;

            margin-bottom: 5px;
        }

        .page-card p {
            color: var(--muted);

            font-size: 12px;
            line-height: 1.5;
        }

        .notification-count {
            min-width: 105px;

            padding: 10px 14px;

            background: #edf5fb;

            border: 1px solid #cedfea;
            border-radius: 7px;

            color: var(--primary);

            text-align: center;

            font-size: 11px;
            font-weight: bold;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            padding: 14px 16px;

            margin-bottom: 18px;

            background: #edf8f2;

            border: 1px solid #badfc9;
            border-left: 4px solid var(--success);

            border-radius: 7px;

            color: #17643d;

            font-size: 12px;
        }

        /* =====================================================
           NOTIFICATION
        ===================================================== */

        .notification {
            position: relative;

            background: white;

            border: 1px solid var(--border);
            border-radius: 10px;

            margin-bottom: 14px;

            box-shadow:
                0 3px 14px rgba(0, 0, 0, 0.04);

            overflow: hidden;
        }

        .notification.unread {
            border-left: 4px solid var(--secondary);
        }

        .notification.read {
            border-left: 4px solid #c8d0d7;
        }

        .notification-body {
            padding: 20px 22px;
        }

        /* =====================================================
           NOTIFICATION TOP
        ===================================================== */

        .notification-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 20px;

            margin-bottom: 11px;
        }

        .notification-title-area {
            display: flex;
            align-items: flex-start;
            gap: 11px;
        }

        .notification-indicator {
            width: 10px;
            height: 10px;

            margin-top: 5px;

            flex-shrink: 0;

            border-radius: 50%;

            background: #bcc5cc;
        }

        .unread .notification-indicator {
            background: var(--secondary);

            box-shadow:
                0 0 0 4px rgba(244, 180, 0, 0.13);
        }

        .notification-title {
            color: #263746;

            font-size: 16px;
            font-weight: 800;

            line-height: 1.4;
        }

        .unread .notification-title {
            color: var(--primary);
        }

        /* =====================================================
           STATUS
        ===================================================== */

        .notification-status {
            flex-shrink: 0;

            padding: 5px 9px;

            border-radius: 4px;

            font-size: 9px;
            font-weight: 800;
        }

        .notification-status.new {
            background: #fff7dd;
            color: #7b641b;

            border: 1px solid #ead99e;
        }

        .notification-status.seen {
            background: #f0f2f4;
            color: #65717b;

            border: 1px solid #dce1e5;
        }

        /* =====================================================
           MESSAGE
        ===================================================== */

        .notification-message {
            color: #4d5b67;

            font-size: 13px;
            line-height: 1.7;

            margin-left: 21px;
            margin-bottom: 14px;
        }

        /* =====================================================
           FOOTER OF NOTIFICATION
        ===================================================== */

        .notification-footer {
            margin-left: 21px;

            padding-top: 13px;

            border-top: 1px solid #edf0f3;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 15px;
        }

        .notification-time {
            color: #7b8790;

            font-size: 10px;
        }

        .read-text {
            color: var(--success);

            font-size: 10px;
            font-weight: bold;
        }

        /* =====================================================
           BUTTON
        ===================================================== */

        .read-button {
            border: 1px solid #b9cbd9;

            background: white;
            color: var(--primary);

            padding: 8px 12px;

            border-radius: 5px;

            cursor: pointer;

            font-size: 10px;
            font-weight: bold;

            transition: 0.2s;
        }

        .read-button:hover {
            background: var(--primary);
            color: white;

            border-color: var(--primary);
        }

        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            background: white;

            padding: 55px 25px;

            border-radius: 14px;

            box-shadow:
                0 6px 25px rgba(0, 0, 0, 0.06);

            text-align: center;
        }

        .empty-mark {
            width: 58px;
            height: 58px;

            margin: 0 auto 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #edf5fb;
            color: var(--primary);

            font-size: 15px;
            font-weight: 800;
        }

        .empty h2 {
            color: var(--primary);

            font-size: 20px;

            margin-bottom: 7px;
        }

        .empty p {
            color: var(--muted);

            font-size: 12px;
            line-height: 1.6;
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

        @media (max-width: 800px) {

            .nav-menu {
                display: none;
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

            .page-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification-top {
                flex-direction: column;
                gap: 10px;
            }

            .notification-message,
            .notification-footer {
                margin-left: 0;
            }

            .notification-footer {
                flex-direction: column;
                align-items: flex-start;
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
                class="nav-link active"
            >
                Thông báo
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
                Thông báo
            </span>

        </div>


        <h1>
            Thông báo của tôi
        </h1>


        <p>
            Theo dõi các thông báo và nhắc nhở liên quan
            đến chuyến bay của bạn.
        </p>

    </div>

</section>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<main class="main">

    {{-- ========================================================= --}}
    {{-- PAGE INFO --}}
    {{-- ========================================================= --}}

    <section class="page-card">

        <div>

            <h2>
                Trung tâm thông báo
            </h2>

            <p>
                Các cập nhật và nhắc nhở từ hệ thống SkyGo.
            </p>

        </div>


        <div class="notification-count">

            {{ $notifications->count() }}
            thông báo

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- SUCCESS --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- NOTIFICATIONS --}}
    {{-- ========================================================= --}}

    @forelse($notifications as $notification)

        <article
            class="notification
            {{ $notification->status === 'unread'
                ? 'unread'
                : 'read' }}"
        >

            <div class="notification-body">

                {{-- ================================================= --}}
                {{-- TOP --}}
                {{-- ================================================= --}}

                <div class="notification-top">

                    <div class="notification-title-area">

                        <span class="notification-indicator"></span>


                        <div class="notification-title">
                            {{ $notification->title }}
                        </div>

                    </div>


                    @if($notification->status === 'unread')

                        <span class="notification-status new">
                            MỚI
                        </span>

                    @else

                        <span class="notification-status seen">
                            ĐÃ ĐỌC
                        </span>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- MESSAGE --}}
                {{-- ================================================= --}}

                <div class="notification-message">
                    {{ $notification->message }}
                </div>


                {{-- ================================================= --}}
                {{-- FOOTER --}}
                {{-- ================================================= --}}

                <div class="notification-footer">

                    <div class="notification-time">

                        Gửi lúc:

                        {{ $notification->created_at
                            ->timezone('Asia/Ho_Chi_Minh')
                            ->format('H:i d/m/Y') }}

                    </div>


                    @if($notification->status === 'unread')

                        <form
                            action="{{ route(
                                'notifications.read',
                                $notification->id
                            ) }}"
                            method="POST"
                        >

                            @csrf


                            <button
                                type="submit"
                                class="read-button"
                            >
                                Đánh dấu đã đọc
                            </button>

                        </form>

                    @else

                        <span class="read-text">
                            Đã đọc
                        </span>

                    @endif

                </div>

            </div>

        </article>

    @empty

        {{-- ===================================================== --}}
        {{-- EMPTY --}}
        {{-- ===================================================== --}}

        <section class="empty">

            <div class="empty-mark">
                SG
            </div>


            <h2>
                Chưa có thông báo
            </h2>


            <p>
                Khi có thông tin mới liên quan đến chuyến bay,
                thông báo sẽ xuất hiện tại đây.
            </p>

        </section>

    @endforelse


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
        Sky<span>Go</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>

</footer>

</body>

</html>