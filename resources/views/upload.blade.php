@extends('layouts.app')

@section('title', __('Cloud Vault') . ' — EcoHub KZ')

@section('content')

{{-- ── HEADER ──────────────────────────────────────────── --}}
<div class="vault-header">
    <div class="vault-glow"></div>
    <h1 class="section-title">
        {{ __('Digital Archive') }}.<br>
        <span style="color:white;">{{ __('Vault Infrastructure') }}.</span>
    </h1>
    <p class="vault-status">
        <span class="pulse-dot">●</span>
        {{ __('SECURE_UPLOADS') }} &nbsp;|&nbsp; {{ __('CLOUD_SYNC') }}:
        <strong style="color:#3b82f6;">{{ __('ENCRYPTED') }}</strong>
    </p>
</div>

{{-- ── TOP ROW: Upload + Stats ─────────────────────────── --}}
<div class="vault-top-row">

    {{-- Upload card --}}
    <div class="card upload-card">
        <div class="upload-icon">
            <i class="fas fa-cloud-arrow-up"></i>
        </div>
        <h3 class="upload-title">{{ __('Transmit File') }}</h3>
        <p class="upload-desc">{{ __('Drag and drop ecological intelligence into the vault.') }}</p>

        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf
            <div class="upload-file-wrap">
                <input type="file" name="file" id="file-upload" class="file-input-hidden"
                       onchange="updateFileName(this)">
                <label for="file-upload" class="file-label">
                    <i class="fas fa-folder-open"></i>
                    <span id="file-name-display">{{ __('Select Intelligence') }}</span>
                </label>
                @error('file')
                    <div class="form-error"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn upload-submit-btn">
                {{ __('Begin Uplink') }} <i class="fas fa-rocket"></i>
            </button>
        </form>
    </div>

    {{-- Stats card --}}
    <div class="card stats-card">
        <div class="stats-row">
            <div class="stats-icon-wrap" style="background:rgba(59,130,246,0.1); border:1px solid rgba(59,130,246,0.2);">
                <i class="fas fa-database" style="color:#3b82f6;"></i>
            </div>
            <div>
                <div class="stats-label">{{ __('Resource Allocation') }}</div>
                <div class="stats-value">{{ count($files) * 2.4 }} MB / 1 GB</div>
            </div>
        </div>

        <div class="progress-bar-wrap">
            <div class="progress-bar-track">
                <div class="progress-bar-fill"
                     style="width:{{ min((count($files) * 2.4 / 1024) * 100, 100) }}%"></div>
            </div>
            <div class="progress-pct">{{ round(min((count($files) * 2.4 / 1024) * 100, 100), 1) }}%</div>
        </div>

        <div class="mini-stats-grid">
            <div class="mini-stat">
                <i class="fas fa-file-shield" style="color:var(--primary);"></i>
                <div class="mini-stat-num">{{ count($files) }}</div>
                <div class="mini-stat-label">{{ __('Stored Nodes') }}</div>
            </div>
            <div class="mini-stat">
                <i class="fas fa-satellite-dish" style="color:#3b82f6;"></i>
                <div class="mini-stat-num">{{ __('LIVE') }}</div>
                <div class="mini-stat-label">{{ __('Comms Link') }}</div>
            </div>
            <div class="mini-stat">
                <i class="fas fa-shield-halved" style="color:var(--accent);"></i>
                <div class="mini-stat-num">{{ __('AES') }}</div>
                <div class="mini-stat-label">{{ __('Cipher') }}</div>
            </div>
            <div class="mini-stat">
                <i class="fas fa-server" style="color:#f43f5e;"></i>
                <div class="mini-stat-num">KZ</div>
                <div class="mini-stat-label">{{ __('Region') }}</div>
            </div>
        </div>
    </div>
</div>

