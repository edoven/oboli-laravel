<?php

class MailService {

	public static function sendConfirmationEmail($name, $email, $confirmation_code)
	{
		Log::info('MailService::sendConfirmationEmail', array('name'=>$name, 'email'=>$email, 'confirmation_code'=>$confirmation_code) );

		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'link' => Config::get('local-config')['host'].'/signin/confirm?email='.$email.'&confirmation_code='.$confirmation_code,
			'from' => array('address' => 'no-response@oboli.co.in', 
							'name' 	  => 'oboli team'),
			);	
		Mail::send('emails.confirmation', 
				   $messageData, 
				   function($message) use($email) {$message->to($email)->subject('Oboli - conferma account');}
				   );
	}


	public static function sendNewAccountCreatedEmail($name, $email)
	{
		Log::info('MailService::sendNewAccountCreated', array('name'=>$name, 'email'=>$email) );

		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'email' => $email,
			'from' => array('address' => 'no-response@oboli.co.in', 
							'name' 	  => 'Oboli-admin'),
			);	
		Mail::send('emails.newaccount', 
				   $messageData, 
				   function($message) use($email) {$message->to('edoardo.venturini@gmail.com')->subject('oboli - nuovo account');}
				   );
	}

	

}

?>