<?php

include_once app_path().'/utils.php';

class AuthRestController extends BaseController {

	
	public function doSignup()
	{
		$return_object = AuthService::doSignup();
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
													  )
									);
					return Utils::create_json_response('error', 
												400, 
												'error with credentials', 
												'there are some missing or malformed credentials, see at errors for more details',
												$data);
				case 'account_exists':
			    	return Utils::create_json_response('error',400, 'a user with this email already exist', null, null);
				case 'facebook_account_exists':
					return Utils::create_json_response('error',400, 'a user with this email is already registered via facebook', null, null);
				default:
			    	return Utils::create_json_response("error", 500, "internal server error", null, null);
			}
		}
		
		if ($return_object['status'] == 'success')
			return Utils::create_json_response('success',200, 'An email was sent to '.Input::get('email').'. Please read it to activate your account.', null, array('email'=>Input::get('email')));
		else
			return Utils::create_json_response("error", 500, "internal server error", null, null);
	}



	public function doLogin()
	{
		$return_object = AuthService::doSignup();
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
					$data = array(
								  'email'=>Input::get('email'),
								  'errors' => array(
													'email'=>$validator->messages()->first('email'),  
													'password'=>$validator->messages()->first('password') 
													)
								  );
					return Utils::create_json_response("error", 400, 'error with credentials', null, $data);
				case 'not_activated':
					return Utils::create_json_response("error", 400, 'account not yet confimed by email', null, null);
				case 'wrong_credentials':
			    	return Utils::create_json_response("error", 400, 'error with credentials', null, null);
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
			return Utils::create_json_response("success", 200, 'successful login', null, $data);
		}
		
		return Utils::create_json_response("error", 500, "internal server error", null, null);
	}
	
	
		
		
	public function doFacebookLogin()
	{
		$access_token = Input::get('access_token');

		$return_object = FacebookService::manageToken($access_token);
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'no_user_related':
					return Utils::create_json_response("error", 500, 'internal server error', 'a facebook profile already exists but it is not related to any user', array('access_token'=>$access_token));
				case 'token_status_error':
					return Utils::create_json_response("error", 400, 'token status = error', null,  array('access_token'=>$access_token));
			    default:
			    	return Utils::create_json_response("error", 500, "internal server error", null, null);
			}
		}
		
		if ($return_object['status'] == 'success')
		{
			FacebookService::createPost();
			$user = $return_object['data']['user'];
			$data =  array('user_id' => $user->id,
						   'token' => $user->api_token,
						   'user' => $user->toArray()
						  );
			return Utils::create_json_response("success", 200, 'successful login', null, $data);
		}
		
		return Utils::create_json_response("error", 500, "internal server error", null, null);
	}

	
}
