<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sửa máy bay - SkyGo Admin</title>

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

        button,
        input,
        select {
            font-family: inherit;
        }

        /* ================================
           LAYOUT
        ================================= */

        .admin-layout {
            min-height: 100vh;

            display: grid;
            grid-template-columns: 245px 1fr;
        }

        /* ================================
           SIDEBAR
        ================================= */

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

        /* ================================
           SIDEBAR BOTTOM
        ================================= */

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

        /* ================================
           MAIN
        ================================= */

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

        /* ================================
           CONTENT
        ================================= */

        .content {
            max-width: 1250px;

            margin: auto;

            padding: 30px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;

            margin-bottom: 22px;
        }

        .page-heading h1 {
            font-size: 24px;
            color: var(--text);

            margin-bottom: 6px;
        }

        .page-heading p {
            font-size: 11px;
            color: var(--muted);
        }

        .back-btn {
            min-height: 38px;

            padding: 0 15px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--border);
            border-radius: 6px;

            background: white;

            color: var(--primary);

            font-size: 11px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #f7f9fb;
        }

        /* ================================
           FORM CARD
        ================================= */

        .form-card {
            max-width: 920px;

            margin: auto;

            background: white;

            border: 1px solid var(--border);
            border-radius: 12px;

            box-shadow:
                0 6px 24px rgba(20, 45, 65, 0.07);

            overflow: hidden;
        }

        .form-header {
            padding: 24px 28px 20px;

            border-bottom: 1px solid #e8edf1;
        }

        .form-accent {
            width: 44px;
            height: 4px;

            margin-bottom: 13px;

            border-radius: 10px;

            background: var(--secondary);
        }

        .form-header h2 {
            color: var(--primary);

            font-size: 19px;

            margin-bottom: 6px;
        }

        .form-header p {
            color: var(--muted);

            font-size: 10px;
            line-height: 1.6;
        }

        .form-body {
            padding: 28px;
        }

        /* ================================
           CURRENT AIRCRAFT
        ================================= */

        .current-aircraft {
            margin-bottom: 22px;

            padding: 14px 16px;

            border: 1px solid #d4e4ee;
            border-left: 4px solid var(--primary);

            border-radius: 7px;

            background: var(--primary-light);

            color: #526b7a;

            font-size: 10px;
            line-height: 1.6;
        }

        .current-aircraft strong {
            color: var(--primary);
        }

        /* ================================
           ERROR
        ================================= */

        .error-box {
            margin-bottom: 22px;

            padding: 13px 15px;

            border-radius: 7px;

            background: #fff2f3;

            border: 1px solid #f0c1c6;
            border-left: 4px solid var(--danger);

            color: #8b2732;

            font-size: 11px;
            line-height: 1.7;
        }

        .error-box strong {
            display: block;
            margin-bottom: 5px;
        }

        /* ================================
           FORM
        ================================= */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 19px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            color: #425361;

            font-size: 11px;
            font-weight: bold;
        }

        .required {
            color: var(--danger);
        }

        input,
        select {
            width: 100%;
            height: 45px;

            padding: 0 13px;

            border: 1px solid #d5dee5;
            border-radius: 7px;

            background: white;
            color: #344653;

            font-size: 12px;

            transition: 0.2s;
        }

        input:focus,
        select:focus {
            outline: none;

            border-color: var(--primary);

            box-shadow:
                0 0 0 3px rgba(0, 59, 112, 0.07);
        }

        .field-note {
            margin-top: 6px;

            color: #929ca4;

            font-size: 9px;
            line-height: 1.5;
        }

        /* ================================
           SEAT CONFIG
        ================================= */

        .seat-config {
            grid-column: 1 / -1;

            padding: 18px;

            border: 1px solid #e2e8ed;
            border-radius: 8px;

            background: #f9fbfc;
        }

        .seat-config-title {
            margin-bottom: 17px;

            color: var(--primary);

            font-size: 11px;
            font-weight: 800;
        }

        .seat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 18px;
        }

        /* ================================
           STATUS
        ================================= */

        .status-box {
            grid-column: 1 / -1;

            padding: 17px;

            border: 1px solid #e2e8ed;
            border-radius: 8px;

            background: #f9fbfc;
        }

        /* ================================
           TOTAL PREVIEW
        ================================= */

        .preview {
            margin-top: 22px;

            padding: 16px 18px;

            border: 1px solid #d5e4ee;
            border-radius: 8px;

            background: var(--primary-light);

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;
        }

        .preview-text strong {
            display: block;

            color: var(--primary);

            font-size: 11px;

            margin-bottom: 4px;
        }

        .preview-text span {
            color: var(--muted);
            font-size: 9px;
        }

        .preview-total {
            color: var(--primary-dark);

            font-size: 22px;
            font-weight: 800;
        }

        .preview-total small {
            color: var(--muted);

            font-size: 9px;
            font-weight: 600;
        }

        /* ================================
           WARNING
        ================================= */

        .seat-warning {
            margin-top: 13px;

            padding: 11px 13px;

            border-radius: 6px;

            background: #fff9e7;

            border: 1px solid #ecd997;

            color: #75600e;

            font-size: 9px;
            line-height: 1.6;
        }

        /* ================================
           ACTIONS
        ================================= */

        .form-actions {
            margin-top: 28px;

            padding-top: 22px;

            border-top: 1px solid #e8edf1;

            display: flex;
            justify-content: flex-end;
            align-items: center;

            gap: 10px;
        }

        .cancel-btn {
            min-height: 42px;

            padding: 0 18px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--border);
            border-radius: 6px;

            background: white;

            color: #596874;

            font-size: 11px;
            font-weight: bold;
        }

        .cancel-btn:hover {
            background: #f6f8fa;
        }

        .save-btn {
            min-height: 42px;

            padding: 0 22px;

            border: none;
            border-radius: 6px;

            background: var(--secondary);

            color: var(--primary-dark);

            cursor: pointer;

            font-size: 11px;
            font-weight: 800;
        }

        .save-btn:hover {
            background: #ffc31a;
        }

        /* ================================
           BOTTOM
        ================================= */

        .bottom-back {
            max-width: 920px;

            margin: 20px auto 0;
        }

        .bottom-back a {
            color: var(--primary);

            font-size: 11px;
            font-weight: bold;
        }

        .bottom-back a:hover {
            text-decoration: underline;
        }

        .footer {
            max-width: 920px;

            margin: 28px auto 0;

            padding-top: 18px;

            border-top: 1px solid var(--border);

            display: flex;
            justify-content: space-between;

            color: #919ca4;

            font-size: 9px;
        }

        /* ================================
           RESPONSIVE
        ================================= */

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
                padding: 20px 15px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .form-grid,
            .seat-grid {
                grid-template-columns: 1fr;
            }

            .seat-config,
            .status-box {
                grid-column: auto;
            }

            .preview {
                align-items: flex-start;
                flex-direction: column;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .cancel-btn,
            .save-btn {
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

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <a
            href="{{ route('admin.trang-chu') }}"
            class="logo"
        >
            Sky<span>Go</span>
        </a>


        <div class="menu-title">
            QUẢN LÝ HỆ THỐNG
        </div>


        <nav class="menu">

            <a
                href="{{ route('admin.trang-chu') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                    </svg>
                </span>

                Tổng quan
            </a>


            <a
                href="{{ route('admin.airports.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21h18" />
                        <path d="M6 21V9l6-4 6 4v12" />
                        <path d="M9 13h6" />
                    </svg>
                </span>

                Quản lý sân bay
            </a>


            <a
                href="{{ route('admin.aircraft.index') }}"
                class="menu-link active"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z" />
                    </svg>
                </span>

                Quản lý máy bay
            </a>


            <a
                href="{{ route('admin.flights.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        />
                        <path d="M8 3v4M16 3v4M3 10h18" />
                    </svg>
                </span>

                Quản lý chuyến bay
            </a>


            <a
                href="{{ route('admin.bookings.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z" />
                        <path d="M8 8h8M8 12h8M8 16h5" />
                    </svg>
                </span>

                Quản lý vé
            </a>


            <a
                href="{{ route('admin.users.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4" />
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2" />
                        <path d="M16 11a4 4 0 0 1 5 4" />
                    </svg>
                </span>

                Quản lý người dùng
            </a>


            <a
                href="{{ route('admin.statistics.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 20V10" />
                        <path d="M10 20V4" />
                        <path d="M16 20v-7" />
                        <path d="M22 20V7" />
                    </svg>
                </span>

                Thống kê chi tiết
            </a>

        </nav>


        <div class="sidebar-bottom">

            <div class="admin-info">

                <strong>
                    {{ auth()->user()->name }}
                </strong>

                <span>
                    Quản trị viên hệ thống
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


    {{-- MAIN --}}
    <main class="main">

        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    SkyGo Administration
                </h2>

                <p>
                    Quản lý thông tin máy bay
                </p>

            </div>


            <span class="admin-badge">
                ADMIN
            </span>

        </header>


        <div class="content">

            <div class="page-heading">

                <div>

                    <h1>
                        Chỉnh sửa máy bay
                    </h1>

                    <p>
                        Cập nhật thông tin và cấu hình
                        máy bay trong hệ thống.
                    </p>

                </div>


                <a
                    href="{{ route('admin.aircraft.index') }}"
                    class="back-btn"
                >
                    ← Quay lại danh sách
                </a>

            </div>


            <section class="form-card">

                <div class="form-header">

                    <div class="form-accent"></div>

                    <h2>
                        Thông tin máy bay
                    </h2>

                    <p>
                        Chỉnh sửa các thông tin cần thay đổi
                        và nhấn cập nhật để lưu.
                    </p>

                </div>


                <div class="form-body">

                    <div class="current-aircraft">

                        Đang chỉnh sửa:

                        <strong>
                            {{ $aircraft->code }}
                            -
                            {{ $aircraft->name }}
                        </strong>

                    </div>


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


                    <form
                        action="{{ route(
                            'admin.aircraft.update',
                            $aircraft->id
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <div class="form-grid">

                            {{-- MÃ MÁY BAY --}}
                            <div class="form-group">

                                <label for="code">
                                    Mã máy bay
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="code"
                                    name="code"

                                    value="{{ old(
                                        'code',
                                        $aircraft->code
                                    ) }}"

                                    required
                                >

                                <div class="field-note">
                                    Mã dùng để nhận diện máy bay trong hệ thống.
                                </div>

                            </div>


                            {{-- TÊN / LOẠI --}}
                            <div class="form-group">

                                <label for="name">
                                    Tên / loại máy bay
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"

                                    value="{{ old(
                                        'name',
                                        $aircraft->name
                                    ) }}"

                                    required
                                >

                                <div class="field-note">
                                    Ví dụ: Airbus A321 hoặc Boeing 787.
                                </div>

                            </div>


                            {{-- CẤU HÌNH GHẾ --}}
                            <div class="seat-config">

                                <div class="seat-config-title">
                                    Cấu hình ghế
                                </div>


                                <div class="seat-grid">

                                    <div class="form-group">

                                        <label for="rows">
                                            Số hàng ghế
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="number"
                                            id="rows"
                                            name="rows"

                                            value="{{ old(
                                                'rows',
                                                $aircraft->rows
                                            ) }}"

                                            min="1"

                                            required
                                        >

                                    </div>


                                    <div class="form-group">

                                        <label for="seats_per_row">
                                            Số ghế mỗi hàng
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="number"
                                            id="seats_per_row"
                                            name="seats_per_row"

                                            value="{{ old(
                                                'seats_per_row',
                                                $aircraft->seats_per_row
                                            ) }}"

                                            min="1"
                                            max="10"

                                            required
                                        >

                                        <div class="field-note">
                                            6 ghế/hàng tương ứng A, B, C, D, E, F.
                                        </div>

                                    </div>

                                </div>


                                <div class="seat-warning">
                                    Khi thay đổi số hàng hoặc số ghế mỗi hàng,
                                    cấu hình tổng số ghế của máy bay cũng sẽ thay đổi.
                                </div>

                            </div>


                            {{-- TRẠNG THÁI --}}
                            <div class="status-box">

                                <label for="status">
                                    Trạng thái hoạt động
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                >

                                    <option
                                        value="1"

                                        {{ old(
                                            'status',
                                            $aircraft->status
                                        ) == 1 ? 'selected' : '' }}
                                    >
                                        Hoạt động
                                    </option>


                                    <option
                                        value="0"

                                        {{ old(
                                            'status',
                                            $aircraft->status
                                        ) == 0 ? 'selected' : '' }}
                                    >
                                        Ngừng hoạt động
                                    </option>

                                </select>


                                <div class="field-note">
                                    Máy bay đang hoạt động có thể
                                    được sử dụng khi tạo chuyến bay.
                                </div>

                            </div>

                        </div>


                        {{-- TOTAL PREVIEW --}}
                        <div class="preview">

                            <div class="preview-text">

                                <strong>
                                    Tổng số ghế sau khi cập nhật
                                </strong>

                                <span>
                                    Số hàng ghế × số ghế mỗi hàng.
                                </span>

                            </div>


                            <div class="preview-total">

                                <span id="totalSeatsPreview">
                                    {{ $aircraft->rows * $aircraft->seats_per_row }}
                                </span>

                                <small>
                                    ghế
                                </small>

                            </div>

                        </div>


                        <div class="form-actions">

                            <a
                                href="{{ route('admin.aircraft.index') }}"
                                class="cancel-btn"
                            >
                                Hủy
                            </a>


                            <button
                                type="submit"
                                class="save-btn"
                            >
                                Cập nhật máy bay
                            </button>

                        </div>

                    </form>

                </div>

            </section>


            <div class="bottom-back">

                <a href="{{ route('admin.aircraft.index') }}">
                    ← Quay lại quản lý máy bay
                </a>

            </div>


            <footer class="footer">

                <span>
                    SkyGo Administration
                </span>

                <span>
                    Chỉnh sửa máy bay
                </span>

            </footer>

        </div>

    </main>

</div>


<script>

    const rowsInput =
        document.getElementById('rows');

    const seatsPerRowInput =
        document.getElementById('seats_per_row');

    const totalSeatsPreview =
        document.getElementById('totalSeatsPreview');


    function updateTotalSeats() {

        const rows =
            parseInt(rowsInput.value) || 0;

        const seatsPerRow =
            parseInt(seatsPerRowInput.value) || 0;

        totalSeatsPreview.textContent =
            rows * seatsPerRow;

    }


    rowsInput.addEventListener(
        'input',
        updateTotalSeats
    );


    seatsPerRowInput.addEventListener(
        'input',
        updateTotalSeats
    );


    updateTotalSeats();

</script>

</body>

</html>