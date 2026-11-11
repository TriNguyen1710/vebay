
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietjet - Đặt vé máy bay</title>

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
            --danger: #e2231a;
            --light: #f5f7fa;
            --white: #fff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: white;
            color: var(--text);
            line-height: 1.5;
            overflow-x: hidden;
        }

        a { text-decoration: none; }
        button, input, select { font-family: inherit; }
        button { cursor: pointer; }

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

        .top-left, .top-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a { color: white; }

        .notification-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .notification-badge {
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            background: var(--danger);
            color: white;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
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
            gap: 25px;
        }

        .logo {
            font-size: 27px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -1px;
            white-space: nowrap;
        }

        .logo span { color: var(--secondary); }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-link {
            color: #293241;
            padding: 27px 13px;
            font-size: 14px;
            font-weight: 600;
            border-bottom: 3px solid transparent;
        }

        .nav-link:hover {
            color: var(--primary);
            border-bottom-color: var(--secondary);
        }

        .nav-actions, .user-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-name {
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
        }

        .btn-login, .btn-register {
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-login {
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-register {
            background: var(--primary);
            color: white;
        }

        .logout-btn {
            padding: 9px 13px;
            border: none;
            border-radius: 7px;
            background: var(--danger);
            color: white;
            font-weight: bold;
        }

        /* THÔNG BÁO */

        .home-notification {
            max-width: 1240px;
            margin: 18px auto 0;
            padding: 0 20px;
        }

        .home-notification-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 14px 18px;
            background: #fff9e8;
            border: 1px solid #ead58e;
            border-left: 4px solid var(--secondary);
            border-radius: 9px;
        }

        .home-notification-text {
            font-size: 13px;
            color: #604c00;
        }

        .home-notification-button {
            padding: 9px 14px;
            background: var(--primary);
            color: white;
            font-size: 12px;
            font-weight: bold;
            border-radius: 6px;
        }

        /* BANNER */

        .hero {
            min-height: 560px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(
                    90deg,
                    rgba(0,43,82,.74),
                    rgba(0,67,125,.32),
                    rgba(0,59,112,.04)
                ),
                url('/images/hinh1.png');
            background-size: cover;
            background-position: center;
        }

        .hero-container {
            max-width: 1240px;
            width: 100%;
            margin: auto;
            padding: 58px 20px 155px;
        }

        .hero-content {
            max-width: 610px;
            color: white;
        }

        .hero-tag {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 3px;
            margin-bottom: 14px;
        }

        .hero h1 {
            font-size: 50px;
            line-height: 1.08;
            margin-bottom: 18px;
            text-shadow: 0 4px 18px rgba(0,0,0,.18);
        }

        .hero-description {
            max-width: 550px;
            font-size: 18px;
            color: #f5f5f5;
            margin-bottom: 28px;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .hero-btn-primary, .hero-btn-secondary {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 48px;
            padding: 0 22px;
            border-radius: 8px;
            font-weight: bold;
        }

        .hero-btn-primary {
            background: var(--secondary);
            color: #202020;
        }

        .hero-btn-secondary {
            color: white;
            border: 1px solid white;
            background: rgba(255,255,255,.14);
        }

        /* KHUNG TÌM CHUYẾN */

        .booking-wrapper {
            max-width: 1240px;
            margin: -112px auto -1px;
            padding: 0 20px;
            position: relative;
            z-index: 50;
        }

        .booking-wrapper::before {
            content: "";
            position: absolute;
            z-index: -1;
            top: 112px;
            left: 50%;
            width: 100vw;
            height: 190px;
            transform: translateX(-50%);
            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,0),
                    rgba(255,255,255,.12)
                ),
                url('/images/hinh2.png');
            background-size: cover;
            background-position: center top;
        }

        .booking-box {
            background: rgba(255,255,255,.98);
            border: 1px solid rgba(0,59,112,.08);
            border-radius: 16px;
            box-shadow: 0 18px 48px rgba(0,45,83,.18);
        }

        .booking-tabs {
            display: flex;
            border-bottom: 1px solid var(--border);
        }

        .booking-tab {
            padding: 19px 28px;
            background: #fafcff;
            color: var(--primary);
            font-size: 15px;
            font-weight: bold;
            border-bottom: 4px solid var(--secondary);
            border-radius: 16px 0 0 0;
        }

        .booking-body { padding: 26px 28px 28px; }
        .booking-title { margin-bottom: 22px; }

        .booking-title h2 {
            font-size: 23px;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .booking-title p {
            font-size: 13px;
            color: var(--muted);
        }

        /* ============================================
           MỘT CHIỀU: TẤT CẢ NẰM TRÊN MỘT HÀNG
        ============================================ */

        .quick-search {
            display: grid;
            grid-template-columns:
                minmax(0, 1.5fr)
                40px
                minmax(0, 1.5fr)
                minmax(0, 1fr)
                minmax(0, 1.08fr)
                minmax(125px, .98fr)
                minmax(130px, 1.15fr);
            gap: 10px;
            align-items: stretch;
        }

        .quick-search > * { min-width: 0; }

        /* DROPDOWN */

        .quick-dropdown {
            position: relative;
            min-width: 0;
        }

        .quick-trigger {
            width: 100%;
            min-height: 70px;
            padding: 12px 34px 12px 12px;
            border: 1px solid #dce5ee;
            border-radius: 10px;
            background: white;
            text-align: left;
            position: relative;
        }

        .quick-trigger:hover,
        .quick-dropdown.active .quick-trigger {
            border-color: #83b5da;
            box-shadow: 0 0 0 3px rgba(0,59,112,.06);
        }

        .quick-label, .date-label, .passenger-label {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 6px;
        }

        .quick-value {
            display: block;
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-arrow {
            position: absolute;
            right: 13px;
            top: 50%;
            width: 8px;
            height: 8px;
            border-right: 2px solid #64748b;
            border-bottom: 2px solid #64748b;
            transform: translateY(-70%) rotate(45deg);
        }

        .quick-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            width: 100%;
            min-width: 250px;
            max-height: 330px;
            overflow-y: auto;
            padding: 8px;
            border: 1px solid #dbe3ea;
            border-radius: 12px;
            background: white;
            box-shadow: 0 15px 35px rgba(0,0,0,.14);
            z-index: 2000;
        }

        .quick-dropdown.active .quick-menu {
            display: block;
        }

        .dropdown-title {
            padding: 9px 11px;
            color: var(--muted);
            font-size: 11px;
            font-weight: bold;
        }

        .airport-option, .trip-option {
            width: 100%;
            padding: 11px 12px;
            border: 0;
            border-radius: 8px;
            background: white;
            text-align: left;
        }

        .airport-option:hover,
        .airport-option.selected,
        .trip-option:hover,
        .trip-option.selected {
            background: #edf6ff;
        }

        .airport-city {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 3px;
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
        }

        .airport-code {
            color: #b68400;
            font-size: 12px;
            font-weight: 800;
        }

        .airport-name {
            color: var(--muted);
            font-size: 12px;
        }

        .trip-option {
            font-size: 14px;
            font-weight: 600;
        }

        /* NÚT ĐỔI CHIỀU */

        .swap {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swap-button {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d3e2ee;
            border-radius: 50%;
            background: white;
            color: var(--primary);
            transition: .2s;
        }

        .swap-button:hover {
            background: #eaf5ff;
            border-color: var(--primary);
        }

        .swap-button svg {
            width: 20px;
            height: 20px;
        }

        /* NGÀY BAY */

        .date-field {
            min-width: 0;
            min-height: 70px;
            padding: 10px 12px;
            border: 1px solid #dce5ee;
            border-radius: 10px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .date-field:focus-within {
            border-color: #83b5da;
            box-shadow: 0 0 0 3px rgba(0,59,112,.06);
        }

        .date-input {
            width: 100%;
            min-width: 0;
            outline: none;
            border: none;
            background: transparent;
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
        }

        .return-date-field.hidden {
            display: none;
        }

        /* SỐ LƯỢNG KHÁCH */

        .passenger-field {
            min-width: 0;
            min-height: 70px;
            padding: 9px 10px;
            border: 1px solid #dce5ee;
            border-radius: 10px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .passenger-control {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
        }

        .passenger-btn {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d7e3ed;
            border-radius: 7px;
            background: #edf5fb;
            color: var(--primary);
            font-size: 19px;
            font-weight: bold;
            transition: .2s;
        }

        .passenger-btn:hover:not(:disabled) {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .passenger-btn:disabled {
            opacity: .35;
            cursor: not-allowed;
        }

        .passenger-display {
            min-width: 0;
            flex: 1;
            text-align: center;
        }

        .passenger-count {
            display: block;
            color: var(--primary);
            font-size: 19px;
            font-weight: 800;
            line-height: 1.2;
        }

        .passenger-unit {
            display: block;
            color: var(--muted);
            font-size: 10px;
            white-space: nowrap;
        }

        /* NÚT TÌM CHUYẾN */

        .search-button {
            width: 100%;
            min-width: 0;
            min-height: 70px;
            padding: 0 8px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #003b70, #006ac1);
            color: white;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
            transition: .2s;
        }

        .search-button:hover {
            background: linear-gradient(135deg, #00294f, #00549a);
            box-shadow: 0 6px 18px rgba(0,59,112,.2);
        }

        /* ============================================
           KHỨ HỒI: 2 HÀNG CÂN ĐỐI
        ============================================ */

        @media (min-width: 1101px) {

            #quickSearchForm .quick-search.round-trip {
                display: grid;
                grid-template-columns: repeat(12, minmax(0, 1fr));
                gap: 12px;
            }

            /* HÀNG 1 */

            #quickSearchForm .quick-search.round-trip
            > #departureDropdown {
                grid-column: 1 / span 4;
                grid-row: 1;
            }

            #quickSearchForm .quick-search.round-trip
            > .swap {
                grid-column: 5 / span 1;
                grid-row: 1;
            }

            #quickSearchForm .quick-search.round-trip
            > #arrivalDropdown {
                grid-column: 6 / span 4;
                grid-row: 1;
            }

            #quickSearchForm .quick-search.round-trip
            > #tripDropdown {
                grid-column: 10 / span 3;
                grid-row: 1;
            }

            /* HÀNG 2 */

            #quickSearchForm .quick-search.round-trip
            > .departure-date-field {
                grid-column: 1 / span 3;
                grid-row: 2;
            }

            #quickSearchForm .quick-search.round-trip
            > #quickReturnField {
                grid-column: 4 / span 3;
                grid-row: 2;
            }

            #quickSearchForm .quick-search.round-trip
            > .passenger-field {
                grid-column: 7 / span 3;
                grid-row: 2;
            }

            #quickSearchForm .quick-search.round-trip
            > .search-button {
                grid-column: 10 / span 3;
                grid-row: 2;
            }
        }

        /* =====================================
           CÁC PHẦN TRANG CHỦ
        ===================================== */

        .section {
            padding: 75px 20px;
        }

        .section.gray {
            background: var(--light);
        }

        .section-container {
            max-width: 1240px;
            margin: auto;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 42px;
        }

        .section-small-title {
            margin-bottom: 7px;
            color: var(--danger);
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .section-heading h2 {
            color: var(--primary);
            font-size: 33px;
            margin-bottom: 10px;
        }

        .section-heading p {
            max-width: 650px;
            margin: auto;
            color: var(--muted);
            font-size: 14px;
        }

        /* KHÁM PHÁ */

        .destination-section {
            position: relative;
            overflow: hidden;
            padding-top: 170px;
            padding-bottom: 100px;
            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,0),
                    rgba(255,255,255,.18) 16%,
                    rgba(255,255,255,.52) 38%,
                    rgba(255,255,255,.78) 65%,
                    rgba(242,249,255,.88) 100%
                ),
                url('/images/hinh2.png');
            background-size: cover;
            background-position: center top;
        }

        .booking-wrapper + .destination-section {
            margin-top: -170px;
            padding-top: 255px;
        }

        .destination-section .section-container {
            position: relative;
            z-index: 2;
        }

        .destination-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .destination {
            min-height: 245px;
            position: relative;
            overflow: hidden;
            border-radius: 14px;
            background-size: cover;
            background-position: center;
            box-shadow: 0 12px 30px rgba(0,45,83,.17);
            transition: .25s;
        }

        .destination:hover {
            transform: translateY(-5px);
        }

        .destination::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.76), transparent);
        }

        .destination-content {
            position: absolute;
            z-index: 2;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 22px;
            color: white;
        }

        .destination-content h3 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .destination-content p {
            color: #eee;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .destination-link {
            display: inline-flex;
            align-items: center;
            min-height: 36px;
            padding: 0 15px;
            color: white;
            background: rgba(0,35,68,.28);
            border: 1px solid white;
            border-radius: 22px;
            font-size: 13px;
            font-weight: bold;
        }

        .destination-link:hover {
            background: var(--secondary);
            color: #202020;
        }

        .danang {
            background-image: url('https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=1000&q=80');
        }

        .hanoi {
            background-image: url('https://images.unsplash.com/photo-1509030450996-dd1a26dda07a?auto=format&fit=crop&w=1000&q=80');
        }

        .hochiminh {
            background-image: url('https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=1000&q=80');
        }

        /* TIỆN ÍCH */

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .service-card {
            padding: 28px 22px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .service-number {
            width: 48px;
            height: 48px;
            margin-bottom: 20px;
            border-radius: 12px;
            background: #edf6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
        }

        .service-card h3 {
            margin-bottom: 9px;
            color: var(--primary);
            font-size: 18px;
        }

        .service-card p {
            color: var(--muted);
            font-size: 14px;
        }

        /* NHẬN DIỆN KHUÔN MẶT */

        .face-section {
            max-width: 1240px;
            margin: auto;
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            border-radius: 22px;
            overflow: hidden;
            background: linear-gradient(120deg, #00294f, #005c9f);
        }

        .face-content {
            padding: 60px;
            color: white;
        }

        .face-badge {
            display: inline-block;
            padding: 7px 13px;
            margin-bottom: 17px;
            border-radius: 30px;
            background: var(--secondary);
            color: #202020;
            font-size: 12px;
            font-weight: bold;
        }

        .face-content h2 {
            font-size: 34px;
            margin-bottom: 16px;
        }

        .face-content p {
            color: #e0ecf5;
            margin-bottom: 25px;
        }

        .face-features {
            display: grid;
            gap: 12px;
        }

        .face-feature {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .face-check {
            width: 25px;
            height: 25px;
            flex-shrink: 0;
            border-radius: 50%;
            background: rgba(255,255,255,.17);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .face-visual {
            min-height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scan-box {
            width: 220px;
            height: 270px;
            border: 3px solid rgba(255,255,255,.8);
            border-radius: 80px 80px 55px 55px;
            position: relative;
        }

        .scan-line {
            position: absolute;
            top: 50%;
            left: 5%;
            width: 90%;
            border-top: 3px solid var(--secondary);
            box-shadow: 0 0 15px var(--secondary);
        }

        .scan-corner {
            position: absolute;
            width: 45px;
            height: 45px;
        }

        .corner-1 {
            left: -18px;
            top: -18px;
            border-left: 5px solid var(--secondary);
            border-top: 5px solid var(--secondary);
        }

        .corner-2 {
            right: -18px;
            top: -18px;
            border-right: 5px solid var(--secondary);
            border-top: 5px solid var(--secondary);
        }

        .corner-3 {
            left: -18px;
            bottom: -18px;
            border-left: 5px solid var(--secondary);
            border-bottom: 5px solid var(--secondary);
        }

        .corner-4 {
            right: -18px;
            bottom: -18px;
            border-right: 5px solid var(--secondary);
            border-bottom: 5px solid var(--secondary);
        }

        /* QUY TRÌNH */

        .steps {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .step {
            position: relative;
            text-align: center;
        }

        .step-number {
            position: relative;
            z-index: 2;
            width: 52px;
            height: 52px;
            margin: auto;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
        }

        .step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 25px;
            left: 60%;
            width: 80%;
            height: 2px;
            background: #d4dbe3;
        }

        .step h3 {
            margin-top: 14px;
            color: var(--primary);
            font-size: 15px;
        }

        .step p {
            margin-top: 5px;
            color: var(--muted);
            font-size: 13px;
        }

        /* BANNER DƯỚI */

        .lower-banner {
            min-height: 250px;
            background:
                linear-gradient(
                    90deg,
                    rgba(0,43,82,.95),
                    rgba(0,84,150,.74)
                ),
                url('/images/hinh2.png');
            background-size: cover;
            background-position: center;
        }

        .lower-banner-inner {
            max-width: 1240px;
            min-height: 250px;
            margin: auto;
            padding: 44px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 44px;
        }

        .lower-banner-copy {
            max-width: 660px;
            color: white;
        }

        .lower-banner-label {
            color: #ffd24f;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .lower-banner-copy h2 {
            font-size: 31px;
            margin: 8px 0;
        }

        .lower-banner-copy p {
            color: #e6f1fa;
        }

        .lower-banner-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 155px;
            min-height: 48px;
            padding: 0 20px;
            border-radius: 9px;
            background: var(--secondary);
            color: #202020;
            font-weight: 800;
        }

        /* LIÊN HỆ */

        .contact-section {
            background: var(--primary-dark);
            color: white;
        }

        .contact-container {
            max-width: 1240px;
            margin: auto;
        }

        .contact-heading {
            margin-bottom: 30px;
        }

        .contact-heading h2 {
            margin-bottom: 10px;
            font-size: 31px;
        }

        .contact-heading p { color: #c8d6e1; }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .contact-card {
            padding: 24px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 12px;
            background: rgba(255,255,255,.06);
        }

        .contact-card h3 {
            margin-bottom: 10px;
            color: var(--secondary);
            font-size: 16px;
        }

        .contact-card p {
            color: #d6e0e8;
            font-size: 14px;
            line-height: 1.8;
        }

        /* FOOTER */

        footer {
            background: #031d33;
            color: white;
            padding-top: 55px;
        }

        .footer-container {
            max-width: 1240px;
            margin: auto;
            padding: 0 20px 40px;
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 50px;
        }

        .footer-logo {
            margin-bottom: 15px;
            color: white;
            font-size: 26px;
            font-weight: 800;
        }

        .footer-logo span { color: var(--secondary); }

        .footer-description {
            max-width: 420px;
            color: #b8c6d3;
            font-size: 14px;
        }

        .footer-title {
            margin-bottom: 16px;
            font-size: 16px;
            font-weight: bold;
        }

        .footer-links {
            display: grid;
            gap: 10px;
        }

        .footer-links a {
            color: #b8c6d3;
            font-size: 14px;
        }

        .copyright {
            border-top: 1px solid rgba(255,255,255,.1);
            padding: 18px 20px;
            text-align: center;
            color: #9bacbb;
            font-size: 13px;
        }

        /* TABLET */

        @media (min-width: 801px) and (max-width: 1100px) {

            .quick-search, .quick-search.round-trip {
                grid-template-columns: repeat(12, minmax(0,1fr));
            }

            .quick-search > #departureDropdown,
            .quick-search > #arrivalDropdown {
                grid-column: span 5;
            }

            .quick-search > .swap {
                grid-column: span 2;
            }

            .quick-search > #tripDropdown,
            .quick-search > .departure-date-field,
            .quick-search > .passenger-field,
            .quick-search > .search-button {
                grid-column: span 4;
            }

            .quick-search.round-trip > #quickReturnField {
                grid-column: span 4;
            }

            .quick-search.round-trip > .search-button {
                grid-column: span 8;
            }

            .nav-menu { display: none; }
            .service-grid { grid-template-columns: repeat(2,1fr); }
        }

        /* MOBILE */

        @media (max-width: 800px) {

            .top-bar { display: none; }
            .nav-menu { display: none; }
            .navbar { min-height: 65px; }
            .hero h1 { font-size: 38px; }

            .quick-search,
            .quick-search.round-trip {
                display: grid;
                grid-template-columns: 1fr;
            }

            .quick-search > *,
            .quick-search.round-trip > * {
                grid-column: 1 / -1 !important;
                grid-row: auto !important;
            }

            .quick-search > .swap {
                min-height: 36px;
                transform: rotate(90deg);
            }

            .quick-menu { min-width: 100%; }

            .destination-grid,
            .face-section,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .step:not(:last-child)::after { display: none; }
            .footer-container { grid-template-columns: 1fr; }

            .home-notification-box,
            .lower-banner-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .face-content { padding: 35px 25px; }

            .booking-wrapper + .destination-section {
                margin-top: -90px;
                padding-top: 175px;
            }
        }

        @media (max-width: 520px) {

            .hero { min-height: 520px; }
            .hero h1 { font-size: 31px; }
            .hero-description { font-size: 15px; }
            .booking-wrapper { padding: 0 12px; }
            .booking-body { padding: 20px 16px; }
            .booking-title h2 { font-size: 21px; }
            .section-heading h2 { font-size: 27px; }
            .service-grid { grid-template-columns: 1fr; }
            .user-name { display: none; }
            .search-button { min-height: 56px; }
        }
    </style>
</head>

<body>

@php
    $quickAirports = \App\Models\Airport::where('status', 1)
        ->orderBy('city')
        ->get();

    $unreadNotificationCount = 0;

    if (auth()->check()) {
        $unreadNotificationCount = \App\Models\Notification::where(
            'user_id', auth()->id()
        )->where('status', 'unread')->count();
    }
@endphp

{{-- TOP BAR --}}

<div class="top-bar">
    <div class="top-bar-inner">
        <div class="top-left"></div>
        <div class="top-right">
            @auth
                <a href="{{ route('profile.edit') }}">
                    Thông tin cá nhân
                </a>
                <a href="{{ route('notifications.index') }}"
                   class="notification-link">
                    Thông báo
                    @if($unreadNotificationCount > 0)
                        <span class="notification-badge">
                            {{ $unreadNotificationCount }}
                        </span>
                    @endif
                </a>
            @endauth
        </div>
    </div>
</div>

{{-- NAVBAR --}}

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
            @auth
                <a href="{{ route('tickets.mine') }}" class="nav-link">
                    Lịch sử vé
                </a>
                <a href="{{ route('notifications.index') }}"
                   class="nav-link">
                    Thông báo
                </a>
            @endauth
            <a href="{{ route('contact') }}" class="nav-link">
                Liên hệ
            </a>
        </div>

        <div class="nav-actions">
            @guest
                <a href="{{ route('dang-nhap') }}" class="btn-login">
                    Đăng nhập
                </a>
                <a href="{{ route('dang-ky') }}" class="btn-register">
                    Đăng ký
                </a>
            @else
                <div class="user-area">
                    <span class="user-name">
                        {{ auth()->user()->name }}
                    </span>
                    <form action="{{ route('dang-xuat') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            @endguest
        </div>

    </nav>
</header>

{{-- THÔNG BÁO MỚI --}}

@auth
    @if($unreadNotificationCount > 0)
        <div class="home-notification">
            <div class="home-notification-box">
                <div class="home-notification-text">
                    <strong>
                        Bạn có {{ $unreadNotificationCount }} thông báo mới.
                    </strong>
                    Vui lòng kiểm tra thông tin liên quan đến chuyến bay.
                </div>
                <a href="{{ route('notifications.index') }}"
                   class="home-notification-button">
                    Xem thông báo
                </a>
            </div>
        </div>
    @endif
@endauth

{{-- BANNER MÁY BAY --}}

<section class="hero">
    <div class="hero-container">
        <div class="hero-content">

            <div class="hero-tag">BAY CÙNG VIETJET</div>

            <h1>
                Khám phá thế giới<br>
                <span>bắt đầu từ một chuyến bay</span>
            </h1>

            <p class="hero-description">
                Hành trình tuyệt vời đang chờ bạn.
                Đặt vé dễ dàng, nhanh chóng với Vietjet.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('flights.search.form') }}"
                   class="hero-btn-primary">
                    Đặt vé ngay
                </a>

                @auth
                    <a href="{{ route('tickets.mine') }}"
                       class="hero-btn-secondary">
                        Xem lịch sử vé
                    </a>
                @else
                    <a href="{{ route('dang-nhap') }}"
                       class="hero-btn-secondary">
                        Đăng nhập
                    </a>
                @endauth
            </div>

        </div>
    </div>
