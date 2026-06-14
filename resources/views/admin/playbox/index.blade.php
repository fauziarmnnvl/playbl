@extends('layouts.admin')

@section('title', 'Manajemen Playbox — BoxPlay.id')
@section('page_title', 'Manajemen Playbox')
@section('page_description', 'Kelola inventaris unit mesin Playbox')
@section('breadcrumb', 'Data Master / Manajemen Playbox')

@section('content')
    <div class="playbox-toolbar">
        <a href="{{ route('admin.playbox.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Playbox
        </a>
    </div>

    @if ($playboxList->count() > 0)
        <div class="table-card">
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
                            <td>{{ $i + 1 }}</td>
                            <td class="td-bold">{{ $playbox->nama_playbox }}</td>
                            <td>{{ $playbox->cabang->nama_cabang ?? '—' }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'Tersedia'    => 'badge-green',
                                        'Maintenance' => 'badge-amber',
                                        'Rusak'       => 'badge-red',
                                    ];
                                    $badgeClass = $statusMap[$playbox->status_mesin] ?? 'badge-default';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $playbox->status_mesin }}</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.playbox.edit', $playbox->id_playbox) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDeletePlaybox({{ $playbox->id_playbox }}, '{{ $playbox->nama_playbox }}')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="8" cy="12" r="1.5"/><circle cx="16" cy="12" r="1.5"/></svg>
            <h3>Belum Ada Playbox</h3>
            <p>Tambahkan unit Playbox pertama untuk memulai.</p>
        </div>
    @endif

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
        function confirmDeletePlaybox(id, name) {
            document.getElementById('deletePlayboxName').textContent = name;
            document.getElementById('deletePlayboxForm').action = '{{ route("admin.playbox.index") }}/' + id;
            document.getElementById('deletePlayboxModal').classList.add('show');
        }
        document.getElementById('deletePlayboxModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });
    </script>
@endsection
