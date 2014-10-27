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
		$data = Input::all();
		$return_object = AuthService::doSignup($data);
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
					if (Request::is("api/*"))
					{
						$data = array(
									'name'=>(Input::get('name')==null ? '' : Input::get('name')), 
									'email'=>(Input::get('email')==null ? '' : Input::get('email')),
									'errors' => array(
													  'name'=>$return_object['data']['validator']->messages()->first('name'), 
												      'email'=>$return_object['data']['validator']->messages()->first('email'),  
													  'password'=>$return_object['data']['validator']->messages()->first('password') 
													  )
									);
						return Utils::create_json_response('error', 400, 'error with credentials', 'missing or invalid credentials', $data);
					}
					else
			    		return Redirect::to('/signup/email')->withErrors($return_object['data']['validator'])->withInput($return_object['data']['input']);
				case 'account_exists':
					if (Request::is("api/*"))
						return Utils::create_json_response('error',400, 'a user with this email already exist', null, null);
			    	else
			    		return "Error: an account associated with ".$return_object['data']['email']." already exists";
				case 'facebook_account_exists':
					if (Request::is("api/*"))
						return Utils::create_json_response('error',400, 'a user with this email is already registered via facebook', null, null);
					else
			    		return "Error: an account associated with ".$return_object['data']['email']." is already registered through facebook login";
			    default:
			    	if (Request::is("api/*"))
			    		return Utils::create_json_response("error", 500, "internal server error", null, null);
			    	else
			    		return 'Internal Server Error';	
			}
		}		
		if ($return_object['status'] == 'success')
			if (Request::is("api/*"))
				return Utils::create_json_response('success', 200, 'An email was sent to '.Input::get('email').'. Please read it to activate your account.', null, array('email'=>Input::get('email')));
			else
				return 'Success! An email was sent to '.$return_object['data']['email'].'. Please read it to activate your account.';
		
		if (Request::is("api/*"))
			return Utils::create_json_response("error", 500, "internal server error", null, null);
		else
			return 'Internal Server Error';		
	}



	public function doLogin()
	{
		$return_object = AuthService::doLogin();
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
					if (Request::is("api/*"))
					{
						$data = array(
								  'email'=>Input::get('email'),
								  'errors' => array(
													'email'=>$return_object['data']['validator']->messages()->first('email'),  
													'password'=>$return_object['data']['validator']->messages()->first('password') 
													)
								  );
						return Utils::create_json_response("error", 400, 'error with credentials', null, $data);
					}
					else
			    		return Redirect::to('/login')->withErrors($return_object['data']['validator'])->withInput($return_object['data']['input']);
				case 'not_activated':
					if (Request::is("api/*"))
						return Utils::create_json_response("error", 400, 'account not yet confimed by email', null, null);
					else
						Auth::logout();
						return "Error: you have not activated your account. Please check your email account.";
				case 'wrong_credentials':
					if (Request::is("api/*"))
			    		return Utils::create_json_response("error", 400, 'error with credentials', null, null);
			    	else
			    		return "Error: wrong credentials";
			    default:
			    	if (Request::is("api/*"))
			    		return Utils::create_json_response("error", 500, "internal server error", null, null);
			    	else
			    		return 'Internal Server Error';	
			}
		}
		if ($return_object['status'] == 'success')
			if (Request::is("api/*"))
			{
				$user = $return_object['data']['user'];
				$data =  array('user_id' => $user->id,
							   'token' => $user->api_token,
							   'user' => $user->toArray()
							  );
				return Utils::create_json_response("success", 200, 'successful login', null, $data);
			}
			else
				return Redirect::to('/');	

		if (Request::is("api/*"))
			return Utils::create_json_response("error", 500, "internal server error", null, null);
		else
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
	
	
	public function redirectToFacebook() {
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


	public function doFacebookRestLogin()
	{
		$access_token = Input::get('access_token');

		$return_object = FacebookService::manageToken($access_token);
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'no_user_related':
					return Utils::create_json_response("error", 500, 'internal server error', 'a facebook profile already exists but it is not related to any user', Input::get('access_token'));
				case 'token_status_error':
					return Utils::create_json_response("error", 400, 'token status = error', null,  Input::get('access_token'));
				case 'invalid_token':
					return Utils::create_json_response("error", 400, 'invalid_token', null,  Input::get('access_token'));
			    default:
			    	return Utils::create_json_response("error", 500, "internal server error: unknown return_error['message']", null, null);
			}
		}
		
		if ($return_object['status'] == 'success')
		{
			//FacebookService::createPost();
			$user = $return_object['data']['user'];
			$data =  array('user_id' => $user->id,
						   'token' => $user->api_token,
						   'user' => $user->toArray()
						  );
			return Utils::create_json_response("success", 200, 'successful login', null, $data);
		}
		
		return Utils::create_json_response("error", 500, "internal server error: return status is neither error nor success", null, null);
	}
	
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}
	
	
}