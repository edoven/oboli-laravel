<?php

//BASIC (no controllers)
Route::get('/', 		function() {return View::make('homepage');});
Route::get('signup', 	function() {return View::make('signup');}); //show signin page
Route::get('signup/email', 	function() {return View::make('signupemail');}); //show signin page
Route::get('login',  	function() {return View::make('login');}); //show login page

//SIGNIN/LOGIN/LOGOUT
Route::post('signin', 				'AuthController@doSignin'); //process the signin request done from the signin page
Route::get('signin/confirm', 		'AuthController@confirmEmail'); //process the confirmed email (parameters:email, confirmation_code)
Route::get('login/fb', 				'AuthController@doLoginWithFacebook');
Route::get('login/fb/callback', 	'AuthController@manageFacebookCallback');
Route::post('login', 				'AuthController@doLogin'); //process the login request done from the login page
Route::get('logout', 				'AuthController@doLogout'); //logout the user

//USERS
//Route::get('users', 			'UserController@showAll'); //show users page [TO BE HIDDEN]
Route::get('user/{id}', 	 	array('before' => 'auth', 'uses' => 'UserController@showProfile')); //show user profile
Route::post('makeDonation',		array('before' => 'auth', 'uses' => 'UserController@makeDonation')); //make the donation from a user to a project (parameters: user, project, amount)

//NGOS
Route::get('ngos', 		'NgoController@showAll'); //show projects page
Route::get('ngos/{id}', 'NgoController@showDetails'); //show project page

//CODES
Route::get('codes', 	'CodeController@showAll'); //show codes page [TO BE HIDDEN]
Route::get('code/{id}', 'CodeController@useCode'); //use a code to accredit obolis

//ERROR
//Route::get('error', 	'CodeController@showAll');



//REST (HTTPS)
Route::post('api/v0.1/signup', 		array('https',  'uses' => 'AuthRestController@doSignup'));
Route::post('api/v0.1/login', 		array('https',  'uses' => 'AuthRestController@doLogin'));
#Route::get('api/v1/login/fb', 		'AuthController@doLoginWithFacebook');
//Route::get('api/v1/users', 			array('before' => 'auth.basic', 'uses' => 'UserController@showAll'));
Route::get('api/v0.1/users/{id}',  	array('https', 'before' => 'auth.rest', 'uses' => 'UserRestController@showProfile'));
Route::get('api/v0.1/ngos', 		array('https', 'before' => 'auth.rest', 'uses' => 'NgoRestController@showAll'));
Route::get('api/v0.1/ngos/{id}', 	array('https', 'before' => 'auth.rest', 'uses' => 'NgoRestController@showDetails'));





//EDITER
#Route::get('editer', function()
#{	
#	Schema::table('projects', function($table)
#	{
#		$table->integer('oboli_count');
#	});  
#	DB::table('users')->insert(array('name' => 'gigi', 'email' => 'gigi@gmail.com', 'oboli_count' => 100, 'password' => 'password'));		
#
#});


