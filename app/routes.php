<?php

//BASIC (no controllers)
Route::get('/', 				function() {return View::make('homepage');});
Route::get('access', 			function() {return View::make('access');}); //show signin page
Route::get('howitworks',  		function() {return View::make('howitworks');}); 
Route::get('404',  				function() {return View::make('404');}); 
Route::get('error',  			function() {return View::make('error');}); 
Route::get('success',  			function() {return View::make('success');});
Route::get('team',  			function() {return View::make('team');});
Route::get('terms',  			function() {return View::make('terms');});
Route::get('giftcard',  		function() {return View::make('giftcard');});
Route::get('landing',  			function() {return View::make('landing');});


//AUTH
Route::get('signin/confirm', 		'AuthWebController@confirmEmail'); //process the confirmed email (parameters:email, confirmation_code)
Route::get('signup/success', 		array('before' => 'auth', function(){ return Redirect::to('/'); })); //useful for analytics
Route::get('logout', 				'AuthWebController@doLogout'); //logout the user
Route::post('signup', 				'AuthWebController@doSignup'); //process the signin request done from the signin page
Route::post('login', 				'AuthWebController@doLogin'); //process the login request done from the login page
Route::get('login/fb', 				'FacebookWebController@redirectToFacebook');
Route::get('login/fb/callback', 	'FacebookWebController@manageFacebookCallback');

//USERS
Route::get('users/{id}', 	 		array('before' => 'auth', 'uses' => 'UserWebController@showProfile')); //show user profile

//DONATIONS
Route::post('donations/new',	array('before' => 'auth', 'uses' => 'DonationWebController@makeDonation')); //make the donation from a user to a project (parameters: user, project, amount)
Route::get('donations/{id}', 	'DonationWebController@showDonationPage');

//NGOS
Route::get('ngos', 				'NgoWebController@show'); //show projects page
Route::get('ngos/{id}', 		'NgoWebController@showDetails')->where('id', '[0-9]+');;
Route::get('ngos/{name_short}', 'NgoWebController@showDetailsFromName'); //show project page

//CODES
Route::get('codes/{id}','CodeWebController@useCode'); //the auth-chech is made in the controller to fire code event

//PASSWORD REMINDER
Route::get('password/remind', 			'RemindersWebController@getRemind' );
Route::post('password/remind', 			'RemindersWebController@postRemind');
Route::get('password/reset/{token}', 	'RemindersWebController@getReset' );
Route::post('password/reset', 			'RemindersWebController@postReset');

//MAILING LIST
Route::post('mailinglist/new', 			'MailinglistWebController@addEmail');




/*
 *
 *		REST (HTTPS)
 *
 */
Route::group(array('prefix' => 'api/v1.0/'), function()
{
	Route::post('login/fb', 					array('https',  'uses' => 'FacebookRestController@doFacebookLogin'));	
	Route::post('login', 						array('https',  'uses' => 'AuthRestController@doLogin'));
	Route::post('signup', 						array('https',  'uses' => 'AuthRestController@doSignup'));
	//Route::get('signup/confirm', 				array('https',  'uses' => 'AuthController@confirmEmail'));
	Route::get('ngos', 							array('https',  'uses' => 'NgoRestController@showAll'));
	//it needs auth because it returns donations to the ngo made by authenticated user
	Route::get('ngos/{id}', 					array('https', 'before' => 'auth.rest', 'uses' => 'NgoRestController@showDetails'));	
	Route::get('users/{id}',  					array('https', 'before' => 'auth.rest', 'uses' => 'UserRestController@showProfile'));
	Route::post('profile/photo', 				array('https', 'before' => 'auth.rest', 'uses' => 'UserRestController@addPhoto'));
	Route::post('donations/new',				array('https', 'before' => 'auth.confirmed.rest', 'uses' => 'DonationRestController@makeDonation')); //make the donation from a user to a project (parameters: user, project, amount)
	Route::get('codes/{id}', 					array('https', 'before' => 'auth.rest', 'uses' => 'CodeRestController@useCode')); //use a code to accredit obolis
	
	//Route::get('sales/new', 					array('https', 'uses' => 'SaleRestController@addSale')); //use a code to accredit obolis
	Route::get('activeProducts', 				array('https', 'uses' => 'ActiveProductRestController@getAll')); 

	Route::get('terms', 						array('https', 'uses' => 'BureacracyRestController@getTerms')); 

});




/*
 *
 * ADMIN
 *
*/
Route::post('api/v1.0/codes/new',			array('https', 'uses' => 'AdminController@addCode')); 
Route::get('admin',  						function() { return View::make('admin.dashboard'); } );
Route::get('admin/codes', 					array('before' => 'auth.admin', 'uses' => 'AdminController@showCodes')); //use a code to accredit obolis
Route::get('admin/users', 					array('before' => 'auth.admin', 'uses' => 'AdminController@showUsers')); //use a code to accredit obolis

?>