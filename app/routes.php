<?php

/*
 * 
 * BASIC
 * 
 */
Route::get('/', function()
{
	return View::make('hello');
});

Route::get('login', array('uses' => 'HomeController@showLogin')); // route to show the login form
Route::post('login', array('uses' => 'HomeController@doLogin')); // route to process the form
Route::get('logout', array('uses' => 'HomeController@doLogout'));
Route::get('signin', array('uses' => 'HomeController@showSignin')); // route to show the signin form
Route::post('signin', array('uses' => 'HomeController@doSignin')); // route to process the form

/*
 * 
 *   USERS
 * 
 */
Route::get('users', 		'UserController@showAll');
Route::get('user/{id}', 	'UserController@showProfile');
Route::post('makeDonation',  'UserController@makeDonation');

/*
 * 
 *   PROJECTS
 * 
 */
Route::get('projects', 'ProjectController@showAll');
Route::get('project/{id}', 'ProjectController@showDetail');

/*
 * 
 *   CODES
 * 
 */
Route::get('code/{id}', 'CodeController@useCode');


/*
 * 
 *   EDITER
 * 
 */
Route::get('editer', function()
{	
#	Schema::table('projects', function($table)
#	{
#		$table->integer('oboli_count');
#	});  
	DB::table('users')->insert(array('name' => 'gigi', 'email' => 'gigi@gmail.com', 'oboli_count' => 100, 'password' => 'password'));		

});


