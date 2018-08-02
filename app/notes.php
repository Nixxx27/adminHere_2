<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notes extends Model
{
    protected $table = 'notes';

    protected $fillable = array(
    	'notes',
    	'entered_by'
    	
	);

	public function theencoder()
    {
        return $this->belongsTo('App\user','entered_by');
    }
}
