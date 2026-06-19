@extends('layouts.admin')

@section('title', 'Tambah Playbox — BoxPlay.id')
@section('page_title', 'Tambah Playbox')
@section('page_description', 'Tambah unit Playbox baru')
@section('breadcrumb', 'Data Master / Playbox / Tambah')

@section('content')
    <div class="page-header">
        <div>
            <h1>Tambah Playbox Baru</h1>
            <p>Isi data untuk menambah unit Playbox baru</p>
        </div>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.playbox.store') }}">
            @csrf

            <div class="form-group">
                <label for="nama_playbox" class="form-label">Nama Playbox <span style="color:var(--error)">*</span></label>
                <input type="text" name="nama_playbox" id="nama_playbox" class="form-input"
                       value="{{ old('nama_playbox') }}" placeholder="Contoh: PB-001" required>
                @error('nama_playbox')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_cabang" class="form-label">Cabang <span style="color:var(--error)">*</span></label>
                <select name="id_cabang" id="id_cabang" class="form-select" required>
                    <option value="">— Pilih Cabang —</option>
                    @foreach ($cabangList as $cabang)
                        <option value="{{ $cabang->id_cabang }}" {{ old('id_cabang') == $cabang->id_cabang ? 'selected' : '' }}>
                            {{ $cabang->nama_cabang }}
                        </option>
                    @endforeach
                </select>
                @error('id_cabang')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status_unit" class="form-label">Status Unit <span style="color:var(--error)">*</span></label>
                <select name="status_unit" id="status_unit" class="form-select" required>
                    @foreach (['Tersedia', 'Maintenance', 'Rusak'] as $status)
                        <option value="{{ $status }}" {{ old('status_unit', 'Tersedia') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('status_unit')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan
                </button>
                <a href="{{ route('admin.playbox.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
