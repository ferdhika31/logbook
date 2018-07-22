<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'project';
    protected $fillable = [
        'nama_project',
        'project_manager',
        'technical_leader'
    ];

    public function perusahaan()
    {
        return $this->hasOne('App/Models/Perusahaan');
    }

}