@extends('layouts.app')

@section('title', 'Жаңа іс-шара қосу — EcoHub KZ')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <h1 class="section-title"><i class="fas fa-calendar-plus" style="color: var(--info);"></i> Жаңа эко-іс-шара</h1>
        <p class="section-subtitle">Жаңа экологиялық іс-шара туралы мәліметтерді енгізіңіз</p>
    </div>

    <div class="card">
        <form action="{{ route('eco-events.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">Іс-шара атауы</label>
                <input type="text" name="title" id="title" class="form-input" placeholder="Мысалы: Орталық саябақты тазалау" required value="{{ old('title') }}">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="event_date">Өткізілетін күні</label>
                <input type="date" name="event_date" id="event_date" class="form-input" required value="{{ old('event_date') }}">
                @error('event_date') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Сипаттамасы</label>
                <textarea name="description" id="description" class="form-input" placeholder="Іс-шара туралы толық мәлімет..." required>{{ old('description') }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Сақтау
                </button>
                <a href="{{ route('eco-events.index') }}" class="btn btn-secondary">
                    Кері қайту
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
