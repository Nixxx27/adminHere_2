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
        'name', 'email', 'password','role','location_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    //check if admin . = 1
    public function is_admin()
    {
        if($this->role == 'admin')
        {
            return true;
        }

        return false;
    }

    public function theLocation() 
    {
        return $this->belongsTo('App\locations','location_id');
    }



}
