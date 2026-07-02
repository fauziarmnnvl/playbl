<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class SesiBermain extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'sesi_bermain';
    protected $primaryKey = 'id_sesi';
    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'waktu_mulai', 'waktu_selesai', 'sisa_waktu', 'status_sesi', 'is_notified_5_minutes', 'is_notified_finished'];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status_sesi', 'sisa_waktu'])
            ->logOnlyDirty();
    }

    public function getDescriptionForEvent(string $eventName): string {
        $playbox = optional(
            optional($this->transaksi)->playbox
        )->nama_playbox ?? 'Playbox';

        if (
            $eventName === 'updated' &&
            $this->status_sesi === 'Selesai'
        ) {
            return "Sesi {$playbox} telah selesai";
        }

        return match ($eventName) {
            'created' => "Sesi {$playbox} dimulai",
            'updated' => "Data sesi {$playbox} diperbarui",
            'deleted' => "Sesi {$playbox} dihapus",
            default => $eventName,
        };
    }
    
    public function scopeRunning(Builder $query): Builder
    {
        return $query
            ->where('status_sesi', self::STATUS_BERJALAN)
            ->whereNotNull('waktu_selesai');
    }

    public function scopeBelumMulai(Builder $query): Builder
    {
        return $query->where('status_sesi', self::STATUS_BELUM_MULAI);
    }

    public const STATUS_BELUM_MULAI = 'Belum Mulai';
    public const STATUS_BERJALAN = 'Berjalan';
    public const STATUS_SELESAI = 'Selesai';
}
