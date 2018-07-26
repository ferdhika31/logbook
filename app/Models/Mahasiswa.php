<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes;
    
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