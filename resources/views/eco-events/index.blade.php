@extends('layouts.app')

@section('title', __('Events') . ' — EcoHub KZ')

@section('content')
<div class="page-header">
    <div class="page-header-glow" style="background: radial-gradient(circle, #3b82f6 0%, transparent 70%);"></div>
    <h1 class="section-title">
        {{ __('Temporal Matrix') }}.<br><span style="color:white;">{{ __('Synchronized Operations') }}.</span>
    </h1>
    <div class="page-header-row">
        <p class="page-counter">
            <span style="color:#3b82f6;">●</span>
            {{ __('UPCOMING_SYNC') }}: <span style="color:white;">{{ $events->count() }}{{ __('_TASKS') }}</span>
        </p>
        @can('create eco-events')
        <a href="{{ route('eco-events.create') }}" class="btn" style="background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 15px 35px rgba(59,130,246,0.4);">
            <i class="fas fa-calendar-plus"></i> {{ __('Schedule Event') }}
        </a>
        @endcan
    </div>
</div>

<div class="grid-2">
    @forelse($events as $event)
    <div class="card event-card">
        <div class="event-card-top">
            <div class="event-card-body">
                <h3 class="event-card-title">{{ $event->title }}</h3>
                <p class="event-card-desc">{{ $event->description }}</p>
            </div>
            <div class="badge badge-gold event-date-badge">
                <i class="fas fa-clock"></i>
                <span>{{ $event->event_date->format('d.m.Y') }}</span>
            </div>
        </div>

        <div class="event-card-actions">
            @can('edit eco-events')
            <a href="{{ route('eco-events.edit', $event->id) }}" class="btn btn-outline" style="padding:11px 24px; font-size:0.82rem;">
                <i class="fas fa-edit"></i> {{ __('Modify') }}
            </a>
            @endcan
            @can('delete eco-events')
            <form action="{{ route('eco-events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                @csrf @method('DELETE')
                <button type="submit" class="btn" style="background:rgba(244,63,94,0.1);color:#f43f5e;box-shadow:none;padding:11px 20px;">
                    <i class="fas fa-trash-can"></i>
                </button>
            </form>
            @endcan
        </div>
    </div>
    @empty
    <div class="card" style="grid-column:1/-1; text-align:center; padding:5rem 2rem; border:2px dashed var(--border);">
        <i class="fas fa-calendar-xmark" style="font-size:4rem; color:var(--text-secondary); margin-bottom:2rem; opacity:0.2; display:block;"></i>
        <h3 style="font-family:var(--font-serif); font-size:2.2rem; color:white;">{{ __('Timeline is Empty') }}</h3>
    </div>
    @endforelse
</div>

<style>
.page-header { margin-bottom: 3rem; position: relative; }
.page-header-glow { position:absolute; top:-50px; left:-50px; width:250px; height:250px; z-index:-1; opacity:0.25; border-radius:50%; }
.page-header-row { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-top:1.2rem; }
.page-counter { font-size:1rem; color:var(--text-secondary); letter-spacing:2px; }

.event-card { display:flex; flex-direction:column; gap:1.2rem; border-left:6px solid #3b82f6; }
.event-card-top { display:flex; justify-content:space-between; align-items:flex-start; gap:16px; }
.event-card-body { flex:1; min-width:0; }
.event-card-title { font-family:var(--font-serif); font-size:1.8rem; color:white; line-height:1.2; margin-bottom:12px; word-break:break-word; }
.event-card-desc { color:var(--text-secondary); line-height:1.7; font-size:0.97rem; font-weight:300; }
.event-date-badge { flex-shrink:0; align-self:flex-start; }
.event-card-actions { display:flex; justify-content:flex-end; gap:12px; border-top:1px solid var(--border); padding-top:1rem; flex-wrap:wrap; }

@media (max-width: 600px) {
    .event-card { border-left:4px solid #3b82f6; }
    .event-card-top { flex-direction:column-reverse; align-items:flex-start; }
    .event-card-title { font-size:1.4rem; }
    .event-date-badge { font-size:0.65rem; padding:6px 12px; }
    .page-header-row { flex-direction:column; align-items:flex-start; }
    .page-counter { font-size:0.85rem; }
}
</style>
@endsection
