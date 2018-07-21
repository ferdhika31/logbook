<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim', 'name', 'email', 'password', 'program_studi_id', 'perusahaan_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the prodi that owns the user.
     */
    public function prodi(){
        return $this->belongsTo('App\Models\Prodi');
    }

    /**
     * Get the perusahaan that owns the user.
     */
    public function perusahaan(){
        return $this->belongsTo('App\Models\Perusahaan');
    }
}
