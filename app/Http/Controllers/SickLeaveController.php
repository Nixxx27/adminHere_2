<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;

class SickLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "hi";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pages.sl.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function home_employee_search()
    {
        // return $_GET['empidnum'];
        $employees = employee::where('empidnum',$_GET['empidnum'])->first();

        if($employees)
        {
             return json_encode(
            array(
                "name"  => ucwords($employees->name), 
                "company"  => ucwords($employees->company), 
                "department"  => ucwords($employees->department), 
                "division"  => ucwords($employees->division), 
                "shift"  => ucwords($employees->shift), 
                "dayoff"  => ucwords($employees->dayoff), 
                ));
         }else
         {
             return json_encode(
            array(
                "name"  => "", 
                "company"  => "", 
                "department"  => "", 
                "division"  => "", 
                "shift"  =>"", 
                "dayoff"  => "", 
                ));
         }
       
        
    }


    public function home_employee_search_by_name()
    {
        $employees = employee::where('name','like', '%' .$_GET['name'] .'%')->first();

        if($employees)
        {
             return json_encode(
            array(
                "name"  => ucwords($employees->name), 
                "company"  => ucwords($employees->company), 
                "department"  => ucwords($employees->department), 
                "division"  => ucwords($employees->division), 
                "shift"  => ucwords($employees->shift), 
                "dayoff"  => ucwords($employees->dayoff), 
                ));
         }else
         {
             return json_encode(
            array(
                "name"  => "", 
                "company"  => "", 
                "department"  => "", 
                "division"  => "", 
                "shift"  =>"", 
                "dayoff"  => "", 
                ));
         }
       
        
    }
}
