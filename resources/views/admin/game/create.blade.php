@extends('layouts.admin')

@section('title', 'Tambah Game — BoxPlay.id')
@section('page_title', 'Tambah Game')
@section('page_description', 'Tambah game baru ke katalog')
@section('breadcrumb', 'Data Master / Game / Tambah')

@section('content')
    <div class="page-header">
        <div>
            <h1>Tambah Game Baru</h1>
            <p>Isi data game untuk menambahkan ke katalog</p>
        </div>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.game.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="judul_game" class="form-label">Judul Game <span style="color:var(--error)">*</span></label>
                <input type="text" name="judul_game" id="judul_game" class="form-input"
                       value="{{ old('judul_game') }}" placeholder="Contoh: FIFA 24" required>
                @error('judul_game')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kategori" class="form-label">Kategori / Mode</label>
                <input type="text" name="kategori" id="kategori" class="form-input"
                       value="{{ old('kategori') }}" placeholder="Contoh: Multiplayer, Racing, RPG">
                @error('kategori')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Cover Image</label>
                <input type="file" name="cover_image" id="coverInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                <small style="color:#64748b">JPG, PNG, WEBP maksimal 2 MB</small>
                @error('cover_image')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <div id="coverPreview" class="image-preview" style="display:none; margin-top:12px;">
                    <img id="coverImg" style="max-width:220px; height:140px; object-fit:cover; border-radius:12px;">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan
                </button>
                <a href="{{ route('admin.game.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('coverInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('coverImg').src = ev.target.result;
                    document.getElementById('coverPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
