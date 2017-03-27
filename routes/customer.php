<?php 

use  Illuminate\Http\Request;

/*** Client Routes **/

Route::get('/culogin','CustomerAuthController@showLoginForm');
Route::post('/culogin','CustomerAuthController@login');
Route::get('/reset/client','ForgotPasswordController@showLinkRequestForm');
Route::post('/password/client','ForgotPasswordController@sendResetLinkEmail');
Route::get('/password/reset/client/{token}','ResetPasswordController@showResetForm')->name('reset.password.client');
Route::post('/password/reset/client','ResetPasswordController@reset');


/* Client route group */

Route::group(['middleware'=>'auth.client:client'],function(){

    Route::get('/cuhome','CustomerController@home');
    Route::get('/cuquote/{request_id?}','CustomerController@showQuotes');
    Route::post('/contact_vendor','CustomerController@contactVendor');
});

/* End of client route group */

