<?php
 
namespace App\MyApp;
 
use Auth;
// use App\responses;
// use App\findings;
use Carbon\Carbon;
use App\trolley_ml;
use App\tracking_series;
use App\locations;
use App\trolley_history;
use Illuminate\Support\Facades\DB;

class NewClass {
	

    /*
    |--------------------------------------------------------------------------
    | WILL RETURN LAST TROLLEY HISTORY
    |--------------------------------------------------------------------------
 	*/
	public function trolleyLastHistory($trolley_id)
	{
		$history = trolley_history::where('trolley_ml_id', $trolley_id)->orderBy('id','DESC')->first();
		if ( $history ) {
			return  $history;
		}else
		{
			return "";
		}
	}


	 /*
    |--------------------------------------------------------------------------
    | WILL RETURN FOR RETURN TROLLIES
    |--------------------------------------------------------------------------
 	*/
	public function forReturnTrollies()
	{
		$histories = trolley_history::where('status', 'forreturn')
		->where('is_returned', 0)
		->orderBy('id','DESC')
		->get();
		
		if ( $history ) {
			return  $history;
		}else
		{
			return "";
		}
	}


	#LAST 5 RESPONSES
	public function latest_responses()
	{
		 return $responses = responses::where('type','response')
		  ->whereHas('thefindings', function ($query) {
            $query->where('status', '<>', "closed"); 
            })
		  ->orderBy('id','DESC')->limit(7)->get();
	}

	##CHECK IF HAS NOTIFICATIONS
	public function notification_is_on()
	{
		if(Auth::user()->is_admin())
		{
			$findings = findings::where('notify',1)->first();
		}else
		{
			$findings = findings::where('notify',1)
			->where('issued_to',Auth::user()->dept)
			->first();
		}



		if($findings)
		{
			return 1;
		}else
		{
			return 0;
		}
	}

	##CHECK NOTIFICATION FOR NEW RESPONSE WITHOUT COMMENT
	public function new_response_notification($id)
	{
		$responses = responses::where('type','response')
		->where('id',$id)
		->where('notify',1)
		 ->whereHas('thefindings', function ($query) {
            $query->where('status', '<>', "closed"); 
            })
		->first();
		if($responses)
		{
			return 1;
		}else
		{
			return 0;
		}
	}

	public function check_if_there_is_an_over_due_findings()
	{

		if(Auth::user()->is_admin())
		{

			$overdue = findings::where('response_due', '<', carbon::now()->format('Y-m-d'))
			->where('status','!=','closed')
			->first();
		}else
		{
			$overdue = findings::where('response_due', '<', carbon::now()->format('Y-m-d'))
			->where('issued_to',Auth::user()->dept)
			->where('status','!=','closed')
			->first();
		}

		if($overdue)
		{
			return 1;
		}else
		{
			return 0;
		}
	}

	public function show_all_overdue_findings()
	{
		if(Auth::user()->is_admin())
		{
			 $overdue = findings::where('response_due', '<', carbon::now()->format('Y-m-d'))
			->where('status','!=','closed')
			->limit(10)
			->get();
		} else
		{
			 $overdue = findings::where('response_due', '<', carbon::now()->format('Y-m-d'))
			->where('status','!=','closed')
			->limit(10)
			->where('issued_to',Auth::user()->dept)
			->get();
		};

		return 	$overdue;
		

	}


	public function count_overdue_of_logon_user()
	{
		return $overdue = findings::where('response_due', '<', carbon::now()->format('Y-m-d'))
		->where('status','!=','closed')
		->where('issued_to',\Auth::user()->dept);
		
	}


	public function count_all_active_findings()
	{
		$findings = findings::where('status','active')
		->orwhere('status','obs');

		if($findings)
		{
			return $findings->count();
		}else
		{
			return 0;
		}

	}

	public function count_all_inprogress_findings()
	{
		$findings = findings::where('status','active');

		if($findings)
		{
			return $findings->count();
		}else
		{
			return 0;
		}

	}


	public function count_all_overdue_findings()
	{
		$findings = findings::where('status','active')
		->where('response_due', '<', carbon::now()->format('Y-m-d'));

		if($findings)
		{
			return $findings->count();
		}else
		{
			return 0;
		}

	}



##====================NOT IN USE ====================##
	#NOTIFICATION I HAS NEW RESPONSE
	public function check_if_has_new_response_within_one_day()
	{
		$responses = responses::where('type','response')
		->orderBy('updated_at','DESC')
		 ->whereHas('thefindings', function ($query) {
            $query->where('status', '<>', "closed"); 
            })
		// ->where('updated_at', '>', Carbon::now()->subDays(1)->toDateTimeString())
		->first();

		if ($responses) {
			return $responses;
		}
	}

	public function check_if_response_is_already_commented_by_qa($id)
	{
		$responses = responses::where('type','comment')
		->where('id','>',$id)
		->first();
		
		if ($responses) {
			return $responses;
		}
	}

##====================NOT IN USE ====================##

}//end