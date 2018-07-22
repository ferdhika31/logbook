<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'periode';
    protected $fillable = [
        'no',
        'tanggal_awal_periode',
        'tanggal_akhir_periode'
    ];
    
    public function mahasiswa()
    {
        return $this->belongsTo('App/Models/Mahasiswa');
    }

    public function logbook()
    {
        return $this->hasMany('App/Models/Logbook');
    }
}