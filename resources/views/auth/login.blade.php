@extends('layouts.app')

@section('title', __('Login') . ' — EcoHub KZ')

@section('content')
<div style="max-width: 500px; margin: 2rem auto; position: relative; padding: 0 15px;" class="fade-in">
    <!-- Back Button -->
    <div style="margin-bottom: 2rem;">
        <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 10px; color: var(--text-secondary); text-decoration: none; font-size: 0.9rem; font-weight: 700; background: rgba(255,255,255,0.05); padding: 12px 20px; border-radius: 15px; border: 1px solid var(--border); backdrop-filter: blur(10px); transition: 0.3s;">
            <i class="fas fa-arrow-left"></i> {{ __('Home') }}
        </a>
    </div>

    <div style="position: absolute; top: -100px; left: -100px; width: 300px; height: 300px; background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%); z-index: -1;"></div>
    
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: clamp(3rem, 10vw, 4.5rem); color: var(--primary); margin-bottom: 1.5rem; filter: drop-shadow(0 0 30px var(--primary-glow));">
            <i class="fas fa-lock-open"></i>
        </div>
        <h1 class="section-title" style="font-size: clamp(2rem, 8vw, 3.5rem); margin-bottom: 0.5rem;">{{ __('Access Hub') }}</h1>
        <p style="color: var(--text-secondary); font-size: 0.9rem; letter-spacing: 2px; font-weight: 300;">SECURE_UPLINK_PROTOCOL</p>
    </div>

    <div class="card" style="padding: clamp(1.5rem, 5vw, 4rem); border-radius: 40px; box-shadow: 0 50px 120px rgba(0,0,0,0.6); border: 1px solid var(--border);">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 10px; font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px;">{{ __('Network Email') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-at" style="position: absolute; left: 20px; top: 18px; color: var(--primary); font-size: 1rem;"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                           style="width: 100%; padding: 15px 15px 15px 55px; background: var(--bg-dark); border: 1px solid var(--border); border-radius: 15px; color: white; font-size: 1rem; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 20px var(--primary-glow)'">
                </div>
                @error('email')
                    <div style="color: #f43f5e; font-size: 0.8rem; margin-top: 10px; font-weight: 700;"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 10px; font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px;">{{ __('Cipher Password') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-shield-halved" style="position: absolute; left: 20px; top: 18px; color: var(--primary); font-size: 1rem;"></i>
                    <input type="password" name="password" required 
                           style="width: 100%; padding: 15px 15px 15px 55px; background: var(--bg-dark); border: 1px solid var(--border); border-radius: 15px; color: white; font-size: 1rem; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 20px var(--primary-glow)'">
                </div>
                @error('password')
                    <div style="color: #f43f5e; font-size: 0.8rem; margin-top: 10px; font-weight: 700;"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</div>
                @enderror
                <div style="text-align: right; margin-top: 10px;">
                    <a href="{{ route('password.request') }}" style="color: var(--text-secondary); text-decoration: none; font-size: 0.8rem; transition: 0.3s; font-weight: 600;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-secondary)'">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; font-size: 0.9rem; color: var(--text-secondary);">
                    <input type="checkbox" name="remember" style="width: 20px; height: 20px; accent-color: var(--primary); border-radius: 6px;">
                    {{ __('Keep me Synced') }}
                </label>
            </div>

            <button type="submit" class="btn" style="width: 100%; height: 60px; font-size: 1rem; border-radius: 20px;">
                {{ __('Initiate Auth') }} <i class="fas fa-bolt"></i>
            </button>
        </form>

        <div style="text-align: center; margin-top: 2.5rem; color: var(--text-secondary); font-size: 0.9rem; border-top: 1px solid var(--border); padding-top: 2rem;">
            {{ __('New to Nexus?') }}
            <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none; font-weight: 900; letter-spacing: 1px; transition: 0.3s;" onmouseover="this.style.filter='brightness(1.2)'">
                {{ __('REGISTER_NOW') }}
            </a>
        </div>
    </div>
</div>
@endsection
