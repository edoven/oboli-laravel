<?php

Event::listen('auth.signup', function($user)
{
    MailService::sendConfirmationEmail($user->name, $user->email, $user->confirmation_code);
});