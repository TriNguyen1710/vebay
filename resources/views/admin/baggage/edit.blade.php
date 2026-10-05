<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa gói hành lý - Vietjet</title>

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
            --danger: #dc3545;
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
        input,
        select {
            font-family: inherit;
        }

        .page {
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
        }

        .topbar-inner {
            width: min(880px, calc(100% - 40px));
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

        .back-btn:hover {
            background: var(--primary-dark);
        }

        .content {
            width: min(880px, calc(100% - 40px));
            margin: 0 auto;
            padding: 32px 0 50px;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .breadcrumb {
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 11px;
        }

        .breadcrumb a {
            color: var(--primary);
            font-weight: bold;
        }

        .page-heading h1 {
            color: var(--primary-dark);
            font-size: 27px;
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
        }

        .card-header {
            padding: 20px 22px;
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
            padding: 24px;
        }

        .error {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid #f1aeb5;
            border-radius: 7px;
            background: #f8d7da;
            color: #842029;
            font-size: 12px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .full {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #465764;
            font-size: 11px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #cdd8df;
            border-radius: 6px;
            background: white;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.08);
        }

        .price-wrap {
            position: relative;
        }

        .price-wrap .form-control {
            padding-right: 55px;
        }

        .price-unit {
            position: absolute;
            right: 13px;
            bottom: 13px;
            color: var(--muted);
            font-size: 11px;
            font-weight: bold;
        }

        .info-box {
            margin-top: 20px;
            padding: 14px 16px;
            border-left: 3px solid var(--secondary);
            border-radius: 5px;
            background: #fff9df;
            color: #655819;
            font-size: 11px;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn {
            min-height: 40px;
            padding: 0 18px;
            border: 0;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: #e9eef2;
            color: #425361;
        }

        .btn-secondary:hover {
            background: #dde5ea;
        }

        @media (max-width: 650px) {
            .content,
            .topbar-inner {
                width: min(100% - 24px, 880px);
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
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

            <a href="{{ route('admin.trang-chu') }}" class="brand">
                Viet<span>jet</span>
            </a>

            <a
                href="{{ route('admin.baggage.index') }}"
                class="back-btn"
            >
                Quay lại
            </a>

        </div>

    </header>

    <main class="content">

        <div class="page-heading">

            <div class="breadcrumb">
                <a href="{{ route('admin.trang-chu') }}">
                    Trang quản trị
                </a>
                /
                <a href="{{ route('admin.baggage.index') }}">
                    Hành lý
                </a>
                /
                Sửa gói
            </div>

            <h1>Sửa gói hành lý ký gửi</h1>

            <p>
                Cập nhật thông tin gói hành lý mà khách hàng có thể mua thêm.
            </p>

        </div>

        <section class="card">

            <div class="card-header">
                <h2>{{ $baggagePackage->name }}</h2>
                <p>
                    Thay đổi khối lượng, giá tiền hoặc trạng thái của gói hành lý.
                </p>
            </div>

            <div class="card-body">

                @if($errors->any())
                    <div class="error">

                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    </div>
                @endif

                <form
                    action="{{ route('admin.baggage.checked.update', $baggagePackage) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group full">

                            <label for="name">
                                Tên gói hành lý
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $baggagePackage->name) }}"
                                maxlength="255"
                                required
                            >

                        </div>

                        <div class="form-group">

                            <label for="weight">
                                Khối lượng
                            </label>

                            <input
                                type="number"
                                id="weight"
                                name="weight"
                                class="form-control"
                                value="{{ old('weight', $baggagePackage->weight) }}"
                                min="1"
                                max="100"
                                required
                            >

                        </div>

                        <div class="form-group price-wrap">

                            <label for="price">
                                Giá gói hành lý
                            </label>

                            <input
                                type="number"
                                id="price"
                                name="price"
                                class="form-control"
                                value="{{ old('price', $baggagePackage->price) }}"
                                min="0"
                                step="1000"
                                required
                            >

                            <span class="price-unit">
                                VNĐ
                            </span>

                        </div>

                        <div class="form-group full">

                            <label for="status">
                                Trạng thái
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="form-control"
                                required
                            >

                                <option
                                    value="1"
                                    @selected((string) old('status', $baggagePackage->status) === '1')
                                >
                                    Bật - Khách hàng có thể chọn gói này
                                </option>

                                <option
                                    value="0"
                                    @selected((string) old('status', $baggagePackage->status) === '0')
                                >
                                    Tắt - Không hiển thị cho khách hàng
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="info-box">
                        Việc thay đổi giá gói hành lý chỉ áp dụng cho các lượt đặt vé mới.
                        Giá hành lý đã lưu trên vé cũ sẽ không bị thay đổi.
                    </div>

                    <div class="actions">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Lưu thay đổi
                        </button>

                        <a
                            href="{{ route('admin.baggage.index') }}"
                            class="btn btn-secondary"
                        >
                            Hủy
                        </a>

                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>