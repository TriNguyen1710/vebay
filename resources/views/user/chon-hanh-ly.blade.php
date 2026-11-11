
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn hành lý - Vietjet</title>

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
            --white: #ffffff;
            --background: #f3f6f9;
            --text: #22313f;
            --muted: #74818c;
            --border: #dfe6eb;
            --success: #198754;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        button,
        input {
            font-family: inherit;
        }

        .page {
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
        }

        .topbar-inner {
            width: min(1100px, calc(100% - 40px));
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            color: var(--primary);
            font-size: 23px;
            font-weight: 800;
        }

        .brand span {
            color: var(--secondary);
        }

        .back-btn {
            min-height: 38px;
            padding: 0 16px;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .content {
            width: min(1100px, calc(100% - 40px));
            margin: auto;
            padding: 32px 0 50px;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h1 {
            color: var(--primary-dark);
            font-size: 28px;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(20, 45, 65, .04);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .card-header {
            padding: 19px 22px;
            border-bottom: 1px solid #e8edf1;
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 16px;
            margin-bottom: 5px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 10px;
        }

        .card-body {
            padding: 22px;
        }

        .carry-on-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 18px;
            border: 1px solid #cfe0eb;
            border-radius: 8px;
            background: var(--primary-light);
        }

        .carry-on-title {
            color: var(--primary-dark);
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .carry-on-text {
            color: #607280;
            font-size: 11px;
        }

        .carry-on-weight {
            color: var(--primary);
            font-size: 22px;
            font-weight: 800;
            white-space: nowrap;
        }

        .trip-section {
            margin-bottom: 26px;
        }

        .trip-section:last-child {
            margin-bottom: 0;
        }

        .trip-title {
            margin-bottom: 13px;
            color: var(--primary-dark);
            font-size: 14px;
            font-weight: bold;
        }

        .packages {
            display: grid;
            grid-template-columns: repeat(
                3,
                minmax(0, 1fr)
            );
            gap: 14px;
        }

        .package-option {
            position: relative;
        }

        .package-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .package-card {
            min-height: 125px;
            padding: 17px;
            border: 2px solid #e1e7eb;
            border-radius: 9px;
            background: white;
            cursor: pointer;
            transition: .2s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .package-card:hover {
            border-color: #9db8cb;
        }

        .package-option input:checked + .package-card {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, .06);
        }

        .package-name {
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .package-weight {
            color: #536675;
            font-size: 11px;
        }

        .package-price {
            margin-top: 14px;
            color: #b42318;
            font-size: 15px;
            font-weight: 800;
        }

        .package-free .package-price {
            color: var(--success);
        }

        .empty {
            padding: 18px;
            border: 1px dashed #cbd5dd;
            border-radius: 8px;
            color: var(--muted);
            font-size: 11px;
            text-align: center;
        }

        .summary {
            margin-top: 22px;
            padding: 17px 18px;
            border-radius: 8px;
            background: #fff9df;
            border-left: 3px solid var(--secondary);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .summary-label {
            color: #6b6250;
        }

        .summary-value {
            color: #3d3520;
            font-weight: bold;
            text-align: right;
        }

        .actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            min-height: 42px;
            padding: 0 20px;
            border: 0;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-secondary {
            background: #e9eef2;
            color: #425361;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        /* BỔ SUNG: THÔNG TIN TỪNG HÀNH KHÁCH */

        .passenger-card-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .passenger-name {
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        .passenger-number {
            display: inline-block;
            padding: 7px 12px;
            background: #edf5fb;
            color: var(--primary);
            border: 1px solid #d4e2ee;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .passenger-note {
            padding: 13px 15px;
            margin-bottom: 22px;
            background: #edf5fb;
            border-left: 3px solid var(--primary);
            color: #435c70;
            font-size: 12px;
            line-height: 1.6;
        }

        .passenger-baggage-total {
            margin-top: 20px;
            padding: 13px 15px;
            background: #f8fafc;
            border: 1px solid #e1e7eb;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            font-size: 13px;
        }

        .passenger-baggage-total strong {
            color: #b42318;
            font-size: 16px;
        }

        .alert-error {
            padding: 13px 15px;
            margin-bottom: 20px;
            background: #fdebed;
            border: 1px solid #efbcc2;
            border-radius: 7px;
            color: #842029;
            font-size: 13px;
        }

        .alert-error ul {
            padding-left: 20px;
            margin-top: 7px;
        }

        .total-group-box {
            margin-top: 22px;
            padding: 18px;
            border-radius: 8px;
            background: #fff9df;
            border: 1px solid #eadca7;
            border-left: 4px solid var(--secondary);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .total-group-box span {
            color: #5d522e;
            font-size: 13px;
            font-weight: bold;
        }

        .total-group-box strong {
            color: #b42318;
            font-size: 20px;
            font-weight: 800;
        }

        @media (max-width: 800px) {
            .packages {
                grid-template-columns: repeat(
                    2,
                    minmax(0, 1fr)
                );
            }
        }

        @media (max-width: 560px) {
            .topbar-inner,
            .content {
                width: min(100% - 24px, 1100px);
            }

            .carry-on-box {
                align-items: flex-start;
                flex-direction: column;
            }

            .packages {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .passenger-baggage-total,
            .total-group-box {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="page">

    {{-- THANH ĐIỀU HƯỚNG --}}

    <header class="topbar">

        <div class="topbar-inner">

            <a
                href="{{ route('trang-chu') }}"
                class="brand"
            >
                Viet<span>jet</span>
            </a>

            <a
                href="{{ route('passenger.create') }}"
                class="back-btn"
            >
                Quay lại
            </a>

        </div>

    </header>

    <main class="content">

        {{-- TIÊU ĐỀ --}}

        <div class="page-heading">

            <h1>Chọn hành lý</h1>

            <p>
                Chọn hành lý ký gửi phù hợp
                trước khi tiếp tục quét khuôn mặt.
            </p>

        </div>

        {{-- THÔNG BÁO LỖI --}}

        @if(session('error'))

            <div class="alert-error">
                {{ session('error') }}
            </div>

        @endif

        @if($errors->any())

            <div class="alert-error">

                <strong>
                    Vui lòng kiểm tra lại thông tin:
                </strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        {{-- HÀNH LÝ XÁCH TAY MIỄN PHÍ --}}

        @if($carryOn)

            <section class="card">

                <div class="card-header">

                    <h2>Hành lý xách tay</h2>

                    <p>
                        Hành lý xách tay đã được
                        bao gồm miễn phí trong vé.
                    </p>

                </div>

                <div class="card-body">

                    <div class="carry-on-box">

                        <div>

                            <div class="carry-on-title">
                                Hành lý xách tay miễn phí
                            </div>

                            <div class="carry-on-text">
                                Mỗi hành khách đều có
                                hành lý xách tay miễn phí.
                                Bạn không cần thanh toán thêm.
                            </div>

                        </div>

                        <div class="carry-on-weight">
                            {{ $carryOn->weight }} kg
                        </div>

                    </div>

                </div>

            </section>

        @endif

        {{-- FORM CHỌN HÀNH LÝ --}}

        <form
            action="{{ route('baggage.store') }}"
            method="POST"
            id="baggageForm"
        >
            @csrf

            @if($passengerCount === 1)

                {{-- =====================================
                     MỘT HÀNH KHÁCH: GIỮ LUỒNG CŨ
                ====================================== --}}

                <section class="card">

                    <div class="card-header">

                        <h2>Hành lý ký gửi</h2>

                        <p>
                            Không bắt buộc.
                            Bạn có thể chọn "Không mua thêm".
                        </p>

                    </div>

                    <div class="card-body">

                        @if($tripType === 'round_trip')

                            {{-- CHIỀU ĐI --}}

                            <div class="trip-section">

                                <div class="trip-title">
                                    Chiều đi
                                </div>

                                <div class="packages">

                                    <label class="package-option">

                                        <input
                                            type="radio"
                                            name="outbound_baggage_package_id"
                                            value=""
                                            data-price="0"
                                            data-summary="Không mua thêm"
                                            @checked(
                                                old(
                                                    'outbound_baggage_package_id',
                                                    $outboundBaggage['package_id'] ?? ''
                                                ) == ''
                                            )
                                        >

                                        <div class="package-card package-free">

                                            <div>
                                                <div class="package-name">
                                                    Không mua thêm
                                                </div>

                                                <div class="package-weight">
                                                    Không có hành lý ký gửi
                                                </div>
                                            </div>

                                            <div class="package-price">
                                                0đ
                                            </div>

                                        </div>

                                    </label>

                                    @foreach($checkedPackages as $package)

                                        <label class="package-option">

                                            <input
                                                type="radio"
                                                name="outbound_baggage_package_id"
                                                value="{{ $package->id }}"
                                                data-price="{{ $package->price }}"
                                                data-summary="{{ $package->name }} - {{ $package->weight }}kg"
                                                @checked(
                                                    old(
                                                        'outbound_baggage_package_id',
                                                        $outboundBaggage['package_id'] ?? ''
                                                    ) == $package->id
                                                )
                                            >

                                            <div class="package-card">

                                                <div>
                                                    <div class="package-name">
                                                        {{ $package->name }}
                                                    </div>

                                                    <div class="package-weight">
                                                        {{ $package->weight }} kg ký gửi
                                                    </div>
                                                </div>

                                                <div class="package-price">
                                                    {{ number_format($package->price, 0, ',', '.') }}đ
                                                </div>

                                            </div>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                            {{-- CHIỀU VỀ --}}

                            <div class="trip-section">

                                <div class="trip-title">
                                    Chiều về
                                </div>

                                <div class="packages">

                                    <label class="package-option">

                                        <input
                                            type="radio"
                                            name="return_baggage_package_id"
                                            value=""
                                            data-price="0"
                                            data-summary="Không mua thêm"
                                            @checked(
                                                old(
                                                    'return_baggage_package_id',
                                                    $returnBaggage['package_id'] ?? ''
                                                ) == ''
                                            )
                                        >

                                        <div class="package-card package-free">

                                            <div>
                                                <div class="package-name">
                                                    Không mua thêm
                                                </div>

                                                <div class="package-weight">
                                                    Không có hành lý ký gửi
                                                </div>
                                            </div>

                                            <div class="package-price">
                                                0đ
                                            </div>

                                        </div>

                                    </label>

                                    @foreach($checkedPackages as $package)

                                        <label class="package-option">

                                            <input
                                                type="radio"
                                                name="return_baggage_package_id"
                                                value="{{ $package->id }}"
                                                data-price="{{ $package->price }}"
                                                data-summary="{{ $package->name }} - {{ $package->weight }}kg"
                                                @checked(
                                                    old(
                                                        'return_baggage_package_id',
                                                        $returnBaggage['package_id'] ?? ''
                                                    ) == $package->id
                                                )
                                            >

                                            <div class="package-card">

                                                <div>
                                                    <div class="package-name">
                                                        {{ $package->name }}
                                                    </div>

                                                    <div class="package-weight">
                                                        {{ $package->weight }} kg ký gửi
                                                    </div>
                                                </div>

                                                <div class="package-price">
                                                    {{ number_format($package->price, 0, ',', '.') }}đ
                                                </div>

                                            </div>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        @else

                            {{-- MỘT CHIỀU --}}

                            <div class="packages">

                                <label class="package-option">

                                    <input
                                        type="radio"
                                        name="baggage_package_id"
                                        value=""
                                        data-price="0"
                                        data-summary="Không mua thêm"
                                        @checked(
                                            old(
                                                'baggage_package_id',
                                                $singleBaggage['package_id'] ?? ''
                                            ) == ''
                                        )
                                    >

                                    <div class="package-card package-free">

                                        <div>
                                            <div class="package-name">
                                                Không mua thêm
                                            </div>

                                            <div class="package-weight">
                                                Không có hành lý ký gửi
                                            </div>
                                        </div>

                                        <div class="package-price">
                                            0đ
                                        </div>

                                    </div>

                                </label>

                                @foreach($checkedPackages as $package)

                                    <label class="package-option">

                                        <input
                                            type="radio"
                                            name="baggage_package_id"
                                            value="{{ $package->id }}"
                                            data-price="{{ $package->price }}"
                                            data-summary="{{ $package->name }} - {{ $package->weight }}kg"
                                            @checked(
                                                old(
                                                    'baggage_package_id',
                                                    $singleBaggage['package_id'] ?? ''
                                                ) == $package->id
                                            )
                                        >

                                        <div class="package-card">

                                            <div>
                                                <div class="package-name">
                                                    {{ $package->name }}
                                                </div>

                                                <div class="package-weight">
                                                    {{ $package->weight }} kg ký gửi
                                                </div>
                                            </div>

                                            <div class="package-price">
                                                {{ number_format($package->price, 0, ',', '.') }}đ
                                            </div>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        @endif

                        @if($checkedPackages->isEmpty())

                            <div
                                class="empty"
                                style="margin-top:16px;"
                            >
                                Hiện chưa có gói hành lý ký gửi nào
                                đang được mở bán.

                                Bạn vẫn có thể tiếp tục
                                mà không mua hành lý ký gửi.
                            </div>

                        @endif

                        {{-- TÓM TẮT MỘT HÀNH KHÁCH --}}

                        <div class="summary">

                            @if($tripType === 'round_trip')

                                <div class="summary-row">

                                    <span class="summary-label">
                                        Hành lý chiều đi
                                    </span>

                                    <span
                                        class="summary-value"
                                        id="outboundSummary"
                                    >
                                        Không mua thêm
                                    </span>

                                </div>

                                <div class="summary-row">

                                    <span class="summary-label">
                                        Hành lý chiều về
                                    </span>

                                    <span
                                        class="summary-value"
                                        id="returnSummary"
                                    >
                                        Không mua thêm
                                    </span>

                                </div>

                            @else

                                <div class="summary-row">

                                    <span class="summary-label">
                                        Hành lý ký gửi
                                    </span>

                                    <span
                                        class="summary-value"
                                        id="singleSummary"
                                    >
                                        Không mua thêm
                                    </span>

                                </div>

                            @endif

                            <div class="summary-row">

                                <span class="summary-label">
                                    Phí hành lý
                                </span>

                                <span
                                    class="summary-value"
                                    id="totalBaggagePrice"
                                >
                                    0đ
                                </span>

                            </div>

                        </div>

                    </div>

                </section>

            @else

                {{-- =====================================
                     NHIỀU HÀNH KHÁCH: 2–5 NGƯỜI
                ====================================== --}}

                <div class="passenger-note">
                    Bạn đang đặt vé cho
                    <strong>{{ $passengerCount }} hành khách</strong>.

                    Mỗi người được chọn gói hành lý ký gửi riêng.

                    @if($tripType === 'round_trip')
                        Với vé khứ hồi, hãy chọn riêng
                        hành lý chiều đi và chiều về
                        cho từng người.
                    @endif
                </div>

                @for($i = 0; $i < $passengerCount; $i++)

                    @php
                        $person = $passengers[$i] ?? [];

                        $savedBaggage =
                            $passengerBaggage[$i] ?? [];

                        $selectedOutbound = old(
                            "baggage.$i.outbound_package_id",
                            $savedBaggage['outbound']['package_id'] ?? ''
                        );

                        $selectedReturn = old(
                            "baggage.$i.return_package_id",
                            $savedBaggage['return']['package_id'] ?? ''
                        );

                        $selectedOneWay = old(
                            "baggage.$i.package_id",
                            $savedBaggage['one_way']['package_id'] ?? ''
                        );
                    @endphp

                    <section class="card">

                        <div class="card-header">

                            <div class="passenger-card-title">

                                <h2 class="passenger-name">
                                    Hành khách {{ $i + 1 }}:
                                    {{ $person['full_name'] ?? 'Chưa có tên' }}
                                </h2>

                                <span class="passenger-number">
                                    Người {{ $i + 1 }}
                                    / {{ $passengerCount }}
                                </span>

                            </div>

                            <p style="margin-top:8px;">
                                Chọn hành lý ký gửi cho hành khách này.
                            </p>

                        </div>

                        <div class="card-body">

                            @if($tripType === 'round_trip')

                                {{-- CHIỀU ĐI CỦA HÀNH KHÁCH --}}

                                <div class="trip-section">

                                    <div class="trip-title">
                                        Hành lý chiều đi
                                    </div>

                                    <div class="packages">

                                        <label class="package-option">

                                            <input
                                                type="radio"
                                                name="baggage[{{ $i }}][outbound_package_id]"
                                                value=""
                                                data-price="0"
                                                data-summary="Không mua thêm"
                                                data-passenger="{{ $i }}"
                                                @checked($selectedOutbound == '')
                                            >

                                            <div class="package-card package-free">

                                                <div>
                                                    <div class="package-name">
                                                        Không mua thêm
                                                    </div>

                                                    <div class="package-weight">
                                                        Không có hành lý ký gửi
                                                    </div>
                                                </div>

                                                <div class="package-price">
                                                    0đ
                                                </div>

                                            </div>

                                        </label>

                                        @foreach($checkedPackages as $package)

                                            <label class="package-option">

                                                <input
                                                    type="radio"
                                                    name="baggage[{{ $i }}][outbound_package_id]"
                                                    value="{{ $package->id }}"
                                                    data-price="{{ $package->price }}"
                                                    data-summary="{{ $package->name }} - {{ $package->weight }}kg"
                                                    data-passenger="{{ $i }}"
                                                    @checked($selectedOutbound == $package->id)
                                                >

                                                <div class="package-card">

                                                    <div>
                                                        <div class="package-name">
                                                            {{ $package->name }}
                                                        </div>

                                                        <div class="package-weight">
                                                            {{ $package->weight }} kg ký gửi
                                                        </div>
                                                    </div>

                                                    <div class="package-price">
                                                        {{ number_format($package->price, 0, ',', '.') }}đ
                                                    </div>

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>

                                </div>

                                {{-- CHIỀU VỀ CỦA HÀNH KHÁCH --}}

                                <div class="trip-section">

                                    <div class="trip-title">
                                        Hành lý chiều về
                                    </div>

                                    <div class="packages">

                                        <label class="package-option">

                                            <input
                                                type="radio"
                                                name="baggage[{{ $i }}][return_package_id]"
                                                value=""
                                                data-price="0"
                                                data-summary="Không mua thêm"
                                                data-passenger="{{ $i }}"
                                                @checked($selectedReturn == '')
                                            >

                                            <div class="package-card package-free">

                                                <div>
                                                    <div class="package-name">
                                                        Không mua thêm
                                                    </div>

                                                    <div class="package-weight">
                                                        Không có hành lý ký gửi
                                                    </div>
                                                </div>

                                                <div class="package-price">
                                                    0đ
                                                </div>

                                            </div>

                                        </label>

                                        @foreach($checkedPackages as $package)

                                            <label class="package-option">

                                                <input
                                                    type="radio"
                                                    name="baggage[{{ $i }}][return_package_id]"
                                                    value="{{ $package->id }}"
                                                    data-price="{{ $package->price }}"
                                                    data-summary="{{ $package->name }} - {{ $package->weight }}kg"
                                                    data-passenger="{{ $i }}"
                                                    @checked($selectedReturn == $package->id)
                                                >

                                                <div class="package-card">

                                                    <div>
                                                        <div class="package-name">
                                                            {{ $package->name }}
                                                        </div>

                                                        <div class="package-weight">
                                                            {{ $package->weight }} kg ký gửi
                                                        </div>
                                                    </div>

                                                    <div class="package-price">
                                                        {{ number_format($package->price, 0, ',', '.') }}đ
                                                    </div>

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>

                                </div>

                            @else

                                {{-- MỘT CHIỀU CỦA HÀNH KHÁCH --}}

                                <div class="trip-section">

                                    <div class="trip-title">
                                        Hành lý ký gửi
                                    </div>

                                    <div class="packages">

                                        <label class="package-option">

                                            <input
                                                type="radio"
                                                name="baggage[{{ $i }}][package_id]"
                                                value=""
                                                data-price="0"
                                                data-summary="Không mua thêm"
                                                data-passenger="{{ $i }}"
                                                @checked($selectedOneWay == '')
                                            >

                                            <div class="package-card package-free">

                                                <div>
                                                    <div class="package-name">
                                                        Không mua thêm
                                                    </div>

                                                    <div class="package-weight">
                                                        Không có hành lý ký gửi
                                                    </div>
                                                </div>

                                                <div class="package-price">
                                                    0đ
                                                </div>

                                            </div>

                                        </label>

                                        @foreach($checkedPackages as $package)

                                            <label class="package-option">

                                                <input
                                                    type="radio"
                                                    name="baggage[{{ $i }}][package_id]"
                                                    value="{{ $package->id }}"
                                                    data-price="{{ $package->price }}"
                                                    data-summary="{{ $package->name }} - {{ $package->weight }}kg"
                                                    data-passenger="{{ $i }}"
                                                    @checked($selectedOneWay == $package->id)
                                                >

                                                <div class="package-card">

                                                    <div>
                                                        <div class="package-name">
                                                            {{ $package->name }}
                                                        </div>

                                                        <div class="package-weight">
                                                            {{ $package->weight }} kg ký gửi
                                                        </div>
                                                    </div>

                                                    <div class="package-price">
                                                        {{ number_format($package->price, 0, ',', '.') }}đ
                                                    </div>

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>

                                </div>

                            @endif

                            @if($checkedPackages->isEmpty())

                                <div class="empty">
                                    Hiện chưa có gói hành lý ký gửi
                                    nào đang mở bán.

                                    Bạn có thể tiếp tục
                                    mà không mua thêm.
                                </div>

                            @endif

                            {{-- TỔNG TIỀN HÀNH LÝ TỪNG NGƯỜI --}}

                            <div class="passenger-baggage-total">

                                <span>
                                    Tổng phí hành lý
                                    hành khách {{ $i + 1 }}
                                </span>

                                <strong id="passengerTotal{{ $i }}">
                                    0đ
                                </strong>

                            </div>

                        </div>

                    </section>

                @endfor

                {{-- TỔNG PHÍ HÀNH LÝ CẢ NHÓM --}}

                <div class="total-group-box">

                    <span>
                        Tổng phí hành lý của
                        {{ $passengerCount }} hành khách
                    </span>

                    <strong id="totalBaggagePrice">
                        0đ
                    </strong>

                </div>

            @endif

            {{-- NÚT TIẾP TỤC --}}

            <div class="actions">

                <a
                    href="{{ route('passenger.create') }}"
                    class="btn btn-secondary"
                >
                    Quay lại
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Tiếp tục quét khuôn mặt
                </button>

            </div>

        </form>

    </main>

</div>

{{-- JAVASCRIPT --}}

<script>
    /*
    |--------------------------------------------------------------------------
    | ĐỊNH DẠNG TIỀN
    |--------------------------------------------------------------------------
    */

    function formatMoney(value) {
        return new Intl.NumberFormat('vi-VN')
            .format(value) + 'đ';
    }

    /*
    |--------------------------------------------------------------------------
    | CẬP NHẬT TỔNG TIỀN HÀNH LÝ
    |--------------------------------------------------------------------------
    */

    function updateSummary() {

        let total = 0;

        /*
         * LUỒNG MỘT HÀNH KHÁCH CŨ
         */
        const single = document.querySelector(
            'input[name="baggage_package_id"]:checked'
        );

        if (single) {
            total += Number(single.dataset.price || 0);

            const summary = document.getElementById(
                'singleSummary'
            );

            if (summary) {
                summary.textContent =
                    single.dataset.summary;
            }
        }

        const outbound = document.querySelector(
            'input[name="outbound_baggage_package_id"]:checked'
        );

        if (outbound) {
            total += Number(
                outbound.dataset.price || 0
            );

            const summary = document.getElementById(
                'outboundSummary'
            );

            if (summary) {
                summary.textContent =
                    outbound.dataset.summary;
            }
        }

        const returnBaggage = document.querySelector(
            'input[name="return_baggage_package_id"]:checked'
        );

        if (returnBaggage) {
            total += Number(
                returnBaggage.dataset.price || 0
            );

            const summary = document.getElementById(
                'returnSummary'
            );

            if (summary) {
                summary.textContent =
                    returnBaggage.dataset.summary;
            }
        }

        /*
         * LUỒNG NHIỀU HÀNH KHÁCH
         */
        const passengerCount = @json($passengerCount);

        if (passengerCount > 1) {

            total = 0;

            for (
                let i = 0;
                i < passengerCount;
                i++
            ) {

                let passengerTotal = 0;

                const selectedPackages =
                    document.querySelectorAll(
                        'input[data-passenger="' +
                        i +
                        '"]:checked'
                    );

                selectedPackages.forEach(
                    function (input) {
                        passengerTotal += Number(
                            input.dataset.price || 0
                        );
                    }
                );

                const passengerTotalElement =
                    document.getElementById(
                        'passengerTotal' + i
                    );

                if (passengerTotalElement) {
                    passengerTotalElement.textContent =
                        formatMoney(passengerTotal);
                }

                total += passengerTotal;
            }
        }

        /*
         * TỔNG PHÍ HÀNH LÝ
         */
        const totalElement = document.getElementById(
            'totalBaggagePrice'
        );

        if (totalElement) {
            totalElement.textContent =
                formatMoney(total);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CẬP NHẬT KHI THAY ĐỔI GÓI HÀNH LÝ
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll(
        'input[type="radio"]'
    ).forEach(function (input) {

        input.addEventListener(
            'change',
            updateSummary
        );

    });

    /*
    |--------------------------------------------------------------------------
    | KHỞI TẠO TỔNG TIỀN
    |--------------------------------------------------------------------------
    */

    updateSummary();
</script>

</body>
</html>
