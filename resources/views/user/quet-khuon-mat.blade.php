<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quét khuôn mặt - Vietjet</title>

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
            --danger: #dc3545;
            --success: #198754;
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
            align-items: center;
            justify-content: space-between;
        }

        .top-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a {
            color: white;
        }

        .header {
            background: white;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
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

        .page-banner {
            min-height: 225px;
            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, 0.94),
                    rgba(0, 59, 112, 0.53)
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

        .main {
            max-width: 1100px;
            margin: -48px auto 70px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }

        .step {
            display: flex;
            align-items: center;
        }

        .step-number {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #dce3e9;
            color: #66717b;
            font-size: 12px;
            font-weight: bold;
        }

        .step.done .step-number {
            background: #176a53;
            color: white;
        }

        .step.active .step-number {
            background: var(--primary);
            color: white;
        }

        .step-text {
            margin-left: 7px;
            color: #737d86;
            font-size: 11px;
            font-weight: bold;
        }

        .step.active .step-text {
            color: var(--primary);
        }

        .step-line {
            width: 50px;
            height: 1px;
            margin: 0 12px;
            background: #ccd4db;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 22px;
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 7px 28px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .summary-header {
            padding: 21px 22px;
            background: var(--primary);
            color: white;
        }

        .summary-header h2 {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .summary-header p {
            color: #d8e5ef;
            font-size: 12px;
            line-height: 1.5;
        }

        .summary-body {
            padding: 21px 22px;
        }

        .summary-section {
            padding-bottom: 19px;
            margin-bottom: 19px;
            border-bottom: 1px solid #e8edf1;
        }

        .summary-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .summary-title {
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-bottom: 14px;
        }

        .summary-row {
            margin-bottom: 13px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .summary-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 3px;
        }

        .summary-value {
            color: #263746;
            font-size: 13px;
            font-weight: bold;
            line-height: 1.4;
        }

        .seat-badge {
            display: inline-block;
            min-width: 42px;
            padding: 6px 10px;
            background: #edf5fb;
            color: var(--primary);
            border: 1px solid #c8dce9;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            font-weight: 800;
        }

        .face-header {
            padding: 24px 26px 20px;
            border-bottom: 1px solid #e8edf1;
        }

        .face-header h2 {
            color: var(--primary);
            font-size: 21px;
            margin-bottom: 5px;
        }

        .face-header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .face-body {
            padding: 27px;
        }

        .scanner {
            max-width: 470px;
            aspect-ratio: 4 / 3;
            margin: 0 auto 22px;
            background: #111820;
            border: 1px solid #cbd4dc;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .scanner video,
        .scanner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transform: scaleX(-1);
        }

        .scanner img {
            display: none;
        }

        .scanner::before,
        .scanner::after {
            content: "";
            position: absolute;
            width: 48px;
            height: 48px;
            z-index: 4;
            pointer-events: none;
        }

        .scanner::before {
            top: 18px;
            left: 18px;
            border-top: 3px solid var(--secondary);
            border-left: 3px solid var(--secondary);
        }

        .scanner::after {
            right: 18px;
            bottom: 18px;
            border-right: 3px solid var(--secondary);
            border-bottom: 3px solid var(--secondary);
        }

        .corner-top-right {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 48px;
            height: 48px;
            border-top: 3px solid var(--secondary);
            border-right: 3px solid var(--secondary);
            z-index: 4;
            pointer-events: none;
        }

        .corner-bottom-left {
            position: absolute;
            bottom: 18px;
            left: 18px;
            width: 48px;
            height: 48px;
            border-bottom: 3px solid var(--secondary);
            border-left: 3px solid var(--secondary);
            z-index: 4;
            pointer-events: none;
        }

        .face-guide {
            position: absolute;
            width: 42%;
            height: 68%;
            left: 29%;
            top: 12%;
            border: 2px solid rgba(255, 255, 255, 0.9);
            border-radius: 48%;
            z-index: 3;
            pointer-events: none;
        }

        .scanner-status {
            position: absolute;
            bottom: 14px;
            left: 50%;
            transform: translateX(-50%);
            padding: 7px 11px;
            background: rgba(0, 41, 79, 0.88);
            color: white;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
            z-index: 5;
        }

        .camera-error {
            display: none;
            padding: 13px 15px;
            margin-bottom: 18px;
            background: #fdebed;
            border: 1px solid #efbec4;
            color: #842029;
            font-size: 13px;
            line-height: 1.5;
        }

        .success-box {
            display: none;
            padding: 13px 15px;
            margin-bottom: 18px;
            background: #eaf7f0;
            border: 1px solid #b8dfc8;
            color: #146c43;
            font-size: 13px;
            line-height: 1.5;
        }

        .guide {
            margin-bottom: 22px;
        }

        .guide-title {
            color: #374151;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .guide-item {
            padding: 12px;
            background: #f8fafc;
            border: 1px solid #e4e9ee;
            text-align: center;
        }

        .guide-number {
            width: 25px;
            height: 25px;
            margin: 0 auto 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-size: 10px;
            font-weight: bold;
        }

        .guide-item p {
            color: #65717c;
            font-size: 10px;
            line-height: 1.4;
        }

        .error {
            padding: 13px 15px;
            margin-bottom: 20px;
            background: #fdebed;
            border: 1px solid #efbec4;
            color: #842029;
            font-size: 13px;
        }

        .action-area {
            padding-top: 20px;
            border-top: 1px solid #e8edf1;
        }

        .button-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .camera-button,
        .confirm-button,
        .retake-button,
        .continue-button {
            width: 100%;
            border: none;
            border-radius: 6px;
            padding: 14px 18px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .camera-button {
            background: var(--primary);
            color: white;
        }

        .camera-button:hover {
            background: var(--primary-dark);
        }

        .retake-button {
            display: none;
            background: #e9eef3;
            color: var(--primary);
        }

        .confirm-button {
            display: none;
            background: var(--success);
            color: white;
        }

        .continue-button {
            background: var(--primary);
            color: white;
        }

        .verification-info {
            display: none;
            padding: 13px 15px;
            margin-bottom: 18px;
            background: #edf5ff;
            border: 1px solid #bfd6f0;
            color: #174a7e;
            font-size: 13px;
            line-height: 1.5;
        }

        .continue-button:disabled,
        .retake-button:disabled,
        .confirm-button:disabled,
        .camera-button:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        .action-note {
            margin-top: 10px;
            color: #8b949c;
            font-size: 11px;
            line-height: 1.5;
            text-align: center;
        }

        .back-area {
            margin-top: 20px;
        }

        .back-button {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

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

        @media (max-width: 850px) {
            .nav-menu {
                display: none;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
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

            .steps {
                display: none;
            }

            .guide-grid,
            .button-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="top-bar-inner">
        <div class="top-group">
            <span>Website đặt vé máy bay trực tuyến</span>
            <span>Hỗ trợ: 1900 6868</span>
        </div>

        <div class="top-group">
            @auth
                <a href="{{ route('profile.edit') }}">Thông tin cá nhân</a>
                <a href="{{ route('notifications.index') }}">Thông báo</a>
            @endauth
            <span>Tiếng Việt</span>
        </div>
    </div>
</div>

<header class="header">
    <nav class="navbar">
        <a href="{{ route('trang-chu') }}" class="logo">
            Viet<span>jet</span>
        </a>

        <div class="nav-menu">
            <a href="{{ route('trang-chu') }}" class="nav-link">
                Trang chủ
            </a>

            <a href="{{ route('flights.search.form') }}" class="nav-link active">
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
        </div>

        <div class="nav-actions">
            @auth
                <span class="user-name">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('dang-xuat') }}" method="POST">
                    @csrf

                    <button type="submit" class="logout-btn">
                        Đăng xuất
                    </button>
                </form>
            @endauth
        </div>
    </nav>
</header>

<section class="page-banner">
    <div class="banner-inner">
        <div class="breadcrumb">
            <a href="{{ route('trang-chu') }}">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('flights.search.form') }}">Đặt vé</a>
            <span>/</span>
            <span>Quét khuôn mặt</span>
        </div>

        <h1>Quét khuôn mặt</h1>

        <p>
            Đối chiếu khuôn mặt với ảnh CCCD trước khi tiếp tục đặt vé.
        </p>
    </div>
</section>

<main class="main">
    <div class="steps">
        <div class="step done">
            <div class="step-number">1</div>
            <div class="step-text">Chọn chuyến</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">2</div>
            <div class="step-text">Chọn ghế</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">3</div>
            <div class="step-text">Hành khách</div>
        </div>

        <div class="step-line"></div>

        <div class="step active">
            <div class="step-number">4</div>
            <div class="step-text">Khuôn mặt</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
            <div class="step-number">5</div>
            <div class="step-text">Thanh toán</div>
        </div>
    </div>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="content-grid">
        <aside class="card">
            <div class="summary-header">
                <h2>Thông tin đặt vé</h2>
                <p>Thông tin hành khách và chuyến bay hiện tại.</p>
            </div>

            <div class="summary-body">
                <div class="summary-section">
                    <div class="summary-title">Hành khách</div>

                    <div class="summary-row">
                        <span class="summary-label">Họ và tên</span>
                        <span class="summary-value">{{ $passenger['full_name'] }}</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Số CCCD</span>
                        <span class="summary-value">{{ $passenger['identity_number'] }}</span>
                    </div>
                </div>

                <div class="summary-section">
                    <div class="summary-title">
                        @if(($tripType ?? 'one_way') === 'round_trip')
                            Chuyến đi
                        @else
                            Chuyến bay
                        @endif
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Mã chuyến</span>
                        <span class="summary-value">{{ $flight->flight_code }}</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Hành trình</span>
                        <span class="summary-value">
                            {{ $flight->departureAirport->city }}
                            →
                            {{ $flight->arrivalAirport->city }}
                        </span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Ghế</span>
                        <span class="seat-badge">{{ $seat->seat_number }}</span>
                    </div>
                </div>

                @if(($tripType ?? 'one_way') === 'round_trip')
                    <div class="summary-section">
                        <div class="summary-title">Chuyến về</div>

                        <div class="summary-row">
                            <span class="summary-label">Mã chuyến</span>
                            <span class="summary-value">{{ $returnFlight->flight_code }}</span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">Hành trình</span>
                            <span class="summary-value">
                                {{ $returnFlight->departureAirport->city }}
                                →
                                {{ $returnFlight->arrivalAirport->city }}
                            </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">Ghế</span>
                            <span class="seat-badge">{{ $returnSeat->seat_number }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </aside>

        <section class="card">
            <div class="face-header">
                <h2>Xác thực khuôn mặt với CCCD</h2>

                <p>
                    Chụp ảnh rõ khuôn mặt, sau đó bấm xác thực để hệ thống
                    đối chiếu với ảnh mặt trước CCCD.
                </p>
            </div>

            <div class="face-body">
                <div
                    id="cameraError"
                    class="camera-error"
                    role="alert"
                ></div>

                <div
                    id="pendingBox"
                    class="verification-info"
                    role="status"
                    aria-live="polite"
                ></div>

                <div
                    id="successBox"
                    class="success-box"
                    role="status"
                    aria-live="polite"
                ></div>

                <div class="scanner">
                    <video id="video" autoplay playsinline muted></video>
                    <img id="preview" alt="Ảnh khuôn mặt đã chụp">
                    <canvas id="canvas" hidden></canvas>

                    <div class="corner-top-right"></div>
                    <div class="corner-bottom-left"></div>
                    <div class="face-guide"></div>

                    <div id="scannerStatus" class="scanner-status">
                        Đang khởi động camera...
                    </div>
                </div>

                <div class="guide">
                    <div class="guide-title">
                        Hướng dẫn chụp khuôn mặt
                    </div>

                    <div class="guide-grid">
                        <div class="guide-item">
                            <div class="guide-number">1</div>
                            <p>Đưa toàn bộ khuôn mặt vào giữa khung hướng dẫn.</p>
                        </div>

                        <div class="guide-item">
                            <div class="guide-number">2</div>
                            <p>Nhìn thẳng vào camera và giữ đầu ổn định.</p>
                        </div>

                        <div class="guide-item">
                            <div class="guide-number">3</div>
                            <p>Đảm bảo đủ ánh sáng và khuôn mặt không bị che.</p>
                        </div>
                    </div>
                </div>

                <form
                    id="faceForm"
                    action="{{ route('face.store') }}"
                    method="POST"
                >
                    @csrf

                    <input
                        type="hidden"
                        id="faceImage"
                        name="face_image"
                    >

                    <div class="action-area">
                        <div class="button-row">
                            <button
                                type="button"
                                id="captureButton"
                                class="camera-button"
                                disabled
                            >
                                Chụp khuôn mặt
                            </button>

                            <button
                                type="button"
                                id="retakeButton"
                                class="retake-button"
                            >
                                Chụp lại
                            </button>

                            <button
                                type="submit"
                                id="confirmButton"
                                class="confirm-button"
                            >
                                Xác thực khuôn mặt
                            </button>

                            <button
                                type="button"
                                id="continueButton"
                                class="continue-button"
                                data-url="{{ route('booking.confirm') }}"
                                disabled
                            >
                                Tiếp tục đặt vé
                            </button>
                        </div>

                        <p class="action-note">
                            Chỉ khi khuôn mặt khớp với CCCD,
                            nút “Tiếp tục đặt vé” mới được bật.
                            Nếu chụp lại, bạn cần xác thực lại.
                        </p>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div class="back-area">
        <a
            href="{{ route('passenger.create') }}"
            class="back-button"
        >
            ← Quay lại thông tin hành khách
        </a>
    </div>
</main>

<footer>
    <div class="footer-logo">
        Viet<span>jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>
</footer>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const preview = document.getElementById('preview');
    const faceImage = document.getElementById('faceImage');
    const captureButton = document.getElementById('captureButton');
    const retakeButton = document.getElementById('retakeButton');
    const confirmButton = document.getElementById('confirmButton');
    const continueButton = document.getElementById('continueButton');
    const scannerStatus = document.getElementById('scannerStatus');
    const cameraError = document.getElementById('cameraError');
    const successBox = document.getElementById('successBox');
    const pendingBox = document.getElementById('pendingBox');
    const faceForm = document.getElementById('faceForm');

    let stream = null;
    let busy = false;
    let verified = false;

    function hideMessages() {
        cameraError.style.display = 'none';
        successBox.style.display = 'none';
        pendingBox.style.display = 'none';
    }

    function showError(message) {
        hideMessages();

        cameraError.textContent = message;
        cameraError.style.display = 'block';
    }

    function setBusy(value) {
        busy = value;

        retakeButton.disabled = value;
        confirmButton.disabled = value;
        continueButton.disabled = value || !verified;

        faceForm.setAttribute('aria-busy', String(value));
    }

    async function postFace(data) {
        const response = await fetch(faceForm.action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin',
            body: data
        });

        if (response.status === 419) {
            throw new Error(
                'Phiên làm việc đã hết hạn. Vui lòng tải lại trang.'
            );
        }

        const contentType = response.headers.get('content-type') || '';

        if (!contentType.includes('application/json')) {
            throw new Error(
                'Không nhận được kết quả xác thực. Vui lòng tải lại trang và kiểm tra đăng nhập.'
            );
        }

        const result = await response.json();

        if (!response.ok || result.success !== true) {
            const validationMessage = result.errors
                ? Object.values(result.errors).flat()[0]
                : null;

            throw new Error(
                validationMessage
                || result.message
                || 'Xác thực chưa thành công. Vui lòng thử lại.'
            );
        }

        return result;
    }

    async function startCamera() {
        hideMessages();

        scannerStatus.textContent = 'Đang khởi động camera...';
        captureButton.disabled = true;

        try {
            if (
                !navigator.mediaDevices
                || !navigator.mediaDevices.getUserMedia
            ) {
                throw new Error(
                    'Trình duyệt không hỗ trợ truy cập camera.'
                );
            }

            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: 'user',
                    width: {
                        ideal: 1280
                    },
                    height: {
                        ideal: 960
                    }
                },
                audio: false
            });

            video.srcObject = stream;

            await video.play();

            scannerStatus.textContent = 'Camera đã sẵn sàng';
            captureButton.disabled = false;
        } catch (error) {
            stopCamera();

            scannerStatus.textContent = 'Không thể mở camera';

            showError(
                'Không thể truy cập camera. Hãy cho phép trình duyệt sử dụng camera rồi tải lại trang.'
            );
        }
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(function (track) {
                track.stop();
            });

            stream = null;
        }
    }

    captureButton.addEventListener('click', function () {
        if (busy) {
            return;
        }

        if (
            !stream
            || video.videoWidth === 0
            || video.videoHeight === 0
        ) {
            showError(
                'Camera chưa sẵn sàng. Vui lòng thử lại.'
            );

            return;
        }

        const maxWidth = 960;
        const ratio = video.videoHeight / video.videoWidth;
        const width = Math.min(video.videoWidth, maxWidth);
        const height = Math.round(width * ratio);

        canvas.width = width;
        canvas.height = height;

        const context = canvas.getContext('2d');

        context.save();
        context.translate(width, 0);
        context.scale(-1, 1);
        context.drawImage(video, 0, 0, width, height);
        context.restore();

        const imageData = canvas.toDataURL('image/jpeg', 0.9);

        faceImage.value = imageData;
        preview.src = imageData;

        verified = false;
        continueButton.disabled = true;

        video.style.display = 'none';
        preview.style.display = 'block';

        captureButton.style.display = 'none';
        retakeButton.style.display = 'block';
        confirmButton.style.display = 'block';
        confirmButton.disabled = false;

        hideMessages();

        pendingBox.textContent =
            'Đã chụp ảnh. Hãy bấm “Xác thực khuôn mặt” để đối chiếu với CCCD.';

        pendingBox.style.display = 'block';

        scannerStatus.textContent =
            'Đã chụp ảnh, chưa xác thực';

        stopCamera();
    });

    retakeButton.addEventListener('click', async function () {
        if (busy) {
            return;
        }

        verified = false;

        setBusy(true);
        hideMessages();

        scannerStatus.textContent =
            'Đang chuẩn bị chụp lại...';

        try {
            const data = new FormData(faceForm);

            data.delete('face_image');
            data.set('action', 'reset');

            await postFace(data);

            faceImage.value = '';

            preview.removeAttribute('src');
            preview.style.display = 'none';
            video.style.display = 'block';

            retakeButton.style.display = 'none';
            confirmButton.style.display = 'none';
            captureButton.style.display = 'block';

            await startCamera();
        } catch (error) {
            showError(
                error.message
                || 'Chưa thể chụp lại. Vui lòng thử lại.'
            );

            scannerStatus.textContent =
                'Chưa thể chụp lại';
        } finally {
            setBusy(false);
        }
    });

    faceForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        if (busy) {
            return;
        }

        verified = false;
        continueButton.disabled = true;

        if (!faceImage.value) {
            showError(
                'Vui lòng chụp khuôn mặt trước khi xác thực.'
            );

            return;
        }

        setBusy(true);
        hideMessages();

        pendingBox.textContent =
            'Đang đối chiếu khuôn mặt với CCCD. Vui lòng chờ...';

        pendingBox.style.display = 'block';

        scannerStatus.textContent =
            'Đang đối chiếu với CCCD...';

        confirmButton.textContent =
            'Đang xác thực...';

        try {
            const result = await postFace(
                new FormData(faceForm)
            );

            if (result.matched !== true) {
                throw new Error(
                    'Khuôn mặt chưa được xác nhận khớp với CCCD. Vui lòng chụp lại.'
                );
            }

            verified = true;

            hideMessages();

            successBox.textContent = result.message;
            successBox.style.display = 'block';

            scannerStatus.textContent =
                'Xác thực CCCD thành công';

            confirmButton.style.display = 'none';
        } catch (error) {
            verified = false;

            showError(
                error.message
                || 'Không thể kết nối để xác thực. Vui lòng thử lại.'
            );

            scannerStatus.textContent =
                'Xác thực chưa thành công';
        } finally {
            confirmButton.textContent =
                'Xác thực khuôn mặt';

            setBusy(false);
        }
    });

    continueButton.addEventListener('click', function () {
        if (busy || !verified) {
            return;
        }

        window.location.assign(
            continueButton.dataset.url
        );
    });

    window.addEventListener(
        'beforeunload',
        stopCamera
    );

    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });

    startCamera();
</script>

</body>
</html>