<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đối soát thanh toán - VietJet</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f3f6fa;
            color: #263849;
            font: 14px Arial, Helvetica, sans-serif;
        }

        a {
            color: #003b70;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        .icon {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* KHUNG MENU: CÙNG KÍCH THƯỚC TRANG CHỦ ADMIN */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 245px;
            padding: 26px 16px;
            background: #00294f;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 30;
        }

        .logo {
            display: block;
            padding: 0 10px;
            margin-bottom: 34px;
            color: white;
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .logo span {
            color: #f4b400;
        }

        .menu-title {
            padding: 0 11px;
            margin-bottom: 10px;
            color: #7895aa;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 1.3px;
        }

        .menu {
            display: grid;
            gap: 4px;
        }

        .menu-link {
            min-height: 44px;
            padding: 0 13px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cad9e4;
            font-size: 12px;
            font-weight: 600;
            transition: 0.2s;
        }

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .menu-link.active {
            background: rgba(255, 255, 255, 0.11);
            color: white;
        }

        .menu-icon {
            width: 17px;
            height: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .menu-icon svg {
            width: 17px;
            height: 17px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .menu-link.active .menu-icon {
            color: #f4b400;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-info {
            padding: 0 11px 16px;
        }

        .admin-info strong {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .admin-info span {
            color: #8fa5b5;
            font-size: 10px;
        }

        .logout-btn {
            width: 100%;
            min-height: 0;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.06);
            color: white;
            cursor: pointer;
            font-size: 11px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: #dc3545;
            border-color: #dc3545;
        }

        .page {
            min-height: 100vh;
            margin-left: 245px;
            min-width: 0;
        }

        .topbar {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 28px;
            border-bottom: 1px solid #dfe7ef;
            background: white;
        }

        .topbar-title {
            display: block;
            color: #003b70;
            font-size: 18px;
        }

        .topbar small {
            display: block;
            margin-top: 6px;
            color: #78899a;
            font-size: 12px;
        }

        .content {
            max-width: 1600px;
            margin: auto;
            padding: 26px 28px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 20px;
            color: #8190a0;
            font-size: 12px;
        }

        .breadcrumb a {
            color: #61788d;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0 0 9px;
            color: #173b5a;
            font-size: 26px;
        }

        h2 {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0 0 20px;
            color: #003b70;
            font-size: 17px;
        }

        h3 {
            margin: 0 0 18px;
            color: #173b5a;
            font-size: 16px;
        }

        p {
            line-height: 1.75;
        }

        .description {
            max-width: 650px;
            margin: 0;
            color: #75869a;
            font-size: 13px;
            line-height: 1.8;
        }

        .muted {
            color: #75869a;
            font-size: 12px;
        }

        .buttons {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .button,
        button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px;
            border: 1px solid transparent;
            border-radius: 7px;
            background: #003b70;
            color: white;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.5;
            cursor: pointer;
        }

        .button:hover,
        button:hover {
            background: #002d56;
        }

        .button .icon,
        button .icon {
            width: 17px;
            height: 17px;
        }

        .secondary {
            border-color: #d5e0eb;
            background: white;
            color: #335a7a;
        }

        .secondary:hover {
            background: #edf4fa;
        }

        .approve-button {
            background: #16804b;
        }

        .approve-button:hover {
            background: #10673c;
        }

        .danger {
            background: #b42318;
        }

        .danger:hover {
            background: #941d14;
        }

        .sidebar .logout-btn {
            min-height: 0;
            padding: 10px;
            border-color: rgba(255, 255, 255, 0.12);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.06);
            font-size: 11px;
        }

        .sidebar .logout-btn:hover {
            background: #dc3545;
            border-color: #dc3545;
        }

        .card {
            min-width: 0;
            margin-bottom: 22px;
            padding: 23px;
            border: 1px solid #dfe7ef;
            border-radius: 12px;
            background: white;
            box-shadow: 0 3px 14px #193e6005;
        }

        .card-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 22px;
        }

        .card-heading h2 {
            margin: 0;
            font-size: 16px;
        }

        .count {
            padding: 7px 11px;
            border-radius: 6px;
            background: #edf5fc;
            color: #003b70;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .filters {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-field {
            flex: 1 1 260px;
            max-width: 430px;
        }

        .filter-status {
            flex: 0 1 230px;
        }

        label {
            display: block;
            margin: 15px 0 9px;
            color: #52677b;
            font-size: 12px;
            font-weight: 700;
        }

        .filters label {
            margin-top: 0;
        }

        input:not([type=checkbox]),
        select,
        textarea {
            width: 100%;
            min-height: 41px;
            padding: 10px 12px;
            border: 1px solid #ccd9e5;
            border-radius: 7px;
            background: white;
            color: #263849;
            font-size: 13px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #c5dcef;
            outline-offset: 1px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #94a3b3;
        }

        textarea {
            min-height: 115px;
            resize: vertical;
        }

        .filter-links {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #edf1f5;
        }

        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border: 1px solid #dfe7ef;
            border-radius: 7px;
            color: #64788c;
            font-size: 12px;
        }

        .filter-chip .icon {
            width: 16px;
            height: 16px;
        }

        .filter-chip:hover {
            background: #f5f9fc;
        }

        .filter-chip.active {
            border-color: #c9deef;
            background: #edf5fc;
            color: #003b70;
            font-weight: 700;
        }

        .scroll {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            padding: 15px 12px;
            border-bottom: 1px solid #e6edf3;
            text-align: left;
            vertical-align: middle;
            line-height: 1.7;
        }

        th {
            background: #f0f6fb;
            color: #536d84;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fbfdff;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .request-code {
            color: #75879a;
            font-weight: 700;
        }

        .booking-code {
            color: #003b70;
            font-weight: 800;
            white-space: nowrap;
        }

        .customer {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            background: #edf4fa;
            color: #3d698c;
            font-weight: 700;
        }

        .customer-name {
            font-weight: 600;
        }

        .money {
            color: #173b5a;
            font-weight: 800;
            white-space: nowrap;
        }

        .date {
            color: #445d73;
            white-space: nowrap;
        }

        .time-detail {
            display: block;
            margin-top: 3px;
            color: #8a98a7;
            font-size: 11px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 6px;
            background: #edf2f7;
            color: #52677b;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge .icon {
            width: 15px;
            height: 15px;
        }

        .badge.pending {
            background: #fff3dc;
            color: #93600a;
        }

        .badge.approved {
            background: #e9f7ef;
            color: #167346;
        }

        .badge.rejected {
            background: #fdeeee;
            color: #b42318;
        }

        .detail-button {
            min-height: 34px;
            padding: 8px 10px;
            border-color: #d9e7f3;
            background: #eef5fb;
            color: #003b70;
            font-size: 11px;
            white-space: nowrap;
        }

        .detail-button:hover {
            background: #e0edf8;
        }

        .empty {
            padding: 40px 20px;
            text-align: center;
            color: #7b8b9b;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #e6edf3;
        }

        .notice,
        .success,
        .errors {
            margin: 0 0 20px;
            padding: 15px 16px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.8;
        }

        .notice {
            border-color: #f2dfb7;
            background: #fff7e9;
            color: #855b13;
        }

        .success {
            border-color: #cbe7d7;
            background: #edf9f2;
            color: #146c43;
        }

        .errors {
            border-color: #f2d1d1;
            background: #fff0f0;
            color: #a12620;
        }

        .grid {
            display: grid;
            grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);
            align-items: start;
            gap: 22px;
        }

        .bill-preview {
            display: block;
            padding: 14px;
            border: 1px solid #e2eaf1;
            border-radius: 9px;
            background: #f5f8fb;
        }

        .bill {
            display: block;
            width: 100%;
            max-height: 650px;
            object-fit: contain;
        }

        .info-list {
            margin: 0;
        }

        .info-row {
            display: grid;
            grid-template-columns: minmax(130px, .8fr) minmax(0, 1.2fr);
            gap: 16px;
            padding: 13px 0;
            border-bottom: 1px solid #edf1f5;
            line-height: 1.7;
        }

        .info-row:first-child {
            padding-top: 0;
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        .info-row dt {
            color: #718296;
            font-size: 12px;
        }

        .info-row dd {
            margin: 0;
            overflow-wrap: anywhere;
            color: #263f54;
            font-size: 13px;
            font-weight: 600;
        }

        .message {
            margin-top: 18px;
            padding: 14px;
            border: 1px solid #e2ebf3;
            border-radius: 8px;
            background: #f7faff;
        }

        .message p {
            margin: 7px 0 0;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .result {
            margin-top: 20px;
        }

        .result p {
            margin: 8px 0;
        }

        .decision-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            align-items: start;
            gap: 22px;
        }

        .decision-grid.single {
            grid-template-columns: 1fr;
        }

        .decision-form {
            min-width: 0;
            padding: 20px;
            border: 1px solid #dfe7ef;
            border-radius: 9px;
        }

        .approve-form {
            border-top: 3px solid #16804b;
        }

        .reject-form {
            border-top: 3px solid #b42318;
        }

        .checkbox {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin: 16px 0;
            font-weight: 400;
            line-height: 1.8;
        }

        .checkbox input {
            width: 17px;
            height: 17px;
            margin: 3px 0 0;
            flex-shrink: 0;
        }

        .decision-form button {
            margin-top: 16px;
        }

        @media (max-width: 1100px) {
            .grid,
            .decision-grid {
                grid-template-columns: 1fr;
            }

            .page-heading {
                flex-direction: column;
            }

            .content {
                padding: 24px 20px;
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .page {
                margin-left: 0;
            }

            .menu {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sidebar-bottom {
                margin-top: 22px;
            }
        }

        @media (max-width: 650px) {
            .menu {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-wrap: wrap;
                padding: 18px;
            }

            .content {
                padding: 20px 15px 35px;
            }

            .card {
                padding: 18px;
            }

            h1 {
                font-size: 23px;
            }

            .filter-field,
            .filter-status {
                flex: 1 1 100%;
                max-width: none;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }
        }
    </style>
</head>

<body>
@php
    // Danh sách và chi tiết cùng hiển thị trong file này.
    $isDetail = isset($review) && $review !== null;

    $statusLabels = [
        'pending' => 'Chờ xử lý',
        'approved' => 'Đã duyệt',
        'rejected' => 'Đã từ chối',
    ];

    $statusIcons = [
        'pending' => 'pr-clock',
        'approved' => 'pr-check',
        'rejected' => 'pr-close',
    ];

    $bookingLabels = [
        'pending' => 'Chờ thanh toán',
        'confirmed' => 'Đã xác nhận',
        'cancelled' => 'Đã hủy',
    ];

    $paymentLabels = [
        'unpaid' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán',
        'refunded' => 'Đã hoàn tiền',
        'failed' => 'Thanh toán thất bại',
    ];

    $ticketLabels = [
        'pending' => 'Chưa có hiệu lực',
        'active' => 'Có hiệu lực',
        'used' => 'Đã check-in',
        'cancelled' => 'Đã hủy',
    ];

    $menus = [
        [
            'admin.trang-chu',
            'Tổng quan',
            'M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h7v7h-7z',
        ],
        [
            'admin.airports.index',
            'Quản lý sân bay',
            'M5 21V7l7-4 7 4v14M3 21h18M9 9h1M14 9h1M9 13h1M14 13h1M10 21v-4h4v4',
        ],
        [
            'admin.aircraft.index',
            'Quản lý máy bay',
            'm3 10 18 2-18 8 3-7-3-3ZM6 13l15-1',
        ],
        [
            'admin.flights.index',
            'Quản lý chuyến bay',
            'M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2ZM8 3v4M16 3v4M3 10h18',
        ],
        [
            'admin.bookings.index',
            'Quản lý vé',
            'M4 4h16v16H4zM8 8h8M8 12h8M8 16h5',
        ],
        [
            'admin.users.index',
            'Quản lý người dùng',
            'M9 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM3 21v-2a6 6 0 0 1 12 0v2M16 11a4 4 0 0 1 5 4',
        ],
        [
            'admin.employees.index',
            'Quản lý nhân viên',
            'M9 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM3 21v-2a6 6 0 0 1 12 0v2M16 11a4 4 0 0 1 5 4',
        ],
        [
            'admin.payment-reviews.index',
            'Đối soát thanh toán',
            'M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2ZM3 9h18M7 14h3',
        ],
        [
            'admin.check-ins.index',
            'Lịch sử check-in',
            'M12 3a9 9 0 1 0 9 9 9 9 0 0 0-9-9ZM12 7v5l3 2',
        ],
        [
            'admin.baggage.index',
            'Quản lý hành lý',
            'M7 7h10a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2ZM9 7V5a3 3 0 0 1 6 0v2M8 11h8',
        ],
        [
            'admin.statistics.index',
            'Thống kê chi tiết',
            'M4 20V10M10 20V4M16 20v-7M22 20V7',
        ],
        [
            'admin.settings.edit',
            'Quản lý đổi giá vé',
            'M3 7h10M17 7h4M3 17h4M11 17h10M17 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM11 17a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z',
        ],
        [
            'admin.refund-settings.edit',
            'Quản lý hoàn vé',
            'M3 6h18v12H3zM7 12h10M10 9l-3 3 3 3',
        ],
    ];

    $canApprove = $isDetail
        && $booking
        && $booking->booking_status === 'pending'
        && $booking->payment_status === 'unpaid'
        && $booking->expires_at
        && !$booking->expires_at->isPast();
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    width="0"
    height="0"
    aria-hidden="true"
    style="position:absolute;overflow:hidden"
>
    <defs>
        <symbol id="pr-search" viewBox="0 0 24 24">
            <circle cx="10.5" cy="10.5" r="6.5"/>
            <path d="m16 16 5 5"/>
        </symbol>

        <symbol id="pr-filter" viewBox="0 0 24 24">
            <path d="M3 4h18l-7 8v7l-4 2v-9z"/>
        </symbol>

        <symbol id="pr-refresh" viewBox="0 0 24 24">
            <path d="M20 7v5h-5M4 17v-5h5"/>
            <path d="M6 7a7 7 0 0 1 12-1l2 3M4 15l2 3a7 7 0 0 0 12-1"/>
        </symbol>

        <symbol id="pr-eye" viewBox="0 0 24 24">
            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
            <circle cx="12" cy="12" r="3"/>
        </symbol>

        <symbol id="pr-clock" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 2"/>
        </symbol>

        <symbol id="pr-check" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m8 12 3 3 5-6"/>
        </symbol>

        <symbol id="pr-close" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="m9 9 6 6M15 9l-6 6"/>
        </symbol>

        <symbol id="pr-list" viewBox="0 0 24 24">
            <rect x="4" y="3" width="16" height="18" rx="2"/>
            <path d="M8 8h8M8 12h8M8 16h5"/>
        </symbol>

        <symbol id="pr-payment" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <path d="M3 9h18M7 14h3"/>
        </symbol>

        <symbol id="pr-ticket" viewBox="0 0 24 24">
            <path d="M3 5h18v5a2 2 0 0 0 0 4v5H3v-5a2 2 0 0 0 0-4V5ZM15 5v3M15 11v2M15 16v3"/>
        </symbol>

        <symbol id="pr-image" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2"/>
            <circle cx="8" cy="8" r="1.5"/>
            <path d="m21 15-5-5L5 21"/>
        </symbol>
    </defs>
</svg>

<aside class="sidebar">
    <a class="logo" href="{{ route('admin.trang-chu') }}">
        Viet<span>jet</span>
    </a>

    <div class="menu-title">QUẢN LÝ HỆ THỐNG</div>

    <nav class="menu" aria-label="Menu quản trị">
        @foreach($menus as [$menuRoute, $menuName, $menuPath])
            <a
                href="{{ route($menuRoute) }}"
                class="menu-link {{ $menuRoute === 'admin.payment-reviews.index' ? 'active' : '' }}"
                @if($menuRoute === 'admin.payment-reviews.index')
                    aria-current="page"
                @endif
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="{{ $menuPath }}"/>
                    </svg>
                </span>

                <span>{{ $menuName }}</span>
            </a>
        @endforeach
    </nav>

    <div class="sidebar-bottom">
        <div class="admin-info">
            <strong>{{ auth()->user()->name }}</strong>
            <span>Quản trị viên hệ thống</span>
        </div>

        <form method="POST" action="{{ route('dang-xuat') }}">
            @csrf

            <button type="submit" class="logout-btn">
                Đăng xuất
            </button>
        </form>
    </div>
</aside>

<div class="page">
    <header class="topbar">
        <div>
            <strong class="topbar-title">VietJet Administration</strong>
            <small>Kiểm tra và đối soát yêu cầu thanh toán của khách hàng</small>
        </div>

        <div class="buttons">
            <a class="button secondary" href="{{ route('admin.bookings.index') }}">
                <svg class="icon" aria-hidden="true">
                    <use href="#pr-ticket"></use>
                </svg>
                Quản lý vé
            </a>

            <a class="button" href="{{ route('admin.payment-reviews.index') }}">
                <svg class="icon" aria-hidden="true">
                    <use href="#pr-payment"></use>
                </svg>
                Đối soát thanh toán
            </a>
        </div>
    </header>

    <main class="content">
        <nav class="breadcrumb" aria-label="Đường dẫn">
            <a href="{{ route('admin.trang-chu') }}">Tổng quan</a>
            <span>/</span>
            <a href="{{ route('admin.payment-reviews.index') }}">
                Đối soát thanh toán
            </a>

            @if($isDetail)
                <span>/</span>
                <span>Yêu cầu #{{ $review->id }}</span>
            @endif
        </nav>

        @if(session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="errors" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- DANH SÁCH YÊU CẦU --}}
        @if(!$isDetail)
            <div class="page-heading">
                <div>
                    <h1>Đối soát thanh toán</h1>

                    <p class="description">
                        Kiểm tra các yêu cầu của khách khi hóa đơn chưa được
                        hệ thống xác nhận tự động.
                    </p>
                </div>

                <a
                    class="button secondary"
                    href="{{ route('admin.payment-reviews.index', [
                        'status' => $status,
                        'keyword' => $keyword,
                    ]) }}"
                >
                    <svg class="icon" aria-hidden="true">
                        <use href="#pr-refresh"></use>
                    </svg>
                    Làm mới
                </a>
            </div>

            <section class="card">
                <div class="card-heading">
                    <h2>
                        <svg class="icon" aria-hidden="true">
                            <use href="#pr-search"></use>
                        </svg>
                        Tìm kiếm yêu cầu
                    </h2>
                </div>

                <form
                    method="GET"
                    action="{{ route('admin.payment-reviews.index') }}"
                    class="filters"
                >
                    <div class="filter-field">
                        <label for="keyword">Mã đặt vé</label>

                        <input
                            id="keyword"
                            name="keyword"
                            value="{{ $keyword }}"
                            maxlength="80"
                            placeholder="Nhập mã đặt vé cần kiểm tra..."
                        >
                    </div>

                    <div class="filter-status">
                        <label for="status">Trạng thái yêu cầu</label>

                        <select id="status" name="status">
                            <option value="" @selected($status === '')>
                                Tất cả trạng thái
                            </option>

                            @foreach($statusLabels as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    @selected($status === $value)
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit">
                        <svg class="icon" aria-hidden="true">
                            <use href="#pr-filter"></use>
                        </svg>
                        Tìm / Lọc
                    </button>

                    <a
                        class="button secondary"
                        href="{{ route('admin.payment-reviews.index', ['status' => '']) }}"
                    >
                        Đặt lại bộ lọc
                    </a>
                </form>

                <div class="filter-links">
                    @foreach([
                        '' => ['Tất cả', 'pr-list'],
                        'pending' => ['Chờ xử lý', 'pr-clock'],
                        'approved' => ['Đã duyệt', 'pr-check'],
                        'rejected' => ['Đã từ chối', 'pr-close'],
                    ] as $filterValue => [$filterLabel, $filterIcon])
                        <a
                            class="filter-chip {{ $status === $filterValue ? 'active' : '' }}"
                            href="{{ route('admin.payment-reviews.index', [
                                'status' => $filterValue,
                                'keyword' => $keyword,
                            ]) }}"
                        >
                            <svg class="icon" aria-hidden="true">
                                <use href="#{{ $filterIcon }}"></use>
                            </svg>

                            {{ $filterLabel }}
                        </a>
                    @endforeach
                </div>
            </section>

            <section class="card">
                <div class="card-heading">
                    <h2>
                        <svg class="icon" aria-hidden="true">
                            <use href="#pr-list"></use>
                        </svg>
                        Danh sách yêu cầu
                    </h2>

                    <span class="count">{{ $reviews->total() }} yêu cầu</span>
                </div>

                <div class="scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Yêu cầu</th>
                                <th>Mã đặt vé</th>
                                <th>Khách hàng</th>
                                <th>Số tiền đơn</th>
                                <th>Thời gian gửi</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($reviews as $item)
                                @php
                                    $customerName = $item->customer_name ?? 'Khách hàng';

                                    $initial = \Illuminate\Support\Str::upper(
                                        \Illuminate\Support\Str::substr($customerName, 0, 1)
                                    );

                                    $createdAt = \Carbon\Carbon::parse(
                                        $item->created_at,
                                        config('app.timezone')
                                    )->timezone('Asia/Ho_Chi_Minh');

                                    $itemIcon = $statusIcons[$item->status] ?? 'pr-list';
                                @endphp

                                <tr>
                                    <td>
                                        <span class="request-code">#{{ $item->id }}</span>
                                    </td>

                                    <td>
                                        <span class="booking-code">
                                            {{ $item->booking_code }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="customer">
                                            <span class="avatar" aria-hidden="true">
                                                {{ $initial }}
                                            </span>

                                            <span class="customer-name">
                                                {{ $customerName }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="money">
                                            {{ number_format($item->expected_amount, 0, ',', '.') }}đ
                                        </span>
                                    </td>

                                    <td>
                                        <span class="date">
                                            {{ $createdAt->format('d/m/Y') }}

                                            <span class="time-detail">
                                                {{ $createdAt->format('H:i:s') }}
                                            </span>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge {{ $item->status }}">
                                            <svg class="icon" aria-hidden="true">
                                                <use href="#{{ $itemIcon }}"></use>
                                            </svg>

                                            {{ $statusLabels[$item->status] ?? $item->status }}
                                        </span>
                                    </td>

                                    <td>
                                        <a
                                            class="button detail-button"
                                            href="{{ route('admin.payment-reviews.show', $item->id) }}"
                                        >
                                            <svg class="icon" aria-hidden="true">
                                                <use href="#pr-eye"></use>
                                            </svg>
                                            Xem chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="empty">
                                        Không có yêu cầu phù hợp với bộ lọc.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($reviews->hasPages())
                    <nav class="pagination" aria-label="Phân trang yêu cầu">
                        <div>
                            @if($reviews->previousPageUrl())
                                <a
                                    class="button secondary"
                                    href="{{ $reviews->previousPageUrl() }}"
                                    rel="prev"
                                >
                                    ← Trang trước
                                </a>
                            @endif
                        </div>

                        <span class="muted">
                            Trang {{ $reviews->currentPage() }}
                            / {{ $reviews->lastPage() }}
                        </span>

                        <div>
                            @if($reviews->nextPageUrl())
                                <a
                                    class="button secondary"
                                    href="{{ $reviews->nextPageUrl() }}"
                                    rel="next"
                                >
                                    Trang sau →
                                </a>
                            @endif
                        </div>
                    </nav>
                @endif
            </section>

        {{-- CHI TIẾT YÊU CẦU --}}
        @else
            <div class="page-heading">
                <div>
                    <h1>Chi tiết yêu cầu #{{ $review->id }}</h1>

                    <p class="description">
                        Mã đặt vé:
                        <strong>{{ $review->booking_code }}</strong>
                        · Kiểm tra hóa đơn và thông tin thanh toán.
                    </p>
                </div>

                <a
                    class="button secondary"
                    href="{{ route('admin.payment-reviews.index') }}"
                >
                    <svg class="icon" aria-hidden="true">
                        <use href="#pr-list"></use>
                    </svg>
                    Danh sách yêu cầu
                </a>
            </div>

            <div class="grid">
                <section class="card">
                    <h2>
                        <svg class="icon" aria-hidden="true">
                            <use href="#pr-image"></use>
                        </svg>
                        Hóa đơn khách gửi
                    </h2>

                    <a
                        class="bill-preview"
                        href="{{ route('payment-reviews.image', $review->id) }}"
                        target="_blank"
                        rel="noopener"
                    >
                        <img
                            class="bill"
                            src="{{ route('payment-reviews.image', $review->id) }}"
                            alt="Hóa đơn chuyển khoản của yêu cầu {{ $review->id }}"
                        >
                    </a>

                    <p class="muted">Bấm vào ảnh để xem kích thước đầy đủ.</p>
                </section>

                <section class="card">
                    <h2>
                        <svg class="icon" aria-hidden="true">
                            <use href="#pr-payment"></use>
                        </svg>
                        Thông tin thanh toán
                    </h2>

                    <dl class="info-list">
                        <div class="info-row">
                            <dt>Khách hàng</dt>
                            <dd>{{ $review->customer_name ?? '---' }}</dd>
                        </div>

                        <div class="info-row">
                            <dt>Mã đặt vé</dt>
                            <dd>{{ $review->booking_code }}</dd>
                        </div>

                        <div class="info-row">
                            <dt>Số tiền lúc gửi yêu cầu</dt>
                            <dd class="money">
                                {{ number_format($review->expected_amount, 0, ',', '.') }}đ
                            </dd>
                        </div>

                        <div class="info-row">
                            <dt>Nội dung yêu cầu của đơn</dt>
                            <dd>VJ {{ $review->booking_code }}</dd>
                        </div>

                        <div class="info-row">
                            <dt>Nội dung OCR ghi nhận</dt>
                            <dd>
                                {{ $review->receipt_content ?? 'Chưa đọc được / khách chọn ảnh mới' }}
                            </dd>
                        </div>

                        <div class="info-row">
                            <dt>Mã giao dịch OCR ghi nhận</dt>
                            <dd>
                                {{ $review->transaction_code ?? 'Chưa đọc được / khách chọn ảnh mới' }}
                            </dd>
                        </div>

                        <div class="info-row">
                            <dt>Trạng thái yêu cầu</dt>
                            <dd>
                                <span class="badge {{ $review->status }}">
                                    {{ $statusLabels[$review->status] ?? $review->status }}
                                </span>
                            </dd>
                        </div>

                        @if($booking)
                            <div class="info-row">
                                <dt>Trạng thái đơn hiện tại</dt>
                                <dd>
                                    {{ $bookingLabels[$booking->booking_status] ?? $booking->booking_status }}
                                </dd>
                            </div>

                            <div class="info-row">
                                <dt>Thanh toán của đơn</dt>
                                <dd>
                                    {{ $paymentLabels[$booking->payment_status] ?? $booking->payment_status }}
                                </dd>
                            </div>
                        @endif
                    </dl>

                    <div class="message">
                        <strong>Lời nhắn của khách</strong>
                        <p>{{ $review->message }}</p>
                    </div>

                    @if($booking)
                        <div class="buttons" style="margin-top:18px">
                            <a
                                class="button secondary"
                                href="{{ route('admin.bookings.show', $booking->id) }}"
                            >
                                <svg class="icon" aria-hidden="true">
                                    <use href="#pr-ticket"></use>
                                </svg>
                                Xem đơn vé
                            </a>

                            @if($review->status === 'pending')
                                <a class="button" href="#xu-ly-yeu-cau">
                                    <svg class="icon" aria-hidden="true">
                                        <use href="#pr-payment"></use>
                                    </svg>
                                    Xử lý yêu cầu
                                </a>
                            @endif
                        </div>

                        @if($review->status === 'pending')
                            @if($booking->payment_status === 'paid')
                                <div class="success result">
                                    Đơn này đã được ghi nhận thanh toán.
                                    Không duyệt thêm giao dịch cho cùng đơn.
                                </div>
                            @elseif(!$canApprove)
                                <div class="notice result">
                                    Đơn không còn đủ điều kiện giữ ghế để duyệt
                                    kích hoạt vé. Nếu khách đã chuyển tiền,
                                    cần xử lý ghế hoặc hoàn tiền riêng.
                                </div>
                            @endif
                        @endif
                    @else
                        <div class="notice result">
                            Không tìm thấy đơn đặt vé hiện tại.
                            Không thể duyệt kích hoạt vé cho yêu cầu này.
                        </div>
                    @endif

                    @if($review->reviewed_at)
                        <div
                            class="{{ $review->status === 'approved' ? 'success' : 'notice' }} result"
                        >
                            <strong>Kết quả xử lý</strong>

                            <p>{{ $review->reviewer_note }}</p>

                            <p>
                                Người xử lý:
                                {{ $review->reviewer_name ?? '---' }}
                                <br>
                                Thời gian:
                                {{ \Carbon\Carbon::parse($review->reviewed_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                            </p>

                            @if($review->approved_transaction_code)
                                <p>
                                    Mã giao dịch đã duyệt:
                                    <strong>{{ $review->approved_transaction_code }}</strong>
                                    <br>
                                    Thực nhận:
                                    <strong>
                                        {{ number_format($review->received_amount, 0, ',', '.') }}đ
                                    </strong>
                                </p>
                            @endif
                        </div>
                    @endif
                </section>
            </div>

            @if($booking)
                <section class="card">
                    <h2>
                        <svg class="icon" aria-hidden="true">
                            <use href="#pr-ticket"></use>
                        </svg>
                        Vé trong đơn
                    </h2>

                    <div class="scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã vé</th>
                                    <th>Hành khách</th>
                                    <th>Chuyến bay</th>
                                    <th>Hành trình</th>
                                    <th>Ngày bay</th>
                                    <th>Ghế</th>
                                    <th>Trạng thái vé</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($booking->tickets as $ticket)
                                    <tr>
                                        <td>
                                            <strong>{{ $ticket->ticket_code }}</strong>
                                        </td>

                                        <td>{{ $ticket->passenger_name }}</td>

                                        <td>
                                            {{ $ticket->flight?->flight_code ?? '---' }}
                                        </td>

                                        <td>
                                            {{ $ticket->flight?->departureAirport?->city ?? '---' }}
                                            →
                                            {{ $ticket->flight?->arrivalAirport?->city ?? '---' }}
                                        </td>

                                        <td>
                                            {{ $ticket->flight?->flight_date?->format('d/m/Y') ?? '---' }}
                                        </td>

                                        <td>
                                            {{ $ticket->flightSeat?->seat_number ?? '---' }}
                                        </td>

                                        <td>
                                            {{ $ticketLabels[$ticket->ticket_status] ?? $ticket->ticket_status }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="empty">
                                            Đơn này chưa có dữ liệu vé.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            @endif

            {{-- DUYỆT VÀ TỪ CHỐI --}}
            @if($review->status === 'pending')
                <section class="card" id="xu-ly-yeu-cau">
                    <h2>
                        <svg class="icon" aria-hidden="true">
                            <use href="#pr-payment"></use>
                        </svg>
                        Xử lý yêu cầu thanh toán
                    </h2>

                    <p class="notice">
                        Chỉ duyệt sau khi đã kiểm tra giao dịch nhận tiền.
                        Bill sai nội dung không được tự xem là bằng chứng
                        tiền đã vào tài khoản.
                    </p>

                    <div class="decision-grid {{ $canApprove ? '' : 'single' }}">
                        @if($canApprove)
                            <form
                                method="POST"
                                action="{{ route('admin.payment-reviews.decide', $review->id) }}"
                                class="decision-form approve-form"
                            >
                                @csrf

                                <input type="hidden" name="decision" value="approve">

                                <h3>Duyệt thanh toán</h3>

                                <label for="transaction_code">
                                    Mã giao dịch đã đối soát
                                </label>

                                <input
                                    id="transaction_code"
                                    name="transaction_code"
                                    value="{{ old('transaction_code', $review->transaction_code) }}"
                                    required
                                    minlength="6"
                                    maxlength="80"
                                    pattern="[A-Za-z0-9-]{6,80}"
                                >

                                <label for="received_amount">
                                    Số tiền thực nhận (đồng)
                                </label>

                                <input
                                    id="received_amount"
                                    name="received_amount"
                                    type="number"
                                    min="1"
                                    step="1"
                                    value="{{ old('received_amount') }}"
                                    required
                                >

                                <label for="approve_note">Ghi chú duyệt</label>

                                <textarea
                                    id="approve_note"
                                    name="note"
                                    required
                                    minlength="3"
                                    maxlength="1000"
                                    placeholder="Ghi kết quả kiểm tra giao dịch."
                                >{{ old('decision') === 'approve' ? old('note') : '' }}</textarea>

                                <label class="checkbox">
                                    <input
                                        type="checkbox"
                                        name="bank_confirmed"
                                        value="1"
                                        required
                                        @checked(
                                            old('decision') === 'approve'
                                            && old('bank_confirmed') == '1'
                                        )
                                    >

                                    <span>
                                        Tôi đã kiểm tra giao dịch nhận tiền,
                                        mã giao dịch và số tiền thuộc đơn này.
                                    </span>
                                </label>

                                <button type="submit" class="approve-button">
                                    <svg class="icon" aria-hidden="true">
                                        <use href="#pr-check"></use>
                                    </svg>
                                    Duyệt thanh toán và kích hoạt vé
                                </button>
                            </form>
                        @endif

                        <form
                            method="POST"
                            action="{{ route('admin.payment-reviews.decide', $review->id) }}"
                            class="decision-form reject-form"
                        >
                            @csrf

                            <input type="hidden" name="decision" value="reject">

                            <h3>Từ chối yêu cầu</h3>

                            <p class="muted">
                                Ghi rõ lý do và hướng xử lý tiếp theo để khách
                                biết cần bổ sung hoặc kiểm tra thông tin nào.
                            </p>

                            <label for="reject_note">
                                Lý do từ chối / hướng xử lý tiếp theo
                            </label>

                            <textarea
                                id="reject_note"
                                name="note"
                                required
                                minlength="3"
                                maxlength="1000"
                                placeholder="Ghi rõ lý do và hướng xử lý cho khách."
                            >{{ old('decision') === 'reject' ? old('note') : '' }}</textarea>

                            <button type="submit" class="danger">
                                <svg class="icon" aria-hidden="true">
                                    <use href="#pr-close"></use>
                                </svg>
                                Từ chối yêu cầu
                            </button>
                        </form>
                    </div>
                </section>
            @endif
        @endif
    </main>
</div>
</body>
</html>