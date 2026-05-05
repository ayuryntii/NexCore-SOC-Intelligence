@extends('layouts.admin')

@section('header', 'Categories_Cluster')

@section('content')
<div class="mb-10">
    <h3 class="text-3xl font-bold font-mono text-slate-100 tracking-tighter outfit-font uppercase">Intel_Cluster_Control</h3>
    <p class="text-xs font-mono text-slate-500 mt-1 uppercase tracking-widest leading-relaxed">Defining logical boundaries for multi-vector intelligence streams.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Add Category Form -->
    <div class="lg:col-span-4">
        <div class="relative group">
            <div class="absolute -inset-1 bg-emerald-500/20 blur opacity-30 group-hover:opacity-50 transition duration-1000"></div>
            <div class="relative glass-card rounded-2xl p-8 border border-emerald-500/20 shadow-2xl">
                <h3 class="font-mono text-sm font-bold text-emerald-500 mb-8 uppercase tracking-widest flex items-center gap-3">
                    <div class="p-2 bg-emerald-500/10 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    INITIALIZE_NEW_CLUSTER
                </h3>
                <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-mono text-slate-500 mb-2 uppercase tracking-[0.2em]">Cluster_Designation</label>
                        <input type="text" name="name" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-5 py-3 text-slate-200 focus:outline-none focus:border-emerald-500/50 font-mono text-sm transition-all focus:ring-1 focus:ring-emerald-500/30" placeholder="e.g. Malware_Analysis">
                        @error('name')
                            <p class="mt-2 text-[10px] font-mono text-rose-500 uppercase">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-bold py-4 rounded-xl transition-all font-mono uppercase tracking-[0.3em] shadow-lg shadow-emerald-500/20 active:scale-95">
                        REGISTER_CLUSTER
                    </button>
                </form>
                
                <div class="mt-8 pt-8 border-t border-slate-800 space-y-4 font-mono text-[9px] text-slate-600 uppercase tracking-widest">
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-1 bg-emerald-500 rounded-full animate-pulse"></span>
                        Auto-Indexing Enabled
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-1 bg-blue-500 rounded-full"></span>
                        Metadata Validation Active
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category List -->
    <div class="lg:col-span-8">
        <div class="glass-card rounded-2xl overflow-hidden border border-slate-800 shadow-2xl">
            <div class="px-8 py-6 border-b border-slate-800 flex items-center justify-between bg-slate-900/50">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    <h4 class="text-xs font-mono font-bold text-slate-300 uppercase tracking-widest">ACTIVE_CLUSTERS_DATABASE</h4>
                </div>
                <div class="text-[10px] font-mono text-slate-500 uppercase">{{ $categories->total() }} Entities Detected</div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left font-mono text-xs">
                    <thead class="bg-slate-900/80 border-b border-slate-800">
                        <tr>
                            <th class="px-8 py-5 text-slate-500 uppercase tracking-widest font-bold">UID</th>
                            <th class="px-8 py-5 text-slate-500 uppercase tracking-widest font-bold">Designation</th>
                            <th class="px-8 py-5 text-slate-500 uppercase tracking-widest font-bold">Intensity</th>
                            <th class="px-8 py-5 text-slate-500 uppercase tracking-widest font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 bg-slate-950/20">
                        @forelse($categories as $category)
                        <tr class="hover:bg-emerald-500/[0.03] transition-colors group">
                            <td class="px-8 py-6 text-slate-600 font-mono">#{{ str_pad($category->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-8 py-6">
                                <div class="text-slate-200 font-bold tracking-tight text-sm uppercase group-hover:text-emerald-400 transition-colors">{{ $category->name }}</div>
                                <div class="text-[9px] text-slate-600 mt-0.5 tracking-tighter">SLUG: {{ $category->slug }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="flex-grow h-1 w-24 bg-slate-900 rounded-full overflow-hidden">
                                        @php $count = $category->posts_count ?? $category->posts()->count(); @endphp
                                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min(100, $count * 10) }}%"></div>
                                    </div>
                                    <span class="text-slate-400 min-w-[50px]">{{ $count }} Units</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <!-- Edit Button -->
                                    <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')" class="p-2.5 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/20 hover:bg-blue-500 hover:text-slate-950 transition-all shadow-lg hover:shadow-blue-500/20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
    
                                    <!-- Delete Form -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Confirm cluster deletion? All linked intel will be purged.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 bg-rose-500/10 text-rose-500 rounded-lg border border-rose-500/20 hover:bg-rose-500 hover:text-slate-950 transition-all shadow-lg hover:shadow-rose-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-24 text-center text-slate-600 uppercase tracking-[0.5em] font-mono">
                                <div class="mb-4 flex justify-center">
                                    <svg class="w-12 h-12 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                Database_Context_Empty
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-8 py-6 bg-slate-900/30 border-t border-slate-800">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/90 backdrop-blur-md p-4 transition-all duration-300">
    <div class="relative w-full max-w-md rounded-3xl overflow-hidden animate-modal-pop">
        <div class="absolute -inset-1 bg-blue-500/20 blur opacity-50"></div>
        <div class="relative glass-card border border-blue-500/20 bg-slate-900/90 shadow-2xl">
            <div class="p-8 border-b border-slate-800 flex justify-between items-center bg-slate-900/50">
                <div>
                    <h3 class="font-mono text-blue-400 font-bold uppercase tracking-widest text-sm">RECONFIGURE_CLUSTER</h3>
                    <p class="text-[9px] font-mono text-slate-500 uppercase mt-1">Modifying logical sector parameters</p>
                </div>
                <button onclick="closeEditModal()" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form id="editForm" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[10px] font-mono text-slate-500 mb-2 uppercase tracking-widest">New_Cluster_Designation</label>
                    <input type="text" name="name" id="editName" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-5 py-4 text-slate-200 focus:outline-none focus:border-blue-500/50 font-mono text-sm transition-all focus:ring-1 focus:ring-blue-500/30 shadow-inner">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl transition-all font-mono uppercase tracking-[0.3em] shadow-lg shadow-blue-500/20 active:scale-95">
                    EXECUTE_UPDATE
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openEditModal(id, name) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const input = document.getElementById('editName');
        
        form.action = `/admin/categories/${id}`;
        input.value = name;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close on escape
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeEditModal();
    });
</script>
<style>
    @keyframes modal-pop {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .animate-modal-pop { animation: modal-pop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
</style>
@endpush
@endsection
