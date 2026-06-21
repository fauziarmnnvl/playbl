<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class SesiBermain extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'sesi_bermain';
    protected $primaryKey = 'id_sesi';
    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'waktu_mulai', 'waktu_selesai', 'sisa_waktu', 'status_sesi'];

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
}
