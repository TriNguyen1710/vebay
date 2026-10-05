<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi chuyến bay - Vietjet</title>

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

        .header {
            background: var(--primary-dark);
            color: white;
        }

        .header-inner {
            max-width: 1100px;
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
            max-width: 1100px;
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

        .alert {
            padding: 14px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #fdebec;
            border: 1px solid #efc0c4;
            color: #922b33;
            font-size: 13px;
        }

        .section-title {
            color: var(--primary);
            font-size: 19px;
            margin: 28px 0 15px;
        }

        .current-ticket {
            background: white;
            border-radius: 13px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .current-label {
            padding: 11px 20px;
            background: var(--primary);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .flight-content {
            padding: 22px;
            display: grid;
            grid-template-columns: 1fr 100px 1fr 170px;
            align-items: center;
            gap: 20px;
        }

        .airport:last-of-type {
            text-align: right;
        }

        .city {
            color: var(--primary);
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .airport-name {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .route-center {
            text-align: center;
        }

        .flight-code {
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .line {
            height: 2px;
            background: #cbd5df;
            position: relative;
        }

        .line::before,
        .line::after {
            content: "";
            position: absolute;
            top: -3px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
        }

        .line::before {
            left: 0;
        }

        .line::after {
            right: 0;
        }

        .ticket-side {
            text-align: right;
        }

        .seat {
            color: #374151;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .price {
            color: #b42318;
            font-size: 19px;
            font-weight: 800;
        }

        .flight-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            margin-bottom: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }

        .flight-card .flight-content {
            grid-template-columns: 1fr 100px 1fr 190px;
        }

        .date {
            color: #4b5563;
            font-size: 12px;
            margin-top: 5px;
        }

        .new-flight-side {
            text-align: right;
        }

        .from-price {
            color: #6b7280;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 6px;
            padding: 11px 17px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            margin-top: 11px;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .empty {
            background: white;
            padding: 35px 25px;
            border-radius: 12px;
            text-align: center;
            color: var(--muted);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .notice {
            margin-top: 22px;
            padding: 15px 17px;
            background: #fff9e8;
            border-left: 4px solid var(--secondary);
            border-radius: 6px;
            color: #62521e;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 800px) {
            .flight-content,
            .flight-card .flight-content {
                grid-template-columns: 1fr;
            }

            .route-center {
                display: none;
            }

            .airport:last-of-type,
            .ticket-side,
            .new-flight-side {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<header class="header">
    <div class="header-inner">

        <a href="{{ route('trang-chu') }}" class="logo">
            Viet<span>jet</span>
        </a>

        <a href="{{ route('tickets.mine') }}" class="back">
            ← Quay lại Vé của tôi
        </a>

    </div>
</header>

<main class="main">

    <h1 class="page-title">
        Đổi chuyến bay
    </h1>

    <p class="page-description">
        Chọn chuyến bay mới có cùng điểm khởi hành và điểm đến với vé hiện tại.
    </p>

    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="section-title">
        Chuyến bay hiện tại
    </h2>

    <section class="current-ticket">

        <div class="current-label">
            Vé {{ $ticket->ticket_code }}
        </div>

        <div class="flight-content">

            <div class="airport">

                <div class="city">
                    {{ $ticket->flight->departureAirport->city }}
                </div>

                <div class="airport-name">
                    {{ $ticket->flight->departureAirport->name }}
                </div>

                <div class="date">
                    {{ $ticket->flight->flight_date->format('d/m/Y') }}
                    ·
                    {{ substr($ticket->flight->departure_time, 0, 5) }}
                </div>

            </div>

            <div class="route-center">

                <div class="flight-code">
                    {{ $ticket->flight->flight_code }}
                </div>

                <div class="line"></div>

            </div>

            <div class="airport">

                <div class="city">
                    {{ $ticket->flight->arrivalAirport->city }}
                </div>

                <div class="airport-name">
                    {{ $ticket->flight->arrivalAirport->name }}
                </div>

                <div class="date">
                    {{ substr($ticket->flight->arrival_time, 0, 5) }}
                </div>

            </div>

            <div class="ticket-side">

                <div class="seat">
                    Ghế {{ $ticket->flightSeat->seat_number }}
                    ·
                    {{ $ticket->seat_class === 'vip' ? 'VIP' : 'Phổ thông' }}
                </div>

                <div class="price">
                    {{ number_format($ticket->price, 0, ',', '.') }} đ
                </div>

            </div>

        </div>

    </section>

    <h2 class="section-title">
        Chọn chuyến bay mới
    </h2>

    @forelse($flights as $flight)

        <section class="flight-card">

            <div class="flight-content">

                <div class="airport">

                    <div class="city">
                        {{ $flight->departureAirport->city }}
                    </div>

                    <div class="airport-name">
                        {{ $flight->departureAirport->name }}
                    </div>

                    <div class="date">
                        {{ $flight->flight_date->format('d/m/Y') }}
                        ·
                        {{ substr($flight->departure_time, 0, 5) }}
                    </div>

                </div>

                <div class="route-center">

                    <div class="flight-code">
                        {{ $flight->flight_code }}
                    </div>

                    <div class="line"></div>

                </div>

                <div class="airport">

                    <div class="city">
                        {{ $flight->arrivalAirport->city }}
                    </div>

                    <div class="airport-name">
                        {{ $flight->arrivalAirport->name }}
                    </div>

                    <div class="date">
                        {{ substr($flight->arrival_time, 0, 5) }}
                    </div>

                </div>

                <div class="new-flight-side">

                    <div class="from-price">
                        Giá từ
                    </div>

                    <div class="price">
                        {{ number_format($flight->price, 0, ',', '.') }} đ
                    </div>

                    <a
                        href="{{ route('ticket.change.seat', [
                            'ticket' => $ticket->id,
                            'flight' => $flight->id
                        ]) }}"
                        class="btn btn-primary"
                    >
                        Chọn chuyến
                    </a>

                </div>

            </div>

        </section>

    @empty

        <div class="empty">
            Hiện chưa có chuyến bay khác phù hợp để đổi.
        </div>

    @endforelse

    <div class="notice">
        Vé và ghế hiện tại của bạn vẫn được giữ nguyên trong quá trình lựa chọn.
        Ghế cũ chỉ được giải phóng sau khi đổi vé thành công.
    </div>

</main>

</body>
</html>