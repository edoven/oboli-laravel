<?php

class AuthService {
	
	public static function verifyFacebookToken($access_token)
	{
		$facebook = new Facebook(Config::get('facebook'));
		$token_debug = $facebook->api('debug_token', array(
									  'input_token' => $access_token,
									  'access_token' => $facebook->getAccessToken() //this is related to the app
									  ));
		if ($token_debug['data']['is_valid']!=true)
			return array('status'=>'error', 
						 'message'=>'token is not valid');					
		if ($token_debug['data']['app_id']!=$facebook->getAppId())
			return array('status'=>'error', 
						 'message'=>'token is not related to this app');
		return array('status'=>'success');
	}

	
	public static function getUserInfoFromToken($access_token)
	{
		$facebook = new Facebook(Config::get('facebook'));
		$me = $facebook->api('/me', 'get', array(
			'access_token' => $access_token
		));
		return array('id'=>$me['id'],
					 'email'=>$me['email'],
					 'name'=>$me['name']);
	}
	
	
	/*
	 *  TODO: move to model
	 */
	public static function createFacebookProfile($user_id, $uid, $access_token)
	{
		$facebook_profile = new FacebookProfile;
		$facebook_profile->uid = $uid;
		$facebook_profile->user_id = $user_id;
		$facebook_profile->access_token = $access_token;
		$facebook_profile->save();
		//User::create(array('uid'=>$uid,
						   //'user_id'=>$user_id,
						   //'access_token'=>$access_token));
	}
	
	/*
	 *  TODO: move to model
	 */
	public static function createConfirmedUser($email, $name)
	{
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->oboli_count = 0;
		$user->confirmation_code = str_random(45);
		$user->confirmed = 1; //email is confirmed because is connected with fb
		$user->facebook_profile = 1; //email is confirmed because is connected with fb
		$user->api_token = str_random(60);
		$user->save();	
		return $user;
	}


	public static function createUnconfirmedUser($email, $name, $password)
	{
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->password = Hash::make($password);
		$user->oboli_count = 0;
		$user->donated_oboli_count = 0;
		$user->confirmation_code = str_random(45);
		$user->confirmed = 0; //email has not been confirmed yet
		$user->api_token = str_random(60);
		$user->facebook_profile = 0;
		$user->save();	
		return $user;
	}

	public static function sendConfirmationEmail($name, $email, $confirmation_code)
	{
		$configs = include(app_path().'/config/local-config.php');
		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'link' => $configs['host'].'/signin/confirm?email='.$email.'&confirmation_code='.$confirmation_code
			);	
		Mail::send('emails.confirmation', 
				   $messageData, 
				   function($message) use($email) {$message->to($email)->subject('oboli account confirmation');}
				   );
	}


	public static function doSignup()
	{
		$return = array();
		$rules = array('name'    => 'required|alphaNum',
					   'email'    => 'required|email',
					   'password' => 'required|alphaNum|min:5');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) 
			return AuthService::createReturnObject('error', 
													'validator_error', 
													array('validator'=>$validator, 'input'=>Input::except('password')));
		//a user with that email already exists
		if (User::where('email', Input::get('email'))->first() != Null)
		{
			$id = User::where('email', Input::get('email'))->first()->id;
			if (FacebookProfile::where('user_id', $id)->first() == Null)
				return AuthService::createReturnObject('error', 
														'account_exists', 
														array('email'=>Input::get('email')) );
			else //a facebook account connected with this email already exist
				return AuthService::createReturnObject('error', 
														'facebook_account_exists', 
														array('input'=>Input::except('password')) );
		}					
		$user = AuthService::createUnconfirmedUser(Input::get('email'), Input::get('name'), Input::get('password'));	
		AuthService::sendConfirmationEmail(Input::get('name'), Input::get('email'), $user->confirmation_code);	
		return AuthService::createReturnObject('success', 
												'mail_sent', 
												array('email'=>Input::get('email')) );
	}




	public static function createReturnObject($status, $message, $data)
	{
		return array('status'=>$status,
					 'message'=>$message,
					 'data'=>$data);
	}
			
}


?>
