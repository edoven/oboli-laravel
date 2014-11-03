<?php



use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\GraphUser;

require_once(app_path().'/utils.php');



class AuthController extends BaseController {


	public function doSignupWeb()
	{
		$data = Input::all();
		$return_object = AuthService::doSignup($data);
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
		elseif ($return_object['status'] == 'success')
		{
			$user = $return_object['data']['user'];			
			Auth::login($user);		
			Event::fire('auth.signup', array($user));	
			Event::fire('auth.signup.web');
			return Redirect::to('/');
			}		
		}
		else
			return 'Internal Server Error';		
	}


	public function doSignupRest()
	{
		$data = Input::all();
		$return_object = AuthService::doSignup($data);
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
					$data = array(
								'name'=>(Input::get('name')==null ? '' : Input::get('name')), 
								'email'=>(Input::get('email')==null ? '' : Input::get('email')),
								'errors' => array(
												  'name'=>$return_object['data']['validator']->messages()->first('name'), 
											      'email'=>$return_object['data']['validator']->messages()->first('email'),  
												  'password'=>$return_object['data']['validator']->messages()->first('password') 
												  ));
					return Utils::create_json_response('error', 400, 'error with credentials', 'missing or invalid credentials', $data);
				case 'account_exists':
					return Utils::create_json_response('error',400, 'a user with this email already exist', null, null);
				case 'facebook_account_exists':
					return Utils::create_json_response('error',400, 'a user with this email is already registered via facebook', null, null);
			    default:
			    	return Utils::create_json_response("error", 500, "internal server error", null, null);
			}
		}		
		elseif ($return_object['status'] == 'success')
		{
			Event::fire('auth.signup', array($return_object['data']['user']));
			return Utils::create_json_response('success', 200, 'An email was sent to '.Input::get('email').'. Please read it to activate your account.', null, array('email'=>Input::get('email')));		
		}	
		else		
			return Utils::create_json_response("error", 500, "internal server error", null, null);	
	}




	public function doLoginWeb()
	{
		$return_object = AuthService::doLogin(Input::all());
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
		    		$messageBag = new Illuminate\Support\MessageBag;
					$messageBag->add('error', 'error with credentials');
					return Redirect::to('/login')->withErrors($messageBag);
			    case 'unknown_email':
		    		$messageBag = new Illuminate\Support\MessageBag;
					$messageBag->add('error', 'unknwn_email');
					return Redirect::to('/login')->withErrors($messageBag);		    		
			    default:
			    		return 'Internal Server Error';	
			}
		}
		if ($return_object['status'] == 'success')
		{
			Event::fire('auth.login.web', array($return_object['data']['user']->id));
			return Redirect::to('/');
		}
		return 'Internal Server Error';	
	}



	public function doLoginRest()
	{
		$return_object = AuthService::doLogin(Input::all());
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
					$data = array(
							  'email'=>Input::get('email'),
							  'errors' => array(
												'email'=>$return_object['data']['validator']->messages()->first('email'),  
												'password'=>$return_object['data']['validator']->messages()->first('password') 
												)
							  );
					return Utils::create_json_response("error", 400, 'error with credentials', null, $data);
				case 'not_activated':
					return Utils::create_json_response("error", 400, 'account not yet confimed by email', null, null);	
				case 'wrong_credentials':
			    	return Utils::create_json_response("error", 400, 'error with credentials', null, null);
			    case 'unknown_email':
			    	return Utils::create_json_response("error", 400, 'unknown_email', null, null);	
			    default:
			    	return Utils::create_json_response("error", 500, "internal server error", null, null);
			}
		}
		if ($return_object['status'] == 'success')
		{
			$user = $return_object['data']['user'];
			$data =  array('user_id' => $user->id,
						   'token' => $user->api_token,
						   'user' => $user->toArray()
						  );
			//Event::fire('auth.login.web');
			return Utils::create_json_response("success", 200, 'successful login', null, $data);
		}
		return Utils::create_json_response("error", 500, "internal server error", null, null);
	}

		
	public function confirmEmail()
	{
		$email = Input::get('email');
		$confirmation_code = Input::get('confirmation_code');
		$return_object = AuthService::confirmEmail($email, $confirmation_code);

		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'data_missing':
					return "Error with the link: email or confirmation code missing.";
				case 'unknown_email':
					return 'Error: no user associated with '.$return_object['data']['email'].'.';
				case 'wrong_code':
					return 'Error: this confirmation code does not match with the one we sent you!';
			    default:
			    	return 'Internal Server Error. '.$return_object['message'];	
			}
		}
		elseif ($return_object['status'] == 'success')
		{
			Auth::loginUsingId($return_object['data']['user']->id);
			return Redirect::to('/');
		}
		else
			return 'Internal Server Error. '.$return_object['message'];		
	}


	// public function confirmEmail()
	// {
	// 	$email = Input::get('email');
	// 	$confirmation_code = Input::get('confirmation_code');
	// 	$return_object = AuthService::confirmEmail($email, $confirmation_code);

	// 	if ($return_object['status'] == 'error')
	// 	{
	// 		switch ($return_object['message']) 
	// 		{
	// 			case 'data_missing':
	// 				if (Request::is("api/*"))
	// 					return Utils::create_json_response("error", 400, 'missing data', null, null);
	// 				else
	// 		    		return "Error with the link: email or confirmation code missing.";
	// 			case 'unknown_email':
	// 				if (Request::is("api/*"))
	// 					return Utils::create_json_response("error", 400, 'unknown_email', null, $return_object['data']);
	// 				else
	// 					return 'Error: no user associated with '.$return_object['data']['email'].'.';
	// 			case 'wrong_code':
	// 				if (Request::is("api/*"))
	// 					return Utils::create_json_response("error", 400, 'wrong_confirmation_code', null, null);
	// 				else
	// 		    		return 'Error: this confirmation code does not match with the one we sent you!';
	// 		    default:
	// 		    	if (Request::is("api/*"))
	// 					return Utils::create_json_response("error", 500, 'internal server error: unknown return_object[message]', null, null);
	// 				else
	// 		    		return 'Internal Server Error. '.$return_object['message'];	
	// 		}
	// 	}
	// 	if ($return_object['status'] == 'success')
	// 	{
	// 		Auth::loginUsingId($return_object['data']['user']->id);
	// 		if (Request::is("api/*"))
	// 			return Utils::create_json_response("success", 200, 'account confirmed', null, null);
	// 		else
	// 			return Redirect::to('/');
	// 	}
		
	// 	if (Request::is("api/*"))
	// 		return Utils::create_json_response("error", 500, 'internal server error: return_object status error', null, null);
	// 	else
	// 		return 'Internal Server Error. '.$return_object['message'];		
	// }
	
		
	
	public function doLogout()
	{
		Session::flush();
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}
	
	
}