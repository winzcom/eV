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
//ini_set('max_execution_time', 180);
use  Illuminate\Http\Request;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;


Route::match(['post','get'],'/search','SearchController@search');
Route::get('review-name/{nameslug}','DetailsController@reviews');

Route::get('/type_search','SearchController@search_by_typing');

Route::get('/load_request','GuestController@testLoad');

Route::get('set_name_slug','GuestController@setNameSlug');

Route::get('/aws_sns_message','GuestController@amazonSnS');

Route::get('/send_follow_up_thanks', 'GuestController@sendFollowUpThanksMail');


/*** General Routes **/

Route::get('/detail/{company}/{id?}','DetailsController@details');

Route::get('/stuwp','GuestController@sendMailToUsersWithoutPasswords');

Route::post('/quotes_request','GuestController@quotesRequest')->name('requests')->middleware('check.image.moderation');

Route::get('/check_vendor_availabity','GuestController@checkVendorAvailability');

Route::post('/write_review','GuestController@writeReview');

Route::get('/browse_vendors/{category?}/{state?}','SearchController@browseByCategory');

Route::get('/password/show', 'GuestController@showPasswordCreate');

Route::post('/password/create', 'GuestController@createPassword');

Route::get('/send_verification_mail', 'GuestController@sendEmailTypeVerificationMail');

Route::get('/verify/vendor/email/{email?}', 'GuestController@verifyVendorByEmail');

Route::get('/about_us',function() {
    return view('about');
});

/*Route::get('/category/{category}',function($category){

    return view('app_view.category')->with('companies',\App\User::whereHas('categories',function($query) use ($category){
        $query->where('name',$category);
    })->get());
});*/

Route::get('/register/verify/{confirm_token}','Auth\RegisterController@verifyToken');

Route::get('/', 'GuestController@index')->middleware('web');


Route::get('/set_firebase_token','GuestController@setFirebaseNotificationEndPoint');

Route::get('/logout','GuestController@logout');


Auth::routes();

