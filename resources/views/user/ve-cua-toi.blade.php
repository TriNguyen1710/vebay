
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử vé - Vietjet</title>

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
            --danger: #dc3545;
            --warning: #d97706;
            --light: #f4f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dfe6ed;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
            line-height: 1.5;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
            cursor: pointer;
        }

        /* HEADER */

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
            box-shadow: 0 3px 15px rgba(0,0,0,.08);
        }

        .navbar {
            max-width: 1240px;
            min-height: 76px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo {
            color: var(--primary);
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -1px;
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
            color: #293241;
            font-size: 15px;
            font-weight: 600;
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
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .logout-btn {
            border: 0;
            background: var(--danger);
            color: white;
            padding: 9px 14px;
            border-radius: 6px;
            font-weight: bold;
        }

        /* BANNER */

        .page-banner {
            min-height: 230px;
            background:
                linear-gradient(
                    90deg,
                    rgba(0,31,58,.95),
                    rgba(0,59,112,.52)
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

        .breadcrumb span {
            color: #e5ebf0;
        }

        .page-banner h1 {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .page-banner p {
            max-width: 650px;
            color: #e3ebf3;
            font-size: 15px;
            line-height: 1.6;
        }

        /* MAIN */

        .main {
            max-width: 1100px;
            margin: -48px auto 70px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .page-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 7px 28px rgba(0,0,0,.08);
            padding: 23px 25px;
            margin-bottom: 22px;
        }

        .page-summary h2 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 5px;
        }

        .page-summary p {
            color: var(--muted);
            font-size: 12px;
        }

        .booking-count {
            min-width: 90px;
            padding: 10px 14px;
            background: #edf5fb;
            border: 1px solid #cedfea;
            border-radius: 7px;
            color: var(--primary);
            text-align: center;
            font-size: 11px;
            font-weight: bold;
        }

        /* BOOKING */

        .booking {
            background: white;
            border-radius: 14px;
            box-shadow: 0 6px 25px rgba(0,0,0,.07);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .booking.cancelled-booking {
            opacity: .82;
        }

        .booking-header {
            padding: 21px 24px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .booking.cancelled-booking .booking-header {
            background: #5d6872;
        }

        .booking-code-label {
            display: block;
            color: #d6e4ed;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .7px;
            margin-bottom: 5px;
        }

        .booking-code {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .payment-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 11px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 800;
        }

        .payment-status.paid {
            background: #eaf7ef;
            color: #17643d;
        }

        .payment-status.unpaid {
            background: #fff5d6;
            color: #78621d;
        }

        .payment-status.cancelled {
            background: #fdebec;
            color: #a5232d;
        }

        .booking-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 1px solid #e8edf1;
        }

        .booking-info-item {
            padding: 17px 24px;
        }

        .booking-info-item:first-child {
            border-right: 1px solid #e8edf1;
        }

        .booking-info-label {
            display: block;
            color: var(--muted);
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 5px;
        }

        .booking-info-value {
            color: #344657;
            font-size: 13px;
            font-weight: bold;
        }

        .total-value {
            color: #b42318;
            font-size: 16px;
            font-weight: 800;
        }

        .expired-notice {
            margin: 18px 24px 0;
            padding: 13px 15px;
            border: 1px solid #f0c8cb;
            border-radius: 7px;
            background: #fff5f5;
            color: #8d2830;
            font-size: 11px;
            line-height: 1.6;
        }

        .expired-notice strong {
            display: block;
            margin-bottom: 3px;
        }

        /* ====================================
           CHIA NHÓM CHUYẾN ĐI - CHUYẾN VỀ
        ==================================== */

        .tickets-area {
            padding: 22px 24px 5px;
        }

        .tickets-heading {
            color: #4a5a68;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 15px;
        }

        .flight-leg-group {
            border: 1px solid #dce6f1;
            border-radius: 12px;
            overflow: hidden;
            background: #f8fbff;
            margin-bottom: 20px;
            padding: 12px 12px 1px;
        }

        .flight-leg-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            background: #003b70;
            color: white;
            padding: 15px 18px;
            border-radius: 9px;
            margin-bottom: 13px;
        }

        .flight-leg-group.return-leg .flight-leg-heading {
            background: #006aa8;
        }

        .flight-leg-title {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .6px;
        }

        .flight-leg-subtitle {
            font-size: 11px;
            color: #e0efff;
            margin-top: 5px;
        }

        .flight-leg-count {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 7px 12px;
            border-radius: 20px;
            background: rgba(255,255,255,.17);
            color: white;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* TỪNG VÉ */

        .ticket {
            border: 1px solid #dfe6eb;
            border-radius: 9px;
            margin-bottom: 13px;
            overflow: hidden;
            background: white;
        }

        .ticket-top {
            padding: 14px 17px;
            background: #f8fafc;
            border-bottom: 1px solid #e5eaee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .ticket-code-label {
            color: var(--muted);
            font-size: 9px;
            margin-bottom: 4px;
        }

        .ticket-code {
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
        }

        .seat-class {
            padding: 6px 9px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 800;
        }

        .seat-class.vip {
            background: #fff8e4;
            color: #80661b;
            border: 1px solid #e8d89d;
        }

        .seat-class.economy {
            background: #edf5fb;
            color: var(--primary);
            border: 1px solid #cbdee9;
        }

        /* ROUTE */

        .route {
            display: grid;
            grid-template-columns: 1fr 120px 1fr;
            gap: 18px;
            align-items: center;
            padding: 21px 18px;
            border-bottom: 1px solid #edf0f3;
        }

        .airport:last-child {
            text-align: right;
        }

        .airport-city {
            color: var(--primary);
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .airport-date {
            color: #65717c;
            font-size: 10px;
        }

        .airport-time {
            margin-top: 4px;
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
        }

        .route-line {
            text-align: center;
        }

        .line {
            height: 2px;
            position: relative;
            background: #c6d2dc;
            margin-bottom: 6px;
        }

        .line::before,
        .line::after {
            content: "";
            position: absolute;
            top: -2px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--primary);
        }

        .line::before { left: 0; }
        .line::after { right: 0; }

        .route-line span {
            color: #87929b;
            font-size: 9px;
        }

        /* THÔNG TIN VÉ */

        .ticket-details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            padding: 5px 18px 17px;
        }

        .ticket-detail {
            padding: 13px 12px 8px 0;
        }

        .ticket-detail-label {
            display: block;
            color: var(--muted);
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 5px;
        }

        .ticket-detail-value {
            color: #344657;
            font-size: 12px;
            font-weight: bold;
            word-break: break-word;
        }

        .seat-number {
            color: var(--primary);
            font-size: 15px;
        }

        .price {
            color: #b42318;
        }

        /* ĐỔI VÉ - HỦY VÉ */

        .ticket-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            padding: 14px 18px;
            background: #f8fafc;
            border-top: 1px solid #e5eaee;
        }

        .ticket-owner {
            display: flex;
            flex-direction: column;
            gap: 5px;
            min-width: 0;
        }

        .ticket-owner-label {
            color: var(--muted);
            font-size: 10px;
        }

        .ticket-owner-name {
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .ticket-action-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
        }

        .ticket-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            min-width: 120px;
            border-radius: 6px;
            color: white;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            transition: .2s;
        }

        .ticket-action-btn.change {
            background: var(--success);
        }

        .ticket-action-btn.change:hover {
            background: #146c43;
        }

        .ticket-action-btn.cancel {
            background: var(--danger);
        }

        .ticket-action-btn.cancel:hover {
            background: #b02a37;
        }

        .ticket-action-notice {
            color: #697580;
            font-size: 11px;
            font-weight: bold;
        }

        /* HOÀN TIỀN */

        .refund-box {
            margin: 0 18px 16px;
            padding: 13px 14px;
            border: 1px solid #ead58e;
            border-radius: 7px;
            background: #fffaf0;
            color: #66572e;
            font-size: 10px;
            line-height: 1.6;
        }

        .refund-box strong {
            color: var(--primary-dark);
        }

        /* TỔNG TIỀN */

        .cost-summary {
            margin: 0 24px 18px;
            padding: 16px 18px;
            background: #fff9e8;
            border: 1px solid #ead795;
            border-left: 4px solid var(--secondary);
            border-radius: 7px;
        }

        .cost-summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 7px 0;
            border-bottom: 1px solid #eee2b9;
        }

        .cost-summary-row:last-child {
            border-bottom: 0;
        }

        .cost-summary-label {
            color: #6a5a27;
            font-size: 11px;
            font-weight: bold;
        }

        .cost-summary-value {
            color: #344657;
            font-size: 12px;
            font-weight: 800;
        }

        .cost-summary-row.total .cost-summary-value {
            color: #b42318;
            font-size: 16px;
        }

        .booking-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            padding: 17px 24px 20px;
            border-top: 1px solid #edf0f3;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 170px;
            padding: 11px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            transition: .2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-pay {
            background: var(--success);
            color: white;
        }

        .btn-pay:hover {
            background: #146c43;
        }

        .cancelled-text {
            color: #8a3339;
            font-size: 11px;
            font-weight: bold;
            line-height: 1.5;
        }

        /* ALERT */

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 11px;
            line-height: 1.6;
        }

        .alert-success {
            background: #edf8f2;
            border: 1px solid #badfc9;
            color: #17643d;
        }

        .alert-error {
            background: #fff0f1;
            border: 1px solid #efc0c5;
            color: #a52a36;
        }

        /* EMPTY */

        .empty {
            background: white;
            border-radius: 14px;
            padding: 55px 25px;
            box-shadow: 0 6px 25px rgba(0,0,0,.06);
            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 17px;
            border-radius: 50%;
            background: #edf5fb;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
        }

        .empty h2 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 7px;
        }

        .empty p {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 20px;
        }

        .bottom-actions {
            margin-top: 5px;
        }

        .back-button {
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        footer {
            background: #031d33;
            color: white;
            padding: 35px 20px;
            text-align: center;
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

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .nav-menu {
                display: none;
            }

            .ticket-details {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 650px) {
            .top-bar {
                display: none;
            }

            .navbar {
                min-height: 65px;
            }

            .user-name {
                display: none;
            }

            .page-banner h1 {
                font-size: 29px;
            }

            .page-summary,
            .booking-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .booking-info {
                grid-template-columns: 1fr;
            }

            .booking-info-item:first-child {
                border-right: 0;
                border-bottom: 1px solid #e8edf1;
            }

            .route {
                grid-template-columns: 1fr;
            }

            .route-line {
                display: none;
            }

            .airport:last-child {
                text-align: left;
            }

            .ticket-details {
                grid-template-columns: 1fr;
            }

            .ticket-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .ticket-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .ticket-action-links {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .ticket-action-btn {
                min-width: 0;
            }

            .flight-leg-heading {
                padding: 12px;
            }

            .booking-actions {
                display: block;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 390px) {
            .ticket-action-links {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

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
            Viet<span>jet</span>
        </a>

        <div class="nav-menu">
            <a href="{{ route('trang-chu') }}" class="nav-link">
                Trang chủ
            </a>

            <a href="{{ route('flights.search.form') }}" class="nav-link">
                Đặt vé
            </a>

            <a href="{{ route('tickets.mine') }}" class="nav-link active">
                Lịch sử vé
            </a>

            <a href="{{ route('notifications.index') }}" class="nav-link">
                Thông báo
            </a>

            <a href="{{ route('contact') }}" class="nav-link">
                Liên hệ
            </a>
        </div>

        <div class="nav-actions">
            @auth
                <span class="user-name">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('dang-xuat') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
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
            <a href="{{ route('trang-chu') }}">Trang chủ</a>
            <span>/</span>
            <span>Lịch sử vé</span>
        </div>

        <h1>Lịch sử vé</h1>

        <p>
            Theo dõi các đơn đặt vé, hành trình và trạng thái
            thanh toán của bạn tại một nơi.
        </p>
    </div>
</section>

{{-- MAIN --}}

<main class="main">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <section class="page-summary">
        <div>
            <h2>Danh sách đặt vé</h2>
            <p>Các chuyến bay bạn đã đặt trên hệ thống Vietjet.</p>
        </div>

        <div class="booking-count">
            {{ $bookings->count() }} đơn đặt vé
        </div>
    </section>

    {{-- DUYỆT CÁC ĐƠN ĐẶT VÉ --}}

    @forelse($bookings as $booking)

        <section class="booking {{ $booking->booking_status === 'cancelled' ? 'cancelled-booking' : '' }}">

            {{-- HEADER ĐƠN --}}

            <div class="booking-header">
                <div>
                    <span class="booking-code-label">
                        Mã đặt vé
                    </span>

                    <div class="booking-code">
                        {{ $booking->booking_code }}
                    </div>
                </div>

                @if($booking->booking_status === 'cancelled')
                    <span class="payment-status cancelled">
                        {{
                            $booking->tickets->contains(
                                fn($ticket) => !empty($ticket->refund_status)
                            )
                                ? 'Đã hủy'
                                : 'Đã hết hạn'
                        }}
                    </span>

                @elseif($booking->payment_status === 'paid')
                    <span class="payment-status paid">
                        Đã thanh toán
                    </span>

                @else
                    <span class="payment-status unpaid">
                        Chưa thanh toán
                    </span>
                @endif
            </div>

            {{-- THÔNG TIN ĐƠN --}}

            <div class="booking-info">
                <div class="booking-info-item">
                    <span class="booking-info-label">
                        Ngày đặt
                    </span>

                    <span class="booking-info-value">
                        {{
                            $booking->created_at
                                ->timezone('Asia/Ho_Chi_Minh')
                                ->format('d/m/Y H:i')
                        }}
                    </span>
                </div>

                <div class="booking-info-item">
                    <span class="booking-info-label">
                        Tổng tiền
                    </span>

                    <span class="total-value">
                        {{ number_format($booking->total_amount, 0, ',', '.') }} đ
                    </span>
                </div>
            </div>

            {{-- THÔNG BÁO ĐƠN ĐÃ HỦY --}}

            @if($booking->booking_status === 'cancelled')

                <div class="expired-notice">
                    @if($booking->tickets->contains(
                        fn($ticket) => !empty($ticket->refund_status)
                    ))
                        <strong>
                            Vé đã được hủy theo yêu cầu của khách hàng.
                        </strong>

                        Ghế đã được giải phóng.
                        Thông tin hoàn tiền được hiển thị tại từng vé.
                    @else
                        <strong>
                            Đơn đặt vé đã hết thời gian giữ ghế.
                        </strong>

                        Ghế của đơn này đã được giải phóng.
                        Bạn cần đặt vé mới nếu vẫn muốn chọn chuyến bay.
                    @endif
                </div>

            @endif

            {{-- ==========================================
                 NHÓM VÉ THÀNH CHUYẾN ĐI VÀ CHUYẾN VỀ
            =========================================== --}}

            @php
                /*
                 * Chỉ lấy vé có chuyến bay.
                 * Sắp xếp theo ngày và giờ khởi hành.
                 */

                $ticketsByFlightDate = $booking->tickets
                    ->filter(fn($t) => $t->flight !== null)
                    ->sortBy(fn($t) =>
                        $t->flight->flight_date->format('Y-m-d')
                        . ' '
                        . $t->flight->departure_time
                    );

                /*
                 * Nhóm theo chiều:
                 * departure_airport_id : arrival_airport_id
                 */

                $ticketGroups = $ticketsByFlightDate->groupBy(
                    fn($t) =>
                        $t->flight->departure_airport_id
                        . ':'
                        . $t->flight->arrival_airport_id
                );

                $firstTicket = $ticketsByFlightDate->first();

                $outboundDepartureId =
                    $firstTicket?->flight?->departure_airport_id;

                $outboundArrivalId =
                    $firstTicket?->flight?->arrival_airport_id;
            @endphp

            <div class="tickets-area">

                <div class="tickets-heading">
                    Chi tiết chuyến bay
                </div>

                @foreach($ticketGroups as $direction => $groupTickets)

                    @php
                        $representative = $groupTickets->first()->flight;

                        $isOutboundGroup =
                            $representative->departure_airport_id
                                == $outboundDepartureId
                            &&
                            $representative->arrival_airport_id
                                == $outboundArrivalId;

                        $isReturnGroup =
                            $representative->departure_airport_id
                                == $outboundArrivalId
                            &&
                            $representative->arrival_airport_id
                                == $outboundDepartureId;

                        $groupTitle = $isOutboundGroup
                            ? 'CHUYẾN ĐI'
                            : (
                                $isReturnGroup
                                    ? 'CHUYẾN VỀ'
                                    : 'CHẶNG BAY KHÁC'
                            );
                    @endphp

                    {{-- NHÓM CHUYẾN --}}

                    <div class="flight-leg-group {{ $isReturnGroup && !$isOutboundGroup ? 'return-leg' : '' }}">

                        <div class="flight-leg-heading">

                            <div>
                                <div class="flight-leg-title">
                                    {{ $groupTitle }}
                                </div>

                                <div class="flight-leg-subtitle">
                                    {{ $representative->departureAirport->city }}
                                    →
                                    {{ $representative->arrivalAirport->city }}
                                </div>
                            </div>

                            <span class="flight-leg-count">
                                {{ $groupTickets->count() }} vé
                            </span>

                        </div>

                        {{-- CÁC VÉ TRONG NHÓM --}}

                        @foreach($groupTickets as $ticket)

                            <div class="ticket">

                                {{-- MÃ VÉ VÀ HẠNG GHẾ --}}

                                <div class="ticket-top">

                                    <div>
                                        <div class="ticket-code-label">
                                            Mã vé
                                        </div>

                                        <div class="ticket-code">
                                            {{ $ticket->ticket_code }}
                                        </div>
                                    </div>

                                    @if($ticket->seat_class === 'vip')
                                        <span class="seat-class vip">
                                            VIP
                                        </span>
                                    @else
                                        <span class="seat-class economy">
                                            PHỔ THÔNG
                                        </span>
                                    @endif

                                </div>

                                {{-- TUYẾN BAY --}}

                                <div class="route">

                                    <div class="airport">
                                        <div class="airport-city">
                                            {{ $ticket->flight->departureAirport->city }}
                                        </div>

                                        <div class="airport-date">
                                            {{
                                                $ticket->flight->flight_date
                                                    ->format('d/m/Y')
                                            }}
                                        </div>

                                        <div class="airport-time">
                                            {{
                                                substr(
                                                    $ticket->flight->departure_time,
                                                    0,
                                                    5
                                                )
                                            }}
                                        </div>
                                    </div>

                                    <div class="route-line">
                                        <div class="line"></div>
                                        <span>
                                            {{ $ticket->flight->flight_code }}
                                        </span>
                                    </div>

                                    <div class="airport">
                                        <div class="airport-city">
                                            {{ $ticket->flight->arrivalAirport->city }}
                                        </div>

                                        <div class="airport-date">
                                            {{
                                                $ticket->flight->flight_date
                                                    ->format('d/m/Y')
                                            }}
                                        </div>

                                        <div class="airport-time">
                                            {{
                                                substr(
                                                    $ticket->flight->arrival_time,
                                                    0,
                                                    5
                                                )
                                            }}
                                        </div>
                                    </div>

                                </div>

                                {{-- CHI TIẾT VÉ --}}

                                <div class="ticket-details">

                                    <div class="ticket-detail">
                                        <span class="ticket-detail-label">
                                            Hành khách
                                        </span>

                                        <span class="ticket-detail-value">
                                            {{ $ticket->passenger_name }}
                                        </span>
                                    </div>

                                    <div class="ticket-detail">
                                        <span class="ticket-detail-label">
                                            Chuyến bay
                                        </span>

                                        <span class="ticket-detail-value">
                                            {{ $ticket->flight->flight_code }}
                                        </span>
                                    </div>

                                    <div class="ticket-detail">
                                        <span class="ticket-detail-label">
                                            Ghế
                                        </span>

                                        <span class="ticket-detail-value seat-number">
                                            {{ $ticket->flightSeat->seat_number }}
                                        </span>
                                    </div>

                                    <div class="ticket-detail">
                                        <span class="ticket-detail-label">
                                            Giá vé
                                        </span>

                                        <span class="ticket-detail-value price">
                                            {{
                                                number_format(
                                                    $ticket->price,
                                                    0,
                                                    ',',
                                                    '.'
                                                )
                                            }} đ
                                        </span>
                                    </div>

                                    <div class="ticket-detail">
                                        <span class="ticket-detail-label">
                                            Hành lý ký gửi
                                        </span>

                                        <span class="ticket-detail-value">
                                            @if((int) $ticket->baggage_weight > 0)
                                                {{ (int) $ticket->baggage_weight }} kg
                                            @else
                                                Không mua thêm
                                            @endif
                                        </span>
                                    </div>

                                    <div class="ticket-detail">
                                        <span class="ticket-detail-label">
                                            Phí hành lý
                                        </span>

                                        <span class="ticket-detail-value price">
                                            {{
                                                number_format(
                                                    (float) $ticket->baggage_price,
                                                    0,
                                                    ',',
                                                    '.'
                                                )
                                            }} đ
                                        </span>
                                    </div>

                                </div>

                                {{-- THÔNG TIN HOÀN TIỀN --}}

                                @if($ticket->refund_status)

                                    <div class="refund-box">

                                        <strong>
                                            Số tiền hoàn:
                                            {{
                                                number_format(
                                                    $ticket->refund_amount ?? 0,
                                                    0,
                                                    ',',
                                                    '.'
                                                )
                                            }} đ
                                        </strong>

                                        <p>
                                            Ngân hàng:
                                            {{ $ticket->refund_bank_name ?? '-' }}
                                        </p>

                                        <p>
                                            Số tài khoản:
                                            {{ $ticket->refund_account_number ?? '-' }}
                                        </p>

                                        <p>
                                            Chủ tài khoản:
                                            {{ $ticket->refund_account_name ?? '-' }}
                                        </p>

                                        <p>
                                            Trạng thái:

                                            @if($ticket->refund_status === 'refunded')
                                                <strong>Đã hoàn tiền</strong>
                                            @else
                                                <strong>
                                                    Chờ Admin xác nhận hoàn tiền
                                                </strong>
                                            @endif
                                        </p>

                                    </div>

                                @endif

                                {{-- ====================================
                                     ĐỔI VÉ - HỦY VÉ TỪNG HÀNH KHÁCH
                                ==================================== --}}

                                @php
                                    $canManageTicket =
                                        $booking->payment_status === 'paid'
                                        && $booking->booking_status === 'confirmed'
                                        && $ticket->ticket_status === 'active'
                                        && !$ticket->flight->flight_date
                                            ->isBefore(now()->startOfDay());
                                @endphp

                                @if($canManageTicket)

                                    <div class="ticket-actions">

                                        <div class="ticket-owner">

                                            <span class="ticket-owner-label">
                                                Thao tác cho hành khách
                                            </span>

                                            <span class="ticket-owner-name">
                                                {{ $ticket->passenger_name }}
                                                — Ghế
                                                {{ $ticket->flightSeat->seat_number }}
                                            </span>

                                        </div>

                                        <div class="ticket-action-links">

                                            <a
                                                href="{{ route(
                                                    'ticket.change.flight',
                                                    $ticket->id
                                                ) }}"
                                                class="ticket-action-btn change"
                                            >
                                                Đổi vé
                                            </a>

                                            <a
                                                href="{{ route(
                                                    'ticket.cancel',
                                                    $ticket->id
                                                ) }}"
                                                class="ticket-action-btn cancel"
                                            >
                                                Hủy vé
                                            </a>

                                        </div>

                                    </div>

                                @elseif(
                                    $ticket->ticket_status === 'cancelled'
                                    && $booking->payment_status === 'paid'
                                )

                                    <div class="ticket-actions">

                                        <div class="ticket-owner">
                                            <span class="ticket-owner-label">
                                                Hành khách
                                            </span>

                                            <span class="ticket-owner-name">
                                                {{ $ticket->passenger_name }}
                                                — Ghế
                                                {{ $ticket->flightSeat->seat_number }}
                                            </span>
                                        </div>

                                        <span class="ticket-action-notice">
                                            Vé này đã hủy
                                        </span>

                                    </div>

                                @elseif($ticket->ticket_status === 'used')

                                    <div class="ticket-actions">

                                        <div class="ticket-owner">
                                            <span class="ticket-owner-label">
                                                Hành khách
                                            </span>

                                            <span class="ticket-owner-name">
                                                {{ $ticket->passenger_name }}
                                            </span>
                                        </div>

                                        <span class="ticket-action-notice">
                                            Vé đã sử dụng
                                        </span>

                                    </div>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endforeach

            </div>

            {{-- TÍNH TỔNG TIỀN --}}

            @php
                $bookingTicketTotal =
                    (float) $booking->tickets->sum('price');

                $bookingBaggageTotal =
                    (float) $booking->tickets->sum('baggage_price');
            @endphp

            <div class="cost-summary">

                <div class="cost-summary-row">
                    <span class="cost-summary-label">
                        Tổng giá vé
                    </span>

                    <span class="cost-summary-value">
                        {{
                            number_format(
                                $bookingTicketTotal,
                                0,
                                ',',
                                '.'
                            )
                        }} đ
                    </span>
                </div>

                <div class="cost-summary-row">
                    <span class="cost-summary-label">
                        Tổng phí hành lý
                    </span>

                    <span class="cost-summary-value">
                        {{
                            number_format(
                                $bookingBaggageTotal,
                                0,
                                ',',
                                '.'
                            )
                        }} đ
                    </span>
                </div>

                <div class="cost-summary-row total">
                    <span class="cost-summary-label">
                        Tổng đơn
                    </span>

                    <span class="cost-summary-value">
                        {{
                            number_format(
                                $booking->total_amount,
                                0,
                                ',',
                                '.'
                            )
                        }} đ
                    </span>
                </div>

            </div>

            {{-- NÚT THAO TÁC TOÀN ĐƠN --}}

            <div class="booking-actions">

                @if($booking->booking_status === 'cancelled')

                    <span class="cancelled-text">
                        {{
                            $booking->tickets->contains(
                                fn($ticket) => !empty($ticket->refund_status)
                            )
                                ? 'Đơn đã hủy. Vui lòng theo dõi trạng thái hoàn tiền ở phía trên.'
                                : 'Không thể tiếp tục thanh toán đơn đặt vé này.'
                        }}
                    </span>

                @elseif($booking->payment_status === 'paid')

                    <a
                        href="{{ route(
                            'ticket.show',
                            $booking->id
                        ) }}"
                        class="btn btn-primary"
                    >
                        Xem vé điện tử
                    </a>

                @else

                    <a
                        href="{{ route(
                            'payment.show',
                            $booking->id
                        ) }}"
                        class="btn btn-pay"
                    >
                        Tiếp tục thanh toán
                    </a>

                @endif

            </div>

        </section>

    @empty

        {{-- CHƯA CÓ VÉ --}}

        <section class="empty">

            <div class="empty-icon">
                SG
            </div>

            <h2>Bạn chưa có vé nào</h2>

            <p>
                Tìm chuyến bay phù hợp và bắt đầu
                hành trình của bạn.
            </p>

            <a
                href="{{ route('flights.search.form') }}"
                class="btn btn-primary"
            >
                Tìm chuyến bay
            </a>

        </section>

    @endforelse

    <div class="bottom-actions">
        <a
            href="{{ route('trang-chu') }}"
            class="back-button"
        >
            ← Quay lại trang chủ
        </a>
    </div>

</main>

{{-- FOOTER --}}

<footer>
    <div class="footer-logo">
        Viet<span>jet</span>
    </div>

    <p>
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </p>
</footer>

</body>
</html>
