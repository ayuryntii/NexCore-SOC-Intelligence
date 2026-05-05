@extends('layouts.admin')

@section('header', 'Modify_Intel_Entry')

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card rounded-2xl p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-mono text-emerald-500 uppercase tracking-widest mb-2">Intel_Subject (Title)</label>
                        <input type="text" name="title" value="{{ $post->title }}" required class="w-full bg-slate-950 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-100 focus:outline-none focus:border-emerald-500/50 font-mono text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-mono text-emerald-500 uppercase tracking-widest mb-2">Intel_Content (Body)</label>
                        <textarea name="content" rows="12" required class="w-full bg-slate-950 border border-emerald-500/20 rounded-lg px-4 py-3 text-slate-100 focus:outline-none focus:border-emerald-500/50 font-mono text-sm resize-none">{{ $post->content }}</textarea>
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
                    <div id="image-preview-container" class="{{ $post->image ? '' : 'hidden' }}">
                        <img id="image-preview" src="{{ $post->image ? asset('storage/' . $post->image) : '#' }}" class="w-full aspect-video object-cover rounded border border-emerald-500/30 mb-3 grayscale group-hover:grayscale-0 transition-all">
                    </div>
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-emerald-500/20 rounded-xl p-6 text-center hover:bg-emerald-500/5 hover:border-emerald-500/50 transition-all">
                            <svg class="w-8 h-8 text-emerald-500/30 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-mono text-slate-500 uppercase">Update_Visual_Data</span>
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
                                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-mono text-slate-500 mb-1 uppercase">Transmission_Mode</label>
                        <select name="status" required class="w-full bg-slate-950 border border-emerald-500/20 rounded-lg px-4 py-2 text-slate-300 font-mono text-xs focus:outline-none">
                            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>STAGING_DRAFT</option>
                            <option value="publish" {{ $post->status == 'publish' ? 'selected' : '' }}>BROADCAST_LIVE</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-slate-950 font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                <span class="font-mono uppercase">Update_Intel</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
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
