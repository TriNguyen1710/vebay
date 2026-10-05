<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán đổi vé - Vietjet</title>

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

        .header {
            background: var(--primary-dark);
            color: white;
        }

        .header-inner {
            max-width: 1000px;
            min-height: 72px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .logo {
            color: white;
            font-size: 27px;
            font-weight: 800;
        }

        .logo span {
            color: var(--secondary);
        }

        .back {
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        .main {
            max-width: 950px;
            margin: 35px auto 70px;
            padding: 0 20px;
        }

        .page-title {
            color: var(--primary);
            font-size: 30px;
            margin-bottom: 8px;
        }

        .page-description {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 7px 28px rgba(0, 0, 0, 0.07);
            padding: 25px;
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 18px;
        }

        .comparison {
            display: grid;
            grid-template-columns: 1fr 50px 1fr;
            gap: 20px;
            align-items: center;
        }

        .flight-box {
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: #f8fafc;
        }

        .flight-box.new {
            background: #fffaf0;
            border-color: #e5cf8b;
        }

        .box-label {
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .flight-code {
            color: var(--primary);
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 9px;
        }

        .route {
            color: #374151;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .detail {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .arrow {
            text-align: center;
            color: var(--primary);
            font-size: 22px;
            font-weight: bold;
        }

        .price-table {
            width: 100%;
            border-collapse: collapse;
        }

        .price-table td {
            padding: 13px 5px;
            border-bottom: 1px solid #edf0f3;
            font-size: 13px;
        }

        .price-table td:last-child {
            text-align: right;
            font-weight: bold;
        }

        .total-box {
            margin-top: 20px;
            padding: 18px 20px;
            background: #fff8e4;
            border-left: 4px solid var(--secondary);
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .total-label {
            color: #62521e;
            font-size: 12px;
            font-weight: bold;
        }

        .total-price {
            color: #b42318;
            font-size: 25px;
            font-weight: 800;
        }

        .notice {
            padding: 15px 17px;
            background: #edf5fb;
            border: 1px solid #cddfea;
            border-radius: 8px;
            color: #36566e;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .payment-option {
            position: relative;
        }

        .payment-option input {
            display: none;
        }

        .payment-option label {
            display: block;
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 17px;
            cursor: pointer;
            transition: 0.15s;
            background: white;
        }

        .payment-option input:checked + label {
            border-color: var(--primary);
            background: #f5f9fc;
        }

        .payment-name {
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .payment-desc {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .payment-detail {
            display: none;
            margin-top: 20px;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 22px;
            background: #fafcfe;
        }

        .payment-detail.active {
            display: block;
        }

        .qr-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
            align-items: center;
        }

        .qr-box {
            text-align: center;
        }

        .qr-box img {
            width: 230px;
            max-width: 100%;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: white;
        }

        .transfer-info {
            display: grid;
            gap: 12px;
        }

        .info-row {
            border-bottom: 1px solid #e8edf2;
            padding-bottom: 10px;
        }

        .info-label {
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 4px;
        }

        .info-value {
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
        }

        .momo-box {
            max-width: 520px;
        }

        .momo-title {
            color: #a50064;
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .actions {
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .btn {
            border: none;
            border-radius: 7px;
            padding: 12px 19px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-back {
            background: #e8edf2;
            color: var(--primary);
        }

        .btn-pay {
            background: var(--success);
            color: white;
        }

        .btn-pay:hover {
            background: #146c43;
        }

        @media (max-width: 760px) {
            .comparison {
                grid-template-columns: 1fr;
            }

            .arrow {
                transform: rotate(90deg);
            }

            .payment-methods {
                grid-template-columns: 1fr;
            }

            .qr-layout {
                grid-template-columns: 1fr;
            }

            .total-box {
                flex-direction: column;
                align-items: flex-start;
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

@php
    $bankCode = 'MB';
    $bankAccount = '0123456789';
    $bankOwner = 'NGUYEN MINH TRI';
    $momoPhone = '0900000000';
    $momoOwner = 'NGUYEN MINH TRI';

    $transferContent = 'DOIVE' . $ticket->ticket_code;

    $qrUrl = 'https://img.vietqr.io/image/' .
        $bankCode . '-' .
        $bankAccount .
        '-compact2.png?amount=' .
        intval($amountToPay) .
        '&addInfo=' .
        urlencode($transferContent) .
        '&accountName=' .
        urlencode($bankOwner);
@endphp

<header class="header">

    <div class="header-inner">

        <a href="{{ route('trang-chu') }}" class="logo">
            Viet<span>jet</span>
        </a>

        <a href="{{ route('ticket.change.flight', $ticket->id) }}" class="back">
            ← Quay lại
        </a>

    </div>

</header>

<main class="main">

    <h1 class="page-title">
        Thanh toán đổi vé
    </h1>

    <p class="page-description">
        Kiểm tra thông tin chuyến mới và thanh toán khoản phí phát sinh để hoàn tất đổi vé.
    </p>

    <section class="card">

        <h2 class="section-title">
            Thay đổi hành trình
        </h2>

        <div class="comparison">

            <div class="flight-box">

                <div class="box-label">
                    Chuyến hiện tại
                </div>

                <div class="flight-code">
                    {{ $ticket->flight->flight_code }}
                </div>

                <div class="route">
                    {{ $ticket->flight->departureAirport->city }}
                    →
                    {{ $ticket->flight->arrivalAirport->city }}
                </div>

                <div class="detail">
                    Ngày: {{ $ticket->flight->flight_date->format('d/m/Y') }}
                    <br>
                    Giờ:
                    {{ substr($ticket->flight->departure_time, 0, 5) }}
                    -
                    {{ substr($ticket->flight->arrival_time, 0, 5) }}
                    <br>
                    Ghế: {{ $ticket->flightSeat->seat_number }}
                </div>

            </div>

            <div class="arrow">
                →
            </div>

            <div class="flight-box new">

                <div class="box-label">
                    Chuyến mới
                </div>

                <div class="flight-code">
                    {{ $flight->flight_code }}
                </div>

                <div class="route">
                    {{ $flight->departureAirport->city }}
                    →
                    {{ $flight->arrivalAirport->city }}
                </div>

                <div class="detail">
                    Ngày: {{ $flight->flight_date->format('d/m/Y') }}
                    <br>
                    Giờ:
                    {{ substr($flight->departure_time, 0, 5) }}
                    -
                    {{ substr($flight->arrival_time, 0, 5) }}
                    <br>
                    Ghế: {{ $seat->seat_number }}
                </div>

            </div>

        </div>

    </section>

    <section class="card">

        <h2 class="section-title">
            Chi tiết thanh toán
        </h2>

        <table class="price-table">

            <tr>
                <td>Giá vé hiện tại</td>
                <td>{{ number_format($ticket->price, 0, ',', '.') }} đ</td>
            </tr>

            <tr>
                <td>Giá vé chuyến mới</td>
                <td>{{ number_format($newPrice, 0, ',', '.') }} đ</td>
            </tr>

            <tr>
                <td>Chênh lệch giá vé cần trả</td>
                <td>{{ number_format($fareDifference, 0, ',', '.') }} đ</td>
            </tr>

            <tr>
                <td>Phí đổi vé</td>
                <td>{{ number_format($amountToPay - $fareDifference, 0, ',', '.') }} đ</td>
            </tr>

        </table>

        <div class="total-box">

            <div class="total-label">
                Tổng tiền cần thanh toán thêm
            </div>

            <div class="total-price">
                {{ number_format($amountToPay, 0, ',', '.') }} đ
            </div>

        </div>

    </section>

    <div class="notice">
        Ghế và vé hiện tại vẫn được giữ nguyên trong lúc thanh toán.
        Hệ thống chỉ chuyển sang chuyến mới và giải phóng ghế cũ sau khi bạn xác nhận đã thanh toán.
    </div>

    <section class="card">

        <h2 class="section-title">
            Chọn phương thức thanh toán
        </h2>

        <div class="payment-methods">

            <div class="payment-option">

                <input
                    type="radio"
                    name="payment_method"
                    id="bank"
                    value="bank"
                    checked
                >

                <label for="bank">

                    <div class="payment-name">
                        Chuyển khoản ngân hàng
                    </div>

                    <div class="payment-desc">
                        Quét mã QR để chuyển khoản đúng số tiền và nội dung.
                    </div>

                </label>

            </div>

            <div class="payment-option">

                <input
                    type="radio"
                    name="payment_method"
                    id="momo"
                    value="momo"
                >

                <label for="momo">

                    <div class="payment-name">
                        Ví MoMo
                    </div>

                    <div class="payment-desc">
                        Chuyển khoản đến số điện thoại MoMo của hệ thống.
                    </div>

                </label>

            </div>

        </div>

        <div id="bankDetail" class="payment-detail active">

            <div class="qr-layout">

                <div class="qr-box">

                    <img
                        src="{{ $qrUrl }}"
                        alt="QR thanh toán đổi vé"
                    >

                </div>

                <div class="transfer-info">

                    <div class="info-row">
                        <div class="info-label">
                            Ngân hàng
                        </div>
                        <div class="info-value">
                            MB Bank
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            Số tài khoản
                        </div>
                        <div class="info-value">
                            {{ $bankAccount }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            Chủ tài khoản
                        </div>
                        <div class="info-value">
                            {{ $bankOwner }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            Số tiền
                        </div>
                        <div class="info-value">
                            {{ number_format($amountToPay, 0, ',', '.') }} đ
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            Nội dung chuyển khoản
                        </div>
                        <div class="info-value">
                            {{ $transferContent }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div id="momoDetail" class="payment-detail">

            <div class="momo-box">

                <div class="momo-title">
                    Thanh toán qua MoMo
                </div>

                <div class="transfer-info">

                    <div class="info-row">
                        <div class="info-label">
                            Số điện thoại MoMo
                        </div>
                        <div class="info-value">
                            {{ $momoPhone }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            Chủ tài khoản
                        </div>
                        <div class="info-value">
                            {{ $momoOwner }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            Số tiền
                        </div>
                        <div class="info-value">
                            {{ number_format($amountToPay, 0, ',', '.') }} đ
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            Nội dung
                        </div>
                        <div class="info-value">
                            {{ $transferContent }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <form
            action="{{ route('ticket.change.pay', $ticket->id) }}"
            method="POST"
            onsubmit="return confirm('Bạn xác nhận đã thanh toán phí đổi vé?')"
        >

            @csrf

            <div class="actions">

                <a
                    href="{{ route('ticket.change.flight', $ticket->id) }}"
                    class="btn btn-back"
                >
                    ← Quay lại
                </a>

                <button
                    type="submit"
                    class="btn btn-pay"
                >
                    Tôi đã thanh toán
                </button>

            </div>

        </form>

    </section>

</main>

<script>
    const bankRadio = document.getElementById('bank');
    const momoRadio = document.getElementById('momo');
    const bankDetail = document.getElementById('bankDetail');
    const momoDetail = document.getElementById('momoDetail');

    function updatePaymentMethod() {
        if (bankRadio.checked) {
            bankDetail.classList.add('active');
            momoDetail.classList.remove('active');
        }

        if (momoRadio.checked) {
            momoDetail.classList.add('active');
            bankDetail.classList.remove('active');
        }
    }

    bankRadio.addEventListener('change', updatePaymentMethod);
    momoRadio.addEventListener('change', updatePaymentMethod);
</script>

</body>
</html>