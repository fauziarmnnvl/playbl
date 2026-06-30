<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Transaksi extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'kode_transaksi',
        'id_pelanggan',
        'id_cabang',
        'id_playbox',
        'id_promo',
        'durasi',
        'total_harga',
        'jenis_sesi',
        'tgl_transaksi',
    ];
    protected $casts = [
        'total_harga' => 'decimal:2',
        'tgl_transaksi' => 'datetime',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function playbox()
    {
        return $this->belongsTo(Playbox::class, 'id_playbox', 'id_playbox');
    }

    public function eventPromo()
    {
        return $this->belongsTo(EventPromo::class, 'id_promo', 'id_promo');
    }

    public function sesiBermain()
    {
        return $this->hasOne(SesiBermain::class, 'id_transaksi', 'id_transaksi');
    }

    public function riwayatPenggunaan()
    {
        return $this->hasOne(RiwayatPenggunaan::class, 'id_transaksi', 'id_transaksi');
    }

    public static function generateKodeTransaksi(): string
    {
        $today = now()->format('Ymd');
        $lastTrx = self::where('kode_transaksi', 'like', "TRX-{$today}-%")
            ->orderBy('kode_transaksi', 'desc')
            ->first();
        $nextNumber = $lastTrx
            ? (int) substr($lastTrx->kode_transaksi, -2) + 1
            : 1;
        return sprintf("TRX-%s-%02d", $today, $nextNumber);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['kode_transaksi', 'total_harga'])
            ->logOnlyDirty();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return match ($eventName) {
            'created' => "Transaksi {$this->kode_transaksi} dibuat",
            'updated' => "Transaksi {$this->kode_transaksi} diperbarui",
            'deleted' => "Transaksi {$this->kode_transaksi} dihapus",
            default => $eventName,
        };
    }

    public function scopeTetap(Builder $query): Builder
    {
        return $query->where('jenis_sesi', self::JENIS_SESI_TETAP);
    }

    public const JENIS_SESI_TETAP = 'Tetap';
    public const JENIS_SESI_FLEKSIBEL = 'Fleksibel';
}
