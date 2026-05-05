<!-- News Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($posts as $post)
    <article class="stagger-card group relative bg-slate-900/40 backdrop-blur-xl border border-slate-800 rounded-[2rem] overflow-hidden hover:border-emerald-500/50 transition-all duration-700 hover:-translate-y-2 shadow-2xl">
        <!-- Scanning Line HUD -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden z-20">
            <div class="w-full h-px bg-emerald-500/30 shadow-[0_0_15px_#10b981] absolute top-0 left-0 opacity-0 group-hover:opacity-100 animate-[scan-v_3s_linear_infinite]"></div>
        </div>

        <!-- Image Header -->
        <div class="relative aspect-video overflow-hidden">
            <div class="absolute inset-0 bg-emerald-500/10 z-10 mix-blend-color opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <img src="{{ $post->image_url }}" 
                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000"
                 onerror="this.src='https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80'">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            
            <div class="absolute top-4 left-4 z-20">
                <span class="px-3 py-1 bg-emerald-500/20 backdrop-blur-md border border-emerald-500/30 rounded-lg text-[9px] font-mono text-emerald-400 font-black uppercase tracking-widest">
                    {{ $post->category->name }}
                </span>
            </div>
        </div>

        <!-- Content Payload -->
        <div class="p-8 relative">
            <div class="flex items-center gap-3 text-[9px] font-mono text-slate-500 mb-4 uppercase tracking-[0.2em]">
                <span class="text-emerald-500">INIT_PKT</span>
                <span>•</span>
                <span>{{ $post->created_at->format('Y.m.d') }}</span>
            </div>
            
            <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-emerald-400 transition-colors outfit-font leading-tight uppercase">
                {{ $post->title }}
            </h3>
            
            <p class="text-slate-400 text-sm line-clamp-3 mb-8 leading-relaxed font-medium">
                {{ Str::limit(strip_tags($post->content), 120) }}
            </p>
            
            <a href="/news/{{ $post->slug }}" class="flex items-center justify-between group/link pt-6 border-t border-slate-800">
                <span class="text-[10px] font-mono text-slate-500 group-hover/link:text-emerald-400 uppercase tracking-[0.3em] font-black transition-colors">ACCESS_DATA_STREAM</span>
                <svg class="w-5 h-5 text-emerald-500 group-hover/link:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </article>
    @empty
    <div class="col-span-full relative overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/40 backdrop-blur-md min-h-[400px] flex flex-col items-center justify-center p-8 group transition-all hover:border-emerald-500/30">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-px h-full bg-gradient-to-b from-transparent via-emerald-500 to-transparent transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-1000 animate-[cyber-move-v_3s_linear_infinite]"></div>
            <div class="absolute top-0 right-1/4 w-px h-full bg-gradient-to-b from-transparent via-emerald-500 to-transparent transform translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-1000 animate-[cyber-move-v_4s_linear_infinite_reverse]"></div>
        </div>

        <!-- Icon Container with Glow -->
        <div class="relative w-24 h-24 mb-8 flex items-center justify-center">
            <div class="absolute inset-0 bg-emerald-500/10 rounded-full blur-xl group-hover:blur-2xl transition-all duration-500 animate-pulse"></div>
            <div class="relative z-10 w-20 h-20 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-xl flex items-center justify-center transform group-hover:-translate-y-2 transition-all duration-500">
                <svg class="w-10 h-10 text-emerald-500 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke-dasharray="2 4" d="M12 15v3"></path>
                </svg>
            </div>
            <!-- Scanning Line -->
            <div class="absolute inset-0 rounded-2xl border border-emerald-500/0 group-hover:border-emerald-500/50 transition-colors overflow-hidden">
                <div class="w-full h-0.5 bg-emerald-500/50 shadow-[0_0_8px_#10b981] absolute top-0 left-0 animate-[cyber-move-v_2s_linear_infinite] opacity-0 group-hover:opacity-100"></div>
            </div>
        </div>

        <!-- Text Content -->
        <div class="text-center z-10 space-y-3 max-w-md">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 text-[10px] font-mono text-slate-600 dark:text-slate-400 uppercase tracking-widest font-bold mb-2 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse shadow-[0_0_5px_#f43f5e]"></span>
                Query_Result: Null
            </div>
            <h3 class="text-xl md:text-2xl font-bold font-mono text-slate-800 dark:text-slate-200 tracking-tight uppercase">
                No_Intelligence_Packets<span class="text-emerald-500 animate-pulse">_</span>
            </h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-relaxed">
                Our global scanners could not detect any data packets matching your current parameters. The requested sector might be classified or currently empty.
            </p>
        </div>

        <!-- Action Button -->
        <div class="mt-10 z-10">
            <button onclick="document.querySelector('.category-filter-btn[data-category=\'\']').click()" class="group/btn relative px-6 py-3 rounded-xl bg-slate-900 dark:bg-slate-100 text-white dark:text-slate-900 font-mono text-xs font-bold uppercase tracking-widest overflow-hidden transition-all hover:scale-105 shadow-lg">
                <span class="relative z-10 flex items-center gap-2 group-hover/btn:text-white transition-colors">
                    <svg class="w-4 h-4 group-hover/btn:-rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET_PARAMETERS
                </span>
                <div class="absolute inset-0 bg-emerald-500 translate-y-[101%] group-hover/btn:translate-y-0 transition-transform duration-300 ease-in-out"></div>
            </button>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-12 ajax-pagination">
    {{ $posts->appends(request()->query())->links() }}
</div>
