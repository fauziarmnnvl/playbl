<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Game extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'game';
    protected $primaryKey = 'id_game';
    public $timestamps = false;

    protected $fillable = ['judul_game', 'kategori', 'deskripsi', 'cover_image'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul_game', 'kategori', 'deskripsi', 'cover_image'])
            ->logOnlyDirty();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return match ($eventName) {
            'created' => "Game {$this->judul_game} ditambahkan",
            'updated' => "Game {$this->judul_game} diperbarui",
            'deleted' => "Game {$this->judul_game} dihapus",
            default => $eventName,
        };
    }
}
