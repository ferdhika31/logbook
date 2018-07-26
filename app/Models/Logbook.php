<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logbook extends Model
{
    use SoftDeletes;

    protected $table = 'logbook';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'subno',
        'tanggal',
        'tugas',
        'kegiatan_harian',
        'tools',
        'hasil_kerja',
        'keterangan'
    ];

    public function periode(){
        return $this->belongsTo('App\Models\Periode');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}