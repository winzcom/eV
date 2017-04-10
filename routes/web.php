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

use  Illuminate\Http\Request;


Route::match(['post','get'],'/search','SearchController@search');

Route::get('/type_search','SearchController@search_by_typing');





/*** General Routes **/

Route::get('/detail/{company}/{id?}','DetailsController@details');

Route::post('/quotes_request','GuestController@quotesRequest')->name('requests');

Route::get('/check_vendor_availabity','GuestController@checkVendorAvailability');

Route::post('/write_review','GuestController@writeReview');

Route::get('/browse_vendors/{category?}','SearchController@browseByCategory');

/*Route::get('/category/{category}',function($category){

    return view('app_view.category')->with('companies',\App\User::whereHas('categories',function($query) use ($category){
        $query->where('name',$category);
    })->get());
});*/

Route::get('/register/verify/{confirm_token}','Auth\RegisterController@verifyToken');

Route::get('/', 'GuestController@index');

Route::get('/set_firebase_token','GuestController@setFirebaseNotificationEndPoint');

Route::get('/logout','GuestController@logout');

Auth::routes();

