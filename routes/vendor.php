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

Route::group(['middleware'=>'auth'],function(){

    Route::get('/home','UserController@home');

    Route::get('/profile','UserController@showProfileForm');

    Route::post('/profile/edit','UserController@updateProfile');

    Route::get('/gallery','UserController@showGallery');

    Route::post('/delete_gallery','UserController@deletePhotos');

    Route::post('/gallery_upload','UserController@uploadPhotos');

    Route::get('/reviews/{filter?}','UserController@getReviews')->name('review');

    Route::get('/gallery/publish','UserController@publish');

    Route::post('/add/offdays','UserController@addOffDays');

    Route::get('/requests','UserController@showRequests');

    Route::post('/reply_request','UserController@replyRequest')->name('reply_request');

    Route::get('/dismiss_request/{rid}/{uid}/{client_id}','UserController@dismissRequest')->name('dismiss_request');

    Route::get('/remove/offdays','UserController@removeOffDays');

    Route::post('/reply_review','UserController@reply');

    Route::get('/quotes','UserController@showQuotes');

    Route::post('/company_profile','UserController@uploadCompanyProfile');
});// end of middleware=>auth grouping

?>