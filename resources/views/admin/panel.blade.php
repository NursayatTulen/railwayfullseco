@extends('layouts.app')

@section('title', __('Admin Panel') . ' — EcoHub KZ')

@section('content')
<div style="margin-bottom: 6rem; position: relative;">
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%); z-index: -1;"></div>
    <h1 class="section-title">
        {{ __('Command Center') }}.<br><span style="color: white;">{{ __('System Infrastructure') }}.</span>
    </h1>
    <p style="font-size: 1.4rem; color: var(--text-secondary); letter-spacing: 3px; font-weight: 300;">
        <span style="color: #3b82f6; animation: pulse 2s infinite;">●</span> {{ __('SESSION_ENCRYPTED') }} | {{ __('UPTIME') }}: <span style="color: var(--primary); font-weight: 800;">{{ __('OPTIMAL') }}</span>
    </p>
</div>

<div class="grid-4" style="margin-bottom: 6rem; gap: 30px;">
    <div class="card" style="padding: 3rem; text-align: center; border-left: 6px solid var(--primary); background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), transparent);">
        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 20px; filter: drop-shadow(0 0 15px var(--primary-glow));"><i class="fas fa-users-viewfinder"></i></div>
        <div style="font-size: 3.5rem; font-weight: 900; color: white; line-height: 1;">{{ $users->count() }}</div>
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 3px; margin-top: 15px;">{{ __('Total Users') }}</div>
    </div>
    <div class="card" style="padding: 3rem; text-align: center; border-left: 6px solid #3b82f6; background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), transparent);">
        <div style="font-size: 3rem; color: #3b82f6; margin-bottom: 20px; filter: drop-shadow(0 0 15px rgba(59, 130, 246, 0.3));"><i class="fas fa-shield-halved"></i></div>
        <div style="font-size: 3.5rem; font-weight: 900; color: white; line-height: 1;">{{ $roles->count() }}</div>
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 3px; margin-top: 15px;">{{ __('Active Roles') }}</div>
    </div>
    <div class="card" style="padding: 3rem; text-align: center; border-left: 6px solid var(--accent); background: linear-gradient(135deg, rgba(251, 191, 36, 0.05), transparent);">
        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 20px; filter: drop-shadow(0 0 15px rgba(251, 191, 36, 0.3));"><i class="fas fa-key-skeleton"></i></div>
        <div style="font-size: 3.5rem; font-weight: 900; color: white; line-height: 1;">{{ $permissions->count() }}</div>
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 3px; margin-top: 15px;">{{ __('System Permissions') }}</div>
    </div>
    <div class="card" style="padding: 3rem; text-align: center; border-left: 6px solid #f43f5e; background: linear-gradient(135deg, rgba(244, 63, 94, 0.05), transparent);">
        <div style="font-size: 3rem; color: #f43f5e; margin-bottom: 20px; filter: drop-shadow(0 0 15px rgba(244, 63, 94, 0.3));"><i class="fas fa-server"></i></div>
        <div style="font-size: 3.5rem; font-weight: 900; color: white; line-height: 1;">{{ PHP_VERSION_ID }}</div>
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 3px; margin-top: 15px;">{{ __('Kernel Core') }}</div>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--border); box-shadow: 0 40px 100px rgba(0,0,0,0.5);">
    <div style="padding: 40px 60px; border-bottom: 1px solid var(--border); background: rgba(255,255,255,0.02); display: flex; justify-content: space-between; align-items: center;">
        <h2 style="font-family: var(--font-serif); font-size: 2.5rem; letter-spacing: -1px;">{{ __('User Directory') }}</h2>
        <div class="badge badge-gold" style="padding: 10px 25px; font-size: 0.8rem; letter-spacing: 2px;">SECURE_PROTOCOL_V3</div>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.03);">
                    <th style="padding: 30px 60px; color: var(--text-secondary); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px;">{{ __('Identity') }}</th>
                    <th style="padding: 30px 60px; color: var(--text-secondary); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px;">{{ __('Network Email') }}</th>
                    <th style="padding: 30px 60px; color: var(--text-secondary); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px;">{{ __('Access Level') }}</th>
                    <th style="padding: 30px 60px; color: var(--text-secondary); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px;">{{ __('Modulation') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr style="border-bottom: 1px solid var(--border); transition: 0.4s;" onmouseover="this.style.background='rgba(16, 185, 129, 0.03)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 40px 60px;">
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div class="nav-avatar" style="width: 55px; height: 55px; border-radius: 18px; font-size: 1.2rem; background: linear-gradient(135deg, var(--primary), #3b82f6);">
                                {{ substr($u->name, 0, 1) }}
                            </div>
                            <div>
                                <div style="font-weight: 800; color: white; font-size: 1.1rem;">{{ $u->name }}</div>
                                <div style="font-size: 0.65rem; color: var(--primary); text-transform: uppercase; letter-spacing: 1px;">ID_{{ $u->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 40px 60px; color: var(--text-secondary); font-family: 'Outfit';">{{ $u->email }}</td>
                    <td style="padding: 40px 60px;">
                        @foreach($u->getRoleNames() as $role)
                            <span class="badge {{ $role == 'super-admin' ? 'badge-rose' : ($role == 'admin' ? 'badge-gold' : 'badge-blue') }}" style="padding: 8px 18px; font-size: 0.7rem;">
                                {{ strtoupper($role) }}
                            </span>
                        @endforeach
                    </td>
                    <td style="padding: 40px 60px;">
                        <div style="display: flex; gap: 15px;">
                            @if($u->id !== auth()->id())
                            <form action="{{ route('admin.users.role', $u->id) }}" method="POST" style="display: flex; gap: 10px;">
                                @csrf @method('PATCH')
                                <select name="role" style="background: var(--bg-dark); border: 1px solid var(--border); border-radius: 15px; color: white; padding: 10px 20px; font-size: 0.8rem; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $u->roles->first()?->name === $role->name ? 'selected' : '' }}>
                                            {{ strtoupper($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn" style="padding: 10px 20px; box-shadow: none;">
                                    <i class="fas fa-sync"></i>
                                </button>
                            </form>
                            @else
                                <span style="color: var(--text-secondary); font-style: italic; font-size: 0.9rem;">ROOT_SYSTEM_ADMIN</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
