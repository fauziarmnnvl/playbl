<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Cabang extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';
    public $timestamps = false;

    protected $fillable = [
        'nama_cabang',
        'alamat_cabang',
        'kontak_cabang',
        'jam_operasional',
        'foto_cabang',
        'link_maps',
        'status_buka',
    ];

    protected $casts = [
        'status_buka' => 'boolean',
    ];

    public function playbox()
    {
        return $this->hasMany(Playbox::class, 'id_cabang', 'id_cabang');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama_cabang', 'alamat_cabang', 'kontak_cabang', 'jam_operasional'])
            ->logOnlyDirty();
    }
}