</section>

{{-- FORM TÌM CHUYẾN BAY --}}

<div class="booking-wrapper">
    <div class="booking-box">

        <div class="booking-tabs">
            <div class="booking-tab">Tìm chuyến bay</div>
        </div>

        <div class="booking-body">

            <div class="booking-title">
                <h2>Bạn muốn đi đâu?</h2>
                <p>
                    Chọn điểm khởi hành, điểm đến, hành trình,
                    ngày bay và số lượng hành khách.
                </p>
            </div>

            <form action="{{ route('flights.search') }}"
                  method="GET"
                  id="quickSearchForm">

                <input type="hidden"
                       name="departure_airport_id"
                       id="quickDepartureInput">

                <input type="hidden"
                       name="arrival_airport_id"
                       id="quickArrivalInput">

                <input type="hidden"
                       name="trip_type"
                       id="quickTripInput"
                       value="one_way">

                <input type="hidden"
                       name="passenger_count"
                       id="quickPassengerInput"
                       value="1">

                <div class="quick-search" id="quickSearchGrid">

                    {{-- ĐIỂM ĐI --}}

                    <div class="quick-dropdown" id="departureDropdown">
                        <button type="button"
                                class="quick-trigger"
                                data-dropdown-trigger
                                aria-expanded="false">

                            <span class="quick-label">Điểm khởi hành</span>
                            <span class="quick-value" id="departureText">
                                Chọn sân bay đi
                            </span>
                            <span class="dropdown-arrow"></span>
                        </button>

                        <div class="quick-menu">
                            <div class="dropdown-title">
                                Chọn điểm khởi hành
                            </div>

                            @forelse($quickAirports as $airport)
                                <button type="button"
                                        class="airport-option departure-option"
                                        data-id="{{ $airport->id }}"
                                        data-text="{{ $airport->city }} ({{ $airport->code }})">

                                    <span class="airport-city">
                                        <span>{{ $airport->city }}</span>
                                        <span class="airport-code">
                                            {{ $airport->code }}
                                        </span>
                                    </span>

                                    <span class="airport-name">
                                        {{ $airport->name }}
                                    </span>
                                </button>
                            @empty
                                <div class="airport-name">
                                    Chưa có sân bay hoạt động.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- ĐỔI CHIỀU --}}

                    <div class="swap">
                        <button type="button"
                                class="swap-button"
                                id="quickSwapButton"
                                title="Đổi điểm đi và đến">

                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M7 7H20M20 7L16.5 3.5M20 7L16.5 10.5"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M17 17H4M4 17L7.5 13.5M4 17L7.5 20.5"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </button>
                    </div>

                    {{-- ĐIỂM ĐẾN --}}

                    <div class="quick-dropdown" id="arrivalDropdown">
                        <button type="button"
                                class="quick-trigger"
                                data-dropdown-trigger
                                aria-expanded="false">

                            <span class="quick-label">Điểm đến</span>
                            <span class="quick-value" id="arrivalText">
                                Chọn sân bay đến
                            </span>
                            <span class="dropdown-arrow"></span>
                        </button>

                        <div class="quick-menu">
                            <div class="dropdown-title">Chọn điểm đến</div>

                            @forelse($quickAirports as $airport)
                                <button type="button"
                                        class="airport-option arrival-option"
                                        data-id="{{ $airport->id }}"
                                        data-text="{{ $airport->city }} ({{ $airport->code }})">

                                    <span class="airport-city">
                                        <span>{{ $airport->city }}</span>
                                        <span class="airport-code">
                                            {{ $airport->code }}
                                        </span>
                                    </span>

                                    <span class="airport-name">
                                        {{ $airport->name }}
                                    </span>
                                </button>
                            @empty
                                <div class="airport-name">
                                    Chưa có sân bay hoạt động.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- HÀNH TRÌNH --}}

                    <div class="quick-dropdown" id="tripDropdown">
                        <button type="button"
                                class="quick-trigger"
                                data-dropdown-trigger
                                aria-expanded="false">

                            <span class="quick-label">Hành trình</span>
                            <span class="quick-value" id="tripText">
                                Một chiều
                            </span>
                            <span class="dropdown-arrow"></span>
                        </button>

                        <div class="quick-menu">
                            <button type="button"
                                    class="trip-option selected"
                                    data-trip="one_way"
                                    data-text="Một chiều">
                                Một chiều
                            </button>

                            <button type="button"
                                    class="trip-option"
                                    data-trip="round_trip"
                                    data-text="Khứ hồi">
                                Khứ hồi
                            </button>
                        </div>
                    </div>

                    {{-- NGÀY ĐI --}}

                    <label class="date-field departure-date-field">
                        <span class="date-label">Ngày đi</span>
                        <input type="date"
                               name="flight_date"
                               id="quickDepartureDate"
                               class="date-input"
                               min="{{ date('Y-m-d') }}"
                               required>
                    </label>

                    {{-- NGÀY VỀ --}}

                    <label class="date-field return-date-field hidden"
                           id="quickReturnField">
                        <span class="date-label">Ngày về</span>
                        <input type="date"
                               name="return_date"
                               id="quickReturnDate"
                               class="date-input"
                               min="{{ date('Y-m-d') }}"
                               disabled>
                    </label>

                    {{-- SỐ LƯỢNG KHÁCH --}}

                    <div class="passenger-field">

                        <span class="passenger-label">
                            Số lượng khách
                        </span>

                        <div class="passenger-control">

                            <button type="button"
                                    class="passenger-btn"
                                    id="passengerMinus"
                                    aria-label="Giảm số khách">
                                −
                            </button>

                            <div class="passenger-display"
                                 aria-live="polite">
                                <span class="passenger-count"
                                      id="passengerCountText">
                                    1
                                </span>
                                <span class="passenger-unit">
                                    hành khách
                                </span>
                            </div>

                            <button type="button"
                                    class="passenger-btn"
                                    id="passengerPlus"
                                    aria-label="Tăng số khách">
                                +
                            </button>

                        </div>
                    </div>

                    {{-- NÚT TÌM --}}

                    <button type="submit" class="search-button">
                        Tìm chuyến bay
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

