<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenggunaan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penggunaan';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'tanggal_main', 'pendapatan', 'keterangan'];

    protected $casts = [
        'tanggal_main' => 'date',
        'pendapatan' => 'decimal:2',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
