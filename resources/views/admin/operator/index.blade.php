@extends('layouts.admin')

@section('title', 'Manajemen Operator — BoxPlay.id')
@section('page_title', 'Manajemen Operator')
@section('page_description', 'Kelola akun penjaga shift / kasir')
@section('breadcrumb', 'Data Master / Manajemen Operator')

@section('content')
    <div class="playbox-toolbar">
        <a href="{{ route('admin.operator.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Operator
        </a>
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
                                    <a href="{{ route('admin.operator.edit', $operator->id) }}" class="btn btn-secondary btn-sm">Edit</a>
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
        function confirmDeleteOperator(id, name) {
            document.getElementById('deleteOperatorName').textContent = name;
            document.getElementById('deleteOperatorForm').action = '{{ route("admin.operator.index") }}/' + id;
            document.getElementById('deleteOperatorModal').classList.add('show');
        }
        document.getElementById('deleteOperatorModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });
    </script>
@endsection
