@extends('layouts.admin')

@section('title', 'Riwayat Bermain — BoxPlay.id')
@section('page_title', 'Riwayat Bermain')
@section('page_description', 'Daftar seluruh transaksi dan sesi bermain yang telah tercatat.')
@section('breadcrumb', 'Laporan / Riwayat Bermain')

@section('content')

    {{-- FILTER BAR --}}
    <div class="table-card" style="margin-bottom: 24px; padding: 20px;">
        <form method="GET" action="{{ route('admin.riwayat') }}" id="filterForm">
            <div style="display:flex; justify-content:space-between; align-items:center; gap:24px; flex-wrap:wrap;">
                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ request('tanggal') }}"
                        onchange="document.getElementById('filterForm').submit()"
                        style="
                            width:170px;
                            height:42px;
                            border:1px solid #dbe2ea;
                            border-radius:10px;
                            padding:0 12px;
                            outline:none;
                        "
                    >

                    <select
                        name="playbox"
                        onchange="document.getElementById('filterForm').submit()"
                        style="
                            width:170px;
                            height:42px;
                            border:1px solid #dbe2ea;
                            border-radius:10px;
                            padding:0 12px;
                            background:#fff;
                            outline:none;
                        "
                    >
                        <option value="">Semua Playbox</option>

                        @foreach ($playboxList as $pb)
                            <option
                                value="{{ $pb->id_playbox }}"
                                {{ request('playbox') == $pb->id_playbox ? 'selected' : '' }}
                            >
                                {{ $pb->nama_playbox }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama pelanggan..."
                        onkeydown="if(event.key==='Enter'){this.form.submit()}"
                        style="
                            width:240px;
                            height:42px;
                            border:1px solid #dbe2ea;
                            border-radius:10px;
                            padding:0 14px;
                            outline:none;
                        "
                    >

                </div>

            </div>

            @if (request()->hasAny(['tanggal', 'playbox', 'search']))
                <div style="margin-top: 16px; font-size: 0.875rem; color: #64748b;">
                    Menampilkan {{ $riwayatList->total() }} transaksi
                </div>
            @endif

        </form>
    </div>


    {{-- TABEL DATA --}}
    @if ($riwayatList->count() > 0)
        <div class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tanggal & Waktu</th>
                        <th>Nama Pelanggan</th>
                        <th>Cabang</th>
                        <th>Playbox</th>
                        <th>Jenis Sesi</th>
                        <th>Durasi</th>
                        <th>Biaya</th>
                        <th>Status Sesi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayatList as $index => $trx)
                        <tr>
                            <td>{{ $riwayatList->firstItem() + $index }}</td>
                            <td>
                                <span class="td-bold" style="display: block;">{{ $trx->tgl_transaksi->format('d M Y') }}</span>
                                <span style="font-size: 0.75rem; color: #64748b;">{{ $trx->tgl_transaksi->format('H:i') }}</span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #e2e8f0; color: #475569; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">
                                        {{ strtoupper(substr($trx->pelanggan?->nama_pelanggan ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="td-bold">{{ $trx->pelanggan?->nama_pelanggan ?? '-' }}</span>
                                </div>
                            </td>
                            <td>{{ $trx->cabang?->nama_cabang ?? $trx->playbox?->cabang?->nama_cabang ?? '-' }}</td>
                            <td>{{ $trx->playbox?->nama_playbox ?? '-' }}</td>
                            <td>
                                @if($trx->jenis_sesi === 'Tetap')
                                    <span class="badge badge-blue">Sesi Tetap</span>
                                @else
                                    <span class="badge" style="background: #ede9fe; color: #8b5cf6;">Sesi Fleksibel</span>
                                @endif
                            </td>
                            <td>
                                @if($trx->jenis_sesi === 'Fleksibel')
                                    @php
                                        $durasiMenit = 0;
                                        if ($trx->sesiBermain?->waktu_mulai) {
                                            $mulai = \Carbon\Carbon::parse($trx->sesiBermain->waktu_mulai);
                                            $selesai = $trx->sesiBermain->waktu_selesai
                                                ? \Carbon\Carbon::parse($trx->sesiBermain->waktu_selesai)
                                                : now();
                                            $durasiMenit = (int) $mulai->diffInMinutes($selesai);
                                        }
                                    @endphp

                                    <span class="td-bold">{{ $durasiMenit }}</span>
                                    <span style="font-size: 0.75rem; color: #64748b;">
                                        menit
                                    </span>
                                @else
                                    <span class="td-bold">{{ $trx->durasi }}</span>
                                    <span style="font-size: 0.75rem; color: #64748b;">
                                        menit
                                    </span>
                                @endif
                            </td>
                            <td class="td-bold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $status = $trx->sesiBermain?->status_sesi ?? null;
                                @endphp
                                @if ($status === 'Selesai')
                                    <span class="badge badge-green">Selesai</span>
                                @elseif ($status === 'Berjalan')
                                    <span class="badge badge-blue">Berjalan</span>
                                @elseif ($status !== null)
                                    <span class="badge badge-default">{{ $status }}</span>
                                @else
                                    <span class="badge badge-default">Belum Mulai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="padding: 16px; border-top: 1px solid #e2e8f0;">
                {{ $riwayatList->links() }}
            </div>
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <h3>Belum Ada Riwayat</h3>
            <p>Belum ada riwayat transaksi yang tercatat atau sesuai filter.</p>
            @if (request()->hasAny(['tanggal', 'playbox', 'search']))
                <a href="{{ route('admin.riwayat') }}" class="btn btn-secondary mt-3">Reset Filter</a>
            @endif
        </div>
    @endif
@endsection
