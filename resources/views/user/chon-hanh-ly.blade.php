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
            box-shadow: 0 3px 12px rgba(20, 45, 65, 0.04);
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
            grid-template-columns: repeat(3, minmax(0, 1fr));
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
            transition: 0.2s;
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
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.06);
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

        @media (max-width: 800px) {
            .packages {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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
        }
    </style>
</head>
<body>

<div class="page">

    <header class="topbar">
        <div class="topbar-inner">

            <a href="{{ route('trang-chu') }}" class="brand">
                Viet<span>jet</span>
            </a>

            <a href="{{ route('passenger.create') }}" class="back-btn">
                Quay lại
            </a>

        </div>
    </header>

    <main class="content">

        <div class="page-heading">
            <h1>Chọn hành lý</h1>

            <p>
                Chọn hành lý ký gửi phù hợp trước khi tiếp tục quét khuôn mặt.
            </p>
        </div>

        @if($carryOn)
            <section class="card">

                <div class="card-header">
                    <h2>Hành lý xách tay</h2>

                    <p>
                        Hành lý xách tay đã được bao gồm miễn phí trong vé.
                    </p>
                </div>

                <div class="card-body">

                    <div class="carry-on-box">

                        <div>
                            <div class="carry-on-title">
                                Hành lý xách tay miễn phí
                            </div>

                            <div class="carry-on-text">
                                Bạn không cần thanh toán thêm cho phần hành lý này.
                            </div>
                        </div>

                        <div class="carry-on-weight">
                            {{ $carryOn->weight }} kg
                        </div>

                    </div>

                </div>

            </section>
        @endif

        <form action="{{ route('baggage.store') }}" method="POST">
            @csrf

            <section class="card">

                <div class="card-header">
                    <h2>Hành lý ký gửi</h2>

                    <p>
                        Không bắt buộc. Bạn có thể chọn "Không mua thêm".
                    </p>
                </div>

                <div class="card-body">

                    @if($tripType === 'round_trip')

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
                                        checked
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
                                        checked
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

                        <div class="packages">

                            <label class="package-option">

                                <input
                                    type="radio"
                                    name="baggage_package_id"
                                    value=""
                                    data-price="0"
                                    data-summary="Không mua thêm"
                                    checked
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
                        <div class="empty" style="margin-top: 16px;">
                            Hiện chưa có gói hành lý ký gửi nào đang được mở bán.
                            Bạn vẫn có thể tiếp tục mà không mua hành lý ký gửi.
                        </div>
                    @endif

                    <div class="summary">

                        @if($tripType === 'round_trip')

                            <div class="summary-row">
                                <span class="summary-label">
                                    Hành lý chiều đi
                                </span>

                                <span class="summary-value" id="outboundSummary">
                                    Không mua thêm
                                </span>
                            </div>

                            <div class="summary-row">
                                <span class="summary-label">
                                    Hành lý chiều về
                                </span>

                                <span class="summary-value" id="returnSummary">
                                    Không mua thêm
                                </span>
                            </div>

                        @else

                            <div class="summary-row">
                                <span class="summary-label">
                                    Hành lý ký gửi
                                </span>

                                <span class="summary-value" id="singleSummary">
                                    Không mua thêm
                                </span>
                            </div>

                        @endif

                        <div class="summary-row">
                            <span class="summary-label">
                                Phí hành lý
                            </span>

                            <span class="summary-value" id="totalBaggagePrice">
                                0đ
                            </span>
                        </div>

                    </div>

                </div>

            </section>

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

<script>
    function formatMoney(value) {
        return new Intl.NumberFormat('vi-VN').format(value) + 'đ';
    }

    function updateSummary() {
        let total = 0;

        const single = document.querySelector(
            'input[name="baggage_package_id"]:checked'
        );

        if (single) {
            total += Number(single.dataset.price || 0);

            const summary = document.getElementById('singleSummary');

            if (summary) {
                summary.textContent = single.dataset.summary;
            }
        }

        const outbound = document.querySelector(
            'input[name="outbound_baggage_package_id"]:checked'
        );

        if (outbound) {
            total += Number(outbound.dataset.price || 0);

            const summary = document.getElementById('outboundSummary');

            if (summary) {
                summary.textContent = outbound.dataset.summary;
            }
        }

        const returnBaggage = document.querySelector(
            'input[name="return_baggage_package_id"]:checked'
        );

        if (returnBaggage) {
            total += Number(returnBaggage.dataset.price || 0);

            const summary = document.getElementById('returnSummary');

            if (summary) {
                summary.textContent = returnBaggage.dataset.summary;
            }
        }

        document.getElementById('totalBaggagePrice').textContent =
            formatMoney(total);
    }

    document
        .querySelectorAll('input[type="radio"]')
        .forEach(function (input) {
            input.addEventListener('change', updateSummary);
        });

    updateSummary();
</script>

</body>
</html>