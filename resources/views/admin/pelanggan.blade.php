@extends('layouts.admin')

@section('title', 'Data Pelanggan — BoxPlay.id')
@section('page_title', 'Data Pelanggan')
@section('page_description', 'Data pelanggan BoxPlay.id')
@section('breadcrumb', 'Data Master / Data Pelanggan')

@section('content')
   
    <div class="pelanggan-toolbar">
    <form method="GET" action="{{ route('admin.pelanggan') }}">
        <input type="text" name="search" class="pelanggan-search" placeholder="Cari nama pelanggan atau nomor HP..." value="{{ request('search') }}">
    </form>
</div>

    @if ($pelangganList->count() > 0)
        <div class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No HP</th>
                        <th>Total Booking</th>
                        <th>Terakhir Bermain</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelangganList as $i => $pelanggan)
                        <tr>
                            <td>{{ $pelangganList->firstItem() + $i }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #e2e8f0; color: #475569; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">
                                        {{ strtoupper(substr($pelanggan->nama_pelanggan, 0, 1)) }}
                                    </div>
                                    <span class="td-bold">{{ $pelanggan->nama_pelanggan }}</span>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span>{{ $pelanggan->no_hp }}</span>
                                    <button type="button" onclick="copyToClipboard('{{ $pelanggan->no_hp }}')" style="background: none; border: none; cursor: pointer; color: #64748b; padding: 4px; border-radius: 4px; display: flex; align-items: center;" title="Copy No HP" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='none'">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td>
                                @php
                                    $bookingCount = $pelanggan->transaksi_count ?? 0;
                                    $badgeClass = 'badge-default';
                                    if ($bookingCount >= 5) {
                                        $badgeClass = 'badge-green';
                                    } elseif ($bookingCount >= 1) {
                                        $badgeClass = 'badge-blue';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $bookingCount }} Booking</span>
                            </td>
                            <td>
                                @if($pelanggan->transaksi_max_tgl_transaksi)
                                    {{ \Carbon\Carbon::parse($pelanggan->transaksi_max_tgl_transaksi)->locale('id')->translatedFormat('d M Y') }}
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="padding: 16px; border-top: 1px solid #e2e8f0;">
                {{ $pelangganList->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <h3>Belum Ada Data Pelanggan</h3>
            <p>Data pelanggan akan terisi secara otomatis saat ada transaksi.</p>
            @if(request('search'))
                <a href="{{ route('admin.pelanggan') }}" class="btn btn-secondary mt-3">Reset Pencarian</a>
            @endif
        </div>
    @endif

    <script>
        function copyToClipboard(text) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('No HP berhasil disalin: ' + text);
                }).catch(err => {
                    console.error('Failed to copy text: ', err);
                });
            } else {
                // Fallback for older browsers
                const textArea = document.createElement("textarea");
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                try {
                    document.execCommand('copy');
                    alert('No HP berhasil disalin: ' + text);
                } catch (err) {
                    console.error('Fallback: Oops, unable to copy', err);
                }
                document.body.removeChild(textArea);
            }
        }
    </script>
@endsection
