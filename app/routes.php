<?php


//Route::get('donazione', 			function() {return View::make('donazione');});

//BASIC (no controllers)
Route::get('/', 			function() {return View::make('homepage');});
Route::get('access', 		function() {return View::make('access');}); //show signin page
Route::get('signup', 		function() {return View::make('signup');}); //show signin page
Route::get('signup/email', 	function() {return View::make('signupemail');}); //show signin page
Route::get('login',  		function() {return View::make('login');}); //show login page
Route::get('howitworks',  	function() {return View::make('howitworks');}); 
Route::get('contact-us',  	function() {return View::make('contact-us');}); 
Route::get('404',  			function() {return View::make('404');}); 
Route::get('error',  		function() {return View::make('error');}); 
Route::get('success',  		function() {return View::make('success');}); 



//SIGNIN/LOGIN/LOGOUT
Route::post('signup', 				'AuthController@doSignupWeb'); //process the signin request done from the signin page
Route::get('signin/confirm', 		'AuthController@confirmEmail'); //process the confirmed email (parameters:email, confirmation_code)
Route::post('login', 				'AuthController@doLoginWeb'); //process the login request done from the login page
Route::get('logout', 				'AuthController@doLogout'); //logout the user

//PROFILE


//FACEBOOK
Route::get('login/fb', 				'FacebookController@redirectToFacebook');
Route::get('login/fb/callback', 	'FacebookController@manageFacebookCallback');

//USERS
Route::get('users/{id}', 	 		array('before' => 'auth', 'uses' => 'UserController@showProfile')); //show user profile

//DONATIONS
Route::post('makeDonation',		array('before' => 'auth', 'uses' => 'DonationController@makeDonationWeb')); //make the donation from a user to a project (parameters: user, project, amount)
Route::get('donations/{id}', 	'DonationController@showDonationPage');

//NGOS
Route::get('ngos', 				'NgoController@showAll'); //show projects page
#Route::get('ngos/{id}', 		'NgoController@showDetailsFromId'); //show project page
Route::get('ngos/{name_short}', 'NgoController@showDetailsFromName'); //show project page

//CODES
Route::get('codes', 	'CodeController@showAll'); //show codes page [TO BE HIDDEN]
//Route::get('codes/{id}', array('before' => 'auth', 'uses' => 'CodeController@useCode'));
Route::get('codes/{id}','CodeController@useCodeWeb'); //the auth-chech is made in the controller to fire code event


//PASSWORD REMINDER
Route::get('password/remind', 			'RemindersController@getRemind' );
Route::post('password/remind', 			'RemindersController@postRemind');
Route::get('password/reset/{token}', 	'RemindersController@getReset' );
Route::post('password/reset', 			'RemindersController@postReset');

//MAILING LIST
Route::post('mailinglist/new', 			'MailinglistController@addEmail');

//LANG
//Route::get('it', 	function() { App::setLocale('it'); return View::make('homepage');} );



//Route::post('api/v0.1/signup', 			array('https',  'uses' => 'AuthRestController@doSignup'));

/*
 *
 *		REST (HTTPS)
 *
 */
Route::group(array('prefix' => 'api/v0.1/'), function()
{
	Route::post('login/fb', 					array('https',  'uses' => 'FacebookController@doFacebookRestLogin'));	
	Route::post('login', 						array('https',  'uses' => 'AuthController@doLoginRest'));
	Route::post('signup', 						array('https',  'uses' => 'AuthController@doSignupRest'));
	Route::get('signup/confirm', 				array('https',  'uses' => 'AuthController@confirmEmail'));
	Route::get('ngos', 							array('https',  'uses' => 'NgoController@showAll'));
	//it needs auth because it returns donations to the ngo made by authenticated user
	Route::get('ngos/{id}', 					array('https', 'before' => 'auth.rest', 'uses' => 'NgoController@showDetailsFromIdRest'));	
	Route::get('users/{id}',  					array('https', 'before' => 'auth.rest', 'uses' => 'UserController@showProfileRest'));
	Route::post('profile/photo', 				array('https', 'before' => 'auth.rest', 'uses' => 'UserController@addPhotoRest'));
	Route::post('donations/new',				array('https', 'before' => 'auth.confirmed.rest', 'uses' => 'DonationController@makeDonationRest')); //make the donation from a user to a project (parameters: user, project, amount)
	Route::get('codes/{id}', 					array('https', 'before' => 'auth.rest', 'uses' => 'CodeController@useCodeRest')); //use a code to accredit obolis
});


Route::group(array('prefix' => 'api/v0.2/'), function()
{
	Route::get('users/{id}', array('https', 'before' => 'auth.rest', 'uses' => 'UserController@showProfileRest_v02'));
});

?>