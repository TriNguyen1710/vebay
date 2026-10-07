<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sửa gói hành lý - Vietjet Admin</title>

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
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
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
            background: var(--white);
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
            width: min(880px, calc(100% - 40px));
            margin: 0 auto;
            padding: 32px 0 50px;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .breadcrumb {
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 11px;
        }

        .breadcrumb a {
            color: var(--primary);
            font-weight: bold;
        }

        .page-heading h1 {
            color: var(--primary-dark);
            font-size: 27px;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e8edf1;
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 16px;
            margin-bottom: 5px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 10px;
        }

        .card-body {
            padding: 24px;
        }

        .error {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid #f1aeb5;
            border-radius: 7px;
            background: #f8d7da;
            color: #842029;
            font-size: 12px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .full {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #465764;
            font-size: 11px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #cdd8df;
            border-radius: 6px;
            background: white;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.08);
        }

        .price-wrap {
            position: relative;
        }

        .price-wrap .form-control {
            padding-right: 55px;
        }

        .price-unit {
            position: absolute;
            right: 13px;
            bottom: 13px;
            color: var(--muted);
            font-size: 11px;
            font-weight: bold;
        }

        .info-box {
            margin-top: 20px;
            padding: 14px 16px;
            border-left: 3px solid var(--secondary);
            border-radius: 5px;
            background: #fff9df;
            color: #655819;
            font-size: 11px;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn {
            min-height: 40px;
            padding: 0 18px;
            border: 0;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: #e9eef2;
            color: #425361;
        }

        .btn-secondary:hover {
            background: #dde5ea;
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

            .menu {
                grid-template-columns: repeat(2, 1fr);
            }

            .main {
                margin-left: 0;
            }
        }

        @media (max-width: 650px) {
            .content {
                width: min(100% - 24px, 880px);
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .menu {
                grid-template-columns: 1fr;
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
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                    </svg>
                </span>
                Tổng quan
            </a>

            <a href="{{ route('admin.airports.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21h18"/>
                        <path d="M6 21V9l6-4 6 4v12"/>
                        <path d="M9 13h6"/>
                    </svg>
                </span>
                Quản lý sân bay
            </a>

            <a href="{{ route('admin.aircraft.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                    </svg>
                </span>
                Quản lý máy bay
            </a>

            <a href="{{ route('admin.flights.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M8 3v4M16 3v4M3 10h18"/>
                    </svg>
                </span>
                Quản lý chuyến bay
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z"/>
                        <path d="M8 8h8M8 12h8M8 16h5"/>
                    </svg>
                </span>
                Quản lý vé
            </a>

            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                        <path d="M16 11a4 4 0 0 1 5 4"/>
                    </svg>
                </span>
                Quản lý người dùng
            </a>

            <a href="{{ route('admin.baggage.index') }}" class="menu-link active">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="7" width="14" height="13" rx="2"/>
                        <path d="M9 7V5a3 3 0 0 1 6 0v2"/>
                        <path d="M8 11h8"/>
                    </svg>
                </span>
                Quản lý hành lý
            </a>

            <a href="{{ route('admin.statistics.index') }}" class="menu-link">
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

            <a href="{{ route('admin.settings.edit') }}" class="menu-link">
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

            <a href="{{ route('admin.refund-settings.edit') }}" class="menu-link">
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
                <p>Quản lý hành lý và các gói hành lý ký gửi</p>
            </div>

            <span class="admin-badge">
                ADMIN
            </span>

        </header>

        <div class="content">

            <div class="page-heading">

                <div class="breadcrumb">

                    <a href="{{ route('admin.trang-chu') }}">
                        Trang quản trị
                    </a>

                    /

                    <a href="{{ route('admin.baggage.index') }}">
                        Hành lý
                    </a>

                    /

                    Sửa gói

                </div>

                <h1>Sửa gói hành lý ký gửi</h1>

                <p>
                    Cập nhật thông tin gói hành lý mà khách hàng có thể mua thêm.
                </p>

            </div>

            <section class="card">

                <div class="card-header">

                    <h2>{{ $baggagePackage->name }}</h2>

                    <p>
                        Thay đổi khối lượng, giá tiền hoặc trạng thái của gói hành lý.
                    </p>

                </div>

                <div class="card-body">

                    @if($errors->any())

                        <div class="error">

                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach

                        </div>

                    @endif

                    <form
                        action="{{ route('admin.baggage.checked.update', $baggagePackage) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="form-grid">

                            <div class="form-group full">

                                <label for="name">
                                    Tên gói hành lý
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name', $baggagePackage->name) }}"
                                    maxlength="255"
                                    required
                                >

                            </div>

                            <div class="form-group">

                                <label for="weight">
                                    Khối lượng
                                </label>

                                <input
                                    type="number"
                                    id="weight"
                                    name="weight"
                                    class="form-control"
                                    value="{{ old('weight', $baggagePackage->weight) }}"
                                    min="1"
                                    max="100"
                                    required
                                >

                            </div>

                            <div class="form-group price-wrap">

                                <label for="price">
                                    Giá gói hành lý
                                </label>

                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    class="form-control"
                                    value="{{ old('price', $baggagePackage->price) }}"
                                    min="0"
                                    step="1000"
                                    required
                                >

                                <span class="price-unit">
                                    VNĐ
                                </span>

                            </div>

                            <div class="form-group full">

                                <label for="status">
                                    Trạng thái
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="form-control"
                                    required
                                >

                                    <option
                                        value="1"
                                        @selected((string) old('status', $baggagePackage->status) === '1')
                                    >
                                        Bật - Khách hàng có thể chọn gói này
                                    </option>

                                    <option
                                        value="0"
                                        @selected((string) old('status', $baggagePackage->status) === '0')
                                    >
                                        Tắt - Không hiển thị cho khách hàng
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="info-box">
                            Việc thay đổi giá gói hành lý chỉ áp dụng cho các lượt đặt vé mới.
                            Giá hành lý đã lưu trên vé cũ sẽ không bị thay đổi.
                        </div>

                        <div class="actions">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Lưu thay đổi
                            </button>

                            <a
                                href="{{ route('admin.baggage.index') }}"
                                class="btn btn-secondary"
                            >
                                Hủy
                            </a>

                        </div>

                    </form>

                </div>

            </section>

        </div>

    </main>

</div>

</body>

</html>