<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Chọn phương thức xác nhận</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #003b70;
            --primary-dark: #002b53;
            --primary-light: #eaf4fc;
            --yellow: #f4b400;
            --yellow-dark: #d99f00;
            --text: #213547;
            --muted: #6f7d89;
            --border: #dce5ec;
            --background: #f4f7f9;
            --white: #ffffff;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        .page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 35px 20px;
        }

        .container {
            width: 100%;
            max-width: 980px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 16px;
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
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(29, 55, 75, 0.08);
        }

        .header {
            padding: 30px 35px 26px;
            text-align: center;
            border-bottom: 1px solid #edf1f4;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            padding: 6px 13px;
            background: var(--primary-light);
            border-radius: 20px;
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header h1 {
            margin-bottom: 8px;
            color: var(--primary);
            font-size: 27px;
            font-weight: 800;
        }

        .header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .content {
            padding: 28px 35px 35px;
        }

        .passenger-card {
            margin-bottom: 28px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            background: #f2f8fc;
            border: 1px solid #dcecf7;
            border-radius: 10px;
        }

        .passenger-avatar {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            border-radius: 50%;
            color: white;
        }

        .passenger-avatar svg {
            width: 23px;
            height: 23px;
        }

        .passenger-content {
            flex: 1;
        }

        .passenger-name {
            margin-bottom: 6px;
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        .passenger-details {
            display: flex;
            flex-wrap: wrap;
            gap: 7px 22px;
        }

        .detail {
            color: var(--muted);
            font-size: 12px;
        }

        .detail strong {
            margin-left: 4px;
            color: var(--text);
        }

        .section-title {
            margin-bottom: 17px;
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        .methods {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .method {
            position: relative;
            min-height: 285px;
            padding: 28px 25px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;
            text-align: center;
            transition:
                transform 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .method:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(20, 45, 65, 0.09);
        }

        .method-face:hover {
            border-color: var(--primary);
        }

        .method-manual:hover {
            border-color: var(--yellow);
        }

        .method-number {
            position: absolute;
            top: 14px;
            right: 15px;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f4f6;
            border-radius: 50%;
            color: #7b8790;
            font-size: 10px;
            font-weight: 800;
        }

        .method-icon {
            width: 72px;
            height: 72px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
        }

        .method-icon svg {
            width: 34px;
            height: 34px;
        }

        .face-icon {
            background: var(--primary-light);
            color: var(--primary);
        }

        .manual-icon {
            background: #fff5d6;
            color: #b67e00;
        }

        .method h2 {
            margin-bottom: 10px;
            color: var(--primary);
            font-size: 18px;
            font-weight: 800;
        }

        .method p {
            max-width: 310px;
            margin-bottom: 22px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .method-info {
            width: 100%;
            margin-bottom: 22px;
            padding-top: 15px;
            border-top: 1px solid #edf1f4;
            color: #74818c;
            font-size: 11px;
            line-height: 1.6;
        }

        .btn {
            width: 100%;
            min-height: 44px;
            margin-top: auto;
            padding: 0 18px;
            border: none;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn svg {
            width: 17px;
            height: 17px;
        }

        .btn-face {
            background: var(--primary);
            color: white;
        }

        .btn-face:hover {
            background: var(--primary-dark);
        }

        .btn-manual {
            background: var(--yellow);
            color: #302400;
        }

        .btn-manual:hover {
            background: var(--yellow-dark);
        }

        .notice {
            margin-top: 22px;
            padding: 12px 15px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            background: #f8fafb;
            border: 1px solid #e5ebef;
            border-radius: 7px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .notice svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            margin-top: 1px;
            color: var(--primary);
        }

        @media (max-width: 750px) {
            .page {
                padding: 20px 15px;
                align-items: flex-start;
            }

            .header {
                padding: 25px 20px 22px;
            }

            .header h1 {
                font-size: 22px;
            }

            .content {
                padding: 22px 20px 25px;
            }

            .methods {
                grid-template-columns: 1fr;
            }

            .passenger-card {
                align-items: flex-start;
            }

            .passenger-details {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <a
            href="{{ route('nhanvien.tickets.index') }}"
            class="back-link"
        >
            <span>←</span>
            Quay lại tra cứu vé
        </a>

        <div class="main-card">

            <div class="header">

                <div class="header-badge">
                    Kiểm tra hành khách
                </div>

                <h1>
                    Chọn phương thức xác nhận
                </h1>

                <p>
                    Chọn phương thức phù hợp để kiểm tra và xác nhận
                    thông tin hành khách trước chuyến bay.
                </p>

            </div>

            <div class="content">

                <div class="passenger-card">

                    <div class="passenger-avatar">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M20 21a8 8 0 0 0-16 0"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>

                    </div>

                    <div class="passenger-content">

                        <div class="passenger-name">
                            {{ $ticket->passenger_name }}
                        </div>

                        <div class="passenger-details">

                            <div class="detail">
                                Mã vé:
                                <strong>
                                    {{ $ticket->ticket_code }}
                                </strong>
                            </div>

                            <div class="detail">
                                CCCD / Hộ chiếu:
                                <strong>
                                    {{ $ticket->identity_number ?? '---' }}
                                </strong>
                            </div>

                            @if($ticket->flight)

                                <div class="detail">
                                    Chuyến bay:
                                    <strong>
                                        {{ $ticket->flight->flight_code }}
                                    </strong>
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

                <div class="section-title">
                    Phương thức kiểm tra
                </div>

                <div class="methods">

                    <div class="method method-face">

                        <div class="method-number">
                            01
                        </div>

                        <div class="method-icon face-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M4 8V6a2 2 0 0 1 2-2h2"></path>
                                <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                                <path d="M20 16v2a2 2 0 0 1-2 2h-2"></path>
                                <path d="M8 20H6a2 2 0 0 1-2-2v-2"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                                <path d="M7.5 17c1.2-2.2 2.7-3 4.5-3s3.3.8 4.5 3"></path>
                            </svg>

                        </div>

                        <h2>
                            Quét khuôn mặt
                        </h2>

                        <p>
                            Sử dụng camera để nhận diện khuôn mặt
                            và đối chiếu với dữ liệu hành khách đã đăng ký.
                        </p>

                        <div class="method-info">
                            Phù hợp khi hành khách đã đăng ký khuôn mặt
                            và có thể thực hiện nhận diện bằng camera.
                        </div>

                        <a
                            href="{{ route(
                                'nhanvien.tickets.face',
                                $ticket->id
                            ) }}"
                            class="btn btn-face"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M4 8V6a2 2 0 0 1 2-2h2"></path>
                                <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                                <path d="M20 16v2a2 2 0 0 1-2 2h-2"></path>
                                <path d="M8 20H6a2 2 0 0 1-2-2v-2"></path>
                            </svg>

                            Bắt đầu quét khuôn mặt

                        </a>

                    </div>

                    <div class="method method-manual">

                        <div class="method-number">
                            02
                        </div>

                        <div class="method-icon manual-icon">

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

                                <path d="M5.5 16c.6-1.7 1.4-2.5 2.5-2.5s1.9.8 2.5 2.5"></path>
                                <path d="M13 9h5"></path>
                                <path d="M13 12h5"></path>
                                <path d="M13 15h3"></path>
                            </svg>

                        </div>

                        <h2>
                            Điền thông tin thủ công
                        </h2>

                        <p>
                            Kiểm tra giấy tờ hành khách và nhập
                            CCCD / Hộ chiếu để hệ thống đối chiếu thông tin.
                        </p>

                        <div class="method-info">
                            Sử dụng khi hành khách không thể quét khuôn mặt
                            hoặc cần kiểm tra bằng giấy tờ tùy thân.
                        </div>

                        <a
                            href="{{ route(
                                'nhanvien.tickets.manual',
                                $ticket->id
                            ) }}"
                            class="btn btn-manual"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                            </svg>

                            Điền thông tin thủ công

                        </a>

                    </div>

                </div>

                <div class="notice">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 11v5"></path>
                        <path d="M12 8h.01"></path>
                    </svg>

                    <div>
                        Chỉ xác nhận hành khách sau khi đã kiểm tra
                        đúng thông tin vé và giấy tờ tùy thân.
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>