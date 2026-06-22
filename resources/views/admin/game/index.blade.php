@extends('layouts.admin')

@section('title', 'Manajemen Game — BoxPlay.id')
@section('page_title', 'Manajemen Game')
@section('page_description', 'Kelola katalog game yang tersedia')
@section('breadcrumb', 'Data Master / Manajemen Game')

@section('content')
    {{-- Search & Filter --}}
    <div class="game-toolbar">
        <form method="GET" action="{{ route('admin.game.index') }}" class="filter-form">
            <div class="filter-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" name="search" class="form-input" placeholder="Cari judul game..." value="{{ request('search') }}">
            </div>
            <select name="kategori" class="form-select" style="max-width:200px" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>

                @foreach ($kategoriList as $kat)
                    <option value="{{ $kat }}"
                        {{ request('kategori') == $kat ? 'selected' : '' }}>
                        {{ $kat }}
                    </option>
                @endforeach
            </select>
        </form>

        <a href="{{ route('admin.game.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Game
        </a>
    </div>

    @if ($gameList->count() > 0)
        <div class="data-grid game-grid">
            @foreach ($gameList as $game)
                <div class="data-card">
                    <div class="data-card-image game-cover">
                        @if ($game->cover_image)
                            <img src="{{ asset($game->cover_image) }}" alt="{{ $game->judul_game }}">
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                        @endif
                        @if ($game->kategori)
                            <div class="game-badge-kategori">{{ $game->kategori }}</div>
                        @endif
                    </div>

                    <div class="data-card-body">
                        <h3 class="data-card-title">{{ $game->judul_game }}</h3>

                        <div class="data-card-footer">
                            <div class="data-card-actions">
                                <a href="{{ route('admin.game.edit', $game->id_game) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteGame({{ $game->id_game }}, '{{ addslashes($game->judul_game) }}')">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
            <h3>Belum Ada Game</h3>
            <p>Tambahkan game pertama ke katalog.</p>
        </div>
    @endif

    {{-- Delete Modal --}}
    <div class="modal-backdrop" id="deleteGameModal">
        <div class="modal-box">
            <h3>Hapus Game?</h3>
            <p>Apakah Anda yakin ingin menghapus <strong id="deleteGameName"></strong>?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="document.getElementById('deleteGameModal').classList.remove('show')">Batal</button>
                <form id="deleteGameForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteGame(id, name) {
            document.getElementById('deleteGameName').textContent = name;
            document.getElementById('deleteGameForm').action = '{{ route("admin.game.index") }}/' + id;
            document.getElementById('deleteGameModal').classList.add('show');
        }
        document.getElementById('deleteGameModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });
    </script>
@endsection
