<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\trolley_ml;
use App\tracking_series;
use App\locations;
use App\trolley_history;
use App\User;
use Carbon\Carbon;

class TrolleysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $series = tracking_series::get();
        // $trolleys = trolley_ml::get();

        $this->search = ltrim(rtrim($request->input('search', '%')));


        $trolleys = trolley_ml::orderby('tracking_number','ASC')
        ->where('tracking_number','like', '%' .$this->search .'%')
        ->paginate(15);
        $trolleys->setPath('trolleys');

        $search = ($this->search=='%')?'': $this->search;
        
        return view('pages.trolleys.lists',compact('trolleys','series','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $this->validate($request,
            [
                'tracking_number'       => 'required',
                'tracking_series_id'       => 'required_without:user_defined_location_id',
                'user_defined_location_id'       => 'required_without:tracking_series_id',
            ],
                $messages = array('tracking_number.required' => 'Tracking Number is Required!',
                    'tracking_series_id.required_without' => 'Please Specify a Location',
                    'user_defined_location_id.required_without' => 'Tracking Number cannot be found in Series List. Please add a Series or Specify a Location!',
                )
            );

        $trolleys = trolley_ml::create($request->all());

             return back()->with([
            'flash_message' => "New Trolley Successfully Added!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $series = tracking_series::get();
        $trolley = trolley_ml::findorfail($id);
        return view('pages.trolleys.edit',compact('series','trolley'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'tracking_number'       => 'required',
                'location'       => 'required',
            ],
                $messages = array('tracking_number.required' => 'Tracking Number is Required!',
                    'location.required' => 'Please Select a Location',
                 )
            );
       
        $request['tracking_series_id'] =  $request['location'];
        $request['user_defined_location_id'] =  $request['location'];

        $trolley = trolley_ml::findorfail($id);
        $trolley ->update([
            'tracking_number' =>  $request['tracking_number'],
            'tracking_series_id' =>  $request['location'],
            'user_defined_location_id' =>  $request['location'],
            'remarks' =>  $request['remarks'],
        ]);

        return back()->with([
            'flash_message' => "Trolley # " . $trolley->tracking_number . " Updated Successfully!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trolley = trolley_ml::findorfail($id);

        
        $history_has_this_trolley =  trolley_history::where('trolley_ml_id', $trolley->id)->get();
 
        if($history_has_this_trolley->count() > 0)
        {
            return \Redirect::back()->withErrors(['Please Delete History with this Trolley First!']);
        }else
        {
            $trolley ->delete();

            return back()->with([
            'flash_message' => "Trolley # " . $trolley->tracking_number . " Deleted Successfully!"
            ]);
        }
    }


   
    /**
     * AJAX Call
     *
     */
    public function returnTrackingSeries(Request $request)
    {
        $trackingNumber =  $request['trackingNumber'];

        return   $tracking_series = tracking_series::where("series_from", "<=",$trackingNumber)
         ->where("series_to", ">=",$trackingNumber)
        ->first();

    }

    /*
    |--------------------------------------------------------------------------
    | BARCODE FUNCTIONS
    |--------------------------------------------------------------------------
    |
    |
    */

    public function barcode()
    {
        $user = Auth::user();

        $locations = locations::get();
        return view('pages.barcode.barcode',compact('user','locations'));
    }

    public function updateUserLocation(Request $request)
    {
        $user = Auth::user();
        $user->update(['location_id'=>$request['location_id']]);

         return back()->with([
            'flash_message' => "Location Updated Succesfully!"
            ]);
    }

     /**
     * AJAX Call
     *
     */
    public function returnTrolleyDetails(Request $request)
    {

        $trackingNumber =  $request['trackingNumber'];

        $trolley = trolley_ml::where("tracking_number", $trackingNumber)
        ->first();


       if($trolley)
        {
            $trolleyId = $trolley->id;
            $trolleyCount = 1;
            // $trolleyNum = $trolley->tracking_number;

            if($trolley->user_defined_location_id)
            {
                $trolleyLocation =  strtoupper($trolley->theUserDefinedLocation->location_description);
                $trolleyArea = strtoupper($trolley->theUserDefinedLocation->theLocation->location);

            }else
            {
                $trolleyLocation = strtoupper($trolley->theTrackingSeries->location_description);
                $trolleyArea = strtoupper($trolley->theTrackingSeries->theLocation->location);
            }
        }else
        {
            $trolleyId = "";
            $trolleyCount = 0;
            // $trolleyNum = "";
            $trolleyArea = "";
            $trolleyLocation = "";
        }

        #RETRIVE USER LOCATION
        $user = Auth::user();
        if( $user->theLocation )
        {
            $userLocation =  $user->theLocation->location;
            $userLocationId = $user->location_id;
        }else
        {
            $userLocation = "";
            $userLocationId = "";
        }

        return json_encode(
            array(
                "trolleyId"         => $trolleyId,
                // "trolleyNum"        => $trolleyNum,
                "userLocationId"    => $userLocationId,
                "trolleyCount"      => $trolleyCount,
                "trolleyArea"       => $trolleyArea,
                "trolleyLocation"   => $trolleyLocation, 
                 "userLocation"     => $userLocation, 
                ));
  

    }

     /*
    |--------------------------------------------------------------------------
    | HISTORY FUNCTIONS
    |--------------------------------------------------------------------------
    |
    |
    */

    public function addTrolleyHistory(Request $request)
    {
         $this->validate($request,
            [
                'trolley_ml_id'       => 'required',
                'user_current_location_id'       => 'required',
                'status'       => 'required',
            ],
                $messages = array('trolley_ml_id.required' => 'Trolley Tracking Number is Required!',
                    'user_current_location_id.required' => 'Location is Required',
                    'status.required' => 'Status is Required',
                 )
            );


        $history = trolley_history::create($request->all());

         return back()->with([
            'flash_message' => "Saved Succesfully!"
            ]);
    }

    public function viewHistoryPerTrolley($trolley_id)
    {
        $trolley = trolley_ml::findorfail($trolley_id);
        $histories = trolley_history::where('trolley_ml_id', $trolley_id)->orderBy('id','DESC')->get();
        return view('pages.trolley_history.lists',compact('trolley','histories'));
    }

    public function returnedTrolley(Request $request, $history_id)
    {

        $history = trolley_history::findorfail($history_id);
       $history ->update([
            'is_returned' =>  1,
            'returned_remarks' =>  $request['returned_remarks'],
            'returned_date' =>  carbon::now(),
            'returned_by' =>  Auth::user()->id,
  
        ]);

        return back()->with([
            'flash_message' => "Trolley # " . $history->theTrolley->tracking_number . " Returned Succesfully!"
            ]);
    }



}
