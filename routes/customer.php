<?php 

use  Illuminate\Http\Request;

/*** Client Routes **/

Route::get('/culogin','CustomerAuthController@showLoginForm');
Route::post('/culogin','CustomerAuthController@login');


/* Client route group */

Route::group(['middleware'=>'auth.client:client'],function(){

    Route::get('/cuhome','CustomerController@home');
});

/* End of client route group */

