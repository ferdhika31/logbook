<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nama_mahasiswa',
    ];

    public function periode()
    {
        return $this->hasMany('App/Models/Periode');
    }

    public function perusahaan()
    {
        return $this->hasOne('App/Models/Perusahaan');
    }
}