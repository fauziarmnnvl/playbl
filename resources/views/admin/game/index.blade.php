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

        <button type="button" class="btn btn-primary" onclick="openCreateGameModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Game
        </button>
    </div>

    @if ($gameList->count() > 0)
        <div class="data-grid game-grid">
            @foreach ($gameList as $game)
                <div class="data-card">
                    <div class="data-card-image game-cover">
                        @if ($game->cover_image)
                            <img src="{{ Storage::url($game->cover_image) }}" alt="{{ $game->judul_game }}">
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
                                @php
                                    $gameData = [
                                        'id' => $game->id_game,
                                        'judul' => $game->judul_game,
                                        'kategori' => $game->kategori,
                                        'cover' => $game->cover_image
                                            ? Storage::url($game->cover_image)
                                            : null,
                                    ];
                                @endphp

                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-game-id="{{ $game->id_game }}"
                                    data-game="{{ json_encode($gameData) }}"
                                    onclick="openEditGameModal(JSON.parse(this.dataset.game))">
                                    Edit
                                </button>
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

    {{-- Create Game Modal --}}
    <div class="modal-backdrop" id="createGameModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Tambah Game</h3>
                    <p>Tambahkan game baru ke katalog BoxPlay</p>
                </div>
                <button type="button" class="modal-close" onclick="closeCreateGameModal()">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.game.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="create_judul_game" class="form-label">Judul Game <span style="color:var(--error)">*</span></label>
                    <input type="text" name="judul_game" id="create_judul_game" class="form-input"
                        value="{{ old('judul_game') }}" placeholder="Contoh: FIFA 24" required>
                    @error('judul_game', 'createGame')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_kategori" class="form-label">Kategori / Mode</label>
                    <input type="text" name="kategori" id="create_kategori" class="form-input"
                        value="{{ old('kategori') }}" placeholder="Contoh: Multiplayer, Racing, RPG">
                    @error('kategori', 'createGame')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="createCoverInput" class="form-label">Cover Image</label>
                    <input type="file" name="cover_image" id="createCoverInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small style="color:#64748b">JPG, PNG, WEBP maksimal 2 MB</small>
                    @error('cover_image', 'createGame')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="createCoverPreview" style="display:none; margin-top:12px;">
                        <img id="createCoverImg" style="max-width:100%; height:160px; object-fit:cover; border-radius:12px;">
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCreateGameModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Game</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Game Modal --}}
    <div class="modal-backdrop" id="editGameModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Edit Game</h3>
                    <p>Perbarui data game pada katalog</p>
                </div>
                <button type="button" class="modal-close" onclick="closeEditGameModal()">&times;</button>
            </div>

            <form id="editGameForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="edit_judul_game" class="form-label">Judul Game <span style="color:var(--error)">*</span></label>
                    <input type="text" name="judul_game" id="edit_judul_game" class="form-input" required>
                    @error('judul_game', 'editGame')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_kategori" class="form-label">Kategori / Mode</label>
                    <input type="text" name="kategori" id="edit_kategori" class="form-input">
                    @error('kategori', 'editGame')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="editCoverInput" class="form-label">Cover Image</label>
                    <input type="file" name="cover_image" id="editCoverInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small class="form-hint">Kosongkan jika tidak ingin mengganti cover</small>
                    @error('cover_image', 'editGame')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="editCoverPreview" style="display:none; margin-top:12px;">
                        <img id="editCoverImg" alt="Preview cover" style="max-width:100%; height:160px; object-fit:cover; border-radius:12px;">
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditGameModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

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
        // Create Game Modal
        function openCreateGameModal() {
            document.getElementById('createGameModal').classList.add('show');
        }
        function closeCreateGameModal() {
            document.getElementById('createGameModal').classList.remove('show');
        }
        const createCoverInput = document.getElementById('createCoverInput');

        createCoverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(ev) {
                    document.getElementById('createCoverImg').src = ev.target.result;
                    document.getElementById('createCoverPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('createGameModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateGameModal();
            }
        });

        // Edit Game Modal
        function openEditGameModal(game) {
            const modal = document.getElementById('editGameModal');

            document.getElementById('editGameForm').action =
                '{{ route("admin.game.index") }}/' + game.id;

            document.getElementById('edit_judul_game').value = game.judul;
            document.getElementById('edit_kategori').value = game.kategori || '';

            const preview = document.getElementById('editCoverPreview');
            const image = document.getElementById('editCoverImg');
            const input = document.getElementById('editCoverInput');

            input.value = '';
            if (game.cover) {
                image.src = game.cover;
                preview.style.display = 'block';
            } else {
                image.src = '';
                preview.style.display = 'none';
            }
            modal.classList.add('show');
        }
        function closeEditGameModal() {
            document.getElementById('editGameModal').classList.remove('show');
        }
        const editCoverInput = document.getElementById('editCoverInput');
        editCoverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('editCoverImg').src = ev.target.result;
                document.getElementById('editCoverPreview').style.display = 'block';
            };

            reader.readAsDataURL(file);
        });

        // Delete Game Modal
        function confirmDeleteGame(id, name) {
            document.getElementById('deleteGameName').textContent = name;
            document.getElementById('deleteGameForm').action = '{{ route("admin.game.index") }}/' + id;
            document.getElementById('deleteGameModal').classList.add('show');
        }
        document.getElementById('deleteGameModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });

        // Auto-open Create Modal jika validasi gagal
        @if ($errors->createGame->any())
            openCreateGameModal();
        @endif

        // Auto-open Edit Modal jika validasi gagal
        @if ($errors->editGame->any() && session('edit_game_id'))
            const editGameId = {{ session('edit_game_id') }};
            const editButton = document.querySelector(`[data-game-id="${editGameId}"]`);

            if (editButton) {
                const game = JSON.parse(editButton.dataset.game);

                game.judul = @json(old('judul_game'));
                game.kategori = @json(old('kategori'));

                openEditGameModal(game);
            }
        @endif

        document.getElementById('editGameModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditGameModal();
            }
        });
    </script>
@endsection
