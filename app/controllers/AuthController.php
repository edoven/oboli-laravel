<?php



include_once app_path().'/utils.php';

class AuthController extends BaseController {


	public function doSignup()
	{
		$return_object = AuthService::doSignup();
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
			    	return Redirect::to('/signup/email')->withErrors($return_object['data']['validator'])->withInput($return_object['data']['input']);
				case 'account_exists':
			    	return "An account associated with ".$return_object['data']['email']." already exists";
				case 'facebook_account_exists':
			    	return "An account associated with ".$return_object['data']['email']." is already registered through facebook login";
			}
		}
		elseif ($return_object['status'] == 'success')
		{
			return 'An email was sent to '.$return_object['data']['email'].'. Please read it to activate your account.';
		}
		else
			return 'Internal Server Error';		
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
		if ($user->confirmation_code != $confirmation_code)
			return 'Error: this confirmation code does not match with the one we gave you!';
		$user->confirmed = 1;
		$user->save();
		return "Great! Your account has been activated!";			
	}
	
	
	public function doLogin()
	{
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
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
			//se l'utente si è collegato con facebook non gli faccio fare l'attivazione tramite email
			if ($user->confirmed==0)
			{
				$facebook_profile=FacebookProfile::where('uid',  $user->id)->first();
				if ($facebook_profile==Null)
				{
					Auth::logout();
					return "You have not activated your account, please check the email we have sent.";
				}			
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
		
		//if user already exist, just log him in
		if ($facebook_profile != Null) 
		{
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
			//if ($user->confirmed == 0)
			//{
			//	Auth::logout();
			//	return "You have not activated your account, please check the email we have sent.";
			//}
			Auth::loginUsingId($facebook_profile->user_id);
			return Redirect::to('/');
		}
		
		//create a user and a facebook_profile		
		$confirmation_code = str_random(45);	
		$api_token = str_random(60);		
		$user = new User;
		$user->name = $me['first_name']." ".$me['last_name'];
		$user->email = $me['email'];
		$user->oboli_count = 0;
		$user->confirmation_code = $confirmation_code;
		$user->confirmed = 1; //email is confirmed because is connected with fb
		$user->facebook_profile = 1; //email is confirmed because is connected with fb
		$user->api_token=$api_token;
		$user->save();	
		
		$facebook_profile = new FacebookProfile;
		$facebook_profile->uid = $uid;
		$facebook_profile->user_id = $user->id;
		$facebook_profile->access_token = $facebook->getAccessToken();
		$facebook_profile->save();
		
		Auth::loginUsingId($user->id);
		return Redirect::to('/');
		
		//$this->sendConfirmationEmail($me['first_name'],$me['email'], $confirmation_code);		
		//return 'An email was sent to '.$me['email'].'. Please read it to confirm your account.';	

	}
	
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}
	

	
}
