<?php




class AuthService {


	public static function doSignup($data)
	{
		Log::info('AuthService::doSignup', $data);
		$rules = array('name'    => 'required',
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
			{
				$user = User::updateDataForExistingEmail($data['email'], $data['name'], $data['password']);
				return Utils::returnSuccess('account_created', array('email'=>$data['email'], 'user'=>$user) );
			}
				
		$user = UserFactory::createUnconfirmedUser($data['email'], $data['name'], $data['password']);
		// $user = User::createUnconfirmedUser($data['email'], $data['name'], $data['password']);	
		// RequestsCounter::addUser($user->id);
		return Utils::returnSuccess('account_created', array('email'=>$data['email'], 'user'=>$user) );
	}


	public static function doLogin($data)
	{
		Log::info('AuthService::doLogin', $data);
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
		);
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) 
			return Utils::returnError('validator_error', array('validator'=>$validator, 'input'=>$data));
		$userdata = array(
			'email' 	=> $data['email'],
			'password' 	=> $data['password']
		);
		if (Auth::attempt($userdata, true) == false)
			if (User::where('email', $data['email'])->first() == null)
				return Utils::returnError('unknown_email', array('email'=>$data['email']));
			else
				return Utils::returnError('wrong_credentials', array('email'=>$data['email']));
		return Utils::returnSuccess('success_login', array("user"=>Auth::user())); 			
	}


	public static function confirmEmail($email, $confirmation_code)
	{
		Log::info('AuthService::confirmEmail', array('email'=>$email, 'confirmation_code'=>$confirmation_code) );
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