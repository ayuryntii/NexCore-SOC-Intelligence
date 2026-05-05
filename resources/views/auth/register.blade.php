@extends('layouts.app')

@section('title', 'System Initialization')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="glass-card rounded-2xl overflow-hidden relative group">
        <div class="p-8 relative z-10">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-500/10 rounded-2xl border border-emerald-500/30 mb-4 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold font-mono tracking-wider text-emerald-500">INITIALIZE_ENTITY</h2>
                <p class="text-slate-500 text-sm font-mono mt-1">CREATE NEW BIOMETRIC PROFILE</p>
            </div>

            <form action="/register" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-mono text-emerald-500/70 mb-2 uppercase tracking-widest">Entity_Name</label>
                    <input type="text" name="name" required class="w-full bg-slate-900/50 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 transition-all font-mono text-sm" placeholder="Subject Name">
                </div>

                <div>
                    <label class="block text-xs font-mono text-emerald-500/70 mb-2 uppercase tracking-widest">Comm_Link (Email)</label>
                    <input type="email" name="email" required class="w-full bg-slate-900/50 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 transition-all font-mono text-sm" placeholder="email@nexus.com">
                    @error('email')
                        <p class="text-rose-500 text-[10px] mt-1 font-mono uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-emerald-500/70 mb-2 uppercase tracking-widest">Access_Key</label>
                    <input type="password" name="password" required class="w-full bg-slate-900/50 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 transition-all font-mono text-sm" placeholder="Minimum 8 Chars">
                </div>

                <div>
                    <label class="block text-xs font-mono text-emerald-500/70 mb-2 uppercase tracking-widest">Confirm_Key</label>
                    <input type="password" name="password_confirmation" required class="w-full bg-slate-900/50 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 transition-all font-mono text-sm" placeholder="Re-enter Key">
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-bold py-4 rounded-xl transition-all cyber-btn flex items-center justify-center gap-2 mt-6">
                    <span class="font-mono tracking-widest uppercase">Register_User</span>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-emerald-500/10 pt-6">
                <p class="text-slate-500 text-xs font-mono">
                    ALREADY_REGISTERED? <a href="/login" class="text-emerald-500 hover:text-emerald-400 underline underline-offset-4 decoration-emerald-500/30 font-bold uppercase">SIGNIN_</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
