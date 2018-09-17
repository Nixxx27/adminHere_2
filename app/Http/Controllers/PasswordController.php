<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findorfail(\Auth::user()->id);
        return view('pages.users.change_password',compact('user'));
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
        $this->validate($request,
            [
                'current-password'       => 'required|min:6',
                'password'       => 'required|same:password|min:6',
                'password_confirmation' => 'required|same:password',
            ],
                $messages = array('current-password.required' => 'Please enter current password',
                    'password.required' => 'Please enter password')
            );

        if( $id == \Auth::User()->id )
        {
            $current_password = \Auth::User()->password;

            if(\Hash::check($request['current-password'], $current_password))
              {         


                $user = User::findorfail( $id);
                $request['password'] = \Hash::make($request['password']);

              
                $user->update( $request->all() );
                
                return back()->with([
                'flash_message' => "Password Updated Successfully!"
                ]);

              }else
              {
                return \Redirect::back()->withErrors('You Have entered a wrong Current Password!'); 
              }

          
        }else
        {
             return \Redirect::back()->withErrors('Not Allowed!');
        }
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
}
