<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employees = employee::get();
        return view('pages.employee.home',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.employee.new');
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
                'empidnum'       => 'required|min:1',
                'name'       => 'required|min:1',
                'company'       => 'required|min:1',
                
            ],
                $messages = array('empidnum.required' => 'Employee ID is required!',
                    'name.required' => 'Employee Name is required!',
                    'company.required' => 'Please Choose if SkyLogistics or SkyKitchen',
                )
            );

        $employees = employee::create($request->all());

             return back()->with([
            'flash_message' => "Employee Successfully Added!"
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
        
        $employees = employee::findorfail($id);
        $employees ->delete();

        return back()->with([
            'flash_message' => $employees->name . " was Successfully Deleted!"
        ]);
    }


   
}
