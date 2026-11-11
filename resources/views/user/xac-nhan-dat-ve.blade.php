
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đặt vé - SkyGo</title>

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

        button,
        input,
        select {
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
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
        }

        .navbar {
            max-width: 1240px;
            min-height: 76px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .logo {
            font-size: 27px;
            font-weight: 800;
            color: var(--primary);
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
            font-size: 15px;
            font-weight: bold;
            color: #293241;
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
            font-size: 14px;
            font-weight: bold;
            color: var(--primary);
        }

        .logout-btn {
            background: var(--danger);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 9px 14px;
            cursor: pointer;
            font-weight: bold;
        }

        .page-banner {
            min-height: 225px;
            background:
                linear-gradient(
                    90deg,
                    rgba(0, 31, 58, .94),
                    rgba(0, 59, 112, .53)
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

        .page-banner h1 {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .page-banner p {
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
            background: #dce3e9;
            border-radius: 50%;
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
            font-size: 11px;
            font-weight: bold;
            color: #737d86;
        }

        .step-line {
            width: 40px;
            height: 1px;
            background: #ccd4db;
            margin: 0 10px;
        }

        .booking-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 350px;
            gap: 22px;
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 7px 28px rgba(0, 0, 0, .08);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .card-header {
            padding: 22px 24px 18px;
            border-bottom: 1px solid #e8edf1;
        }

        .card-header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 4px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .card-body {
            padding: 22px 24px;
        }

        .trip-badge {
            background: var(--primary);
            color: white;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .flight-block + .flight-block {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e5eaee;
        }

        .flight-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .direction {
            min-width: 38px;
            height: 34px;
            background: var(--primary);
            color: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
        }

        .direction.return {
            background: #176a53;
        }

        .flight-title h3 {
            color: #344657;
            font-size: 16px;
        }

        .route-display {
            display: grid;
            grid-template-columns: 1fr 100px 1fr;
            gap: 15px;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e3e9ee;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 16px;
        }

        .airport:last-child {
            text-align: right;
        }

        .airport-city {
            display: block;
            color: var(--primary);
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .airport-time {
            color: #4d5d6b;
            font-size: 12px;
        }

        .route-line {
            text-align: center;
        }

        .line {
            height: 2px;
            background: #c6d1da;
            margin-bottom: 6px;
        }

        .route-line span {
            color: #8b949c;
            font-size: 9px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .detail-box {
            border: 1px solid #e5eaee;
            border-radius: 6px;
            padding: 12px;
        }

        .detail-label {
            display: block;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--muted);
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 12px;
            font-weight: bold;
            color: #344657;
        }

        .seat {
            color: var(--primary);
            font-size: 15px;
        }

        .price {
            color: #b42318;
        }

        .passenger-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .passenger-row {
            padding: 14px 0;
            border-bottom: 1px solid #edf0f3;
        }

        .passenger-row:nth-child(odd) {
            padding-right: 20px;
        }

        .passenger-row:nth-child(even) {
            padding-left: 20px;
            border-left: 1px solid #edf0f3;
        }

        .passenger-label {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 5px;
        }

        .passenger-value {
            display: block;
            color: #263746;
            font-size: 13px;
            font-weight: bold;
            word-break: break-word;
        }

        .edit-passenger-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            background: #edf5fb;
            color: var(--primary);
            border: 1px solid var(--primary);
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            white-space: nowrap;
        }

        .edit-passenger-button:hover {
            background: var(--primary);
            color: white;
        }

        /*
         * FORM CHỈNH SỬA NGAY TRONG KHUNG.
         */
        .inline-edit-form {
            display: none;
            padding: 22px 24px;
            border-top: 1px solid #e8edf1;
            background: #f8fbfe;
        }

        .inline-edit-form.is-open {
            display: block;
        }

        .edit-title {
            color: var(--primary);
            font-size: 16px;
            margin-bottom: 18px;
        }

        .edit-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .edit-group {
            margin-bottom: 13px;
        }

        .edit-group label {
            display: block;
            color: #374151;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .edit-input {
            width: 100%;
            height: 43px;
            border: 1px solid #ccd4dc;
            border-radius: 6px;
            padding: 0 12px;
            font-size: 13px;
            background: white;
            color: #263746;
            outline: none;
        }

        .edit-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, .08);
        }

        .edit-note {
            color: #7a848c;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 4px;
        }

        .edit-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .cancel-edit-button,
        .save-edit-button {
            border: none;
            border-radius: 6px;
            padding: 11px 18px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .cancel-edit-button {
            background: #e9eef3;
            color: #344657;
        }

        .save-edit-button {
            background: var(--primary);
            color: white;
        }

        .save-edit-button:hover {
            background: var(--primary-dark);
        }

        .payment-card {
            position: sticky;
            top: 20px;
        }

        .payment-header {
            background: var(--primary);
            padding: 22px 23px;
            color: white;
        }

        .payment-header h2 {
            font-size: 19px;
            margin-bottom: 5px;
        }

        .payment-header p {
            color: #d7e5ef;
            font-size: 11px;
            line-height: 1.5;
        }

        .payment-body {
            padding: 22px 23px;
        }

        .payment-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #edf0f3;
        }

        .payment-row span:first-child {
            color: var(--muted);
            font-size: 12px;
        }

        .payment-row strong {
            color: #344657;
            font-size: 12px;
            text-align: right;
        }

        .total-area {
            margin-top: 20px;
            padding: 17px;
            background: #fff9e8;
            border: 1px solid #ead795;
            border-left: 4px solid var(--secondary);
            border-radius: 6px;
        }

        .total-label {
            display: block;
            color: #665723;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .total-price {
            color: #b42318;
            font-size: 25px;
            font-weight: 800;
        }

        .payment-note {
            margin-top: 14px;
            color: #7a848c;
            font-size: 10px;
            line-height: 1.6;
        }

        .continue-button {
            width: 100%;
            margin-top: 20px;
            padding: 14px 18px;
            border: none;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .continue-button:hover {
            background: var(--primary-dark);
        }

        .secure-text {
            color: #8a939b;
            font-size: 9px;
            line-height: 1.5;
            margin-top: 9px;
            text-align: center;
        }

        .bottom-actions {
            margin-top: 4px;
        }

        .back-button {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .alert {
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-error {
            background: #fdebed;
            border: 1px solid #efbec4;
            color: #842029;
        }

        .alert-success {
            background: #eaf7f0;
            border: 1px solid #b8dfc8;
            color: #146c43;
        }

        footer {
            background: #031d33;
            color: white;
            text-align: center;
            padding: 35px 20px;
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

        @media (max-width: 950px) {
            .nav-menu {
                display: none;
            }

            .booking-layout {
                grid-template-columns: 1fr;
            }

            .payment-card {
                position: static;
            }
        }

        @media (max-width: 700px) {
            .top-bar {
                display: none;
            }

            .navbar {
                min-height: 65px;
            }

            .steps {
                display: none;
            }

            .page-banner h1 {
                font-size: 29px;
            }

            .card-header-flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .route-display {
                grid-template-columns: 1fr;
            }

            .route-line {
                display: none;
            }

            .airport:last-child {
                text-align: left;
            }

            .detail-grid {
                grid-template-columns: 1fr 1fr;
            }

            .passenger-grid,
            .edit-grid {
                grid-template-columns: 1fr;
            }

            .passenger-row:nth-child(odd),
            .passenger-row:nth-child(even) {
                padding-left: 0;
                padding-right: 0;
                border-left: none;
            }

            .edit-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

@php
    $tripType = $tripType ?? 'one_way';

    $passengerCount = max(
        1,
        min(
            5,
            (int) (
                $passengerCount
                ?? session('flight_search.passenger_count', 1)
            )
        )
    );

    $passengers = $passengers
        ?? session('booking.passengers', []);

    if (!is_array($passengers)) {
        $passengers = [];
    }

    if (
        !$passengers
        && $passengerCount === 1
    ) {
        $passengers = [
            $passenger ?? session('booking.passenger', [])
        ];
    }

    $passengers = array_values($passengers);

    $carryOn = \App\Models\BaggagePackage::where(
        'type',
        'carry_on'
    )
        ->where('status', true)
        ->first();

    $seats = collect(
        $seats
        ?? (
            $tripType === 'round_trip'
                ? $outboundSeats ?? []
                : []
        )
    );

    $outboundSeats = collect(
        $outboundSeats ?? []
    );

    $returnSeats = collect(
        $returnSeats ?? []
    );

    if (
        $tripType !== 'round_trip'
        && $seats->isEmpty()
        && isset($seat)
    ) {
        $seats = collect([$seat]);
    }

    if (
        $tripType === 'round_trip'
        && $outboundSeats->isEmpty()
        && isset($outboundSeat)
    ) {
        $outboundSeats = collect([$outboundSeat]);
    }

    if (
        $tripType === 'round_trip'
        && $returnSeats->isEmpty()
        && isset($returnSeat)
    ) {
        $returnSeats = collect([$returnSeat]);
    }

    $baggage = session('baggage', []);

    $outboundBaggage = session(
        'baggage.outbound',
        []
    );

    $returnBaggage = session(
        'baggage.return',
        []
    );

    $groupBaggage = session(
        'baggage.passengers',
        []
    );

    if (!is_array($groupBaggage)) {
        $groupBaggage = [];
    }

    $displayLegs = $tripType === 'round_trip'
        ? [
            [
                'flight' => $outboundFlight,
                'seats' => $outboundSeats,
                'code' => 'outbound',
            ],
            [
                'flight' => $returnFlight,
                'seats' => $returnSeats,
                'code' => 'return',
            ],
        ]
        : [
            [
                'flight' => $flight,
                'seats' => $seats,
                'code' => 'one_way',
            ],
        ];

    $passengerDetails = [];

    $selectedPrice = 0;
    $outboundPrice = 0;
    $returnPrice = 0;
    $totalBaggagePrice = 0;
    $totalPrice = 0;

    foreach ($passengers as $index => $person) {
        $personData = [
            'passenger' => $person,
            'legs' => [],
            'fare' => 0,
            'baggage' => 0,
            'total' => 0,
        ];

        foreach ($displayLegs as $leg) {
            $selectedSeat = $leg['seats']
                ->values()
                ->get($index);

            if (!$selectedSeat) {
                continue;
            }

            $fare = (float) $leg['flight']->price;

            if ($selectedSeat->seat_class === 'vip') {
                $fare += (float) $leg['flight']->vip_surcharge;
            }

            if ($passengerCount > 1) {
                $bag = $groupBaggage[$index][
                    $leg['code']
                ] ?? [];
            } else {
                if ($leg['code'] === 'outbound') {
                    $bag = $outboundBaggage;
                } elseif ($leg['code'] === 'return') {
                    $bag = $returnBaggage;
                } else {
                    $bag = $baggage;
                }
            }

            $bagWeight = (int) (
                $bag['weight'] ?? 0
            );

            $bagPrice = (float) (
                $bag['price'] ?? 0
            );

            $personData['legs'][$leg['code']] = [
                'seat' => $selectedSeat,
                'fare' => $fare,
                'baggage_weight' => $bagWeight,
                'baggage_price' => $bagPrice,
            ];

            $personData['fare'] += $fare;
            $personData['baggage'] += $bagPrice;
            $personData['total'] += $fare + $bagPrice;

            $totalBaggagePrice += $bagPrice;
            $totalPrice += $fare + $bagPrice;

            if ($leg['code'] === 'one_way') {
                $selectedPrice += $fare;
            }

            if ($leg['code'] === 'outbound') {
                $outboundPrice += $fare;
            }

            if ($leg['code'] === 'return') {
                $returnPrice += $fare;
            }
        }

        $passengerDetails[] = $personData;
    }
@endphp

{{-- TOP BAR --}}

<div class="top-bar">
    <div class="top-bar-inner">
        <div class="top-group">
            <span>Website đặt vé máy bay trực tuyến</span>
            <span>Hỗ trợ: 1900 6868</span>
        </div>

        <div class="top-group">
            @auth
                <a href="{{ route('profile.edit') }}">
                    Thông tin cá nhân
                </a>

                <a href="{{ route('notifications.index') }}">
                    Thông báo
                </a>
            @endauth
        </div>
    </div>
</div>

{{-- HEADER --}}

<header class="header">
    <nav class="navbar">

        <a href="{{ route('trang-chu') }}" class="logo">
            Sky<span>Go</span>
        </a>

        <div class="nav-menu">
            <a
                href="{{ route('trang-chu') }}"
                class="nav-link"
            >
                Trang chủ
            </a>

            <a
                href="{{ route('flights.search.form') }}"
                class="nav-link active"
            >
                Đặt vé
            </a>

            @auth
                <a
                    href="{{ route('tickets.mine') }}"
                    class="nav-link"
                >
                    Lịch sử vé
                </a>

                <a
                    href="{{ route('notifications.index') }}"
                    class="nav-link"
                >
                    Thông báo
                </a>
            @endauth
        </div>

        <div class="nav-actions">
            @auth
                <span class="user-name">
                    {{ auth()->user()->name }}
                </span>

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
            @endauth
        </div>

    </nav>
</header>

{{-- BANNER --}}

<section class="page-banner">
    <div class="banner-inner">

        <div class="breadcrumb">
            <a href="{{ route('trang-chu') }}">
                Trang chủ
            </a>
            <span>/</span>
            <a href="{{ route('flights.search.form') }}">
                Đặt vé
            </a>
            <span>/</span>
            <span>Xác nhận đặt vé</span>
        </div>

        <h1>Xác nhận thông tin đặt vé</h1>

        <p>
            Kiểm tra lại hành trình, thông tin hành khách
            và chi phí trước khi chuyển sang bước thanh toán.
        </p>

    </div>
</section>

{{-- MAIN --}}

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

        <div class="step done">
            <div class="step-number">4</div>
            <div class="step-text">Hành lý</div>
        </div>

        <div class="step-line"></div>

        <div class="step done">
            <div class="step-number">5</div>
            <div class="step-text">Khuôn mặt</div>
        </div>

        <div class="step-line"></div>

        <div class="step active">
            <div class="step-number">6</div>
            <div class="step-text">Xác nhận</div>
        </div>
        <div class="step-line"></div>

        <div class="step active">
            <div class="step-number">7</div>
            <div class="step-text">Thanh toán</div>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <strong>Vui lòng kiểm tra thông tin:</strong>

            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="booking-layout">

        {{-- BÊN TRÁI --}}

        <div>

            {{-- THÔNG TIN HÀNH TRÌNH --}}

            <section class="card">

                <div class="card-header">
                    <div class="card-header-flex">

                        <div>
                            <h2>Thông tin hành trình</h2>
                            <p>
                                Chuyến bay và các ghế bạn đã lựa chọn.
                            </p>
                        </div>

                        <div class="trip-badge">
                            {{ $tripType === 'round_trip'
                                ? 'KHỨ HỒI'
                                : 'MỘT CHIỀU' }}
                        </div>

                    </div>
                </div>

                <div class="card-body">

                    @foreach($displayLegs as $leg)

                        @php
                            $legFlight = $leg['flight'];
                            $legSeats = $leg['seats'];
                            $isReturn = $leg['code'] === 'return';
                        @endphp

                        <div class="flight-block">

                            <div class="flight-title">
                                <div class="direction {{ $isReturn ? 'return' : '' }}">
                                    {{ $isReturn ? 'VỀ' : 'ĐI' }}
                                </div>

                                <h3>
                                    @if($tripType === 'round_trip')
                                        {{ $isReturn ? 'Chiều về' : 'Chiều đi' }}
                                    @else
                                        Chuyến bay
                                    @endif
                                </h3>
                            </div>

                            <div class="route-display">

                                <div class="airport">
                                    <span class="airport-city">
                                        {{ $legFlight->departureAirport->city }}
                                    </span>
                                    <span class="airport-time">
                                        {{ substr($legFlight->departure_time, 0, 5) }}
                                    </span>
                                </div>

                                <div class="route-line">
                                    <div class="line"></div>
                                    <span>Bay thẳng</span>
                                </div>

                                <div class="airport">
                                    <span class="airport-city">
                                        {{ $legFlight->arrivalAirport->city }}
                                    </span>
                                    <span class="airport-time">
                                        {{ substr($legFlight->arrival_time, 0, 5) }}
                                    </span>
                                </div>

                            </div>

                            <div class="detail-grid">

                                <div class="detail-box">
                                    <span class="detail-label">
                                        Mã chuyến
                                    </span>
                                    <span class="detail-value">
                                        {{ $legFlight->flight_code }}
                                    </span>
                                </div>

                                <div class="detail-box">
                                    <span class="detail-label">
                                        Ngày bay
                                    </span>
                                    <span class="detail-value">
                                        {{ $legFlight->flight_date->format('d/m/Y') }}
                                    </span>
                                </div>

                                <div class="detail-box">
                                    <span class="detail-label">
                                        Ghế
                                    </span>
                                    <span class="detail-value seat">
                                        {{ $legSeats->pluck('seat_number')->implode(', ') }}
                                    </span>
                                </div>

                                <div class="detail-box">
                                    <span class="detail-label">
                                        Số lượng vé
                                    </span>
                                    <span class="detail-value">
                                        {{ $legSeats->count() }} vé
                                    </span>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>
            </section>

            {{-- TỪNG HÀNH KHÁCH --}}

            @foreach($passengerDetails as $i => $item)

                @php
                    $person = $item['passenger'];
                @endphp

                <section
                    class="card"
                    id="passenger-card-{{ $i }}"
                >

                    <div class="card-header">
                        <div class="card-header-flex">

                            <div>
                                <h2>
                                    Hành khách {{ $i + 1 }}
                                    —
                                    {{ $person['full_name'] ?? '' }}
                                </h2>

                                <p>
                                    Thông tin riêng của hành khách
                                    được sử dụng để phát hành vé điện tử.
                                </p>
                            </div>

                            {{-- NÚT MỞ FORM CHỈNH SỬA TẠI CHỖ --}}

                            <button
                                type="button"
                                class="edit-passenger-button"
                                onclick="togglePassengerEdit({{ $i }}, true)"
                            >
                                ✎ Chỉnh sửa thông tin
                            </button>

                        </div>
                    </div>

                    {{-- THÔNG TIN ĐANG HIỂN THỊ --}}

                    <div
                        class="card-body"
                        id="passenger-view-{{ $i }}"
                    >

                        <div class="passenger-grid">

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    Họ và tên
                                </span>
                                <span class="passenger-value">
                                    {{ $person['full_name'] ?? '' }}
                                </span>
                            </div>

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    Ngày sinh
                                </span>
                                <span class="passenger-value">
                                    @if(!empty($person['date_of_birth']))
                                        {{ \Carbon\Carbon::parse(
                                            $person['date_of_birth']
                                        )->format('d/m/Y') }}
                                    @endif
                                </span>
                            </div>

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    Giới tính
                                </span>
                                <span class="passenger-value">
                                    {{
                                        [
                                            'nam' => 'Nam',
                                            'nu' => 'Nữ',
                                            'khac' => 'Khác'
                                        ][$person['gender'] ?? ''] ?? 'Khác'
                                    }}
                                </span>
                            </div>

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    CCCD / Hộ chiếu
                                </span>
                                <span class="passenger-value">
                                    {{ $person['identity_number'] ?? '' }}
                                </span>
                            </div>

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    Số điện thoại
                                </span>
                                <span class="passenger-value">
                                    {{ $person['phone'] ?? '' }}
                                </span>
                            </div>

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    Email
                                </span>
                                <span class="passenger-value">
                                    {{ $person['email'] ?? '' }}
                                </span>
                            </div>

                            {{-- GHẾ VÀ HÀNH LÝ --}}

                            @foreach($item['legs'] as $legCode => $detail)

                                <div class="passenger-row">
                                    <span class="passenger-label">
                                        Ghế
                                        {{ $legCode === 'return'
                                            ? 'chiều về'
                                            : 'chiều đi' }}
                                    </span>

                                    <span class="passenger-value">
                                        {{ $detail['seat']->seat_number }}
                                        —
                                        {{ $detail['seat']->seat_class === 'vip'
                                            ? 'VIP'
                                            : 'Phổ thông' }}
                                        ({{ number_format(
                                            $detail['fare'],
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ)
                                    </span>
                                </div>

                                <div class="passenger-row">
                                    <span class="passenger-label">
                                        Hành lý ký gửi
                                        {{ $legCode === 'return'
                                            ? 'chiều về'
                                            : 'chiều đi' }}
                                    </span>

                                    <span class="passenger-value">
                                        @if($detail['baggage_weight'] > 0)
                                            {{ $detail['baggage_weight'] }} kg
                                        @else
                                            Không mua thêm
                                        @endif

                                        —
                                        {{ number_format(
                                            $detail['baggage_price'],
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ
                                    </span>
                                </div>

                            @endforeach

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    Hành lý xách tay
                                </span>
                                <span class="passenger-value">
                                    @if($carryOn)
                                        {{ $carryOn->weight }} kg
                                        — Đã bao gồm
                                    @else
                                        Theo chính sách hiện hành
                                    @endif
                                </span>
                            </div>

                            <div class="passenger-row">
                                <span class="passenger-label">
                                    Tổng riêng hành khách {{ $i + 1 }}
                                </span>
                                <span class="passenger-value price">
                                    {{ number_format(
                                        $item['total'],
                                        0,
                                        ',',
                                        '.'
                                    ) }} đ
                                </span>
                            </div>

                        </div>
                    </div>

                    {{-- FORM CHỈNH SỬA NGAY TẠI KHUNG --}}

                    <div
                        class="inline-edit-form"
                        id="passenger-edit-{{ $i }}"
                    >

                        <h3 class="edit-title">
                            Chỉnh sửa thông tin hành khách {{ $i + 1 }}
                        </h3>

                        <form
                            action="{{ route('passenger.confirm.update', ['index' => $i]) }}"
                            method="POST"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="editing_passenger_index"
                                value="{{ $i }}"
                            >

                            <div class="edit-grid">

                                {{-- HỌ TÊN --}}

                                <div class="edit-group">
                                    <label for="full_name_{{ $i }}">
                                        Họ và tên *
                                    </label>

                                    <input
                                        type="text"
                                        id="full_name_{{ $i }}"
                                        name="full_name"
                                        class="edit-input"
                                        value="{{ old(
                                            'editing_passenger_index'
                                        ) == $i && old(
                                            'editing_passenger_index'
                                        ) !== null
                                            ? old('full_name')
                                            : ($person['full_name'] ?? '')
                                        }}"
                                        required
                                        maxlength="255"
                                    >
                                </div>

                                {{-- NGÀY SINH --}}

                                <div class="edit-group">
                                    <label for="dob_{{ $i }}">
                                        Ngày sinh *
                                    </label>

                                    <input
                                        type="date"
                                        id="dob_{{ $i }}"
                                        name="date_of_birth"
                                        class="edit-input"
                                        value="{{ old(
                                            'editing_passenger_index'
                                        ) == $i && old(
                                            'editing_passenger_index'
                                        ) !== null
                                            ? old('date_of_birth')
                                            : ($person['date_of_birth'] ?? '')
                                        }}"
                                        max="{{ now()->subDay()->format('Y-m-d') }}"
                                        required
                                    >
                                </div>

                                {{-- GIỚI TÍNH --}}

                                @php
                                    $selectedGender = (
                                        old('editing_passenger_index') !== null
                                        && (int) old('editing_passenger_index') === $i
                                    )
                                        ? old('gender')
                                        : ($person['gender'] ?? '');
                                @endphp

                                <div class="edit-group">
                                    <label for="gender_{{ $i }}">
                                        Giới tính *
                                    </label>

                                    <select
                                        id="gender_{{ $i }}"
                                        name="gender"
                                        class="edit-input"
                                        required
                                    >
                                        <option value="">
                                            Chọn giới tính
                                        </option>

                                        <option
                                            value="nam"
                                            @selected($selectedGender === 'nam')
                                        >
                                            Nam
                                        </option>

                                        <option
                                            value="nu"
                                            @selected($selectedGender === 'nu')
                                        >
                                            Nữ
                                        </option>

                                        <option
                                            value="khac"
                                            @selected($selectedGender === 'khac')
                                        >
                                            Khác
                                        </option>
                                    </select>
                                </div>

                                {{-- CCCD --}}

                                <div class="edit-group">
                                    <label for="identity_{{ $i }}">
                                        Số CCCD / Hộ chiếu *
                                    </label>

                                    <input
                                        type="text"
                                        id="identity_{{ $i }}"
                                        name="identity_number"
                                        class="edit-input"
                                        value="{{ old(
                                            'editing_passenger_index'
                                        ) == $i && old(
                                            'editing_passenger_index'
                                        ) !== null
                                            ? old('identity_number')
                                            : ($person['identity_number'] ?? '')
                                        }}"
                                        maxlength="30"
                                        required
                                    >
                                </div>

                                {{-- SỐ ĐIỆN THOẠI --}}

                                <div class="edit-group">
                                    <label for="phone_{{ $i }}">
                                        Số điện thoại *
                                    </label>

                                    <input
                                        type="text"
                                        id="phone_{{ $i }}"
                                        name="phone"
                                        class="edit-input"
                                        value="{{ old(
                                            'editing_passenger_index'
                                        ) == $i && old(
                                            'editing_passenger_index'
                                        ) !== null
                                            ? old('phone')
                                            : ($person['phone'] ?? '')
                                        }}"
                                        maxlength="20"
                                        required
                                    >
                                </div>

                                {{-- EMAIL --}}

                                <div class="edit-group">
                                    <label for="email_{{ $i }}">
                                        Email *
                                    </label>

                                    <input
                                        type="email"
                                        id="email_{{ $i }}"
                                        name="email"
                                        class="edit-input"
                                        value="{{ old(
                                            'editing_passenger_index'
                                        ) == $i && old(
                                            'editing_passenger_index'
                                        ) !== null
                                            ? old('email')
                                            : ($person['email'] ?? '')
                                        }}"
                                        maxlength="255"
                                        required
                                    >
                                </div>

                            </div>

                            <p class="edit-note">
                                Ảnh CCCD đã tải lên được giữ nguyên.
                                Bạn chỉ đang sửa thông tin cá nhân,
                                không sửa ghế hoặc hành lý.
                            </p>

                            <p class="edit-note">
                                Nếu thay đổi họ tên, ngày sinh,
                                giới tính hoặc số CCCD,
                                hệ thống sẽ yêu cầu xác thực
                                khuôn mặt lại.
                            </p>

                            <div class="edit-actions">

                                <button
                                    type="button"
                                    class="cancel-edit-button"
                                    onclick="togglePassengerEdit({{ $i }}, false)"
                                >
                                    Hủy
                                </button>

                                <button
                                    type="submit"
                                    class="save-edit-button"
                                >
                                    Lưu thay đổi
                                </button>

                            </div>

                        </form>

                    </div>

                </section>

            @endforeach

        </div>

        {{-- CỘT PHẢI: THANH TOÁN --}}

        <aside class="card payment-card">

            <div class="payment-header">
                <h2>Chi tiết thanh toán</h2>
                <p>
                    Kiểm tra tổng chi phí trước khi tiếp tục.
                </p>
            </div>

            <div class="payment-body">

                <div class="payment-row">
                    <span>Số hành khách</span>
                    <strong>{{ $passengerCount }} người</strong>
                </div>

                <div class="payment-row">
                    <span>Số vé</span>
                    <strong>
                        {{ $passengerCount * (
                            $tripType === 'round_trip' ? 2 : 1
                        ) }} vé
                    </strong>
                </div>

                @if($tripType === 'round_trip')

                    <div class="payment-row">
                        <span>Giá vé chiều đi</span>
                        <strong>
                            {{ number_format(
                                $outboundPrice,
                                0,
                                ',',
                                '.'
                            ) }} đ
                        </strong>
                    </div>

                    <div class="payment-row">
                        <span>Giá vé chiều về</span>
                        <strong>
                            {{ number_format(
                                $returnPrice,
                                0,
                                ',',
                                '.'
                            ) }} đ
                        </strong>
                    </div>

                @else

                    <div class="payment-row">
                        <span>Tổng giá vé</span>
                        <strong>
                            {{ number_format(
                                $selectedPrice,
                                0,
                                ',',
                                '.'
                            ) }} đ
                        </strong>
                    </div>

                @endif

                <div class="payment-row">
                    <span>Tổng phí hành lý</span>
                    <strong>
                        {{ number_format(
                            $totalBaggagePrice,
                            0,
                            ',',
                            '.'
                        ) }} đ
                    </strong>
                </div>

                <div class="payment-row">
                    <span>Loại hành trình</span>
                    <strong>
                        {{ $tripType === 'round_trip'
                            ? 'Khứ hồi'
                            : 'Một chiều' }}
                    </strong>
                </div>

                <div class="total-area">
                    <span class="total-label">
                        Tổng thanh toán cho cả nhóm
                    </span>

                    <div class="total-price">
                        {{ number_format(
                            $totalPrice,
                            0,
                            ',',
                            '.'
                        ) }} đ
                    </div>
                </div>

                <p class="payment-note">
                    Sau khi xác nhận, hệ thống sẽ tạo mã đặt chỗ
                    và chuyển bạn đến trang thanh toán.
                </p>

                <form
                    action="{{ route('booking.store') }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="continue-button"
                    >
                        Xác nhận và tiếp tục thanh toán
                    </button>
                </form>

                <p class="secure-text">
                    Vui lòng kiểm tra kỹ thông tin hành khách
                    trước khi tiếp tục.
                </p>

            </div>

        </aside>

    </div>

    <div class="bottom-actions">
        <a
            href="{{ route('face.create', ['review' => 1]) }}"
            class="back-button"
        >
            ← Quay lại bước quét khuôn mặt
        </a>
    </div>

