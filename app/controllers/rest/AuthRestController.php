<?php



require_once(app_path().'/utils.php');



class AuthRestController extends BaseController {



	public function doSignup()
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
					return Utils::create_json_response('error',400, 'a user with this email already exist', null, array());
				case 'facebook_account_exists':
					return Utils::create_json_response('error',400, 'a user with this email is already registered via facebook', null, array());
			    default:
			    	return Utils::create_json_response("error", 500, "internal server error", null, array());
			}
		}		
		elseif ($return_object['status'] == 'success')
		{
			Event::fire('auth.signup', array($return_object['data']['user']));
			$user = $return_object['data']['user'];
			$data =  array('user_id' => $user->id,
						   'token' => $user->api_token,
						   'user' => $user->toArray(),
						   'email' => $user->email
						  );
			
			return Utils::create_json_response('success', 200, 'An email was sent to '.Input::get('email').'. Please read it to activate your account.', null, $data);		
		}	
		else		
			return Utils::create_json_response("error", 500, "internal server error", null, array());	
	}


	public function doLogin()
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
					return Utils::create_json_response("error", 400, 'account not yet confimed by email', null, array());	
				case 'wrong_credentials':
			    	return Utils::create_json_response("error", 400, 'error with credentials', null, array());
			    case 'unknown_email':
			    	return Utils::create_json_response("error", 400, 'unknown_email', null, array());	
			    default:
			    	return Utils::create_json_response("error", 500, "internal server error", null, array());
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
		return Utils::create_json_response("error", 500, "internal server error", null, array());
	}

	
}