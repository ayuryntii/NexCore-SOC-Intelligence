@extends('layouts.admin')

@section('header', 'Initialize_Intel')

@section('content')
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card rounded-2xl p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-mono text-emerald-500 uppercase tracking-widest mb-2">Intel_Subject (Title)</label>
                        <input type="text" name="title" required class="w-full bg-slate-950 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-100 focus:outline-none focus:border-emerald-500/50 font-mono text-sm" placeholder="REPORT_TITLE_HERE">
                    </div>
                    <div>
                        <label class="block text-[10px] font-mono text-emerald-500 uppercase tracking-widest mb-2">Intel_Content (Body)</label>
                        <textarea name="content" rows="12" required class="w-full bg-slate-950 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-100 focus:outline-none focus:border-emerald-500/50 font-mono text-sm resize-none" placeholder="SECURE_DATA_INPUT..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Image Upload -->
            <div class="glass-card rounded-2xl p-6">
                <h3 class="text-[10px] font-mono text-emerald-500 uppercase tracking-widest mb-4">Visual_Attachment</h3>
                <div class="space-y-4">
                    <div id="image-preview-container" class="hidden">
                        <img id="image-preview" src="#" class="w-full aspect-video object-cover rounded border border-emerald-500/30 mb-3 grayscale group-hover:grayscale-0 transition-all">
                    </div>
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-emerald-500/20 rounded-xl p-6 text-center hover:bg-emerald-500/5 hover:border-emerald-500/50 transition-all">
                            <svg class="w-8 h-8 text-emerald-500/30 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-mono text-slate-500 uppercase">Load_Visual_Data</span>
                            <input type="file" name="image" id="image-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                        </div>
                    </label>
                </div>
            </div>

            <!-- Settings -->
            <div class="glass-card rounded-2xl p-6">
                <h3 class="text-[10px] font-mono text-emerald-500 uppercase tracking-widest mb-4">System_Flags</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-mono text-slate-500 mb-1 uppercase">Target_Cluster</label>
                        <select name="category_id" required class="w-full bg-slate-950 border border-emerald-500/20 rounded-lg px-4 py-2 text-slate-300 font-mono text-xs focus:outline-none">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-mono text-slate-500 mb-1 uppercase">Transmission_Mode</label>
                        <select name="status" required class="w-full bg-slate-950 border border-emerald-500/20 rounded-lg px-4 py-2 text-slate-300 font-mono text-xs focus:outline-none">
                            <option value="draft">STAGING_DRAFT</option>
                            <option value="publish">BROADCAST_LIVE</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-bold py-4 rounded-xl transition-all cyber-btn flex items-center justify-center gap-2">
                <span class="font-mono uppercase">Deploy_Intel</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
    function previewImage(input) {
        const container = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
