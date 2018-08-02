<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = notes::orderBy('id','DESC')->get();
        return view('home',compact('notes'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'notes'       => 'required|min:1',
            ],
                $messages = array('notes.required' => 'Please type a Note!')
            );

                    
        $request['entered_by'] = \Auth::user()->id;
            $notes = notes::create($request->all());

             return back()->with([
            'flash_message' => "New Note Successfully Created!"
        ]);
    }

     public function destroy($id)
    {
        $notes = notes::findorfail($id);
        $notes ->delete();

        return back()->with([
            'flash_message' => "Note Deleted Successfully!"
        ]);
    }
}
