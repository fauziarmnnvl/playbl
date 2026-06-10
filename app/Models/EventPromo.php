<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class EventPromo extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'event_promo';
    protected $primaryKey = 'id_promo';
    public $timestamps = false;

    protected $fillable = ['nama_promo', 'tipe_diskon', 'nilai_diskon', 'tanggal_mulai', 'tanggal_selesai', 'banner_promo'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'nilai_diskon' => 'decimal:2',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_promo', 'id_promo');
    }

    public function getIsAktifAttribute(): bool
    {
        $today = now()->toDateString();
        return $this->tanggal_mulai <= $today && $this->tanggal_selesai >= $today;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama_promo', 'tipe_diskon', 'nilai_diskon', 'tanggal_mulai', 'tanggal_selesai', 'banner_promo'])
            ->logOnlyDirty();
    }
}
