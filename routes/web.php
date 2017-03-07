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

Route::group(['middleware'=>'auth'],function(){

    Route::get('/home','UserController@home');

    Route::get('/profile/edit/','UserController@showProfileForm');

    Route::post('/profile/edit','UserController@updateProfile');

    Route::get('/gallery','UserController@showGallery');

    Route::post('/delete_gallery','UserController@deletePhotos');

    Route::post('/gallery_upload','UserController@uploadPhotos');

    Route::get('/reviews/{filter?}','UserController@getReviews');

    Route::get('/gallery/publish','UserController@publish');

    Route::post('/add/offdays','UserController@addOffDays');

    Route::post('/reply_request','UserController@replyRequest')->name('reply_request');

    Route::get('/dismiss_request/{rid}/{uid}/{client_id}','UserController@dismissRequest')->name('dismiss_request');

    Route::get('/remove/offdays','UserController@removeOffDays');

    Route::post('/reply_review','UserController@reply');

    Route::get('/quotes','UserController@showQuotes');
});// end of middleware=>auth grouping



Route::get('/detail/{company}/{id?}','DetailsController@details');

Route::post('/quotes_request','GuestController@quotesRequest')->name('requests');


Route::post('/write_review','GuestController@writeReview');

Route::get('/browse_vendors/{category?}','SearchController@browseByCategory');

Route::get('/category/{category}',function($category){

    return view('app_view.category')->with('companies',\App\User::whereHas('categories',function($query) use ($category){
        $query->where('name',$category);
    })->get());
});

Route::get('/register/verify/{confirm_token}','Auth\RegisterController@verifyToken');

Route::get('/', 'GuestController@index');


Auth::routes();

