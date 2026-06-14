@extends('layouts.admin')

@section('title', 'Riwayat Bermain — BoxPlay.id')
@section('page_title', 'Riwayat Bermain')
@section('page_description', 'Histori transaksi dan sesi bermain cabang Anda')
@section('breadcrumb', 'Riwayat Bermain')

@section('content')
    @if ($riwayat->count() > 0)
        <div class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Playbox</th>
                        <th>Durasi</th>
                        <th>Total Biaya</th>
                        <th>Status Bayar</th>
                        <th>Status Sesi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $i => $trx)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><code style="background:#f1f5f9; padding:2px 8px; border-radius:4px; font-size:0.8125rem;">{{ $trx->kode_transaksi }}</code></td>
                            <td class="td-bold">{{ $trx->pelanggan->nama_pelanggan ?? '—' }}</td>
                            <td>{{ $trx->playbox->nama_playbox ?? '—' }}</td>
                            <td>{{ $trx->durasi_menit }} menit</td>
                            <td>Rp {{ number_format($trx->total_biaya, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $bayarMap = [
                                        'Lunas'                 => 'badge-green',
                                        'Menunggu Verifikasi'   => 'badge-amber',
                                        'Dibatalkan'            => 'badge-red',
                                    ];
                                @endphp
                                <span class="badge {{ $bayarMap[$trx->status_bayar] ?? 'badge-default' }}">{{ $trx->status_bayar }}</span>
                            </td>
                            <td>
                                @if ($trx->sesiBermain)
                                    @php
                                        $sesiMap = [
                                            'Berjalan' => 'badge-blue',
                                            'Selesai'  => 'badge-green',
                                            'Dibatalkan' => 'badge-red',
                                        ];
                                    @endphp
                                    <span class="badge {{ $sesiMap[$trx->sesiBermain->status_sesi] ?? 'badge-default' }}">{{ $trx->sesiBermain->status_sesi }}</span>
                                @else
                                    <span class="badge badge-default">—</span>
                                @endif
                            </td>
                            <td style="white-space:nowrap">{{ $trx->waktu_transaksi ? $trx->waktu_transaksi->format('d/m/Y H:i') : '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <h3>Belum Ada Riwayat</h3>
            <p>Belum ada transaksi di cabang Anda.</p>
        </div>
    @endif
@endsection
