@extends('layouts.app')

@section('title', __('Dashboard') . ' — EcoHub KZ')

@section('content')
<div class="dash-header">
    <div class="dash-glow"></div>
    <h1 class="section-title">
        {{ __('The Archive of') }}<br><span style="color:white;">{{ Auth::user()->name }}</span>
    </h1>
    <p class="dash-status">
        <span style="color:var(--primary);">●</span>
        {{ __('ONLINE_SESSION') }} | {{ __('AUTH_LEVEL') }}:
        <span style="color:var(--accent); font-weight:800;">{{ strtoupper($user->getRoleNames()->first() ?? 'User') }}</span>
    </p>
</div>

<div class="grid-4 dash-stats">
    <div class="card stat-card" style="border-top:5px solid var(--primary);">
        <div class="stat-icon" style="color:var(--primary);"><i class="fas fa-crown"></i></div>
        <div class="stat-num">{{ $roles->count() }}</div>
        <div class="stat-label">{{ __('Your Roles') }}</div>
    </div>
    <div class="card stat-card" style="border-top:5px solid #3b82f6;">
        <div class="stat-icon" style="color:#3b82f6;"><i class="fas fa-fingerprint"></i></div>
        <div class="stat-num">{{ $permissions->count() }}</div>
        <div class="stat-label">{{ __('Permissions Count') }}</div>
    </div>
    <div class="card stat-card" style="border-top:5px solid var(--accent);">
        <div class="stat-icon" style="color:var(--accent);"><i class="fas fa-leaf"></i></div>
        <div class="stat-num">{{ $projectsCount }}</div>
        <div class="stat-label">{{ __('Eco Projects') }}</div>
    </div>
    <div class="card stat-card" style="border-top:5px solid #f43f5e;">
        <div class="stat-icon" style="color:#f43f5e;"><i class="fas fa-meteor"></i></div>
        <div class="stat-num">{{ $eventsCount }}</div>
        <div class="stat-label">{{ __('Events') }}</div>
    </div>
</div>

<div class="grid-2 dash-panels">
    <div class="card">
        <h3 class="panel-title"><i class="fas fa-user-shield" style="color:var(--primary);"></i> {{ __('Your Roles') }}</h3>
        <div class="tags-wrap">
            @foreach($roles as $role)
                <span class="badge badge-primary">{{ strtoupper($role) }}</span>
            @endforeach
        </div>
    </div>
    <div class="card">
        <h3 class="panel-title"><i class="fas fa-key" style="color:#3b82f6;"></i> {{ __('Permissions') }}</h3>
        <div class="perms-grid">
            @foreach($permissions as $perm)
                <div class="perm-item">
                    <i class="fas fa-circle-check" style="color:#3b82f6; font-size:0.8rem;"></i>
                    <span>{{ $perm }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card quick-ops">
    <h3 class="panel-title">{{ __('Quick Operations') }}</h3>
    <div class="quick-btns">
        @can('create eco-projects')
        <a href="{{ route('eco-projects.create') }}" class="btn"><i class="fas fa-plus"></i> {{ __('New Eco Project') }}</a>
        @endcan
        @can('create eco-events')
        <a href="{{ route('eco-events.create') }}" class="btn"><i class="fas fa-calendar-plus"></i> {{ __('New Event') }}</a>
        @endcan
        @can('view eco-projects')
        <a href="{{ route('eco-projects.index') }}" class="btn btn-outline"><i class="fas fa-seedling"></i> {{ __('View Projects') }}</a>
        @endcan
        @can('view eco-events')
        <a href="{{ route('eco-events.index') }}" class="btn btn-outline"><i class="fas fa-calendar-alt"></i> {{ __('Events') }}</a>
        @endcan
        @hasanyrole('admin|super-admin')
        <a href="{{ route('admin.panel') }}" class="btn btn-outline"><i class="fas fa-shield-alt"></i> {{ __('Admin Panel') }}</a>
        @endhasanyrole
        {{-- Eco Map — available to ALL authenticated users --}}
        <a href="{{ route('eco-map') }}" class="btn eco-map-btn"><i class="fas fa-eye"></i> {{ __('Eco Monitor') }}</a>
    </div>
</div>

<style>
.dash-header { margin-bottom:2.5rem; position:relative; }
.dash-glow { position:absolute; top:-80px; left:-80px; width:260px; height:260px; background:radial-gradient(circle, var(--primary-glow) 0%, transparent 70%); z-index:-1; opacity:0.5; border-radius:50%; }
.dash-status { font-size:1rem; color:var(--text-secondary); letter-spacing:2px; font-weight:300; margin-top:0.5rem; }
.dash-stats { margin-bottom:2rem; }

.stat-card { padding:2rem 1.5rem; text-align:center; }
.stat-icon { font-size:2rem; margin-bottom:14px; }
.stat-num { font-size:2.8rem; font-weight:900; color:white; line-height:1; }
.stat-label { font-size:0.7rem; color:var(--text-secondary); text-transform:uppercase; letter-spacing:2px; margin-top:10px; }

.dash-panels { margin-bottom:2rem; }
.panel-title { font-family:var(--font-serif); font-size:1.6rem; margin-bottom:1.4rem; display:flex; align-items:center; gap:12px; }
.tags-wrap { display:flex; flex-wrap:wrap; gap:10px; }
.perms-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:10px; }
.perm-item { display:flex; align-items:center; gap:8px; color:var(--text-secondary); font-size:0.88rem; font-weight:500; }

.quick-ops { border:2px dashed var(--border); }
.quick-btns { display:flex; flex-wrap:wrap; gap:14px; }

@media (max-width:600px) {
    .stat-card { padding:1.4rem 1rem; }
    .stat-num { font-size:2.2rem; }
    .perms-grid { grid-template-columns:1fr; }
    .quick-btns { flex-direction:column; }
    .quick-btns .btn, .quick-btns .btn-outline { width:100%; justify-content:center; }
    .dash-status { font-size:0.82rem; letter-spacing:1px; }
}

.eco-map-btn {
    background: linear-gradient(135deg, #10b981, #059669) !important;
    color: white !important;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(16, 185, 129, 0.4), inset 0 0 20px rgba(16, 185, 129, 0.1);
    animation: eco-pulse 2s infinite;
}
.eco-map-btn:hover {
    box-shadow: 0 0 40px rgba(16, 185, 129, 0.7), inset 0 0 30px rgba(16, 185, 129, 0.2);
    transform: translateY(-3px) scale(1.05);
}
.eco-map-btn i { animation: eye-scan 3s infinite; }
@keyframes eco-pulse { 0%,100% { box-shadow: 0 0 20px rgba(16,185,129,0.4); } 50% { box-shadow: 0 0 35px rgba(16,185,129,0.7); } }
@keyframes eye-scan { 0%,100% { transform: scale(1); } 50% { transform: scale(1.3); } }
</style>
@endsection
