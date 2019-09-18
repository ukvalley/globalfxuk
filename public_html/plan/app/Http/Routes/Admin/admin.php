<?php
	
	Route::get('/login',						['as'=>'login',						'uses'=>'Admin\AuthController@login']);

	Route::get('/logout',						['as'=>'logout',					'uses'=>'Admin\AuthController@logout']);

	Route::get('/change_password',				['as'=>'change_password',			'uses'=>'Admin\AdminController@change_password']);

	Route::post('/process_change_pass',			['as'=>'process_change_pass',		'uses'=>'Admin\AdminController@process_change_pass']);
	
	Route::get('/change_trans_password',		['as'=>'change_trans_password',		'uses'=>'Admin\AdminController@change_trans_password']);

	Route::post('/process_change_trans_password',['as'=>'process_change_trans_password','uses'=>'Admin\AdminController@process_change_trans_password']);
	
	Route::post('/forget_password_process',     ['as'=>'forget_password_process',   'uses'=>'Admin\AuthController@forget_password_process']);

Route::get('/forgot_tpin',				['as'=>'forgot_tpin',			'uses'=>'Admin\AuthController@forgot_tpin']);
Route::get('/mail',				['as'=>'mail',			'uses'=>'Admin\AuthController@mail']);

Route::post('/forget_transaction_pin',     ['as'=>'forget_transaction_pin',   'uses'=>'Admin\AuthController@forget_transaction_pin']);

	Route::get('/dashboard',					['as'=>'dashboard',					'uses'=>'Admin\AdminController@dashboard']);

Route::get('/force_active',					['as'=>'force_active',					'uses'=>'Admin\AdminController@force_active']);
	
	Route::get('/get_link',					    ['as'=>'get_link',					'uses'=>'Admin\AdminController@get_link']);
	
Route::get('/reclaim_payment',				['as'=>'reclaim_payment',			'uses'=>'Admin\AdminController@reclaim_payment']);


Route::get('/block_user_list',					['as'=>'block_user_list',					'uses'=>'Admin\AdminController@block_user_list']);

Route::get('/recommitment_user_list',					['as'=>'recommitment_user_list',					'uses'=>'Admin\AdminController@recommitment_user_list']);

	
	Route::get('/check_pin',					['as'=>'check_pin',					'uses'=>'Admin\AdminController@check_pin']);

	Route::get('/user_list',					['as'=>'user_list',					'uses'=>'Admin\AdminController@user_list']);

Route::get('/update_newsfeed',				['as'=>'update_newsfeed',				'uses'=>'Admin\AdminController@update_newsfeed']);

Route::get('/news_feed',		['as'=>'news_feed',		'uses'=>'Admin\AdminController@news_feed']);


Route::post('/process_change_pass',			['as'=>'process_change_pass',		'uses'=>'Admin\AdminController@process_change_pass']);

	
	Route::get('/transaction',					['as'=>'transaction',				'uses'=>'Admin\AdminController@transaction']);

Route::get('/user_mobile',					['as'=>'user_mobile',				'uses'=>'Admin\AdminController@user_mobile']);

Route::get('/process_send_msg',		['as'=>'process_send_msg',		'uses'=>'Admin\AdminController@process_send_msg']);


	
	Route::get('/user_transaction',				['as'=>'user_transaction',			'uses'=>'Admin\AdminController@user_transaction']);
	
	Route::get('/user_transaction_',				['as'=>'user_transaction_',			'uses'=>'Admin\AdminController@user_transaction_']);

Route::get('/user_transaction_daily',				['as'=>'user_transaction_daily',			'uses'=>'Admin\AdminController@user_transaction_daily']);

Route::get('/user_transaction_daily_admin',				['as'=>'user_transaction_daily_admin',			'uses'=>'Admin\AdminController@user_transaction_daily_admin']);
	
	Route::get('/recommit',			        	['as'=>'recommit',		        	'uses'=>'Admin\AdminController@recommit']);

	Route::get('/link_send',					['as'=>'link_send',					'uses'=>'Admin\AdminController@link_send']);

	Route::post('/apply_link',					['as'=>'apply_link',				'uses'=>'Admin\AdminController@apply_link']);
	
	Route::get('/generate_link',					['as'=>'generate_link',				'uses'=>'Admin\AdminController@generate_link']);
	
	Route::get('/generate_link_r',					['as'=>'generate_link_r',				'uses'=>'Admin\AdminController@generate_link_r']);
	
    Route::get('/self_team',					['as'=>'self_team',				    'uses'=>'Admin\AdminController@level_view']);
    
    Route::get('/level_tree',					['as'=>'level_tree',				'uses'=>'Admin\AdminController@level_tree']);

	Route::get('/withdrawal_payment',			['as'=>'withdrawal_payment',		'uses'=>'Admin\AdminController@withdrawal_payment']);

	Route::get('/status_change',				['as'=>'status_change',				'uses'=>'Admin\AdminController@status_change']);

	Route::get('/accept_payment',				['as'=>'accept_payment',			'uses'=>'Admin\AdminController@accept_payment']);

	Route::get('/accept_package',				['as'=>'accept_package',			'uses'=>'Admin\AdminController@accept_package']);

	Route::post('/submit_support_enquiry',		['as'=>'submit_support_enquiry',	'uses'=>'Admin\AdminController@submit_support_enquiry']);

	Route::get('/edit',							['as'=>'edit',						'uses'=>'Admin\AdminController@edit']);
	
	Route::post('/update_user',					['as'=>'update_user',				'uses'=>'Admin\AdminController@update_user']);
	
    Route::get('/profile_edit',					['as'=>'profile_edit',						'uses'=>'Admin\AdminController@profile_edit']);
	
	Route::post('/update_user_profile',			['as'=>'update_user_profile',				'uses'=>'Admin\AdminController@update_user_profile']);
	
	 Route::get('/bank_edit',					['as'=>'bank_edit',						'uses'=>'Admin\AdminController@bank_edit']);
	
	Route::post('/update_user_bank',			['as'=>'update_user_bank',				'uses'=>'Admin\AdminController@update_user_bank']);
	
	

	Route::get('/view',							['as'=>'view',						'uses'=>'Admin\AdminController@view']);
	
	
		Route::get('/viewbyreciever',							['as'=>'viewbyreciever',						'uses'=>'Admin\AdminController@viewbyreciever']);
	
	
		Route::get('/user_level_income',							['as'=>'user_level_income',						'uses'=>'Admin\AdminController@user_level_income']);
	
	Route::get('/referal_bonus_income',							['as'=>'referal_bonus_income',						'uses'=>'Admin\AdminController@referal_bonus_income']);
	
	
	
	
	