</main>

<footer>
    <div class="footer-logo">
        Sky<span>Go</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp
        nhận diện khuôn mặt.
    </p>
</footer>

<script>
    /*
     * Hiển thị form chỉnh sửa ngay tại khung.
     * Không chuyển trang.
     */
    function togglePassengerEdit(index, open) {

        const view = document.getElementById(
            'passenger-view-' + index
        );

        const form = document.getElementById(
            'passenger-edit-' + index
        );

        if (!view || !form) {
            return;
        }

        if (open) {
            view.style.display = 'none';
            form.classList.add('is-open');

            const firstInput = form.querySelector(
                'input[name="full_name"]'
            );

            if (firstInput) {
                firstInput.focus();
            }

        } else {
            form.classList.remove('is-open');
            view.style.display = 'block';
        }
    }

    /*
     * Nếu lưu bị lỗi validation,
     * tự mở lại form của hành khách vừa sửa.
     */
    const editingIndex = @json(
        old('editing_passenger_index')
    );

    const hasErrors = @json($errors->any());

    if (
        hasErrors
        && editingIndex !== null
        && editingIndex !== ''
    ) {
        const index = Number(editingIndex);

        togglePassengerEdit(index, true);

        const card = document.getElementById(
            'passenger-card-' + index
        );

        if (card) {
            card.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    }
</script>

</body>
</html>
