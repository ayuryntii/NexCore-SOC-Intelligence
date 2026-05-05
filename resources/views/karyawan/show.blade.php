@extends('layouts.master')

@section('title', 'PERSONNEL_PROFILE')

@push('styles')
<style>
    .profile-container {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
        margin-top: 1rem;
    }
    
    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
    }

    .profile-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .photo-frame {
        position: relative;
        width: 100%;
        aspect-ratio: 1/1;
        border: 1px solid var(--sys-border);
        background: rgba(0, 243, 255, 0.05);
        padding: 15px;
        box-sizing: border-box;
        overflow: hidden;
    }

    .photo-frame::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 2px;
        background: var(--sys-primary);
        box-shadow: 0 0 15px var(--sys-primary);
        z-index: 10;
        animation: scanline 3s linear infinite;
    }

    @keyframes scanline {
        0% { top: 0; }
        100% { top: 100%; }
    }

    .photo-content {
        width: 100%;
        height: 100%;
        overflow: hidden;
        border: 1px solid rgba(0, 243, 255, 0.3);
        position: relative;
    }

    .photo-content::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06));
        background-size: 100% 2px, 3px 100%;
        pointer-events: none;
    }

    .photo-content img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: contrast(1.1) brightness(0.9) saturate(1.2);
        transition: all 0.5s;
    }

    .photo-frame:hover img {
        transform: scale(1.05);
        filter: contrast(1.2) brightness(1.1) saturate(1.3);
    }

    .status-badge {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        padding: 0.6rem;
        text-align: center;
        background: rgba(0, 255, 136, 0.05);
        color: #00ff88;
        border: 1px solid rgba(0, 255, 136, 0.3);
        letter-spacing: 3px;
        font-weight: bold;
        text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
    }

    .data-section {
        background: linear-gradient(135deg, rgba(0, 243, 255, 0.03) 0%, rgba(0, 243, 255, 0.01) 100%);
        border: 1px solid var(--sys-border);
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .data-section::before {
        content: 'CONFIDENTIAL';
        position: absolute;
        top: 10px; right: 10px;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        color: var(--sys-secondary);
        opacity: 0.3;
        letter-spacing: 2px;
    }

    .section-title {
        font-family: var(--font-mono);
        font-size: 0.8rem;
        color: var(--sys-primary);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        border-bottom: 1px solid rgba(0, 243, 255, 0.1);
        padding-bottom: 0.8rem;
        letter-spacing: 1px;
    }

    .info-group {
        margin-bottom: 2rem;
    }

    .info-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        color: var(--sys-primary);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
        opacity: 0.7;
    }

    .info-value {
        font-family: var(--font-mono);
        font-size: 1.2rem;
        color: #fff;
        padding-left: 15px;
        border-left: 3px solid var(--sys-primary);
        background: rgba(0, 243, 255, 0.02);
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .mini-stat {
        background: rgba(13, 17, 23, 0.6);
        border: 1px solid var(--sys-border);
        padding: 1.2rem;
        text-align: center;
        position: relative;
    }

    .mini-stat::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 2px;
        background: var(--sys-primary);
        transform: scaleX(0);
        transition: 0.3s;
    }

    .mini-stat:hover::after {
        transform: scaleX(1);
    }

    .mini-stat .val {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--sys-primary);
        font-family: var(--font-mono);
    }

    .mini-stat .lbl {
        font-size: 0.6rem;
        color: var(--sys-text-muted);
        text-transform: uppercase;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        border: 1px solid var(--sys-border);
        font-family: var(--font-mono);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
        background: transparent;
        color: var(--sys-text);
        text-decoration: none;
    }

    .btn-back:hover {
        border-color: var(--sys-primary);
        background: rgba(0, 243, 255, 0.05);
        color: var(--sys-primary);
    }

    .card-corners {
        position: relative;
        background: rgba(13, 17, 23, 0.8);
        border: 1px solid var(--sys-border);
        padding: 1.5rem;
    }

    .card-corners::before, .card-corners::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 2px solid var(--sys-primary);
        pointer-events: none;
    }

    .card-corners::before { top: -2px; left: -2px; border-right: 0; border-bottom: 0; }
    .card-corners::after { bottom: -2px; right: -2px; border-left: 0; border-top: 0; }

    .nik-badge {
        background: var(--sys-primary);
        color: #000;
        padding: 2px 8px;
        font-size: 0.7rem;
        font-weight: bold;
        margin-left: 10px;
        vertical-align: middle;
    }