{{-- KHÁM PHÁ VIỆT NAM --}}

<section class="section destination-section">
    <div class="section-container">

        <div class="section-heading">
            <div class="section-small-title">Điểm đến</div>
            <h2>Khám phá Việt Nam</h2>
            <p>Lựa chọn hành trình phù hợp và bắt đầu chuyến đi.</p>
        </div>

        <div class="destination-grid">

            <div class="destination danang">
                <div class="destination-content">
                    <h3>Đà Nẵng</h3>
                    <p>Thành phố biển năng động với nhiều điểm đến nổi tiếng.</p>
                    <a href="{{ route('flights.search.form') }}"
                       class="destination-link">
                        Khám phá →
                    </a>
                </div>
            </div>

            <div class="destination hanoi">
                <div class="destination-content">
                    <h3>Hà Nội</h3>
                    <p>Khám phá thủ đô với nét đẹp văn hóa và lịch sử.</p>
                    <a href="{{ route('flights.search.form') }}"
                       class="destination-link">
                        Khám phá →
                    </a>
                </div>
            </div>

            <div class="destination hochiminh">
                <div class="destination-content">
                    <h3>TP. Hồ Chí Minh</h3>
                    <p>Trung tâm kinh tế sôi động với nhiều trải nghiệm.</p>
                    <a href="{{ route('flights.search.form') }}"
                       class="destination-link">
                        Khám phá →
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- TIỆN ÍCH --}}

