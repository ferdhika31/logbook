<?php
/*
 * @Author: Ferdhika Yudira 
 * @Website: http://dika.web.id 
 * @Date:   2018-07-22 00:03:37 
 * @Email: fer@dika.web.id 
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perusahaan extends Model{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perusahaan';

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
        'nama_perusahaan'
    ];

    /**
     * Get the user for the perusahaan.
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }

    // public function project(){
    //     return $this->belongsTo('App\Models\Project');
    // }

}