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
            --white: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff;
            color: var(--text);
            line-height: 1.5;
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
            margin: auto;
            min-height: 36px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .top-left,
        .top-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar a {
            color: white;
            opacity: 0.9;
        }

        .top-bar a:hover {
            opacity: 1;
        }

        .notification-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .notification-badge {
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 20px;
            background: var(--danger);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
        }

        .header {
            background: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .navbar {
            max-width: 1240px;
            margin: auto;
            min-height: 76px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo {
            font-size: 27px;
            font-weight: 800;
            color: var(--primary);
            white-space: nowrap;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--secondary);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-link {
            color: #293241;
            padding: 27px 14px;
            font-weight: 600;
            font-size: 15px;
            border-bottom: 3px solid transparent;
            transition: 0.2s;
        }

        .nav-link:hover {
            color: var(--primary);
            border-bottom-color: var(--secondary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-login,
        .btn-register {
            padding: 10px 17px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 700;
        }

        .btn-login {
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-register {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-name {
            font-size: 14px;
            font-weight: bold;
            color: var(--primary);
        }

        .logout-btn {
            border: 0;
            cursor: pointer;
            color: white;
            background: var(--danger);
            padding: 9px 13px;
            border-radius: 7px;
            font-weight: bold;
        }

        .home-notification {
            max-width: 1240px;
            margin: 18px auto 0;
            padding: 0 20px;
        }

        .home-notification-box {
            padding: 14px 18px;
            border: 1px solid #ead58e;
            border-left: 4px solid var(--secondary);
            border-radius: 9px;
            background: #fff9e8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .home-notification-text {
            color: #604c00;
            font-size: 14px;
        }

        .home-notification-text strong {
            color: var(--primary-dark);
        }

        .home-notification-button {
            padding: 9px 14px;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .hero {
            min-height: 560px;
            position: relative;
            background:
                linear-gradient(
                    90deg,
                    rgba(0, 43, 82, 0.74) 0%,
                    rgba(0, 67, 125, 0.32) 44%,
                    rgba(0, 59, 112, 0.04) 100%
                ),
                url('/images/hinh1.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-container {
            width: 100%;
            max-width: 1240px;
            margin: auto;
            padding: 58px 20px 155px;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            width: 610px;
            max-width: 100%;
            color: white;
        }

        .hero-tag {
            display: inline-flex;
            background: transparent;
            border: 0;
            padding: 0;
            border-radius: 0;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 3px;
            margin-bottom: 14px;
        }

        .hero h1 {
            font-size: 50px;
            line-height: 1.08;
            margin-bottom: 18px;
            text-shadow: 0 4px 18px rgba(0, 0, 0, 0.18);
        }

        .hero h1 span {
            color: white;
        }

        .hero-description {
            font-size: 18px;
            max-width: 550px;
            color: #f5f5f5;
            margin-bottom: 28px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-btn-primary,
        .hero-btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 22px;
            border-radius: 8px;
            font-weight: bold;
        }

        .hero-btn-primary {
            background: var(--secondary);
            color: #202020;
        }

        .hero-btn-secondary {
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid white;
            color: white;
        }

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
            left: 50%;
            top: 112px;
            width: 100vw;
            height: 190px;
            transform: translateX(-50%);
            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,0.00),
                    rgba(255,255,255,0.12)
                ),
                url('/images/hinh2.png');
            background-size: cover;
            background-position: center top;
        }

        .booking-box {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 59, 112, 0.08);
            border-radius: 16px;
            box-shadow: 0 18px 48px rgba(0, 45, 83, 0.18);
            overflow: visible;
        }

        .booking-tabs {
            display: flex;
            border-bottom: 1px solid var(--border);
        }

        .booking-tab {
            padding: 19px 28px;
            font-size: 15px;
            font-weight: bold;
            color: #565f6b;
        }

        .booking-tab.active {
            color: var(--primary);
            border-bottom: 4px solid var(--secondary);
            background: #fafcff;
        }

        .booking-body {
            padding: 28px;
        }

        .booking-title {
            margin-bottom: 22px;
        }

        .booking-title h2 {
            font-size: 23px;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .booking-title p {
            color: var(--muted);
            font-size: 14px;
        }

        .quick-search {
            display: grid;
            grid-template-columns:
                minmax(175px, 1fr)
                48px
                minmax(175px, 1fr)
                minmax(145px, 0.72fr)
                minmax(145px, 0.72fr)
                minmax(145px, 0.72fr)
                155px;
            gap: 10px;
            align-items: stretch;
        }

        .quick-dropdown {
            position: relative;
        }

        .quick-trigger {
            width: 100%;
            min-height: 70px;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 42px 12px 15px;
            background: white;
            text-align: left;
            cursor: pointer;
            position: relative;
        }

        .quick-dropdown.active .quick-trigger {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 59, 112, 0.08);
        }

        .quick-label {
            display: block;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 5px;
        }

        .quick-value {
            display: block;
            color: #202631;
            font-size: 15px;
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dropdown-arrow {
            position: absolute;
            right: 15px;
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
            min-width: 300px;
            max-height: 330px;
            overflow-y: auto;
            background: white;
            border: 1px solid #dbe3ea;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.14);
            z-index: 2000;
            padding: 8px;
        }

        .quick-dropdown.active .quick-menu {
            display: block;
        }

        .dropdown-title {
            padding: 9px 11px 8px;
            color: var(--muted);
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .airport-option,
        .trip-option {
            width: 100%;
            border: none;
            border-radius: 8px;
            background: white;
            padding: 11px 12px;
            text-align: left;
            cursor: pointer;
        }

        .airport-option:hover,
        .trip-option:hover {
            background: #f1f6fb;
        }

        .airport-city {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            color: var(--primary);
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .airport-code {
            color: var(--secondary);
            font-size: 12px;
            font-weight: 800;
        }

        .airport-name {
            display: block;
            color: var(--muted);
            font-size: 12px;
        }

        .trip-option {
            color: #273445;
            font-size: 14px;
            font-weight: 600;
        }

        .trip-option.selected,
        .airport-option.selected {
            background: #edf6ff;
        }

        .swap {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swap-button {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: white;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .swap-button svg {
            width: 20px;
            height: 20px;
        }

        .date-field {
            min-height: 70px;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px 13px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .date-label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 5px;
        }

        .date-input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            color: #202631;
            font-size: 14px;
            font-weight: bold;
        }

        .return-date-field.hidden {
            display: none;
        }

        .search-button {
            min-height: 70px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            background: linear-gradient(135deg, var(--primary), #006ac1);
            color: white;
            font-size: 15px;
            font-weight: bold;
        }

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
            color: var(--danger);
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 7px;
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
        }

        .destination-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .destination {
            min-height: 330px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            background-size: cover;
            background-position: center;
            box-shadow: 0 7px 20px rgba(0, 0, 0, 0.12);
        }

        .destination::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(0, 0, 0, 0.76),
                rgba(0, 0, 0, 0.03)
            );
        }

        .destination-content {
            position: absolute;
            z-index: 2;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 25px;
            color: white;
        }

        .destination-content h3 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .destination-content p {
            font-size: 14px;
            color: #eeeeee;
            margin-bottom: 12px;
        }

        .destination-link {
            color: var(--secondary);
            font-weight: bold;
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

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .service-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 28px 22px;
        }

        .service-number {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf6ff;
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .service-card h3 {
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 9px;
        }

        .service-card p {
            color: var(--muted);
            font-size: 14px;
        }

        .face-section {
            max-width: 1240px;
            margin: auto;
            border-radius: 22px;
            overflow: hidden;
            background: linear-gradient(120deg, #00294f, #005c9f);
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
        }

        .face-content {
            padding: 60px;
            color: white;
        }

        .face-badge {
            display: inline-block;
            background: var(--secondary);
            color: #202020;
            padding: 7px 13px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 17px;
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
            gap: 10px;
            align-items: center;
        }

        .face-check {
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.17);
        }

        .face-visual {
            min-height: 380px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .scan-box {
            width: 220px;
            height: 270px;
            border: 3px solid rgba(255, 255, 255, 0.8);
            border-radius: 80px 80px 55px 55px;
            position: relative;
        }

        .scan-line {
            position: absolute;
            width: 90%;
            left: 5%;
            top: 50%;
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
            width: 52px;
            height: 52px;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            font-weight: bold;
            font-size: 18px;
            position: relative;
            z-index: 2;
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
            font-size: 13px;
            color: var(--muted);
            margin-top: 5px;
        }

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

        .contact-heading p {
            max-width: 650px;
            color: #c8d6e1;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .contact-card {
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.06);
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
            color: white;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer-logo span {
            color: var(--secondary);
        }

        .footer-description {
            color: #b8c6d3;
            max-width: 420px;
            font-size: 14px;
        }

        .footer-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 16px;
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
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 18px 20px;
            text-align: center;
            color: #9bacbb;
            font-size: 13px;
        }


        .popular-routes {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
        }

        .popular-label {
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
            margin-right: 4px;
        }

        .popular-routes a {
            padding: 6px 13px;
            border-radius: 18px;
            background: #eaf4fb;
            color: #174f7d;
            font-size: 12px;
            font-weight: 700;
        }

        .popular-routes a:hover {
            background: #d8edfc;
        }

        .destination-section {
            position: relative;
            overflow: hidden;
            margin-top: 0;
            padding-top: 170px;
            padding-bottom: 100px;
            background:
                linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0.00) 0%,
                    rgba(255, 255, 255, 0.18) 16%,
                    rgba(255, 255, 255, 0.52) 38%,
                    rgba(255, 255, 255, 0.78) 65%,
                    rgba(242, 249, 255, 0.88) 100%
                ),
                url('/images/hinh2.png');
            background-size: cover;
            background-position: center top;
        }

        .destination-section .section-container {
            position: relative;
            z-index: 2;
        }

        .booking-wrapper + .destination-section {
            margin-top: -170px;
            padding-top: 255px;
        }

        .destination-section .section-heading {
            margin-bottom: 28px;
        }

        .destination-grid {
            gap: 18px;
        }

        .destination {
            min-height: 245px;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(0, 45, 83, .17);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .destination:hover {
            transform: translateY(-5px);
            box-shadow: 0 19px 38px rgba(0, 45, 83, .21);
        }

        .destination-content {
            padding: 22px;
        }

        .destination-link {
            display: inline-flex;
            align-items: center;
            min-height: 36px;
            padding: 0 15px;
            border: 1px solid rgba(255,255,255,.88);
            border-radius: 22px;
            color: white;
            background: rgba(0, 35, 68, .28);
            backdrop-filter: blur(4px);
        }

        .destination-link:hover {
            background: var(--secondary);
            border-color: var(--secondary);
            color: #202020;
        }

        .lower-banner {
            position: relative;
            overflow: hidden;
            min-height: 250px;
            background:
                linear-gradient(
                    90deg,
                    rgba(0, 43, 82, .95),
                    rgba(0, 84, 150, .74)
                ),
                url('/images/hinh2.png');
            background-size: cover;
            background-position: center 64%;
        }

        .lower-banner-inner {
            max-width: 1240px;
            margin: auto;
            min-height: 250px;
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
            margin-bottom: 8px;
        }

        .lower-banner-copy h2 {
            font-size: 31px;
            margin-bottom: 10px;
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
            border-radius: 9px;
            background: var(--secondary);
            color: #202020;
            font-weight: 800;
        }

        @media (max-width: 1050px) {
            .nav-menu {
                display: none;
            }

            .quick-search {
                grid-template-columns: 1fr 50px 1fr;
            }

            .service-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 800px) {
            .top-bar {
                display: none;
            }

            .navbar {
                min-height: 65px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .quick-search,
            .destination-grid,
            .face-section,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .swap {
                transform: rotate(90deg);
            }

            .quick-menu {
                min-width: 100%;
            }

            .steps {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .step:not(:last-child)::after {
                display: none;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .home-notification-box {
                align-items: flex-start;
                flex-direction: column;
            }

            .lower-banner-inner {
                align-items: flex-start;
                flex-direction: column;
                gap: 24px;
            }

            .booking-wrapper + .destination-section {
                margin-top: -90px;
                padding-top: 175px;
            }

            .booking-wrapper::before {
                top: 112px;
                height: 120px;
            }
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
            'user_id',
            auth()->id()
        )
            ->where('status', 'unread')
            ->count();
    }
@endphp

<div class="top-bar">
    <div class="top-bar-inner">
        <div class="top-left">
            <span></span>
            <span></span>
        </div>

        <div class="top-right">
            @auth
                <a href="{{ route('profile.edit') }}">
                    Thông tin cá nhân
                </a>

                <a
                    href="{{ route('notifications.index') }}"
                    class="notification-link"
                >
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
                    Vé của tôi
                </a>

                <a
                    href="{{ route('notifications.index') }}"
                    class="nav-link notification-link"
                >
                    Thông báo

                    @if($unreadNotificationCount > 0)
                        <span class="notification-badge">
                            {{ $unreadNotificationCount }}
                        </span>
                    @endif
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

@auth
    @if($unreadNotificationCount > 0)
        <div class="home-notification">
            <div class="home-notification-box">
                <div class="home-notification-text">
                    <strong>
                        Bạn có {{ $unreadNotificationCount }} thông báo mới.
                    </strong>
                    Vui lòng kiểm tra thông tin và nhắc nhở liên quan đến chuyến bay của bạn.
                </div>

                <a
                    href="{{ route('notifications.index') }}"
                    class="home-notification-button"
                >
                    Xem thông báo
                </a>
            </div>
        </div>
    @endif
@endauth

<section class="hero">
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-tag">
                BAY CÙNG VIETJET
            </div>

            <h1>
                Khám phá thế giới<br>
                <span>bắt đầu từ một chuyến bay</span>
            </h1>

            <p class="hero-description">
                Hành trình tuyệt vời đang chờ bạn. Đặt vé dễ dàng,
                nhanh chóng với Vietjet.
            </p>

            <div class="hero-buttons">
                <a
                    href="{{ route('flights.search.form') }}"
                    class="hero-btn-primary"
                >
                    Đặt vé ngay
                </a>

                @auth
                    <a
                        href="{{ route('tickets.mine') }}"
                        class="hero-btn-secondary"
                    >
                        Xem vé của tôi
                    </a>
                @else
                    <a
                        href="{{ route('dang-nhap') }}"
                        class="hero-btn-secondary"
                    >
                        Đăng nhập
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<div class="booking-wrapper">
    <div class="booking-box">
        <div class="booking-tabs">
            <div class="booking-tab active">
                Tìm chuyến bay
            </div>

            @auth
               
            @endauth
        </div>

        <div class="booking-body">
            <div class="booking-title">
                <h2>Bạn muốn đi đâu?</h2>

                <p>
                    Chọn điểm khởi hành, điểm đến, hành trình và ngày bay.
                </p>
            </div>

            <form
                action="{{ route('flights.search') }}"
                method="GET"
                id="quickSearchForm"
            >
                <input
                    type="hidden"
                    name="departure_airport_id"
                    id="quickDepartureInput"
                >

                <input
                    type="hidden"
                    name="arrival_airport_id"
                    id="quickArrivalInput"
                >

                <input
                    type="hidden"
                    name="trip_type"
                    id="quickTripInput"
                    value="one_way"
                >

                <div class="quick-search">
                    <div class="quick-dropdown" id="departureDropdown">
                        <button
                            type="button"
                            class="quick-trigger"
                            data-dropdown-trigger
                        >
                            <span class="quick-label">
                                Điểm khởi hành
                            </span>

                            <span
                                class="quick-value"
                                id="departureText"
                            >
                                Chọn sân bay đi
                            </span>

                            <span class="dropdown-arrow"></span>
                        </button>

                        <div class="quick-menu">
                            <div class="dropdown-title">
                                Chọn điểm khởi hành
                            </div>

                            @forelse($quickAirports as $airport)
                                <button
                                    type="button"
                                    class="airport-option departure-option"
                                    data-id="{{ $airport->id }}"
                                    data-text="{{ $airport->city }} ({{ $airport->code }})"
                                >
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
                                <div style="padding:15px;color:#6b7280;font-size:13px;">
                                    Chưa có sân bay hoạt động.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="swap">
                        <button
                            type="button"
                            class="swap-button"
                            id="quickSwapButton"
                            title="Đổi điểm đi và điểm đến"
                        >
                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M7 7H20M20 7L16.5 3.5M20 7L16.5 10.5"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M17 17H4M4 17L7.5 13.5M4 17L7.5 20.5"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </div>

                    <div class="quick-dropdown" id="arrivalDropdown">
                        <button
                            type="button"
                            class="quick-trigger"
                            data-dropdown-trigger
                        >
                            <span class="quick-label">
                                Điểm đến
                            </span>

                            <span
                                class="quick-value"
                                id="arrivalText"
                            >
                                Chọn sân bay đến
                            </span>

                            <span class="dropdown-arrow"></span>
                        </button>

                        <div class="quick-menu">
                            <div class="dropdown-title">
                                Chọn điểm đến
                            </div>

                            @forelse($quickAirports as $airport)
                                <button
                                    type="button"
                                    class="airport-option arrival-option"
                                    data-id="{{ $airport->id }}"
                                    data-text="{{ $airport->city }} ({{ $airport->code }})"
                                >
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
                                <div style="padding:15px;color:#6b7280;font-size:13px;">
                                    Chưa có sân bay hoạt động.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div
                        class="quick-dropdown trip-dropdown"
                        id="tripDropdown"
                    >
                        <button
                            type="button"
                            class="quick-trigger"
                            data-dropdown-trigger
                        >
                            <span class="quick-label">
                                Hành trình
                            </span>

                            <span
                                class="quick-value"
                                id="tripText"
                            >
                                Một chiều
                            </span>

                            <span class="dropdown-arrow"></span>
                        </button>

                        <div class="quick-menu">
                            <button
                                type="button"
                                class="trip-option selected"
                                data-trip="one_way"
                                data-text="Một chiều"
                            >
                                Một chiều
                            </button>

                            <button
                                type="button"
                                class="trip-option"
                                data-trip="round_trip"
                                data-text="Khứ hồi"
                            >
                                Khứ hồi
                            </button>
                        </div>
                    </div>

                    <label class="date-field">
                        <span class="date-label">
                            Ngày đi
                        </span>

                        <input
                            type="date"
                            name="flight_date"
                            id="quickDepartureDate"
                            class="date-input"
                            min="{{ date('Y-m-d') }}"
                            required
                        >
                    </label>

                    <label
                        class="date-field return-date-field hidden"
                        id="quickReturnField"
                    >
                        <span class="date-label">
                            Ngày về
                        </span>

                        <input
                            type="date"
                            name="return_date"
                            id="quickReturnDate"
                            class="date-input"
                            min="{{ date('Y-m-d') }}"
                        >
                    </label>

                    <button type="submit" class="search-button">
                        Tìm chuyến bay
                    </button>
                </div>

                
            </form>
        </div>
    </div>
</div>

<section class="section destination-section">
    <div class="section-container">
        <div class="section-heading">
            <div class="section-small-title">
                Điểm đến
            </div>

            <h2>Khám phá Việt Nam</h2>

            <p>
                Lựa chọn hành trình phù hợp và bắt đầu chuyến đi của bạn.
            </p>
        </div>

        <div class="destination-grid">
            <div class="destination danang">
                <div class="destination-content">
                    <h3>Đà Nẵng</h3>

                    <p>
                        Thành phố biển năng động với nhiều điểm đến nổi tiếng.
                    </p>

                    <a
                        href="{{ route('flights.search.form') }}"
                        class="destination-link"
                    >
                        Khám phá →
                    </a>
                </div>
            </div>

            <div class="destination hanoi">
                <div class="destination-content">
                    <h3>Hà Nội</h3>

                    <p>
                        Khám phá thủ đô với nét đẹp văn hóa và lịch sử.
                    </p>

                    <a
                        href="{{ route('flights.search.form') }}"
                        class="destination-link"
                    >
                        Khám phá →
                    </a>
                </div>
            </div>

            <div class="destination hochiminh">
                <div class="destination-content">
                    <h3>TP. Hồ Chí Minh</h3>

                    <p>
                        Trung tâm kinh tế sôi động với nhiều trải nghiệm.
                    </p>

                    <a
                        href="{{ route('flights.search.form') }}"
                        class="destination-link"
                    >
                        Khám phá →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section gray" id="tien-ich">
    <div class="section-container">
        <div class="section-heading">
            <div class="section-small-title">
                Tiện ích
            </div>

            <h2>Một hệ thống cho toàn bộ hành trình</h2>

            <p>
                Các chức năng được thiết kế để hỗ trợ khách hàng
                từ lúc tìm chuyến đến khi hoàn tất chuyến bay.
            </p>
        </div>

        <div class="service-grid">
            <div class="service-card">
                <div class="service-number">01</div>

                <h3>Tìm chuyến bay</h3>

                <p>
                    Tìm kiếm chuyến bay theo điểm đi,
                    điểm đến và ngày khởi hành.
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
                    thanh toán được hệ thống hỗ trợ.
                </p>
            </div>

            <div class="service-card">
                <div class="service-number">04</div>

                <h3>Nhận diện khuôn mặt</h3>

                <p>
                    Đăng ký khuôn mặt khi đặt vé để hỗ trợ
                    nhân viên xác minh hành khách tại sân bay.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="face-section">
        <div class="face-content">
            <div class="face-badge">
                NHẬN DIỆN KHUÔN MẶT
            </div>

            <h2>
                Hỗ trợ xác minh hành khách nhanh chóng
            </h2>

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
                    <span>Chỉ xác nhận hành khách sau khi nhận diện thành công</span>
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

<section class="section gray">
    <div class="section-container">
        <div class="section-heading">
            <div class="section-small-title">
                Quy trình
            </div>

            <h2>Đặt vé chỉ với 5 bước</h2>

            <p>
                Quy trình đặt vé được thực hiện trực tuyến
                từ tìm chuyến đến thanh toán.
            </p>
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

<section class="lower-banner">
    <div class="lower-banner-inner">
        <div class="lower-banner-copy">
            <div class="lower-banner-label">SẴN SÀNG CẤT CÁNH</div>

            <h2>Hành trình tiếp theo đang chờ bạn</h2>

            <p>
                Tìm chuyến bay phù hợp, lựa chọn ghế ngồi và tiếp tục
                hành trình của bạn trên hệ thống đặt vé trực tuyến.
            </p>
        </div>

        <a href="{{ route('flights.search.form') }}" class="lower-banner-action">
            Tìm chuyến bay
        </a>
    </div>
</section>

<section class="section contact-section" id="lien-he">
    <div class="contact-container">
        <div class="contact-heading">
            <h2>Liên hệ hỗ trợ</h2>

            <p>
                Liên hệ với Vietjet khi bạn cần hỗ trợ về đặt vé,
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
            <div class="footer-title">
                Chức năng
            </div>

            <div class="footer-links">
                <a href="{{ route('flights.search.form') }}">
                    Đặt vé
                </a>

                @auth
                    <a href="{{ route('tickets.mine') }}">
                        Vé của tôi
                    </a>

                    <a href="{{ route('notifications.index') }}">
                        Thông báo
                    </a>
                @endauth
            </div>
        </div>

        <div>
            <div class="footer-title">
                Hỗ trợ
            </div>

            <div class="footer-links">
                @auth
                    <a href="{{ route('profile.edit') }}">
                        Thông tin cá nhân
                    </a>
                @endauth

                <a href="#lien-he">
                    Liên hệ
                </a>
            </div>
        </div>
    </div>

    <div class="copyright">
        © {{ date('Y') }} Vietjet -
        Website đặt vé máy bay tích hợp nhận diện khuôn mặt.
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.quick-dropdown');

        dropdowns.forEach(function (dropdown) {
            const trigger = dropdown.querySelector('[data-dropdown-trigger]');

            if (!trigger) {
                return;
            }

            trigger.addEventListener('click', function (event) {
                event.stopPropagation();

                dropdowns.forEach(function (item) {
                    if (item !== dropdown) {
                        item.classList.remove('active');
                    }
                });

                dropdown.classList.toggle('active');
            });
        });

        document.addEventListener('click', function () {
            dropdowns.forEach(function (dropdown) {
                dropdown.classList.remove('active');
            });
        });

        document.querySelectorAll('.quick-menu').forEach(function (menu) {
            menu.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });

        const departureInput = document.getElementById('quickDepartureInput');
        const arrivalInput = document.getElementById('quickArrivalInput');
        const departureText = document.getElementById('departureText');
        const arrivalText = document.getElementById('arrivalText');

        document.querySelectorAll('.departure-option').forEach(function (option) {
            option.addEventListener('click', function () {
                departureInput.value = this.dataset.id;
                departureText.textContent = this.dataset.text;

                document.querySelectorAll('.departure-option').forEach(function (item) {
                    item.classList.remove('selected');
                });

                this.classList.add('selected');
                document.getElementById('departureDropdown').classList.remove('active');
            });
        });

        document.querySelectorAll('.arrival-option').forEach(function (option) {
            option.addEventListener('click', function () {
                arrivalInput.value = this.dataset.id;
                arrivalText.textContent = this.dataset.text;

                document.querySelectorAll('.arrival-option').forEach(function (item) {
                    item.classList.remove('selected');
                });

                this.classList.add('selected');
                document.getElementById('arrivalDropdown').classList.remove('active');
            });
        });

        const swapButton = document.getElementById('quickSwapButton');

        swapButton.addEventListener('click', function () {
            const departureValue = departureInput.value;
            const departureLabel = departureText.textContent;

            departureInput.value = arrivalInput.value;
            departureText.textContent = arrivalText.textContent;

            arrivalInput.value = departureValue;
            arrivalText.textContent = departureLabel;
        });

        const tripInput = document.getElementById('quickTripInput');
        const tripText = document.getElementById('tripText');
        const returnField = document.getElementById('quickReturnField');
        const returnDate = document.getElementById('quickReturnDate');
        const departureDate = document.getElementById('quickDepartureDate');

        document.querySelectorAll('.trip-option').forEach(function (option) {
            option.addEventListener('click', function () {
                tripInput.value = this.dataset.trip;
                tripText.textContent = this.dataset.text;

                document.querySelectorAll('.trip-option').forEach(function (item) {
                    item.classList.remove('selected');
                });

                this.classList.add('selected');

                if (this.dataset.trip === 'round_trip') {
                    returnField.classList.remove('hidden');
                    returnDate.required = true;
                } else {
                    returnField.classList.add('hidden');
                    returnDate.required = false;
                    returnDate.value = '';
                }

                document.getElementById('tripDropdown').classList.remove('active');
            });
        });

        departureDate.addEventListener('change', function () {
            returnDate.min = this.value;

            if (
                returnDate.value &&
                returnDate.value < this.value
            ) {
                returnDate.value = '';
            }
        });

        document.getElementById('quickSearchForm').addEventListener('submit', function (event) {
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
                alert('Điểm khởi hành và điểm đến không được trùng nhau.');
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
            }
        });
    });
</script>

</body>
</html>