<section class="section gray" id="tien-ich">
    <div class="section-container">

        <div class="section-heading">
            <div class="section-small-title">Tiện ích</div>
            <h2>Một hệ thống cho toàn bộ hành trình</h2>
            <p>
                Các chức năng hỗ trợ khách hàng từ lúc tìm chuyến
                đến khi hoàn tất chuyến bay.
            </p>
        </div>

        <div class="service-grid">

            <div class="service-card">
                <div class="service-number">01</div>
                <h3>Tìm chuyến bay</h3>
                <p>
                    Tìm kiếm chuyến bay theo điểm đi, điểm đến
                    và ngày khởi hành.
                </p>
            </div>

            <div class="service-card">
                <div class="service-number">02</div>
                <h3>Chọn ghế trực tuyến</h3>
                <p>
                    Xem sơ đồ ghế và lựa chọn vị trí phù hợp
                    trước khi hoàn tất đặt vé.
                </p>
            </div>

            <div class="service-card">
                <div class="service-number">03</div>
                <h3>Thanh toán tiện lợi</h3>
                <p>
                    Hoàn tất thanh toán vé bằng các phương thức
                    được hệ thống hỗ trợ.
                </p>
            </div>

            <div class="service-card">
                <div class="service-number">04</div>
                <h3>Nhận diện khuôn mặt</h3>
                <p>
                    Đăng ký khuôn mặt khi đặt vé để hỗ trợ
                    nhân viên xác minh hành khách.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- NHẬN DIỆN KHUÔN MẶT --}}

