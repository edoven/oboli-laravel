<?php

Event::listen('auth.signup', function($user)
{
	Log::info('Event::auth.signup', array('user'=>$user) );

    MailService::sendConfirmationEmail($user->name, $user->email, $user->confirmation_code);
});


Event::listen('auth.signup.web', function()
{
	Log::info('Event::auth.signup.web' );

    Session::put('activated', false);
	Session::put('obolis', 0 );
	if (Session::has('code'))
	{
		$code = Session::get('code');
		App::make('CodeController')->useCodeWeb($code);
	}
});


Event::listen('auth.login.web', function($user_id)
{
	Log::info('Event::auth.login.web', array('user_id'=>$user_id) );

	$user = User::find($user_id);
    Session::put('activated', $user->activated);
	Session::put('obolis', $user->oboli_count );
	if (Session::has('code'))
	{
		$code = Session::get('code');
		App::make('CodeController')->useCodeWeb($code);
	}
});


