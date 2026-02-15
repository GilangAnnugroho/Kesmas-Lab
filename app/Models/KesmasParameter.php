<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesmasParameter extends Model
{
    protected $fillable = [
        'kategori',      
        'nama_parameter',
        'nilai_rujukan',
        'deskripsi',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function examinationItems()
    {
        return $this->hasMany(KesmasExaminationItem::class, 'parameter_id');
    }

    public function logs()
    {
        return $this->morphMany(KesmasActivityLog::class, 'loggable');
    }
}