<section class="section">
    <div class="face-section">

        <div class="face-content">
            <div class="face-badge">
                NHẬN DIỆN KHUÔN MẶT
            </div>

            <h2>Hỗ trợ xác minh hành khách nhanh chóng</h2>

            <p>
                Vietjet tích hợp nhận diện khuôn mặt vào quy trình
                đặt vé nhằm hỗ trợ nhân viên sân bay đối chiếu
                hành khách với thông tin đã đăng ký.
            </p>

            <div class="face-features">

                <div class="face-feature">
                    <span class="face-check">1</span>
                    <span>Đăng ký khuôn mặt trong quá trình đặt vé</span>
                </div>

                <div class="face-feature">
                    <span class="face-check">2</span>
                    <span>Đối chiếu khuôn mặt tại khu vực nhân viên</span>
                </div>

                <div class="face-feature">
                    <span class="face-check">3</span>
                    <span>
                        Chỉ xác nhận hành khách sau khi nhận diện thành công
                    </span>
                </div>

            </div>
        </div>

        <div class="face-visual">
            <div class="scan-box">
                <span class="scan-corner corner-1"></span>
                <span class="scan-corner corner-2"></span>
                <span class="scan-corner corner-3"></span>
                <span class="scan-corner corner-4"></span>
                <span class="scan-line"></span>
            </div>
        </div>

    </div>
