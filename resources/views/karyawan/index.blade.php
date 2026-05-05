@extends('layouts.master')

@section('title', 'KARYAWAN_DB')

@push('styles')
<style>
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-family: var(--font-mono);
        margin-top: 1.5rem;
        background: rgba(0, 243, 255, 0.01);
    }
    .data-table th {
        background: linear-gradient(180deg, rgba(0, 243, 255, 0.1) 0%, rgba(0, 243, 255, 0.05) 100%);
        color: var(--sys-primary);
        text-align: left;
        padding: 1.2rem 1rem;
        border-bottom: 2px solid var(--sys-border);
        font-size: 0.75rem;
        letter-spacing: 2px;
        position: relative;
        overflow: hidden;
    }
    .data-table th::after {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 243, 255, 0.1), transparent);
        animation: table-scan 4s linear infinite;
    }
    @keyframes table-scan {
        0% { left: -100%; }
        50% { left: 100%; }
        100% { left: 100%; }
    }
    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--sys-border);
        color: var(--sys-text);
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    .data-table tr:hover td {
        background: rgba(0, 243, 255, 0.05);
        color: var(--sys-primary);
        text-shadow: 0 0 5px rgba(0, 243, 255, 0.5);
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

    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }
    .pagination-container .page-item .page-link {
        background: rgba(0, 243, 255, 0.02);
        border: 1px solid var(--sys-border);
        color: var(--sys-primary);
        padding: 0.5rem 0.8rem;
        text-decoration: none;
        font-family: var(--font-mono);
        font-size: 0.8rem;
        transition: all 0.3s;
    }
    .pagination-container .page-item.active .page-link {
        background: var(--sys-primary);
        color: #000;
        border-color: var(--sys-primary);
        box-shadow: 0 0 10px var(--sys-primary);
    }
    .pagination-container .page-item .page-link:hover:not(.active) {
        border-color: var(--sys-primary);
        background: rgba(0, 243, 255, 0.1);
    }

    .search-container {
        position: relative;
        margin-bottom: 0;
        max-width: 400px;
    }
    .search-input {
        width: 100%;
        background: rgba(0, 243, 255, 0.02);
        border: 1px solid var(--sys-border);
        padding: 0.8rem 1rem 0.8rem 2.5rem;
        color: var(--sys-primary);
        font-family: var(--font-mono);
        font-size: 0.85rem;
        transition: all 0.3s;
        outline: none;
    }
    .search-input:focus {
        border-color: var(--sys-primary);
        background: rgba(0, 243, 255, 0.05);
        box-shadow: 0 0 15px rgba(0, 243, 255, 0.1);
    }
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--sys-border);
    }
    .clear-search {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--sys-secondary);
        cursor: pointer;
        text-decoration: none;
    }

    .btn-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--sys-border);
        background: rgba(255, 255, 255, 0.02);
        color: var(--sys-text);
        transition: all 0.3s;
        border-radius: 4px;
        text-decoration: none;
    }
    .btn-icon-show { border-color: #00ff88; color: #00ff88; }
    .btn-icon-show:hover { background: #00ff88; color: #000; box-shadow: 0 0 15px #00ff88; }
    .btn-icon-edit:hover { background: var(--sys-primary); color: #000; box-shadow: 0 0 15px var(--sys-primary); }
    .btn-icon-delete:hover { background: var(--sys-secondary); color: #000; box-shadow: 0 0 15px var(--sys-secondary); }

    .stats-hud {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    .stat-card {
        background: rgba(0, 243, 255, 0.02);
        border: 1px solid var(--sys-border);
        padding: 1.2rem;
        position: relative;
        transition: all 0.3s;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 4px; height: 100%;
        background: var(--sys-primary);
        opacity: 0.5;
    }
    .stat-card:hover {
        background: rgba(0, 243, 255, 0.05);
        border-color: var(--sys-primary);
        transform: translateY(-3px);
    }
    .stat-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        color: var(--sys-text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .stat-value {
        font-family: var(--font-mono);
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--sys-primary);
    }
    .stat-unit {
        font-size: 0.7rem;
        color: var(--sys-text-muted);
        margin-left: 0.3rem;
    }
    .stat-icon-bg {
        position: absolute;
        right: 10px;
        bottom: 10px;
        font-size: 2.5rem;
        color: var(--sys-primary);
        opacity: 0.1;
    }
</style>
@endpush

@section('content')
<div class="animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10 pb-8 border-b border-emerald-500/10">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                <p class="text-[10px] font-mono text-emerald-500/60 uppercase tracking-[0.4em] font-black">Authorized_Access_Only</p>
            </div>
            <h2 class="text-4xl font-black text-white outfit-font tracking-tighter uppercase leading-none">PERSONNEL_DIRECTORY<span class="text-emerald-500 animate-pulse">_</span></h2>
        </div>
        <a href="{{ route('karyawan.create') }}" class="group px-6 py-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl font-mono text-[10px] font-black tracking-[0.2em] uppercase transition-all hover:bg-emerald-500 hover:text-slate-950 hover:shadow-[0_0_20px_rgba(16,185,129,0.3)]">
            <i class="fas fa-plus mr-2"></i> APPEND_NEW_RECORD
        </a>
    </div>

    <!-- Stats HUD -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        @php
            $kStats = [
                ['label' => 'Total_Staff', 'val' => $stats['total'], 'unit' => 'UNITS', 'icon' => 'fa-users'],
                ['label' => 'Avg_Age_Index', 'val' => $stats['avg_age'], 'unit' => 'YRS', 'icon' => 'fa-hourglass-half'],
                ['label' => 'Active_Clusters', 'val' => $stats['unique_roles'], 'unit' => 'DEPT', 'icon' => 'fa-network-wired'],
                ['label' => 'Primary_Sector', 'val' => Str::limit($stats['top_role'], 12), 'unit' => '', 'icon' => 'fa-award'],
            ];
        @endphp
        @foreach($kStats as $ks)
        <div class="bg-slate-900/40 backdrop-blur-md border border-slate-800 p-5 rounded-2xl relative overflow-hidden group hover:border-emerald-500/30 transition-all">
            <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500/20 group-hover:bg-emerald-500 transition-colors"></div>
            <div class="relative z-10">
                <p class="text-[9px] font-mono text-slate-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <i class="fas {{ $ks['icon'] }} text-emerald-500/50"></i>
                    {{ $ks['label'] }}
                </p>
                <h3 class="text-2xl font-black text-white font-mono tracking-tighter">{{ $ks['val'] }} <span class="text-[10px] text-slate-600 ml-1">{{ $ks['unit'] }}</span></h3>
            </div>
        </div>
        @endforeach
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-500/5 border border-emerald-500/20 text-emerald-400 rounded-xl font-mono text-[10px] font-black tracking-widest flex items-center gap-3">
            <i class="fas fa-check-circle"></i> [LOG]: {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8">
        <form action="{{ route('karyawan.index') }}" method="GET" class="relative w-full md:w-96 group">
            <input type="text" name="search" class="w-full bg-slate-900/50 border border-slate-800 focus:border-emerald-500/50 rounded-xl px-10 py-3 text-xs font-mono text-emerald-400 outline-none transition-all" placeholder="QUERY_PERSONNEL_HASH..." value="{{ request('search') }}">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-600 group-focus-within:text-emerald-500 transition-colors"></i>
            @if(request('search'))
                <a href="{{ route('karyawan.index') }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-600 hover:text-rose-500"><i class="fas fa-times"></i></a>
            @endif
        </form>

        <div class="font-mono text-[10px] text-slate-500 uppercase tracking-widest">
            Stream: <span class="text-emerald-500 font-black">{{ $karyawan->firstItem() ?? 0 }}-{{ $karyawan->lastItem() ?? 0 }}</span> // Total: <span class="text-emerald-500 font-black">{{ $karyawan->total() }}</span>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>FOTO</th>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>USIA</th>
                    <th>ALAMAT</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($karyawan as $index => $item)
                <tr data-aos="fade-right" data-aos-delay="{{ $index * 50 }}">
                    <td style="color: var(--sys-primary);">{{ $loop->iteration + ($karyawan->currentPage() - 1) * $karyawan->perPage() }}</td>
                    <td>
                        <div style="position: relative; width: 45px; height: 45px; border-radius: 50%; padding: 2px; background: linear-gradient(45deg, var(--sys-primary), transparent); box-shadow: 0 0 10px rgba(0, 243, 255, 0.2);">
                            <div style="width: 100%; height: 100%; background: #000; border-radius: 50%; overflow: hidden; border: 1px solid rgba(0, 243, 255, 0.3);">
                                <img src="{{ $item->foto_url }}" style="width: 100%; height: 100%; object-fit: cover; transition: 0.3s;">
                            </div>
                        </div>
                    </td>
                    <td style="color: var(--sys-primary); font-family: var(--font-mono); font-size: 0.7rem; letter-spacing: 1px;">{{ $item->nik ?? 'N/A' }}</td>
                    <td style="font-weight: bold; color: #fff;">{{ strtoupper($item->nama) }}</td>
                    <td><span style="color: var(--sys-primary); border-bottom: 1px solid rgba(0, 243, 255, 0.3);">{{ strtoupper($item->jabatan) }}</span></td>
                    <td>{{ $item->usia }}</td>
                    <td style="font-size: 0.75rem; color: var(--sys-text-muted);">{{ Str::limit($item->alamat, 20) }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <!-- Tombol DETAIL (BARU) -->
                            <a href="{{ route('karyawan.show', $item->id_karyawan) }}" class="btn-icon btn-icon-show" title="DETAIL">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Tombol EDIT -->
                            <a href="{{ route('karyawan.edit', $item->id_karyawan) }}" class="btn-icon btn-icon-edit" title="EDIT">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Tombol DELETE -->
                            <form action="{{ route('karyawan.destroy', $item->id_karyawan) }}" method="POST" onsubmit="return confirm('APAKAH ANDA YAKIN INGIN MENGHAPUS DATA INI?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon-delete" style="background: transparent; cursor: pointer;" title="DELETE">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 3rem; color: var(--sys-text-muted);">
                        -- NO_RECORDS_FOUND_IN_DATABASE --
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $karyawan->links() }}
    </div>
</div>
@endsection
