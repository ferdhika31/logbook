<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

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