<?php

Event::listen('auth.signup', function($user)
{
    MailService::sendConfirmationEmail($user->name, $user->email, $user->confirmation_code);

    //if (Session::get('code'))
});


Event::listen('auth.login.web', function($user_id)
{
	$user = User::find($user_id);
    Session::put('activated', $user->activated);
	Session::put('obolis', $user->oboli_count );
});


