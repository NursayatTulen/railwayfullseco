@extends('layouts.app')

@section('title', 'Жобаны өңдеу — EcoHub KZ')

@section('content')
<div class="form-page">
    <div class="form-page-header">
        <a href="{{ route('eco-projects.index') }}" class="back-link"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h1 class="section-title" style="font-size:2.4rem; margin-bottom:0.3rem;">
                <i class="fas fa-edit" style="color:var(--primary); font-size:1.8rem;"></i>
                Жобаны өңдеу
            </h1>
            <p class="section-subtitle">Жоба мәліметтерін өзгертіңіз</p>
        </div>
    </div>

    <div class="card form-card">
        <form action="{{ route('eco-projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label class="form-label" for="title">Жоба атауы</label>
                <input type="text" name="title" id="title" class="form-input"
                       required value="{{ old('title', $project->title) }}">
                @error('title') <div class="form-error"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Сипаттамасы</label>
                <textarea name="description" id="description" class="form-input"
                          required rows="5">{{ old('description', $project->description) }}</textarea>
                @error('description') <div class="form-error"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</div> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Жаңарту
                </button>
                <a href="{{ route('eco-projects.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Кері қайту
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-page { max-width: 760px; margin: 0 auto; }
.form-page-header { display:flex; align-items:flex-start; gap:20px; margin-bottom:2rem; }
.back-link {
    display:flex; align-items:center; justify-content:center;
    width:46px; height:46px; flex-shrink:0; margin-top:4px;
    background:rgba(255,255,255,0.05); border:1px solid var(--border);
    border-radius:14px; color:var(--text-secondary); text-decoration:none;
    transition:0.3s; font-size:1rem;
}
.back-link:hover { background:rgba(255,255,255,0.1); color:white; }
.form-card { padding:2.5rem; }
.form-actions { display:flex; gap:12px; margin-top:2rem; flex-wrap:wrap; }

@media (max-width:600px) {
    .form-card { padding:1.5rem; }
    .form-actions { flex-direction:column; }
    .form-actions .btn-primary, .form-actions .btn-secondary { width:100%; justify-content:center; }
}
</style>
@endsection
