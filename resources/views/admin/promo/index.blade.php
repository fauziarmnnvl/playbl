@extends('layouts.admin')

@section('title', 'Event & Promo — BoxPlay.id')
@section('page_title', 'Event & Promo')
@section('page_description', 'Kelola campaign diskon dan paket bermain')
@section('breadcrumb', 'Data Master / Event & Promo')

@section('content')
    <div class="promo-toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.promo.index') }}"
            class="filter-tab {{ request('status') == null ? 'active' : '' }}">
                Semua
            </a>

            <a href="{{ route('admin.promo.index', ['status' => 'aktif']) }}"
            class="filter-tab {{ request('status') == 'aktif' ? 'active' : '' }}">
                Aktif
            </a>

            <a href="{{ route('admin.promo.index', ['status' => 'nonaktif']) }}"
            class="filter-tab {{ request('status') == 'nonaktif' ? 'active' : '' }}">
                Nonaktif
            </a>
        </div>

        <button type="button" class="btn btn-primary" onclick="openCreatePromoModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Promo
        </button>
    </div>

    @if ($promoList->count() > 0)
        <div class="data-grid">
            @foreach ($promoList as $promo)
                <div class="data-card">
                    <div class="data-card-image promo-banner">
                        @if ($promo->banner_promo)
                            <img src="{{ Storage::url($promo->banner_promo) }}" alt="{{ $promo->nama_promo }}">
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                <line x1="7" y1="7" x2="7.01" y2="7"/>
                            </svg>
                        @endif
                        {{-- Overlay diskon --}}
                        <div class="promo-diskon-overlay">
                            @if ($promo->tipe_diskon === 'Persentase')
                                {{ intval($promo->nilai_diskon) }}%
                            @else
                                Rp {{ number_format($promo->nilai_diskon, 0, ',', '.') }}
                            @endif
                        </div>

                        @if ($promo->is_aktif)
                            <div class="promo-status-badge aktif">
                                Aktif
                            </div>
                        @else
                            <div class="promo-status-badge nonaktif">
                                Nonaktif
                            </div>
                        @endif
                    </div>

                    <div class="data-card-body">
                        <h3 class="data-card-title">{{ $promo->nama_promo }}</h3>

                        <p class="promo-description">
                            {{ $promo->deskripsi }}
                        </p>

                        <div class="data-card-info">
                            <div class="data-card-info-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                <span>{{ $promo->tanggal_mulai->format('d M Y') }} — {{ $promo->tanggal_selesai->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="data-card-footer">
                            <div class="data-card-actions">
                                @php
                                    $promoData = [
                                        'id' => $promo->id_promo,
                                        'nama' => $promo->nama_promo,
                                        'deskripsi' => $promo->deskripsi,
                                        'tipe' => $promo->tipe_diskon,
                                        'nilai' => $promo->nilai_diskon,
                                        'tanggal_mulai' => $promo->tanggal_mulai->format('Y-m-d'),
                                        'tanggal_selesai' => $promo->tanggal_selesai->format('Y-m-d'),
                                        'banner' => $promo->banner_promo ? Storage::url($promo->banner_promo) : null,
                                    ];
                                @endphp

                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-promo-id="{{ $promo->id_promo }}"
                                    data-promo="{{ json_encode($promoData) }}"
                                    onclick="openEditPromoModal(JSON.parse(this.dataset.promo))">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeletePromo({{ $promo->id_promo }}, '{{ addslashes($promo->nama_promo) }}')">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
            <h3>Belum Ada Promo</h3>
            <p>Tambahkan promo pertama untuk memulai campaign.</p>
        </div>
    @endif

    {{-- Create Promo Modal --}}
    <div class="modal-backdrop" id="createPromoModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Tambah Promo</h3>
                    <p>Isi data untuk membuat campaign diskon baru</p>
                </div>
                <button type="button" class="modal-close" onclick="closeCreatePromoModal()">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.promo.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="create_nama_promo" class="form-label">Nama Promo <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama_promo" id="create_nama_promo" class="form-input"
                        value="{{ old('nama_promo') }}" placeholder="Contoh: Diskon Akhir Pekan" required>
                    @error('nama_promo', 'createPromo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_deskripsi" class="form-label">Deskripsi Promo <span style="color:var(--error)">*</span></label>
                    <textarea name="deskripsi" id="create_deskripsi" class="form-input" rows="4"
                        placeholder="Contoh: Diskon spesial untuk penyewaan minimal 3 jam di akhir pekan."
                        required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi', 'createPromo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="create_tipe_diskon" class="form-label">Tipe Diskon <span style="color:var(--error)">*</span></label>
                        <select name="tipe_diskon" id="create_tipe_diskon" class="form-select" required>
                            <option value="Persentase" {{ old('tipe_diskon') === 'Persentase' ? 'selected' : '' }}>Persentase (%)</option>
                            <option value="Nominal" {{ old('tipe_diskon') === 'Nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                        </select>
                    </div>

                    <div class="form-group form-half">
                        <label for="create_nilai_diskon" class="form-label">Nilai Diskon <span style="color:var(--error)">*</span></label>
                        <input type="number" name="nilai_diskon" id="create_nilai_diskon" class="form-input"
                            value="{{ old('nilai_diskon') }}" placeholder="Contoh: 20" min="0" step="0.01" required>
                        @error('nilai_diskon', 'createPromo')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="create_tanggal_mulai" class="form-label">Tanggal Mulai <span style="color:var(--error)">*</span></label>
                        <input type="date" name="tanggal_mulai" id="create_tanggal_mulai" class="form-input"
                            value="{{ old('tanggal_mulai') }}" required>
                    </div>

                    <div class="form-group form-half">
                        <label for="create_tanggal_selesai" class="form-label">Tanggal Selesai <span style="color:var(--error)">*</span></label>
                        <input type="date" name="tanggal_selesai" id="create_tanggal_selesai" class="form-input"
                            value="{{ old('tanggal_selesai') }}" required>
                        @error('tanggal_selesai', 'createPromo')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="createBannerInput" class="form-label">Banner Promo</label>
                    <input type="file" name="banner_promo" id="createBannerInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small style="color:#64748b">JPG, PNG, WEBP maksimal 2 MB</small>
                    @error('banner_promo', 'createPromo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="createBannerPreview" style="display:none; margin-top:12px;">
                        <img id="createBannerImg" style="max-width:100%; height:160px; object-fit:cover; border-radius:12px;">
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCreatePromoModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Promo</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Promo Modal --}}
    <div class="modal-backdrop" id="editPromoModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Edit Promo</h3>
                    <p>Perbarui data campaign promo</p>
                </div>
                <button type="button" class="modal-close" onclick="closeEditPromoModal()">&times;</button>
            </div>

            <form id="editPromoForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="edit_nama_promo" class="form-label">Nama Promo <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama_promo" id="edit_nama_promo" class="form-input" required>
                    @error('nama_promo', 'editPromo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_deskripsi" class="form-label">Deskripsi Promo <span style="color:var(--error)">*</span></label>
                    <textarea name="deskripsi" id="edit_deskripsi" class="form-input" rows="4" required></textarea>
                    @error('deskripsi', 'editPromo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="edit_tipe_diskon" class="form-label">Tipe Diskon <span style="color:var(--error)">*</span></label>
                        <select name="tipe_diskon" id="edit_tipe_diskon" class="form-select" required>
                            <option value="Persentase">Persentase (%)</option>
                            <option value="Nominal">Nominal (Rp)</option>
                        </select>
                        @error('tipe_diskon', 'editPromo')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-half">
                        <label for="edit_nilai_diskon" class="form-label">Nilai Diskon <span style="color:var(--error)">*</span></label>
                        <input type="number" name="nilai_diskon" id="edit_nilai_diskon" class="form-input" min="0" step="0.01" required>
                        @error('nilai_diskon', 'editPromo')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="edit_tanggal_mulai" class="form-label">Tanggal Mulai <span style="color:var(--error)">*</span></label>
                        <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" class="form-input" required>
                        @error('tanggal_mulai', 'editPromo')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-half">
                        <label for="edit_tanggal_selesai" class="form-label">Tanggal Selesai <span style="color:var(--error)">*</span></label>
                        <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai" class="form-input" required>
                        @error('tanggal_selesai', 'editPromo')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="editBannerInput" class="form-label">Banner Promo</label>
                    <input type="file" name="banner_promo" id="editBannerInput" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                    <small class="form-hint">Kosongkan jika tidak ingin mengganti banner</small>
                    @error('banner_promo', 'editPromo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    <div id="editBannerPreview" style="display:none; margin-top:12px;">
                        <img id="editBannerImg" alt="Preview banner" style="max-width:100%; height:160px; object-fit:cover; border-radius:12px;">
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditPromoModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal-backdrop" id="deletePromoModal">
        <div class="modal-box">
            <h3>Hapus Promo?</h3>
            <p>Apakah Anda yakin ingin menghapus <strong id="deletePromoName"></strong>?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="document.getElementById('deletePromoModal').classList.remove('show')">Batal</button>
                <form id="deletePromoForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create Promo Modal
        function openCreatePromoModal() {
            document.getElementById('createPromoModal').classList.add('show');
        }
        function closeCreatePromoModal() {
            document.getElementById('createPromoModal').classList.remove('show');
        }
        const createBannerInput = document.getElementById('createBannerInput');

        createBannerInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(ev) {
                    document.getElementById('createBannerImg').src = ev.target.result;
                    document.getElementById('createBannerPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('createPromoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreatePromoModal();
            }
        });

        // Edit Promo Modal
        function openEditPromoModal(promo) {
            const modal = document.getElementById('editPromoModal');

            document.getElementById('editPromoForm').action =
                '{{ route("admin.promo.index") }}/' + promo.id;

            document.getElementById('edit_nama_promo').value = promo.nama;
            document.getElementById('edit_deskripsi').value = promo.deskripsi;
            document.getElementById('edit_tipe_diskon').value = promo.tipe;
            document.getElementById('edit_nilai_diskon').value = promo.nilai;
            document.getElementById('edit_tanggal_mulai').value = promo.tanggal_mulai;
            document.getElementById('edit_tanggal_selesai').value = promo.tanggal_selesai;

            const preview = document.getElementById('editBannerPreview');
            const image = document.getElementById('editBannerImg');
            const input = document.getElementById('editBannerInput');

            input.value = '';
            if (promo.banner) {
                image.src = promo.banner;
                preview.style.display = 'block';
            } else {
                image.src = '';
                preview.style.display = 'none';
            }
            modal.classList.add('show');
        }
        function closeEditPromoModal() {
            document.getElementById('editPromoModal').classList.remove('show');
        }
        const editBannerInput = document.getElementById('editBannerInput');
        editBannerInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('editBannerImg').src = ev.target.result;
                document.getElementById('editBannerPreview').style.display = 'block';
            };

            reader.readAsDataURL(file);
        });

        // Delete Promo Modal
        function confirmDeletePromo(id, name) {
            document.getElementById('deletePromoName').textContent = name;
            document.getElementById('deletePromoForm').action = '{{ route("admin.promo.index") }}/' + id;
            document.getElementById('deletePromoModal').classList.add('show');
        }
        document.getElementById('deletePromoModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });

        @if ($errors->createPromo->any())
            openCreatePromoModal();
        @endif

        @if ($errors->editPromo->any() && session('edit_promo_id'))
            const editPromoId = {{ session('edit_promo_id') }};
            const editButton = document.querySelector(`[data-promo-id="${editPromoId}"]`);

            if (editButton) {
                const promo = JSON.parse(editButton.dataset.promo);

                promo.nama = @json(old('nama_promo'));
                promo.deskripsi = @json(old('deskripsi'));
                promo.tipe = @json(old('tipe_diskon'));
                promo.nilai = @json(old('nilai_diskon'));
                promo.tanggal_mulai = @json(old('tanggal_mulai'));
                promo.tanggal_selesai = @json(old('tanggal_selesai'));

                openEditPromoModal(promo);
            }
        @endif

        document.getElementById('editPromoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditPromoModal();
            }
        });
    </script>
@endsection