</section>

{{-- QUY TRÌNH ĐẶT VÉ --}}

<section class="section gray">
    <div class="section-container">

        <div class="section-heading">
            <div class="section-small-title">Quy trình</div>
            <h2>Đặt vé chỉ với 5 bước</h2>
            <p>Quy trình từ tìm chuyến đến thanh toán.</p>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Tìm chuyến</h3>
                <p>Chọn điểm đi, điểm đến và ngày bay.</p>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <h3>Chọn ghế</h3>
                <p>Lựa chọn ghế phù hợp trên chuyến bay.</p>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <h3>Thông tin</h3>
                <p>Nhập thông tin hành khách và CCCD.</p>
            </div>

            <div class="step">
                <div class="step-number">4</div>
                <h3>Khuôn mặt</h3>
                <p>Đăng ký ảnh khuôn mặt của hành khách.</p>
            </div>

            <div class="step">
                <div class="step-number">5</div>
                <h3>Thanh toán</h3>
                <p>Xác nhận và hoàn tất thanh toán vé.</p>
            </div>
        </div>

    </div>
</section>

{{-- BANNER DƯỚI --}}

<section class="lower-banner">
    <div class="lower-banner-inner">

        <div class="lower-banner-copy">
            <div class="lower-banner-label">
                SẴN SÀNG CẤT CÁNH
            </div>
            <h2>Hành trình tiếp theo đang chờ bạn</h2>
            <p>
                Tìm chuyến bay phù hợp, lựa chọn ghế ngồi
                và tiếp tục hành trình trên hệ thống đặt vé trực tuyến.
            </p>
        </div>

        <a href="{{ route('flights.search.form') }}"
           class="lower-banner-action">
            Tìm chuyến bay
        </a>

    </div>
