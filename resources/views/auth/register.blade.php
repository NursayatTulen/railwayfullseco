@extends('layouts.app')

@section('title', __('Register') . ' — EcoHub KZ')

@section('content')
<div style="max-width: 600px; margin: 2rem auto; position: relative; padding: 0 15px;" class="fade-in">
    <!-- Back Button -->
    <div style="margin-bottom: 2rem;">
        <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 10px; color: var(--text-secondary); text-decoration: none; font-size: 0.9rem; font-weight: 700; background: rgba(255,255,255,0.05); padding: 12px 20px; border-radius: 15px; border: 1px solid var(--border); backdrop-filter: blur(10px); transition: 0.3s;">
            <i class="fas fa-arrow-left"></i> {{ __('Home') }}
        </a>
    </div>

    <div style="position: absolute; bottom: -100px; right: -100px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%); z-index: -1;"></div>
    
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: clamp(3rem, 10vw, 4.5rem); color: #3b82f6; margin-bottom: 1.5rem; filter: drop-shadow(0 0 30px rgba(59, 130, 246, 0.4));">
            <i class="fas fa-user-plus"></i>
        </div>
        <h1 class="section-title" style="font-size: clamp(2rem, 8vw, 3.5rem); margin-bottom: 0.5rem;">{{ __('Join the Nexus') }}</h1>
        <p style="color: var(--text-secondary); font-size: 0.9rem; letter-spacing: 2px; font-weight: 300;">INITIALIZE_NEW_IDENTITY</p>
    </div>

    <div class="card" style="padding: clamp(1.5rem, 5vw, 4rem); border-radius: 40px; box-shadow: 0 50px 120px rgba(0,0,0,0.6); border: 1px solid var(--border);">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 10px; font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px;">{{ __('Full Legal Name') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-signature" style="position: absolute; left: 20px; top: 18px; color: #3b82f6; font-size: 1rem;"></i>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus 
                           style="width: 100%; padding: 15px 15px 15px 55px; background: var(--bg-dark); border: 1px solid var(--border); border-radius: 15px; color: white; font-size: 1rem; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 20px rgba(59, 130, 246, 0.2)'">
                </div>
                @error('name')
                    <div style="color: #f43f5e; font-size: 0.8rem; margin-top: 10px; font-weight: 700;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 10px; font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px;">{{ __('Network Address') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-link" style="position: absolute; left: 20px; top: 18px; color: #3b82f6; font-size: 1rem;"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           style="width: 100%; padding: 15px 15px 15px 55px; background: var(--bg-dark); border: 1px solid var(--border); border-radius: 15px; color: white; font-size: 1rem; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 20px rgba(59, 130, 246, 0.2)'">
                </div>
                @error('email')
                    <div style="color: #f43f5e; font-size: 0.8rem; margin-top: 10px; font-weight: 700;">{{ $message }}</div>
                @enderror
            </div>

            <div class="auth-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 2.5rem;">
                <div>
                    <label style="display: block; margin-bottom: 10px; font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px;">{{ __('Key Cipher') }}</label>
                    <input type="password" name="password" required 
                           style="width: 100%; padding: 15px; background: var(--bg-dark); border: 1px solid var(--border); border-radius: 15px; color: white; font-size: 1rem; outline: none;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 10px; font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px;">{{ __('Repeat Cipher') }}</label>
                    <input type="password" name="password_confirmation" required 
                           style="width: 100%; padding: 15px; background: var(--bg-dark); border: 1px solid var(--border); border-radius: 15px; color: white; font-size: 1rem; outline: none;">
                </div>
            </div>

            <button type="submit" class="btn" style="width: 100%; height: 60px; font-size: 1rem; border-radius: 20px; background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);">
                {{ __('Create Identity') }} <i class="fas fa-sparkles"></i>
            </button>
        </form>

        <div style="text-align: center; margin-top: 2.5rem; color: var(--text-secondary); font-size: 0.9rem; border-top: 1px solid var(--border); padding-top: 2rem;">
            {{ __('Already in Database?') }}
            <a href="{{ route('login') }}" style="color: #3b82f6; text-decoration: none; font-weight: 900; letter-spacing: 1px; transition: 0.3s;" onmouseover="this.style.filter='brightness(1.2)'">
                {{ __('ACCESS_SYSTEM') }}
            </a>
        </div>
    </div>
</div>
@endsection
