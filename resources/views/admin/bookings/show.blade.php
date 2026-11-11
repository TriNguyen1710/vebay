<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Chi tiết vé - Vietjet Admin</title>

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
            --background: #f3f6f9;
            --white: #ffffff;
            --text: #243746;
            --muted: #74818c;
            --border: #dfe6eb;
            --success: #198754;
            --success-bg: #ecf8f1;
            --warning: #b88700;
            --warning-bg: #fff8e6;
            --danger: #dc3545;
            --danger-bg: #fff1f3;
            --info: #0d6efd;
            --info-bg: #eef5ff;
            --shadow: 0 10px 30px rgba(16, 42, 67, 0.08);
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        .admin-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 245px 1fr;
        }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 245px;
            padding: 26px 16px;
            display: flex;
            flex-direction: column;
            background: var(--primary-dark);
            color: white;
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
            color: var(--secondary);
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

        .menu-link:hover,
        .menu-link.active {
            background: rgba(255, 255, 255, 0.1);
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
        }

        .menu-link.active .menu-icon {
            color: var(--secondary);
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
            background: var(--danger);
            border-color: var(--danger);
        }

        /* =========================
           MAIN
        ========================= */
        .main {
            grid-column: 2;
            min-width: 0;
        }

        .topbar {
            height: 70px;
            padding: 0 30px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-left h2 {
            margin-bottom: 3px;
            color: var(--primary);
            font-size: 19px;
        }

        .topbar-left p {
            color: var(--muted);
            font-size: 10px;
        }

        .admin-badge {
            padding: 7px 11px;
            border: 1px solid #cbdce7;
            border-radius: 5px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 10px;
            font-weight: bold;
        }

        .content {
            max-width: 1280px;
            margin: auto;
            padding: 28px 30px 45px;
        }

        .page-heading {
            margin-bottom: 22px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
        }

        .page-heading h1 {
            margin-bottom: 6px;
            color: var(--text);
            font-size: 24px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 11px;
        }

        .back-btn {
            min-height: 38px;
            padding: 0 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: white;
            color: var(--primary);
            font-size: 11px;
            font-weight: bold;
        }

        .back-btn:hover {
            border-color: #c7d6e2;
            background: #f9fbfd;
        }

        .alert {
            margin-bottom: 16px;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .alert-success {
            color: #156c43;
            background: #edf9f2;
            border: 1px solid #bfe8cf;
        }

        .alert-error {
            color: #8d1f2d;
            background: #fff2f4;
            border: 1px solid #f2c7d0;
        }

        /* =========================
           COMMON CARD
        ========================= */
        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
        }

        /* =========================
           BOOKING SUMMARY
        ========================= */
        .booking-card {
            overflow: hidden;
            margin-bottom: 22px;
        }

        .booking-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, #073e74, #0d4c8a);
            color: white;
        }

        .booking-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-icon svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.9;
        }

        .booking-header h2 {
            margin-bottom: 5px;
            font-size: 20px;
        }

        .booking-header p {
            color: #d7e6f2;
            font-size: 12px;
        }

        .booking-code-box {
            padding: 12px 15px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.12);
            text-align: right;
            min-width: 180px;
        }

        .booking-code-box span {
            display: block;
            margin-bottom: 4px;
            color: #d6e6f2;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.6px;
        }

        .booking-code-box strong {
            font-size: 23px;
            letter-spacing: 1px;
        }

        .booking-body {
            padding: 22px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 18px;
        }

        .info-item {
            min-height: 88px;
            padding: 14px 15px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #f9fbfc;
        }

        .info-label {
            display: block;
            margin-bottom: 8px;
            color: #82909b;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.5;
            color: #39505f;
        }

        .info-value.primary {
            color: var(--primary);
        }

        .booking-stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
        }

        .stat-box {
            padding: 14px 15px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: white;
        }

        .stat-box span {
            display: block;
            margin-bottom: 7px;
            color: #7d8a95;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .stat-box strong {
            font-size: 21px;
            color: var(--primary-dark);
        }

        .stat-box.warning {
            background: #fffaf0;
            border-color: #ead89e;
        }

        .stat-box.warning strong {
            color: #9b7200;
        }

        .stat-box.success {
            background: #edf9f2;
            border-color: #caecd8;
        }

        .stat-box.success strong {
            color: #127246;
        }

        .stat-box.danger {
            background: #fff4f5;
            border-color: #f3d0d6;
        }

        .stat-box.danger strong {
            color: #b42335;
        }

        /* =========================
           SECTION TITLE
        ========================= */
        .tickets-title {
            margin: 28px 0 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tickets-title-line {
            width: 4px;
            height: 26px;
            border-radius: 10px;
            background: var(--secondary);
        }

        .tickets-title h2 {
            color: var(--primary-dark);
            font-size: 18px;
        }

        .tickets-title span {
            color: var(--muted);
            font-size: 11px;
        }

        /* =========================
           TICKET CARD
        ========================= */
        .ticket-card {
            margin-bottom: 22px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .ticket-header {
            min-height: 88px;
            padding: 18px 22px;
            background: #093d72;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .ticket-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .ticket-icon {
            width: 42px;
            height: 42px;
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            flex-shrink: 0;
        }

        .ticket-icon svg {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .ticket-header h3 {
            margin-bottom: 4px;
            font-size: 17px;
        }

        .ticket-header p {
            color: #cadcea;
            font-size: 11px;
        }

        .ticket-status-wrap {
            text-align: right;
        }

        .ticket-status-wrap .ticket-status-label {
            display: block;
            margin-bottom: 8px;
            color: #b6cada;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .ticket-body {
            padding: 24px;
        }

        .flight-summary {
            padding: 18px 20px;
            border: 1px solid #e8edf1;
            border-radius: 12px;
            background: #fbfcfd;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 25px;
            margin-bottom: 20px;
        }

        .airport-block:last-child {
            text-align: right;
        }

        .airport-city {
            margin-bottom: 6px;
            color: var(--primary);
            font-size: 20px;
            font-weight: 800;
        }

        .airport-label {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .route-center {
            min-width: 220px;
            text-align: center;
        }

        .flight-code {
            margin-bottom: 10px;
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 800;
        }

        .route-line {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .line {
            height: 1px;
            flex: 1;
            background: #bbc9d3;
        }

        .plane-svg {
            width: 18px;
            height: 18px;
            color: var(--primary);
        }

        .plane-svg svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .ticket-section {
            margin-bottom: 22px;
        }

        .ticket-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            margin-bottom: 13px;
            padding-bottom: 9px;
            border-bottom: 1px solid #edf0f2;
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .detail-item {
            min-height: 80px;
            padding: 13px 14px;
            border-radius: 10px;
            background: #f8fafb;
            border: 1px solid #edf0f2;
        }

        .detail-label {
            display: block;
            margin-bottom: 7px;
            color: #8a969f;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .detail-value {
            color: #394c59;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;
        }

        .detail-value.strong {
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
        }

        .price-value {
            color: #a47700;
            font-size: 17px;
            font-weight: 800;
        }

        .ticket-summary-box {
            margin-top: 14px;
            padding: 16px;
            border: 1px solid #ead89e;
            border-left: 4px solid var(--secondary);
            border-radius: 10px;
            background: #fffaf0;
        }

        .summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 7px 0;
            border-bottom: 1px solid #efe3bc;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row span {
            color: #6c6250;
            font-size: 12px;
            font-weight: 700;
        }

        .summary-row strong {
            color: #354754;
            font-size: 13px;
        }

        .summary-row.total strong {
            color: #9b7200;
            font-size: 18px;
        }

        /* =========================
           BADGES
        ========================= */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 28px;
            padding: 0 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .badge-blue {
            background: #eef5ff;
            color: #1f5c97;
            border-color: #cadcf3;
        }

        .badge-success {
            background: #edf9f2;
            color: #18784a;
            border-color: #caecd8;
        }

        .badge-warning {
            background: #fff7e8;
            color: #a66d00;
            border-color: #f1ddb2;
        }

        .badge-danger {
            background: #fff1f3;
            color: #b6293a;
            border-color: #f0cbd2;
        }

        .badge-dark {
            background: #ecf1f5;
            color: #435462;
            border-color: #d5e0e9;
        }

        /* =========================
           REFUND BOX
        ========================= */
        .refund-box {
            margin-top: 18px;
            border-radius: 12px;
            border: 1px solid #ead89e;
            background: #fffdf7;
            overflow: hidden;
        }

        .refund-box.waiting {
            border-color: #efd18c;
            background: #fffaf0;
        }

        .refund-box.refunded {
            border-color: #c7ead6;
            background: #f4fcf7;
        }

        .refund-box.none {
            border-color: #dbe6ee;
            background: #f8fbfd;
        }

        .refund-box-header {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .refund-box-header h4 {
            font-size: 15px;
            color: #223a4a;
        }

        .refund-box-header p {
            margin-top: 4px;
            color: #6f7f8c;
            font-size: 11px;
            line-height: 1.5;
        }

        .refund-box-body {
            padding: 16px;
        }

        .refund-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        .refund-item {
            padding: 13px 14px;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 10px;
            background: rgba(255,255,255,0.75);
        }

        .refund-item span {
            display: block;
            margin-bottom: 6px;
            color: #7f8d99;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .refund-item strong {
            color: #314654;
            font-size: 13px;
            line-height: 1.5;
        }

        .refund-amount {
            color: #a66d00 !important;
            font-size: 18px !important;
        }

        .refund-note {
            padding: 13px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.7;
        }

        .refund-note.waiting {
            color: #8a6200;
            background: #fff5d9;
            border: 1px solid #f1ddb2;
        }

        .refund-note.refunded {
            color: #176c42;
            background: #edf9f2;
            border: 1px solid #caecd8;
        }

        .refund-note.none {
            color: #5d7080;
            background: #f3f8fb;
            border: 1px solid #d7e4ec;
        }

        .refund-actions {
            margin-top: 16px;
            display: flex;
            justify-content: flex-end;
        }

        .refund-confirm-btn {
            min-height: 42px;
            padding: 0 18px;
            border: none;
            border-radius: 8px;
            background: var(--success);
            color: white;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(25, 135, 84, 0.18);
        }

        .refund-confirm-btn:hover {
            background: #146c43;
        }

        /* =========================
           EMPTY STATE
        ========================= */
        .empty-box {
            padding: 32px 20px;
            text-align: center;
            border: 1px dashed #d6e1e8;
            border-radius: 12px;
            background: #fbfdfe;
            color: #6d7c88;
            font-size: 13px;
            font-weight: 600;
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 1200px) {
            .info-grid,
            .booking-stats,
            .detail-grid,
            .refund-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .admin-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .main {
                grid-column: 1;
            }

            .flight-summary {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .airport-block:last-child {
                text-align: left;
            }

            .route-center {
                min-width: 0;
            }

            .ticket-header,
            .booking-header,
            .page-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .ticket-status-wrap,
            .booking-code-box {
                text-align: left;
            }
        }

        @media (max-width: 640px) {
            .content {
                padding: 20px 16px 36px;
            }

            .topbar {
                padding: 0 16px;
            }

            .info-grid,
            .booking-stats,
            .detail-grid,
            .refund-grid {
                grid-template-columns: 1fr;
            }

            .refund-actions {
                justify-content: stretch;
            }

            .refund-confirm-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

@php
    $totalTickets = $booking->tickets->count();
    $activeTickets = $booking->tickets->where('ticket_status', 'active')->count();
    $usedTickets = $booking->tickets->where('ticket_status', 'used')->count();
    $cancelledTickets = $booking->tickets->where('ticket_status', 'cancelled')->count();
    $waitingRefundTickets = $booking->tickets->where('refund_status', 'waiting_confirmation')->count();
    $refundedTickets = $booking->tickets->where('refund_status', 'refunded')->count();
@endphp

<div class="admin-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <a
            href="{{ route('admin.trang-chu') }}"
            class="logo"
        >
            Viet<span>jet</span>
        </a>

        <div class="menu-title">
            QUẢN LÝ HỆ THỐNG
        </div>

        <nav class="menu">

            <a
                href="{{ route('admin.trang-chu') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                    </svg>
                </span>
                Tổng quan
            </a>

            <a
                href="{{ route('admin.airports.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 21h18"/>
                        <path d="M6 21V9l6-4 6 4v12"/>
                        <path d="M9 13h6"/>
                    </svg>
                </span>
                Quản lý sân bay
            </a>

            <a
                href="{{ route('admin.aircraft.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                    </svg>
                </span>
                Quản lý máy bay
            </a>

            <a
                href="{{ route('admin.flights.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M8 3v4M16 3v4M3 10h18"/>
                    </svg>
                </span>
                Quản lý chuyến bay
            </a>

            <a
                href="{{ route('admin.bookings.index') }}"
                class="menu-link active"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4z"/>
                        <path d="M8 8h8M8 12h8M8 16h5"/>
                    </svg>
                </span>
                Quản lý vé
            </a>

            <a
                href="{{ route('admin.users.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
                        <path d="M16 11a4 4 0 0 1 5 4"/>
                    </svg>
                </span>
                Quản lý người dùng
            </a>

            <a
                href="{{ route('admin.baggage.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="7" width="14" height="13" rx="2"/>
                        <path d="M9 7V5a3 3 0 0 1 6 0v2"/>
                        <path d="M8 11h8"/>
                    </svg>
                </span>
                Quản lý hành lý
            </a>

            <a
                href="{{ route('admin.statistics.index') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 20V10"/>
                        <path d="M10 20V4"/>
                        <path d="M16 20v-7"/>
                        <path d="M22 20V7"/>
                    </svg>
                </span>
                Thống kê chi tiết
            </a>

            <a
                href="{{ route('admin.settings.edit') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h10"/>
                        <path d="M18 7h2"/>
                        <circle cx="16" cy="7" r="2"/>
                        <path d="M4 12h2"/>
                        <path d="M10 12h10"/>
                        <circle cx="8" cy="12" r="2"/>
                        <path d="M4 17h7"/>
                        <path d="M15 17h5"/>
                        <circle cx="13" cy="17" r="2"/>
                    </svg>
                </span>
                Quản lý đổi giá vé
            </a>

            <a
                href="{{ route('admin.refund-settings.edit') }}"
                class="menu-link"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h16v10H4z"/>
                        <path d="M8 11h8"/>
                        <path d="M12 8v6"/>
                    </svg>
                </span>
                Quản lý hoàn vé
            </a>

        </nav>

        <div class="sidebar-bottom">
            <div class="admin-info">
                <strong>{{ auth()->user()->name }}</strong>
                <span>Quản trị viên hệ thống</span>
            </div>

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
        </div>

    </aside>

    {{-- MAIN --}}
    <main class="main">

        <header class="topbar">
            <div class="topbar-left">
                <h2>Vietjet Administration</h2>
                <p>Chi tiết đơn đặt vé và trạng thái từng vé</p>
            </div>

            <span class="admin-badge">ADMIN</span>
        </header>

        <div class="content">

            <div class="page-heading">
                <div>
                    <h1>Chi tiết vé / đơn đặt vé</h1>
                    <p>
                        Đây là trang chi tiết theo <strong>đơn đặt vé</strong>.
                        Nếu một đơn có 2 vé thì tại đây vẫn hiển thị đủ 2 vé,
                        nhưng mỗi vé sẽ có trạng thái riêng: còn hiệu lực, đã hủy,
                        chờ hoàn tiền hoặc đã hoàn tiền.
                    </p>
                </div>

                <a
                    href="{{ route('admin.bookings.index') }}"
                    class="back-btn"
                >
                    ← Quay lại danh sách vé
                </a>
            </div>

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

            {{-- BOOKING SUMMARY --}}
            <section class="booking-card card">

                <div class="booking-header">

                    <div class="booking-header-left">
                        <div class="header-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 5h16v14H4z"/>
                                <path d="M8 9h8"/>
                                <path d="M8 13h5"/>
                            </svg>
                        </div>

                        <div>
                            <h2>Thông tin đơn đặt vé</h2>
                            <p>Thông tin người đặt, tổng quan đơn và trạng thái chung.</p>
                        </div>
                    </div>

                    <div class="booking-code-box">
                        <span>MÃ ĐẶT VÉ</span>
                        <strong>{{ $booking->booking_code }}</strong>
                    </div>

                </div>

                <div class="booking-body">

                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Người đặt</span>
                            <div class="info-value primary">
                                {{ $booking->user->name ?? 'Không xác định' }}
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Email tài khoản</span>
                            <div class="info-value">
                                {{ $booking->user->email ?? '-' }}
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Ngày đặt</span>
                            <div class="info-value">
                                {{ optional($booking->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Thanh toán đơn</span>
                            <div class="info-value">
                                @if($booking->payment_status === 'paid')
                                    <span class="badge badge-success">Đã thanh toán</span>
                                @elseif($booking->payment_status === 'pending')
                                    <span class="badge badge-warning">Chờ thanh toán</span>
                                @else
                                    <span class="badge badge-dark">{{ $booking->payment_status ?? 'Không xác định' }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="booking-stats">
                        <div class="stat-box">
                            <span>Tổng số vé</span>
                            <strong>{{ $totalTickets }}</strong>
                        </div>

                        <div class="stat-box success">
                            <span>Vé còn hiệu lực</span>
                            <strong>{{ $activeTickets }}</strong>
                        </div>

                        <div class="stat-box">
                            <span>Vé đã sử dụng</span>
                            <strong>{{ $usedTickets }}</strong>
                        </div>

                        <div class="stat-box danger">
                            <span>Vé đã hủy</span>
                            <strong>{{ $cancelledTickets }}</strong>
                        </div>

                        <div class="stat-box warning">
                            <span>Chờ / đã hoàn tiền</span>
                            <strong>{{ $waitingRefundTickets }} / {{ $refundedTickets }}</strong>
                        </div>
                    </div>

                </div>

            </section>

            {{-- TICKETS --}}
            <div class="tickets-title">
                <div class="tickets-title-line"></div>
                <div>
                    <h2>Danh sách vé trong đơn</h2>
                    <span>Mỗi khối dưới đây là một vé riêng của một hành khách.</span>
                </div>
            </div>

            @forelse($booking->tickets as $index => $ticket)
                <section class="ticket-card">

                    <div class="ticket-header">

                        <div class="ticket-title-wrap">
                            <div class="ticket-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 7h16v10H4z"/>
                                    <path d="M8 11h8"/>
                                    <path d="M8 15h5"/>
                                </svg>
                            </div>

                            <div>
                                <h3>
                                    Vé {{ $ticket->ticket_code }}
                                </h3>
                                <p>
                                    Hành khách {{ $index + 1 }}:
                                    {{ $ticket->passenger_name }}
                                </p>
                            </div>
                        </div>

                        <div class="ticket-status-wrap">
                            <span class="ticket-status-label">Trạng thái vé</span>

                            @if($ticket->ticket_status === 'active')
                                <span class="badge badge-success">Còn hiệu lực</span>
                            @elseif($ticket->ticket_status === 'used')
                                <span class="badge badge-blue">Đã sử dụng</span>
                            @elseif($ticket->ticket_status === 'cancelled')
                                <span class="badge badge-danger">Đã hủy</span>
                            @else
                                <span class="badge badge-dark">{{ $ticket->ticket_status }}</span>
                            @endif
                        </div>

                    </div>

                    <div class="ticket-body">

                        {{-- FLIGHT SUMMARY --}}
                        <div class="flight-summary">

                            <div class="airport-block">
                                <div class="airport-city">
                                    {{ $ticket->flight?->departureAirport?->city ?? '---' }}
                                </div>
                                <div class="airport-label">
                                    {{ $ticket->flight?->departureAirport?->name ?? 'Sân bay đi' }}<br>
                                    {{ optional($ticket->flight?->flight_date)->format('d/m/Y') }}
                                    ·
                                    {{ $ticket->flight?->departure_time }}
                                </div>
                            </div>

                            <div class="route-center">
                                <div class="flight-code">
                                    {{ $ticket->flight?->flight_code ?? '---' }}
                                </div>

                                <div class="route-line">
                                    <div class="line"></div>
                                    <div class="plane-svg">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                                        </svg>
                                    </div>
                                    <div class="line"></div>
                                </div>
                            </div>

                            <div class="airport-block">
                                <div class="airport-city">
                                    {{ $ticket->flight?->arrivalAirport?->city ?? '---' }}
                                </div>
                                <div class="airport-label">
                                    {{ $ticket->flight?->arrivalAirport?->name ?? 'Sân bay đến' }}<br>
                                    {{ optional($ticket->flight?->flight_date)->format('d/m/Y') }}
                                    ·
                                    {{ $ticket->flight?->arrival_time }}
                                </div>
                            </div>

                        </div>

                        {{-- PASSENGER INFO --}}
                        <div class="ticket-section">
                            <div class="section-title">Thông tin hành khách</div>

                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Họ và tên</span>
                                    <div class="detail-value strong">
                                        {{ $ticket->passenger_name }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Ngày sinh</span>
                                    <div class="detail-value">
                                        {{ optional($ticket->date_of_birth)->format('d/m/Y') ?: '-' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Giới tính</span>
                                    <div class="detail-value">
                                        {{ $ticket->gender ?: '-' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">CCCD / Hộ chiếu</span>
                                    <div class="detail-value">
                                        {{ $ticket->identity_number ?: '-' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Số điện thoại</span>
                                    <div class="detail-value">
                                        {{ $ticket->phone ?: '-' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Email hành khách</span>
                                    <div class="detail-value">
                                        {{ $ticket->email ?: '-' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Mã chuyến bay</span>
                                    <div class="detail-value">
                                        {{ $ticket->flight?->flight_code ?: '-' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Máy bay</span>
                                    <div class="detail-value">
                                        {{ $ticket->flight?->aircraft?->name ?? $ticket->flight?->aircraft?->code ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SEAT + PRICE --}}
                        <div class="ticket-section">
                            <div class="section-title">Ghế và giá vé</div>

                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Ghế</span>
                                    <div class="detail-value strong">
                                        {{ $ticket->flightSeat?->seat_number ?? '-' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Hạng ghế</span>
                                    <div class="detail-value">
                                        {{ $ticket->seat_class === 'vip' ? 'VIP' : 'Phổ thông' }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Giá vé</span>
                                    <div class="detail-value price-value">
                                        {{ number_format((float) $ticket->price, 0, ',', '.') }} đ
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Tổng vé + hành lý</span>
                                    <div class="detail-value price-value">
                                        {{ number_format((float) $ticket->price + (float) $ticket->baggage_price, 0, ',', '.') }} đ
                                    </div>
                                </div>
                            </div>

                            <div class="ticket-summary-box">
                                <div class="summary-row">
                                    <span>Hành lý ký gửi</span>
                                    <strong>
                                        {{ (int) $ticket->baggage_weight > 0 ? ((int) $ticket->baggage_weight . ' kg') : 'Không mua thêm' }}
                                    </strong>
                                </div>

                                <div class="summary-row">
                                    <span>Phí hành lý</span>
                                    <strong>
                                        {{ number_format((float) $ticket->baggage_price, 0, ',', '.') }} đ
                                    </strong>
                                </div>

                                <div class="summary-row total">
                                    <span>Tổng tiền của vé này</span>
                                    <strong>
                                        {{ number_format((float) $ticket->price + (float) $ticket->baggage_price, 0, ',', '.') }} đ
                                    </strong>
                                </div>
                            </div>
                        </div>

                        {{-- REFUND SECTION --}}
                        <div class="ticket-section">
                            <div class="section-title">Tình trạng hủy vé / hoàn tiền</div>

                            @if($ticket->refund_status === 'waiting_confirmation')
                                <div class="refund-box waiting">
                                    <div class="refund-box-header">
                                        <div>
                                            <h4>Yêu cầu hoàn tiền đang chờ admin xử lý</h4>
                                            <p>
                                                Vé này đã được khách hàng xác nhận hủy.
                                                Ghế đã được giải phóng. Admin chỉ cần kiểm tra thông tin và bấm
                                                <strong>Xác nhận đã hoàn tiền</strong> sau khi chuyển khoản xong.
                                            </p>
                                        </div>

                                        <span class="badge badge-warning">Chờ hoàn tiền</span>
                                    </div>

                                    <div class="refund-box-body">
                                        <div class="refund-grid">
                                            <div class="refund-item">
                                                <span>Số tiền hoàn</span>
                                                <strong class="refund-amount">
                                                    {{ number_format((float) ($ticket->refund_amount ?? 0), 0, ',', '.') }} đ
                                                </strong>
                                            </div>

                                            <div class="refund-item">
                                                <span>Ngân hàng</span>
                                                <strong>{{ $ticket->refund_bank_name ?? '-' }}</strong>
                                            </div>

                                            <div class="refund-item">
                                                <span>Số tài khoản</span>
                                                <strong>{{ $ticket->refund_account_number ?? '-' }}</strong>
                                            </div>

                                            <div class="refund-item">
                                                <span>Chủ tài khoản</span>
                                                <strong>{{ $ticket->refund_account_name ?? '-' }}</strong>
                                            </div>
                                        </div>

                                        <div class="refund-note waiting">
                                            Vé này thuộc cùng đơn với các vé khác, nhưng chỉ
                                            <strong>riêng vé {{ $ticket->ticket_code }}</strong>
                                            đang có yêu cầu hoàn tiền.
                                            Những vé còn lại trong cùng đơn nếu chưa hủy thì vẫn giữ nguyên trạng thái bình thường.
                                        </div>

                                        <div class="refund-actions">
                                            <form
                                                action="{{ route('admin.bookings.confirm-refund', [$booking->id, $ticket->id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Bạn xác nhận đã hoàn tiền cho vé {{ $ticket->ticket_code }}?');"
                                            >
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="refund-confirm-btn"
                                                >
                                                    Xác nhận đã hoàn tiền cho vé này
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @elseif($ticket->refund_status === 'refunded')
                                <div class="refund-box refunded">
                                    <div class="refund-box-header">
                                        <div>
                                            <h4>Đã hoàn tiền cho khách hàng</h4>
                                            <p>
                                                Yêu cầu hoàn tiền của vé này đã được xử lý hoàn tất.
                                            </p>
                                        </div>

                                        <span class="badge badge-success">Đã hoàn tiền</span>
                                    </div>

                                    <div class="refund-box-body">
                                        <div class="refund-grid">
                                            <div class="refund-item">
                                                <span>Số tiền hoàn</span>
                                                <strong class="refund-amount">
                                                    {{ number_format((float) ($ticket->refund_amount ?? 0), 0, ',', '.') }} đ
                                                </strong>
                                            </div>

                                            <div class="refund-item">
                                                <span>Ngân hàng</span>
                                                <strong>{{ $ticket->refund_bank_name ?? '-' }}</strong>
                                            </div>

                                            <div class="refund-item">
                                                <span>Số tài khoản</span>
                                                <strong>{{ $ticket->refund_account_number ?? '-' }}</strong>
                                            </div>

                                            <div class="refund-item">
                                                <span>Chủ tài khoản</span>
                                                <strong>{{ $ticket->refund_account_name ?? '-' }}</strong>
                                            </div>
                                        </div>

                                        <div class="refund-note refunded">
                                            Admin đã xác nhận hoàn tiền xong cho vé
                                            <strong>{{ $ticket->ticket_code }}</strong>.
                                            Nếu đơn này có nhiều vé thì chỉ vé này được hoàn tiền,
                                            các vé khác vẫn hiển thị đúng trạng thái riêng của chúng.
                                        </div>
                                    </div>
                                </div>

                            @elseif($ticket->ticket_status === 'cancelled')
                                <div class="refund-box none">
                                    <div class="refund-box-header">
                                        <div>
                                            <h4>Vé đã hủy nhưng chưa có trạng thái hoàn tiền</h4>
                                            <p>
                                                Vé này đã chuyển sang trạng thái hủy.
                                                Nếu đây là trường hợp đặc biệt chưa ghi nhận hoàn tiền thì kiểm tra lại dữ liệu trong CSDL.
                                            </p>
                                        </div>

                                        <span class="badge badge-danger">Đã hủy</span>
                                    </div>

                                    <div class="refund-box-body">
                                        <div class="refund-note none">
                                            Không tìm thấy trạng thái `refund_status`.
                                            Bạn nên kiểm tra lại dữ liệu của vé này nếu muốn theo dõi hoàn tiền rõ ràng.
                                        </div>
                                    </div>
                                </div>

                            @else
                                <div class="refund-box none">
                                    <div class="refund-box-header">
                                        <div>
                                            <h4>Không có yêu cầu hoàn tiền</h4>
                                            <p>
                                                Vé này hiện chưa có thao tác hủy / hoàn tiền.
                                            </p>
                                        </div>

                                        <span class="badge badge-dark">Bình thường</span>
                                    </div>

                                    <div class="refund-box-body">
                                        <div class="refund-note none">
                                            Vé <strong>{{ $ticket->ticket_code }}</strong> vẫn đang hoạt động bình thường
                                            hoặc đã sử dụng, không có yêu cầu hoàn tiền nào gắn với vé này.
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                </section>
            @empty
                <div class="empty-box">
                    Không có vé nào trong đơn đặt vé này.
                </div>
            @endforelse

        </div>
    </main>
</div>

</body>
</html>