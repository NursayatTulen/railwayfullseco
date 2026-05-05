@extends('layouts.app')

@section('title', 'Еко Хаб Kazakhstan — ' . __('Future of Nature'))

@section('content')
<div id="eco-root" dir="{{ app()->getLocale() == 'he' ? 'rtl' : 'ltr' }}" style="position: relative; background: transparent;">

    <!-- Video Background Layer REMOVED -->
    <div id="video-bg-container" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1; overflow: hidden; background-image: url('{{ asset('img/ChatGPT Image 5 мая 2026 г., 22_12_11.png') }}'); background-size: cover; background-position: center; background-attachment: fixed; pointer-events: none;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.6) 100%);"></div>
        <canvas id="pollen-canvas" style="position: absolute; top: 0; left: 0; pointer-events: none;"></canvas>
    </div>


    <!-- SPACER -->
    <div id="scroll-spacer" style="height: 400vh; position: relative; z-index: 1;">
        <!-- SECTION 1: CINEMATIC INTRO -->
        <section style="height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative;">
            
            <!-- Hero Text Layer -->
            <div style="text-align: center; z-index: 2; margin-top: -10vh;">
                <h1 style="font-family: var(--font-serif); font-size: clamp(3rem, 10vw, 7rem); color: white; line-height: 0.9; margin-bottom: 20px; text-shadow: 0 0 50px rgba(16, 185, 129, 0.4); animation: heroFadeIn 2s cubic-bezier(0.22, 1, 0.36, 1);">
                    ECO HUB<br>
                    <span style="color: var(--eco-emerald); filter: drop-shadow(0 0 30px var(--eco-glow));">KAZAKHSTAN</span>
                </h1>
                <p style="font-size: 1.2rem; letter-spacing: 5px; color: rgba(255,255,255,0.7); text-transform: uppercase; font-weight: 300; animation: heroFadeIn 3s cubic-bezier(0.22, 1, 0.36, 1);">
                    {{ __('Future of Nature') }}
                </p>
            </div>

            <!-- Scroll Indicator -->
            <div style="position: absolute; bottom: 80px; left: 50%; transform: translateX(-50%); z-index: 2;">
                <a href="javascript:void(0)" onclick="window.scrollTo({top: 1000, behavior: 'smooth'})" style="text-decoration: none; cursor: pointer;">
                    <div style="color: var(--eco-emerald); font-size: 0.8rem; letter-spacing: 8px; animation: bounce 2s infinite; text-align: center; background: rgba(0,0,0,0.4); padding: 20px 40px; border-radius: 50px; backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 50px rgba(0,0,0,0.3);">
                        {{ __('SCROLL DOWN') }}<br>
                        <i class="fas fa-chevron-down" style="margin-top: 20px; font-size: 1.8rem;"></i>
                    </div>
                </a>
            </div>

            <style>
                @keyframes heroFadeIn {
                    from { opacity: 0; transform: translateY(40px) scale(0.95); filter: blur(10px); }
                    to { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
                }
            </style>
        </section>

        <!-- SECTION 2: ALL CONTENT -->
        <section id="hero-section" style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 60px 20px; opacity: 0; transform: translateY(60px); transition: all 1.5s cubic-bezier(0.22, 1, 0.36, 1);">
            <div style="text-align: center; max-width: 1100px; width: 100%; background: rgba(0,0,0,0.35); backdrop-filter: blur(25px); padding: 70px 40px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 40px 100px rgba(0,0,0,0.5);">
                <div style="margin-bottom: 30px; display: flex; justify-content: center; width: 100%;">
                    <div style="width: clamp(180px, 40vw, 280px); height: clamp(180px, 40vw, 280px); display: flex; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.7); border-radius: 50%; box-shadow: 0 0 60px rgba(16, 185, 129, 0.3); border: 1px solid rgba(16, 185, 129, 0.2);">
                        <img src="{{ asset('img/logo.png') }}" alt="Nuralem Ecology" style="height: 75%; width: auto; filter: drop-shadow(0 0 30px var(--eco-glow));" onerror="this.src='https://cdn-icons-png.flaticon.com/512/892/892926.png'">
                    </div>
                </div>
                <div class="eco-status" style="justify-content: center; margin-bottom: 25px;">
                    <span class="status-pulse"></span>
                    {{ __('ECO_SYSTEM_ACTIVE') }} // NURALEM_V3
                </div>
                <h1 class="hero-main-title">
                    {{ __('EcoHub') }}<span class="dot-accent">.</span><br>
                    <span class="hero-subtext">{{ __('Kazakhstan') }}</span>
                </h1>
                <p style="max-width: 800px; margin: 35px auto; color: white; font-size: clamp(1rem, 2vw, 1.4rem); line-height: 1.8; text-shadow: 0 2px 20px rgba(0,0,0,0.8);">
                    {{ __('Welcome Subtitle') }}
                </p>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-eco btn-primary">
                            <i class="fas fa-chart-line"></i> {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-eco btn-primary">
                            <i class="fas fa-lock-open"></i> {{ __('Access') }}
                        </a>
                        <a href="{{ route('register') }}" class="btn-eco btn-outline">
                            <i class="fas fa-user-plus"></i> {{ __('Register') }}
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- SECTION 3: FEATURES -->
        <section id="features-section" style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 80px 20px; opacity: 0; transform: translateY(60px); transition: all 1.2s cubic-bezier(0.22, 1, 0.36, 1);">
            <div class="features-grid">
                <a href="{{ route('eco-projects.index') }}" class="feature-card">
                    <div class="card-glass"></div>
                    <div class="card-content">
                        <div class="card-icon-box"><i class="fas fa-tree"></i></div>
                        <h3 class="card-title">{{ __('Eco Projects') }}</h3>
                        <p class="card-text">{{ __('Eco Projects Description') }}</p>
                        <div class="card-footer-meta">01 // PROJECT_SYNC</div>
                    </div>
                </a>
                <a href="{{ route('eco-events.index') }}" class="feature-card">
                    <div class="card-glass"></div>
                    <div class="card-content">
                        <div class="card-icon-box"><i class="fas fa-calendar-check"></i></div>
                        <h3 class="card-title">{{ __('Events') }}</h3>
                        <p class="card-text">{{ __('Events Description') }}</p>
                        <div class="card-footer-meta">02 // EVENT_FLOW</div>
                    </div>
                </a>
                <div class="feature-card">
                    <div class="card-glass"></div>
                    <div class="card-content">
                        <div class="card-icon-box"><i class="fas fa-shield-heart"></i></div>
                        <h3 class="card-title">{{ __('Rules') }}</h3>
                        <p class="card-text">{{ __('Rules Description') }}</p>
                        <div class="card-footer-meta">03 // POLICY_CORE</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<style>
    :root {
        --eco-emerald: #10b981;
        --eco-mint: #34d399;
        --eco-dark: #064e3b;
        --eco-glow: rgba(16, 185, 129, 0.4);
    }

    /* Override layout to make window the scroll container */
    body { background: transparent !important; overflow-x: hidden; margin: 0; }
    body::before, body::after { display: none !important; }
    .app-container { height: auto !important; overflow: visible !important; }
    .main-wrapper { overflow: visible !important; height: auto !important; }
    .main-wrapper.full-width { background: transparent !important; backdrop-filter: none !important; border: none !important; box-shadow: none !important; }
    .top-header { position: fixed !important; top: 0; left: 0; right: 0; z-index: 1000 !important; }
    .footer-premium { position: relative; z-index: 20; }

    .hero-main-title {
        font-family: var(--font-serif);
        font-size: clamp(3.5rem, 10vw, 8rem);
        line-height: 0.85; color: white; font-weight: 950;
        letter-spacing: -4px; text-shadow: 0 15px 50px rgba(0,0,0,1);
    }
    .dot-accent { color: var(--eco-emerald); text-shadow: 0 0 30px var(--eco-emerald); }
    .hero-subtext { font-size: 0.35em; letter-spacing: 15px; text-transform: uppercase; color: var(--eco-mint); font-weight: 300; }

    .btn-eco {
        position: relative; padding: 22px 50px; border-radius: 50px;
        font-size: 1.1rem; font-weight: 800; text-transform: uppercase;
        letter-spacing: 3px; text-decoration: none; transition: 0.5s;
        display: inline-flex; align-items: center; gap: 15px; border: none; cursor: pointer;
    }
    .btn-eco.btn-primary { background: var(--eco-emerald); color: white; box-shadow: 0 10px 40px var(--eco-glow); }
    .btn-eco.btn-outline { border: 2px solid rgba(255,255,255,0.4); color: white; backdrop-filter: blur(15px); background: rgba(255,255,255,0.1); }
    .btn-eco:hover { transform: translateY(-10px) scale(1.05); box-shadow: 0 20px 60px var(--eco-glow); }

    .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; max-width: 1400px; width: 100%; }
    .feature-card { position: relative; border-radius: 45px; text-decoration: none; overflow: hidden; padding: 60px 40px; transition: 0.7s cubic-bezier(0.23, 1, 0.32, 1); }
    .card-glass { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(40px); border: 1px solid rgba(255,255,255,0.1); z-index: 1; }
    .feature-card:hover .card-glass { background: rgba(16, 185, 129, 0.2); border-color: var(--eco-emerald); }
    .card-content { position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; }
    .card-icon-box { width: 90px; height: 90px; background: rgba(16, 185, 129, 0.2); border-radius: 28px; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: var(--eco-emerald); margin-bottom: 35px; transition: 0.5s; }
    .feature-card:hover .card-icon-box { transform: scale(1.1) rotate(10deg); background: var(--eco-emerald); color: white; }
    .card-title { font-family: var(--font-serif); font-size: 2.3rem; color: white; margin-bottom: 20px; }
    .card-text { color: rgba(255,255,255,0.8); line-height: 1.8; font-size: 1.1rem; margin-bottom: 30px; }
    .card-footer-meta { font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; color: var(--eco-mint); letter-spacing: 2px; opacity: 0.6; }

    .eco-status { font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: var(--eco-emerald); letter-spacing: 4px; display: flex; align-items: center; gap: 12px; font-weight: 700; }
    .status-pulse { width: 10px; height: 10px; background: var(--eco-emerald); border-radius: 50%; box-shadow: 0 0 15px var(--eco-emerald); animation: pulse 2s infinite; }
    
    @keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.6); opacity: 0.4; } 100% { transform: scale(1); opacity: 1; } }
    @keyframes bounce { 0%, 20%, 50%, 80%, 100% {transform: translateY(0);} 40% {transform: translateY(-20px);} 60% {transform: translateY(-10px);} }

    @media (max-width: 1100px) {
        .features-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .hero-main-title { font-size: 5.5rem; }
    }
    @media (max-width: 768px) {
        .features-grid { grid-template-columns: 1fr; }
        .hero-main-title { font-size: 3.5rem; letter-spacing: -2px; }
        .btn-eco { width: 100%; justify-content: center; padding: 18px 30px; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const heroSection = document.getElementById('hero-section');
    const featuresSection = document.getElementById('features-section');

    // Scroll handler - section animations
    function handleScroll() {
        const scrollY = window.pageYOffset || window.scrollY || 0;

        // Section animations
        if (scrollY > 600) {
            heroSection.style.opacity = '1';
            heroSection.style.transform = 'translateY(0)';
        } else {
            heroSection.style.opacity = '0';
            heroSection.style.transform = 'translateY(40px)';
        }

        if (scrollY > 1200) {
            featuresSection.style.opacity = '1';
            featuresSection.style.transform = 'translateY(0)';
        } else {
            featuresSection.style.opacity = '0';
            featuresSection.style.transform = 'translateY(40px)';
        }
    }

    // Initialize
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Pollen Effect
    const canvas = document.getElementById('pollen-canvas');
    const ctx = canvas.getContext('2d');
    let w, h;
    function resize() { w = canvas.width = window.innerWidth; h = canvas.height = window.innerHeight; }
    window.addEventListener('resize', resize); resize();
    
    const particles = [];
    for(let i=0; i<60; i++) particles.push({
        x: Math.random()*w, y: Math.random()*h, 
        size: Math.random()*1.5 + 0.5, 
        speedX: Math.random()*0.3 - 0.15, 
        speedY: Math.random()*0.3 + 0.05,
        op: Math.random()*0.4 + 0.1
    });

    function drawParticles() {
        ctx.clearRect(0,0,w,h);
        particles.forEach(p => {
            p.y -= p.speedY; p.x += p.speedX;
            if(p.y < 0) { p.y = h; p.x = Math.random()*w; }
            ctx.fillStyle = `rgba(52, 211, 153, ${p.op})`;
            ctx.beginPath(); ctx.arc(p.x, p.y, p.size, 0, Math.PI*2); ctx.fill();
        });
        requestAnimationFrame(drawParticles);
    }
    drawParticles();
});
</script>
@endsection


