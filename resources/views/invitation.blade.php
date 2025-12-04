<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="title" content="The Wedding Of Madihah & Khairul | Saturday 27/12/2025">
    <meta name="description" content="Walimatulurus Madihah & Khairul. Sabtu, 27 Disember 2025 di 82 Cottage Homestay, Melor, Kelantan. #Dihatikhairul">
    <meta name="keywords" content="wedding,invitation,digital card,kad kahwin,jemputan,madihah,khairul,walimatulurus">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="The Wedding Of Madihah & Khairul | Saturday 27/12/2025">
    <meta property="og:description" content="Walimatulurus Madihah & Khairul. Sabtu, 27 Disember 2025 di 82 Cottage Homestay, Melor, Kelantan. #Dihatikhairul">
    <meta property="og:image" content="{{ asset('images/cover-bg.jpeg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="ms_MY">
    <meta property="og:site_name" content="Wedding Invitation - Madihah & Khairul">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="The Wedding Of Madihah & Khairul | Saturday 27/12/2025">
    <meta property="twitter:description" content="Walimatulurus Madihah & Khairul. Sabtu, 27 Disember 2025 di 82 Cottage Homestay, Melor, Kelantan. #Dihatikhairul">
    <meta property="twitter:image" content="{{ asset('images/cover-bg.jpeg') }}">

    <title>The Wedding Of Madihah & Khairul | Saturday 27/12/2025</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Great+Vibes&family=Lora:wght@400;500;600&family=Cinzel:wght@400;500;600;700&family=Spartan:wght@300;400;500;600&family=Marck+Script&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Spartan', sans-serif;
            background: #fff;
            color: #333;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        body.scroll-enabled {
            overflow-y: auto;
        }

        .container {
            max-width: 530px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .cover-section {
            min-height: 100vh;
            background-image: url('{{ asset('images/cover-bg.jpeg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .cover-content {
            text-align: center;
            color: #714d32;
            padding: 2rem;
            margin-top: -13rem;
        }

        .invitation-type {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            text-transform: uppercase;
            opacity: 0.8;
            margin-bottom: 2rem;
            font-weight: 500;
            letter-spacing: 2px;
        }

        .cover-name {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            margin: 0.5rem 0;
            line-height: 1.2;
            font-weight: 700;
            font-style: italic;
        }

        .and-text {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            margin: 1rem 0;
            font-weight: 400;
            font-style: italic;
        }

        .cover-date, .cover-hashtag {
            font-family: 'Cinzel', serif;
            font-size: 16px;
            margin-top: 2rem;
            opacity: 0.9;
            font-weight: 500;
            letter-spacing: 1px;
        }

        .main-content {
            padding: 3rem 1rem;
        }

        .section-title {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .intro-text {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 14px;
            font-family: 'Spartan', sans-serif;
            line-height: 1.8;
        }

        .parents-section {
            text-align: center;
            margin: 2rem 0;
        }

        .parent-name {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            margin: 0.5rem 0;
            font-weight: 500;
            font-style: italic;
        }

        .together-text {
            margin: 1.5rem 0;
            font-size: 16px;
        }

        .event-section {
            background: rgba(255,192,203,0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            text-align: center;
        }

        .venue-name {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .address-text {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-family: 'Spartan', sans-serif;
        }

        .date-time-info {
            margin: 1rem 0;
            font-size: 16px;
            font-family: 'Spartan', sans-serif;
        }

        .dress-code {
            margin-top: 2rem;
            font-size: 16px;
            font-family: 'Spartan', sans-serif;
        }

        .programme-section {
            padding: 2rem 1rem;
        }

        .programme-inner {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .programme-item {
            margin: 1.2rem 0;
            text-align: center;
        }

        .programme-item:first-of-type {
            margin-top: 1.5rem;
        }

        .programme-time {
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            margin-bottom: 0.3rem;
        }

        .programme-desc {
            font-family: 'Spartan', sans-serif;
            font-size: 15px;
            color: #333;
        }

        .countdown-section {
            text-align: center;
        }

        .countdown-grid {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .countdown-item {
            flex: 1;
            max-width: 80px;
        }

        .countdown-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #c02942;
        }

        .countdown-label {
            font-size: 0.9rem;
            margin-top: 0.5rem;
            font-family: 'Spartan', sans-serif;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            border: 1px solid #000;
            color: #000;
            background: transparent;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Spartan', sans-serif;
            font-weight: 500;
        }

        .btn:hover {
            background: #000;
            color: #fff;
        }

        .btn i {
            font-size: 16px;
        }

        .wishes-section {
            padding: 0;
            text-align: center;
            background: linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(255,192,203,0.05) 50%, rgba(255,255,255,0) 100%);
        }

        .wish-item {
            padding: 0;
            margin: 1rem auto;
            max-width: 500px;
        }

        .wish-text {
            margin-bottom: 1rem;
            font-family: 'Marck Script', cursive;
            font-size: 25px;
            line-height: 1.8;
            color: #333;
        }

        .wish-author {
            font-weight: 600;
            font-size: 13px;
            font-family: 'Spartan', sans-serif;
            color: #714d32;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-section {
            text-align: center;
            padding: 2rem;
            font-size: 12px;
            opacity: 0.5;
        }

        .footer-logo {
            width: 100px;
            opacity: 0.3;
            margin-top: 1rem;
        }

        .bottom-nav {
            position: fixed;
            bottom: 33px;
            left: 0;
            right: 0;
            max-width: 530px;
            margin: 0 auto;
            background: #e8dcc4;
            backdrop-filter: blur(10px);
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 1000;
        }

        .nav-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            color: #000;
            padding: 1rem;
            flex: 1;
        }

        .nav-btn img {
            width: 28px;
            height: 28px;
        }

        .prayer {
            position: relative;
            text-align: center;
            padding: 0 1rem 6rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .prayer .wrapper {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 85%;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .prayer-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            line-height: 1.8;
            color: #333;
            text-align: center;
            padding: 0 2rem;
        }

        .prayer img {
            width: 100%;
            height: 300px;
            object-fit: fill;
            position: relative;
            z-index: 1;
        }

        .section-divider {
            text-align: center;
            margin: 2rem 0;
            padding: 1rem 0;
        }

        .section-divider img {
            width: 100%;
            max-width: 400px;
            height: auto;
            opacity: 0.6;
        }

        .calendar-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }

        .calendar-modal.active {
            display: flex;
        }

        .calendar-modal-content {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .calendar-modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .calendar-modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .calendar-modal-datetime {
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            color: #666;
            margin-bottom: 2rem;
        }

        .calendar-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .calendar-btn {
            flex: 1;
            padding: 1rem;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            background: #f8f8f8;
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .calendar-btn:hover {
            background: #fff;
            border-color: #c0c0c0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .calendar-btn svg {
            width: 20px;
            height: 20px;
        }

        .wish-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }

        .wish-modal.active {
            display: flex;
        }

        .wish-modal-content {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .wish-modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wish-modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }

        .wish-success-message {
            text-align: center;
            padding: 2rem;
        }

        .wish-success-message h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: #714d32;
            margin-bottom: 1rem;
        }

        .wish-success-message p {
            font-family: 'Spartan', sans-serif;
            font-size: 15px;
            color: #666;
            line-height: 1.6;
        }

        .wish-display {
            background: rgba(255,192,203,0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .wish-display-text {
            font-family: 'Spartan', sans-serif;
            font-size: 15px;
            font-style: italic;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .wish-display-author {
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #714d32;
        }

        .wish-form-group {
            margin-bottom: 1.5rem;
        }

        .wish-form-label {
            font-family: 'Spartan', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #666;
            margin-bottom: 0.5rem;
            display: block;
        }

        .wish-form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .wish-form-input:focus {
            outline: none;
            border-color: #d4a574;
        }

        .wish-form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .wish-submit-btn {
            width: 100%;
            padding: 1rem;
            background: #714d32;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .wish-submit-btn:hover {
            background: #5a3d26;
        }

        .wish-submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .error-message {
            background: #fee;
            border: 1px solid #fcc;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            color: #c00;
        }

        .wishes-slider {
            position: relative;
            overflow: hidden;
        }

        .wishes-track {
            display: flex;
            transition: transform 0.5s ease;
        }

        .wish-slide {
            min-width: 100%;
            padding: 0 1rem;
        }

        .slider-arrow {
            display: none;
        }

        .wish-indicators {
            display: flex;
            justify-content: center;
            gap: 0.4rem;
            margin-top: 1.5rem;
        }

        .wish-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(113, 77, 50, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .wish-indicator:hover {
            background: rgba(113, 77, 50, 0.4);
        }

        .wish-indicator.active {
            background: #714d32;
            width: 24px;
            border-radius: 4px;
        }

        .contact-modal,
        .location-modal,
        .calendar-popup-modal,
        .wish-popup-modal {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 10000;
            pointer-events: none;
        }

        .contact-modal.active,
        .location-modal.active,
        .calendar-popup-modal.active,
        .wish-popup-modal.active {
            pointer-events: auto;
        }

        .contact-modal-content,
        .location-modal-content,
        .calendar-popup-content,
        .wish-popup-content {
            border-radius: 20px 20px 0 0;
            padding: 1.5rem;
            margin: 0 auto;
            width: 100%;
            max-width: 530px;
            position: absolute;
            bottom: 52px;
            left: 50%;
            overflow: hidden;
            pointer-events: auto;
            transform: translate(-50%, 150%);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .contact-modal.active .contact-modal-content,
        .location-modal.active .location-modal-content,
        .calendar-popup-modal.active .calendar-popup-content,
        .wish-popup-modal.active .wish-popup-content {
            transform: translate(-50%, 0);
        }

        .contact-modal-bg,
        .location-modal-bg,
        .calendar-popup-bg,
        .wish-popup-bg {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background: #f5ede0;
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            transition: backdrop-filter 0.5s, -webkit-backdrop-filter 0.5s;
            z-index: -1;
        }

        .contact-modal-content::before,
        .location-modal-content::before,
        .calendar-popup-content::before,
        .wish-popup-content::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 4px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 2px;
        }

        .contact-modal-title,
        .location-modal-title,
        .calendar-popup-title,
        .wish-popup-title {
            font-family: 'Spartan', sans-serif;
            font-size: 15px;
            font-weight: 600;
            margin: 1rem 0 1.5rem;
            color: #333;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .wish-popup-form-group {
            margin-bottom: 1rem;
        }

        .wish-popup-label {
            font-family: 'Spartan', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: #666;
            margin-bottom: 0.5rem;
            display: block;
        }

        .wish-popup-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-family: 'Spartan', sans-serif;
            font-size: 13px;
            background: rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .wish-popup-input:focus {
            outline: none;
            border-color: rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.8);
        }

        .wish-popup-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .wish-popup-submit {
            width: 100%;
            padding: 0.8rem;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Spartan', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .wish-popup-submit:hover {
            background: #555;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .wish-popup-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .wish-popup-error {
            background: #fee;
            border: 1px solid #fcc;
            border-radius: 8px;
            padding: 0.8rem;
            margin-bottom: 1rem;
            font-family: 'Spartan', sans-serif;
            font-size: 12px;
            color: #c00;
        }

        .calendar-date-display {
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            color: #333;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .calendar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding: 0 1rem;
        }

        .calendar-month-year {
            font-family: 'Spartan', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .calendar-nav-btn {
            background: transparent;
            border: none;
            font-size: 20px;
            color: #666;
            cursor: pointer;
            padding: 0.5rem;
        }

        .calendar-nav-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .calendar-grid {
            margin-bottom: 1.5rem;
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .calendar-weekday {
            font-family: 'Spartan', sans-serif;
            font-size: 11px;
            color: #666;
            text-align: center;
            padding: 0.3rem;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }

        .calendar-day {
            font-family: 'Spartan', sans-serif;
            font-size: 14px;
            color: #333;
            text-align: center;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
        }

        .calendar-day.other-month {
            color: #ccc;
        }

        .calendar-day.selected {
            background: #333;
            color: #fff;
            font-weight: 600;
        }

        .calendar-actions {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .calendar-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.8rem;
            background: transparent;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-family: 'Spartan', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #333;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .calendar-action-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .calendar-action-btn svg,
        .calendar-action-btn img {
            width: 20px;
            height: 20px;
        }

        .location-info {
            margin-bottom: 1.5rem;
        }

        .location-venue {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .location-address {
            font-family: 'Spartan', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
            text-align: center;
        }

        .location-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .location-btn {
            flex: 1;
            max-width: 150px;
            padding: 0.8rem;
            background: transparent;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            color: #333;
            font-family: 'Spartan', sans-serif;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .location-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .location-btn img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.2rem;
            padding: 0.5rem 0;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-info {
            flex: 1;
        }

        .contact-name {
            font-family: 'Spartan', sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: #333;
            margin: 0;
            line-height: 1.4;
        }

        .contact-role {
            font-family: 'Spartan', sans-serif;
            font-size: 11px;
            font-style: italic;
            color: #666;
            margin: 0.2rem 0 0 0;
        }

        .contact-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .contact-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            background: transparent;
            border: none;
            padding: 0;
        }

        .contact-btn img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }

        .contact-btn img[alt="Phone"] {
            width: 24px;
            height: 24px;
        }


        @media (max-width: 480px) {
            .cover-name {
                font-size: 28px;
            }

            .main-content {
                padding: 2rem 1rem;
            }

            .intro-text {
                font-size: 12px;
            }

            .parent-name {
                font-size: 16px;
            }

            .address-text {
                font-size: 12px;
            }

            .date-time-info {
                font-size: 12px;
            }

            .countdown-item {
                max-width: 70px;
            }

            .countdown-number {
                font-size: 1.2rem;
            }

            .prayer img {
                height: 420px;
            }

            .prayer .wrapper {
                top: 44%;
            }
        }

        .mb-5 { margin-bottom: 3rem; }
        .text-center { text-align: center; }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .cover-section .cover-content,
        .main-content > div,
        .container > footer,
        .container > nav {
            opacity: 0;
        }

        .container.revealed .cover-section .cover-content {
            opacity: 1;
            animation: fadeInUp 0.8s ease forwards;
        }

        .container.revealed .bottom-nav {
            opacity: 1;
        }

        .countdown-section.visible .section-title,
        .countdown-section.visible .countdown-grid {
            opacity: 1;
        }

        .wishes-section.visible .section-title,
        .wishes-section.visible .wish-item,
        .wishes-section.visible .text-center {
            opacity: 1;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #opening-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay-container {
            position: relative;
            width: 100%;
            max-width: 530px;
            height: 100vh;
            overflow: hidden;
        }

        .door {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            transition: transform 1s ease-in-out;
            will-change: transform;
        }

        .door-left {
            left: 0;
            transform-origin: left;
            border-right: 1px solid rgba(255, 255, 255, 0.5);
        }

        .door-right {
            right: 0;
            transform-origin: right;
            border-left: 1px solid rgba(255, 255, 255, 0.5);
        }

        .center-line {
            position: absolute;
            top: 0;
            left: 50%;
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom,
                transparent,
                rgba(255, 255, 255, 0.6) 20%,
                rgba(255, 255, 255, 0.6) 80%,
                transparent
            );
            transform: translateX(-50%);
            z-index: 1;
            transition: opacity 0.3s ease;
        }

        #opening-overlay.hide .door-left {
            transform: translateX(-100%);
        }

        #opening-overlay.hide .door-right {
            transform: translateX(100%);
        }

        #opening-overlay.hide .button-container {
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        #opening-overlay.hide .center-line {
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        #opening-overlay.hide {
            transition: opacity 0.3s ease 1s;
            opacity: 0;
            pointer-events: none;
        }

        .button-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10001;
        }

        .open-button {
            position: relative;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: #fff;
            border: none;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .open-button.loaded {
            animation: pulse 2s ease-in-out infinite;
        }

        .open-button::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid transparent;
            border-top-color: #8B6F47;
            border-right-color: #8B6F47;
            animation: spinner 0.8s linear infinite;
        }

        .open-button.loaded::after {
            display: none;
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            }
        }

        .open-button:hover {
            animation: none;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .open-button .names,
        .open-button .open-text {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .open-button.loaded .names,
        .open-button.loaded .open-text {
            opacity: 1;
        }

        .open-button .names {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 600;
            color: #8B6F47;
            text-align: center;
            line-height: 1.4;
            margin-bottom: 0.8rem;
            letter-spacing: 0.5px;
        }

        .open-button .open-text {
            font-family: 'Playfair Display', serif;
            font-size: 13px;
            color: #8B6F47;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Contact Modal -->
    <div class="contact-modal" id="contactModal">
        <div class="contact-modal-content">
            <div class="contact-modal-bg"></div>
            <h5 class="contact-modal-title">Hubungi</h5>

            <div class="contact-item">
                <div class="contact-info">
                    <p class="contact-name">Mohammed Rusli</p>
                </div>
                <div class="contact-buttons">
                    <a href="https://wa.me/60139101879" class="contact-btn" target="_blank">
                        <img src="{{ asset('images/icons/whatsapp.png') }}" alt="WhatsApp">
                    </a>
                    <a href="tel:+60139101879" class="contact-btn">
                        <img src="{{ asset('images/icons/phone-call.svg') }}" alt="Phone">
                    </a>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-info">
                    <p class="contact-name">Dihah</p>
                </div>
                <div class="contact-buttons">
                    <a href="https://wa.me/60139909137" class="contact-btn" target="_blank">
                        <img src="{{ asset('images/icons/whatsapp.png') }}" alt="WhatsApp">
                    </a>
                    <a href="tel:+60139909137" class="contact-btn">
                        <img src="{{ asset('images/icons/phone-call.svg') }}" alt="Phone">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Modal -->
    <div class="calendar-popup-modal" id="calendarPopupModal">
        <div class="calendar-popup-content">
            <div class="calendar-popup-bg"></div>
            <h5 class="calendar-popup-title">Calendar</h5>

            <p class="calendar-date-display">Sabtu, 27 Disember 2025</p>

            <div class="calendar-header">
                <button class="calendar-nav-btn" id="prevMonthBtn" onclick="previousMonth()">&lt;</button>
                <span class="calendar-month-year" id="calendarMonthYear">Dis 2025</span>
                <button class="calendar-nav-btn" id="nextMonthBtn" onclick="nextMonth()">&gt;</button>
            </div>

            <div class="calendar-grid">
                <div class="calendar-weekdays">
                    <div class="calendar-weekday">Ahd</div>
                    <div class="calendar-weekday">Isn</div>
                    <div class="calendar-weekday">Sel</div>
                    <div class="calendar-weekday">Rab</div>
                    <div class="calendar-weekday">Kha</div>
                    <div class="calendar-weekday">Jum</div>
                    <div class="calendar-weekday">Sab</div>
                </div>
                <div class="calendar-days" id="calendarDays"></div>
            </div>

            <div class="calendar-actions">
                <button class="calendar-action-btn" onclick="addToAppleCalendar()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                    </svg>
                    Add to Apple Calendar
                </button>
                <button class="calendar-action-btn" onclick="addToGoogleCalendar()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    </svg>
                    Add to Google Calendar
                </button>
            </div>
        </div>
    </div>

    <!-- Wish Popup Modal -->
    <div class="wish-popup-modal" id="wishPopupModal">
        <div class="wish-popup-content">
            <div class="wish-popup-bg"></div>
            <h5 class="wish-popup-title">Tulis Ucapan</h5>

            <div id="wishPopupErrorContainer"></div>

            <form id="wishPopupForm" onsubmit="submitWishPopup(event)">
                <div class="wish-popup-form-group">
                    <label class="wish-popup-label">Nama</label>
                    <input type="text" name="name" class="wish-popup-input" required maxlength="255">
                </div>
                <div class="wish-popup-form-group">
                    <label class="wish-popup-label">Ucapan</label>
                    <textarea name="message" class="wish-popup-input wish-popup-textarea" required maxlength="500"></textarea>
                </div>
                <button type="submit" class="wish-popup-submit" id="wishPopupSubmitBtn">Hantar Ucapan</button>
            </form>
        </div>
    </div>

    <!-- Location Modal -->
    <div class="location-modal" id="locationModal">
        <div class="location-modal-content">
            <div class="location-modal-bg"></div>
            <h5 class="location-modal-title">Lokasi</h5>

            <div class="location-info">
                <p class="location-venue">82 Cottage Homestay</p>
                <p class="location-address">
                    Bersebelahan, Taman Tengku Ahmad Rithauddeen,<br>
                    16400 Melor, Kelantan
                </p>
            </div>

            <div class="location-buttons">
                <a href="https://maps.app.goo.gl/HXtQLT5bzhRertD58" class="location-btn" target="_blank">
                    <img src="{{ asset('images/icons/google.png') }}" alt="Google Maps">
                    Maps
                </a>
                <a href="https://www.waze.com/en/live-map/directions/my/kelantan/melor/82-cottage-homestay?place=ChIJJbeTfKq9tjER6kxx7ry48Yc" class="location-btn" target="_blank">
                    <img src="{{ asset('images/icons/waze.png') }}" alt="Waze">
                    Waze
                </a>
            </div>
        </div>
    </div>

    <!-- Wish Modal -->
    <div class="wish-modal" id="wishModal">
        <div class="wish-modal-content">
            <button class="wish-modal-close" onclick="closeWishModal()">&times;</button>

            <div id="wishFormContainer">
                <h3 class="wish-modal-title">Tulis Ucapan</h3>
                <div id="errorContainer"></div>
                <form id="wishForm" onsubmit="submitWish(event)">
                    <div class="wish-form-group">
                        <label class="wish-form-label">Nama</label>
                        <input type="text" name="name" class="wish-form-input" required maxlength="255">
                    </div>
                    <div class="wish-form-group">
                        <label class="wish-form-label">Ucapan</label>
                        <textarea name="message" class="wish-form-input wish-form-textarea" required maxlength="500"></textarea>
                    </div>
                    <button type="submit" class="wish-submit-btn" id="submitWishBtn">Hantar Ucapan</button>
                </form>
            </div>

            <div id="wishSuccessContainer" style="display: none;">
                <div class="wish-success-message">
                    <h3>Thank you for your wishes!</h3>
                    <div class="wish-display" id="submittedWish">
                        <!-- Wish will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Modal -->
    <div class="calendar-modal" id="calendarModal">
        <div class="calendar-modal-content">
            <button class="calendar-modal-close" onclick="closeCalendarModal()">&times;</button>
            <h3 class="calendar-modal-title">Sabtu, 27 Disember 2025</h3>
            <p class="calendar-modal-datetime">11:00 PAGI - 6:00 PETANG</p>
            <div class="calendar-buttons">
                <button class="calendar-btn" onclick="addToAppleCalendar()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                    </svg>
                    Calendar
                </button>
                <button class="calendar-btn" onclick="addToGoogleCalendar()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    </svg>
                    Calendar
                </button>
            </div>
        </div>
    </div>

    <div id="opening-overlay">
        <div class="overlay-container">
            <div class="door door-left"></div>
            <div class="door door-right"></div>
            <div class="center-line"></div>
            <div class="button-container">
                <button class="open-button" id="openButton" onclick="openInvitation()">
                    <div class="names">MADIHAH<br>&<br>KHAIRUL</div>
                    <div class="open-text">OPEN</div>
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <section class="cover-section">
            <div class="cover-content">
                <p class="invitation-type">Walimatulurus</p>
                <h1 class="cover-name">MADIHAH</h1>
                <p class="and-text">&</p>
                <h1 class="cover-name">KHAIRUL</h1>
                <p class="cover-date">Sabtu<br>27 Disember 2025</p>
                <p class="cover-hashtag">#Dihatikhairul</p>
            </div>
        </section>

        <div class="section-divider animate-on-scroll">
            <img src="{{ asset('images/divider.svg') }}" alt="Divider">
        </div>

        <div class="main-content">
            <div class="intro-text animate-on-scroll">
                <p>ASSALAMUALAIKUM WBT & SALAM SEJAHTERA</p>
            </div>

            <div class="parents-section animate-on-scroll">
                <p class="parent-name">MOHAMED RUSLI BIN DAUD</p>
                <p class="parent-name">&</p>
                <p class="parent-name">WAN MAIMUN BINTI WAN YUSUF</p>
            </div>

            <div class="intro-text animate-on-scroll">
                <p>Dengan penuh kesyukuran kehadrat Illahi, kami mempersilakan Dato'/Datin/Dr/Tuan/Puan/Encik/Cik ke walimatulurus anakanda kesayangan kami</p>
            </div>

            <div class="parents-section animate-on-scroll">
                <p class="parent-name">WAN MADIHAH BINTI MOHAMED RUSLI</p>
                <p class="parent-name">&</p>
                <p class="parent-name">MUHAMMAD KHAIRUL IMRAN BIN YAAKUB</p>
            </div>

            <div class="event-section animate-on-scroll">
                <h5 class="section-title">TEMPAT</h5>
                <p class="venue-name">82 Cottage Homestay</p>
                <p class="address-text">
                    Bersebelahan, Taman Tengku Ahmad Rithauddeen,<br>
                    16400 Melor, Kelantan
                </p>
            </div>

            <div class="event-section animate-on-scroll">
                <h5 class="section-title">TARIKH</h5>
                <p class="date-time-info">Sabtu, 27 Disember 2025</p>
            </div>

            <div class="event-section animate-on-scroll">
                <h5 class="section-title">MASA</h5>
                <p class="date-time-info">11:00 PAGI - 6:00 PETANG</p>
            </div>

            <div class="text-center animate-on-scroll">
                <button class="btn" onclick="saveToCalendar()">Simpan Tarikh</button>
            </div>

            <div class="programme-section animate-on-scroll">
                <div class="programme-inner">
                    <h5 class="section-title" style="margin-bottom: 2rem;">ATURCARA MAJLIS</h5>

                    <div class="programme-item">
                        <div class="programme-time">12.00 Tengahari</div>
                        <div class="programme-desc">Majlis Bermula</div>
                    </div>

                    <div class="programme-item">
                        <div class="programme-time">3.00 Petang</div>
                        <div class="programme-desc">Ketibaan Pengantin</div>
                    </div>

                    <div class="programme-item">
                        <div class="programme-time">4.30 Petang</div>
                        <div class="programme-desc">Majlis Berakhir</div>
                    </div>
                </div>
            </div>

            <div class="text-center animate-on-scroll">
                <p style="font-size: 20px; font-family: 'Great Vibes', cursive;">#Dihatikhairul</p>
            </div>
        </div>

        <div class="section-divider animate-on-scroll">
            <img src="{{ asset('images/divider.svg') }}" alt="Divider">
        </div>

        <section class="countdown-section animate-on-scroll">
            <h5 class="section-title">MENGHITUNG HARI</h5>
            <div class="countdown-grid">
                <div class="countdown-item">
                    <div class="countdown-number" id="days">0</div>
                    <div class="countdown-label">Hari</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="hours">0</div>
                    <div class="countdown-label">Jam</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="minutes">0</div>
                    <div class="countdown-label">Minit</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="seconds">0</div>
                    <div class="countdown-label">Saat</div>
                </div>
            </div>
        </section>

        <div class="section-divider animate-on-scroll">
            <img src="{{ asset('images/divider.svg') }}" alt="Divider">
        </div>

        <section class="wishes-section animate-on-scroll">
            <h5 class="section-title">UCAPAN</h5>
            <div class="wishes-slider" id="wishesSlider">
                <div class="wishes-track" id="wishesTrack">
                    <!-- Wishes will be loaded here -->
                </div>
            </div>
            <div class="wish-indicators" id="wishIndicators"></div>
            <div class="text-center" style="margin-top: 2rem;">
                <button class="btn" onclick="openWishModal()">
                    <i class="fas fa-pen-nib"></i>
                    <span>Tulis Ucapan</span>
                </button>
            </div>
        </section>

        <div class="section-divider animate-on-scroll">
            <img src="{{ asset('images/divider.svg') }}" alt="Divider">
        </div>

        <section class="prayer animate-on-scroll">
            <div class="wrapper">
                <p class="prayer-text">
                    Ya Allah, berkatilah majlis perkahwinan ini, limpahkan baraqah dan rahmat kepada kedua mempelai ini, Kurniakanlah mereka zuriat yang soleh dan solehah. Kekalkanlah jodoh mereka di dunia dan di akhirat dan sempurnakanlah agama mereka dengan berkat ikatan ini.
                </p>
            </div>
            <img src="https://www.kahwinnow.com/storage/frame/RKyQEhQdr8RXc0tPDhHHhEPYL7ThvpnH55GxwSOo.png" alt="Prayer Frame">
        </section>

        <nav class="bottom-nav animate-on-scroll">
            <a href="#" class="nav-btn" onclick="openContactModal(); return false;">
                <img src="{{ asset('images/icons/phone.svg') }}" alt="Hubungi">
            </a>
            <a href="#" class="nav-btn" onclick="openCalendarPopup(); return false;">
                <img src="{{ asset('images/icons/rsvp.png') }}" alt="Calendar">
            </a>
            <a href="#" class="nav-btn" onclick="openLocationModal(); return false;">
                <img src="{{ asset('images/icons/location-dot.svg') }}" alt="Lokasi">
            </a>
            <a href="#" class="nav-btn" onclick="openWishPopup(); return false;">
                <img src="{{ asset('images/icons/gift.svg') }}" alt="Ucapan">
            </a>
        </nav>
    </div>

    <script>
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }
        window.scrollTo(0, 0);

        let bgMusic = null;

        window.addEventListener('load', function() {
            window.scrollTo(0, 0);
            const openButton = document.getElementById('openButton');

            bgMusic = new Audio('{{ asset('music/maher-zain-for-the-rest-of-my-life.mp3') }}');
            bgMusic.loop = true;
            bgMusic.volume = 0.5;

            setTimeout(() => {
                openButton.classList.add('loaded');
            }, 200);
        });

        let isAutoScrolling = false;
        let scrollAnimationId = null;

        function stopAutoScroll() {
            if (isAutoScrolling) {
                isAutoScrolling = false;
                if (scrollAnimationId) {
                    cancelAnimationFrame(scrollAnimationId);
                    scrollAnimationId = null;
                }
            }
        }

        window.addEventListener('wheel', stopAutoScroll, { passive: true });
        window.addEventListener('touchstart', stopAutoScroll, { passive: true });
        window.addEventListener('keydown', stopAutoScroll, { passive: true });

        function openInvitation() {
            const overlay = document.getElementById('opening-overlay');
            const buttonContainer = document.querySelector('.button-container');
            const centerLine = document.querySelector('.center-line');
            const container = document.querySelector('.container');

            // Enable scrolling
            document.body.classList.add('scroll-enabled');

            if (bgMusic) {
                bgMusic.play().catch(e => console.log('Audio play failed:', e));
            }

            buttonContainer.style.display = 'none';
            centerLine.style.opacity = '0';

            overlay.classList.add('hide');

            window.scrollTo(0, 0);

            setTimeout(() => {
                container.classList.add('revealed');

                setupScrollAnimations();
            }, 800);

            setTimeout(() => {
                isAutoScrolling = true;
                const scrollHeight = document.body.scrollHeight;
                const duration = 25000;
                const start = 0;
                const distance = scrollHeight - start;
                let startTime = null;

                function scrollAnimation(currentTime) {
                    if (!isAutoScrolling) return;

                    if (startTime === null) startTime = currentTime;
                    const timeElapsed = currentTime - startTime;
                    const progress = Math.min(timeElapsed / duration, 1);

                    window.scrollTo(0, start + (distance * progress));

                    if (timeElapsed < duration && isAutoScrolling) {
                        scrollAnimationId = requestAnimationFrame(scrollAnimation);
                    } else {
                        isAutoScrolling = false;
                    }
                }

                scrollAnimationId = requestAnimationFrame(scrollAnimation);
            }, 1200);

            setTimeout(() => {
                overlay.style.display = 'none';
            }, 1300);
        }

        function setupScrollAnimations() {
            const observerOptions = {
                root: null,
                rootMargin: '-50px 0px -50px 0px',
                threshold: [0, 0.2, 0.5]
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.intersectionRatio >= 0.2) {
                        entry.target.classList.add('visible');
                    } else if (!entry.isIntersecting) {
                        entry.target.classList.remove('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        }

        function updateCountdown() {
            const weddingDate = new Date('2025-12-27T11:00:00+08:00');
            const now = new Date();
            const timeDiff = weddingDate - now;

            if (timeDiff > 0) {
                const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = days;
                document.getElementById('hours').textContent = hours;
                document.getElementById('minutes').textContent = minutes;
                document.getElementById('seconds').textContent = seconds;
            } else {
                document.getElementById('days').textContent = '0';
                document.getElementById('hours').textContent = '0';
                document.getElementById('minutes').textContent = '0';
                document.getElementById('seconds').textContent = '0';
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        function saveToCalendar() {
            document.getElementById('calendarModal').classList.add('active');
        }

        function closeCalendarModal() {
            document.getElementById('calendarModal').classList.remove('active');
        }

        function addToAppleCalendar() {
            const eventTitle = 'Walimatulurus - Madihah & Khairul';
            const eventLocation = 'LOT 2143(B), TAMAN TENGKU AHMAD RITHAUDEEN, 16400, MELOR, KOTA BHARU, KELANTAN';
            const eventDetails = 'Walimatulurus Wan Madihah binti Mohamed Rusli & Muhammad Khairul Imran bin Yaakub';
            const startDate = '20251227T110000';
            const endDate = '20251227T180000';

            const icalContent = `BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Wedding Invitation//EN
BEGIN:VEVENT
DTSTART:${startDate}
DTEND:${endDate}
SUMMARY:${eventTitle}
DESCRIPTION:${eventDetails}
LOCATION:${eventLocation}
STATUS:CONFIRMED
END:VEVENT
END:VCALENDAR`;

            const blob = new Blob([icalContent], { type: 'text/calendar;charset=utf-8' });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'walimatulurus-madihah-khairul.ics';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            closeCalendarModal();
        }

        function addToGoogleCalendar() {
            const eventTitle = 'Walimatulurus - Madihah & Khairul';
            const eventLocation = 'LOT 2143(B), TAMAN TENGKU AHMAD RITHAUDEEN, 16400, MELOR, KOTA BHARU, KELANTAN';
            const eventDetails = 'Walimatulurus Wan Madihah binti Mohamed Rusli & Muhammad Khairul Imran bin Yaakub';
            const startDate = '20251227T110000';
            const endDate = '20251227T180000';

            const googleCalendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(eventTitle)}&dates=${startDate}/${endDate}&details=${encodeURIComponent(eventDetails)}&location=${encodeURIComponent(eventLocation)}`;

            window.open(googleCalendarUrl, '_blank');
            closeCalendarModal();
        }

        // Close modal when clicking outside
        document.getElementById('calendarModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCalendarModal();
            }
        });

        // Wish Modal Functions
        function openWishModal() {
            document.getElementById('wishModal').classList.add('active');
        }

        function closeWishModal() {
            document.getElementById('wishModal').classList.remove('active');
            document.getElementById('wishForm').reset();
            document.getElementById('errorContainer').innerHTML = '';
            // Reset to form view
            document.getElementById('wishFormContainer').style.display = 'block';
            document.getElementById('wishSuccessContainer').style.display = 'none';
        }

        function showError(message) {
            const errorContainer = document.getElementById('errorContainer');
            errorContainer.innerHTML = `<div class="error-message">${message}</div>`;
        }

        function clearError() {
            document.getElementById('errorContainer').innerHTML = '';
        }

        async function submitWish(event) {
            event.preventDefault();

            clearError();
            const submitBtn = document.getElementById('submitWishBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menghantar...';

            const form = event.target;
            const formData = new FormData(form);
            const data = {
                name: formData.get('name'),
                message: formData.get('message')
            };

            try {
                const response = await fetch('/api/wishes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Hide form, show success message with wish
                    document.getElementById('wishFormContainer').style.display = 'none';
                    document.getElementById('wishSuccessContainer').style.display = 'block';

                    // Display the submitted wish
                    document.getElementById('submittedWish').innerHTML = `
                        <p class="wish-display-text">"${result.wish.message}"</p>
                        <p class="wish-display-author">- ${result.wish.name}</p>
                    `;

                    // Reload wishes to include the new one in slider
                    loadWishes();

                    // Auto close after 3 seconds
                    setTimeout(() => {
                        closeWishModal();
                    }, 3000);
                } else {
                    showError(result.message || 'Maaf, terdapat masalah. Sila cuba lagi.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Hantar Ucapan';
                }
            } catch (error) {
                showError('Maaf, terdapat masalah sambungan. Sila cuba lagi.');
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.textContent = 'Hantar Ucapan';
            }
        }

        // Close wish modal when clicking outside
        document.getElementById('wishModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeWishModal();
            }
        });

        // Load and display wishes
        let currentWishIndex = 0;
        let wishes = [];
        let autoSlideInterval = null;

        async function loadWishes() {
            try {
                const response = await fetch('/api/wishes');
                wishes = await response.json();
                displayWishes();
                updateIndicators();
                updateArrows();
                if (wishes.length > 1) {
                    startWishSlider();
                }
            } catch (error) {
                console.error('Error loading wishes:', error);
            }
        }

        function displayWishes() {
            const track = document.getElementById('wishesTrack');

            if (wishes.length === 0) {
                track.innerHTML = `
                    <div class="wish-slide">
                        <div class="wish-item">
                            <p class="wish-text">"Tahniah dan semoga berbahagia!"</p>
                            <p class="wish-author">- Tetamu</p>
                        </div>
                    </div>
                `;
                return;
            }

            track.innerHTML = wishes.map(wish => `
                <div class="wish-slide">
                    <div class="wish-item">
                        <p class="wish-text">"${wish.message}"</p>
                        <p class="wish-author">- ${wish.name}</p>
                    </div>
                </div>
            `).join('');
        }

        function updateIndicators() {
            const container = document.getElementById('wishIndicators');

            if (wishes.length <= 1) {
                container.innerHTML = '';
                return;
            }

            container.innerHTML = wishes.map((_, index) =>
                `<div class="wish-indicator ${index === currentWishIndex ? 'active' : ''}" onclick="goToWish(${index})"></div>`
            ).join('');
        }

        function updateArrows() {
            const prevBtn = document.getElementById('prevWish');
            const nextBtn = document.getElementById('nextWish');

            if (wishes.length <= 1 || !prevBtn || !nextBtn) return;

            if (currentWishIndex === 0) {
                prevBtn.classList.add('disabled');
            } else {
                prevBtn.classList.remove('disabled');
            }

            if (currentWishIndex === wishes.length - 1) {
                nextBtn.classList.add('disabled');
            } else {
                nextBtn.classList.remove('disabled');
            }
        }

        function changeWish(direction) {
            if (wishes.length <= 1) return;

            const newIndex = currentWishIndex + direction;

            if (newIndex < 0 || newIndex >= wishes.length) return;

            currentWishIndex = newIndex;
            updateSlider();
            resetAutoSlide();
        }

        function goToWish(index) {
            if (wishes.length <= 1) return;
            currentWishIndex = index;
            updateSlider();
            resetAutoSlide();
        }

        function updateSlider() {
            const track = document.getElementById('wishesTrack');
            track.style.transform = `translateX(-${currentWishIndex * 100}%)`;
            updateIndicators();
            updateArrows();
        }

        function startWishSlider() {
            autoSlideInterval = setInterval(() => {
                currentWishIndex = (currentWishIndex + 1) % wishes.length;
                updateSlider();
            }, 5000); // Change every 5 seconds
        }

        function resetAutoSlide() {
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
                startWishSlider();
            }
        }

        // Load wishes on page load
        window.addEventListener('load', loadWishes);

        // Close all modals
        function closeAllModals() {
            document.getElementById('contactModal').classList.remove('active');
            document.getElementById('locationModal').classList.remove('active');
            document.getElementById('calendarPopupModal').classList.remove('active');
            document.getElementById('wishPopupModal').classList.remove('active');
        }

        // Wish Popup Modal Functions
        function openWishPopup() {
            closeAllModals();
            document.getElementById('wishPopupModal').classList.add('active');
        }

        function closeWishPopup() {
            document.getElementById('wishPopupModal').classList.remove('active');
            document.getElementById('wishPopupForm').reset();
            document.getElementById('wishPopupErrorContainer').innerHTML = '';
        }

        function showWishPopupError(message) {
            const errorContainer = document.getElementById('wishPopupErrorContainer');
            errorContainer.innerHTML = `<div class="wish-popup-error">${message}</div>`;
        }

        function clearWishPopupError() {
            document.getElementById('wishPopupErrorContainer').innerHTML = '';
        }

        async function submitWishPopup(event) {
            event.preventDefault();

            clearWishPopupError();
            const submitBtn = document.getElementById('wishPopupSubmitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menghantar...';

            const form = event.target;
            const formData = new FormData(form);
            const data = {
                name: formData.get('name'),
                message: formData.get('message')
            };

            try {
                const response = await fetch('/api/wishes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Reload wishes to include the new one
                    loadWishes();

                    // Close modal and reset form
                    closeWishPopup();

                    // Reset button
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Hantar Ucapan';
                } else {
                    showWishPopupError(result.message || 'Maaf, terdapat masalah. Sila cuba lagi.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Hantar Ucapan';
                }
            } catch (error) {
                showWishPopupError('Maaf, terdapat masalah sambungan. Sila cuba lagi.');
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.textContent = 'Hantar Ucapan';
            }
        }

        // Close wish popup modal when clicking outside
        document.getElementById('wishPopupModal').addEventListener('click', function(e) {
            if (e.target === this || !document.querySelector('.wish-popup-content').contains(e.target)) {
                closeWishPopup();
            }
        });

        // Calendar variables
        let currentCalendarMonth = 11; // December (0-indexed)
        let currentCalendarYear = 2025;
        const weddingDate = new Date(2025, 11, 27); // December 27, 2025

        // Calendar Modal Functions
        function openCalendarPopup() {
            closeAllModals();
            document.getElementById('calendarPopupModal').classList.add('active');
            renderCalendar();
        }

        function closeCalendarPopup() {
            document.getElementById('calendarPopupModal').classList.remove('active');
        }

        function previousMonth() {
            currentCalendarMonth--;
            if (currentCalendarMonth < 0) {
                currentCalendarMonth = 11;
                currentCalendarYear--;
            }
            renderCalendar();
        }

        function nextMonth() {
            currentCalendarMonth++;
            if (currentCalendarMonth > 11) {
                currentCalendarMonth = 0;
                currentCalendarYear++;
            }
            renderCalendar();
        }

        function renderCalendar() {
            const monthNames = ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogo', 'Sep', 'Okt', 'Nov', 'Dis'];
            document.getElementById('calendarMonthYear').textContent = `${monthNames[currentCalendarMonth]} ${currentCalendarYear}`;

            const firstDay = new Date(currentCalendarYear, currentCalendarMonth, 1).getDay();
            const daysInMonth = new Date(currentCalendarYear, currentCalendarMonth + 1, 0).getDate();
            const prevMonthDays = new Date(currentCalendarYear, currentCalendarMonth, 0).getDate();

            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';

            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = document.createElement('div');
                day.className = 'calendar-day other-month';
                day.textContent = prevMonthDays - i;
                calendarDays.appendChild(day);
            }

            // Current month days
            for (let i = 1; i <= daysInMonth; i++) {
                const day = document.createElement('div');
                day.className = 'calendar-day';
                day.textContent = i;

                // Check if this is the wedding date
                if (currentCalendarYear === weddingDate.getFullYear() &&
                    currentCalendarMonth === weddingDate.getMonth() &&
                    i === weddingDate.getDate()) {
                    day.classList.add('selected');
                }

                calendarDays.appendChild(day);
            }

            // Next month days
            const totalCells = calendarDays.children.length;
            const remainingCells = 42 - totalCells; // 6 rows * 7 days
            for (let i = 1; i <= remainingCells; i++) {
                const day = document.createElement('div');
                day.className = 'calendar-day other-month';
                day.textContent = i;
                calendarDays.appendChild(day);
            }

            // Disable navigation buttons
            const prevBtn = document.getElementById('prevMonthBtn');
            const nextBtn = document.getElementById('nextMonthBtn');

            // Always disable both buttons to lock on current month
            prevBtn.disabled = true;
            nextBtn.disabled = true;
        }

        // Contact Modal Functions
        function openContactModal() {
            closeAllModals();
            document.getElementById('contactModal').classList.add('active');
        }

        function closeContactModal() {
            document.getElementById('contactModal').classList.remove('active');
        }

        // Close contact modal when clicking outside the modal content
        document.getElementById('contactModal').addEventListener('click', function(e) {
            if (e.target === this || !document.querySelector('.contact-modal-content').contains(e.target)) {
                closeContactModal();
            }
        });

        // Location Modal Functions
        function openLocationModal() {
            closeAllModals();
            document.getElementById('locationModal').classList.add('active');
        }

        function closeLocationModal() {
            document.getElementById('locationModal').classList.remove('active');
        }

        // Close location modal when clicking outside the modal content
        document.getElementById('locationModal').addEventListener('click', function(e) {
            if (e.target === this || !document.querySelector('.location-modal-content').contains(e.target)) {
                closeLocationModal();
            }
        });

        // Close calendar modal when clicking outside
        document.getElementById('calendarPopupModal').addEventListener('click', function(e) {
            if (e.target === this || !document.querySelector('.calendar-popup-content').contains(e.target)) {
                closeCalendarPopup();
            }
        });

        // Close all modals when clicking anywhere on the page
        document.addEventListener('click', function(e) {
            const contactModal = document.getElementById('contactModal');
            const locationModal = document.getElementById('locationModal');
            const calendarPopupModal = document.getElementById('calendarPopupModal');
            const wishPopupModal = document.getElementById('wishPopupModal');
            const navBtns = document.querySelectorAll('.nav-btn');

            // Check if click is outside modals and not on navigation buttons
            let isNavClick = false;
            navBtns.forEach(btn => {
                if (btn.contains(e.target)) {
                    isNavClick = true;
                }
            });

            if (!isNavClick) {
                if (contactModal.classList.contains('active') &&
                    (e.target === contactModal || !document.querySelector('.contact-modal-content').contains(e.target))) {
                    closeContactModal();
                }
                if (locationModal.classList.contains('active') &&
                    (e.target === locationModal || !document.querySelector('.location-modal-content').contains(e.target))) {
                    closeLocationModal();
                }
                if (calendarPopupModal.classList.contains('active') &&
                    (e.target === calendarPopupModal || !document.querySelector('.calendar-popup-content').contains(e.target))) {
                    closeCalendarPopup();
                }
                if (wishPopupModal.classList.contains('active') &&
                    (e.target === wishPopupModal || !document.querySelector('.wish-popup-content').contains(e.target))) {
                    closeWishPopup();
                }
            }
        });
    </script>
</body>
</html>
