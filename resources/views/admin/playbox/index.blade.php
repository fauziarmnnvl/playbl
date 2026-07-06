@extends('layouts.admin')

@section('title', 'Manajemen Playbox — BoxPlay.id')
@section('page_title', 'Manajemen Playbox')
@section('page_description', 'Kelola inventaris unit mesin Playbox')
@section('breadcrumb', 'Data Master / Manajemen Playbox')

@section('content')
    <div class="playbox-toolbar">
        <button type="button" class="btn btn-primary" onclick="openCreatePlayboxModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Playbox
        </button>
    </div>

    @if ($playboxList->count() > 0)
        <div class="table-card">
            <div class="table-responsive">
                <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Playbox</th>
                        <th>Cabang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($playboxList as $i => $playbox)
                        <tr>
                            <td>{{ $playboxList->firstItem() + $i }}</td>
                            <td class="td-bold">{{ $playbox->nama_playbox }}</td>
                            <td>{{ $playbox->cabang->nama_cabang ?? '—' }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'Tersedia'    => 'badge-green',
                                        'Maintenance' => 'badge-amber',
                                        'Rusak'       => 'badge-red',
                                    ];
                                    $badgeClass = $statusMap[$playbox->status_unit] ?? 'badge-default';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $playbox->status_unit }}</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    @php
                                        $playboxData = [
                                            'id' => $playbox->id_playbox,
                                            'nama' => $playbox->nama_playbox,
                                            'id_cabang' => $playbox->id_cabang,
                                            'status' => $playbox->status_unit,
                                        ];
                                    @endphp

                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-playbox-id="{{ $playbox->id_playbox }}"
                                        data-playbox="{{ json_encode($playboxData) }}"
                                        onclick="openEditPlayboxModal(JSON.parse(this.dataset.playbox))">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDeletePlaybox({{ $playbox->id_playbox }}, '{{ $playbox->nama_playbox }}')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        @if ($playboxList->hasPages())
            <div class="table-pagination">

                @if ($playboxList->onFirstPage())
                    <span class="page-btn disabled">&laquo;</span>
                @else
                    <a class="page-btn" href="{{ $playboxList->previousPageUrl() }}">&laquo;</a>
                @endif

                @for ($i = 1; $i <= $playboxList->lastPage(); $i++)
                    <a href="{{ $playboxList->url($i) }}"
                    class="page-btn {{ $playboxList->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor

                @if ($playboxList->hasMorePages())
                    <a class="page-btn" href="{{ $playboxList->nextPageUrl() }}">&raquo;</a>
                @else
                    <span class="page-btn disabled">&raquo;</span>
                @endif

            </div>
        @endif
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="8" cy="12" r="1.5"/><circle cx="16" cy="12" r="1.5"/></svg>
            <h3>Belum Ada Playbox</h3>
            <p>Tambahkan unit Playbox pertama untuk memulai.</p>
        </div>
    @endif

    {{-- Create Playbox Modal --}}
    <div class="modal-backdrop" id="createPlayboxModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Tambah Playbox</h3>
                    <p>Tambahkan unit Playbox baru ke sistem</p>
                </div>
                <button type="button" class="modal-close" onclick="closeCreatePlayboxModal()">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.playbox.store') }}">
                @csrf

                <div class="form-group">
                    <label for="create_nama_playbox" class="form-label">Nama Playbox <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama_playbox" id="create_nama_playbox" class="form-input"
                        value="{{ old('nama_playbox') }}" placeholder="Contoh: PB-001" required>
                    @error('nama_playbox', 'createPlaybox')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_id_cabang" class="form-label">Cabang <span style="color:var(--error)">*</span></label>
                    <select name="id_cabang" id="create_id_cabang" class="form-select" required>
                        <option value="">— Pilih Cabang —</option>
                        @foreach ($cabangList as $cabang)
                            <option value="{{ $cabang->id_cabang }}"
                                {{ old('id_cabang') == $cabang->id_cabang ? 'selected' : '' }}
                                {{ !$cabang->status_buka ? 'disabled' : '' }}>
                                {{ $cabang->nama_cabang }}{{ !$cabang->status_buka ? ' (Nonaktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_cabang', 'createPlaybox')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_status_unit" class="form-label">Status Unit <span style="color:var(--error)">*</span></label>
                    <select name="status_unit" id="create_status_unit" class="form-select" required>
                        <option value="Tersedia" {{ old('status_unit', 'Tersedia') === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Maintenance" {{ old('status_unit') === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="Rusak" {{ old('status_unit') === 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                    @error('status_unit', 'createPlaybox')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCreatePlayboxModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Playbox</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Playbox Modal --}}
    <div class="modal-backdrop" id="editPlayboxModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Edit Playbox</h3>
                    <p>Perbarui data unit Playbox</p>
                </div>
                <button type="button" class="modal-close" onclick="closeEditPlayboxModal()">&times;</button>
            </div>

            <form id="editPlayboxForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="edit_nama_playbox" class="form-label">Nama Playbox <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama_playbox" id="edit_nama_playbox" class="form-input" required>
                    @error('nama_playbox', 'editPlaybox')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_id_cabang" class="form-label">Cabang <span style="color:var(--error)">*</span></label>
                    <select name="id_cabang" id="edit_id_cabang" class="form-select" required>
                        <option value="">— Pilih Cabang —</option>
                        @foreach ($cabangList as $cabang)
                            <option value="{{ $cabang->id_cabang }}"
                                {{ !$cabang->status_buka ? 'disabled' : '' }}>
                                {{ $cabang->nama_cabang }}{{ !$cabang->status_buka ? ' (Nonaktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_cabang', 'editPlaybox')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_status_unit" class="form-label">Status Unit <span style="color:var(--error)">*</span></label>
                    <select name="status_unit" id="edit_status_unit" class="form-select" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                    @error('status_unit', 'editPlaybox')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditPlayboxModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal-backdrop" id="deletePlayboxModal">
        <div class="modal-box">
            <h3>Hapus Playbox?</h3>
            <p>Apakah Anda yakin ingin menghapus <strong id="deletePlayboxName"></strong>?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="document.getElementById('deletePlayboxModal').classList.remove('show')">Batal</button>
                <form id="deletePlayboxForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create Playbox Modal
        function openCreatePlayboxModal() {
            document.getElementById('createPlayboxModal').classList.add('show');
        }
        function closeCreatePlayboxModal() {
            document.getElementById('createPlayboxModal').classList.remove('show');
        }

        document.getElementById('createPlayboxModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreatePlayboxModal();
            }
        });

        // Edit Playbox Modal
        function openEditPlayboxModal(playbox) {
            const modal = document.getElementById('editPlayboxModal');

            document.getElementById('editPlayboxForm').action =
                '{{ route("admin.playbox.index") }}/' + playbox.id;

            document.getElementById('edit_nama_playbox').value = playbox.nama;
            document.getElementById('edit_id_cabang').value = playbox.id_cabang;
            document.getElementById('edit_status_unit').value = playbox.status;

            modal.classList.add('show');
        }
        function closeEditPlayboxModal() {
            document.getElementById('editPlayboxModal').classList.remove('show');
        }

        document.getElementById('editPlayboxModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditPlayboxModal();
            }
        });

        // Delete Playbox Modal
        function confirmDeletePlaybox(id, name) {
            document.getElementById('deletePlayboxName').textContent = name;
            document.getElementById('deletePlayboxForm').action = '{{ route("admin.playbox.index") }}/' + id;
            document.getElementById('deletePlayboxModal').classList.add('show');
        }
        document.getElementById('deletePlayboxModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });

        // Auto-open Create Modal jika validasi gagal atau cabang nonaktif
        @if ($errors->createPlaybox->any() || session('create_playbox_error'))
            openCreatePlayboxModal();
        @endif

        // Auto-open Edit Modal jika validasi gagal atau cabang nonaktif
        @if (($errors->editPlaybox->any() || session('edit_playbox_error')) && session('edit_playbox_id'))
            const editPlayboxId = {{ session('edit_playbox_id') }};
            const editButton = document.querySelector(`[data-playbox-id="${editPlayboxId}"]`);

            if (editButton) {
                const playbox = JSON.parse(editButton.dataset.playbox);

                playbox.nama = @json(old('nama_playbox'));
                playbox.id_cabang = @json(old('id_cabang'));
                playbox.status = @json(old('status_unit'));

                openEditPlayboxModal(playbox);
            }
        @endif
    </script>
@endsection
