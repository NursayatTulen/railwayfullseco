@extends('layouts.app')

@section('title', __('Forgot Password?') . ' — EcoHub KZ')

@section('content')
<div style="max-width: 600px; margin: 6rem auto; position: relative;" class="fade-in">
    <div style="position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(251, 191, 36, 0.2) 0%, transparent 70%); z-index: -1;"></div>
    
    <div style="text-align: center; margin-bottom: 5rem;">
        <div style="font-size: 5rem; color: var(--accent); margin-bottom: 2rem; filter: drop-shadow(0 0 30px rgba(251, 191, 36, 0.4));">
            <i class="fas fa-satellite"></i>
        </div>
        <h1 class="section-title" style="font-size: 4rem; margin-bottom: 1rem;">{{ __('Access Recovery') }}</h1>
        <p style="color: var(--text-secondary); font-size: 1.2rem; letter-spacing: 2px; font-weight: 300;">SIGNAL_INTERRUPTION_RECOVERY</p>
    </div>

    @if (session('status'))
        <div class="card" style="margin-bottom: 3rem; padding: 20px 40px; border-left: 5px solid var(--primary); background: rgba(16, 185, 129, 0.1);">
            <p style="color: var(--primary); font-weight: 800; margin: 0;"><i class="fas fa-check-circle"></i> {{ session('status') }}</p>
        </div>
    @endif

    <div class="card" style="padding: 5rem; border-radius: 50px; box-shadow: 0 50px 120px rgba(0,0,0,0.6); border: 1px solid var(--border);">
        <p style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.8; margin-bottom: 4rem; text-align: center;">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div style="margin-bottom: 4rem;">
                <label style="display: block; margin-bottom: 15px; font-size: 0.8rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px;">{{ __('Verification Email') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-broadcast-tower" style="position: absolute; left: 25px; top: 22px; color: var(--accent); font-size: 1.2rem;"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                           style="width: 100%; padding: 22px 22px 22px 65px; background: var(--bg-dark); border: 1px solid var(--border); border-radius: 20px; color: white; font-size: 1.1rem; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='var(--accent)'; this.style.boxShadow='0 0 20px rgba(251, 191, 36, 0.2)'">
                </div>
                @error('email')
                    <div style="color: #f43f5e; font-size: 0.85rem; margin-top: 15px; font-weight: 700;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn" style="width: 100%; height: 75px; font-size: 1.2rem; border-radius: 25px; background: linear-gradient(135deg, var(--accent), #d97706); color: #000; box-shadow: 0 15px 35px rgba(251, 191, 36, 0.4);">
                {{ __('Transmit Reset Link') }} <i class="fas fa-paper-plane"></i>
            </button>
        </form>

        <div style="text-align: center; margin-top: 4rem; border-top: 1px solid var(--border); padding-top: 3rem;">
            <a href="{{ route('login') }}" style="color: var(--text-secondary); text-decoration: none; font-size: 1rem; font-weight: 700; transition: 0.3s; letter-spacing: 1px;" onmouseover="this.style.color='white'">
                <i class="fas fa-chevron-left" style="margin-right: 10px;"></i> {{ __('ABORT_RECOVERY') }}
            </a>
        </div>
    </div>
</div>
@endsection
