<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use SoftDeletes;

    protected $table = 'periode';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'no',
        'tanggal_awal_periode',
        'tanggal_akhir_periode'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function logbook()
    {
        return $this->hasOne('App\Models\Logbook');
    }

    public function project()
    {
        return $this->hasOne('App\Models\Project');
    }
}