{{-- ── FILES GRID ───────────────────────────────────────── --}}
<div class="vault-table-card card">
    <div class="vault-table-header">
        <h2 class="vault-table-title">
            <i class="fas fa-vault" style="color:var(--primary);"></i>
            {{ __('Vault Assets') }}
        </h2>
        <span class="badge badge-primary">{{ count($files) }} {{ __('files') }}</span>
    </div>

    <div class="vault-files-grid">
        @forelse($files as $file)
            @php
                $path      = str_replace('uploads/', '', $file);
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $isImage   = in_array($extension, ['jpg','jpeg','png','gif','webp','svg']);
                $iconMap   = ['pdf'=>'fa-file-pdf','zip'=>'fa-file-zipper','rar'=>'fa-file-zipper','doc'=>'fa-file-word','docx'=>'fa-file-word','xls'=>'fa-file-excel','xlsx'=>'fa-file-excel','mp4'=>'fa-file-video','mp3'=>'fa-file-audio'];
                $icon      = $iconMap[$extension] ?? 'fa-file-code';
            @endphp

            <div class="file-card">
                <div class="file-preview">
                    @if($isImage)
                        <img src="{{ asset('storage/' . $file) }}" alt="{{ $path }}" class="file-img">
                    @else
                        <div class="file-icon">
                            <i class="fas {{ $icon }}"></i>
                            <span class="file-ext">{{ strtoupper($extension) }}</span>
                        </div>
                    @endif
                </div>
                <div class="file-name" title="{{ $path }}">{{ $path }}</div>
                <div class="file-actions">
                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-outline file-btn">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ asset('storage/' . $file) }}" download class="btn file-btn">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="vault-empty">
                <i class="fas fa-inbox"></i>
                <p>{{ __('Archive empty.') }}</p>
            </div>
        @endforelse
    </div>
</div>

<style>
/* ── Header ─────────────────────────────────────── */
.vault-header { margin-bottom: 2.5rem; position: relative; }
.vault-glow {
    position: absolute; top: -80px; left: -80px;
    width: 300px; height: 300px; border-radius: 50%;
    background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%);
    z-index: -1; opacity: 0.4;
}
.vault-status {
    font-size: 0.95rem; color: var(--text-secondary);
    letter-spacing: 2px; font-weight: 300; margin-top: 0.6rem;
}
.pulse-dot { color: var(--primary); animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

/* ── Top row ─────────────────────────────────────── */
.vault-top-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 2rem;
    align-items: start;
}

/* ── Upload card ─────────────────────────────────── */
.upload-card { text-align: center; padding: 2.5rem 2rem; border: 2px dashed rgba(16,185,129,0.4); background: linear-gradient(to bottom, rgba(16,185,129,0.04), transparent); }
.upload-icon { font-size: 3.5rem; color: var(--primary); margin-bottom: 1.2rem; filter: drop-shadow(0 0 20px var(--primary-glow)); }
.upload-title { font-family: var(--font-serif); font-size: 1.8rem; color: white; margin-bottom: 0.8rem; }
.upload-desc { color: var(--text-secondary); font-size: 0.92rem; margin-bottom: 2rem; line-height: 1.6; font-weight: 300; }
.upload-form { display: flex; flex-direction: column; gap: 14px; }
.upload-file-wrap { width: 100%; }
.file-input-hidden { display: none; }
.file-label {
    display: flex; align-items: center; justify-content: center; gap: 12px;
    width: 100%; padding: 16px 24px; cursor: pointer;
    background: rgba(255,255,255,0.03); border: 1px dashed var(--border);
    border-radius: 18px; color: var(--text-secondary); font-weight: 700;
    font-size: 0.9rem; letter-spacing: 1px; transition: 0.3s;
    text-transform: uppercase;
}
.file-label:hover { border-color: var(--primary); color: var(--primary); background: rgba(16,185,129,0.05); }
.upload-submit-btn { width: 100%; justify-content: center; padding: 16px; font-size: 0.95rem; border-radius: 18px; }

