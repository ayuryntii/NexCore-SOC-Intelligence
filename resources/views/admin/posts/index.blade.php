@extends('layouts.admin')

@section('header', 'Intelligence_Base')

@section('content')
<div class="mb-8 flex justify-between items-end">
    <div>
        <h3 class="text-2xl font-bold font-mono text-slate-100 tracking-tighter">ALL_INTEL_REPORTS</h3>
        <p class="text-xs font-mono text-slate-500 uppercase">Managing {{ $posts->total() }} recorded data packets</p>
    </div>
    <a href="{{ route('posts.create') }}" class="bg-emerald-600 hover:bg-emerald-500 text-slate-950 px-6 py-3 rounded-xl font-bold text-sm transition-all cyber-btn flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        <span class="font-mono uppercase">New_Intel_Entry</span>
    </a>
</div>

<div class="glass-card rounded-2xl overflow-hidden shadow-2xl">
    <table class="w-full text-left font-mono text-xs">
        <thead class="bg-emerald-500/5 border-b border-emerald-500/10">
            <tr>
                <th class="px-6 py-5 text-emerald-500 uppercase tracking-widest font-bold">Preview</th>
                <th class="px-6 py-5 text-emerald-500 uppercase tracking-widest font-bold">Intel_Title</th>
                <th class="px-6 py-5 text-emerald-500 uppercase tracking-widest font-bold">Cluster</th>
                <th class="px-6 py-5 text-emerald-500 uppercase tracking-widest font-bold">Status</th>
                <th class="px-6 py-5 text-emerald-500 uppercase tracking-widest font-bold">Timestamp</th>
                <th class="px-6 py-5 text-emerald-500 uppercase tracking-widest font-bold text-right">Protocol</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-emerald-500/10">
            @forelse($posts as $post)
            <tr class="hover:bg-emerald-500/5 transition-all group">
                <td class="px-6 py-4">
                    <div class="w-16 h-10 rounded border border-emerald-500/20 overflow-hidden bg-slate-900 flex items-center justify-center">
                        <img src="{{ $post->image_url }}" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 transition-opacity">
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-slate-200 font-bold text-sm tracking-tight group-hover:text-emerald-400 transition-colors">{{ $post->title }}</div>
                    <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ Str::limit($post->slug, 30) }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 bg-blue-500/10 text-blue-400 rounded text-[10px] border border-blue-500/20 uppercase">
                        {{ $post->category->name }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($post->status === 'publish')
                        <span class="flex items-center gap-1.5 text-emerald-500">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            PUBLISHED
                        </span>
                    @else
                        <span class="flex items-center gap-1.5 text-amber-500/70">
                            <span class="w-1.5 h-1.5 bg-amber-500/50 rounded-full"></span>
                            DRAFT
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-slate-500 text-[10px]">
                    {{ $post->created_at->format('Y-m-d H:i:s') }}
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2 opacity-30 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('posts.edit', $post->id) }}" class="p-2 bg-blue-500/10 text-blue-400 rounded border border-blue-500/20 hover:bg-blue-500 hover:text-slate-950 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Initiate permanent data purge?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-rose-500/10 text-rose-500 rounded border border-rose-500/20 hover:bg-rose-500 hover:text-slate-950 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-20 text-center text-slate-500 uppercase tracking-tighter">Database empty. No intelligence recorded.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 bg-slate-900/50 border-t border-emerald-500/10">
        {{ $posts->links() }}
    </div>
</div>
@endsection
