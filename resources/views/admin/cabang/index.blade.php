@extends('layouts.admin')

@section('title', 'Manajemen Cabang — BoxPlay.id')
@section('page_title', 'Manajemen Cabang')
@section('page_description', 'Kelola data cabang dan lokasi cafe')
@section('breadcrumb', 'Data Master / Manajemen Cabang')

@section('content')

<div class="branch-toolbar">
    <div class="branch-search">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>     
        <input type="text" id="branchSearch" placeholder="Cari cabang..." >
    </div>
    <button type="button" class="btn btn-primary" onclick="openCreateCabangModal()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Cabang
    </button>
</div>

    @if ($cabangList->count() > 0)
        <div class="data-grid">
            @foreach ($cabangList as $cabang)
                <div class="data-card">
                    <div class="data-card-image">
                        @if($cabang->foto_cabang)
                            <img
                                src="{{ Storage::url($cabang->foto_cabang) }}"
                                alt="{{ $cabang->nama_cabang }}"
                            >
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M3 21h18"/>
                                <path d="M5 21V7l8-4v18"/>
                                <path d="M19 21V11l-6-4"/>
                            </svg>
                        @endif
                        <div class="data-card-status {{ $cabang->status_buka ? 'open' : 'closed' }}">
                            {{ $cabang->status_buka ? 'Aktif' : 'Nonaktif' }}
                        </div>
                    </div>
                    <div class="data-card-body">
                        <h3 class="data-card-title">
                            {{ $cabang->nama_cabang }}
                        </h3>
                        <div class="data-card-info">
                            @if($cabang->alamat_cabang)
                            <div class="data-card-info-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>

                                <span>{{ $cabang->alamat_cabang }}</span>
                            </div>
                            @endif
                            @if($cabang->jam_operasional)
                            <div class="data-card-info-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>

                                <span>{{ $cabang->jam_operasional }}</span>
                            </div>
                            @endif
                            @if($cabang->kontak_cabang)
                            <div class="data-card-info-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                                            19.79 19.79 0 0 1-8.63-3.07
                                            19.5 19.5 0 0 1-6-6
                                            19.79 19.79 0 0 1-3.07-8.67
                                            A2 2 0 0 1 4.11 2h3
                                            a2 2 0 0 1 2 1.72
                                            12.84 12.84 0 0 0 .7 2.81
                                            2 2 0 0 1-.45 2.11
                                            L8.09 9.91a16 16 0 0 0 6 6
                                            l1.27-1.27a2 2 0 0 1 2.11-.45
                                            12.84 12.84 0 0 0 2.81.7
                                            A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <span>{{ $cabang->kontak_cabang }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="data-card-footer">
                            <span class="badge badge-indigo">
                                {{ $cabang->playbox_count }} Playbox
                            </span>
                            <div class="data-card-actions">
                                @if($cabang->link_maps)
                                    <a
                                        href="{{ $cabang->link_maps }}"
                                        target="_blank"
                                        class="btn btn-secondary btn-sm"
                                    >
                                        Lokasi
                                    </a>
                                @endif

                                @php
                                    $cabangData = [
                                        'id' => $cabang->id_cabang,
                                        'nama' => $cabang->nama_cabang,
                                        'alamat' => $cabang->alamat_cabang,
                                        'kontak' => $cabang->kontak_cabang,
                                        'jam_operasional' => $cabang->jam_operasional,
                                        'link_maps' => $cabang->link_maps,
                                        'status_buka' => (bool) $cabang->status_buka,
                                        'foto' => $cabang->foto_cabang
                                            ? Storage::url($cabang->foto_cabang)
                                            : null,
                                        'qris' => $cabang->qris
                                            ? Storage::url($cabang->qris)
                                            : null,
                                    ];
                                @endphp

                                <button type="button" class="btn btn-primary btn-sm"
                                    data-cabang-id="{{ $cabang->id_cabang }}"
                                    data-cabang="{{ json_encode($cabangData) }}"
                                    onclick="openEditCabangModal(JSON.parse(this.dataset.cabang))">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $cabang->id_cabang }}, '{{ addslashes($cabang->nama_cabang) }}')">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>  
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
            <h3>Belum Ada Cabang</h3>
            <p>Tambahkan cabang pertama untuk memulai.</p>
        </div>
    @endif

    {{-- Create Cabang Modal --}}
    <div class="modal-backdrop" id="createCabangModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Tambah Cabang</h3>
                    <p>Tambahkan cabang baru ke sistem BoxPlay</p>
                </div>
                <button type="button" class="modal-close" onclick="closeCreateCabangModal()">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.cabang.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="create_nama_cabang" class="form-label">Nama Cabang <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama_cabang" id="create_nama_cabang" class="form-input"
                        value="{{ old('nama_cabang') }}" placeholder="Contoh: BoxPlay Padang" required>
                    @error('nama_cabang', 'createCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_alamat_cabang" class="form-label">Alamat</label>
                    <textarea name="alamat_cabang" id="create_alamat_cabang" class="form-input" rows="3"
                        placeholder="Alamat lengkap cabang">{{ old('alamat_cabang') }}</textarea>
                    @error('alamat_cabang', 'createCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="create_kontak_cabang" class="form-label">Kontak</label>
                        <input type="text" name="kontak_cabang" id="create_kontak_cabang" class="form-input"
                            value="{{ old('kontak_cabang') }}" placeholder="Contoh: 081234567890">
                        @error('kontak_cabang', 'createCabang')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-half">
                        <label for="create_jam_operasional" class="form-label">Jam Operasional</label>
                        <input type="text" name="jam_operasional" id="create_jam_operasional" class="form-input"
                            value="{{ old('jam_operasional') }}" placeholder="Contoh: 10:00 - 22:00">
                        @error('jam_operasional', 'createCabang')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="create_link_maps" class="form-label">Link Google Maps</label>
                    <input type="url" name="link_maps" id="create_link_maps" class="form-input"
                        value="{{ old('link_maps') }}" placeholder="https://maps.google.com/...">
                    @error('link_maps', 'createCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_status_buka" class="form-label">Status Cabang <span style="color:var(--error)">*</span></label>
                    <select name="status_buka" id="create_status_buka" class="form-select" required>
                        <option value="1" {{ old('status_buka', '1') === '1' || old('status_buka', '1') === 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status_buka') === '0' || old('status_buka') === 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status_buka', 'createCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="createFotoCabangInput" class="form-label">Foto Cabang</label>
                    <input type="file" name="foto_cabang" id="createFotoCabangInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small style="color:#64748b">JPG, PNG, WEBP maksimal 2 MB</small>
                    @error('foto_cabang', 'createCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="createFotoCabangPreview" style="display:none; margin-top:12px;">
                        <img id="createFotoCabangImg" style="max-width:100%; height:160px; object-fit:cover; border-radius:12px;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="createQrisInput" class="form-label">QRIS Pembayaran</label>
                    <input type="file" name="qris" id="createQrisInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small style="color:#64748b">JPG, PNG, WEBP maksimal 2 MB</small>
                    @error('qris', 'createCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="createQrisPreview" style="display:none; margin-top:12px;">
                        <img id="createQrisImg" alt="Preview QRIS" style="max-width:220px; width:100%; height:auto; object-fit:contain; border-radius:12px;">
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCreateCabangModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Cabang</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Cabang Modal --}}
    <div class="modal-backdrop" id="editCabangModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Edit Cabang</h3>
                    <p>Perbarui data cabang BoxPlay</p>
                </div>
                <button type="button" class="modal-close" onclick="closeEditCabangModal()">&times;</button>
            </div>

            <form id="editCabangForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="edit_nama_cabang" class="form-label">Nama Cabang <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama_cabang" id="edit_nama_cabang" class="form-input" required>
                    @error('nama_cabang', 'editCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_alamat_cabang" class="form-label">Alamat</label>
                    <textarea name="alamat_cabang" id="edit_alamat_cabang" class="form-input" rows="3"></textarea>
                    @error('alamat_cabang', 'editCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="edit_kontak_cabang" class="form-label">Kontak</label>
                        <input type="text" name="kontak_cabang" id="edit_kontak_cabang" class="form-input">
                        @error('kontak_cabang', 'editCabang')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-half">
                        <label for="edit_jam_operasional" class="form-label">Jam Operasional</label>
                        <input type="text" name="jam_operasional" id="edit_jam_operasional" class="form-input">
                        @error('jam_operasional', 'editCabang')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_link_maps" class="form-label">Link Google Maps</label>
                    <input type="url" name="link_maps" id="edit_link_maps" class="form-input">
                    @error('link_maps', 'editCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_status_buka" class="form-label">Status Cabang <span style="color:var(--error)">*</span></label>
                    <select name="status_buka" id="edit_status_buka" class="form-select" required>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                    @error('status_buka', 'editCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="editFotoCabangInput" class="form-label">Ganti Foto</label>
                    <input type="file" name="foto_cabang" id="editFotoCabangInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small class="form-hint">Kosongkan jika tidak ingin mengganti foto</small>
                    @error('foto_cabang', 'editCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="editFotoCabangPreview" style="display:none; margin-top:12px;">
                        <img id="editFotoCabangImg" alt="Preview foto" style="max-width:100%; height:160px; object-fit:cover; border-radius:12px;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="editQrisInput" class="form-label">Ganti QRIS Pembayaran</label>
                    <input type="file" name="qris" id="editQrisInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small class="form-hint">Kosongkan jika tidak ingin mengganti QRIS</small>
                    @error('qris', 'editCabang')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="editQrisPreview" style="display:none; margin-top:12px;">
                        <img id="editQrisImg" alt="Preview QRIS" style="max-width:220px; width:100%; height:auto; object-fit:contain; border-radius:12px;">
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditCabangModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal-backdrop" id="deleteModal">
        <div class="modal-box">
            <h3>Hapus Cabang?</h3>
            <p>Apakah Anda yakin ingin menghapus cabang <strong id="deleteName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create Cabang Modal
        function openCreateCabangModal() {
            document.getElementById('createCabangModal').classList.add('show');
        }
        function closeCreateCabangModal() {
            document.getElementById('createCabangModal').classList.remove('show');
        }

        const createFotoCabangInput = document.getElementById('createFotoCabangInput');
        createFotoCabangInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('createFotoCabangImg').src = ev.target.result;
                    document.getElementById('createFotoCabangPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('createFotoCabangPreview').style.display = 'none';
                document.getElementById('createFotoCabangImg').src = '';
            }
        });

        document.getElementById('createCabangModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateCabangModal();
            }
        });

        const createQrisInput = document.getElementById('createQrisInput');
        createQrisInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(ev) {
                    document.getElementById('createQrisImg').src = ev.target.result;
                    document.getElementById('createQrisPreview').style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                document.getElementById('createQrisPreview').style.display = 'none';
                document.getElementById('createQrisImg').src = '';
            }
        });

        // Edit Cabang Modal
        function openEditCabangModal(cabang) {
            const modal = document.getElementById('editCabangModal');

            document.getElementById('editCabangForm').action =
                '{{ route("admin.cabang.index") }}/' + cabang.id;

            document.getElementById('edit_nama_cabang').value = cabang.nama;
            document.getElementById('edit_alamat_cabang').value = cabang.alamat ?? '';
            document.getElementById('edit_kontak_cabang').value = cabang.kontak ?? '';
            document.getElementById('edit_jam_operasional').value = cabang.jam_operasional ?? '';
            document.getElementById('edit_link_maps').value = cabang.link_maps ?? '';
            document.getElementById('edit_status_buka').value = cabang.status_buka ? '1' : '0';

            const preview = document.getElementById('editFotoCabangPreview');
            const image = document.getElementById('editFotoCabangImg');
            const input = document.getElementById('editFotoCabangInput');

            input.value = '';
            if (cabang.foto) {
                image.src = cabang.foto;
                preview.style.display = 'block';
            } else {
                image.src = '';
                preview.style.display = 'none';
            }
            const qrisPreview = document.getElementById('editQrisPreview');
            const qrisImage = document.getElementById('editQrisImg');
            const qrisInput = document.getElementById('editQrisInput');

            qrisInput.value = '';

            if (cabang.qris) {
                qrisImage.src = cabang.qris;
                qrisPreview.style.display = 'block';
            } else {
                qrisImage.src = '';
                qrisPreview.style.display = 'none';
            }

            modal.classList.add('show');
        }
        function closeEditCabangModal() {
            document.getElementById('editCabangModal').classList.remove('show');
        }

        const editFotoCabangInput = document.getElementById('editFotoCabangInput');
        editFotoCabangInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('editFotoCabangImg').src = ev.target.result;
                document.getElementById('editFotoCabangPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        const editQrisInput = document.getElementById('editQrisInput');
        editQrisInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('editQrisImg').src = ev.target.result;
                document.getElementById('editQrisPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('editCabangModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditCabangModal();
            }
        });

        // Delete Modal
        function confirmDelete(id, name) {
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteForm').action = '{{ route("admin.cabang.index") }}/' + id;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Auto-open Create Modal jika validasi gagal
        @if ($errors->createCabang->any())
            openCreateCabangModal();
        @endif

        // Auto-open Edit Modal jika validasi gagal
        @if ($errors->editCabang->any() && session('edit_cabang_id'))
            const editCabangId = {{ session('edit_cabang_id') }};
            const editButton = document.querySelector(`[data-cabang-id="${editCabangId}"]`);

            if (editButton) {
                const cabang = JSON.parse(editButton.dataset.cabang);

                cabang.nama = @json(old('nama_cabang'));
                cabang.alamat = @json(old('alamat_cabang'));
                cabang.kontak = @json(old('kontak_cabang'));
                cabang.jam_operasional = @json(old('jam_operasional'));
                cabang.link_maps = @json(old('link_maps'));

                const oldStatusBuka = @json(old('status_buka'));
                if (oldStatusBuka !== null) {
                    cabang.status_buka = String(oldStatusBuka) === '1';
                }

                openEditCabangModal(cabang);
            }
        @endif
    </script>
    <script>
        document
        .getElementById('branchSearch')
        ?.addEventListener('keyup', function () {

            const keyword = this.value.toLowerCase();

            document
                .querySelectorAll('.data-card')
                .forEach(card => {

                    const text =
                        card.innerText.toLowerCase();

                    card.style.display =
                        text.includes(keyword)
                        ? ''
                        : 'none';
                });
        });
    </script>
@endsection
