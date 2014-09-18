<?php

//BASIC
Route::get('/', function() {return View::make('homepage');});

//LOGIN/LOGOUT
Route::get('login',  function() {return View::make('login');}); //show login page
Route::post('login', array('uses' => 'LoginController@doLogin')); //process the login request done from the login page
Route::get('logout', array('uses' => 'LoginController@doLogout')); //logout the user
//Route::get('facebookLogin', array('uses' => 'LoginController@loginWithFacebook')); //logout the user
Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});
Route::get('login/fb/callback', function() {
    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();

    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

    $me = $facebook->api('/me');

	//array(11) { 
	//	["id"]=> string(15) "519487098184173" 
	//	["email"]=> string(25) "theodor.dangelo@gmail.com" 
	//	["first_name"]=> string(7) "Edoardo" 
	//	["gender"]=> string(4) "male" 
	//	["last_name"]=> string(9) "Venturini" 
	//	["link"]=> string(60) "https://www.facebook.com/app_scoped_user_id/519487098184173/" 
	//	["locale"]=> string(5) "en_US" 
	//	["name"]=> string(17) "Edoardo Venturini" 
	//	["timezone"]=> int(2) 
	//	["updated_time"]=> string(24) "2014-01-27T21:29:26+0000" 
	//	["verified"]=> bool(true) 
	//	} 
    //dd($me);
    return 'email='.$me['email'].'<br />link='.$me['link'].'<br />first_name='.$me['first_name'].'<br />last_name='.$me['last_name'].'<br />id='.$me['id'].'<br />verified='.$me['verified'];
});

//SIGNIN
Route::get('signin', 			function() {return View::make('signin');}); //show signin page
Route::post('signin', 			array('uses' => 'SigninController@doSignin')); //process the signin request done from the signin page
Route::get('signin/confirm', 	array('uses' => 'SigninController@confirmEmail')); //process the confirmed email (parameters:email, confirmation_code)

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


