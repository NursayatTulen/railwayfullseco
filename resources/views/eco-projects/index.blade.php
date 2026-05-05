@extends('layouts.app')

@section('title', __('Eco Projects') . ' — EcoHub KZ')

@section('content')
<div class="page-header">
    <div class="page-header-glow" style="background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%);"></div>
    <h1 class="section-title">
        {{ __('Project Nexus') }}.<br><span style="color:white;">{{ __('Active Ecological Streams') }}.</span>
    </h1>
    <div class="page-header-row">
        <p class="page-counter">
            <span style="color:var(--primary);">●</span>
            {{ __('TOTAL_LOAD') }}: <span style="color:white;">{{ $projects->count() }}{{ __('_NODES') }}</span>
        </p>
        @can('create eco-projects')
        <a href="{{ route('eco-projects.create') }}" class="btn">
            <i class="fas fa-plus-circle"></i> {{ __('New Project') }}
        </a>
        @endcan
    </div>
</div>

<div class="grid-2">
    @forelse($projects as $project)
    <div class="card project-card">
        <div class="project-card-top">
            <div class="project-card-body">
                <h3 class="project-card-title">{{ $project->title }}</h3>
                <p class="project-card-desc">{{ $project->description }}</p>
            </div>
            <div class="badge badge-gold project-version-badge">
                <i class="fas fa-microchip"></i>
                <span>v.{{ $project->id }}.0</span>
            </div>
        </div>

        <div class="project-card-footer">
            <div class="project-badges">
                <span class="badge badge-blue">NODE_{{ $project->id }}</span>
                <span class="badge badge-primary">{{ __('Active') }}</span>
            </div>
            <div class="project-actions">
                @can('edit eco-projects')
                <a href="{{ route('eco-projects.edit', $project->id) }}" class="btn btn-outline" style="padding:11px 22px; font-size:0.82rem;">
                    <i class="fas fa-sliders"></i> {{ __('Configure') }}
                </a>
                @endcan
                @can('delete eco-projects')
                <form action="{{ route('eco-projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn" style="background:rgba(244,63,94,0.1);color:#f43f5e;box-shadow:none;padding:11px 18px;">
                        <i class="fas fa-trash-can"></i>
                    </button>
                </form>
                @endcan
            </div>
        </div>
    </div>
    @empty
    <div class="card" style="grid-column:1/-1; text-align:center; padding:5rem 2rem; border:2px dashed var(--border);">
        <i class="fas fa-ghost" style="font-size:4rem; color:var(--text-secondary); margin-bottom:2rem; opacity:0.2; display:block;"></i>
        <h3 style="font-family:var(--font-serif); font-size:2.2rem; color:white;">{{ __('No Projects in Database') }}</h3>
    </div>
    @endforelse
</div>

<style>
.page-header { margin-bottom: 3rem; position: relative; }
.page-header-glow { position:absolute; top:-50px; left:-50px; width:250px; height:250px; z-index:-1; opacity:0.25; border-radius:50%; }
.page-header-row { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-top:1.2rem; }
.page-counter { font-size:1rem; color:var(--text-secondary); letter-spacing:2px; }

.project-card { display:flex; flex-direction:column; gap:1.2rem; border-bottom:6px solid var(--primary); }
.project-card-top { display:flex; justify-content:space-between; align-items:flex-start; gap:16px; }
.project-card-body { flex:1; min-width:0; }
.project-card-title { font-family:var(--font-serif); font-size:1.8rem; color:white; line-height:1.2; margin-bottom:12px; word-break:break-word; }
.project-card-desc { color:var(--text-secondary); line-height:1.7; font-size:0.97rem; font-weight:300; }
.project-version-badge { flex-shrink:0; align-self:flex-start; }
.project-card-footer { display:flex; justify-content:space-between; align-items:center; border-top:1px solid var(--border); padding-top:1rem; flex-wrap:wrap; gap:12px; }
.project-badges { display:flex; gap:8px; flex-wrap:wrap; }
.project-actions { display:flex; gap:10px; flex-wrap:wrap; }

@media (max-width: 600px) {
    .project-card-top { flex-direction:column-reverse; align-items:flex-start; }
    .project-card-title { font-size:1.4rem; }
    .project-version-badge { font-size:0.65rem; padding:6px 12px; }
    .project-card-footer { flex-direction:column; align-items:flex-start; }
    .page-header-row { flex-direction:column; align-items:flex-start; }
    .page-counter { font-size:0.85rem; }
}
</style>
@endsection
