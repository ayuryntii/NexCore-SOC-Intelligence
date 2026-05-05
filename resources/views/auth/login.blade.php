@extends('layouts.app')

@section('title', 'Secure Authentication')

@push('styles')
<style>
    /* Full Screen Matrix Background */
    #matrix-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 0;
        opacity: 0.25;
        pointer-events: none;
    }

    .login-wrapper {
        position: relative;
        z-index: 10;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        perspective: 1000px;
    }

    .premium-auth-card {
        background: rgba(10, 15, 30, 0.85);
        backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 2.5rem;
        padding: 3.5rem;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.8), 
                    inset 0 0 20px rgba(16, 185, 129, 0.05);
        transform-style: preserve-3d;
        animation: card-entry 1.2s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    @keyframes card-entry {
        from { opacity: 0; transform: rotateX(-10deg) translateY(30px); }
        to { opacity: 1; transform: rotateX(0) translateY(0); }
    }

    /* Dramatic Input Animations */
    .cyber-field {
        position: relative;
        transition: transform 0.3s ease;
    }

    .cyber-field:focus-within {
        transform: scale(1.02);
    }

    .premium-input {
        background: rgba(2, 6, 23, 0.8) !important;
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #fff;
        padding: 1.25rem 1rem 1.25rem 3.5rem;
        border-radius: 1.25rem;
        width: 100%;
        font-family: 'JetBrains Mono', monospace;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .premium-input:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.4),
                    inset 0 0 15px rgba(16, 185, 129, 0.2);
        padding-left: 4.5rem;
        transform: translateX(12px) scale(1.01);
        background: rgba(16, 185, 129, 0.05) !important;
    }

    .cyber-field::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; width: 0; height: 1px;
        background: #10b981;
        transition: width 0.4s ease;
        box-shadow: 0 0 10px #10b981;
    }

    .cyber-field:focus-within::after {
        width: 100%;
    }

    .input-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(16, 185, 129, 0.4);
        transition: all 0.3s ease;
    }

    .premium-input:focus + .input-icon,
    .premium-input:not(:placeholder-shown) + .input-icon {
        color: #10b981;
        transform: translateY(-50%) scale(1.2);
        filter: drop-shadow(0 0 5px #10b981);
    }

    /* Typing Cursor Animation */
    .typing-cursor::after {
        content: '_';
        animation: blink 1s step-end infinite;
    }

    @keyframes blink { 50% { opacity: 0; } }

    .glow-btn {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #020617;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        padding: 1.25rem;
        border-radius: 1.25rem;
        width: 100%;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .glow-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
        letter-spacing: 0.3em;
    }

    .glow-btn::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%; width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .glow-btn:hover::before { opacity: 1; }
</style>
@endpush

@section('content')
<canvas id="matrix-bg"></canvas>

<div class="login-wrapper">
    <div class="premium-auth-card">
        <div class="text-center mb-12">
            <div class="inline-block px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-[10px] font-mono font-bold text-emerald-500 uppercase tracking-widest mb-6">
                Terminal_Handshake_v4.2
            </div>
            <h1 class="text-4xl font-black text-white mb-3 tracking-tighter outfit-font">
                AUTHORIZE_USER<span class="text-emerald-500 typing-cursor"></span>
            </h1>
            <p class="text-slate-500 font-mono text-[11px] uppercase tracking-[0.3em]">Credentials required for system access</p>
        </div>

        <form action="/login" method="POST" class="space-y-8">
            @csrf
            
            <div class="space-y-3">
                <label class="block text-[10px] font-mono text-emerald-500/70 uppercase tracking-[0.2em] font-black ml-2">Identify_Packet (Email)</label>
                <div class="cyber-field">
                    <input type="email" name="email" required placeholder=" " class="premium-input" value="{{ old('email') }}">
                    <div class="input-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                </div>
                @error('email')
                    <p class="text-[9px] font-mono text-rose-500 font-bold uppercase mt-2 px-2 animate-bounce">Verification_Error: {{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3">
                <label class="block text-[10px] font-mono text-emerald-500/70 uppercase tracking-[0.2em] font-black ml-2">Access_Key (Password)</label>
                <div class="cyber-field">
                    <input type="password" name="password" required placeholder=" " class="premium-input">
                    <div class="input-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="glow-btn">
                    <span class="relative z-10 flex items-center justify-center gap-3">
                        EXECUTE_LOGIN
                        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </span>
                </button>
            </div>
        </form>

        <div class="mt-12 pt-8 border-t border-slate-800 text-center">
            <a href="/register" class="text-[10px] font-mono text-slate-500 hover:text-emerald-500 uppercase tracking-widest transition-all">
                New_Entity? <span class="text-emerald-500 font-bold underline underline-offset-8 decoration-emerald-500/30">Initialize_Account_Protocol</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const canvas = document.getElementById('matrix-bg');
    const ctx = canvas.getContext('2d');

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resize);
    resize();

    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$#@%&*^!(){}[]<>?/\\|";
    const fontSize = 16;
    const columns = canvas.width / fontSize;
    const drops = Array(Math.floor(columns)).fill(1);

    function draw() {
        ctx.fillStyle = 'rgba(2, 6, 23, 0.08)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = '#10b981';
        ctx.font = fontSize + 'px "JetBrains Mono"';

        for (let i = 0; i < drops.length; i++) {
            const text = letters[Math.floor(Math.random() * letters.length)];
            
            // Randomly make some characters brighter
            if (Math.random() > 0.95) {
                ctx.fillStyle = '#6ee7b7';
                ctx.shadowBlur = 10;
                ctx.shadowColor = '#10b981';
            } else {
                ctx.fillStyle = '#10b981';
                ctx.shadowBlur = 0;
            }

            ctx.fillText(text, i * fontSize, drops[i] * fontSize);

            if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                drops[i] = 0;
            }
            drops[i]++;
        }
    }

    setInterval(draw, 40);
</script>
@endpush
@endsection
