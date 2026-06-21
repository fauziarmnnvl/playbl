<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    use Exportable;

    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return Transaksi::query()
            ->with(['pelanggan', 'playbox', 'cabang'])
            ->whereBetween('tgl_transaksi', [$this->startDate, $this->endDate])
            ->orderBy('tgl_transaksi', 'desc');
    }

    public function headings(): array
    {
        return [
            'Tanggal Transaksi',
            'Pelanggan',
            'Cabang',
            'Playbox',
            'Jenis Sesi',
            'Durasi (Menit)',
            'Total Harga'
        ];
    }

    public function map($transaksi): array
    {
        // Prioritaskan cabang dari transaksi, jika null ambil dari relasi playbox->cabang
        $namaCabang = $transaksi->cabang->nama_cabang ?? ($transaksi->playbox->cabang->nama_cabang ?? '-');

        return [
            $transaksi->tgl_transaksi->format('d M Y H:i'),
            $transaksi->pelanggan->nama_pelanggan ?? '-',
            $namaCabang,
            $transaksi->playbox->nama_playbox ?? '-',
            $transaksi->jenis_sesi,
            $transaksi->durasi == 0 ? 'Fleksibel' : $transaksi->durasi,
            $transaksi->total_harga
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
