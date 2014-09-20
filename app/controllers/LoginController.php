<?php

class LoginController extends BaseController {

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
			//if ($user->activated == 0) error
			$user_donations = Donation::where('user_id', '=', $user->getId())->get();
			return Redirect::to('/')->with('user', $user)->with('donations', $user_donations); 
		}
		else 
			echo 'error with credentials';
	}


	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}
	
	
	
	
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
	
	
	
	public function loginWithFacebook() {
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
		if ($facebook_profile == Null)
		{
			//create new profile and new user
			$me = $facebook->api('/me');
			$user = new User;
			$user->name = $me['first_name']." ".$me['last_name'];
			$user->email = $me['email']; // WARNING: CHECK IF EMAIL ALREADY EXIST!!
			$user->oboli_count = 0;
			$user->confirmation_code = $confirmation_code;
			$user->confirmed = 0; //email has not been confirmed yet
			$user->save();	
		}
		else
		{
			//get the user and log him in
		}

		

		
		$output = 'email='.$me['email'].
				  '<br />link='.$me['link'].
				  '<br />first_name='.$me['first_name'].
				  '<br />last_name='.$me['last_name'].
				  '<br />id='.$me['id'].
				  '<br />verified='.$me['verified'].
				  '<br />gender='.$me['gender'].
				  '<br />locale='.$me['locale'].
				  '<br />access_token='.$facebook->getAccessToken();
		return $output;
	}
	
	
}
