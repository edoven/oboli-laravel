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
	
	
	public function loginWithFacebook() {
		$code = Input::get( 'code' );
		$fb = OAuth::consumer( 'Facebook' );
		if ( !empty( $code ) ) {
			$token = $fb->requestAccessToken( $code );
			$result = json_decode( $fb->request( '/me' ), true );
			$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			//echo $message. "<br/>";
			//dd($result);
			return $message;
		}
		else {
			$url = $fb->getAuthorizationUri();
			return Redirect::to( (string)$url );
		}
	}
	
	
}
