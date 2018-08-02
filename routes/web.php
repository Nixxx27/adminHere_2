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

    /*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	*/

		Route::resource('home', 'HomeController');

    /*
	|--------------------------------------------------------------------------
	| Location Controller
	|--------------------------------------------------------------------------
	*/
	Route::resource('locations', 'LocationController'); 

	/*
	|--------------------------------------------------------------------------
	| Tracking Series Controller
	|--------------------------------------------------------------------------
	*/
	Route::resource('trackingseries', 'TrackingSeriesController'); 
	/*
	|--------------------------------------------------------------------------
	| Trolleys Controller
	|--------------------------------------------------------------------------
	*/
	Route::GET('/trolleys/trackingseries','TrolleysController@returnTrackingSeries');//Ajax Call
	Route::resource('trolleys', 'TrolleysController'); 
	/*
	|--------------------------------------------------------------------------
	| Barcode Controller Extends Trolleys Controller
	|--------------------------------------------------------------------------
	*/
	Route::GET('/barcode/trolleydetails','TrolleysController@returnTrolleyDetails'); //Ajax Call
	Route::GET('barcode', 'TrolleysController@barcode'); 
	Route::POST('updateuserlocation', 'TrolleysController@updateUserLocation');
	Route::POST('addtrolleyhistory', 'TrolleysController@addTrolleyHistory');
	/*
	|--------------------------------------------------------------------------
	| History Extends Trolleys Controller
	|--------------------------------------------------------------------------
	*/
	
	Route::POST('/trolleys/history/returntrolley/{history_id}','TrolleysController@returnedTrolley');
	Route::GET('/trolleys/history/{trolley_id}','TrolleysController@viewHistoryPerTrolley');

		    
// Route::get('/home', 'HomeController@index')->name('home');

});#END OF MIDDLEWARE AUTH