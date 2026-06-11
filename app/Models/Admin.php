<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Admin extends Authenticatable
{
    use HasFactory, LogsActivity;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama', 'email'])
            ->logOnlyDirty();
    }
}
