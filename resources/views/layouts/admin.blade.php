<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CyberNews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-emerald: #10b981;
        }
        body { font-family: 'Inter', sans-serif; }
        .outfit-font { font-family: 'Outfit', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(16, 185, 129, 0.2);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.8);
            box-shadow: none;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-200 min-h-screen flex transition-colors duration-300">
    <!-- Matrix Background System -->
    <canvas id="matrix-canvas" class="fixed inset-0 z-[-1] opacity-20"></canvas>
    <div class="fixed inset-0 z-[-2] bg-slate-950"></div>
    
    <script>
        const canvas = document.getElementById('matrix-canvas');
        const ctx = canvas.getContext('2d');
        let width, height, columns;
        const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*()_+=-{}[]|;:,.<>?/πΩΣΔ";
        const fontSize = 14;
        let drops = [];

        function initMatrix() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
            columns = Math.floor(width / fontSize);
            drops = new Array(columns).fill(1);
        }

        function drawMatrix() {
            ctx.fillStyle = 'rgba(2, 6, 23, 0.05)';
            ctx.fillRect(0, 0, width, height);
            ctx.fillStyle = '#10b981';
            ctx.font = fontSize + 'px monospace';
            for (let i = 0; i < drops.length; i++) {
                const text = characters.charAt(Math.floor(Math.random() * characters.length));
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                if (drops[i] * fontSize > height && Math.random() > 0.975) drops[i] = 0;
                drops[i]++;
            }
        }
        initMatrix();
        window.addEventListener('resize', initMatrix);
        setInterval(drawMatrix, 50);
    </script>

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-slate-950/80 backdrop-blur-2xl border-r border-emerald-500/20 flex flex-col sticky top-0 z-50 flex-shrink-0">
        <!-- Logo / Brand -->
        <div class="p-6 border-b border-emerald-500/10 flex-shrink-0">
            <a href="/" class="flex items-center gap-3 group">
                <div class="relative w-10 h-10 flex-shrink-0">
                    <div class="absolute inset-0 bg-emerald-500/20 rounded-xl border border-emerald-500/40 shadow-[0_0_20px_rgba(16,185,129,0.2)]"></div>
                    <svg class="relative w-10 h-10 text-emerald-500 p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-black font-mono text-white leading-none tracking-tighter"><span class="text-emerald-500">CYBER</span>_COMMAND</p>
                    <p class="text-[8px] font-mono text-emerald-500/60 uppercase tracking-[0.3em] mt-1.5">SOC_CORE_V1</p>
                </div>
            </a>
        </div>

        <!-- System Status Bar -->
        <div class="mx-4 mt-4 mb-2 px-3 py-2 rounded-xl bg-emerald-500/5 border border-emerald-500/20 flex items-center gap-2 flex-shrink-0">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_#10b981]"></span>
            <span class="text-[9px] font-mono font-black text-emerald-400 uppercase tracking-widest">ACTIVE_MONITORING</span>
        </div>

        <!-- Navigation -->
        <div class="flex-grow overflow-y-auto custom-scrollbar">
            <nav class="p-4 space-y-2">
                <p class="text-[9px] font-mono text-slate-600 uppercase tracking-[0.3em] px-3 mb-3 font-black">CORE_MODULES</p>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-emerald-500/10 text-sm font-mono transition-all group {{ Request::is('admin/dashboard') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-black shadow-[0_0_15px_rgba(16,185,129,0.1)]' : 'text-slate-400' }}">
                    <svg class="w-5 h-5 {{ Request::is('admin/dashboard') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <p class="text-[9px] font-mono text-slate-600 uppercase tracking-[0.3em] px-3 mt-6 mb-3 font-black">DATA_STREAMS</p>
                <a href="{{ route('posts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-emerald-500/10 text-sm font-mono transition-all group {{ Request::is('admin/posts*') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-black shadow-[0_0_15px_rgba(16,185,129,0.1)]' : 'text-slate-400' }}">
                    <svg class="w-5 h-5 {{ Request::is('admin/posts*') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Intelligence
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-emerald-500/10 text-sm font-mono transition-all group {{ Request::is('admin/categories*') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-black shadow-[0_0_15px_rgba(16,185,129,0.1)]' : 'text-slate-400' }}">
                    <svg class="w-5 h-5 {{ Request::is('admin/categories*') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M11 7h.01M11 11h.01M11 15h.01M15 7h.01M15 11h.01M15 15h.01"></path></svg>
                    Clusters
                </a>

                <p class="text-[9px] font-mono text-slate-600 uppercase tracking-[0.3em] px-3 mt-6 mb-3 font-black">INTERFACE</p>
                <a href="{{ route('news.index') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-emerald-500/10 text-sm font-mono transition-all group text-slate-400">
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Live Portal
                </a>
            </nav>
        </div>

        <!-- User Profile & Logout -->
        <div class="p-6 border-t border-emerald-500/10 bg-slate-900/50 backdrop-blur-md flex-shrink-0">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 font-black text-xs shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-black text-white truncate font-mono uppercase tracking-tighter">{{ Auth::user()->name }}</p>
                    <p class="text-[8px] text-emerald-500 font-mono uppercase font-black tracking-widest">LEVEL_01_ADMIN</p>
                </div>
            </div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-rose-500/5 hover:bg-rose-500/20 border border-rose-500/10 text-rose-500 transition-all font-mono text-[10px] font-black uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    EXIT_COMMAND
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow min-w-0">
        <header class="bg-slate-950/60 backdrop-blur-xl border-b border-emerald-500/20 px-10 py-5 flex justify-between items-center sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <h2 class="font-mono text-white font-black uppercase tracking-[0.2em] text-sm">@yield('header', 'SYSTEM_CORE')</h2>
                <div class="h-4 w-px bg-slate-800"></div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-mono text-emerald-500/80 font-black">SYNC_ON</span>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-[10px] font-mono text-slate-500 flex items-center gap-2 bg-slate-900/50 px-3 py-1.5 rounded-lg border border-slate-800">
                    <span class="text-emerald-500">IP:</span> 192.168.1.104
                </div>
                <div class="h-8 w-px bg-slate-800"></div>
                <span class="text-[11px] font-mono text-slate-400 font-bold uppercase tracking-widest">AUTH: {{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="p-10">
            @if(session('success'))
                <div class="mb-8 p-5 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-2xl flex items-center gap-4 font-mono text-xs font-black tracking-widest shadow-[0_0_20px_rgba(16,185,129,0.1)]">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-slate-950">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path></svg>
                    </div>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <style>
        /* Modern scrollbar for navigation only */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(16, 185, 129, 0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(16, 185, 129, 0.3); }
        
        /* Ensure the whole page scrolls smoothly */
        html { scroll-behavior: smooth; }
    </style>

    <script>
        // Matrix simplified logic already handled at top
    </script>
    @stack('scripts')
</body>
</html>
