<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Xác nhận hành khách thủ công</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #004b87;
            --primary-dark: #00345f;
            --primary-light: #eaf4fb;
            --yellow: #f7b500;
            --yellow-light: #fff7dc;
            --success: #16945f;
            --success-dark: #107447;
            --success-light: #eaf8f1;
            --danger: #dc3545;
            --danger-light: #fff0f1;
            --text: #203443;
            --muted: #6e7f8d;
            --border: #dce5eb;
            --background: #eef3f7;
            --white: #ffffff;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background:
                linear-gradient(
                    135deg,
                    #eef5fa 0%,
                    #f7f9fb 45%,
                    #eef3f7 100%
                );
            color: var(--text);
        }

        .page {
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 920px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 17px;
            color: var(--primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: 0.2s;
        }

        .back-link:hover {
            transform: translateX(-3px);
        }

        .main-card {
            overflow: hidden;
            background: var(--white);
            border: 1px solid #dce5eb;
            border-radius: 18px;
            box-shadow:
                0 16px 45px rgba(28, 61, 84, 0.10);
        }

        .header {
            position: relative;
            padding: 35px 35px 32px;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #003b70 0%,
                    #00589b 65%,
                    #0070b5 100%
                );
            color: white;
            text-align: center;
        }

        .header::before {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            top: -100px;
            right: -50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .header::after {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            bottom: -80px;
            left: -25px;
            border-radius: 50%;
            background: rgba(247, 181, 0, 0.13);
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 17px;
            background: rgba(255, 255, 255, 0.13);
            color: white;
        }

        .header-icon svg {
            width: 29px;
            height: 29px;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 5px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .header h1 {
            margin-bottom: 8px;
            font-size: 27px;
            font-weight: 800;
        }

        .header p {
            max-width: 620px;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.82);
            font-size: 12px;
            line-height: 1.7;
        }

        .content {
            padding: 32px 36px 36px;
        }

        .alert {
            margin-bottom: 22px;
            padding: 13px 15px;
            border-radius: 9px;
            font-size: 12px;
            line-height: 1.6;
        }

        .alert-error {
            background: var(--danger-light);
            border: 1px solid #efc0c5;
            border-left: 4px solid var(--danger);
            color: #a52a36;
        }

        .step-heading {
            margin-bottom: 23px;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .step-number {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
        }

        .step-heading h2 {
            margin-bottom: 4px;
            color: var(--primary-dark);
            font-size: 16px;
            font-weight: 800;
        }

        .step-heading p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .input-card {
            padding: 23px;
            background:
                linear-gradient(
                    135deg,
                    #f7fbfe,
                    #edf6fc
                );
            border: 1px solid #d8e9f5;
            border-radius: 12px;
        }

        .input-label {
            margin-bottom: 9px;
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
        }

        .input-label svg {
            width: 18px;
            height: 18px;
            color: var(--primary);
        }

        .required {
            color: var(--danger);
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            height: 51px;
            padding: 0 15px 0 46px;
            border: 1px solid #c9d8e2;
            border-radius: 8px;
            background: white;
            color: var(--text);
            font-size: 13px;
            transition: 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow:
                0 0 0 3px rgba(0, 75, 135, 0.10);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7693a8;
        }

        .input-icon svg {
            width: 19px;
            height: 19px;
        }

        .input-note {
            margin-top: 9px;
            display: flex;
            align-items: flex-start;
            gap: 6px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.5;
        }

        .input-note svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .actions {
            margin-top: 23px;
            display: flex;
            gap: 11px;
        }

        .btn {
            min-height: 46px;
            padding: 0 21px;
            border: none;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition:
                transform 0.2s,
                background 0.2s,
                box-shadow 0.2s;
        }

        .btn svg {
            width: 17px;
            height: 17px;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-back {
            border: 1px solid #d2dde5;
            background: white;
            color: var(--primary);
        }

        .btn-back:hover {
            background: #f5f8fa;
        }

        .btn-check {
            flex: 1;
            background:
                linear-gradient(
                    135deg,
                    #004b87,
                    #0067a8
                );
            color: white;
            box-shadow:
                0 6px 15px rgba(0, 75, 135, 0.17);
        }

        .btn-check:hover {
            background:
                linear-gradient(
                    135deg,
                    #003b70,
                    #00558c
                );
        }

        .success-banner {
            margin-bottom: 24px;
            padding: 17px 19px;
            display: flex;
            align-items: center;
            gap: 14px;
            background:
                linear-gradient(
                    135deg,
                    #eaf8f1,
                    #f5fcf8
                );
            border: 1px solid #bfe5d0;
            border-radius: 11px;
        }

        .success-icon {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--success);
            color: white;
        }

        .success-icon svg {
            width: 22px;
            height: 22px;
        }

        .success-banner h3 {
            margin-bottom: 4px;
            color: var(--success-dark);
            font-size: 14px;
            font-weight: 800;
        }

        .success-banner p {
            color: #557266;
            font-size: 11px;
            line-height: 1.5;
        }

        .passenger-card {
            overflow: hidden;
            border: 1px solid #d9e4eb;
            border-radius: 13px;
            background: white;
        }

        .passenger-header {
            padding: 17px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            background:
                linear-gradient(
                    135deg,
                    #edf6fc,
                    #f8fbfd
                );
            border-bottom: 1px solid #dce7ee;
        }

        .passenger-header-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .passenger-avatar {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--primary);
            color: white;
        }

        .passenger-avatar svg {
            width: 21px;
            height: 21px;
        }

        .passenger-header h3 {
            margin-bottom: 3px;
            color: var(--primary-dark);
            font-size: 15px;
            font-weight: 800;
        }

        .passenger-header p {
            color: var(--muted);
            font-size: 10px;
        }

        .verified-badge {
            padding: 6px 11px;
            border-radius: 20px;
            background: #dff4e8;
            color: var(--success-dark);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }

        .section-label {
            padding: 19px 20px 0;
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-grid {
            padding: 14px 20px 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .info-box {
            min-height: 72px;
            padding: 13px 14px;
            border: 1px solid #e3e9ed;
            border-radius: 9px;
            background: #fbfcfd;
        }

        .info-label {
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .info-value {
            color: var(--text);
            font-size: 13px;
            font-weight: 800;
            line-height: 1.4;
            word-break: break-word;
        }

        .info-value.success {
            color: var(--success);
        }

        .flight-box {
            margin: 0 20px 20px;
            padding: 19px 20px;
            background:
                linear-gradient(
                    135deg,
                    #003b70,
                    #005b9c
                );
            border-radius: 11px;
            color: white;
        }

        .flight-top {
            margin-bottom: 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .flight-label {
            color: rgba(255, 255, 255, 0.68);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .flight-code {
            margin-top: 4px;
            font-size: 14px;
            font-weight: 800;
        }

        .seat {
            text-align: right;
        }

        .route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 17px;
        }

        .airport {
            font-size: 24px;
            font-weight: 800;
        }

        .airport:last-child {
            text-align: right;
        }

        .route-middle {
            min-width: 180px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .route-line {
            height: 1px;
            flex: 1;
            background: rgba(255, 255, 255, 0.35);
        }

        .plane {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--yellow);
            color: #3b2b00;
        }

        .plane svg {
            width: 17px;
            height: 17px;
        }

        .ticket-extra {
            margin: 0 20px 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .extra-box {
            padding: 13px 14px;
            background: #f8fafb;
            border: 1px solid #e3e9ed;
            border-radius: 9px;
        }

        .extra-label {
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .extra-value {
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
            line-height: 1.4;
        }

        .extra-value.green {
            color: var(--success);
        }

        .confirm-area {
            margin-top: 22px;
            padding: 18px;
            background: #f8fafb;
            border: 1px solid #e3e9ed;
            border-radius: 10px;
        }

        .confirm-warning {
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .confirm-warning svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 1px;
            color: var(--primary);
        }

        .btn-confirm {
            flex: 1;
            background:
                linear-gradient(
                    135deg,
                    #16945f,
                    #20a96f
                );
            color: white;
            box-shadow:
                0 6px 15px rgba(22, 148, 95, 0.18);
        }

        .btn-confirm:hover {
            background:
                linear-gradient(
                    135deg,
                    #107447,
                    #168c5b
                );
        }

        @media (max-width: 700px) {
            .page {
                padding: 20px 14px;
                align-items: flex-start;
            }

            .header {
                padding: 28px 20px 25px;
            }

            .header h1 {
                font-size: 22px;
            }

            .content {
                padding: 24px 19px 26px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .ticket-extra {
                grid-template-columns: 1fr;
            }

            .passenger-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .route-middle {
                min-width: 70px;
            }

            .airport {
                font-size: 19px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <a
            href="{{ route(
                'nhanvien.tickets.verification.choose',
                $ticket->id
            ) }}"
            class="back-link"
        >
            ← Quay lại chọn cách xác nhận
        </a>

        <div class="main-card">

            <div class="header">

                <div class="header-content">

                    <div class="header-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            ></rect>

                            <circle
                                cx="8"
                                cy="11"
                                r="2"
                            ></circle>

                            <path
                                d="M5.5 16c.6-1.7 1.4-2.5 2.5-2.5s1.9.8 2.5 2.5"
                            ></path>

                            <path d="M13 9h5"></path>
                            <path d="M13 12h5"></path>
                            <path d="M13 15h3"></path>
                        </svg>

                    </div>

                    <div class="header-badge">
                        Kiểm tra giấy tờ
                    </div>

                    <h1>
                        Xác nhận hành khách thủ công
                    </h1>

                    @if(!$manualVerified)

                        <p>
                            Nhập CCCD / Hộ chiếu mà hành khách xuất trình.
                            Thông tin hành khách chỉ hiển thị sau khi
                            đối chiếu thành công.
                        </p>

                    @else

                        <p>
                            Giấy tờ đã được đối chiếu thành công.
                            Vui lòng kiểm tra thông tin trước khi xác nhận hành khách.
                        </p>

                    @endif

                </div>

            </div>

            <div class="content">

                @if(session('error'))

                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>

                @endif

                @if($errors->any())

                    <div class="alert alert-error">

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                @endif

                @if(!$manualVerified)

                    <div class="step-heading">

                        <div class="step-number">
                            01
                        </div>

                        <div>

                            <h2>
                                Nhập thông tin giấy tờ
                            </h2>

                            <p>
                                Hệ thống sẽ đối chiếu CCCD / Hộ chiếu
                                với thông tin hành khách của vé.
                            </p>

                        </div>

                    </div>

                    <form
                        action="{{ route(
                            'nhanvien.tickets.manual.check',
                            $ticket->id
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        <div class="input-card">

                            <label
                                for="identity_number"
                                class="input-label"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    ></rect>

                                    <circle
                                        cx="8"
                                        cy="11"
                                        r="2"
                                    ></circle>

                                    <path d="M13 9h5"></path>
                                    <path d="M13 13h5"></path>
                                </svg>

                                CCCD / Hộ chiếu

                                <span class="required">
                                    *
                                </span>

                            </label>

                            <div class="input-wrapper">

                                <div class="input-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <circle
                                            cx="11"
                                            cy="11"
                                            r="7"
                                        ></circle>

                                        <path d="m20 20-3.5-3.5"></path>
                                    </svg>

                                </div>

                                <input
                                    type="text"
                                    id="identity_number"
                                    name="identity_number"
                                    class="form-control"
                                    value="{{ old('identity_number') }}"
                                    placeholder="Nhập số CCCD hoặc hộ chiếu của hành khách"
                                    autocomplete="off"
                                    required
                                    autofocus
                                >

                            </div>

                            <div class="input-note">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    ></circle>

                                    <path d="M12 11v5"></path>
                                    <path d="M12 8h.01"></path>
                                </svg>

                                <span>
                                    Nhập đúng thông tin trên giấy tờ
                                    mà hành khách đang xuất trình tại quầy.
                                </span>

                            </div>

                        </div>

                        <div class="actions">

                            <a
                                href="{{ route(
                                    'nhanvien.tickets.verification.choose',
                                    $ticket->id
                                ) }}"
                                class="btn btn-back"
                            >
                                ← Quay lại
                            </a>

                            <button
                                type="submit"
                                class="btn btn-check"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <circle
                                        cx="11"
                                        cy="11"
                                        r="7"
                                    ></circle>

                                    <path d="m20 20-3.5-3.5"></path>
                                </svg>

                                Kiểm tra thông tin

                            </button>

                        </div>

                    </form>

                @else

                    <div class="success-banner">

                        <div class="success-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                            >
                                <path d="m5 12 4 4L19 6"></path>
                            </svg>

                        </div>

                        <div>

                            <h3>
                                Xác minh thông tin thành công
                            </h3>

                            <p>
                                CCCD / Hộ chiếu đã khớp với
                                thông tin hành khách trong hệ thống.
                            </p>

                        </div>

                    </div>

                    <div class="step-heading">

                        <div class="step-number">
                            02
                        </div>

                        <div>

                            <h2>
                                Kiểm tra thông tin hành khách
                            </h2>

                            <p>
                                Đối chiếu lại thông tin trước khi
                                thực hiện xác nhận cuối cùng.
                            </p>

                        </div>

                    </div>

                    <div class="passenger-card">

                        <div class="passenger-header">

                            <div class="passenger-header-left">

                                <div class="passenger-avatar">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <circle
                                            cx="12"
                                            cy="8"
                                            r="4"
                                        ></circle>

                                        <path
                                            d="M4 21a8 8 0 0 1 16 0"
                                        ></path>
                                    </svg>

                                </div>

                                <div>

                                    <h3>
                                        {{ $ticket->passenger_name }}
                                    </h3>

                                    <p>
                                        Thông tin hành khách đã được đối chiếu
                                    </p>

                                </div>

                            </div>

                            <div class="verified-badge">
                                ✓ ĐÃ XÁC MINH
                            </div>

                        </div>

                        <div class="section-label">
                            Thông tin cá nhân
                        </div>

                        <div class="info-grid">

                            <div class="info-box">

                                <div class="info-label">
                                    Họ và tên
                                </div>

                                <div class="info-value">
                                    {{ $ticket->passenger_name ?? '---' }}
                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    CCCD / Hộ chiếu
                                </div>

                                <div class="info-value">
                                    {{ $ticket->identity_number ?? '---' }}
                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Ngày sinh
                                </div>

                                <div class="info-value">
                                    {{ $ticket->date_of_birth
                                        ? $ticket->date_of_birth->format('d/m/Y')
                                        : '---' }}
                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Giới tính
                                </div>

                                <div class="info-value">

                                    @if($ticket->gender === 'male')

                                        Nam

                                    @elseif($ticket->gender === 'female')

                                        Nữ

                                    @elseif($ticket->gender)

                                        {{ $ticket->gender }}

                                    @else

                                        ---

                                    @endif

                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Số điện thoại
                                </div>

                                <div class="info-value">
                                    {{ $ticket->phone ?? '---' }}
                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Email
                                </div>

                                <div class="info-value">
                                    {{ $ticket->email ?? '---' }}
                                </div>

                            </div>

                        </div>

                        <div class="section-label">
                            Thông tin vé
                        </div>

                        <div class="info-grid">

                            <div class="info-box">

                                <div class="info-label">
                                    Mã vé
                                </div>

                                <div class="info-value">
                                    {{ $ticket->ticket_code ?? '---' }}
                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Mã đặt vé
                                </div>

                                <div class="info-value">
                                    {{ $ticket->booking->booking_code ?? '---' }}
                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Giá vé
                                </div>

                                <div class="info-value">
                                    {{ number_format(
                                        (float) ($ticket->price ?? 0),
                                        0,
                                        ',',
                                        '.'
                                    ) }} đ
                                </div>

                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Trạng thái vé
                                </div>

                                <div class="info-value success">

                                    @if($ticket->ticket_status === 'active')

                                        Có hiệu lực

                                    @elseif($ticket->ticket_status === 'used')

                                        Đã xác nhận

                                    @elseif($ticket->ticket_status === 'cancelled')

                                        Đã hủy

                                    @else

                                        {{ $ticket->ticket_status ?? '---' }}

                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="flight-box">

                            <div class="flight-top">

                                <div>

                                    <div class="flight-label">
                                        Chuyến bay
                                    </div>

                                    <div class="flight-code">
                                        {{ $ticket->flight->flight_code ?? '---' }}
                                    </div>

                                </div>

                                <div class="seat">

                                    <div class="flight-label">
                                        Ghế
                                    </div>

                                    <div class="flight-code">
                                        {{ $ticket->flightSeat->seat_number ?? '---' }}
                                    </div>

                                </div>

                            </div>

                            <div class="route">

                                <div class="airport">
                                    {{ $ticket->flight->departureAirport->code ?? '---' }}
                                </div>

                                <div class="route-middle">

                                    <div class="route-line"></div>

                                    <div class="plane">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="M22 2 9 15"></path>

                                            <path
                                                d="m22 2-7 20-4-9-9-4Z"
                                            ></path>
                                        </svg>

                                    </div>

                                    <div class="route-line"></div>

                                </div>

                                <div class="airport">
                                    {{ $ticket->flight->arrivalAirport->code ?? '---' }}
                                </div>

                            </div>

                        </div>

                        <div class="ticket-extra">

                            <div class="extra-box">

                                <div class="extra-label">
                                    Hành lý ký gửi
                                </div>

                                <div class="extra-value">

                                    @if((int) $ticket->baggage_weight > 0)

                                        {{ (int) $ticket->baggage_weight }} kg

                                    @else

                                        Không có

                                    @endif

                                </div>

                            </div>

                            <div class="extra-box">

                                <div class="extra-label">
                                    Phí hành lý
                                </div>

                                <div class="extra-value">
                                    {{ number_format(
                                        (float) ($ticket->baggage_price ?? 0),
                                        0,
                                        ',',
                                        '.'
                                    ) }} đ
                                </div>

                            </div>

                            <div class="extra-box">

                                <div class="extra-label">
                                    Thanh toán
                                </div>

                                <div class="extra-value green">

                                    @if(
                                        $ticket->booking
                                        &&
                                        $ticket->booking->payment_status === 'paid'
                                    )

                                        Đã thanh toán

                                    @else

                                        Chưa thanh toán

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="confirm-area">

                        <div class="confirm-warning">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                ></circle>

                                <path d="M12 11v5"></path>
                                <path d="M12 8h.01"></path>
                            </svg>

                            <span>
                                Chỉ bấm xác nhận sau khi đã kiểm tra
                                đúng hành khách và giấy tờ tùy thân.
                                Sau khi xác nhận, hành khách sẽ được
                                đánh dấu là đã kiểm tra.
                            </span>

                        </div>

                        <form
                            action="{{ route(
                                'nhanvien.tickets.confirm.manual',
                                $ticket->id
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'nhanvien.tickets.verification.choose',
                                        $ticket->id
                                    ) }}"
                                    class="btn btn-back"
                                >
                                    ← Quay lại
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-confirm"
                                    onclick="return confirm(
                                        'Bạn chắc chắn muốn xác nhận hành khách này?'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.5"
                                    >
                                        <path
                                            d="m5 12 4 4L19 6"
                                        ></path>
                                    </svg>

                                    Xác nhận hành khách

                                </button>

                            </div>

                        </form>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

</body>

</html>