<?php

class AuthService {


	public static function doSignup()
	{
		$return = array();
		$rules = array('name'    => 'required|alphaNum',
					   'email'    => 'required|email',
					   'password' => 'required|alphaNum|min:5');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) 
			return Utils::returnError('validator_error', array('validator'=>$validator, 'input'=>Input::except('password')));
		//a user with that email already exists
		$user = User::where('email', Input::get('email'))->first();
		if ($user!=null)
			if (FacebookProfile::where('user_id', $user->id)->first() == Null)
				return Utils::returnError('account_exists',array('email'=>Input::get('email')) );
			else //a facebook account connected with this email already exist
				return Utils::returnError('facebook_account_exists',array('input'=>Input::except('password')) );				
		$user = User::createUnconfirmedUser(Input::get('email'), Input::get('name'), Input::get('password'));	
		MailService::sendConfirmationEmail(Input::get('name'), Input::get('email'), $user->confirmation_code);	
		return Utils::returnSuccess('mail_sent', array('email'=>Input::get('email')) );
	}


	public static function doLogin()
	{
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) 
			return Utils::returnError('validator_error', array('validator'=>$validator, 'input'=>Input::except('password')));
		$userdata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
		);
		if (Auth::attempt($userdata) == false)
			return Utils::returnError('wrong_credentials', array('email'=>Input::get('email')));

		//se l'utente si è collegato con facebook non gli faccio fare l'attivazione tramite email
		$user = Auth::user();
		if ( ($user->confirmed == 0) && FacebookProfile::exists($user->id) )
			return Utils::returnError('not_activated', array('email'=>Input::get('email')));
		return Utils::returnSuccess('login success', array("user"=>$user)); 			
	}


	public static function confirmEmail()
	{
		$email = Input::get('email');
		$confirmation_code = Input::get('confirmation_code');
		if (($email == Null) or ($confirmation_code == Null))
			return Utils::returnError('data_missing', 
									  array('email'=>$email, 'confirmation_code'=>$confirmation_code));
		$user = User::where('email' , $email)->first();
		if ($user == Null)
			return Utils::returnError('wrong_email', 
									  array('email'=>$email));
		if ($user->confirmation_code != $confirmation_code)
			return Utils::returnError('wrong_code', 
									  array('code'=>$confirmation_code));
		$user->confirmed = 1;
		$user->save();
		return Utils::returnSuccess('email confirmed', array('user'=>$user));		
	}
			
}


?>