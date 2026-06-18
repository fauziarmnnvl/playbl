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
    <a href="{{ route('admin.cabang.create') }}" class="btn btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Cabang
    </a>
</div>

    @if ($cabangList->count() > 0)
        <div class="data-grid">
            @foreach ($cabangList as $cabang)
                <div class="data-card">
                    <div class="data-card-image">
                        @if($cabang->foto_cabang)
                            <img
                                src="{{ asset($cabang->foto_cabang) }}"
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
                                <a href="{{ route('admin.cabang.edit', $cabang->id_cabang) }}" class="btn btn-primary btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $cabang->id_cabang }}, '{{ $cabang->nama_cabang }}')">Hapus</button>
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
        function confirmDelete(id, name) {
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteForm').action = '{{ route("admin.cabang.index") }}/' + id;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        // Close modal on backdrop click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
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
