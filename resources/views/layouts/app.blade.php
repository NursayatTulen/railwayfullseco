<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'he' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Еко Хаб Kazakhstan')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Outfit:wght@300;400;600;800&family=Heebo:wght@300;400;700;900&family=Rubik:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        :root {
            --primary: #10b981;
            --primary-light: #34d399;
            --primary-glow: rgba(16, 185, 129, 0.4);
            --accent: #fbbf24;
            --bg-dark: #020617;
            --glass: rgba(15, 23, 42, 0.4);
            --border: rgba(255, 255, 255, 0.08);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --sidebar-width: 280px;
            --font-main: {{ app()->getLocale() == 'he' ? "'Heebo', sans-serif" : "'Outfit', sans-serif" }};
            --font-serif: {{ app()->getLocale() == 'he' ? "'Rubik', sans-serif" : "'Playfair Display', serif" }};
        }

        * { margin: 0; padding: 0; box-sizing: border-box; cursor: default; }
        a, button, input, select { cursor: pointer; }

        body {
            font-family: var(--font-main);
            background: {{ request()->is('/') ? 'transparent' : '#011c14' }};
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            background-attachment: fixed;
            @if(!request()->is('/'))
            background-image: 
                radial-gradient(circle at 10% 10%, rgba(16, 185, 129, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(52, 211, 153, 0.08) 0%, transparent 40%);
            @endif
        }

        body::before, body::after {
            content: "";
            position: fixed;
            width: 800px; height: 800px;
            border-radius: 50%;
            filter: blur(150px);
            z-index: -1;
            opacity: 0.4;
            animation: aurora 30s infinite alternate cubic-bezier(0.45, 0, 0.55, 1);
        }
        body::before { background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%); top: -200px; left: -200px; }
        body::after { background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, transparent 70%); bottom: -200px; right: -200px; animation-delay: -15s; }

        @keyframes aurora {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(20%, 20%) scale(1.2); }
        }

        .app-container {
            display: flex;
            padding: 25px;
            gap: 25px;
            height: 100vh;
            width: 100vw;
            transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-toggle { display: none; }
        img { max-width: 100%; height: auto; }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--glass);
            backdrop-filter: blur(40px) saturate(200%);
            border: 1px solid var(--border);
            border-radius: 40px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 40px 100px rgba(0,0,0,0.4), inset 0 0 20px rgba(255,255,255,0.02);
            transition: 0.5s;
            position: relative;
        }

        .sidebar::after {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            border-radius: 40px;
            border: 1px solid rgba(255,255,255,0.05);
            pointer-events: none;
        }

        .sidebar-header { padding: 50px 30px; text-align: center; }
        .sidebar-logo { height: 60px; filter: drop-shadow(0 0 20px var(--primary-glow)); margin-bottom: 20px; }
        .sidebar-text {
            font-family: var(--font-serif);
            font-size: 2.2rem;
            font-weight: 900;
            letter-spacing: -1px;
            background: linear-gradient(135deg, #fff 30%, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-menu { flex: 1; padding: 0 25px; }
        .sidebar-nav { list-style: none; display: flex; flex-direction: column; gap: 15px; }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 18px 25px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 25px;
            font-weight: 700;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid transparent;
        }

        .sidebar-link:hover, .sidebar-link.active {
            color: white;
            background: rgba(255,255,255,0.03);
            border-color: var(--border);
            transform: scale(1.05) translateX(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        [dir="rtl"] .sidebar-link:hover, [dir="rtl"] .sidebar-link.active { transform: scale(1.05) translateX(-10px); }

        .sidebar-link i { font-size: 1.3rem; color: var(--primary); opacity: 0.7; transition: 0.4s; }
        .sidebar-link:hover i, .sidebar-link.active i { opacity: 1; transform: rotate(10deg) scale(1.2); }

        .nav-node-container {
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .nav-node {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 25px;
            text-decoration: none;
            transition: 0.5s;
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
        }
        .nav-node::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 5px; height: 100%;
            background: var(--primary);
            transform: scaleY(0);
            transition: 0.4s;
        }
        .nav-node:hover, .nav-node.active {
            background: rgba(16, 185, 129, 0.05);
            border-color: var(--primary);
            transform: translateX(10px);
        }
        .nav-node:hover::before, .nav-node.active::before { transform: scaleY(1); }
        .nav-node-icon {
            width: 50px; height: 50px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--primary);
        }
        .nav-node-label {
            font-weight: 800;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.8rem;
        }

        .sidebar-footer { padding: 30px 25px; }

        .footer-premium {
            padding: 100px 50px;
            background: rgba(2, 6, 23, 0.8);
            backdrop-filter: blur(40px);
            border-top: 1px solid var(--border);
            position: relative;
            z-index: 10;
        }
        .footer-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 80px;
        }
        .footer-logo { font-family: var(--font-serif); font-size: 2.5rem; font-weight: 900; margin-bottom: 20px; color: white; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { color: var(--text-secondary); text-decoration: none; transition: 0.3s; font-size: 0.9rem; }
        .footer-links a:hover { color: var(--primary); padding-left: 10px; }
        .footer-glow {
            position: absolute;
            bottom: 0; left: 50%; transform: translateX(-50%);
            width: 80%; height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            box-shadow: 0 0 50px var(--primary-glow);
        }

        .sidebar.home-special {
            width: 100px;
            background: transparent;
            border: none;
            box-shadow: none;
            backdrop-filter: none;
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
        }
        .home-special .sidebar-header, .home-special .sidebar-footer { display: none; }
        .home-special .nav-node-container { gap: 40px; }
        .home-special .nav-node {
            width: 80px; height: 80px;
            padding: 0;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .home-special .nav-node-label { display: none; }
        .home-special .nav-node-icon { background: transparent; width: 100%; height: 100%; font-size: 1.8rem; }
        .home-special .nav-node:hover { transform: scale(1.2) rotate(360deg); background: var(--primary); color: white; }
        .home-special .nav-node:hover .nav-node-icon { color: white; }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            border-radius: 40px;
            background: rgba(15, 23, 42, 0.2);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            box-shadow: inset 0 0 100px rgba(0,0,0,0.2);
            position: relative;
            scrollbar-gutter: stable;
            transition: 0.5s;
        }
        .main-wrapper.full-width { border-radius: 0; border: none; background: transparent; backdrop-filter: none; }

        .top-header {
            height: 100px;
            padding: 0 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(2, 6, 23, 0.5);
            backdrop-filter: blur(25px) saturate(180%);
            border-bottom: 1px solid var(--border);
            z-index: 100;
            position: sticky;
            top: 0;
        }

        .main-content {
            padding: 60px 8%;
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
        }

        .btn {
            background: linear-gradient(135deg, var(--primary), #059669);
            color: white;
            padding: 18px 40px;
            border-radius: 25px;
            border: none;
            font-weight: 800;
            transition: 0.5s;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px var(--primary-glow);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.8rem;
        }

        .btn::before {
            content: "";
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 25px 50px var(--primary-glow);
            filter: brightness(1.1);
        }

        .btn:hover::before { left: 100%; }

        .btn-outline {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            color: var(--text-primary);
            box-shadow: none;
        }

        .btn-outline:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--primary);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.2);
        }

        .card {
            background: var(--glass);
            backdrop-filter: blur(30px);
            border: 1px solid var(--border);
            border-radius: 45px;
            padding: 4rem;
            transition: 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        }

        .card:hover {
            transform: translateY(-20px) scale(1.02);
            border-color: rgba(255,255,255,0.2);
            box-shadow: 0 50px 100px rgba(0,0,0,0.5);
        }

        .section-title {
            font-family: var(--font-serif);
            font-size: 5rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 2.5rem;
            background: linear-gradient(to right, #fff, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -3px;
        }

        .lang-switcher { display: flex; gap: 8px; background: rgba(255,255,255,0.03); padding: 6px; border-radius: 20px; border: 1px solid var(--border); }
        .lang-btn {
            font-weight: 800; padding: 10px 15px; border-radius: 14px;
            color: var(--text-secondary);
            text-decoration: none; transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); font-size: 0.7rem;
            border: 1px solid transparent;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .lang-btn.active { background: var(--primary); color: white; border-color: var(--primary-light); box-shadow: 0 0 25px var(--primary-glow); transform: scale(1.1); }
        .lang-btn:hover:not(.active) { background: rgba(255,255,255,0.05); color: white; transform: translateY(-2px); }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(var(--primary), #3b82f6); border-radius: 10px; }

        [dir="rtl"] { text-align: right; }
        [dir="rtl"] .top-header { flex-direction: row-reverse; }

        .fade-in { animation: fadeIn 1.2s cubic-bezier(0.23, 1, 0.32, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

        .hud-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0.7;
        }
        .hud-line { height: 1px; background: linear-gradient(90deg, var(--primary), transparent); flex: 1; }

        .scan-line {
            position: absolute; width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            top: 0; animation: scan 4s infinite linear; opacity: 0.2; z-index: 10;
        }
        @keyframes scan { 0% { top: 0; } 100% { top: 100%; } }

        /* ── Badge ─────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: 50px;
            font-size: 0.72rem; font-weight: 800;
            text-transform: uppercase; letter-spacing: 1.5px;
            white-space: nowrap;
        }
        .badge-gold  { background: rgba(251,191,36,0.12); border: 1px solid rgba(251,191,36,0.35); color: #fbbf24; }
        .badge-blue  { background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.35); color: #60a5fa; }
        .badge-primary { background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.35); color: var(--primary); }
        .badge-red   { background: rgba(244,63,94,0.12);  border: 1px solid rgba(244,63,94,0.35);  color: #f43f5e; }
        .badge-rose  { background: rgba(225,29,72,0.12);  border: 1px solid rgba(225,29,72,0.35);  color: #fb7185; }

        /* ── Forms ─────────────────────────────────── */
        .section-subtitle { color: var(--text-secondary); font-size: 1.05rem; font-weight: 300; margin-top: -0.5rem; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1.8rem; }
        .form-label {
            display: block; margin-bottom: 10px;
            font-size: 0.78rem; color: var(--text-secondary);
            text-transform: uppercase; letter-spacing: 2px; font-weight: 700;
        }
        .form-input {
            width: 100%; padding: 16px 22px;
            background: rgba(2,6,23,0.6);
            border: 1px solid var(--border);
            border-radius: 18px;
            color: white; font-size: 1rem;
            font-family: var(--font-main);
            outline: none; transition: 0.3s;
            resize: vertical;
        }
        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }
        .form-error { color: #f43f5e; font-size: 0.82rem; margin-top: 8px; font-weight: 700; }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #059669);
            color: white; padding: 15px 35px; border-radius: 18px;
            border: none; font-weight: 800; cursor: pointer;
            display: inline-flex; align-items: center; gap: 10px;
            text-decoration: none; font-size: 0.9rem;
            letter-spacing: 1px; transition: 0.4s;
            box-shadow: 0 10px 30px var(--primary-glow);
        }
        .btn-primary:hover { transform: translateY(-4px); filter: brightness(1.1); }
        .btn-secondary {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 15px 35px; border-radius: 18px;
            font-weight: 700; cursor: pointer;
            display: inline-flex; align-items: center; gap: 10px;
            text-decoration: none; font-size: 0.9rem; transition: 0.4s;
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.2); }

        /* ── Grid ──────────────────────────────────── */
        .rtl-text { text-align: right; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 28px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; }

        /* ── Responsive ────────────────────────────── */
        @media (max-width: 1400px) {
            .grid-4 { grid-template-columns: repeat(3, 1fr); }
            .grid-3 { grid-template-columns: repeat(2, 1fr); }
            .section-title { font-size: 3.8rem; }
        }
        @media (max-width: 1100px) {
            .grid-4 { grid-template-columns: repeat(2, 1fr); }
            .grid-2 { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 40px; }
            --sidebar-width: 240px;
        }
        @media (max-width: 900px) {
            .app-container { padding: 0; gap: 0; display: block; height: auto; min-height: 100vh; }
            .sidebar {
                position: fixed; 
                top: 0; 
                bottom: 0;
                width: 280px !important;
                z-index: 2000; 
                display: flex !important;
                background: rgba(10,15,35,0.95) !important;
                backdrop-filter: blur(30px) !important;
                transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                border-radius: 0 !important;
                box-shadow: 0 0 50px rgba(0,0,0,0.5);
            }
            
            /* LTR: Slide from left */
            [dir="ltr"] .sidebar { left: 0; transform: translateX(-100%); }
            [dir="ltr"] .sidebar.active { transform: translateX(0); }
            
            /* RTL: Slide from right */
            [dir="rtl"] .sidebar { right: 0; transform: translateX(100%); }
            [dir="rtl"] .sidebar.active { transform: translateX(0); }

            .main-wrapper { border-radius: 0; border: none; width: 100%; min-height: 100vh; }
            .top-header { height: 80px; padding: 0 20px; display: flex !important; align-items: center; justify-content: space-between; }
            
            .mobile-toggle {
                display: flex !important;
                align-items: center; justify-content: center;
                width: 50px; height: 50px;
                background: rgba(255,255,255,0.05); 
                border: 1px solid var(--border);
                border-radius: 16px; 
                color: var(--primary); 
                font-size: 1.4rem;
                cursor: pointer;
                z-index: 1001;
                transition: 0.3s;
            }
            .mobile-toggle:active { transform: scale(0.9); background: var(--primary-glow); }

            /* Remove bottom bar behavior on home for mobile to avoid confusion */
            .sidebar.home-special {
                position: fixed !important;
                top: 0 !important;
                bottom: 0 !important;
                height: 100vh !important;
                width: 280px !important;
            }
            .home-special .sidebar-header, .home-special .sidebar-footer { display: flex !important; }
            .home-special .nav-node-container { flex-direction: column !important; padding: 0 25px !important; gap: 15px !important; }
            .home-special .nav-node { width: 100% !important; height: auto !important; border-radius: 25px !important; padding: 18px 25px !important; justify-content: flex-start !important; }
            .home-special .nav-node-label { display: block !important; }
            .home-special .nav-node-icon { width: auto !important; font-size: 1.3rem !important; }
            
            .section-title { font-size: 2.6rem; letter-spacing: -1px; }
            .card { padding: 1.8rem; border-radius: 28px; }
        }
        @media (max-width: 600px) {
            .grid-4, .grid-3, .grid-2 { grid-template-columns: 1fr; gap: 16px; }
            .section-title { font-size: 2rem; letter-spacing: -1px; }
            .card { padding: 1.4rem; border-radius: 22px; }
            .main-content { padding: 20px 12px; }
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            .top-header { gap: 8px; height: 64px; padding: 0 12px; }
            .lang-switcher { gap: 4px; }
            .lang-btn { padding: 8px 10px; font-size: 0.65rem; }
            .footer-premium { padding: 40px 16px; }
            .btn { padding: 13px 24px; font-size: 0.75rem; letter-spacing: 1px; }
            .btn-primary, .btn-secondary { padding: 13px 22px; font-size: 0.85rem; }
        }
        @media (max-width: 400px) {
            .lang-switcher { display: none; }
            .section-title { font-size: 1.7rem; }
            .top-header { padding: 0 10px; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.querySelector('.mobile-toggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.createElement('div');
            
            overlay.style.cssText = 'position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); z-index: 999; display: none; opacity: 0; transition: 0.5s;';
            document.body.appendChild(overlay);

            if (toggle && sidebar) {
                toggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    if (sidebar.classList.contains('active')) {
                        overlay.style.display = 'block';
                        setTimeout(() => overlay.style.opacity = '1', 10);
                    } else {
                        overlay.style.opacity = '0';
                        setTimeout(() => overlay.style.display = 'none', 500);
                    }
                });

                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.style.opacity = '0';
                    setTimeout(() => overlay.style.display = 'none', 500);
                });
            }
        });
    </script>
