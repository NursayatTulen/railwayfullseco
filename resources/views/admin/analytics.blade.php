@extends('layouts.app')

@section('title', 'Аналитика — EcoHub KZ')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 class="section-title">
        <i class="fas fa-chart-bar" style="color: var(--info);"></i>
        Аналитика
    </h1>
    <p class="section-subtitle">Жүйе бойынша жалпы статистика</p>
</div>

<div class="grid-3" style="margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $usersCount }}</div>
            <div class="stat-label">Барлық пайдаланушылар</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-seedling"></i></div>
        <div>
            <div class="stat-value">{{ $projectsCount }}</div>
            <div class="stat-label">Эко-жобалар</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-value">{{ $eventsCount }}</div>
            <div class="stat-label">Эко-іс-шаралар</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><i class="fas fa-info-circle"></i> Жүйе туралы</div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 1rem;">
        <div style="text-align: center; padding: 1.5rem; background: rgba(16,185,129,0.05); border-radius: 12px; border: 1px solid rgba(16,185,129,0.15);">
            <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 0.5rem;">
                <i class="fas fa-leaf"></i>
            </div>
            <div style="font-size: 1.5rem; font-weight: 800;">{{ $projectsCount }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.25rem;">Жоба</div>
        </div>
        <div style="text-align: center; padding: 1.5rem; background: rgba(59,130,246,0.05); border-radius: 12px; border: 1px solid rgba(59,130,246,0.15);">
            <div style="font-size: 2.5rem; color: var(--info); margin-bottom: 0.5rem;">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div style="font-size: 1.5rem; font-weight: 800;">{{ $eventsCount }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.25rem;">Іс-шара</div>
        </div>
        <div style="text-align: center; padding: 1.5rem; background: rgba(245,158,11,0.05); border-radius: 12px; border: 1px solid rgba(245,158,11,0.15);">
            <div style="font-size: 2.5rem; color: var(--warning); margin-bottom: 0.5rem;">
                <i class="fas fa-user-friends"></i>
            </div>
            <div style="font-size: 1.5rem; font-weight: 800;">{{ $usersCount }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.25rem;">Пайдаланушы</div>
        </div>
    </div>
</div>
@endsection

