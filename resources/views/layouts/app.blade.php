<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - CyberNews</title>
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
                    },
                    animation: {
                        'kenburns': 'kenburns 30s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        kenburns: {
                            '0%': { transform: 'scale(1) translate(0, 0)' },
                            '100%': { transform: 'scale(1.15) translate(-2%, -2%)' },
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
            --neon-glow: rgba(16, 185, 129, 0.4);
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #020617;
            overflow-x: hidden;
        }
        
        /* Global Cyber Background */
        .cyber-bg-system {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.05) 0%, transparent 80%),
                linear-gradient(rgba(15, 23, 42, 1) 0%, rgba(2, 6, 23, 1) 100%);
        }

        .cyber-grid-overlay {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(16, 185, 129, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(ellipse at center, black, transparent 90%);
        }

        .floating-data {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .data-stream {
            position: absolute;
            background: linear-gradient(to bottom, transparent, var(--neon-emerald), transparent);
            width: 1px;
            height: 100px;
            opacity: 0.1;
            animation: data-fall linear infinite;
        }

        @keyframes data-fall {
            from { transform: translateY(-100vh); }
            to { transform: translateY(100vh); }
        }

        h1, h2, h3, h4, h5, h6, .outfit-font {
            font-family: 'Outfit', sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(16, 185, 129, 0.2);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }
        .neon-border:hover {
            box-shadow: 0 0 20px var(--neon-glow);
            border-color: var(--neon-emerald);
        }
        .cyber-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-950 text-slate-200 transition-colors duration-300 min-h-screen flex flex-col overflow-x-hidden">
    <!-- Matrix Background System -->
    <canvas id="matrix-canvas" class="fixed inset-0 z-[-1] opacity-20"></canvas>
    <div class="fixed inset-0 z-[-2] bg-slate-950"></div>
    <div class="fixed inset-0 z-[-1] bg-gradient-to-b from-transparent via-slate-950/50 to-slate-950"></div>
    
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

                if (drops[i] * fontSize > height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
                drops[i]++;
            }
        }

        initMatrix();
        window.addEventListener('resize', initMatrix);
        setInterval(drawMatrix, 50);
    </script>
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 glass-card border-b border-emerald-500/20 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold tracking-tighter flex items-center gap-2 group outfit-font">
                <span class="w-8 h-8 bg-emerald-500 rounded flex items-center justify-center group-hover:rotate-12 transition-transform shadow-lg shadow-emerald-500/30">
                    <svg class="w-5 h-5 text-white dark:text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </span>
                <span class="text-emerald-600 dark:text-emerald-500 font-mono">CYBER</span><span class="text-slate-900 dark:text-slate-100 font-mono">PORTAL</span>
            </a>

            <div class="hidden md:flex items-center gap-8 font-medium">
                <a href="{{ route('news.index') }}" class="text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors {{ request()->routeIs('news.index') ? 'text-emerald-600 dark:text-emerald-500 font-semibold' : '' }}">Home</a>
                
                <!-- Category Dropdown -->
                <div class="relative group">
                    <button class="text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors flex items-center gap-1">
                        Clusters
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-48 glass-card rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[100] p-2 border-emerald-500/30 shadow-xl">
                        @php $cats = \App\Models\Category::all(); @endphp
                        @foreach($cats as $cat)
                            <a href="/?category={{ $cat->slug }}" class="block px-4 py-2 text-xs font-mono text-slate-700 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 rounded-lg uppercase transition-all">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <form action="{{ route('news.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Intel..." class="bg-white dark:bg-slate-900 border border-emerald-500/30 rounded-full px-4 py-1.5 text-sm focus:outline-none focus:border-emerald-500 transition-all w-48 focus:w-64 font-mono text-slate-800 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-emerald-500/10 text-emerald-600 dark:text-emerald-500 transition-colors shadow-sm dark:shadow-none border border-transparent hover:border-emerald-500/20">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="/admin/dashboard" class="text-sm font-mono border border-emerald-500 px-3 py-1.5 rounded text-emerald-600 dark:text-emerald-500 hover:bg-emerald-500 hover:text-white dark:hover:text-slate-950 transition-all font-semibold">TERMINAL</a>
                    @endif
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-500 font-mono font-medium">SIGNOUT_</button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-mono text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium">LOGIN_</a>
                    <a href="/register" class="bg-emerald-500 hover:bg-emerald-600 text-white dark:text-slate-950 px-4 py-2 rounded font-bold text-sm transition-all cyber-btn shadow-md shadow-emerald-500/20">REGISTER</a>
                @endauth
                
                <!-- GitHub Integration -->
                <a href="https://github.com/ayuryntii" target="_blank" class="ml-2 text-slate-600 hover:text-emerald-600 dark:text-slate-400 dark:hover:text-emerald-500 transition-colors" title="GitHub Profile">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-6 py-12">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="glass-card border-t border-emerald-500/20 py-12 px-6 mt-auto">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-2">
                <div class="flex items-center gap-2 mb-4 outfit-font">
                    <span class="text-emerald-600 dark:text-emerald-500 font-mono text-xl font-bold">CYBER</span><span class="text-slate-900 dark:text-slate-100 font-mono text-xl">PORTAL</span>
                </div>
                <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 max-w-sm">Secure Intelligence & Tech Intel. Updated hourly. All data encrypted and verified for accuracy.</p>
                
                <a href="https://github.com/ayuryntii" target="_blank" class="inline-flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors cyber-btn px-4 py-2 rounded-lg border border-emerald-500/30 bg-white/50 dark:bg-slate-900/50 shadow-sm font-medium">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                    Developer: @ayuryntii
                </a>
            </div>
            <div>
                <h4 class="font-bold text-emerald-600 dark:text-emerald-500 mb-4 font-mono">QUICK_LINKS</h4>
                <ul class="text-slate-600 dark:text-slate-400 text-sm space-y-3 font-medium">
                    <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Latest Intel</a></li>
                    <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Breach Alerts</a></li>
                    <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Security Tools</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-emerald-600 dark:text-emerald-500 mb-4 font-mono">SYSTEM_STATUS</h4>
                <div class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300 font-medium bg-slate-100 dark:bg-slate-900/50 p-3 rounded-lg border border-slate-200 dark:border-emerald-500/10">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                    ALL SYSTEMS OPERATIONAL
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 text-center text-slate-500 dark:text-slate-500 text-xs font-mono">
            &copy; {{ date('Y') }} CYBERPORTAL V1.0.5. EXECUTED IN {{ round(microtime(true) - LARAVEL_START, 4) }}S
        </div>
    </footer>

    <!-- Loading Overlay -->
    <div id="loader" class="fixed inset-0 z-[100] bg-white dark:bg-slate-950 flex flex-col items-center justify-center transition-opacity duration-700">
        <div class="relative w-24 h-24 mb-6">
            <div class="absolute inset-0 border-4 border-slate-200 dark:border-emerald-500/20 rounded-full"></div>
            <div class="absolute inset-0 border-4 border-emerald-500 rounded-full border-t-transparent animate-spin shadow-lg shadow-emerald-500/20"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
        </div>
        <div class="text-emerald-600 dark:text-emerald-500 font-mono text-xs tracking-[0.3em] uppercase animate-pulse font-bold">Initializing_Session...</div>
    </div>

    <script>
        // Loader handling
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            loader.style.opacity = '0';
            setTimeout(() => loader.style.display = 'none', 700);
        });

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
            document.documentElement.classList.add('dark');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
            document.documentElement.classList.remove('dark');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
