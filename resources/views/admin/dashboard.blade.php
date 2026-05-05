@extends('layouts.admin')

@section('header', 'SOC_COMMAND_CENTER')

@section('content')

{{-- SOC TOP STATUS --}}
<div class="mb-10 flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8 animate-in fade-in slide-in-from-top-4 duration-700">
    <div>
        <div class="flex items-center gap-3 mb-2">
            <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-[10px] font-mono font-black border border-emerald-500/20 uppercase tracking-widest animate-pulse">Session_Secure</span>
            <div class="h-px w-8 bg-slate-800"></div>
            <p class="text-[10px] font-mono text-slate-500 uppercase tracking-[0.3em] font-bold">Operator: {{ Auth::user()->name }}</p>
        </div>
        <h1 class="text-5xl font-black text-white outfit-font tracking-tighter leading-none">
            INTELLIGENCE_OVERVIEW<span class="text-emerald-500 animate-pulse">_</span>
        </h1>
    </div>
    
    <div class="flex items-center gap-4">
        <div class="hidden md:block text-right mr-4">
            <p class="text-[10px] font-mono text-slate-500 uppercase font-black tracking-widest">Local_Timestamp</p>
            <p class="text-sm font-mono text-white font-black">{{ now()->format('H:i:s') }} <span class="text-emerald-500">UTC+7</span></p>
        </div>
        <a href="{{ route('posts.create') }}" class="group relative px-8 py-4 bg-emerald-500 text-slate-950 rounded-2xl font-black font-mono text-xs tracking-widest transition-all hover:scale-105 shadow-[0_0_30px_rgba(16,185,129,0.3)] overflow-hidden">
            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 skew-x-12"></div>
            <span class="relative flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                INIT_NEW_INTEL
            </span>
        </a>
    </div>
</div>

