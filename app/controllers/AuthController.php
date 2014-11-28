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
		Log::info('AuthController::doSignupWeb', array('email'=>Input::get('email')) );

		$data = Input::all();
		$return_object = AuthService::doSignup($data);
		Log::info('AuthController::doSignupWeb', array('return_object'=>$return_object) );
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
			    	return Redirect::to('/signup/email')->withErrors($return_object['data']['validator'])
			    										->with('input', Input::all());
				case 'account_exists':
					$errors = new Illuminate\Support\MessageBag( array('account' => 'un account associato a questa email gia esiste') );
					return Redirect::to('/signup/email')->withErrors($errors)
			    										->with('input', Input::all());
				case 'facebook_account_exists':
					$errors = new Illuminate\Support\MessageBag( array('account' => 'un account associato a questa email gia esiste') );
					return Redirect::to('/signup/email')->withErrors($errors)
			    										->with('input', Input::all());
			    default:
			    	return Redirect::to('error')->withMessage('Internal Server Error');
			}
		}		
		elseif ($return_object['status'] == 'success')
		{
			$user = $return_object['data']['user'];			
			Auth::login($user);		
			Event::fire('auth.signup', array($user));	
			Event::fire('auth.signup.web');
			return Redirect::to('/signup/success');	
		}
		else
			return Redirect::to('error')->withMessage('Internal Server Error');	
	}


	public function doSignupRest()
	{
		Log::info('AuthController::doSignupRest', array('email'=>Input::get('email')) );

		$data = Input::all();
		$return_object = AuthService::doSignup($data);
		Log::info('AuthController::doSignupRest', array('return_object'=>$return_object) );
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
		Log::info('AuthController::doLoginWeb', array('email'=>Input::get('email')) );
		$return_object = AuthService::doLogin(Input::all());
		Log::info('AuthController::doLoginWeb', array('return_object'=>$return_object) );
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
			    	return Redirect::to('/login')->withErrors($return_object['data']['validator'])
			    								 ->withInput($return_object['data']['input']);
				// case 'not_activated':
				// 	Auth::logout();
				// 	return "Error: you have not activated your account. Please check your email account.";
				case 'wrong_credentials':
		    		$messageBag = new Illuminate\Support\MessageBag;
					$messageBag->add('error', 'error with credentials');
					return Redirect::to('/login')->withErrors($messageBag);
			    case 'unknown_email':
		    		$messageBag = new Illuminate\Support\MessageBag;
					$messageBag->add('error', 'nessun account associato a questa email');
					return Redirect::to('/login')->withErrors($messageBag);		    		
			    default:
			    	return Redirect::to('error')->withMessage('Internal Server Error');	
			}
		}
		if ($return_object['status'] == 'success')
		{
			Event::fire('auth.login.web', array($return_object['data']['user']->id));
			return Redirect::to('/');
		}
		return Redirect::to('error')->withMessage('Internal Server Error');
	}



	public function doLoginRest()
	{
		Log::info('AuthController::doLoginRest', array('email'=>Input::get('email')) );
		$return_object = AuthService::doLogin(Input::all());
		Log::info('AuthController::doLoginRest', array('return_object'=>$return_object) );
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
		Log::info('AuthController::confirmEmail', array('email'=>Input::get('email')) );
		$email = Input::get('email');
		$confirmation_code = Input::get('confirmation_code');
		$return_object = AuthService::confirmEmail($email, $confirmation_code);

		Log::info('AuthController::confirmEmail', array('return_object'=>$return_object) );

		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'data_missing':
					Redirect::to('/error')->withMessage('Error with the link: email or confirmation code missing.');
				case 'unknown_email':
					Redirect::to('/error')->withMessage('no user associated with '.$return_object['data']['email'].'.');
				case 'wrong_code':
					Redirect::to('/error')->withMessage('Error: this confirmation code does not match with the one we sent you!');
			    default:
			    	Log::warning('AuthController::confirmEmail - Internal Server Error. Message: '.$return_object['message']);
			    	Redirect::to('/error')->withMessage('Internal Server Error.');
			}
		}
		elseif ($return_object['status'] == 'success')
		{
			Auth::loginUsingId($return_object['data']['user']->id);
			return Redirect::to('/');
		}
		else
		{
			Log::warning('AuthController::confirmEmail - Internal Server Error. Message: '.$return_object['message']);
			Redirect::to('/error')->withMessage('Internal Server Error.');
		}	
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
		if (!Auth::guest())
		{
			Log::info('AuthController::doLogout', array('user_email'=>Auth::user()->email) );
			Session::flush();
			Auth::logout();
		}		
		return Redirect::to('/login');
	}
	
	
}