/* ── Stats card ──────────────────────────────────── */
.stats-card { padding: 2rem; display: flex; flex-direction: column; gap: 1.4rem; }
.stats-row { display: flex; align-items: center; gap: 16px; }
.stats-icon-wrap { width: 56px; height: 56px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.stats-label { font-size: 0.72rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 4px; }
.stats-value { font-size: 1.5rem; font-weight: 900; color: white; }

.progress-bar-wrap { display: flex; align-items: center; gap: 12px; }
.progress-bar-track { flex: 1; height: 10px; background: rgba(255,255,255,0.05); border-radius: 10px; overflow: hidden; border: 1px solid var(--border); }
.progress-bar-fill { height: 100%; background: linear-gradient(90deg, var(--primary), #3b82f6); box-shadow: 0 0 10px var(--primary-glow); border-radius: 10px; transition: width 1s ease; }
.progress-pct { font-size: 0.78rem; color: var(--primary); font-weight: 800; white-space: nowrap; }

.mini-stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
.mini-stat {
    padding: 16px; background: rgba(255,255,255,0.02);
    border: 1px solid var(--border); border-radius: 18px;
    text-align: center;
}
.mini-stat i { font-size: 1.2rem; margin-bottom: 8px; display: block; }
.mini-stat-num { font-size: 1.3rem; font-weight: 900; color: white; line-height: 1; }
.mini-stat-label { font-size: 0.65rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 4px; }

/* ── Vault table card ────────────────────────────── */
.vault-table-card { padding: 0; overflow: hidden; }
.vault-table-header {
    padding: 1.4rem 2rem; border-bottom: 1px solid var(--border);
    background: rgba(255,255,255,0.02);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
}
.vault-table-title { font-family: var(--font-serif); font-size: 1.6rem; display: flex; align-items: center; gap: 14px; margin: 0; }

.vault-files-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
    padding: 2rem;
}

/* ── File card ───────────────────────────────────── */
.file-card {
    background: rgba(255,255,255,0.02); border: 1px solid var(--border);
    border-radius: 20px; padding: 16px; text-align: center;
    transition: 0.35s; display: flex; flex-direction: column; gap: 12px;
}
.file-card:hover { border-color: var(--primary); background: rgba(16,185,129,0.04); transform: translateY(-4px); }
.file-preview { width: 100%; }
.file-img { width: 100%; height: 120px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border); }
.file-icon {
    height: 120px; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 8px;
    font-size: 2.8rem; color: var(--accent);
    filter: drop-shadow(0 0 10px rgba(251,191,36,0.2));
}
.file-ext { font-size: 0.65rem; font-family: 'JetBrains Mono', monospace; color: var(--text-secondary); letter-spacing: 2px; }
.file-name {
    font-size: 0.75rem; font-weight: 700; color: var(--text-secondary);
    font-family: 'JetBrains Mono', monospace; white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
}
.file-actions { display: flex; gap: 8px; }
.file-btn { flex: 1; justify-content: center; padding: 10px 8px; font-size: 0.8rem; border-radius: 12px; }

.vault-empty {
    grid-column: 1 / -1; text-align: center; padding: 5rem 2rem;
    display: flex; flex-direction: column; align-items: center; gap: 1rem;
}
.vault-empty i { font-size: 3.5rem; color: var(--text-secondary); opacity: 0.2; }
.vault-empty p { color: var(--text-secondary); font-weight: 300; }

/* ── Responsive ──────────────────────────────────── */
@media (max-width: 900px) {
    .vault-top-row { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .upload-card { padding: 1.8rem 1.2rem; }
    .upload-icon { font-size: 2.5rem; }
    .upload-title { font-size: 1.4rem; }
    .stats-card { padding: 1.4rem; }
    .vault-table-header { padding: 1rem 1.2rem; }
    .vault-files-grid { grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; padding: 1.2rem; }
    .vault-table-title { font-size: 1.2rem; }
    .mini-stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 400px) {
    .vault-files-grid { grid-template-columns: 1fr 1fr; gap: 10px; padding: 1rem; }
}
</style>

<script>
function updateFileName(input) {
    const display = document.getElementById('file-name-display');
    if (input.files && input.files[0]) {
        display.textContent = input.files[0].name;
    }
}
</script>

@endsection
