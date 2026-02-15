<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesmasExaminationItem extends Model
{
    protected $fillable = [
        'registration_id',
        'parameter_id',
        'status', 
    ];

    public function registration()
    {
        return $this->belongsTo(KesmasRegistration::class, 'registration_id');
    }

    public function parameter()
    {
        return $this->belongsTo(KesmasParameter::class, 'parameter_id');
    }

    public function result()
    {
        return $this->hasOne(KesmasResult::class, 'examination_item_id');
    }

    public function logs()
    {
        return $this->morphMany(KesmasActivityLog::class, 'loggable');
    }

    public function done()
    {
        return $this->status === 'selesai';
    }
}