</section>

{{-- LIÊN HỆ --}}

<section class="section contact-section" id="lien-he">
    <div class="contact-container">

        <div class="contact-heading">
            <h2>Liên hệ hỗ trợ</h2>
            <p>
                Liên hệ Vietjet khi bạn cần hỗ trợ về đặt vé,
                chuyến bay hoặc thông tin hành khách.
            </p>
        </div>

        <div class="contact-grid">
            <div class="contact-card">
                <h3>Tổng đài hỗ trợ</h3>
                <p>Hotline: 1900 6868</p>
                <p>Hỗ trợ khách hàng mỗi ngày.</p>
            </div>

            <div class="contact-card">
                <h3>Email</h3>
                <p>hotro@vietjet.vn</p>
                <p>Tiếp nhận yêu cầu hỗ trợ trực tuyến.</p>
            </div>

            <div class="contact-card">
                <h3>Thời gian hỗ trợ</h3>
                <p>08:00 - 22:00</p>
                <p>Thứ Hai đến Chủ Nhật.</p>
            </div>
        </div>

    </div>
</section>

{{-- FOOTER --}}

<footer>
    <div class="footer-container">

        <div>
            <div class="footer-logo">
                Viet<span>jet</span>
            </div>
            <p class="footer-description">
                Website đặt vé máy bay tích hợp nhận diện khuôn mặt,
                hỗ trợ khách hàng đặt vé và quản lý hành trình trực tuyến.
            </p>
        </div>

        <div>
            <div class="footer-title">Chức năng</div>
            <div class="footer-links">
                <a href="{{ route('flights.search.form') }}">
                    Đặt vé
                </a>
                @auth
                    <a href="{{ route('tickets.mine') }}">
                        Lịch sử vé
                    </a>
                    <a href="{{ route('notifications.index') }}">
                        Thông báo
                    </a>
                @endauth
            </div>
        </div>

        <div>
            <div class="footer-title">Hỗ trợ</div>
            <div class="footer-links">
                @auth
                    <a href="{{ route('profile.edit') }}">
                        Thông tin cá nhân
                    </a>
                @endauth
                <a href="#lien-he">Liên hệ</a>
            </div>
        </div>

    </div>

    <div class="copyright">
        © {{ date('Y') }} Vietjet -
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </div>
</footer>

