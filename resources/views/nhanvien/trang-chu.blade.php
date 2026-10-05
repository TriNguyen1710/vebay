<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Nhân viên sân bay </title>

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

        button {
            font-family: inherit;
        }

        .employee-layout {
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
            margin-bottom: 7px;
            color: white;
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .employee-label {
            padding: 0 11px;
            margin-bottom: 31px;
            color: #8ca5b6;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
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

        .employee-info {
            padding: 0 11px 16px;
        }

        .employee-info strong {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .employee-info span {
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

        .employee-badge {
            padding: 7px 11px;
            border: 1px solid #cbdce7;
            border-radius: 5px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 10px;
            font-weight: bold;
        }

        .content {
            max-width: 1250px;
            margin: auto;
            padding: 30px;
        }

        .welcome {
            position: relative;
            margin-bottom: 22px;
            padding: 27px 29px;
            overflow: hidden;
            border-radius: 11px;
            background:
                linear-gradient(
                    120deg,
                    var(--primary-dark),
                    var(--primary)
                );
            color: white;
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 210px;
            height: 210px;
            top: -110px;
            right: -65px;
            border: 35px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
        }

        .welcome-small {
            margin-bottom: 8px;
            color: #a9c5d8;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .welcome h1 {
            margin-bottom: 8px;
            font-size: 25px;
            line-height: 1.3;
        }

        .welcome h1 span {
            color: var(--secondary);
        }

        .welcome p {
            max-width: 650px;
            color: #d5e2eb;
            font-size: 11px;
            line-height: 1.7;
        }

        .section-heading {
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-line {
            width: 4px;
            height: 23px;
            border-radius: 10px;
            background: var(--secondary);
        }

        .section-heading h2 {
            color: var(--primary-dark);
            font-size: 16px;
        }

        .function-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .function-card {
            min-height: 190px;
            padding: 21px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
            color: var(--text);
            transition: 0.2s;
            display: flex;
            flex-direction: column;
        }

        a.function-card:hover {
            transform: translateY(-2px);
            border-color: #c8d9e5;
            box-shadow: 0 7px 20px rgba(20, 45, 65, 0.08);
        }

        .function-top {
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }

        .function-icon {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .function-icon svg {
            width: 21px;
            height: 21px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.7;
        }

        .function-status {
            padding: 5px 8px;
            border-radius: 4px;
            background: #edf8f2;
            color: #17643d;
            font-size: 8px;
            font-weight: bold;
        }

        .function-card h3 {
            margin-bottom: 8px;
            color: var(--primary);
            font-size: 16px;
        }

        .function-card p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.65;
        }

        .function-footer {
            margin-top: auto;
            padding-top: 18px;
            color: var(--primary);
            font-size: 9px;
            font-weight: bold;
        }

        .workflow {
            margin-top: 22px;
            padding: 21px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
        }

        .workflow h3 {
            margin-bottom: 17px;
            color: var(--primary);
            font-size: 14px;
        }

        .workflow-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
        }

        .workflow-step {
            position: relative;
            padding: 13px 16px;
            text-align: center;
        }

        .workflow-step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 22px;
            right: -12px;
            width: 24px;
            height: 1px;
            background: #cbd5dc;
        }

        .step-number {
            width: 30px;
            height: 30px;
            margin: 0 auto 9px;
            border: 1px solid #c9d9e4;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
        }

        .workflow-step strong {
            display: block;
            margin-bottom: 5px;
            color: #425563;
            font-size: 9px;
        }

        .workflow-step span {
            color: var(--muted);
            font-size: 8px;
            line-height: 1.5;
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

        @media (max-width: 1050px) {
            .function-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .employee-layout {
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

        @media (max-width: 750px) {
            .workflow-grid {
                grid-template-columns: 1fr;
            }

            .workflow-step:not(:last-child)::after {
                display: none;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .topbar {
                height: auto;
                padding: 16px;
                gap: 15px;
                align-items: flex-start;
                flex-direction: column;
            }

            .menu {
                grid-template-columns: 1fr;
            }

            .welcome {
                padding: 24px 20px;
            }

            .footer {
                gap: 8px;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="employee-layout">

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

        <nav class="menu">

            <a
                href="{{ route('nhanvien.trang-chu') }}"
                class="menu-link active"
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
                href="{{ route('nhanvien.tickets.index') }}"
                class="menu-link"
            >

                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 5h16v14H4z"/>
                        <path d="M8 9h8"/>
                        <path d="M8 13h5"/>
                    </svg>
                </span>

                Tra cứu vé

            </a>

            <a
                href="{{ route('nhanvien.passengers.unchecked') }}"
                class="menu-link"
            >

                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                        <path d="M16 11a4 4 0 0 1 5 4"/>
                    </svg>
                </span>

                Hành khách chưa kiểm tra

            </a>

            <a
                href="{{ route('nhanvien.flights.index') }}"
                class="menu-link"
            >

                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                    </svg>
                </span>

                Danh sách chuyến bay

            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="employee-info">

                <strong>
                    {{ auth()->user()->name }}
                </strong>

                <span>
                    Nhân viên sân bay
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
                    SkyGo Airport Operations
                </h2>

                <p>
                    Hệ thống hỗ trợ nghiệp vụ nhân viên sân bay
                </p>

            </div>

            <span class="employee-badge">
                NHÂN VIÊN
            </span>

        </header>

        <div class="content">

            <section class="welcome">

                <div class="welcome-content">

                    <div class="welcome-small">
                        Khu vực nghiệp vụ
                    </div>

                    <h1>
                        Xin chào,
                        <span>
                            {{ auth()->user()->name }}
                        </span>
                    </h1>

                    <p>
                        Tra cứu vé, kiểm tra thông tin hành khách,
                        nhận diện khuôn mặt, theo dõi chuyến bay
                        và xác nhận hành khách trước khi lên máy bay.
                    </p>

                </div>

            </section>

            <div class="section-heading">

                <div class="section-line"></div>

                <h2>
                    Chức năng nghiệp vụ
                </h2>

            </div>

            <div class="function-grid">

                <a
                    href="{{ route('nhanvien.tickets.index') }}"
                    class="function-card"
                >

                    <div class="function-top">

                        <div class="function-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 5h16v14H4z"/>
                                <path d="M8 9h8"/>
                                <path d="M8 13h5"/>
                            </svg>
                        </div>

                        <span class="function-status">
                            Sẵn sàng
                        </span>

                    </div>

                    <h3>
                        Tra cứu vé
                    </h3>

                    <p>
                        Tìm kiếm theo mã vé, mã đặt vé,
                        tên hành khách hoặc thông tin giấy tờ
                        để kiểm tra chi tiết vé.
                    </p>

                    <div class="function-footer">
                        Mở tra cứu →
                    </div>

                </a>

                <a
                    href="{{ route('nhanvien.passengers.unchecked') }}"
                    class="function-card"
                >

                    <div class="function-top">

                        <div class="function-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="9" cy="8" r="4"/>
                                <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                                <path d="M16 11a4 4 0 0 1 5 4"/>
                            </svg>
                        </div>

                        <span class="function-status">
                            Sẵn sàng
                        </span>

                    </div>

                    <h3>
                        Hành khách chưa kiểm tra
                    </h3>

                    <p>
                        Xem hành khách chưa được xác nhận,
                        gửi nhắc nhở và thực hiện nhận diện
                        khuôn mặt trước khi xác nhận.
                    </p>

                    <div class="function-footer">
                        Xem hành khách →
                    </div>

                </a>

                <a
                    href="{{ route('nhanvien.flights.index') }}"
                    class="function-card"
                >

                    <div class="function-top">

                        <div class="function-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                            </svg>
                        </div>

                        <span class="function-status">
                            Sẵn sàng
                        </span>

                    </div>

                    <h3>
                        Danh sách chuyến bay
                    </h3>

                    <p>
                        Theo dõi thông tin chuyến bay,
                        thời gian khởi hành và danh sách
                        hành khách của từng chuyến.
                    </p>

                    <div class="function-footer">
                        Xem chuyến bay →
                    </div>

                </a>

            </div>

            <section class="workflow">

                <h3>
                    Quy trình kiểm tra hành khách
                </h3>

                <div class="workflow-grid">

                    <div class="workflow-step">

                        <div class="step-number">
                            1
                        </div>

                        <strong>
                            Tra cứu vé
                        </strong>

                        <span>
                            Kiểm tra vé và thông tin
                            chuyến bay của hành khách.
                        </span>

                    </div>

                    <div class="workflow-step">

                        <div class="step-number">
                            2
                        </div>

                        <strong>
                            Nhận diện khuôn mặt
                        </strong>

                        <span>
                            Chụp khuôn mặt và đối chiếu
                            với dữ liệu đã đăng ký.
                        </span>

                    </div>

                    <div class="workflow-step">

                        <div class="step-number">
                            3
                        </div>

                        <strong>
                            Xác nhận hành khách
                        </strong>

                        <span>
                            Hiển thị thông tin sau khi
                            nhận diện thành công.
                        </span>

                    </div>

                    <div class="workflow-step">

                        <div class="step-number">
                            4
                        </div>

                        <strong>
                            Hoàn tất kiểm tra
                        </strong>

                        <span>
                            Cập nhật trạng thái vé
                            sau khi nhân viên xác nhận.
                        </span>

                    </div>

                </div>

            </section>

            <footer class="footer">

                <span>
                    SkyGo Airport Operations
                </span>

                <span>
                    Khu vực nhân viên sân bay
                </span>

            </footer>

        </div>

    </main>

</div>

</body>

</html>