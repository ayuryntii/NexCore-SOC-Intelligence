<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CORE_SYS') | Ayu Rianti [OPERATOR_037]</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            /* System Core Palette - High Contrast Dark */
            --sys-bg: #050505;
            --sys-surface: rgba(15, 15, 15, 0.85);
            --sys-border: rgba(0, 243, 255, 0.2);
            --sys-border-active: rgba(0, 243, 255, 0.8);
            --sys-primary: #00f3ff; /* Cyber Cyan */
            --sys-secondary: #ff00ff; /* Cyber Magenta (for alerts/accents) */
            --sys-success: #00ff41; /* Terminal Green */
            --sys-text: #e0e0e0;
            --sys-text-muted: #666;
            --font-mono: 'Fira Code', monospace;
            --font-sans: 'Inter', sans-serif;
            --sys-glow: 0 0 10px rgba(0, 243, 255, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--sys-bg);
            color: var(--sys-text);
            line-height: 1.6;
            overflow-x: hidden;
            background-image:
                radial-gradient(circle at 50% 50%, rgba(0, 243, 255, 0.03) 0%, transparent 60%),
                linear-gradient(rgba(0, 243, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 243, 255, 0.02) 1px, transparent 1px);
            background-size: 100% 100%, 40px 40px, 40px 40px;
        }

        /* Scanning Line Effect */
        .scanline {
            width: 100%;
            height: 100px;
            z-index: 9999;
            background: linear-gradient(0deg, rgba(0, 243, 255, 0) 0%, rgba(0, 243, 255, 0.1) 50%, rgba(0, 243, 255, 0) 100%);
            opacity: 0.1;
            position: fixed;
            bottom: 100%;
            left: 0;
            pointer-events: none;
            animation: scan 6s linear infinite;
        }

        @keyframes scan {
            0% { bottom: 100%; }
            100% { bottom: -100px; }
        }

        /* Static Noise Overlay */
        .noise {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            opacity: 0.02;
            pointer-events: none;
        }

        /* Navbar - HUD Style */
        .navbar {
            background: rgba(5, 5, 5, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--sys-border);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0.75rem 2rem;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            font-family: var(--font-mono);
        }

        .logo-icon {
            color: var(--sys-primary);
            font-size: 1.8rem;
            filter: drop-shadow(0 0 5px var(--sys-primary));
        }

        .logo-text {
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }

        .logo-text span {
            display: block;
            font-size: 0.7rem;
            color: var(--sys-success);
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--sys-text-muted);
            font-family: var(--font-mono);
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            padding-bottom: 0.2rem;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--sys-primary);
            text-shadow: 0 0 8px var(--sys-primary);
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; width: 100%; height: 2px;
            background: var(--sys-primary);
            box-shadow: 0 0 10px var(--sys-primary);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 2rem;
            min-height: calc(100vh - 160px);
        }

        /* System Module (Card) */
        .card {
            background: var(--sys-surface);
            border: 1px solid var(--sys-border);
            border-left: 4px solid var(--sys-primary);
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            position: relative;
            box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        .card::before {
            content: 'SYS_MODULE';
            position: absolute;
            top: -10px; right: 20px;
            background: var(--sys-bg);
            padding: 2px 10px;
            font-family: var(--font-mono);
            font-size: 0.7rem;
            color: var(--sys-primary);
            border: 1px solid var(--sys-border);
        }

        .card:hover {
            border-color: var(--sys-primary);
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.1);
            transform: translate(-2px, -2px);
        }

        h1, h2, h3 {
            font-family: var(--font-mono);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        h1 {
            color: #fff;
            font-size: 3rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        h1 span {
            color: var(--sys-primary);
            text-shadow: 0 0 10px var(--sys-primary);
        }

        h2 {
            font-size: 1.5rem;
            color: var(--sys-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            border-bottom: 1px solid var(--sys-border);
            padding-bottom: 0.5rem;
        }

        /* Buttons - High Tech Style */
        .btn-primary, .btn-outline {
            font-family: var(--font-mono);
            font-weight: 600;
            padding: 0.8rem 1.8rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .btn-primary {
            background: var(--sys-primary);
            color: #000;
            border: 1px solid var(--sys-primary);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.4);
        }

        .btn-primary:hover {
            background: transparent;
            color: var(--sys-primary);
            box-shadow: 0 0 25px rgba(0, 243, 255, 0.6);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--sys-primary);
            color: var(--sys-primary);
        }

        .btn-outline:hover {
            background: rgba(0, 243, 255, 0.1);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.2);
        }

        /* Tech Tags */
        .skill-tag {
            background: rgba(0, 243, 255, 0.05);
            border: 1px solid var(--sys-border);
            color: var(--sys-primary);
            padding: 0.4rem 0.8rem;
            font-family: var(--font-mono);
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .skill-tag:hover {
            border-color: var(--sys-primary);
            background: rgba(0, 243, 255, 0.1);
        }

        /* Footer */
        footer {
            border-top: 1px solid var(--sys-border);
            padding: 3rem 2rem;
            text-align: center;
            background: var(--sys-bg);
            font-family: var(--font-mono);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .social-links a {
            color: var(--sys-text-muted);
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: var(--sys-primary);
            filter: drop-shadow(0 0 5px var(--sys-primary));
        }

        @media (max-width: 900px) {
            h1 { font-size: 2rem; }
            .card { padding: 1.5rem; }
            .nav-links { display: none; } /* Could add mobile menu later */
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-950 text-slate-200 min-h-screen flex flex-col transition-colors duration-300 overflow-x-hidden">
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
                if (drops[i] * fontSize > height && Math.random() > 0.975) drops[i] = 0;
                drops[i]++;
            }
        }
        initMatrix();
        window.addEventListener('resize', initMatrix);
        setInterval(drawMatrix, 50);
    </script>

    <!-- Navbar - HUD Style -->
    <nav class="sticky top-0 z-50 bg-slate-950/80 backdrop-blur-2xl border-b border-emerald-500/20 px-8 py-5">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                <div class="relative w-12 h-12 flex-shrink-0">
                    <div class="absolute inset-0 bg-emerald-500/10 rounded-2xl border border-emerald-500/30 group-hover:border-emerald-500 transition-colors shadow-[0_0_20px_rgba(16,185,129,0.1)]"></div>
                    <i class="fab fa-connectdevelop absolute inset-0 flex items-center justify-center text-emerald-500 text-2xl animate-pulse"></i>
                </div>
                <div>
                    <p class="text-lg font-black font-mono text-white leading-none tracking-tighter uppercase">AYU_RIANTI</p>
                    <p class="text-[9px] font-mono text-emerald-500/60 uppercase tracking-[0.4em] mt-1 font-black">SEC_SYSTEMS_ENG</p>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-2 bg-slate-900/50 p-1.5 rounded-2xl border border-slate-800">
                @foreach([
                    ['route' => 'home', 'label' => 'DASHBOARD'],
                    ['route' => 'about', 'label' => 'IDENTITY'],
                    ['route' => 'education', 'label' => 'KNOWLEDGE'],
                    ['route' => 'project', 'label' => 'PROTOCOLS'],
                    ['route' => 'karyawan.index', 'label' => 'PERSONNEL']
                ] as $link)
                    <a href="{{ route($link['route']) }}" class="px-5 py-2.5 rounded-xl font-mono text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs($link['route'].'*') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.1)]' : 'text-slate-500 hover:text-emerald-400 hover:bg-emerald-500/5' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden xl:flex flex-col items-end">
                    <span class="text-[9px] font-mono text-emerald-500 font-black tracking-widest">ENCRYPTED_LINK_ACTIVE</span>
                    <span class="text-[9px] font-mono text-slate-500">NODE_ID: {{ strtoupper(substr(md5(request()->ip()), 0, 8)) }}</span>
                </div>
                <div class="h-8 w-px bg-slate-800"></div>
                <a href="{{ route('login') }}" class="p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/30 transition-all">
                    <i class="fas fa-lock"></i>
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-grow container max-w-7xl mx-auto py-12 px-6 relative z-10">
        @yield('content')
    </main>

    <footer class="bg-slate-950/90 backdrop-blur-xl border-t border-emerald-500/10 py-12 px-8 relative z-10">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex flex-col items-center md:items-start">
                <div class="flex gap-4 mb-4">
                    <a href="https://github.com/ayuryntii" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 hover:text-emerald-400 hover:border-emerald-500 transition-all"><i class="fab fa-github"></i></a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 hover:text-emerald-400 hover:border-emerald-500 transition-all"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 hover:text-emerald-400 hover:border-emerald-500 transition-all"><i class="fas fa-terminal"></i></a>
                </div>
                <p class="text-[9px] font-mono text-slate-600 uppercase tracking-[0.2em] font-black">Core_Software_Infrastructure // v2.0.4_BETA</p>
            </div>

            <div class="text-center md:text-right">
                <p class="text-[10px] font-mono text-slate-500 uppercase tracking-[0.2em] mb-1">Authenticated: <span class="text-emerald-500">{{ strtoupper($name ?? 'Ayu Rianti') }}</span></p>
                <p class="text-[9px] font-mono text-emerald-500/40 uppercase tracking-widest font-black">PROCESS_NOMINAL // &copy; {{ date('Y') }} // SYNCED_WITH_LARAVEL_CORE</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
    @stack('scripts')
</body>
</html>
