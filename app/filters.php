<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('auth.rest', function()
{
	$user_id = Input::get('user_id');
	$token = Input::get('token');
	if ($user_id==null)
		return Response::json(array(
			'status' => 'error',
			'code' => '400',
			'message' => 'user_id missing'),
			400
		);
	if ($token==null)
		return Response::json(array(
			'status' => 'error',
			'code' => '400',
			'message' => 'token missing'),
			400
		);
	$user = User::find($user_id);
	if ($user==Null)
		return Response::json(array(
			'status' => 'error',
			'code' => '401',
			'message' => 'A user with id='.$user_id.' does not exist',
			'user_id' => $user_id,
			'token' => $token),
			401
		);
	if ($user->api_token!=$token)
		return Response::json(array(
			'status' => 'error',
			'code' => '401',
			'message' => 'wrong credentials',
			'user_id' => $user_id,
			'token' => $token),
			401
		);	
	if ($user->confirmed==0)
		return Response::json(array(
			'status' => 'error',
			'code' => '401',
			'message' => 'email not yet confirmed'),
			401
		);
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
