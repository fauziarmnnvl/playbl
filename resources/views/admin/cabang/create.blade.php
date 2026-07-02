@extends('layouts.admin')

@section('title', 'Tambah Cabang — BoxPlay.id')
@section('breadcrumb', 'Data Master / Manajemen Cabang / Tambah')

@section('content')
    <div class="page-header">
        <div>
            <h1>Tambah Cabang Baru</h1>
            <p>Isi data cabang untuk menambah lokasi operasional baru</p>
        </div>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.cabang.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama_cabang" class="form-label">Nama Cabang <span style="color:var(--error)">*</span></label>
                <input type="text" name="nama_cabang" id="nama_cabang" class="form-input" value="{{ old('nama_cabang') }}"
                    placeholder="Contoh: BoxPlay Padang" required>
                @error('nama_cabang')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat_cabang" class="form-label">Alamat</label>
                <textarea name="alamat_cabang" id="alamat_cabang" class="form-textarea"
                    placeholder="Alamat lengkap cabang">{{ old('alamat_cabang') }}</textarea>
                @error('alamat_cabang')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kontak_cabang" class="form-label">Kontak</label>
                <input type="text" name="kontak_cabang" id="kontak_cabang" class="form-input"
                    value="{{ old('kontak_cabang') }}" placeholder="Contoh: 081234567890">
                @error('kontak_cabang')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jam_operasional" class="form-label">Jam Operasional</label>
                <input type="text" name="jam_operasional" id="jam_operasional" class="form-input"
                    value="{{ old('jam_operasional') }}" placeholder="Contoh: 10:00 - 22:00">
                @error('jam_operasional')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Link Google Maps</label>
                <input type="url" name="link_maps" class="form-input" value="{{ old('link_maps') }}"
                    placeholder="https://maps.google.com/...">
                @error('link_maps')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status Cabang</label>
                <select name="status_buka" class="form-select">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Cabang</label>
                <input type="file" name="foto_cabang" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                <small style="color:#64748b">JPG, PNG, WEBP maksimal 2 MB</small>
                @error('foto_cabang')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    Simpan
                </button>
                <a href="{{ route('admin.cabang.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection