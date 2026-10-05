<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn ghế mới - Vietjet</title>

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
            max-width: 900px;
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
            margin-bottom: 24px;
        }

        .flight-info {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 22px rgba(0, 0, 0, 0.06);
            padding: 20px;
            margin-bottom: 22px;
        }

        .flight-code {
            color: var(--primary);
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .flight-route {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .flight-date {
            color: var(--muted);
            font-size: 12px;
        }

        .alert {
            padding: 13px 15px;
            margin-bottom: 20px;
            border-radius: 7px;
            background: #fdebec;
            border: 1px solid #efc0c4;
            color: #922b33;
            font-size: 13px;
        }

        .legend {
            background: white;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 18px;
            display: flex;
            gap: 22px;
            flex-wrap: wrap;
            border: 1px solid var(--border);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #4b5563;
            font-size: 11px;
        }

        .legend-box {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 1px solid #ccd6df;
            background: white;
        }

        .legend-box.vip {
            background: #fff8e4;
            border-color: #d9c477;
        }

        .legend-box.selected {
            background: var(--primary);
            border-color: var(--primary);
        }

        .seat-map {
            background: white;
            border-radius: 14px;
            box-shadow: 0 7px 28px rgba(0, 0, 0, 0.07);
            padding: 30px 35px;
        }

        .cabin-title {
            text-align: center;
            color: var(--primary);
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 25px;
        }

        .seat-grid {
            display: grid;
            grid-template-columns: repeat(3, 82px) 60px repeat(3, 82px);
            justify-content: center;
            gap: 10px;
        }

        .seat-item input {
            display: none;
        }

        .seat-item label {
            width: 82px;
            height: 54px;
            border: 1px solid #cbd6df;
            border-radius: 7px;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #344657;
            font-size: 12px;
            font-weight: 800;
            transition: 0.15s;
        }

        .seat-item label:hover {
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        .seat-item.vip label {
            background: #fff9e8;
            border-color: #d8c477;
            color: #725d1c;
        }

        .seat-item input:checked + label {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .seat-item input:checked + label small {
            color: #dce9f2;
        }

        .seat-item label small {
            margin-top: 3px;
            color: var(--muted);
            font-size: 8px;
            font-weight: normal;
        }

        .aisle {
            width: 60px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9aa5af;
            font-size: 8px;
        }

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 25px;
        }

        .actions {
            margin-top: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .btn {
            border: none;
            border-radius: 7px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-back {
            background: #e8edf2;
            color: var(--primary);
        }

        .btn-primary {
            background: var(--secondary);
            color: #17202a;
        }

        .btn-primary:hover {
            background: #dda300;
        }

        @media (max-width: 700px) {
            .seat-map {
                padding: 22px 10px;
                overflow-x: auto;
            }

            .seat-grid {
                grid-template-columns: repeat(3, 60px) 30px repeat(3, 60px);
                gap: 5px;
                min-width: 430px;
            }

            .seat-item label {
                width: 60px;
                height: 46px;
                font-size: 10px;
            }

            .aisle {
                width: 30px;
                height: 46px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
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

        <a href="{{ route('ticket.change.flight', $ticket->id) }}" class="back">
            ← Chọn chuyến khác
        </a>
    </div>
</header>

<main class="main">

    <h1 class="page-title">
        Chọn ghế mới
    </h1>

    <p class="page-description">
        Chọn một ghế còn trống trên chuyến bay mới.
    </p>

    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <section class="flight-info">

        <div class="flight-code">
            {{ $flight->flight_code }}
        </div>

        <div class="flight-route">
            {{ $flight->departureAirport->city }}
            →
            {{ $flight->arrivalAirport->city }}
        </div>

        <div class="flight-date">
            {{ $flight->flight_date->format('d/m/Y') }}
            ·
            {{ substr($flight->departure_time, 0, 5) }}
            -
            {{ substr($flight->arrival_time, 0, 5) }}
        </div>

    </section>

    <div class="legend">

        <div class="legend-item">
            <span class="legend-box"></span>
            Ghế phổ thông
        </div>

        <div class="legend-item">
            <span class="legend-box vip"></span>
            Ghế VIP
        </div>

        <div class="legend-item">
            <span class="legend-box selected"></span>
            Ghế đang chọn
        </div>

    </div>

    @php
        $sortedSeats = $flight->flightSeats
            ->sort(function ($a, $b) {
                return strnatcmp($a->seat_number, $b->seat_number);
            })
            ->values();
    @endphp

    <form
        action="{{ route('ticket.change.confirm', $ticket->id) }}"
        method="POST"
    >

        @csrf

        <input
            type="hidden"
            name="flight_id"
            value="{{ $flight->id }}"
        >

        <section class="seat-map">

            <div class="cabin-title">
                Sơ đồ ghế chuyến bay
            </div>

            @if($sortedSeats->isNotEmpty())

                <div class="seat-grid">

                    @foreach($sortedSeats as $seat)

                        @php
                            $letter = substr($seat->seat_number, -1);
                        @endphp

                        @if($letter === 'D')
                            <div class="aisle">
                                LỐI ĐI
                            </div>
                        @endif

                        <div class="seat-item {{ $seat->seat_class === 'vip' ? 'vip' : '' }}">

                            <input
                                type="radio"
                                name="seat_id"
                                id="seat_{{ $seat->id }}"
                                value="{{ $seat->id }}"
                                required
                            >

                            <label for="seat_{{ $seat->id }}">

                                {{ $seat->seat_number }}

                                <small>
                                    {{ $seat->seat_class === 'vip' ? 'VIP' : 'Phổ thông' }}
                                </small>

                            </label>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty">
                    Chuyến bay này hiện không còn ghế trống.
                </div>

            @endif

        </section>

        <div class="actions">

            <a
                href="{{ route('ticket.change.flight', $ticket->id) }}"
                class="btn btn-back"
            >
                ← Quay lại
            </a>

            @if($sortedSeats->isNotEmpty())

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Tiếp tục thanh toán đổi vé
                </button>

            @endif

        </div>

    </form>

</main>

</body>
</html>