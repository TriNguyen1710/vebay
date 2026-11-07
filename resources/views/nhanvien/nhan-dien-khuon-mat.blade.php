
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nhận diện khuôn mặt - VietJet</title>

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
            --text: #22313f;
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

        .topbar {
            height: 68px;
            padding: 0 32px;
            background: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }

        .logo {
            color: white;
            font-size: 25px;
            font-weight: 800;
        }

        .logo span {
            color: var(--secondary);
        }

        .employee-label {
            font-size: 11px;
            font-weight: 700;
        }

        .container {
            width: min(100% - 40px, 1240px);
            margin: 0 auto;
            padding: 28px 0 50px;
        }

        .back-link {
            min-height: 38px;
            margin-bottom: 20px;
            padding: 0 15px;
            display: inline-flex;
            align-items: center;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: white;
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
        }

        .heading {
            margin-bottom: 24px;
        }

        .heading h1 {
            margin-bottom: 7px;
            color: var(--primary-dark);
            font-size: 27px;
        }

        .heading p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .alert {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.6;
        }

        .alert-success {
            background: #e9f7ef;
            border: 1px solid #b9dfc8;
            color: #17643d;
        }

        .alert-error {
            background: #fff0f1;
            border: 1px solid #efc0c5;
            color: #a52a36;
        }

        /* CAMERA */

        .card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: white;
            box-shadow: 0 4px 18px rgba(25, 45, 65, .06);
        }

        .card-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
        }

        .card-header h2 {
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 16px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 11px;
        }

        .card-body {
            padding: 22px;
        }

        .camera-box {
            position: relative;
            width: min(100%, 700px);
            aspect-ratio: 4 / 3;
            margin: auto;
            overflow: hidden;
            border-radius: 10px;
            background: #101820;
        }

        #video,
        #preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #video {
            transform: scaleX(-1);
        }

        #preview {
            display: none;
        }

        .face-frame {
            position: absolute;
            top: 14%;
            left: 29%;
            width: 42%;
            height: 70%;
            border: 3px solid var(--secondary);
            border-radius: 50%;
            pointer-events: none;
        }

        .camera-status {
            margin-top: 14px;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
        }

        .actions {
            margin-top: 17px;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            min-height: 42px;
            padding: 0 20px;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-secondary {
            background: #e9eef2;
            color: var(--text);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn:disabled {
            cursor: not-allowed;
            opacity: .5;
        }

        /* KẾT QUẢ XÁC THỰC */

        .result-card {
            overflow: hidden;
            border: 1px solid #d9e4eb;
            border-radius: 16px;
            background: white;
            box-shadow: 0 12px 32px rgba(0, 41, 79, .08);
        }

        .result-title {
            padding: 24px 28px;
            background: var(--primary-dark);
            border-bottom: 4px solid var(--secondary);
        }

        .result-title h2 {
            margin-bottom: 6px;
            color: white;
            font-size: 21px;
        }

        .result-title p {
            color: #b8cad8;
            font-size: 11px;
            line-height: 1.6;
        }

        .information {
            padding: 26px 28px 22px;
        }

        .information-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .info-group {
            overflow: hidden;
            border: 1px solid #dce6ed;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 14px rgba(0, 41, 79, .035);
        }

        .info-group-title {
            position: relative;
            padding: 14px 17px 14px 21px;
            border-bottom: 1px solid var(--border);
            background: #f6f9fb;
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .info-group-title::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 4px;
            background: var(--secondary);
        }

        .info-row {
            min-height: 54px;
            padding: 13px 16px;
            display: grid;
            grid-template-columns: 135px minmax(0, 1fr);
            gap: 15px;
            align-items: center;
            border-bottom: 1px solid #edf0f2;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #7d8b96;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .value {
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .status-row {
            margin-top: 20px;
            padding: 15px 17px;
            border: 1px solid #c7e5d2;
            border-radius: 9px;
            background: #f0faf4;
        }

        .status-row .value {
            color: var(--success);
        }

        /* BA ẢNH ĐỐI CHIẾU */

        .compare-section {
            padding: 0 28px 24px;
        }

        .compare-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .compare-heading::before {
            content: "";
            width: 4px;
            height: 21px;
            border-radius: 6px;
            background: var(--secondary);
        }

        .compare-heading h3 {
            color: var(--primary-dark);
            font-size: 15px;
        }

        .compare-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
        }

        .compare-card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: #fbfcfd;
        }

        .compare-card-title {
            min-height: 54px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            background: #f2f7fb;
            border-bottom: 1px solid var(--border);
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
            line-height: 1.5;
        }

        .compare-image-area {
            padding: 13px;
        }

        .compare-image {
            width: 100%;
            height: 245px;
            display: block;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #dce5eb;
            background: #eef3f7;
        }

        .compare-empty {
            min-height: 245px;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px dashed #ccd8e2;
            border-radius: 8px;
            background: #f8fafc;
            color: var(--muted);
            text-align: center;
            font-size: 11px;
            line-height: 1.6;
        }

        .compare-caption {
            margin-top: 11px;
            color: #667b8c;
            font-size: 11px;
            line-height: 1.6;
        }

        .compare-success {
            margin-top: 15px;
            padding: 13px 15px;
            background: #eaf7ef;
            color: #17643d;
            border: 1px solid #b9dfc8;
            border-radius: 8px;
            font-size: 11px;
            line-height: 1.7;
        }

        .similarity {
            margin: 0 28px 22px;
            padding: 15px 17px;
            border: 1px solid #d9e4eb;
            border-radius: 9px;
            background: #f7fafc;
            color: #5f6f7b;
            font-size: 11px;
        }

        .similarity strong {
            float: right;
            padding: 4px 9px;
            margin-top: -4px;
            border-radius: 999px;
            background: #eaf7ef;
            color: var(--success);
            font-size: 12px;
        }

        .confirm-area {
            padding: 20px 28px;
            border-top: 1px solid var(--border);
            background: #f8fafc;
        }

        .confirm-area form {
            display: flex;
            justify-content: flex-end;
        }

        .confirm-area .btn-success {
            min-height: 46px;
            padding: 0 26px;
            border-radius: 8px;
        }

        .confirm-area .btn-success:hover {
            background: #157347;
        }

        canvas {
            display: none;
        }

        @media (max-width: 950px) {
            .compare-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .compare-card:last-child {
                grid-column: span 2;
            }
        }

        @media (max-width: 650px) {
            .container {
                width: min(100% - 24px, 1240px);
            }

            .topbar {
                padding: 0 16px;
            }

            .result-title,
            .information,
            .compare-section,
            .confirm-area {
                padding-left: 20px;
                padding-right: 20px;
            }

            .information-grid,
            .compare-grid {
                grid-template-columns: 1fr;
            }

            .compare-card:last-child {
                grid-column: auto;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .similarity {
                margin: 0 20px 18px;
            }

            .similarity strong {
                float: none;
                display: inline-block;
                margin: 8px 0 0;
            }

            .confirm-area form,
            .confirm-area .btn-success {
                width: 100%;
            }

            .compare-image {
                height: 250px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">

    <a
        href="{{ route('nhanvien.trang-chu') }}"
        class="logo"
    >
        Viet<span>Jet</span>
    </a>

    <div class="employee-label">
        NHÂN VIÊN SÂN BAY
    </div>

</header>

<div class="container">

    <a
        href="{{ route('nhanvien.passengers.unchecked') }}"
        class="back-link"
    >
        ← Quay lại
    </a>

    <div class="heading">

        <h1>
            Nhận diện khuôn mặt hành khách
        </h1>

        @if(!$verified)

            <p>
                Chụp khuôn mặt hành khách để đối chiếu với
                ảnh đã xác thực khi đặt vé.
                Thông tin hành khách chỉ hiển thị khi
                nhận diện thành công.
            </p>

        @else

            <p>
                Khuôn mặt đã được xác minh thành công.
                Vui lòng kiểm tra ba hình ảnh trước khi
                xác nhận hành khách.
            </p>

        @endif

    </div>

    <!-- THÔNG BÁO -->

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-error">

            {{ session('error') }}

            @if(session('similarity') !== null)

                <div>
                    Mức tương đồng:
                    {{ number_format(
                        (float) session('similarity') * 100,
                        2
                    ) }}%
                </div>

            @endif

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-error">
            {{ $errors->first() }}
        </div>

    @endif

    <!-- ===================================
         CHƯA XÁC THỰC: HIỆN CAMERA
    ==================================== -->

    @if(!$verified)

        <section class="card">

            <div class="card-header">

                <h2>Camera nhận diện</h2>

                <p>
                    Đưa khuôn mặt vào giữa khung,
                    nhìn thẳng và giữ ổn định khi chụp.
                </p>

            </div>

            <div class="card-body">

                <form
                    action="{{ route('nhanvien.tickets.face.verify', $ticket) }}"
                    method="POST"
                    id="faceForm"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="face_image"
                        id="faceImage"
                    >

                    <div class="camera-box">

                        <video
                            id="video"
                            autoplay
                            playsinline
                            muted
                        ></video>

                        <img
                            id="preview"
                            alt="Ảnh khuôn mặt vừa chụp"
                        >

                        <div
                            id="faceFrame"
                            class="face-frame"
                        ></div>

                    </div>

                    <div
                        id="cameraStatus"
                        class="camera-status"
                    >
                        Đang khởi động camera...
                    </div>

                    <div class="actions">

                        <button
                            type="button"
                            id="captureButton"
                            class="btn btn-primary"
                            disabled
                        >
                            Chụp khuôn mặt
                        </button>

                        <button
                            type="button"
                            id="retakeButton"
                            class="btn btn-secondary"
                            style="display:none;"
                        >
                            Chụp lại
                        </button>

                        <button
                            type="submit"
                            id="verifyButton"
                            class="btn btn-success"
                            style="display:none;"
                        >
                            Kiểm tra khuôn mặt
                        </button>

                    </div>

                    <canvas id="canvas"></canvas>

                </form>

            </div>

        </section>

    <!-- ===================================
         ĐÃ XÁC THỰC: HIỆN KẾT QUẢ
    ==================================== -->

    @else

        <section class="result-card">

            <div class="result-title">

                <h2>
                    ✓ Nhận diện thành công
                </h2>

                <p>
                    Hệ thống đã so khớp khuôn mặt vừa quét
                    với khuôn mặt đã đăng ký khi đặt vé.
                </p>

            </div>

            <!-- THÔNG TIN HÀNH KHÁCH -->

            <div class="information">

                <div class="information-grid">

                    <div class="info-group">

                        <div class="info-group-title">
                            Thông tin hành khách
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Mã vé
                            </div>

                            <div class="value">
                                {{ $ticket->ticket_code }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Họ tên hành khách
                            </div>

                            <div class="value">
                                {{ $ticket->passenger_name }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                CCCD / Hộ chiếu
                            </div>

                            <div class="value">
                                {{ $ticket->identity_number ?? '---' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Ngày sinh
                            </div>

                            <div class="value">
                                {{ $ticket->date_of_birth
                                    ? $ticket->date_of_birth->format('d/m/Y')
                                    : '---' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Giới tính
                            </div>

                            <div class="value">

                                @if(in_array($ticket->gender, ['nam', 'male']))

                                    Nam

                                @elseif(in_array($ticket->gender, ['nu', 'female']))

                                    Nữ

                                @elseif($ticket->gender)

                                    Khác

                                @else

                                    ---

                                @endif

                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Số điện thoại
                            </div>

                            <div class="value">
                                {{ $ticket->phone ?? '---' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Email
                            </div>

                            <div class="value">
                                {{ $ticket->email ?? '---' }}
                            </div>
                        </div>

                    </div>

                    <!-- THÔNG TIN CHUYẾN BAY -->

                    <div class="info-group">

                        <div class="info-group-title">
                            Thông tin chuyến bay
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Chuyến bay
                            </div>

                            <div class="value">
                                {{ optional($ticket->flight)->flight_code ?? '---' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Hành trình
                            </div>

                            <div class="value">
                                {{ optional(
                                    optional($ticket->flight)->departureAirport
                                )->city
                                    ?? optional(
                                        optional($ticket->flight)->departureAirport
                                    )->name
                                    ?? '---' }}
                                →
                                {{ optional(
                                    optional($ticket->flight)->arrivalAirport
                                )->city
                                    ?? optional(
                                        optional($ticket->flight)->arrivalAirport
                                    )->name
                                    ?? '---' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Ngày bay
                            </div>

                            <div class="value">
                                {{ optional(
                                    optional($ticket->flight)->flight_date
                                )->format('d/m/Y') ?? '---' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Giờ bay
                            </div>

                            <div class="value">

                                {{ optional($ticket->flight)->departure_time
                                    ? substr($ticket->flight->departure_time, 0, 5)
                                    : '---' }}

                                →

                                {{ optional($ticket->flight)->arrival_time
                                    ? substr($ticket->flight->arrival_time, 0, 5)
                                    : '---' }}

                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Ghế
                            </div>

                            <div class="value">
                                {{ optional($ticket->flightSeat)->seat_number ?? '---' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Hạng ghế
                            </div>

                            <div class="value">
                                {{ $ticket->seat_class === 'vip'
                                    ? 'VIP'
                                    : 'Phổ thông' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="label">
                                Hành lý ký gửi
                            </div>

                            <div class="value">

                                @if((int) ($ticket->baggage_weight ?? 0) > 0)

                                    {{ (int) $ticket->baggage_weight }} kg

                                    -

                                    {{ number_format(
                                        (float) ($ticket->baggage_price ?? 0),
                                        0,
                                        ',',
                                        '.'
                                    ) }} đ

                                @else

                                    Không mua thêm

                                @endif

                            </div>
                        </div>

                    </div>

                </div>

                <div class="status-row info-row">

                    <div class="label">
                        Trạng thái
                    </div>

                    <div class="value">
                        Vé hợp lệ - Chưa kiểm tra
                    </div>

                </div>

            </div>

            <!-- ===================================
                 BA HÌNH ẢNH ĐỐI CHIẾU
            ==================================== -->

            <div class="compare-section">

                <div class="compare-heading">

                    <h3>
                        Hình ảnh đối chiếu hành khách
                    </h3>

                </div>

                <div class="compare-grid">

                    <!-- ẢNH 1: CCCD KHI ĐẶT VÉ -->

                    <div class="compare-card">

                        <div class="compare-card-title">
                            1. Ảnh CCCD / Hộ chiếu khi đặt vé
                        </div>

                        <div class="compare-image-area">

                            @if(!empty($ticket->cccd_image))

                                <img
                                    src="{{ asset($ticket->cccd_image) }}"
                                    alt="Ảnh CCCD khi đặt vé"
                                    class="compare-image"
                                >

                            @else

                                <div class="compare-empty">
                                    Không có ảnh CCCD /
                                    Hộ chiếu trong hồ sơ vé.
                                </div>

                            @endif

                            <p class="compare-caption">
                                Ảnh giấy tờ hành khách đã tải lên
                                khi nhập thông tin đặt vé.
                            </p>

                        </div>

                    </div>

                    <!-- ẢNH 2: KHUÔN MẶT XÁC THỰC VỚI CCCD -->

                    <div class="compare-card">

                        <div class="compare-card-title">
                            2. Ảnh khuôn mặt xác thực với CCCD
                        </div>

                        <div class="compare-image-area">

                            @if(!empty($ticket->face_image))

                                <img
                                    src="{{ asset($ticket->face_image) }}"
                                    alt="Khuôn mặt đã xác thực với CCCD lúc đặt vé"
                                    class="compare-image"
                                >

                            @else

                                <div class="compare-empty">
                                    Không tìm thấy ảnh khuôn mặt
                                    đã xác thực khi đặt vé.
                                </div>

                            @endif

                            <p class="compare-caption">
                                Ảnh được lưu khi hành khách xác thực
                                khuôn mặt thành công với CCCD
                                trong quá trình đặt vé.
                            </p>

                        </div>

                    </div>

                    <!-- ẢNH 3: KHUÔN MẶT VỪA QUÉT TẠI QUẦY -->

                    <div class="compare-card">

                        <div class="compare-card-title">
                            3. Ảnh khuôn mặt vừa quét check-in
                        </div>

                        <div class="compare-image-area">

                            <img
                                id="successfulFaceImage"
                                src=""
                                alt="Ảnh khuôn mặt vừa quét tại quầy"
                                class="compare-image"
                                style="display:none;"
                            >

                            <div
                                id="faceImageEmpty"
                                class="compare-empty"
                            >
                                Không tìm thấy ảnh quét check-in
                                của lần xác thực hiện tại.
                            </div>

                            <p
                                id="successfulFaceNote"
                                class="compare-caption"
                            >
                                Ảnh mới được chụp tại quầy
                                và đã được hệ thống xác minh.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="compare-success">

                    ✓ Hệ thống đã xác thực khuôn mặt thành công.

                    Nhân viên hãy đối chiếu:

                    ảnh CCCD, ảnh khuôn mặt đã đăng ký
                    và ảnh khuôn mặt vừa quét tại quầy

                    trước khi xác nhận hành khách.

                </div>

            </div>

            <!-- MỨC ĐỘ TƯƠNG ĐỒNG -->

            @if($similarity !== null)

                <div class="similarity">

                    Mức tương đồng khuôn mặt:

                    <strong>
                        {{ number_format(
                            (float) $similarity * 100,
                            2
                        ) }}%
                    </strong>

                </div>

            @endif

            <!-- XÁC NHẬN HÀNH KHÁCH -->

            <div class="confirm-area">

                <form
                    action="{{ route('nhanvien.tickets.confirm', $ticket) }}"
                    method="POST"
                    id="confirmPassengerForm"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        Xác nhận hành khách
                    </button>

                </form>

            </div>

        </section>

    @endif

</div>

<!-- ===================================
     JAVASCRIPT KHI CHƯA XÁC THỰC
==================================== -->

@if(!$verified)

<script>
    const video = document.getElementById('video');
    const preview = document.getElementById('preview');
    const canvas = document.getElementById('canvas');
    const faceImage = document.getElementById('faceImage');

    const captureButton = document.getElementById('captureButton');
    const retakeButton = document.getElementById('retakeButton');
    const verifyButton = document.getElementById('verifyButton');

    const cameraStatus = document.getElementById('cameraStatus');
    const faceFrame = document.getElementById('faceFrame');
    const faceForm = document.getElementById('faceForm');

    const faceStorageKey =
        @json('employee_face_capture_' . $ticket->id);

    const faceStorageTimeKey =
        @json('employee_face_capture_time_' . $ticket->id);

    let stream = null;

    /*
     * MỞ CAMERA
     */
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: 'user',
                    width: {
                        ideal: 1280
                    },
                    height: {
                        ideal: 720
                    }
                },
                audio: false
            });

            video.srcObject = stream;

            video.onloadedmetadata = function () {
                captureButton.disabled = false;

                cameraStatus.textContent =
                    'Camera đã sẵn sàng. Đưa khuôn mặt vào giữa khung.';
            };

        } catch (error) {
            captureButton.disabled = true;

            cameraStatus.textContent =
                'Không thể mở camera. Vui lòng cho phép trình duyệt sử dụng camera.';
        }
    }

    /*
     * CHỤP KHUÔN MẶT
     */
    function captureFace() {
        if (!video.videoWidth || !video.videoHeight) {
            return;
        }

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext('2d');

        context.save();

        context.translate(canvas.width, 0);
        context.scale(-1, 1);

        context.drawImage(
            video,
            0,
            0,
            canvas.width,
            canvas.height
        );

        context.restore();

        const imageData = canvas.toDataURL(
            'image/jpeg',
            0.85
        );

        faceImage.value = imageData;
        preview.src = imageData;

        video.style.display = 'none';
        preview.style.display = 'block';

        faceFrame.style.display = 'none';

        captureButton.style.display = 'none';
        retakeButton.style.display = 'inline-block';
        verifyButton.style.display = 'inline-block';

        cameraStatus.textContent =
            'Đã chụp ảnh. Bấm Kiểm tra khuôn mặt để nhận diện.';
    }

    /*
     * CHỤP LẠI
     */
    function retakeFace() {
        faceImage.value = '';
        preview.src = '';

        preview.style.display = 'none';
        video.style.display = 'block';

        faceFrame.style.display = 'block';

        captureButton.style.display = 'inline-block';
        retakeButton.style.display = 'none';
        verifyButton.style.display = 'none';

        cameraStatus.textContent =
            'Đưa khuôn mặt vào giữa khung và chụp lại.';
    }

    captureButton.addEventListener(
        'click',
        captureFace
    );

    retakeButton.addEventListener(
        'click',
        retakeFace
    );

    /*
     * LƯU TẠM ẢNH CHECK-IN TRONG TAB
     *
     * Ảnh khuôn mặt đăng ký khi đặt vé
     * đã được lưu riêng trong tickets.face_image.
     *
     * Đây là ảnh MỚI chụp tại quầy.
     */
    faceForm.addEventListener('submit', function (event) {

        if (!faceImage.value) {
            event.preventDefault();

            cameraStatus.textContent =
                'Vui lòng chụp khuôn mặt trước.';

            return;
        }

        try {
            sessionStorage.setItem(
                faceStorageKey,
                faceImage.value
            );

            sessionStorage.setItem(
                faceStorageTimeKey,
                String(Date.now())
            );

        } catch (error) {
            // Không cản trở việc gửi ảnh lên server.
        }

        verifyButton.disabled = true;

        verifyButton.textContent =
            'Đang kiểm tra...';
    });

    /*
     * DỪNG CAMERA KHI RỜI TRANG
     */
    window.addEventListener(
        'beforeunload',
        function () {
            if (stream) {
                stream.getTracks().forEach(function (track) {
                    track.stop();
                });
            }
        }
    );

    /*
     * XÓA ẢNH CHECK-IN CŨ KHI BẮT ĐẦU LẦN QUÉT MỚI
     */
    try {
        sessionStorage.removeItem(faceStorageKey);
        sessionStorage.removeItem(faceStorageTimeKey);
    } catch (error) {
        // Không ảnh hưởng đến hoạt động camera.
    }

    startCamera();
</script>

<!-- ===================================
     JAVASCRIPT SAU KHI XÁC THỰC
==================================== -->

@else

<script>
    const successfulImage =
        document.getElementById('successfulFaceImage');

    const emptyImage =
        document.getElementById('faceImageEmpty');

    const successfulFaceNote =
        document.getElementById('successfulFaceNote');

    const faceStorageKey =
        @json('employee_face_capture_' . $ticket->id);

    const faceStorageTimeKey =
        @json('employee_face_capture_time_' . $ticket->id);

    const confirmPassengerForm =
        document.getElementById('confirmPassengerForm');

    let capturedImage = null;
    let capturedAt = 0;

    /*
     * LẤY ẢNH VỪA QUÉT TẠI QUẦY.
     * ẢNH NÀY KHÁC VỚI tickets.face_image.
     */
    try {
        capturedImage =
            sessionStorage.getItem(faceStorageKey);

        capturedAt = Number(
            sessionStorage.getItem(faceStorageTimeKey) || 0
        );

    } catch (error) {
        capturedImage = null;
    }

    /*
     * CHỈ DÙNG ẢNH TẠM CỦA LẦN QUÉT GẦN ĐÂY.
     * Thời hạn tương ứng với cửa sổ xác thực 5 phút.
     */
    const captureIsRecent =
        capturedAt > 0 &&
        Date.now() - capturedAt <= 5 * 60 * 1000;

    if (capturedImage && captureIsRecent) {

        successfulImage.src = capturedImage;
        successfulImage.style.display = 'block';

        emptyImage.style.display = 'none';

        successfulFaceNote.textContent =
            'Đây là ảnh vừa quét tại quầy và được xác thực thành công.';

    } else {

        successfulImage.style.display = 'none';
        emptyImage.style.display = 'flex';

        emptyImage.textContent =
            'Ảnh check-in vừa chụp không còn trong tab này.';

        successfulFaceNote.textContent =
            'Ảnh đã đăng ký khi đặt vé vẫn được hiển thị ở ô số 2.';
    }

    successfulImage.addEventListener(
        'error',
        function () {

            successfulImage.style.display = 'none';
            emptyImage.style.display = 'flex';

            emptyImage.textContent =
                'Không thể tải ảnh khuôn mặt vừa quét.';

        }
    );

    /*
     * KHI NHÂN VIÊN XÁC NHẬN, XÓA ẢNH TẠM.
     */
    confirmPassengerForm.addEventListener(
        'submit',
        function () {

            try {
                sessionStorage.removeItem(faceStorageKey);
                sessionStorage.removeItem(faceStorageTimeKey);
            } catch (error) {
                // Không ảnh hưởng đến xác nhận hành khách.
            }

        }
    );
</script>

@endif

</body>
</html>
