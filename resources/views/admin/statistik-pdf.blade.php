<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Statistik BoxPlay</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; color: #333; }
        h1 { text-align: center; font-size: 24px; margin-bottom: 5px; }
        h3 { text-align: center; font-size: 16px; margin-top: 0; color: #666; font-weight: normal; margin-bottom: 30px; }
        .kpi-container { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .kpi-container th, .kpi-container td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .kpi-container th { background-color: #f4f4f4; width: 30%; }
        .kpi-value { font-weight: bold; font-size: 16px; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #999; }
    </style>
</head>
<body>

    <h1>Laporan Statistik BoxPlay</h1>
    <h3>Periode {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</h3>

    <table class="kpi-container">
        <tr>
            <th>Total Pendapatan</th>
            <td class="kpi-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Transaksi</th>
            <td class="kpi-value">{{ number_format($totalTransaksi, 0, ',', '.') }} Transaksi</td>
        </tr>
        <tr>
            <th>Total Sesi Bermain</th>
            <td class="kpi-value">{{ number_format($totalSesi, 0, ',', '.') }} Sesi</td>
        </tr>
        <tr>
            <th>Playbox Teraktif</th>
            <td class="kpi-value">
                @if($playboxPalingAktif)
                    {{ $playboxPalingAktif->playbox->nama_playbox ?? 'Unknown' }} 
                    ({{ $playboxPalingAktif->total }} penggunaan)
                @else
                    Tidak ada data
                @endif
            </td>
        </tr>
    </table>

    <p>Ringkasan Statistik ini digenerate secara otomatis oleh sistem BoxPlay.id berdasarkan data aktual pada rentang tanggal yang dipilih.</p>

    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y H:i:s') }}
    </div>

</body>
</html>
