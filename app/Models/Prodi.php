<?php
/*
 * @Author: Ferdhika Yudira 
 * @Website: http://dika.web.id 
 * @Date:   2018-07-21 22:07:37 
 * @Email: fer@dika.web.id 
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodi extends Model{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'program_studi';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_prodi'
    ];

    /**
     * Get the jurusan that owns the prodi.
     */
    public function jurusan(){
        return $this->belongsTo('App\Models\Jurusan');
    }

    /**
     * Get the user for the prodi.
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }

}