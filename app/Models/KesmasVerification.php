<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesmasVerification extends Model
{
    protected $fillable = [
        'registration_id',
        'verified_by',
        'verified_at',
        'jabatan',
        'nama_pejabat',
        'nip',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function registration()
    {
        return $this->belongsTo(KesmasRegistration::class, 'registration_id');
    }

    public function pejabat()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function logs()
    {
        return $this->morphMany(KesmasActivityLog::class, 'loggable');
    }
}
