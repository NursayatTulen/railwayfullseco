@extends('layouts.app')

@section('title', __('Reset Password') . ' — EcoHub KZ')

@section('content')
<div style="max-width: 500px; margin: 4rem auto; position: relative;">
    <div style="text-align: center; margin-bottom: 4rem;">
        <div style="font-size: 4rem; color: #f43f5e; margin-bottom: 2rem; filter: drop-shadow(0 0 20px rgba(244, 63, 94, 0.4));">
            <i class="fas fa-rotate-right"></i>
        </div>
        <h1 class="section-title" style="font-size: 2.8rem; margin-bottom: 1.5rem;">New Credentials</h1>
        <p style="color: var(--text-secondary); line-height: 1.8;">
            {{ __('Define your new secure access keys.') }}
        </p>
    </div>

    <div class="card" style="padding: 3.5rem; border-radius: 40px;">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group" style="margin-bottom: 2rem;">
                <label class="form-label" style="margin-bottom: 12px; display: block; font-size: 0.85rem; letter-spacing: 1px;">{{ __('Email') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope" style="position: absolute; left: 20px; top: 18px; color: #f43f5e; opacity: 0.7;"></i>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $request->email) }}"
                           required autofocus style="width: 100%; padding-left: 55px; height: 60px; background: rgba(255,255,255,0.03); border-radius: 20px;">
                </div>
                @error('email')
                    <div style="color: #f43f5e; font-size: 0.8rem; margin-top: 10px; font-weight: 600;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <label class="form-label" style="margin-bottom: 12px; display: block; font-size: 0.85rem; letter-spacing: 1px;">{{ __('Password') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-lock" style="position: absolute; left: 20px; top: 18px; color: #f43f5e; opacity: 0.7;"></i>
                    <input type="password" name="password" class="form-input" required
                           placeholder="••••••••" style="width: 100%; padding-left: 55px; height: 60px; background: rgba(255,255,255,0.03); border-radius: 20px;">
                </div>
                @error('password')
                    <div style="color: #f43f5e; font-size: 0.8rem; margin-top: 10px; font-weight: 600;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 3rem;">
                <label class="form-label" style="margin-bottom: 12px; display: block; font-size: 0.85rem; letter-spacing: 1px;">{{ __('Confirm Password') }}</label>
                <div style="position: relative;">
                    <i class="fas fa-shield-check" style="position: absolute; left: 20px; top: 18px; color: #f43f5e; opacity: 0.7;"></i>
                    <input type="password" name="password_confirmation" class="form-input" required
                           placeholder="••••••••" style="width: 100%; padding-left: 55px; height: 60px; background: rgba(255,255,255,0.03); border-radius: 20px;">
                </div>
            </div>

            <button type="submit" class="btn" style="width: 100%; justify-content: center; height: 65px; font-size: 1.1rem; border-radius: 25px; background: linear-gradient(135deg, #f43f5e, #e11d48); box-shadow: 0 10px 25px rgba(244, 63, 94, 0.3);">
                {{ __('Reset Password') }} <i class="fas fa-check-double" style="margin-left: 10px;"></i>
            </button>
        </form>
    </div>
</div>
@endsection
