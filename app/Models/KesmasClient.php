<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesmasClient extends Model
{
    protected $fillable = [
        'nama',
        'jenis',
        'nik',
        'no_hp',
        'email',
        'alamat',
    ];

    public function registrations()
    {
        return $this->hasMany(KesmasRegistration::class, 'client_id');
    }
    
    public function riwayatPemeriksaan()
    {
        return $this->hasMany(KesmasRegistration::class, 'client_id');
    }

    public function logs()
    {
        return $this->morphMany(KesmasActivityLog::class, 'loggable');
    }
}
