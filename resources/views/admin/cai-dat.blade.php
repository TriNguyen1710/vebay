<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đổi giá vé - Vietjet Admin</title>

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
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-info {
            padding: 0 11px 15px;
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
        }

        .main {
            grid-column: 2;
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

        .topbar h2 {
            margin-bottom: 3px;
            color: var(--primary);
            font-size: 19px;
        }

        .topbar p {
            color: var(--muted);
            font-size: 10px;
        }

        .admin-badge {
            padding: 7px 11px;
            border: 1px solid #cbdce7;
            border-radius: 5px;
            background: #edf5fb;
            color: var(--primary);
            font-size: 10px;
            font-weight: bold;
        }

        .content {
            max-width: 950px;
            margin: auto;
            padding: 30px;
        }

        .page-heading {
            margin-bottom: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .btn-back {
            min-height: 38px;
            padding: 0 15px;
            border: 1px solid var(--border);
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            background: white;
            color: var(--primary);
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 15px;
            border-radius: 6px;
            font-size: 11px;
        }

        .alert-success {
            background: #edf8f2;
            border: 1px solid #badfc9;
            color: #17643d;
        }

        .alert-error {
            background: #fff0f1;
            border: 1px solid #efc0c5;
            color: #a52a36;
        }

        .card {
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.05);
        }

        .card-header {
            padding: 19px 22px;
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
            padding: 24px 22px;
        }

        .current-fee {
            margin-bottom: 22px;
            padding: 15px 17px;
            border-left: 4px solid var(--secondary);
            border-radius: 5px;
            background: #f8fafc;
        }

        .current-fee span {
            display: block;
            margin-bottom: 5px;
            color: var(--muted);
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .current-fee strong {
            color: var(--primary);
            font-size: 21px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #435461;
            font-size: 11px;
            font-weight: bold;
        }

        .money-input {
            display: flex;
            width: 420px;
            max-width: 100%;
        }

        .money-input input {
            width: 100%;
            height: 44px;
            padding: 0 13px;
            border: 1px solid #ccd7df;
            border-right: none;
            border-radius: 6px 0 0 6px;
            outline: none;
            color: var(--text);
            font-size: 13px;
        }

        .money-input input:focus {
            border-color: var(--primary);
        }

        .money-unit {
            width: 55px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ccd7df;
            border-radius: 0 6px 6px 0;
            background: #f2f5f7;
            color: var(--primary);
            font-size: 12px;
            font-weight: bold;
        }

        .preview {
            margin-top: 8px;
            color: var(--muted);
            font-size: 10px;
        }

        .form-actions {
            padding-top: 18px;
            border-top: 1px solid #edf0f2;
            display: flex;
            gap: 9px;
        }

        .btn-save {
            min-height: 39px;
            padding: 0 18px;
            border: none;
            border-radius: 6px;
            background: var(--secondary);
            color: var(--primary-dark);
            cursor: pointer;
            font-size: 10px;
            font-weight: bold;
        }

        .btn-save:hover {
            background: #ffc31a;
        }

        .btn-cancel {
            min-height: 39px;
            padding: 0 18px;
            border: 1px solid var(--border);
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            background: white;
            color: #596a76;
            font-size: 10px;
            font-weight: bold;
        }

        .note {
            margin-top: 16px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
        }

        .bottom-back {
            display: inline-block;
            margin-top: 20px;
            color: var(--primary);
            font-size: 11px;
            font-weight: bold;
        }

        @media (max-width: 800px) {
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

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .content {
                padding: 20px 15px;
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
                    </svg>
                </span>
                Quản lý người dùng
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

            <a href="{{ route('admin.settings.edit') }}" class="menu-link active">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h10"/>
                        <path d="M18 7h2"/>
                        <circle cx="16" cy="7" r="2"/>
                        <path d="M4 12h2"/>
                        <path d="M10 12h10"/>
                        <circle cx="8" cy="12" r="2"/>
                    </svg>
                </span>
                Quản lý đổi giá vé
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

            <div>
                <h2>Vietjet Administration</h2>
                <p>Quản lý phí đổi chuyến bay</p>
            </div>

            <span class="admin-badge">
                ADMIN
            </span>

        </header>

        <div class="content">

            <div class="page-heading">

                <div>
                    <h1>Quản lý đổi giá vé</h1>
                    <p>
                        Thiết lập phí áp dụng khi khách hàng thực hiện đổi chuyến bay.
                    </p>
                </div>

                <a href="{{ route('admin.trang-chu') }}" class="btn-back">
                    ← Quay lại
                </a>

            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <section class="card">

                <div class="card-header">
                    <h2>Phí đổi vé</h2>
                    <p>
                        Khoản phí được cộng vào phần chênh lệch giá vé khi khách hàng đổi chuyến.
                    </p>
                </div>

                <div class="card-body">

                    <div class="current-fee">
                        <span>Phí đổi vé hiện tại</span>

                        <strong>
                            {{ number_format($changeTicketFee, 0, ',', '.') }} đ
                        </strong>
                    </div>

                    <form
                        action="{{ route('admin.settings.update') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="form-group">

                            <label for="change_ticket_fee">
                                Nhập mức phí mới
                            </label>

                            <div class="money-input">

                                <input
                                    type="number"
                                    id="change_ticket_fee"
                                    name="change_ticket_fee"
                                    min="0"
                                    step="1000"
                                    value="{{ old('change_ticket_fee', $changeTicketFee) }}"
                                    required
                                >

                                <div class="money-unit">
                                    đ
                                </div>

                            </div>

                            <div class="preview" id="feePreview"></div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn-save">
                                Lưu thay đổi
                            </button>

                            <a
                                href="{{ route('admin.trang-chu') }}"
                                class="btn-cancel"
                            >
                                Hủy
                            </a>

                        </div>

                    </form>

                    <p class="note">
                        Khi khách hàng đổi chuyến, hệ thống sẽ tính phần chênh lệch
                        giá vé và cộng thêm mức phí đổi vé được thiết lập tại đây.
                    </p>

                </div>

            </section>

            <a href="{{ route('admin.trang-chu') }}" class="bottom-back">
                ← Quay lại trang quản trị
            </a>

        </div>

    </main>

</div>

<script>
    const input = document.getElementById('change_ticket_fee');
    const preview = document.getElementById('feePreview');

    function updatePreview() {
        const value = Number(input.value || 0);

        preview.textContent =
            'Mức phí mới: ' +
            new Intl.NumberFormat('vi-VN').format(value) +
            ' đ';
    }

    input.addEventListener('input', updatePreview);
    updatePreview();
</script>

</body>
</html>