{{-- JAVASCRIPT --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const dropdowns = document.querySelectorAll('.quick-dropdown');

    function closeDropdowns() {
        dropdowns.forEach(function (dropdown) {
            dropdown.classList.remove('active');

            const trigger = dropdown.querySelector(
                '[data-dropdown-trigger]'
            );

            if (trigger) {
                trigger.setAttribute('aria-expanded', 'false');
            }
        });
    }

    dropdowns.forEach(function (dropdown) {
        const trigger = dropdown.querySelector(
            '[data-dropdown-trigger]'
        );

        if (!trigger) return;

        trigger.addEventListener('click', function (event) {
            event.stopPropagation();

            const isActive = dropdown.classList.contains('active');
            closeDropdowns();

            if (!isActive) {
                dropdown.classList.add('active');
                trigger.setAttribute('aria-expanded', 'true');
            }
        });
    });

    document.addEventListener('click', closeDropdowns);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeDropdowns();
    });

    document.querySelectorAll('.quick-menu').forEach(function (menu) {
        menu.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });

    /* SÂN BAY */

    const departureInput = document.getElementById(
        'quickDepartureInput'
    );
    const arrivalInput = document.getElementById(
        'quickArrivalInput'
    );
    const departureText = document.getElementById(
        'departureText'
    );
    const arrivalText = document.getElementById(
        'arrivalText'
    );

    function updateAirportOptions() {
        document.querySelectorAll('.departure-option').forEach(
            function (option) {
                option.classList.toggle(
                    'selected',
                    departureInput.value !== '' &&
                    option.dataset.id === departureInput.value
                );
            }
        );

        document.querySelectorAll('.arrival-option').forEach(
            function (option) {
                option.classList.toggle(
                    'selected',
                    arrivalInput.value !== '' &&
                    option.dataset.id === arrivalInput.value
                );
            }
        );
    }

    document.querySelectorAll('.departure-option').forEach(
        function (option) {
            option.addEventListener('click', function () {
                departureInput.value = this.dataset.id;
                departureText.textContent = this.dataset.text;
                updateAirportOptions();
                closeDropdowns();
            });
        }
    );

    document.querySelectorAll('.arrival-option').forEach(
        function (option) {
            option.addEventListener('click', function () {
                arrivalInput.value = this.dataset.id;
                arrivalText.textContent = this.dataset.text;
                updateAirportOptions();
                closeDropdowns();
            });
        }
    );

    /* ĐỔI CHIỀU */

    document.getElementById('quickSwapButton')
        .addEventListener('click', function () {

            const oldId = departureInput.value;
            const oldText = departureText.textContent;

            departureInput.value = arrivalInput.value;
            departureText.textContent = arrivalText.textContent;

            arrivalInput.value = oldId;
            arrivalText.textContent = oldText;

            updateAirportOptions();
        });

    /* HÀNH TRÌNH */

    const tripInput = document.getElementById('quickTripInput');
    const tripText = document.getElementById('tripText');
    const searchGrid = document.getElementById('quickSearchGrid');
    const departureDate = document.getElementById(
        'quickDepartureDate'
    );
    const returnField = document.getElementById(
        'quickReturnField'
    );
    const returnDate = document.getElementById(
        'quickReturnDate'
    );

    document.querySelectorAll('.trip-option').forEach(
        function (option) {

            option.addEventListener('click', function () {

                tripInput.value = this.dataset.trip;
                tripText.textContent = this.dataset.text;

                document.querySelectorAll('.trip-option').forEach(
                    function (item) {
                        item.classList.remove('selected');
                    }
                );

                this.classList.add('selected');

                if (this.dataset.trip === 'round_trip') {
                    searchGrid.classList.add('round-trip');
                    returnField.classList.remove('hidden');

                    returnDate.disabled = false;
                    returnDate.required = true;
                    returnDate.min =
                        departureDate.value || departureDate.min;

                } else {
                    searchGrid.classList.remove('round-trip');
                    returnField.classList.add('hidden');

                    returnDate.disabled = true;
                    returnDate.required = false;
                    returnDate.value = '';
                }

                closeDropdowns();
            });
        }
    );

    /* NGÀY BAY */

    departureDate.addEventListener('change', function () {
        returnDate.min = this.value;

        if (returnDate.value && returnDate.value < this.value) {
            returnDate.value = '';
        }
    });

    /* SỐ LƯỢNG KHÁCH */

    const minusBtn = document.getElementById('passengerMinus');
    const plusBtn = document.getElementById('passengerPlus');
    const countText = document.getElementById('passengerCountText');
    const countInput = document.getElementById('quickPassengerInput');

    let passengerCount = parseInt(countInput.value, 10) || 1;

    function updatePassengers() {
        passengerCount = Math.max(1, Math.min(5, passengerCount));

        countText.textContent = passengerCount;
        countInput.value = passengerCount;

        minusBtn.disabled = passengerCount <= 1;
        plusBtn.disabled = passengerCount >= 5;
    }

    minusBtn.addEventListener('click', function () {
        passengerCount = Math.max(1, passengerCount - 1);
        updatePassengers();
    });

    plusBtn.addEventListener('click', function () {
        passengerCount = Math.min(5, passengerCount + 1);
        updatePassengers();
    });

    updatePassengers();

    /* VALIDATE FORM */

    document.getElementById('quickSearchForm')
        .addEventListener('submit', function (event) {

            if (!departureInput.value) {
                event.preventDefault();
                alert('Vui lòng chọn điểm khởi hành.');
                return;
            }

            if (!arrivalInput.value) {
                event.preventDefault();
                alert('Vui lòng chọn điểm đến.');
                return;
            }

            if (departureInput.value === arrivalInput.value) {
                event.preventDefault();
                alert(
                    'Điểm khởi hành và điểm đến không được trùng nhau.'
                );
                return;
            }

            if (!departureDate.value) {
                event.preventDefault();
                alert('Vui lòng chọn ngày đi.');
                return;
            }

            if (
                tripInput.value === 'round_trip' &&
                !returnDate.value
            ) {
                event.preventDefault();
                alert('Vui lòng chọn ngày về.');
                return;
            }

            if (
                tripInput.value === 'round_trip' &&
                returnDate.value < departureDate.value
            ) {
                event.preventDefault();
                alert('Ngày về không được trước ngày đi.');
                return;
            }

            const count = Number(countInput.value);

            if (
                !Number.isInteger(count) ||
                count < 1 ||
                count > 5
            ) {
                event.preventDefault();
                alert('Số lượng khách phải từ 1 đến 5.');
                return;
            }
        });

});
</script>

</body>
</html>
