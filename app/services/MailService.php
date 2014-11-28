<?php

class MailService {

	public static function sendConfirmationEmail($name, $email, $confirmation_code)
	{
		Log::info('MailService::sendConfirmationEmail', array('name'=>$name, 'email'=>$email, 'confirmation_code'=>$confirmation_code) );

		$configs = include(app_path().'/config/local-config.php');
		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'link' => $configs['host'].'/signin/confirm?email='.$email.'&confirmation_code='.$confirmation_code
			);	
		Mail::send('emails.confirmation', 
				   $messageData, 
				   function($message) use($email) {$message->to($email)->subject('oboli conferma account');}
				   );
	}


	public static function sendNewAccountCreatedEmail($name, $email)
	{
		Log::info('MailService::sendNewAccountCreated', array('name'=>$name, 'email'=>$email) );

		$configs = include(app_path().'/config/local-config.php');
		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'email' => $email
			);	
		Mail::send('emails.newaccount', 
				   $messageData, 
				   function($message) use($email) {$message->to('edoardo.venturini@gmail.com')->subject('oboli - nuovo account');}
				   );
	}

	

}

?>