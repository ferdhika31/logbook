<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'logbook';
    protected $fillable = [
        'subno',
        'tanggal',
        'tugas',
        'kegiatan_harian',
        'tools',
        'hasil_kerja',
        'keterangan'
    ];

    public function periode()
    {
        return $this->belongsTo('App/Models/Periode');
    }

    public function project()
    {
        return $this->hasOne('App/Models/Periode');
    }
}