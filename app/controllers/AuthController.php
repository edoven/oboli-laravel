<?php

class AuthController extends BaseController {

	
	//TODO: check if the email is sent
	private function sendConfirmationEmail($name, $email, $confirmation_code)
	{
		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'link' => 'http://edoventurini.com/signin/confirm?email='.$email.'&confirmation_code='.$confirmation_code
		);	
		Mail::send('emails.confirmation', $messageData, function($message) use($email)
														{
															$message->to($email)->subject('oboli account confirmation');
														}
		);
	}


	private function userExists($email)
	{
		$user = User::where('email' , $email)->first();
		if ($user!=Null)
			return true;
		else
			return false;			
	}


	private function createNewUnconfimedUser($name, $email, $password, $confirmation_code)
	{
		if ($this-> userExists(Input::get('email')))
			return "An account associated with ".Input::get('email')." already exists";
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->password = $password;
		$user->oboli_count = 0;
		$user->confirmation_code = $confirmation_code;
		$user->confirmed = 0; //email has not been confirmed yet
		$user->save();	
	}
	
	
	public function doSignin()
	{
		$rules = array(
						'name'    => 'required|alphaNum',
						'email'    => 'required|email',
						'password' => 'required|alphaNum|min:5'
						);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) 
			return Redirect::to('/signin')->withErrors($validator)->withInput(Input::except('password'));	
		//if a user with the input email already exist return error
		if ($this-> userExists(Input::get('email')))
			return "An account associated with ".Input::get('email')." already exists";
		$confirmation_code = str_random(45);
		$this->createNewUnconfimedUser(Input::get('name'), Input::get('email'), Input::get('password'), $confirmation_code);
		$this->sendConfirmationEmail(Input::get('name'),Input::get('email'), $confirmation_code);		
		return 'An email was sent to '.Input::get('email').'. Please read it to activate your account.';
	}

		
	public function confirmEmail()
	{
		$email = Input::get('email');
		$confirmation_code = Input::get('confirmation_code');
		if (($email == Null) or ($confirmation_code == Null))
			return "Error with the link: email or confirmation code missing.";
		$user = User::where('email' , $email)->first();
		if ($user == Null)
			return 'Error: no user associated with '.$email.'.';
		if ($user->getConfirmationCode() == $confirmation_code)
		{
			$user->confirmed = 1;
			$user->save();
			return "Great! Your account has been activated!";
		}
		else
			return 'Error: no user associated with '.$user.'.';
	}
	
	
	public function doLogin()
	{
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required|alphaNum|min:5'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) 
			return Redirect::to('/login')->withErrors($validator)->withInput(Input::except('password'));

		$userdata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
		);
		if (Auth::attempt($userdata))
		{
			$user = Auth::user();	
			if ($user->confirmed == 0)
			{
				Auth::logout();
				return "You have not activated your account, please check the email we have sent.";
			}
			return Redirect::to('/');
		}
		else 
			echo 'error with credentials';
	}
	
	
	public function doLoginWithFacebook() {
		$facebook = new Facebook(Config::get('facebook'));
		$params = array(
			'redirect_uri' => url('/login/fb/callback'),
			'scope' => 'email',
		);
		return Redirect::to($facebook->getLoginUrl($params));
	}


	public function manageFacebookCallback() {
		$code = Input::get('code');
		if (strlen($code) == 0) 
			return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

		$facebook = new Facebook(Config::get('facebook'));
		$uid = $facebook->getUser();

		if ($uid == 0) 
			return Redirect::to('/')->with('message', 'There was an error');
			
		$facebook_profile = FacebookProfile::where('uid',  $uid)->first();
		
		if ($facebook_profile != Null) //user already exist, just log him in
		{
			$user = User::find($facebook_profile->user_id);
			if ($user->confirmed == 0)
			{
				Auth::logout();
				return "You have not activated your account, please check the email we have sent.";
			}
			Auth::loginUsingId($facebook_profile->user_id);
			return Redirect::to('/');
		}
				
		$me = $facebook->api('/me');		
		$user = User::where('email', $me['email'])->first(); 
		if ($user!=Null) //a user with the email associated with this facebook account already exist
		{
			$facebook_profile = new FacebookProfile;
			$facebook_profile->uid = $uid;
			$facebook_profile->user_id = $user->id;
			$facebook_profile->access_token = $facebook->getAccessToken();
			$facebook_profile->save();
			if ($user->confirmed == 0)
			{
				Auth::logout();
				return "You have not activated your account, please check the email we have sent.";
			}
			Auth::loginUsingId($facebook_profile->user_id);
			return Redirect::to('/');
		}
		
		//create a user and a facebook_profile		
		$confirmation_code = str_random(45);			
		$user = new User;
		$user->name = $me['first_name']." ".$me['last_name'];
		$user->email = $me['email'];
		$user->oboli_count = 0;
		$user->confirmation_code = $confirmation_code;
		$user->confirmed = 0; //email has not been confirmed yet
		$user->save();	
		$user_id = $user->id;
		
		$facebook_profile = new FacebookProfile;
		$facebook_profile->uid = $uid;
		$facebook_profile->user_id = $user_id;
		$facebook_profile->access_token = $facebook->getAccessToken();
		$facebook_profile->save();
		
		$this->sendConfirmationEmail($me['first_name'],$me['email'], $confirmation_code);		
		return 'An email was sent to '.$me['email'].'. Please read it to confirm your account.';	

	}
	
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}
	
	
}
