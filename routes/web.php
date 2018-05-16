<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');




Route::group(['middleware' => ['auth']],
    function () {

Route::resource('employees', 'EmployeeController'); 
    	
Route::resource('patients', 'PatientController'); 


Route::GET('sl/home_employee_search','SickLeaveController@home_employee_search');
Route::GET('sl/home_employee_search_by_name','SickLeaveController@home_employee_search_by_name');

Route::resource('sl', 'SickLeaveController'); 
		    
Route::get('/home', 'HomeController@index')->name('home');

});#END OF MIDDLEWARE AUTH