@extends('layouts.admin')

@section('title', 'Manajemen Operator — BoxPlay.id')
@section('page_title', 'Manajemen Operator')
@section('page_description', 'Kelola akun penjaga shift / kasir')
@section('breadcrumb', 'Data Master / Manajemen Operator')

@section('content')
    <div class="playbox-toolbar">
        <button type="button" class="btn btn-primary" onclick="openCreateOperatorModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Operator
        </button>
    </div>

    @if ($operators->count() > 0)
        <div class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Penempatan Cabang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operators as $i => $operator)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="td-bold">{{ $operator->nama }}</td>
                            <td><code style="background:#f1f5f9; padding:2px 8px; border-radius:4px; font-size:0.8125rem;">{{ $operator->username }}</code></td>
                            <td>{{ $operator->email }}</td>
                            <td>
                                @if ($operator->cabang)
                                    <span class="badge badge-indigo">{{ $operator->cabang->nama_cabang }}</span>
                                @else
                                    <span class="badge badge-default">Belum ditentukan</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    @php
                                        $operatorData = [
                                            'id' => $operator->id,
                                            'nama' => $operator->nama,
                                            'username' => $operator->username,
                                            'email' => $operator->email,
                                            'id_cabang' => $operator->id_cabang,
                                            'telegram_id' => $operator->telegram_id,
                                        ];
                                    @endphp

                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-operator-id="{{ $operator->id }}"
                                        data-operator="{{ json_encode($operatorData) }}"
                                        onclick="openEditOperatorModal(JSON.parse(this.dataset.operator))">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDeleteOperator({{ $operator->id }}, '{{ addslashes($operator->nama) }}')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <h3>Belum Ada Operator</h3>
            <p>Tambahkan akun operator pertama untuk memulai.</p>
        </div>
    @endif

    {{-- Create Operator Modal --}}
    <div class="modal-backdrop" id="createOperatorModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Tambah Operator</h3>
                    <p>Buat akun operator baru untuk mengelola cabang</p>
                </div>
                <button type="button" class="modal-close" onclick="closeCreateOperatorModal()">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.operator.store') }}">
                @csrf

                <div class="form-group">
                    <label for="create_nama" class="form-label">Nama Lengkap <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama" id="create_nama" class="form-input"
                        value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required>
                    @error('nama', 'createOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="create_username" class="form-label">Username <span style="color:var(--error)">*</span></label>
                        <input type="text" name="username" id="create_username" class="form-input"
                            value="{{ old('username') }}" placeholder="Contoh: budi_santoso" required>
                        @error('username', 'createOperator')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-half">
                        <label for="create_email" class="form-label">Email <span style="color:var(--error)">*</span></label>
                        <input type="email" name="email" id="create_email" class="form-input"
                            value="{{ old('email') }}" placeholder="Contoh: budi@boxplay.id" required>
                        @error('email', 'createOperator')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="create_password" class="form-label">Password <span style="color:var(--error)">*</span></label>
                    <input type="password" name="password" id="create_password" class="form-input"
                        placeholder="Minimal 8 karakter" required>
                    @error('password', 'createOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_id_cabang" class="form-label">Penempatan Cabang <span style="color:var(--error)">*</span></label>
                    <select name="id_cabang" id="create_id_cabang" class="form-select" required>
                        <option value="">— Pilih Cabang —</option>
                        @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->id_cabang }}"
                                {{ old('id_cabang') == $cabang->id_cabang ? 'selected' : '' }}>
                                {{ $cabang->nama_cabang }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_cabang', 'createOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="create_telegram_id" class="form-label">Telegram ID</label>
                    <input type="text" name="telegram_id" id="create_telegram_id" class="form-input"
                        value="{{ old('telegram_id') }}" placeholder="Contoh: 123456789">
                    <small style="color:#64748b">Chat ID Telegram operator untuk menerima notifikasi.</small>
                    @error('telegram_id', 'createOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCreateOperatorModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Operator</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Operator Modal --}}
    <div class="modal-backdrop" id="editOperatorModal">
        <div class="modal-box promo-form-modal">
            <div class="modal-header">
                <div>
                    <h3>Edit Operator</h3>
                    <p>Perbarui data akun operator</p>
                </div>
                <button type="button" class="modal-close" onclick="closeEditOperatorModal()">&times;</button>
            </div>

            <form id="editOperatorForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="edit_nama" class="form-label">Nama Lengkap <span style="color:var(--error)">*</span></label>
                    <input type="text" name="nama" id="edit_nama" class="form-input" required>
                    @error('nama', 'editOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group form-half">
                        <label for="edit_username" class="form-label">Username <span style="color:var(--error)">*</span></label>
                        <input type="text" name="username" id="edit_username" class="form-input" required>
                        @error('username', 'editOperator')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-half">
                        <label for="edit_email" class="form-label">Email <span style="color:var(--error)">*</span></label>
                        <input type="email" name="email" id="edit_email" class="form-input" required>
                        @error('email', 'editOperator')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_password" class="form-label">Password</label>
                    <input type="password" name="password" id="edit_password" class="form-input"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    <small style="color:#64748b">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah.</small>
                    @error('password', 'editOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_id_cabang" class="form-label">Penempatan Cabang <span style="color:var(--error)">*</span></label>
                    <select name="id_cabang" id="edit_id_cabang" class="form-select" required>
                        <option value="">— Pilih Cabang —</option>
                        @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->id_cabang }}">
                                {{ $cabang->nama_cabang }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_cabang', 'editOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_telegram_id" class="form-label">Telegram ID</label>
                    <input type="text" name="telegram_id" id="edit_telegram_id" class="form-input">
                    <small style="color:#64748b">Chat ID Telegram operator untuk menerima notifikasi.</small>
                    @error('telegram_id', 'editOperator')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditOperatorModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal-backdrop" id="deleteOperatorModal">
        <div class="modal-box">
            <h3>Hapus Operator?</h3>
            <p>Apakah Anda yakin ingin menghapus <strong id="deleteOperatorName"></strong>?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="document.getElementById('deleteOperatorModal').classList.remove('show')">Batal</button>
                <form id="deleteOperatorForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create Operator Modal
        function openCreateOperatorModal() {
            document.getElementById('createOperatorModal').classList.add('show');
        }
        function closeCreateOperatorModal() {
            document.getElementById('createOperatorModal').classList.remove('show');
        }

        document.getElementById('createOperatorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateOperatorModal();
            }
        });

        // Edit Operator Modal
        function openEditOperatorModal(operator) {
            const modal = document.getElementById('editOperatorModal');

            document.getElementById('editOperatorForm').action =
                '{{ route("admin.operator.index") }}/' + operator.id;

            document.getElementById('edit_nama').value = operator.nama;
            document.getElementById('edit_username').value = operator.username;
            document.getElementById('edit_email').value = operator.email;
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_id_cabang').value = operator.id_cabang;
            document.getElementById('edit_telegram_id').value = operator.telegram_id ?? '';

            modal.classList.add('show');
        }
        function closeEditOperatorModal() {
            document.getElementById('editOperatorModal').classList.remove('show');
        }

        document.getElementById('editOperatorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditOperatorModal();
            }
        });

        // Delete Operator Modal
        function confirmDeleteOperator(id, name) {
            document.getElementById('deleteOperatorName').textContent = name;
            document.getElementById('deleteOperatorForm').action = '{{ route("admin.operator.index") }}/' + id;
            document.getElementById('deleteOperatorModal').classList.add('show');
        }
        document.getElementById('deleteOperatorModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });

        // Auto-open Create Modal jika validasi gagal
        @if ($errors->createOperator->any())
            openCreateOperatorModal();
        @endif

        // Auto-open Edit Modal jika validasi gagal
        @if ($errors->editOperator->any() && session('edit_operator_id'))
            const editOperatorId = {{ session('edit_operator_id') }};
            const editButton = document.querySelector(`[data-operator-id="${editOperatorId}"]`);

            if (editButton) {
                const operator = JSON.parse(editButton.dataset.operator);

                operator.nama = @json(old('nama'));
                operator.username = @json(old('username'));
                operator.email = @json(old('email'));
                operator.id_cabang = @json(old('id_cabang'));
                operator.telegram_id = @json(old('telegram_id'));

                openEditOperatorModal(operator);
            }
        @endif
    </script>
@endsection
