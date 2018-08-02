<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
	protected $table = 'locations';
    protected $guarded = [];

    public function theTrackingSeries()
    {
        return $this->hasMany('App\tracking_series','location_id');
    }

    public function theTrolleyMasterLists()
    {
        return $this->hasMany('App\tracking_series','user_defined_location_id');
    }

}
