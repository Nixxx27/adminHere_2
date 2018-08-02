<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trolley_history extends Model
{
    protected $table = 'trolley_history';
    protected $guarded = [];
    protected $dates = ['returned_date'];


    public function theTrolley() 
    {
        return $this->belongsTo('App\trolley_ml','trolley_ml_id');
    }

    public function theCurrentLocation() 
    {
        return $this->belongsTo('App\locations','user_current_location_id');
    }

    public function theUserDefinedLocation() 
    {
        return $this->belongsTo('App\locations','user_defined_location_id');
    }

    public function theReturnedBy() 
    {
        return $this->belongsTo('App\User','returned_by');
    }
}
