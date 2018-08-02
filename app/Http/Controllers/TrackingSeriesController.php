<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\locations;
use App\tracking_series;
use App\trolley_ml;

class TrackingSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $locations = locations::get();
        $series = tracking_series::orderBy('series_from','ASC')->get();
        return view('pages.tracking_series.lists',compact('series','locations'));
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
                'location_id'       => 'required',
                'location_description'       => 'required',
                'series_from'       => 'required',
                'series_to'       => 'required',
            ],
                $messages = array('location_id.required' => 'Please Select Location!',
                    'location_description.required' => 'Description is Required!',
                    'series_from.required' => 'Series From is Required!',
                    'series_to.required' => 'Series To is Required!',
                 
                )
            );

        $series = tracking_series::create($request->all());

             return back()->with([
            'flash_message' => "New Tracking Number Series Successfully Added!"
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
        $locations = locations::get();
        $series = tracking_series::findorfail($id);
        return view('pages.tracking_series.edit',compact('series','locations'));
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
                'location_id'       => 'required',
                'location_description'       => 'required',
                'series_from'       => 'required',
                'series_to'       => 'required',
            ],
                $messages = array('location_id.required' => 'Please Select Location!',
                    'location_description.required' => 'Description is Required!',
                    'series_from.required' => 'Series From is Required!',
                    'series_to.required' => 'Series To is Required!',
                 
                )
            );

        
        $series = tracking_series::findorfail($id)->update($request->all());

        return back()->with([
            'flash_message' => "Tracking Number Updated Successfully!"
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
        $series = tracking_series::findorfail($id);
        
        $ml_has_this_tracking_series =  trolley_ml::where('tracking_series_id', $series->id)->get();
 
        if($ml_has_this_tracking_series->count() > 0)
        {
            return \Redirect::back()->withErrors(['Please Delete Trolley with this Tracking Series First!']);
        }else
        {
            $series ->delete();

            return back()->with([
                'flash_message' => "Tracking Number Series Deleted Successfully!"
            ]); 
        }

    }
}
