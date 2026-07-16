<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Statistik BoxPlay.id</title>
    <style>
        @page{
            margin:28px 32px;
        }

        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family:DejaVu Sans,sans-serif;
            font-size:10px;
            color:#1e293b;
            background:#fff;
        }

        .header{
            padding-bottom:18px;
            margin-bottom:20px;
            border-bottom:2px solid #2563eb;
        }

        .header-table{
            width:100%;
            border-collapse:collapse;
        }

        .header-title{
            margin:0 0 5px;
            font-size:21px;
            color:#0f172a;
        }

        .header-subtitle{
            margin:0;
            font-size:10px;
            color:#64748b;
        }

        .generated{
            text-align:right;
            color:#64748b;
            font-size:9px;
        }

        .section-title{
            margin:0 0 10px;
            font-size:12px;
            color:#0f172a;
            text-transform:uppercase;
            letter-spacing:.4px;
        }

        .kpi-table{
            width:100%;
            margin-bottom:20px;
            border-collapse:separate;
            border-spacing:6px;
        }

        .kpi-card{
            width:20%;
            padding:13px 11px;
            vertical-align:top;
            background:#f8fafc;
            border:1px solid #e2e8f0;
            border-radius:7px;
        }

        .kpi-label{
            margin-bottom:6px;
            font-size:8px;
            color:#64748b;
            text-transform:uppercase;
        }

        .kpi-value{
            font-size:14px;
            font-weight:bold;
            color:#0f172a;
        }

        .kpi-detail{
            margin-top:4px;
            font-size:8px;
            color:#64748b;
        }

        .info-table{
            width:100%;
            margin-bottom:22px;
            border-collapse:collapse;
        }

        .info-table td{
            width:33.33%;
            padding:11px 12px;
            border:1px solid #e2e8f0;
        }

        .info-label{
            display:block;
            margin-bottom:5px;
            font-size:8px;
            color:#64748b;
        }

        .info-value{
            font-size:11px;
            font-weight:bold;
            color:#0f172a;
        }

        .data-table{
            width:100%;
            margin-bottom:22px;
            border-collapse:collapse;
        }

        .data-table th{
            padding:8px 7px;
            text-align:left;
            font-size:8px;
            color:#fff;
            background:#1e40af;
        }

        .data-table td{
            padding:8px 7px;
            font-size:8px;
            border-bottom:1px solid #e2e8f0;
        }

        .data-table tbody tr:nth-child(even){
            background:#f8fafc;
        }

        .text-right{
            text-align:right !important;
        }

        .text-center{
            text-align:center !important;
        }

        .empty{
            padding:20px;
            text-align:center;
            color:#64748b;
            background:#f8fafc;
            border:1px solid #e2e8f0;
        }

        .page-break{
            page-break-before:always;
        }

        .detail-header{
            padding-bottom:12px;
            margin-bottom:16px;
            border-bottom:1px solid #cbd5e1;
        }

        .detail-title{
            margin:0 0 4px;
            font-size:16px;
            color:#0f172a;
        }

        .detail-subtitle{
            margin:0;
            color:#64748b;
            font-size:9px;
        }

        .footer{
            margin-top:18px;
            padding-top:10px;
            text-align:center;
            font-size:8px;
            color:#94a3b8;
            border-top:1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td>
                    <h1 class="header-title">Laporan Statistik BoxPlay.id</h1>
                    <p class="header-subtitle">
                        Periode {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
                    </p>
                </td>
                <td class="generated">
                    Dicetak pada<br>
                    {{ now()->format('d M Y H:i') }}
                </td>
            </tr>
        </table>
    </div>

    <h2 class="section-title">Ringkasan Kinerja</h2>

    <table class="kpi-table">
        <tr>
            <td class="kpi-card">
                <div class="kpi-label">Total Pendapatan</div>
                <div class="kpi-value">
                    Rp {{ number_format($totalPendapatan,0,',','.') }}
                </div>
            </td>

            <td class="kpi-card">
                <div class="kpi-label">Total Diskon Diberikan</div>
                <div class="kpi-value">
                    Rp {{ number_format($totalDiskon,0,',','.') }}
                </div>
            </td>

            <td class="kpi-card">
                <div class="kpi-label">Total Transaksi</div>
                <div class="kpi-value">
                    {{ number_format($totalTransaksi,0,',','.') }}
                </div>
                <div class="kpi-detail">Transaksi</div>
            </td>

            <td class="kpi-card">
                <div class="kpi-label">Total Sesi Bermain</div>
                <div class="kpi-value">
                    {{ number_format($totalSesi,0,',','.') }}
                </div>
                <div class="kpi-detail">Sesi</div>
            </td>

            <td class="kpi-card">
                <div class="kpi-label">Playbox Teraktif</div>
                <div class="kpi-value">
                    {{ $playboxPalingAktif['nama'] ?? '-' }}
                </div>
                <div class="kpi-detail">
                    {{ $playboxPalingAktif['total'] ?? 0 }} penggunaan
                </div>
            </td>
        </tr>
    </table>

    <h2 class="section-title">Informasi Utama</h2>

    <table class="info-table">
        <tr>
            <td>
                <span class="info-label">Rata-rata Nilai Transaksi</span>
                <span class="info-value">
                    Rp {{ number_format($rataRataTransaksi,0,',','.') }}
                </span>
            </td>

            <td>
                <span class="info-label">Cabang dengan Pendapatan Tertinggi</span>
                <span class="info-value">
                    {{ $cabangTerlaris['nama_cabang'] ?? '-' }}
                </span>
            </td>

            <td>
                <span class="info-label">Jenis Sesi Terpopuler</span>
                <span class="info-value">
                    {{ $jenisSesiTerpopuler ?? '-' }}
                </span>
            </td>
        </tr>
    </table>

    <h2 class="section-title">Ringkasan Per Cabang</h2>

    @if($ringkasanCabang->count())
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:8%">No</th>
                    <th>Cabang</th>
                    <th class="text-center" style="width:22%">Transaksi</th>
                    <th class="text-right" style="width:30%">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ringkasanCabang as $cabang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cabang['nama_cabang'] }}</td>
                        <td class="text-center">{{ $cabang['total_transaksi'] }}</td>
                        <td class="text-right">
                            Rp {{ number_format($cabang['total_pendapatan'],0,',','.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty">
            Tidak ada data cabang pada periode yang dipilih.
        </div>
    @endif

    <div class="footer">
        Laporan ini dibuat secara otomatis oleh sistem BoxPlay.id berdasarkan data pada periode yang dipilih.
    </div>

    @if($transaksi->count())
        <div class="page-break"></div>

        <div class="detail-header">
            <h2 class="detail-title">Detail Transaksi</h2>
            <p class="detail-subtitle">
                Data transaksi periode {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
            </p>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:3%">No</th>
                    <th style="width:11%">Tanggal</th>
                    <th style="width:12%">Pelanggan</th>
                    <th style="width:12%">Cabang</th>
                    <th style="width:10%">Playbox</th>
                    <th style="width:10%">Jenis Sesi</th>
                    <th style="width:6%">Durasi</th>
                    <th class="text-right" style="width:10%">Harga Awal</th>
                    <th style="width:10%">Promo</th>
                    <th class="text-right" style="width:8%">Potongan</th>
                    <th class="text-right" style="width:8%">Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $item)
                    @php
                        $namaCabang = $item->cabang->nama_cabang
                            ?? $item->playbox->cabang->nama_cabang
                            ?? '-';
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tgl_transaksi->format('d M Y H:i') }}</td>
                        <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td>{{ $namaCabang }}</td>
                        <td>{{ $item->playbox->nama_playbox ?? '-' }}</td>
                        <td>{{ $item->jenis_sesi }}</td>
                        <td>
                            {{ $item->durasi == 0 ? 'Fleksibel' : $item->durasi.' menit' }}
                        </td>
                        <td class="text-right">
                            Rp {{ number_format($item->total_harga + $item->nilai_potongan, 0, ',', '.') }}
                        </td>
                        <td>{{ $item->eventPromo?->nama_promo ?? '-' }}</td>
                        <td class="text-right">
                            Rp {{ number_format($item->nilai_potongan, 0, ',', '.') }}
                        </td>
                        <td class="text-right">
                            Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Total {{ $totalTransaksi }} transaksi dengan pendapatan
            Rp {{ number_format($totalPendapatan,0,',','.') }}
        </div>
    @endif

</body>
</html>