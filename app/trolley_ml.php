<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trolley_ml extends Model
{
   	protected $table = 'trolley_ml';
    protected $guarded = [];


	public function theTrackingSeries() 
    {
        return $this->belongsTo('App\tracking_series','tracking_series_id');
    }


   public function theUserDefinedLocation() 
    {
        return $this->belongsTo('App\tracking_series','user_defined_location_id');
    }
}