{{-- METRIC GRID --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    @php
        $statsData = [
            ['label' => 'Total_Articles', 'val' => $stats['posts'] ?? 0, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'emerald'],
            ['label' => 'Live_Clusters', 'val' => $stats['categories'] ?? 0, 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', 'color' => 'blue'],
            ['label' => 'Verified_Users', 'val' => $stats['users'] ?? 0, 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'purple'],
            ['label' => 'Global_Threats', 'val' => 0, 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 17c-.77 1.333.192 3 1.732 3z', 'color' => 'rose'],
        ];
    @endphp

    @foreach($statsData as $stat)
    <div class="relative group bg-slate-900/50 backdrop-blur-md border border-slate-800 p-6 rounded-3xl overflow-hidden transition-all hover:border-{{ $stat['color'] }}-500/50 hover:shadow-[0_0_30px_rgba(0,0,0,0.5)]">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
            <svg class="w-20 h-20 text-{{ $stat['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="{{ $stat['icon'] }}"></path></svg>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-2 h-2 rounded-full bg-{{ $stat['color'] }}-500 animate-pulse"></div>
                <p class="text-[10px] font-mono text-slate-500 uppercase tracking-[0.2em] font-black">{{ $stat['label'] }}</p>
            </div>
            <div class="flex items-baseline gap-2">
                <h3 class="text-4xl font-black text-white font-mono tabular-nums tracking-tighter">{{ $stat['val'] }}</h3>
                <span class="text-[10px] font-mono text-emerald-500 font-bold">+0%</span>
            </div>
            <div class="mt-4 h-1 w-full bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full bg-{{ $stat['color'] }}-500 w-2/3 rounded-full shadow-[0_0_10px_#10b981]"></div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- SOC PANELS --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- Telemetry Panel --}}
    <div class="bg-slate-900/50 backdrop-blur-md border border-slate-800 rounded-3xl overflow-hidden flex flex-col">
        <div class="p-6 border-b border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="absolute inset-0 bg-emerald-500 rounded-full animate-ping opacity-20"></div>
                    <div class="relative w-2 h-2 bg-emerald-500 rounded-full"></div>
                </div>
                <h3 class="text-xs font-mono font-black text-white uppercase tracking-[0.2em]">System_Pulse</h3>
            </div>
            <div class="flex gap-1">
                <div class="w-1 h-3 bg-emerald-500/40 rounded-full animate-[bounce_1s_infinite]"></div>
                <div class="w-1 h-5 bg-emerald-500 rounded-full animate-[bounce_1.2s_infinite]"></div>
                <div class="w-1 h-2 bg-emerald-500/20 rounded-full animate-[bounce_0.8s_infinite]"></div>
            </div>
        </div>
        <div class="p-8 space-y-8 flex-grow">
            @php
                $telemetry = [
                    ['label' => 'Neural_Link_Latency', 'val' => '14ms', 'progress' => 85, 'color' => 'emerald'],
                    ['label' => 'Database_Entropy', 'val' => '0.04%', 'progress' => 12, 'color' => 'blue'],
                    ['label' => 'Cipher_Load_Index', 'val' => '24.1', 'progress' => 44, 'color' => 'purple'],
                    ['label' => 'Intrusion_Shield', 'val' => 'Active', 'progress' => 100, 'color' => 'emerald'],
                ];
            @endphp
            @foreach($telemetry as $t)
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-[10px] font-mono text-slate-400 uppercase tracking-widest">{{ $t['label'] }}</span>
                    <span class="text-[10px] font-mono text-white font-black">{{ $t['val'] }}</span>
                </div>
                <div class="h-1.5 w-full bg-slate-800/50 rounded-full border border-slate-700/30 p-[1px]">
                    <div class="h-full bg-{{ $t['color'] }}-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.3)] transition-all duration-1000" style="width: {{ $t['progress'] }}%"></div>
                </div>
            </div>
            @endforeach
            
            <div class="mt-8 p-4 bg-emerald-500/5 border border-emerald-500/20 rounded-2xl">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span class="text-[10px] font-mono font-black text-emerald-400 uppercase tracking-widest">FIREWALL_STABLE</span>
                </div>
                <p class="text-[9px] font-mono text-slate-500 leading-relaxed uppercase">No malicious vectors detected in the last 24 orbital cycles. Encryption layer: AES-256-GCM.</p>
            </div>
        </div>
    </div>

    {{-- Intelligence Stream Panel --}}
    <div class="lg:col-span-2 bg-slate-900/50 backdrop-blur-md border border-slate-800 rounded-3xl overflow-hidden">
        <div class="p-6 border-b border-slate-800 flex items-center justify-between bg-slate-900/30">
            <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_#3b82f6]"></div>
                <h3 class="text-xs font-mono font-black text-white uppercase tracking-[0.2em]">Intelligence_Stream</h3>
            </div>
            <a href="{{ route('posts.index') }}" class="text-[10px] font-mono text-emerald-500 hover:text-emerald-400 font-black uppercase tracking-widest transition-colors">ACCESS_ALL_NODES //</a>
        </div>
        
        <div class="divide-y divide-slate-800/50">
            @forelse(\App\Models\Post::with(['category','user'])->latest()->take(5)->get() as $post)
            <div class="group p-6 flex items-center gap-6 hover:bg-emerald-500/5 transition-all">
                <div class="relative w-16 h-16 rounded-2xl overflow-hidden border border-slate-700 flex-shrink-0 group-hover:border-emerald-500/50 transition-colors">
                    <img src="{{ $post->image_url }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-500" alt="">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
                </div>
                
                <div class="flex-grow min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-[9px] font-mono font-black px-2 py-0.5 rounded border border-emerald-500/30 text-emerald-400 uppercase tracking-tighter">{{ $post->category->name ?? 'UNKNOWN' }}</span>
                        <div class="w-1 h-1 rounded-full bg-slate-700"></div>
                        <span class="text-[9px] font-mono text-slate-500 uppercase font-bold">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <h4 class="text-base font-black text-white truncate group-hover:text-emerald-400 transition-colors outfit-font">{{ $post->title }}</h4>
                    <p class="text-[10px] font-mono text-slate-500 mt-1 uppercase tracking-tight truncate">Hash: {{ md5($post->id) }} // Author: {{ $post->user->name ?? 'SYSTEM' }}</p>
                </div>
                
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all">
                    <a href="{{ route('posts.edit', $post) }}" class="p-3 rounded-xl bg-slate-800 text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 border border-slate-700 hover:border-emerald-500/30 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="py-20 text-center">
                <p class="text-xs font-mono text-slate-600 uppercase tracking-widest font-black">Waiting for intelligence input...</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- SOC TERMINAL FOOTER --}}
<div class="mt-8 bg-slate-900/80 backdrop-blur-md border border-slate-800 rounded-3xl p-6 font-mono">
    <div class="flex items-center gap-3 mb-4">
        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
        <span class="text-[10px] text-emerald-500 font-black uppercase tracking-widest">Security_Log_Feed</span>
    </div>
    <div class="space-y-1">
        <p class="text-[10px] text-slate-500"><span class="text-emerald-600">[{{ now()->subMinutes(5)->format('H:i:s') }}]</span> AUTH_SUCCESS: Operator '{{ Auth::user()->name }}' linked to Core_Module.</p>
        <p class="text-[10px] text-slate-500"><span class="text-emerald-600">[{{ now()->subMinutes(2)->format('H:i:s') }}]</span> DB_SYNC: Refreshing intelligence clusters... 100% Complete.</p>
        <p class="text-[10px] text-slate-500"><span class="text-emerald-600">[{{ now()->format('H:i:s') }}]</span> KERNEL: All sub-systems nominal. Monitoring active.</p>
    </div>
</div>

@endsection
