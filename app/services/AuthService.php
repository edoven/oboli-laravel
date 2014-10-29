<?php




class AuthService {


	public static function doSignup($data)
	{
		$rules = array('name'    => 'required|alphaNum',
					   'email'    => 'required|email',
					   'password' => 'required|alphaNum|min:5');
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) 
			return Utils::returnError('validator_error', array('validator'=>$validator, 'input'=>$data)); //TODO: REMOVE password FROM INPUT
		//a user with that email already exists
		$user = User::where('email', $data['email'])->first();
		if ($user != null)
			if (FacebookProfile::where('user_id', $user->id)->first() == Null)
				return Utils::returnError('account_exists', array('email'=>$data['email']) );
			else //a facebook account connected with this email already exist
				return Utils::returnError('facebook_account_exists', array('input'=>$data) );	 //TODO: REMOVE password FROM INPUT			
		$user = User::createUnconfirmedUser($data['email'], $data['name'], $data['password']);	
		
		//MailService::sendConfirmationEmail($data['name'], $data['email'], $user->confirmation_code);	


		//TODO: TEEEEEEEEEEEEEEEEEST
		Event::fire('auth.signup', array($user));		
		return Utils::returnSuccess('mail_sent', array('email'=>$data['email'], 'user'=>$user) );
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
		// if ( ($user->confirmed == 0) && FacebookProfile::exists($user->id)==false )
		// 	return Utils::returnError('not_activated', array('email'=>Input::get('email')));


		return Utils::returnSuccess('login success', array("user"=>$user)); 			
	}


	public static function confirmEmail($email, $confirmation_code)
	{
		if (($email == null) or ($confirmation_code == null))
			return Utils::returnError('data_missing', 
									  array('email'=>$email, 'confirmation_code'=>$confirmation_code));
		$user = User::where('email', $email)->first();
		$users = User::all();
		if ($user == null)
			return Utils::returnError('unknown_email', array('environment'=>App::environment(), 'user'=>$user, 'email'=>$email, 'code'=>$confirmation_code));
		if ($user->confirmation_code != $confirmation_code)
			return Utils::returnError('wrong_code', array('email'=>$email, 'code'=>$confirmation_code));
		$user->confirmed = 1;
		$user->save();

		//TODO: TEST
		Session::put('activated', true);
		return Utils::returnSuccess('email confirmed', array('user'=>$user));		
	}
			
}


?>