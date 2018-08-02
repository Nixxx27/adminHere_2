<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tracking_series extends Model
{
    protected $table = 'tracking_series';
    protected $guarded = [];


	public function theLocation() 
    {
        return $this->belongsTo('App\locations','location_id');
    }
}
