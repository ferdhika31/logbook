<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'project';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'nama_project',
        'project_manager',
        'technical_leader'
    ];

    public function perusahaan(){
        return $this->belongsTo('App\Models\Perusahaan');
    }

}