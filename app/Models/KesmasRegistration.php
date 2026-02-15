<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesmasRegistration extends Model
{
    protected $fillable = [
        'client_id',
        'no_registrasi',
        'nama_sampel',
        'identitas_pengirim',
        'lokasi_pengambilan',
        'jenis_sampel',
        'jenis_pemeriksaan',
        'petugas_sampling',
        'alamat_petugas_sampling',
        'tgl_pengambilan',
        'jam_pengambilan',
        'tgl_permintaan',      
        'tgl_penerimaan',
        'jam_penerimaan',
        'volume_sampel',
        'status_pembayaran',
        'status_proses',
        'sumber',
        'mikrobiologi',
        'kimia',

        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tgl_pengambilan' => 'date',
        'tgl_permintaan'  => 'date',
        'tgl_penerimaan'  => 'date',

        'mikrobiologi'    => 'array',
        'kimia'           => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(KesmasClient::class, 'client_id');
    }

    public function items()
    {
        return $this->hasMany(KesmasExaminationItem::class, 'registration_id');
    }

    public function results()
    {
        return $this->hasManyThrough(
            KesmasResult::class,
            KesmasExaminationItem::class,
            'registration_id',
            'examination_item_id'
        );
    }

    public function verification()
    {
        return $this->hasOne(KesmasVerification::class, 'registration_id');
    }

    public function verifikasi()
    {
        return $this->hasOne(KesmasVerification::class, 'registration_id');
    }

    public function logs()
    {
        return $this->morphMany(KesmasActivityLog::class, 'loggable');
    }

    public function isCompleted()
    {
        return $this->status_proses === 'selesai';
    }
}
