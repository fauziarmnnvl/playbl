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

        <a href="{{ route('admin.promo.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Promo
        </a>
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
                    </div>

                    <div class="data-card-body">
                        <h3 class="data-card-title">{{ $promo->nama_promo }}</h3>

                        <div class="data-card-info">
                            <div class="data-card-info-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                <span>{{ $promo->tanggal_mulai->format('d M Y') }} — {{ $promo->tanggal_selesai->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="data-card-footer">
                            @if ($promo->is_aktif)
                                <span class="badge badge-green">Aktif</span>
                            @else
                                <span class="badge badge-default">Nonaktif</span>
                            @endif

                            <div class="data-card-actions">
                                <a href="{{ route('admin.promo.edit', $promo->id_promo) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeletePromo({{ $promo->id_promo }}, '{{ addslashes($promo->nama_promo) }}')">Hapus</button>
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
        function confirmDeletePromo(id, name) {
            document.getElementById('deletePromoName').textContent = name;
            document.getElementById('deletePromoForm').action = '{{ route("admin.promo.index") }}/' + id;
            document.getElementById('deletePromoModal').classList.add('show');
        }
        document.getElementById('deletePromoModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });
    </script>
@endsection
