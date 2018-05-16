<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $table = 'employee';

    protected $fillable = array(
    	'empidnum',
    	'name',
    	'company',
    	'department',
    	'division',
    	'shift',
    	'dayoff',
	);

	// public function thedepartment() 
 //    {
 //        return $this->belongsTo('App\department','department_id');
 //    }

 //    public function thefindings()
 //    {
 //        return $this->hasMany('App\findings','finding_audit_id');
 //    }

    // public function theattachments()
    // {
    //     return $this->hasOne('App\audit_attachments','attachment_audit_id');
    // }

    // public function theattachment($id)
    // {
    //     return audit_attachments::where('attachment_audit_id',$id)->first();
    // }
}
