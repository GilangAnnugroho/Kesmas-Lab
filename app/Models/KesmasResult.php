<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesmasResult extends Model
{
    protected $fillable = [
        'examination_item_id',
        'nilai_angka',
        'hasil_text',
        'satuan',
        'nilai_rujukan',
        'keterangan',
        'catatan_petugas', 
        'status_hasil',
        'analis_id',
        'verifikator_id',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(KesmasExaminationItem::class, 'examination_item_id');
    }

    public function analis()
    {
        return $this->belongsTo(User::class, 'analis_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }

    public function logs()
    {
        return $this->morphMany(KesmasActivityLog::class, 'loggable');
    }
}
