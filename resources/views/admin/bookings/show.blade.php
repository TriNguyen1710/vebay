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
            --danger: #dc3545;
            --warning: #b88700;
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

        /* ================================
           LAYOUT
        ================================= */
        .admin-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 245px 1fr;
        }

        /* ================================
           SIDEBAR
        ================================= */
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

        /* ================================
           SIDEBAR BOTTOM
        ================================= */
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

        /* ================================
           MAIN
        ================================= */
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

        /* ================================
           CONTENT
        ================================= */
        .content {
            max-width: 1250px;
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
            background: #f6f8fa;
        }

        /* ================================
           BOOKING SUMMARY
        ================================= */
        .booking-card {
            margin-bottom: 22px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: 0 4px 16px rgba(20, 45, 65, 0.05);
            overflow: hidden;
        }

        .booking-header {
            padding: 22px 24px;
            border-bottom: 1px solid #e8edf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .booking-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-icon {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            color: var(--primary);
        }

        .header-icon svg {
            width: 21px;
            height: 21px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .booking-header h2 {
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 17px;
        }

        .booking-header p {
            color: var(--muted);
            font-size: 9px;
        }

        .booking-code-box {
            min-width: 150px;
            padding: 11px 14px;
            border-radius: 7px;
            background: var(--primary-light);
            text-align: right;
        }

        .booking-code-box span {
            display: block;
            margin-bottom: 3px;
            color: var(--muted);
            font-size: 8px;
        }

        .booking-code-box strong {
            color: var(--primary);
            font-size: 14px;
        }

        /* ================================
           INFO GRID
        ================================= */
        .booking-body {
            padding: 24px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .info-item {
            min-height: 78px;
            padding: 14px 15px;
            border: 1px solid #e5eaee;
            border-radius: 7px;
            background: #fbfcfd;
        }

        .info-label {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .info-value {
            color: #354754;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.5;
        }

        .info-value.primary {
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
        }

        .total-item {
            background: #fffaf0;
            border-color: #ead89e;
        }

        .total-value {
            color: #9b7200;
            font-size: 19px;
            font-weight: 800;
        }

        /* ================================
           BADGES
        ================================= */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            white-space: nowrap;
        }

        .paid {
            background: #edf8f2;
            color: #17643d;
        }

        .unpaid {
            background: #fff8df;
            color: #806300;
        }

        .waiting-payment {
            background: #fff3cd;
            color: #7a5d00;
            border: 1px solid #ead58e;
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 10px;
            line-height: 1.6;
        }

        .alert-success {
            background: #edf8f2;
            border: 1px solid #badfc9;
            border-left: 4px solid var(--success);
            color: #17643d;
        }

        .alert-error {
            background: #fff0f1;
            border: 1px solid #efc0c5;
            border-left: 4px solid var(--danger);
            color: #a52a36;
        }

        .confirm-payment-box {
            margin-top: 16px;
            padding: 16px;
            border: 1px solid #ead58e;
            border-left: 4px solid var(--secondary);
            border-radius: 7px;
            background: #fffaf0;
        }

        .confirm-payment-box h3 {
            margin-bottom: 6px;
            color: var(--primary-dark);
            font-size: 13px;
        }

        .confirm-payment-box p {
            margin-bottom: 12px;
            color: #6b6250;
            font-size: 10px;
            line-height: 1.6;
        }

        .confirm-payment-btn {
            min-height: 39px;
            padding: 0 15px;
            border: none;
            border-radius: 6px;
            background: var(--success);
            color: white;
            cursor: pointer;
            font-size: 10px;
            font-weight: 800;
        }

        .confirm-payment-btn:hover {
            background: #157347;
        }

        .refund-admin-box {
            margin: 0 24px 24px;
            padding: 16px;
            border: 1px solid #ead58e;
            border-left: 4px solid var(--secondary);
            border-radius: 7px;
            background: #fffaf0;
            color: #655b43;
            font-size: 10px;
            line-height: 1.7;
        }

        .refund-admin-box h3 {
            margin-bottom: 7px;
            color: var(--primary-dark);
            font-size: 13px;
        }

        .refund-confirm-btn {
            margin-top: 12px;
            min-height: 38px;
            padding: 0 15px;
            border: none;
            border-radius: 6px;
            background: var(--success);
            color: white;
            cursor: pointer;
            font-size: 10px;
            font-weight: 800;
        }

        .refund-confirm-btn:hover {
            background: #157347;
        }

        .confirmed {
            background: #edf5fb;
            color: var(--primary);
        }

        .pending {
            background: #fff8df;
            color: #806300;
        }

        .cancelled {
            background: #fff0f1;
            color: #b02a37;
        }

        .active {
            background: #edf8f2;
            color: #17643d;
        }

        .used {
            background: #f1f3f5;
            color: #66717a;
        }

        .vip {
            background: #fff7dc;
            color: #8b6800;
            border: 1px solid #ead68b;
        }

        .economy {
            background: var(--primary-light);
            color: var(--primary);
        }

        /* ================================
           TICKET
        ================================= */
        .tickets-title {
            margin: 30px 0 14px;
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
            font-size: 17px;
        }

        .tickets-title span {
            color: var(--muted);
            font-size: 9px;
        }

        .ticket-card {
            margin-bottom: 20px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: 0 4px 16px rgba(20, 45, 65, 0.05);
            overflow: hidden;
        }

        .ticket-header {
            min-height: 82px;
            padding: 18px 22px;
            background: var(--primary-dark);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .ticket-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .ticket-icon {
            width: 40px;
            height: 40px;
            border-radius: 7px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
        }

        .ticket-icon svg {
            width: 21px;
            height: 21px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
        }

        .ticket-header h3 {
            margin-bottom: 5px;
            font-size: 15px;
        }

        .ticket-header p {
            color: #aac0d0;
            font-size: 9px;
        }

        .ticket-status-wrap {
            text-align: right;
        }

        .ticket-status-wrap span:first-child {
            display: block;
            margin-bottom: 5px;
            color: #94adc0;
            font-size: 8px;
        }

        /* ================================
           FLIGHT ROUTE
        ================================= */
        .flight-summary {
            padding: 22px 24px;
            border-bottom: 1px solid #e8edf1;
            background: #fbfcfd;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 25px;
        }

        .airport-block:last-child {
            text-align: right;
        }

        .airport-city {
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 18px;
            font-weight: 800;
        }

        .airport-label {
            color: var(--muted);
            font-size: 9px;
        }

        .route-center {
            min-width: 190px;
            text-align: center;
        }

        .flight-code {
            margin-bottom: 9px;
            color: var(--primary-dark);
            font-size: 11px;
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

        /* ================================
           TICKET BODY
        ================================= */
        .ticket-body {
            padding: 24px;
        }

        .ticket-section {
            margin-bottom: 24px;
        }

        .ticket-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            margin-bottom: 13px;
            padding-bottom: 9px;
            border-bottom: 1px solid #edf0f2;
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .detail-item {
            min-height: 65px;
            padding: 12px 13px;
            border-radius: 6px;
            background: #f8fafb;
            border: 1px solid #edf0f2;
        }

        .detail-label {
            display: block;
            margin-bottom: 6px;
            color: #8a969f;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .detail-value {
            color: #394c59;
            font-size: 10px;
            font-weight: 600;
            line-height: 1.5;
        }

        .detail-value.strong {
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
        }

        .price-value {
            color: #a47700;
            font-size: 15px;
            font-weight: 800;
        }

        .baggage-summary {
            margin-top: 14px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .baggage-box {
            padding: 15px;
            border: 1px solid #dce5eb;
            border-radius: 7px;
            background: #fffaf0;
        }

        .baggage-box span {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 8px;
            font-weight: bold;
        }

        .baggage-box strong {
            color: var(--primary-dark);
            font-size: 12px;
        }

        .baggage-box .baggage-price {
            color: #a47700;
            font-size: 14px;
            font-weight: 800;
        }

        .booking-cost-summary {
            margin-top: 16px;
            padding: 16px;
            border: 1px solid #ead89e;
            border-left: 4px solid var(--secondary);
            border-radius: 7px;
            background: #fffaf0;
        }

        .booking-cost-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 7px 0;
            border-bottom: 1px solid #efe3bc;
        }

        .booking-cost-row:last-child {
            border-bottom: none;
        }

        .booking-cost-row span {
            color: #6c6250;
            font-size: 10px;
            font-weight: 700;
        }

        .booking-cost-row strong {
            color: #354754;
            font-size: 11px;
        }

        .booking-cost-row.total strong {
            color: #9b7200;
            font-size: 16px;
        }

        /* ================================
           SEAT SUMMARY
        ================================= */
        .seat-summary {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
        }

        .seat-box {
            padding: 16px;
            border: 1px solid #dce5eb;
            border-radius: 7px;
            background: var(--primary-light);
        }

        .seat-box span {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 8px;
            font-weight: bold;
        }

        .seat-box strong {
            color: var(--primary);
            font-size: 16px;
        }

        /* ================================
           BOTTOM
        ================================= */
        .bottom-back {
            margin-top: 24px;
        }

        .bottom-back a {
            color: var(--primary);
            font-size: 11px;
            font-weight: bold;
        }

        .bottom-back a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 28px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            color: #919ca4;
            font-size: 9px;
        }

        /* ================================
           RESPONSIVE
        ================================= */
        @media (max-width: 1000px) {
            .info-grid,
            .detail-grid,
            .baggage-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .admin-layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .menu {
                grid-template-columns: repeat(2, 1fr);
            }

            .main {
                margin-left: 0;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px 15px 35px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .booking-header,
            .ticket-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .booking-code-box,
            .ticket-status-wrap {
                width: 100%;
                text-align: left;
            }

            .info-grid,
            .detail-grid,
            .seat-summary,
            .baggage-summary {
                grid-template-columns: 1fr;
            }

            .flight-summary {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .airport-block,
            .airport-block:last-child {
                text-align: center;
            }

            .route-center {
                min-width: 0;
            }

            .menu {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
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
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        />
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
                        <path d="M4 7h10" />
                        <path d="M18 7h2" />
                        <circle cx="16" cy="7" r="2" />
                        <path d="M4 12h2" />
                        <path d="M10 12h10" />
                        <circle cx="8" cy="12" r="2" />
                        <path d="M4 17h7" />
                        <path d="M15 17h5" />
                        <circle cx="13" cy="17" r="2" />
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
                <strong>
                    {{ auth()->user()->name }}
                </strong>
                <span>
                    Quản trị viên hệ thống
                </span>
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
                <h2>
                    Vietjet Administration
                </h2>
                <p>
                    Chi tiết đơn đặt vé
                </p>
            </div>

            <span class="admin-badge">
                ADMIN
            </span>

        </header>

        <div class="content">

            {{-- PAGE HEADING --}}
            <div class="page-heading">

                <div>
                    <h1>
                        Chi tiết vé
                    </h1>
                    <p>
                        Xem thông tin đơn đặt vé,
                        hành khách và từng chặng bay.
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
            <section class="booking-card">

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
                            <h2>
                                Thông tin đơn đặt vé
                            </h2>
                            <p>
                                Thông tin người đặt và
                                trạng thái của đơn.
                            </p>
                        </div>

                    </div>

                    <div class="booking-code-box">
                        <span>
                            MÃ ĐẶT VÉ
                        </span>
                        <strong>
                            {{ $booking->booking_code }}
                        </strong>
                    </div>

                </div>

                <div class="booking-body">

                    <div class="info-grid">

                        {{-- NGƯỜI ĐẶT --}}
                        <div class="info-item">
                            <span class="info-label">
                                Người đặt
                            </span>
                            <div class="info-value primary">
                                {{ $booking->user->name ?? 'Không xác định' }}
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="info-item">
                            <span class="info-label">
                                Email tài khoản
                            </span>
                            <div class="info-value">
                                {{ $booking->user->email ?? '-' }}
                            </div>
                        </div>

                        {{-- NGÀY ĐẶT --}}
                        <div class="info-item">
                            <span class="info-label">
                                Ngày đặt
                            </span>
                            <div class="info-value">
                                {{ $booking->created_at
                                    ->timezone('Asia/Ho_Chi_Minh')
                                    ->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        {{-- BOOKING STATUS --}}
                        <div class="info-item">
                            <span class="info-label">
                                Trạng thái đặt vé
                            </span>

                            <div class="info-value">

                                @if($booking->booking_status === 'confirmed')

                                    <span class="badge confirmed">
                                        Đã xác nhận
                                    </span>

                                @elseif($booking->booking_status === 'cancelled')

                                    <span class="badge cancelled">
                                        Đã hủy
                                    </span>

                                @else

                                    <span class="badge pending">
                                        Chờ xác nhận
                                    </span>

                                @endif

                            </div>
                        </div>

                        {{-- PAYMENT --}}
                        <div class="info-item">
                            <span class="info-label">
                                Trạng thái thanh toán
                            </span>

                            <div class="info-value">

                                @if($booking->payment_status === 'paid')

                                    <span class="badge paid">
                                        Đã thanh toán
                                    </span>

                                @elseif($booking->payment_status === 'waiting_confirmation')

                                    <span class="badge waiting-payment">
                                        Chờ Admin xác nhận
                                    </span>

                                @else

                                    <span class="badge unpaid">
                                        Chưa thanh toán
                                    </span>

                                @endif

                            </div>
                        </div>

                        {{-- TOTAL --}}
                        <div class="info-item total-item">
                            <span class="info-label">
                                Tổng thanh toán
                            </span>

                            <div class="total-value">
                                {{ number_format(
                                    $booking->total_amount,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ
                            </div>
                        </div>

                    </div>

                    @php
                        $adminTicketTotal =
                            (float) $booking->tickets->sum('price');

                        $adminBaggageTotal =
                            (float) $booking->tickets->sum('baggage_price');
                    @endphp

                    <div class="booking-cost-summary">

                        <div class="booking-cost-row">
                            <span>
                                Tổng giá vé
                            </span>
                            <strong>
                                {{ number_format(
                                    $adminTicketTotal,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ
                            </strong>
                        </div>

                        <div class="booking-cost-row">
                            <span>
                                Tổng phí hành lý
                            </span>
                            <strong>
                                {{ number_format(
                                    $adminBaggageTotal,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ
                            </strong>
                        </div>

                        <div class="booking-cost-row total">
                            <span>
                                Tổng đơn
                            </span>
                            <strong>
                                {{ number_format(
                                    $booking->total_amount,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ
                            </strong>
                        </div>

                    </div>

                </div>

                @if(
                    $booking->payment_status === 'paid'
                    && $booking->booking_status === 'pending'
                    && $booking->tickets->contains('ticket_status', 'pending')
                )

                    <div class="booking-body" style="padding-top:0;">

                        <div class="confirm-payment-box">

                            <h3>
                                Vé đang chờ xác nhận
                            </h3>

                            <p>
                                Khách hàng đã thanh toán đơn
                                <strong>{{ $booking->booking_code }}</strong>
                                với số tiền
                                <strong>{{ number_format($booking->total_amount, 0, ',', '.') }} đ</strong>.
                                Bấm Xác nhận để kích hoạt vé.
                            </p>

                            <form
                                action="{{ route(
                                    'admin.bookings.confirm-payment',
                                    $booking->id
                                ) }}"
                                method="POST"
                                onsubmit="return confirm(
                                    'Bạn xác nhận kích hoạt vé của đơn này?'
                                );"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="confirm-payment-btn"
                                >
                                    Xác nhận
                                </button>

                            </form>

                        </div>

                    </div>

                @endif

            </section>

            {{-- TICKET TITLE --}}
            <div class="tickets-title">

                <div class="tickets-title-line"></div>

                <div>
                    <h2>
                        Danh sách vé trong đơn
                    </h2>

                    <span>
                        {{ $booking->tickets->count() }}
                        vé / chặng bay
                    </span>
                </div>

            </div>

            {{-- TICKETS --}}
            @foreach($booking->tickets as $ticket)

                <section class="ticket-card">

                    {{-- HEADER --}}
                    <div class="ticket-header">

                        <div class="ticket-title-wrap">

                            <div class="ticket-icon">

                                <svg viewBox="0 0 24 24">
                                    <path d="M4 5h16v14H4z"/>
                                    <path d="M8 9h8"/>
                                    <path d="M8 13h5"/>
                                </svg>

                            </div>

                            <div>
                                <h3>
                                    Vé {{ $ticket->ticket_code }}
                                </h3>
                                <p>
                                    {{ $ticket->passenger_name }}
                                </p>
                            </div>

                        </div>

                        <div class="ticket-status-wrap">

                            <span>
                                TRẠNG THÁI VÉ
                            </span>

                            @if($ticket->ticket_status === 'active')

                                <span class="badge active">
                                    Có hiệu lực
                                </span>

                            @elseif($ticket->ticket_status === 'used')

                                <span class="badge used">
                                    Đã sử dụng
                                </span>

                            @elseif($ticket->ticket_status === 'cancelled')

                                <span class="badge cancelled">
                                    Đã hủy
                                </span>

                            @else

                                <span class="badge pending">
                                    Chờ xác nhận
                                </span>

                            @endif

                        </div>

                    </div>

                    {{-- ROUTE --}}
                    <div class="flight-summary">

                        <div class="airport-block">

                            <div class="airport-city">
                                {{ $ticket->flight->departureAirport->city }}
                            </div>

                            <div class="airport-label">
                                Điểm khởi hành
                            </div>

                        </div>

                        <div class="route-center">

                            <div class="flight-code">
                                {{ $ticket->flight->flight_code }}
                            </div>

                            <div class="route-line">

                                <span class="line"></span>

                                <span class="plane-svg">

                                    <svg viewBox="0 0 24 24">
                                        <path d="M2 16l20-5-20-5 3 5-3 5z"/>
                                    </svg>

                                </span>

                                <span class="line"></span>

                            </div>

                        </div>

                        <div class="airport-block">

                            <div class="airport-city">
                                {{ $ticket->flight->arrivalAirport->city }}
                            </div>

                            <div class="airport-label">
                                Điểm đến
                            </div>

                        </div>

                    </div>

                    <div class="ticket-body">

                        {{-- PASSENGER --}}
                        <div class="ticket-section">

                            <div class="section-title">
                                Thông tin hành khách
                            </div>

                            <div class="detail-grid">

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Họ và tên
                                    </span>
                                    <div class="detail-value strong">
                                        {{ $ticket->passenger_name }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Ngày sinh
                                    </span>
                                    <div class="detail-value">
                                        {{ $ticket->date_of_birth->format('d/m/Y') }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Giới tính
                                    </span>
                                    <div class="detail-value">

                                        @if($ticket->gender === 'nam')
                                            Nam
                                        @elseif($ticket->gender === 'nu')
                                            Nữ
                                        @else
                                            Khác
                                        @endif

                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        CCCD / Hộ chiếu
                                    </span>
                                    <div class="detail-value">
                                        {{ $ticket->identity_number }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Số điện thoại
                                    </span>
                                    <div class="detail-value">
                                        {{ $ticket->phone }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Email hành khách
                                    </span>
                                    <div class="detail-value">
                                        {{ $ticket->email }}
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- FLIGHT --}}
                        <div class="ticket-section">

                            <div class="section-title">
                                Thông tin chuyến bay
                            </div>

                            <div class="detail-grid">

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Mã chuyến bay
                                    </span>
                                    <div class="detail-value strong">
                                        {{ $ticket->flight->flight_code }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Ngày bay
                                    </span>
                                    <div class="detail-value">
                                        {{ $ticket->flight->flight_date->format('d/m/Y') }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Máy bay
                                    </span>
                                    <div class="detail-value">
                                        {{ $ticket->flight->aircraft->name }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Giờ khởi hành
                                    </span>

                                    <div class="detail-value strong">
                                        {{ substr(
                                            $ticket->flight->departure_time,
                                            0,
                                            5
                                        ) }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Giờ đến
                                    </span>

                                    <div class="detail-value strong">
                                        {{ substr(
                                            $ticket->flight->arrival_time,
                                            0,
                                            5
                                        ) }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Hành trình
                                    </span>

                                    <div class="detail-value">
                                        {{ $ticket->flight->departureAirport->city }}
                                        →
                                        {{ $ticket->flight->arrivalAirport->city }}
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- SEAT --}}
                        <div class="ticket-section">

                            <div class="section-title">
                                Ghế và giá vé
                            </div>

                            <div class="seat-summary">

                                <div class="seat-box">
                                    <span>
                                        GHẾ
                                    </span>
                                    <strong>
                                        {{ $ticket->flightSeat->seat_number }}
                                    </strong>
                                </div>

                                <div class="seat-box">
                                    <span>
                                        HẠNG GHẾ
                                    </span>

                                    @if($ticket->seat_class === 'vip')
                                        <strong>
                                            VIP
                                        </strong>
                                    @else
                                        <strong>
                                            Phổ thông
                                        </strong>
                                    @endif
                                </div>

                                <div class="seat-box">
                                    <span>
                                        GIÁ VÉ
                                    </span>

                                    <div class="price-value">
                                        {{ number_format(
                                            $ticket->price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ
                                    </div>
                                </div>

                            </div>

                            <div class="baggage-summary">

                                <div class="baggage-box">
                                    <span>
                                        HÀNH LÝ KÝ GỬI
                                    </span>

                                    <strong>
                                        @if((int) $ticket->baggage_weight > 0)
                                            {{ (int) $ticket->baggage_weight }} kg
                                        @else
                                            Không mua thêm
                                        @endif
                                    </strong>
                                </div>

                                <div class="baggage-box">
                                    <span>
                                        PHÍ HÀNH LÝ
                                    </span>

                                    <div class="baggage-price">
                                        {{ number_format(
                                            (float) $ticket->baggage_price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ
                                    </div>
                                </div>

                                <div class="baggage-box">
                                    <span>
                                        TỔNG VÉ + HÀNH LÝ
                                    </span>

                                    <div class="baggage-price">
                                        {{ number_format(
                                            (float) $ticket->price
                                            + (float) $ticket->baggage_price,
                                            0,
                                            ',',
                                            '.'
                                        ) }} đ
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    @if($ticket->refund_status)

                        <div class="refund-admin-box">

                            <h3>
                                Yêu cầu hoàn tiền do hủy vé
                            </h3>

                            Số tiền hoàn:
                            <strong>
                                {{ number_format(
                                    $ticket->refund_amount ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }} đ
                            </strong>
                            (60% giá vé)

                            <br>

                            Ngân hàng:
                            <strong>
                                {{ $ticket->refund_bank_name ?? '-' }}
                            </strong>

                            <br>

                            Số tài khoản:
                            <strong>
                                {{ $ticket->refund_account_number ?? '-' }}
                            </strong>

                            <br>

                            Chủ tài khoản:
                            <strong>
                                {{ $ticket->refund_account_name ?? '-' }}
                            </strong>

                            <br>

                            Trạng thái:
                            <strong>
                                {{ $ticket->refund_status === 'refunded'
                                    ? 'Đã hoàn tiền'
                                    : 'Chờ hoàn tiền' }}
                            </strong>

                            @if($ticket->refund_status === 'waiting_confirmation')

                                <form
                                    action="{{ route(
                                        'admin.bookings.confirm-refund',
                                        [
                                            $booking->id,
                                            $ticket->id
                                        ]
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        'Bạn xác nhận đã xử lý hoàn tiền cho khách hàng?'
                                    );"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="refund-confirm-btn"
                                    >
                                        Xác nhận đã hoàn tiền
                                    </button>

                                </form>

                            @endif

                        </div>

                    @endif

                </section>

            @endforeach

            <div class="bottom-back">
                <a href="{{ route('admin.bookings.index') }}">
                    ← Quay lại danh sách vé
                </a>
            </div>

            <footer class="footer">

                <span>
                    Vietjet Administration
                </span>

                <span>
                    Chi tiết đơn
                    {{ $booking->booking_code }}
                </span>

            </footer>

        </div>

    </main>

</div>
</body>
</html>