</head>
<body>

    <div class="app-container" style="{{ request()->is('/') ? 'padding: 0; gap: 0;' : '' }}">
        <aside class="sidebar {{ request()->is('/') ? 'home-special' : '' }}">
            <div class="sidebar-header">
                <a href="{{ url('/') }}" style="text-decoration: none;">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="sidebar-logo" onerror="this.src='https://cdn-icons-png.flaticon.com/512/892/892926.png'">
                    <div class="sidebar-text">{{ __('EcoHub') }}</div>
                </a>
            </div>

            <div class="sidebar-menu">
                <div class="nav-node-container">
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-node {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <div class="nav-node-icon"><i class="fas fa-shapes"></i></div>
                            <div class="nav-node-label">{{ __('Dashboard') }}</div>
                        </a>
                        <a href="{{ route('eco-projects.index') }}" class="nav-node {{ request()->routeIs('eco-projects.*') ? 'active' : '' }}">
                            <div class="nav-node-icon"><i class="fas fa-leaf"></i></div>
                            <div class="nav-node-label">{{ __('Eco Projects') }}</div>
                        </a>
                        <a href="{{ route('eco-events.index') }}" class="nav-node {{ request()->routeIs('eco-events.*') ? 'active' : '' }}">
                            <div class="nav-node-icon"><i class="fas fa-meteor"></i></div>
                            <div class="nav-node-label">{{ __('Events') }}</div>
                        </a>
                        @hasanyrole('super-admin|admin|moderator')
                        <a href="{{ route('upload.index') }}" class="nav-node {{ request()->routeIs('upload.index') ? 'active' : '' }}">
                            <div class="nav-node-icon"><i class="fas fa-fingerprint"></i></div>
                            <div class="nav-node-label">{{ __('Security') }}</div>
                        </a>
                        @endhasanyrole
                    @else
                        <a href="{{ url('/') }}" class="nav-node {{ request()->is('/') ? 'active' : '' }}">
                            <div class="nav-node-icon"><i class="fas fa-compass"></i></div>
                            <div class="nav-node-label">{{ __('Explore') }}</div>
                        </a>
                        <a href="{{ route('login') }}" class="nav-node {{ request()->routeIs('login') ? 'active' : '' }}">
                            <div class="nav-node-icon"><i class="fas fa-key"></i></div>
                            <div class="nav-node-label">{{ __('Access') }}</div>
                        </a>
                    @endauth
                </div>
            </div>

            <div class="sidebar-footer" style="padding: 20px; border-top: 1px solid var(--border);">
                @auth
                    <div class="nav-user" style="display: flex; align-items: center; gap: 15px; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 20px;">
                        <div class="nav-avatar" style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <div style="flex: 1; overflow: hidden;">
                            <div style="font-weight: 800; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 0.6rem; color: var(--primary); text-transform: uppercase;">{{ Auth::user()->getRoleNames()->first() }}</div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" style="background: transparent; border: none; color: #f43f5e; cursor: pointer; padding: 10px; font-size: 1.2rem;">
                                <i class="fas fa-power-off"></i>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </aside>

        <div class="main-wrapper {{ request()->is('/') ? 'full-width' : '' }}">
            <header class="top-header" style="{{ request()->is('/') ? 'background: transparent; border: none;' : '' }}">
                <div class="mobile-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                
                <div class="lang-switcher">
                    <a href="{{ route('lang.switch', 'kk') }}" class="lang-btn {{ app()->getLocale() == 'kk' ? 'active' : '' }}">KZ</a>
                    <a href="{{ route('lang.switch', 'ru') }}" class="lang-btn {{ app()->getLocale() == 'ru' ? 'active' : '' }}">RU</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                    <a href="{{ route('lang.switch', 'he') }}" class="lang-btn {{ app()->getLocale() == 'he' ? 'active' : '' }}">HE</a>
                </div>
                
                @guest
                    <a href="{{ route('register') }}" class="btn" style="padding: 12px 30px; font-size: 0.9rem;">
                        {{ __('Join Community') }} <i class="fas fa-sparkles"></i>
                    </a>
                @endguest
            </header>

            <main class="main-content fade-in">
                @yield('content')
            </main>

            <footer class="footer-premium">
                <div class="footer-grid">
                    <div>
                        <div class="footer-logo">Еко Хаб.</div>
                        <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: 30px;">
                            {{ __('Welcome Subtitle') }}
                        </p>
                        <div style="display: flex; gap: 20px;">
                            <a href="#" style="font-size: 1.5rem; color: var(--primary);"><i class="fab fa-instagram"></i></a>
                            <a href="#" style="font-size: 1.5rem; color: var(--primary);"><i class="fab fa-telegram"></i></a>
                            <a href="#" style="font-size: 1.5rem; color: var(--primary);"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 style="color: white; margin-bottom: 30px; letter-spacing: 2px;">{{ __('Explore') }}</h4>
                        <ul class="footer-links">
                            <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('eco-projects.index') }}">{{ __('Eco Projects') }}</a></li>
                            <li><a href="{{ route('eco-events.index') }}">{{ __('Events') }}</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 style="color: white; margin-bottom: 30px; letter-spacing: 2px;">{{ __('Access') }}</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 style="color: white; margin-bottom: 30px; letter-spacing: 2px;">Legal</h4>
                        <ul class="footer-links">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-glow"></div>
                <div style="text-align: center; margin-top: 80px; color: var(--text-secondary); font-size: 0.8rem; letter-spacing: 2px;">
                    © 2026 ЕКО ХАБ КАЗАХСТАН. БАРЛЫҚ ҚҰҚЫҚТАР ҚОРҒАЛҒАН.
                </div>
            </footer>
        </div>
    </div>

</body>
</html>