Route::get('/view1',							['as'=>'view1',						'uses'=>'Admin\AdminController@view1']);

	Route::get('/user_view',					['as'=>'user_view',					'uses'=>'Admin\AdminController@user_view']);
	
	Route::get('/work_income',					['as'=>'work_income',				'uses'=>'Admin\AdminController@work_income']);

	Route::get('/add_fund_request',					['as'=>'add_fund_request',				'uses'=>'Admin\AdminController@add_fund_request']);

	Route::get('/add_fund',					['as'=>'add_fund',				'uses'=>'Admin\AdminController@add_fund']);

	Route::post('/add_money',					['as'=>'add_money',				'uses'=>'Admin\AdminController@add_money']);



	Route::get('/level_income',					['as'=>'level_income',				'uses'=>'Admin\AdminController@level_income']);

	Route::get('/payment_sent',					['as'=>'payment_sent',				'uses'=>'Admin\AdminController@payment_sent']);
	

	Route::get('/support',						['as'=>'support',					'uses'=>'Admin\AdminController@support']);

	
	Route::get('/u_work_income',				['as'=>'work_income',				'uses'=>'Admin\CustomerController@work_income']);

		Route::get('/u_level_income',				['as'=>'u_level_income',				'uses'=>'Admin\CustomerController@u_level_income']);
	

	Route::get('/u_daily_income',				['as'=>'daily_income',				'uses'=>'Admin\CustomerController@daily_income']);

	Route::get('/u_support',					['as'=>'support',					'uses'=>'Admin\CustomerController@support']);
	
		Route::get('/withdrawl',					['as'=>'withdrawl',					'uses'=>'Admin\AdminController@withdrawl']);


	Route::get('/create_daily_link',					['as'=>'create_daily_link',					'uses'=>'Admin\AdminController@create_daily_link']);

    
    Route::post('/change_btc',					['as'=>'change_btc',					'uses'=>'Admin\AdminController@change_btc']);

     Route::get('/btc_change',					['as'=>'btc_change',					'uses'=>'Admin\AdminController@btc_change']);


	Route::get('/epin_generate',							['as'=>'epin_generate',						'uses'=>'Admin\AdminController@epin_generate']);

	Route::get('/transfer_epin',							['as'=>'transfer_epin',						'uses'=>'Admin\AdminController@transfer_epin']);

	Route::get('/unused_pin',							['as'=>'unused_pin',						'uses'=>'Admin\AdminController@unused_pin']);

	Route::post('/generate_epin',		['as'=>'generate_epin',	'uses'=>'Admin\AdminController@generate_epin']);
	
	Route::post('/generate_epin_for_user',		['as'=>'generate_epin_for_user',	'uses'=>'Admin\AdminController@generate_epin_for_user']);

	Route::get('/activate_user_with_epin',		['as'=>'activate_user_with_epin',	'uses'=>'Admin\AdminController@activate_user_with_epin']);

	Route::post('/epin_transfer',		['as'=>'epin_transfer',	'uses'=>'Admin\AdminController@epin_transfer']);

	Route::get('/epin_transaction',							['as'=>'epin_transaction',						'uses'=>'Admin\AdminController@epin_transaction']);

	Route::get('/withdrawl_request',			['as'=>'withdrawl_request',		'uses'=>'Admin\AdminController@withdrawl_request']);

	Route::get('/payment_sent',			['as'=>'payment_sent',		'uses'=>'Admin\AdminController@payment_sent']);

	Route::get('/withdrawl_history',			['as'=>'withdrawl_history',		'uses'=>'Admin\AdminController@withdrawl_history']);

	//Route::get('/epin_generate_user',			['as'=>'epin_generate_user',		'uses'=>'Admin\CustomerController@epin_generate_user']);

	Route::post('/add_return',		['as'=>'add_return',	'uses'=>'Admin\AdminController@add_return']);
	
	Route::get('/create_return',			['as'=>'create_return',		'uses'=>'Admin\AdminController@create_return']);

	Route::get('/all_return',			['as'=>'all_return',		'uses'=>'Admin\AdminController@all_return']);