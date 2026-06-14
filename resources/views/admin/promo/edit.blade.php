@extends('layouts.admin')

@section('title', 'Edit Promo — BoxPlay.id')
@section('page_title', 'Edit Promo')
@section('page_description', 'Perbarui data promo')
@section('breadcrumb', 'Data Master / Promo / Edit')

@section('content')
    <div class="page-header">
        <div>
            <h1>Edit Promo</h1>
            <p>Perbarui data {{ $promo->nama_promo }}</p>
        </div>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.promo.update', $promo->id_promo) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_promo" class="form-label">Nama Promo <span style="color:var(--error)">*</span></label>
                <input type="text" name="nama_promo" id="nama_promo" class="form-input"
                       value="{{ old('nama_promo', $promo->nama_promo) }}" required>
                @error('nama_promo')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group form-half">
                    <label for="tipe_diskon" class="form-label">Tipe Diskon <span style="color:var(--error)">*</span></label>
                    <select name="tipe_diskon" id="tipe_diskon" class="form-select" required>
                        <option value="Persentase" {{ old('tipe_diskon', $promo->tipe_diskon) === 'Persentase' ? 'selected' : '' }}>Persentase (%)</option>
                        <option value="Nominal" {{ old('tipe_diskon', $promo->tipe_diskon) === 'Nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                    </select>
                </div>

                <div class="form-group form-half">
                    <label for="nilai_diskon" class="form-label">Nilai Diskon <span style="color:var(--error)">*</span></label>
                    <input type="number" name="nilai_diskon" id="nilai_diskon" class="form-input"
                           value="{{ old('nilai_diskon', $promo->nilai_diskon) }}" min="0" step="0.01" required>
                    @error('nilai_diskon')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group form-half">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span style="color:var(--error)">*</span></label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-input"
                           value="{{ old('tanggal_mulai', $promo->tanggal_mulai->format('Y-m-d')) }}" required>
                    @error('tanggal_mulai')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-half">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span style="color:var(--error)">*</span></label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-input"
                           value="{{ old('tanggal_selesai', $promo->tanggal_selesai->format('Y-m-d')) }}" required>
                    @error('tanggal_selesai')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @if ($promo->banner_promo)
                <div class="form-group">
                    <label class="form-label">Banner Saat Ini</label>
                    <img src="{{ Storage::url($promo->banner_promo) }}"
                         style="max-width:320px; height:160px; object-fit:cover; border-radius:12px; display:block;">
                </div>
            @endif

            <div class="form-group">
                <label class="form-label">{{ $promo->banner_promo ? 'Ganti Banner' : 'Banner Promo' }}</label>
                <input type="file" name="banner_promo" id="bannerInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                <small style="color:#64748b">Kosongkan jika tidak ingin mengganti</small>
                @error('banner_promo')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <div id="bannerPreview" style="display:none; margin-top:12px;">
                    <img id="bannerImg" style="max-width:320px; height:160px; object-fit:cover; border-radius:12px;">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('bannerInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('bannerImg').src = ev.target.result;
                    document.getElementById('bannerPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
