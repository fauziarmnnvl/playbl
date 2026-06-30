@extends('layouts.admin')

@section('title', 'Edit Operator — BoxPlay.id')
@section('page_title', 'Edit Operator')
@section('page_description', 'Perbarui data operator')
@section('breadcrumb', 'Data Master / Operator / Edit')

@section('content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.operator.update', $operator->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama" class="form-label">Nama Lengkap <span style="color:var(--error)">*</span></label>
                <input type="text" name="nama" id="nama" class="form-input"
                       value="{{ old('nama', $operator->nama) }}" required>
                @error('nama')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group form-half">
                    <label for="username" class="form-label">Username <span style="color:var(--error)">*</span></label>
                    <input type="text" name="username" id="username" class="form-input"
                           value="{{ old('username', $operator->username) }}" required>
                    @error('username')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-half">
                    <label for="email" class="form-label">Email <span style="color:var(--error)">*</span></label>
                    <input type="email" name="email" id="email" class="form-input"
                           value="{{ old('email', $operator->email) }}" required>
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-input"
                       placeholder="Kosongkan jika tidak ingin mengubah password">
                <small style="color:#64748b">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah.</small>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_cabang" class="form-label">Penempatan Cabang <span style="color:var(--error)">*</span></label>
                <select name="id_cabang" id="id_cabang" class="form-select" required>
                    <option value="">— Pilih Cabang —</option>
                    @foreach ($cabangs as $cabang)
                        <option value="{{ $cabang->id_cabang }}" {{ old('id_cabang', $operator->id_cabang) == $cabang->id_cabang ? 'selected' : '' }}>
                            {{ $cabang->nama_cabang }}
                        </option>
                    @endforeach
                </select>
                @error('id_cabang')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="telegram_id" class="form-label">Telegram ID</label>
                <input type="text" name="telegram_id" id="telegram_id" class="form-input" value="{{ old('telegram_id', $operator->telegram_id) }}" placeholder="Contoh: 123456789">
                <small style="color:#64748b">Chat ID Telegram operator untuk menerima notifikasi.</small>
                @error('telegram_id')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.operator.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
