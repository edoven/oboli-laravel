<?php

//BASIC (no controllers)
Route::get('/', 		function() {return View::make('homepage');});
Route::get('signin', 	function() {return View::make('signin');}); //show signin page
Route::get('login',  	function() {return View::make('login');}); //show login page

//SIGNIN/LOGIN/LOGOUT
Route::post('login', 				'AuthController@doLogin'); //process the login request done from the login page
Route::get('login/fb', 				'AuthController@doLoginWithFacebook');
Route::get('login/fb/callback', 	'AuthController@manageFacebookCallback');
Route::post('signin', 				'AuthController@doSignin'); //process the signin request done from the signin page
Route::get('signin/confirm', 		'AuthController@confirmEmail'); //process the confirmed email (parameters:email, confirmation_code)
Route::get('logout', 				'AuthController@doLogout'); //logout the user

//USERS
Route::get('users', 			'UserController@showAll'); //show users page [TO BE HIDDEN]
Route::get('user/{id}', 	 	'UserController@showProfile'); //show user profile
Route::post('makeDonation',		'UserController@makeDonation'); //make the donation from a user to a project (parameters: user, project, amount)

//PROJECTS
Route::get('projects', 		'ProjectController@showAll'); //show projects page
Route::get('project/{id}', 	'ProjectController@showDetail'); //show project page

//CODES
Route::get('codes', 	'CodeController@showAll'); //show codes page [TO BE HIDDEN]
Route::get('code/{id}', 'CodeController@useCode'); //use a code to accredit obolis

//ERROR
Route::get('error', 	'CodeController@showAll');




//EDITER
Route::get('editer', function()
{	
#	Schema::table('projects', function($table)
#	{
#		$table->integer('oboli_count');
#	});  
	DB::table('users')->insert(array('name' => 'gigi', 'email' => 'gigi@gmail.com', 'oboli_count' => 100, 'password' => 'password'));		

});