</style>
@endpush

@section('content')
<div class="card-corners" data-aos="fade-up">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--sys-border); padding-bottom: 1rem; margin-bottom: 2rem;">
        <h2 style="margin-bottom: 0; color: var(--sys-primary);">
            <i class="fas fa-user-shield"></i> PERSONNEL_PROFILE
            <span class="nik-badge">{{ $karyawan->nik ?? 'UNASSIGNED' }}</span>
        </h2>
        <a href="{{ route('karyawan.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> KEMBALI
        </a>
    </div>

    <div class="profile-container">
        <!-- Sidebar -->
        <div class="profile-sidebar" data-aos="fade-right" data-aos-delay="100">
            <div class="photo-frame">
                <div class="photo-content">
                    <img src="{{ $karyawan->foto_url }}" alt="{{ $karyawan->nama }}">
                </div>
            </div>
            <div class="status-badge">
                <i class="fas fa-circle" style="font-size: 0.5rem; vertical-align: middle; margin-right: 5px;"></i> SYSTEM_ACTIVE
            </div>
            
            <div class="mini-stat" style="margin-top: 0.5rem;">
                <div class="lbl">MEMBER_SINCE</div>
                <div class="val" style="font-size: 0.8rem;">{{ $karyawan->created_at->format('M Y') }}</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="profile-main" data-aos="fade-left" data-aos-delay="200">
            <div class="data-section">
                <div class="section-title"><i class="fas fa-id-card-alt"></i> PRIMARY_IDENTIFICATION</div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div class="info-group">
                        <div class="info-label">FULL_NAME</div>
                        <div class="info-value">{{ strtoupper($karyawan->nama) }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">ASSIGNED_ROLE</div>
                        <div class="info-value">{{ strtoupper($karyawan->jabatan) }}</div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div class="info-group">
                        <div class="info-label">PERSONNEL_AGE</div>
                        <div class="info-value">{{ $karyawan->usia }} YEARS_OLD</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">INTERNAL_ID</div>
                        <div class="info-value">#{{ str_pad($karyawan->id_karyawan, 4, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-label">CURRENT_COORDINATES / ADDRESS</div>
                    <div class="info-value" style="font-size: 0.9rem; line-height: 1.5;">{{ $karyawan->alamat }}</div>
                </div>
            </div>

            <div class="stats-grid" style="margin-top: 2rem;">
                <div class="mini-stat">
                    <div class="val">{{ $totalKaryawan }}</div>
                    <div class="lbl">TOTAL_NODES</div>
                </div>
                <div class="mini-stat">
                    <div class="val">{{ $samePosition }}</div>
                    <div class="lbl">DEPT_PEERS</div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}" class="btn-primary" style="flex: 1; text-align: center; justify-content: center;">
                    <i class="fas fa-edit"></i> MODIFY_PERSONNEL_DATA
                </a>
                <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}" method="POST" onsubmit="return confirm('APAKAH ANDA YAKIN INGIN MENGHAPUS DATA INI?')" style="flex: 1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-outline" style="width: 100%; border-color: #ff00ff; color: #ff00ff; cursor: pointer; justify-content: center;">
                        <i class="fas fa-user-slash"></i> TERMINATE_RECORD
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div style="margin-top: 2rem; border-top: 1px solid var(--sys-border); padding-top: 1rem; font-family: var(--font-mono); font-size: 0.6rem; color: var(--sys-text-muted); display: flex; justify-content: space-between;">
        <span>LOG_AUTH: SECURE_ENCRYPTED</span>
        <span>LAST_SYNC: {{ $karyawan->updated_at->diffForHumans() }}</span>
    </div>
</div>
@endsection
