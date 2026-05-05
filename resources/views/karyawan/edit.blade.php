@extends('layouts.master')

@section('title', 'EDIT_RECORD')

@push('styles')
<style>
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }
    .form-label {
        display: block;
        font-family: var(--font-mono);
        color: var(--sys-primary);
        font-size: 0.7rem;
        margin-bottom: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .form-label::before {
        content: '>';
        font-weight: bold;
    }
    .form-control {
        width: 100%;
        background: rgba(0, 243, 255, 0.02);
        border: 1px solid var(--sys-border);
        color: #fff;
        padding: 1rem;
        font-family: var(--font-mono);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border-radius: 0;
    }
    .form-control:focus {
        outline: none;
        background: rgba(0, 243, 255, 0.05);
        border-color: var(--sys-primary);
        box-shadow: 0 0 20px rgba(0, 243, 255, 0.2), inset 0 0 10px rgba(0, 243, 255, 0.1);
        transform: translateX(5px);
    }
    .text-danger {
        color: var(--sys-secondary);
        font-family: var(--font-mono);
        font-size: 0.7rem;
        margin-top: 0.5rem;
        background: rgba(255, 0, 255, 0.1);
        padding: 0.3rem 0.6rem;
        border-left: 2px solid var(--sys-secondary);
    }

    /* Corner Brackets for Card */
    .card-corners::before, .card-corners::after {
        content: '';
        position: absolute;
        width: 30px;
        height: 30px;
        border: 2px solid var(--sys-primary);
        pointer-events: none;
    }
    .card-corners::before { top: -2px; left: -2px; border-right: 0; border-bottom: 0; }
    .card-corners::after { bottom: -2px; right: -2px; border-left: 0; border-top: 0; }

    .btn-primary {
        position: relative;
        overflow: hidden;
    }
    .btn-primary::after {
        content: '';
        position: absolute;
        top: -50%; left: -60%; width: 20%; height: 200%;
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(30deg);
        transition: all 0.5s;
    }
    .btn-primary:hover::after {
        left: 150%;
    }
</style>
@endpush

@section('content')
<div class="card card-corners" style="max-width: 800px; margin: 0 auto;" data-aos="fade-up">
    <div style="border-bottom: 1px solid var(--sys-border); padding-bottom: 1rem; margin-bottom: 2rem;">
        <h2 style="margin-bottom: 0;"><i class="fas fa-user-edit"></i> UPDATE_KARYAWAN_DATA</h2>
        <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--sys-text-muted); margin-top: 5px;">
            REFERENCE_ID: {{ $karyawan->id_karyawan }} // TIMESTAMP: {{ now()->format('Y.m.d.H:i:s') }}
        </div>
    </div>

    <form action="{{ route('karyawan.update', $karyawan->id_karyawan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label"><i class="fas fa-id-card"></i> FULL_NAME</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $karyawan->nama) }}" required>
            @error('nama') <div class="text-danger">!! ERROR: {{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-briefcase"></i> POSITION/JABATAN</label>
            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $karyawan->jabatan) }}" required>
            @error('jabatan') <div class="text-danger">!! ERROR: {{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-hourglass-half"></i> AGE/USIA</label>
            <input type="number" name="usia" class="form-control" value="{{ old('usia', $karyawan->usia) }}" required>
            @error('usia') <div class="text-danger">!! ERROR: {{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-map-marker-alt"></i> ALAMAT_DOMISILI</label>
            <textarea name="alamat" class="form-control" rows="4" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
            @error('alamat') <div class="text-danger">!! ERROR: {{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-camera"></i> UPDATE_PROFILE_PHOTO</label>
            <div style="display: flex; gap: 1.5rem; align-items: center;">
                <div id="photo-preview-container" style="width: 100px; height: 100px; border: 1px solid var(--sys-border); background: rgba(0, 243, 255, 0.05); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img id="photo-preview" src="{{ $karyawan->foto_url }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="flex: 1;">
                    <input type="file" name="foto" id="foto-input" class="form-control" accept="image/*" onchange="previewImage(this)">
                    <div style="font-size: 0.6rem; color: var(--sys-text-muted); margin-top: 0.5rem;">ALLOWED: JPG, PNG, JPEG (MAX 2MB) // LEAVE EMPTY TO KEEP CURRENT</div>
                </div>
            </div>
            @error('foto') <div class="text-danger">!! ERROR: {{ $message }}</div> @enderror
        </div>

        <script>
            function previewImage(input) {
                const preview = document.getElementById('photo-preview');
                
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-primary">
                <i class="fas fa-sync-alt"></i> OVERWRITE_DATA
            </button>
            <a href="{{ route('karyawan.index') }}" class="btn-outline">
                <i class="fas fa-undo"></i> CANCEL_OPERATION
            </a>
        </div>
    </form>
</div>
@endsection
