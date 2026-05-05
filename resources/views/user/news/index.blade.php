@extends('layouts.app')

@section('title', 'Intelligence Feed')

@push('styles')
<style>
    .mouse-follower {
        position: fixed;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        transform: translate(-50%, -50%);
        transition: width 0.3s, height 0.3s;
    }

    .hero-glitch {
        animation: hero-glitch 10s linear infinite;
    }

    @keyframes hero-glitch {
        0%, 100% { transform: translate(0); }
        1% { transform: translate(-2px, 1px); }
        2% { transform: translate(2px, -1px); }
        3% { transform: translate(0); }
    }

    .stagger-card {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .stagger-card.reveal {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<div id="mouse-glow" class="mouse-follower"></div>

<!-- Moving Hero Section -->
<div class="relative mb-20 rounded-[3rem] overflow-hidden glass-card border-emerald-500/20 p-12 min-h-[550px] flex items-center group bg-slate-900 shadow-[0_0_50px_rgba(0,0,0,0.5)]">
    <!-- Animated Background Image -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="hero-image-container w-full h-full transform scale-110">
            <img src="{{ asset('images/cyber_security_hero.png') }}" alt="Cyber Security" class="w-full h-full object-cover opacity-50 mix-blend-overlay animate-kenburns">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/90 to-transparent"></div>
        
        <!-- Tech Grid Overlay -->
        <div class="absolute inset-0 opacity-20" style="background-image: linear-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(16, 185, 129, 0.1) 1px, transparent 1px); background-size: 50px 50px;"></div>
    </div>

    <div class="relative z-10 max-w-3xl">
        <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 mb-8 hero-glitch">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="text-[11px] font-mono text-emerald-400 font-black uppercase tracking-[0.3em]">SECURE_NODE_04 // ACTIVE</span>
        </div>
        <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter mb-8 leading-[0.9] outfit-font">
            THE PULSE OF <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-500 animate-gradient-x">FUTURE_TECH</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl mb-12 font-medium leading-relaxed max-w-2xl font-mono">
            >> Accessing encrypted intelligence streams... <br>
            >> Analyzing global threat vectors in real-time...
        </p>
        <div class="flex flex-wrap gap-6">
            <a href="#feed" class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 px-10 py-4 rounded-2xl font-black transition-all cyber-btn shadow-[0_0_20px_rgba(16,185,129,0.4)] font-mono tracking-widest text-sm">ENGAGE_FEED</a>
            <a href="/register" class="bg-slate-950/50 backdrop-blur-md border border-emerald-500/30 hover:border-emerald-500 text-emerald-400 px-10 py-4 rounded-2xl font-bold transition-all hover:bg-emerald-500/10 font-mono tracking-widest text-sm">ENROLL_SYSTEM</a>
        </div>
    </div>
</div>

<div id="feed" class="mb-20">
    <div class="flex flex-col xl:flex-row justify-between items-stretch xl:items-center gap-10">
        <!-- Technical Header -->
        <div class="flex items-center gap-8 group">
            <div class="relative w-24 h-24 flex items-center justify-center">
                <!-- Spinning HUD Ring -->
                <div class="absolute inset-0 border-2 border-dashed border-emerald-500/30 rounded-full animate-[spin_10s_linear_infinite]"></div>
                <div class="absolute inset-2 border border-emerald-500/10 rounded-full"></div>
                <div class="relative z-10 w-16 h-16 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center shadow-[0_0_30px_rgba(16,185,129,0.1)] group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-emerald-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
            
            <div class="space-y-2">
                <h2 class="text-5xl font-black font-mono tracking-[-0.05em] text-white flex items-center gap-4">
                    DATA_PACKETS
                    <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded border border-emerald-500/20 animate-pulse">LIVE</span>
                </h2>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_#3b82f6]"></span>
                        <span class="text-[10px] font-mono text-slate-400 uppercase tracking-widest">Global_Sync: 100%</span>
                    </div>
                    <div class="w-px h-3 bg-slate-800"></div>
                    <p class="text-slate-500 font-mono text-[10px] uppercase tracking-[0.2em] font-bold">Encrypted Intelligence Monitoring</p>
                </div>
            </div>
        </div>
        
        <!-- Categories Filter HUD -->
        <div class="flex flex-wrap gap-3 p-3 bg-slate-900/40 backdrop-blur-md border border-slate-800 rounded-3xl" id="category-filters">
            <button data-category="" class="category-filter-btn relative group px-6 py-3 rounded-xl font-mono text-[11px] font-black uppercase tracking-widest transition-all duration-300 text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 shadow-[0_0_20px_rgba(16,185,129,0.15)]">
                <span class="relative z-10 flex items-center gap-2">
                    <span class="status-active-dot w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    ALL_CLUSTERS
                </span>
            </button>
            @foreach($categories as $category)
                <button data-category="{{ $category->slug }}" class="category-filter-btn relative group px-6 py-3 rounded-xl font-mono text-[11px] font-black uppercase tracking-widest transition-all duration-300 text-slate-500 border border-slate-800 hover:border-emerald-500/50 hover:text-emerald-400 hover:bg-emerald-500/5">
                    <span class="relative z-10">{{ str_replace(' ', '_', $category->name) }}</span>
                    <!-- Corner Accents for Hover -->
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-emerald-500/0 group-hover:border-emerald-500/50 transition-all"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-emerald-500/0 group-hover:border-emerald-500/50 transition-all"></div>
                </button>
            @endforeach
        </div>
    </div>
    
    <!-- Visual Separator Line -->
    <div class="mt-12 h-px w-full bg-gradient-to-r from-transparent via-slate-800 to-transparent"></div>
</div>

<div id="feed-content" class="relative">
    <!-- Loading overlay for AJAX -->
    <div id="feed-loader" class="absolute inset-0 bg-slate-950/60 backdrop-blur-md z-50 flex flex-col items-center justify-center opacity-0 pointer-events-none transition-all duration-500 rounded-[2rem]">
        <div class="relative w-20 h-20 mb-6">
            <div class="absolute inset-0 border-4 border-emerald-500/20 rounded-full"></div>
            <div class="absolute inset-0 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
        </div>
        <span class="text-xs font-mono text-emerald-400 font-black uppercase tracking-[0.4em] animate-pulse">Syncing_Data_Stream...</span>
    </div>

    <div id="grid-container">
        @include('user.news.partials.grid')
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mouse Glow Tracking
        const mouseGlow = document.getElementById('mouse-glow');
        document.addEventListener('mousemove', (e) => {
            mouseGlow.style.left = e.clientX + 'px';
            mouseGlow.style.top = e.clientY + 'px';
        });

        // Intersection Observer for Reveal
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('reveal'), index * 80);
                }
            });
        }, observerOptions);

        function observeCards() {
            document.querySelectorAll('.stagger-card').forEach(card => revealObserver.observe(card));
        }

        observeCards();

        const filterBtns = document.querySelectorAll('.category-filter-btn');
        const feedContent = document.getElementById('grid-container');
        const loader = document.getElementById('feed-loader');

        function updateActiveButton(clickedBtn) {
            filterBtns.forEach(btn => {
                btn.classList.remove('text-emerald-400', 'bg-emerald-500/10', 'border-emerald-500/30', 'shadow-[0_0_20px_rgba(16,185,129,0.15)]');
                btn.classList.add('text-slate-500', 'border-slate-800');
                const dot = btn.querySelector('.status-active-dot');
                if(dot) dot.remove();
            });
            clickedBtn.classList.add('text-emerald-400', 'bg-emerald-500/10', 'border-emerald-500/30', 'shadow-[0_0_20px_rgba(16,185,129,0.15)]');
            clickedBtn.classList.remove('text-slate-500', 'border-slate-800');
            
            const dot = document.createElement('span');
            dot.className = 'status-active-dot w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse mr-2';
            clickedBtn.querySelector('.relative.z-10').prepend(dot);
        }

        function fetchPosts(url) {
            loader.classList.remove('opacity-0', 'pointer-events-none');
            
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                feedContent.innerHTML = html;
                loader.classList.add('opacity-0', 'pointer-events-none');
                observeCards();
                bindPaginationLinks();
            })
            .catch(() => loader.classList.add('opacity-0', 'pointer-events-none'));
        }

        function bindPaginationLinks() {
            document.querySelectorAll('.ajax-pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetchPosts(this.href);
                    document.getElementById('feed').scrollIntoView({ behavior: 'smooth' });
                });
            });
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                updateActiveButton(this);
                const category = this.dataset.category;
                const url = new URL(window.location.href);
                if (category) url.searchParams.set('category', category);
                else url.searchParams.delete('category');
                
                window.history.pushState({}, '', url);
                fetchPosts(url);
            });
        });

        bindPaginationLinks();
    });
</script>
@endpush
