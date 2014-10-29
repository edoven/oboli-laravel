<?php


Route::get('donazione', 			function() {return View::make('donazione');});

//BASIC (no controllers)
Route::get('/', 			function() {return View::make('homepage');});
Route::get('signup', 		function() {return View::make('signup');}); //show signin page
Route::get('signup/email', 	function() {return View::make('signupemail');}); //show signin page
Route::get('login',  		function() {return View::make('login');}); //show login page

//SIGNIN/LOGIN/LOGOUT
Route::post('signup', 				'AuthController@doSignup'); //process the signin request done from the signin page
Route::get('signin/confirm', 		'AuthController@confirmEmail'); //process the confirmed email (parameters:email, confirmation_code)
Route::get('login/fb', 				'AuthController@redirectToFacebook');
Route::get('login/fb/callback', 	'AuthController@manageFacebookCallback');
Route::post('login', 				'AuthController@doLogin'); //process the login request done from the login page
Route::get('logout', 				'AuthController@doLogout'); //logout the user

//USERS
//Route::get('users', 			'UserController@showAll'); //show users page [TO BE HIDDEN]
Route::get('users/{id}', 	 	array('before' => 'auth', 'uses' => 'UserController@showProfile')); //show user profile
Route::post('makeDonation',		array('before' => 'auth', 'uses' => 'UserController@makeDonation')); //make the donation from a user to a project (parameters: user, project, amount)

//NGOS
Route::get('ngos', 		'NgoController@showAll'); //show projects page
Route::get('ngos/{id}', 'NgoController@showDetails'); //show project page

//CODES
Route::get('codes', 	'CodeController@showAll'); //show codes page [TO BE HIDDEN]
//Route::get('codes/{id}', array('before' => 'auth', 'uses' => 'CodeController@useCode'));
Route::get('codes/{id}','CodeController@useCode'); //the auth-chech is made in the controller to fire code event

//PASSWORD REMINDER
Route::get('password/remind', 			'RemindersController@getRemind' );
Route::post('password/remind', 			'RemindersController@postRemind');
Route::get('password/reset/{token}', 	'RemindersController@getReset' );
Route::post('password/reset', 			'RemindersController@postReset');

//LANG
Route::get('it', 	function() { App::setLocale('it'); return View::make('homepage');} );



//Route::post('api/v0.1/signup', 			array('https',  'uses' => 'AuthRestController@doSignup'));

/*
 *
 *		REST (HTTPS)
 *
 */
Route::group(array('prefix' => 'api/v0.1/'), function()
{
	Route::post('login/fb', 		array('https',  'uses' => 'AuthController@doFacebookRestLogin'));	
	Route::post('login', 			array('https',  'uses' => 'AuthController@doLogin'));
	Route::post('signup', 			array('https',  'uses' => 'AuthController@doSignup'));
	Route::get('signup/confirm', 	array('https',  'uses' => 'AuthController@confirmEmail'));
	Route::get('ngos', 				array('https',  'uses' => 'NgoController@showAll'));
	//it needs auth because it returns donations to the ngo made by authenticated user
	Route::get('ngos/{id}', 		array('https', 'before' => 'auth.rest', 'uses' => 'NgoController@showDetails'));	
	Route::get('users/{id}',  		array('https', 'before' => 'auth.rest', 'uses' => 'UserController@showProfile'));
	Route::post('donations/new',	array('https', 'before' => 'auth.rest', 'uses' => 'UserController@makeDonation')); //make the donation from a user to a project (parameters: user, project, amount)
	Route::get('codes/{id}', 		array('https', 'before' => 'auth.rest', 'uses' => 'CodeController@useCode')); //use a code to accredit obolis
});

?>