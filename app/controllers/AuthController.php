<?php


use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\GraphUser;

require_once(app_path().'/utils.php');



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
			    	return "Error: an account associated with ".$return_object['data']['email']." already exists";
				case 'facebook_account_exists':
			    	return "Error: an account associated with ".$return_object['data']['email']." is already registered through facebook login";
			    default:
			    	return 'Internal Server Error';	
			}
		}		
		if ($return_object['status'] == 'success')
			return 'Success! An email was sent to '.$return_object['data']['email'].'. Please read it to activate your account.';		
		return 'Internal Server Error';		
	}

	public function doLogin()
	{
		$return_object = AuthService::doSignup();
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
			    	return Redirect::to('/login')->withErrors($return_object['data']['validator'])->withInput($return_object['data']['input']);
				case 'not_activated':
					Auth::logout();
					return "Error: you have not activated your account. Please check your email account.";
				case 'wrong_credentials':
			    	return "Error: wrong credentials";
			    default:
			    	return 'Internal Server Error';	
			}
		}
		if ($return_object['status'] == 'success')
			return Redirect::to('/');	
		return 'Internal Server Error';	
	}

		
	public function confirmEmail()
	{
		$return_object = AuthService::confirmEmail();
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'data_missing':
			    	return "Error with the link: email or confirmation code missing.";
				case 'wrong_email':
					return 'Error: no user associated with '.$return_object['data']['email'].'.';
				case 'wrong_credentials':
			    	return 'Error: this confirmation code does not match with the one we sent you!';
			    default:
			    	return 'Internal Server Error. '.$return_object['message'];	
			}
		}
		if ($return_object['status'] == 'success')
		{
			Auth::loginUsingId($return_object['data']['user']->id);
			return Redirect::to('/');
		}
			
		return 'Internal Server Error. '.$return_object['message'];		
	}
	
	
	public function doLoginWithFacebook() {
		// $facebook = new Facebook(Config::get('facebook'));
		// $params = array(
		// 	'redirect_uri' => url('/login/fb/callback'),
		// 	'scope' => 'email',
		// );
		// return Redirect::to($facebook->getLoginUrl($params));
		session_start();
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$helper = new FacebookRedirectLoginHelper(Config::get('local-config')['host'].'/login/fb/callback');
		$loginUrl = $helper->getLoginUrl();
		return Redirect::to($loginUrl); 
	}


	public function manageFacebookCallback() {
		$return_object = FacebookService::manageFacebookCallback();
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'facebook_error':
			    	return "Facebook error (UID is not present or 0).";
			    default:
			    	return 'Internal Server Error';	
			}
		}
		if ($return_object['status'] == 'success')
		{
			Auth::loginUsingId($return_object['data']['user_id']);
			return Redirect::to('/');
		}
		return 'Internal Server Error';	
	}

	// public function manageFacebookCallback() {
	// 	session_start();
	// 	FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
	// 	$helper = new FacebookRedirectLoginHelper('http://edoventurini.com/login/fb/callback');
	// 	try {
	// 		$session = $helper->getSessionFromRedirect();
	// 		//return var_dump($helper->getSessionFromRedirect());
	// 	} catch(FacebookRequestException $ex) {
	// 	 	return $ex;
	// 	} catch(Exception $ex) {
	// 		return "Exception";
	// 	}
	// 	if ($session) {
	// 	  $me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
	// 	  return $me->getId();
	// 	}
	// 	return $helper->toJson();	
	// }
	
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}
	
	
}