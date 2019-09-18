<?php

	/*Route::get('/',							['as'=>'admin_auth_login',		'uses'=>'Admin\AuthController@login']);*/
	
	Route::get('/login',						['as'=>'login',						'uses'=>'Customer\AuthController@login']);

	Route::get('/logout',						['as'=>'logout',					'uses'=>'Customer\AuthController@logout']);

	Route::get('/dashboard',					['as'=>'dashboard',					'uses'=>'Customer\AuthController@dashboard']);

	Route::get('/new_joining',					['as'=>'new_joining',				'uses'=>'Customer\AccountController@index']);

	Route::post('/joining_process',				['as'=>'joining_process',			'uses'=>'Customer\AccountController@joining_process']);

	Route::get('/my_direct',					['as'=>'my_direct',					'uses'=>'Customer\DownlineController@my_direct']);

	Route::get('/self_team',					['as'=>'self_team',					'uses'=>'Customer\DownlineController@self_team']);

	Route::get('/level_view',					['as'=>'level_view',				'uses'=>'Customer\DownlineController@level_view']);

	Route::get('/direct_income',				['as'=>'direct_income',				'uses'=>'Customer\PayoutController@direct_income']);

	Route::get('/growth_income',				['as'=>'growth_income',				'uses'=>'Customer\PayoutController@growth_income']);

	Route::get('/level_income',					['as'=>'level_income',				'uses'=>'Customer\PayoutController@level_income']);

	Route::get('/work_withdrawal',				['as'=>'work_withdrawal',			'uses'=>'Customer\PayoutController@work_withdrawal']);

	Route::get('/growth_withdrawal',			['as'=>'growth_withdrawal',			'uses'=>'Customer\PayoutController@growth_withdrawal']);

	Route::get('/my_provided_donation',			['as'=>'my_provided_donation',		'uses'=>'Customer\PayoutController@my_provided_donation']);

	Route::get('/my_receive_donation',			['as'=>'my_receive_donation',		'uses'=>'Customer\PayoutController@my_receive_donation']);
	
	Route::get('/my_withdrawal',				['as'=>'my_withdrawal',				'uses'=>'Customer\PayoutController@my_withdrawal']);

	Route::get('/bank_details',					['as'=>'bank_details',				'uses'=>'Customer\SettingController@bank_details']);

	Route::post('/store_bank_details',			['as'=>'store_bank_details',		'uses'=>'Customer\SettingController@store_bank_details']);

	Route::get('/change_password',				['as'=>'change_password',			'uses'=>'Customer\SettingController@change_password']);
	
	Route::post('/process_change_pass',			['as'=>'process_change_pass',		'uses'=>'Customer\SettingController@process_change_pass']);

	Route::get('/bank_details_otp',				['as'=>'bank_details_otp',			'uses'=>'Customer\SettingController@bank_details_otp']);

	Route::post('/activate_bank_details',		['as'=>'activate_bank_details',		'uses'=>'Customer\SettingController@activate_bank_details']);

	Route::get('/resend_otp',					['as'=>'resend_otp',				'uses'=>'Customer\SettingController@resend_otp']);

	Route::post('/work_withdrawal_process',		['as'=>'work_withdrawal_process',	'uses'=>'Customer\PayoutController@work_withdrawal_process']);

	Route::post('/growth_withdrawal_process',	['as'=>'growth_withdrawal_process',	'uses'=>'Customer\PayoutController@growth_withdrawal_process']);

	Route::post('/get_notification_count',		['as'=>'get_notification_count',	'uses'=>'Customer\NotificationsController@get_notification_count']);

	Route::post('/get_sponcer_name',			['as'=>'get_sponcer_name',			'uses'=>'Customer\AccountController@get_sponcer_name']);

	Route::post('/user_exist',					['as'=>'user_exist',				'uses'=>'Customer\AccountController@user_exist']);

	Route::get('/notification',					['as'=>'notification',				'uses'=>'Customer\NotificationsController@index']);

	Route::get('/upload_recipient',				['as'=>'upload_recipient',			'uses'=>'Customer\ActivationController@index']);

	Route::post('/depisite_approval_process',	['as'=>'depisite_approval_process',	'uses'=>'Customer\ActivationController@depisite_approval_process']);

	Route::get('/approve_payment',				['as'=>'approve_payment',			'uses'=>'Customer\ActivationController@approve_payment']);

	Route::post('/approval_process',			['as'=>'approval_process',			'uses'=>'Customer\ActivationController@approval_process']);

	Route::get('/accept_request/{id}',			['as'=>'accept_request',			'uses'=>'Customer\ActivationController@accept_request']);

	Route::get('/accept_request_package/{id}',	['as'=>'accept_request_package',	'uses'=>'Customer\ActivationController@accept_request_package']);

	Route::get('/approve_payment_withdraw',		['as'=>'approve_payment_withdraw',	'uses'=>'Customer\ActivationController@approve_payment_withdraw']);
	
	Route::get('/accept_request_withdraw/{id}',	['as'=>'accept_request_withdraw',	'uses'=>'Customer\ActivationController@accept_request_withdraw']);
	

	Route::get('/re_entry',						['as'=>'re_entry',					'uses'=>'Customer\PayoutController@re_entry']);

	Route::get('/change_user_status/{id}',		['as'=>'change_user_status',		'uses'=>'Customer\DownlineController@change_user_status']);

	Route::get('/re_enter',						['as'=>'re_enter',					'uses'=>'Customer\ActivationController@re_enter']);

	Route::post('/reenter_approval_process',	['as'=>'reenter_approval_process',	'uses'=>'Customer\ActivationController@reenter_approval_process']);
