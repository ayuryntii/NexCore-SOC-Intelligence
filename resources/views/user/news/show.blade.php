@extends('layouts.app')

@section('title', $post->title)

@push('styles')
<style>
    .intel-container {
        position: relative;
        overflow: hidden;
    }

    .neural-scan {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 2px;
        background: rgba(16, 185, 129, 0.5);
        box-shadow: 0 0 15px #10b981;
        animation: scan-v 4s linear infinite;
        z-index: 20;
    }

    @keyframes scan-v {
        0% { top: 0; opacity: 0; }
        5% { opacity: 1; }
        95% { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }

    .report-card {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(16, 185, 129, 0.1);
        border-radius: 2rem;
        position: relative;
        overflow: hidden;
    }

    .report-card::after {
        content: 'CLASSIFIED_INTEL';
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        font-size: 8rem;
        font-weight: 900;
        color: rgba(16, 185, 129, 0.03);
        pointer-events: none;
        white-space: nowrap;
        z-index: 0;
    }

    .tech-sidebar {
        background: rgba(2, 6, 23, 0.4);
        border-radius: 1.5rem;
        border: 1px border-slate-800;
        padding: 2rem;
    }

    .data-point {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(16, 185, 129, 0.05);
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px;
    }

    .cyber-dropcap::first-letter {
        font-family: 'Outfit', sans-serif;
        font-size: 4rem;
        font-weight: 900;
        float: left;
        line-height: 1;
        margin-right: 0.75rem;
        color: #10b981;
        text-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 intel-container">
    <!-- Header Protocol -->
    <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-8 border-b border-emerald-500/10 pb-12">
        <div class="flex-grow">
            <nav class="mb-8 flex items-center gap-3 font-mono text-[10px] uppercase tracking-[0.4em] text-slate-500">
                <span class="text-emerald-500/50">SECURE_ROOT</span>
                <span>/</span>
                <a href="/?category={{ $post->category->slug }}" class="hover:text-emerald-400 transition-colors">{{ str_replace(' ', '_', strtoupper($post->category->name)) }}</a>
                <span>/</span>
                <span class="bg-emerald-500/10 px-2 py-0.5 rounded text-emerald-400 border border-emerald-500/20">PKT_{{ sprintf('%06d', $post->id) }}</span>
            </nav>
            
            <div class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-emerald-500/5 border border-emerald-500/20 text-[9px] font-mono font-black text-emerald-500 uppercase tracking-widest mb-6">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Verified_Integrity_Report
            </div>
            
            <h1 class="text-4xl md:text-7xl font-black text-white tracking-tighter leading-[0.95] outfit-font max-w-4xl">
                {{ $post->title }}<span class="text-emerald-500 animate-pulse">_</span>
            </h1>
        </div>
        
        <div class="md:text-right font-mono">
            <div class="text-[9px] text-slate-500 uppercase tracking-widest mb-1">Time_Hash</div>
            <div class="text-lg text-emerald-400 font-bold tracking-tighter">{{ $post->created_at->format('Y.m.d // H:i') }}</div>
            <div class="text-[10px] text-slate-600 mt-2">UUID: {{ md5($post->slug) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 relative z-10">
        <!-- Intelligence Payload -->
        <div class="lg:col-span-8 space-y-12">
            <!-- Neural Scan Media -->
            <div class="relative group report-card border-emerald-500/20 shadow-2xl overflow-hidden aspect-[21/9]">
                <div class="neural-scan"></div>
                <div class="absolute inset-0 bg-emerald-500/10 z-10 mix-blend-color pointer-events-none"></div>
                <img src="{{ $post->image_url }}" 
                     class="w-full h-full object-cover filter contrast-125 brightness-75 grayscale-[0.3] group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-105"
                     onerror="this.src='https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=1200&q=80'">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                
                <!-- HUD Overlays -->
                <div class="absolute top-6 right-6 p-4 bg-black/40 backdrop-blur-md rounded-xl border border-white/10 font-mono text-[8px] text-emerald-400 space-y-1">
                    <div>SCAN_RES: 4K_ULTRA</div>
                    <div>FREQ: 5.8GHZ</div>
                    <div class="text-emerald-500 animate-pulse">STATUS: CAPTURED</div>
                </div>
            </div>

            <!-- Content Dossier -->
            <div class="report-card p-8 md:p-16">
                <div class="prose prose-invert prose-emerald max-w-none">
                    <div class="text-slate-200 text-lg md:text-xl leading-[1.8] cyber-dropcap font-medium tracking-tight">
                        @php
                            $paragraphs = explode("\n\n", $post->content);
                        @endphp
                        @foreach($paragraphs as $index => $para)
                            <p class="mb-10 text-justify relative">
                                @if($index == 1)
                                    <div class="my-16 p-8 rounded-3xl bg-emerald-500/5 border border-emerald-500/10 relative overflow-hidden group">
                                        <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500 shadow-[0_0_15px_#10b981]"></div>
                                        <div class="text-[9px] font-mono text-emerald-500 uppercase tracking-widest mb-4">Internal_Analysis_Break</div>
                                        <div class="text-sm italic text-slate-300 leading-relaxed font-serif">
                                            "Further examination of the packet headers reveals a sophisticated obfuscation layer, typical of state-sponsored entities operating in the {{ $post->category->name }} sector."
                                        </div>
                                    </div>
                                @endif
                                {!! nl2br(e($para)) !!}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Metadata -->
        <div class="lg:col-span-4 space-y-8">
            <div class="tech-sidebar">
                <h3 class="text-xs font-mono font-black text-emerald-500 uppercase tracking-[0.3em] mb-8 border-b border-emerald-500/10 pb-4">SECTOR_METADATA</h3>
                
                <div class="space-y-4">
                    <div class="data-point">
                        <span class="text-slate-500">Author_Signature</span>
                        <span class="text-slate-200 font-bold">{{ strtoupper($post->user->name) }}</span>
                    </div>
                    <div class="data-point">
                        <span class="text-slate-500">Category_Cluster</span>
                        <span class="text-blue-400 font-bold">{{ strtoupper($post->category->name) }}</span>
                    </div>
                    <div class="data-point">
                        <span class="text-slate-500">Clearance_Level</span>
                        <span class="text-rose-500 font-bold">LEVEL_5_RESTRICTED</span>
                    </div>
                    <div class="data-point">
                        <span class="text-slate-500">Signal_Source</span>
                        <span class="text-emerald-500 font-bold">IP_{{ rand(10,255) }}.{{ rand(10,255) }}.XX.XX</span>
                    </div>
                </div>

                <div class="mt-10 space-y-6">
                    <div class="p-4 bg-slate-950/80 rounded-xl border border-slate-800">
                        <div class="text-[8px] font-mono text-slate-500 uppercase mb-2">Entropy_Scan</div>
                        <div class="h-1.5 w-full bg-slate-900 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 shadow-[0_0_10px_#10b981]" style="width: 84%"></div>
                        </div>
                    </div>
                    <div class="p-4 bg-slate-950/80 rounded-xl border border-slate-800">
                        <div class="text-[8px] font-mono text-slate-500 uppercase mb-2">Integrity_Coefficient</div>
                        <div class="h-1.5 w-full bg-slate-900 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 shadow-[0_0_10px_#3b82f6]" style="width: 97%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="w-full py-5 bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-black rounded-2xl font-mono text-xs uppercase tracking-widest transition-all hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                DOWNLOAD_RAW_SIGNAL
            </button>
        </div>
    </div>

    <!-- Cluster Expansion -->
    @if($related->count() > 0)
    <div class="mt-32">
        <h3 class="text-2xl font-black font-mono text-white mb-12 flex items-center gap-4">
            <span class="w-12 h-1 px-1 bg-emerald-500/20 rounded-full">
                <span class="block h-full bg-emerald-500 animate-[cyber-move-h_2s_linear_infinite]"></span>
            </span>
            RELATED_INTEL_STREAM
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($related as $rel)
            <a href="/news/{{ $rel->slug }}" class="group relative report-card p-6 transition-all duration-500 hover:-translate-y-2 border-slate-800 hover:border-emerald-500/40">
                <div class="aspect-video rounded-xl overflow-hidden mb-6 relative">
                    <div class="absolute inset-0 bg-emerald-500/10 z-10 mix-blend-color opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <img src="{{ $rel->image_url }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000">
                </div>
                <div class="text-[9px] font-mono text-emerald-500 uppercase mb-3 tracking-widest">{{ $rel->category->name }}</div>
                <h4 class="text-lg font-bold text-slate-100 group-hover:text-emerald-400 transition-colors line-clamp-2 leading-tight outfit-font">{{ $rel->title }}</h4>
                <div class="mt-6 flex items-center justify-between text-[8px] font-mono text-slate-600 uppercase tracking-[0.2em] pt-4 border-t border-slate-800">
                    <span>{{ $rel->created_at->format('Y.m.d') }}</span>
                    <span class="text-emerald-500 opacity-0 group-hover:opacity-100 transition-all">ACCESS_PKT →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
