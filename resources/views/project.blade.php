@extends('layouts.master')

@section('title', 'DEPROYED_MODULES')

@push('styles')
<style>
    .module-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 2rem;
    }

    .module-hex {
        border: 1px solid var(--sys-border);
        background: rgba(0, 243, 255, 0.02);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }

    .module-hex:hover {
        border-color: var(--sys-primary);
        box-shadow: inset 0 0 20px rgba(0, 243, 255, 0.1);
        transform: translateY(-5px);
    }

    .module-header {
        background: rgba(0, 243, 255, 0.1);
        padding: 1rem;
        border-bottom: 1px solid var(--sys-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: var(--font-mono);
    }

    .module-body {
        padding: 2rem;
        flex: 1;
    }

    .module-id { color: var(--sys-primary); font-size: 0.7rem; }
    .module-name { font-family: var(--font-mono); color: #fff; font-size: 1.2rem; margin-bottom: 1rem; font-weight: 700; }
    .module-tags { color: var(--sys-success); font-family: var(--font-mono); font-size: 0.75rem; margin-bottom: 1.5rem; }
    .module-desc { color: var(--sys-text-muted); font-size: 0.9rem; line-height: 1.7; margin-bottom: 2rem; }

    .module-stats {
        background: #000;
        padding: 1rem;
        border: 1px solid #222;
        font-family: var(--font-mono);
        font-size: 0.7rem;
        color: var(--sys-text-muted);
    }
</style>
@endpush

@section('content')
<div data-aos="fade-in">
    <h1>DEPLOYED <span>PROJECT_MODULES</span></h1>
    <p style="color: var(--sys-text-muted); font-family: var(--font-mono); margin-bottom: 3rem;">
        > LISTING: /ROOT/BIN/PROJECTS/*<br>
        > TOTAL_ITEMS: {{ count($projects) }}
    </p>

    <div class="module-grid">
        @foreach($projects as $index => $project)
        <div class="module-hex" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
            <div class="module-header">
                <span class="module-id">ID: {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</span>
                <i class="fas {{ $project['image_icon'] }}" style="color: var(--sys-primary);"></i>
            </div>
            <div class="module-body">
                <div class="module-name">{{ strtoupper($project['nama']) }}</div>
                <div class="module-tags">// TECH_STACK: {{ strtoupper($project['teknologi']) }}</div>
                <div class="module-desc">{{ $project['deskripsi'] }}</div>
                
                <div class="module-stats">
                    <span style="color: var(--sys-primary);">[LOG]</span> {{ $project['features'] }}
                </div>
            </div>
            <div style="padding: 1rem; border-top: 1px solid var(--sys-border); text-align: right;">
                <a href="{{ $project['link'] }}" target="_blank" class="btn-outline" style="padding: 0.4rem 1rem; font-size: 0.7rem;">
                    ACCESS_GITHUB_REPO <i class="fab fa-github"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
