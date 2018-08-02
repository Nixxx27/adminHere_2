<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\locations;
use App\tracking_series;
use App\trolley_history;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = locations::orderBy('location','ASC')->get();
        return view('pages.location.lists',compact('locations'));
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
                'location'       => 'required',
            ],
                $messages = array('location.required' => 'Location name is required!',
                 
                )
            );

        $locations = locations::create($request->all());

             return back()->with([
            'flash_message' => strtoupper($locations->location) . " Successfully Added!"
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = locations::findorfail($id);
        return view('pages.location.edit',compact('location'));
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
                'location'       => 'required',
            ],
                $messages = array('location.required' => 'Location name is required!',
                 
                )
            );

        $location = locations::findorfail($id)->update($request->all());

             return back()->with([
            'flash_message' => "Location Successfully Updated!"
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
        $location = locations::findorfail($id);

        ##CHECK IF USER/TRACKING SERIES/TROLLY HISTORY HAS THIS LOCATION.
        $user_has_this_location =  User::where('location_id', $location->id)->get();
        $series_has_this_location =  tracking_series::where('location_id', $location->id)->get();
        $trolley_history_has_this_location =  trolley_history::where('user_current_location_id', $location->id)->orwhere('user_defined_location_id', $location->id)->get();

        $count =  $user_has_this_location->count() + $series_has_this_location->count() + $trolley_history_has_this_location->count();

        if($count > 0)
        {
            return \Redirect::back()->withErrors(['Please Delete User Location / Tracking Number Series / Trolley with this Location First!']);
        }else
        {
             $location ->delete();

            return back()->with([
                'flash_message' =>  "Location Successfully Deleted!"
            ]);
        }

       
    }



}
