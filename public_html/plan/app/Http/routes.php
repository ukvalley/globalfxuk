<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware'=>['api']],function()
{
	/* -------------------------------------------------------------------------------------
	 Admin Routes Group :: Main group all route of admin will in this Group 
	---------------------------------------------------------------------------------------*/


	/*-------------------------------------------
		Admin Route starts Here
	--------------------------------------------*/
	Route::get('/mail',				['as'=>'mail',			'uses'=>'Admin\AuthController@mail']);
	
	Route::get('/admin',							['as'=>'admin_auth_login',		'uses'=>'Admin\AuthController@login']);

	Route::get('/admin/registration',				['as'=>'registration',			'uses'=>'Admin\AuthController@registration']);

	Route::post('/admin/register_process',			['as'=>'register_process',		'uses'=>'Admin\AuthController@register_process']);

	Route::post('/admin/login_process',				['as'=>'login_process',			'uses'=>'Admin\AuthController@login_process']);

	Route::get('/admin/forget_password',			['as'=>'forget_password',		'uses'=>'Admin\AuthController@forget_password']);

	Route::get('/check_sponcer1',					    ['as'=>'check_sponcer',					'uses'=>'Admin\AdminController@check_sponcer']);
	
	Route::post('/forget_password_process',	['as'=>'forget_password_process','uses'=>'Admin\AuthController@forget_password_process']);
	
	Route::post('/forget_password_process1',	['as'=>'forget_password_process1','uses'=>'Admin\AuthController@forget_password_process1']);

	Route::post('/admin/get_state',					['as'=>'get_state',				'uses'=>'Admin\AccountController@get_state']);

	Route::post('/admin/get_city',					['as'=>'get_city',				'uses'=>'Admin\AccountController@get_city']);

	Route::post('/get_sponcer_name',				['as'=>'get_sponcer_name',		'uses'=>'Customer\AccountController@get_sponcer_name']);

	Route::post('/user_exist',						['as'=>'user_exist',			'uses'=>'Customer\AccountController@user_exist']);


	Route::group(['prefix' => 'admin','middleware' =>'admin'], function () 
	{
		include(app_path('Http/Routes/Admin/admin.php'));
	});

	/*-------------------------------------------
		Customer Route starts Here
	--------------------------------------------*/
	/*Route::get('/customer',							['as'=>'admin_auth_login',		'uses'=>'Customer\AuthController@login']);

	Route::post('/customer/login_process',			['as'=>'login_process',			'uses'=>'Customer\AuthController@login_process']);

	Route::get('/customer/registration',			['as'=>'registration',			'uses'=>'Customer\AuthController@registration']);

	Route::post('/customer/registration_process',	['as'=>'registration_process',	'uses'=>'Customer\AuthController@registration_process']);

	Route::get('/customer/forget_password',			['as'=>'forget_password',		'uses'=>'Customer\AuthController@forget_password']);

	Route::post('/customer/forget_password_process',['as'=>'forget_password_process','uses'=>'Customer\AuthController@forget_password_process']);

	Route::get('/customer/forget_password',			['as'=>'forget_password',		'uses'=>'Customer\AuthController@forget_password']);

	
	Route::group(['prefix' => 'customer','middleware' =>'customer'], function () 
	{
		include(app_path('Http/Routes/Customer/customer.php'));
	});
*/

	/*-------------------------------------------
		Front Route starts Here
	--------------------------------------------*/
	Route::get('/', function () 
	{
		dd('welcome to Lifetime help');
	    //return view('');
	});
	
		
	Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});


});

	

//Route::auth();

//Route::get('/home', 'HomeController@index');
