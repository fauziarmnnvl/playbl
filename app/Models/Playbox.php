<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Playbox extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'playbox';
    protected $primaryKey = 'id_playbox';
    public $timestamps = false;

    protected $fillable = ['id_cabang', 'nama_playbox', 'status_unit'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_playbox', 'id_playbox');
    }

    /**
     * Transaksi aktif — transaksi terbaru yang memiliki sesi berjalan.
     */
    public function transaksiAktif()
    {
        return $this->hasOne(Transaksi::class, 'id_playbox', 'id_playbox')
            ->whereHas('sesiBermain', function ($q) {
                $q->where('status_sesi', 'Berjalan');
            })
            ->latestOfMany('id_transaksi');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id_cabang', 'nama_playbox', 'status_unit'])
            ->logOnlyDirty();
    }
}
