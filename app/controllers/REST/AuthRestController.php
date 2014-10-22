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
									'name'=>Input::get('name'), 
									'email'=>Input::get('email')
									'errors' => array(
													  'name'=>$return_object['data']['validator']->messages()->first('name'), 
												      'email'=>$return_object['data']['validator']->messages()->first('email'),  
													  'password'=>$return_object['data']['validator']->messages()->first('password') 
													  )
									)
					return Utils::create_json_response('error', 
												400, 
												'error with credentials', 
												'there are some missing or malformed credentials, see at errors for more details',
												$data);
				case 'account_exists':
			    	return Utils::create_json_response('error',400, 'a user with this email already exist', null, null);
				case 'facebook_account_exists':
			    	return Response::json(array(
						'status' => 'error',
						'code' => '400',
						'message' => 'a user with this email is already registered via facebook'
						),
						400
					);
			}
		}
		elseif ($return_object['status'] == 'success')
		{
			return Response::json(array(
						'status' => 'success',
						'code' => '200',
						'message' => 'An email was sent to '.Input::get('email').'. Please read it to activate your account.'
						),
						200
					);
		}
		else
			return Response::json(array(
						'status' => 'error',
						'code' => '500',
						'message' => 'return_object[\'status\'] is neither success or error.'
						),
						500
					);


	}
	
	
	public function doLogin()
	{
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Response::json(array(
						'status' => 'error',
						'code' => '400',
						'message' => 'error with credentials',
						'data' => array(
									'email'=>Input::get('email')
									),
						'errors' => array(
									'email'=>$validator->messages()->first('email'),  
									'password'=>$validator->messages()->first('password') 
									),
						),
						400
					);
		}
		$userdata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
		);
		if (Auth::attempt($userdata))
		{
			$user = Auth::user();	
			//se l'utente si è collegato con facebook non gli faccio fare l'attivazione tramite email
			if ($user->confirmed==0 && FacebookProfile::where('uid',  $user->id)->first()==null)
			{
					Auth::logout();
					return Response::json(array(
								'status' => 'error',
								'code' => '400',
								'message' => 'account not yet confimed by email'),
								400
					);
			}
			return Response::json(array(
						'status' => 'success',
						'code' => '200',
						'user_id' => $user->id,
						'token' => $user->api_token,
						'user' => $user->toArray()
						),
						200
					);
		}
		else 
			return Response::json(array(
						'status' => 'error',
						'code' => '400',
						'message' => 'error with credentials'
									),
						400
					);
	}
	
		
	public function doFacebookLogin()
	{
		$access_token = Input::get('access_token');
		$facebook_profile = FacebookProfile::where('access_token', $access_token)->first();
		
		//if this token already exists just acts as a normal login 
		if ($facebook_profile!=null)
		{
			/*
			 * TODO: CHECK IF THE TOKEN IS VALID OR IS EXPIRED
			 */
			$user = User::where('id', $facebook_profile->user_id)->first();
			if ($user == null)
				return Response::json(array(
						'status' => 'error',
						'code' => '500',
						'message' => 'Internal Server Error. A facebook_profiles related with this token exist but there is no relation with an existing user.'),
						500
						);
			return Response::json(array(
						'status' => 'success',
						'code' => '200',
						'user_id' => $user->id,
						'token' => $user->api_token,
						'user' => $user->toArray()
						),
						200
					);
		}
		//let's verify the token
		$token_status = AuthService::verifyFacebookToken($access_token);
		if ($token_status['status'] == 'error')
			return Response::json(array(
						'status' => 'error',
						'code' => '400',
						'message' => $token_status['message']),
						400
						);						
		//let's create the facebook_profile and the user (if it does not yet exist)			
		$facebook_user_info = AuthService::getUserInfoFromToken($access_token);
		$user = User::where('email', $facebook_user_info['email'])->first(); 
		if ($user == null)
			$user = AuthService::createConfirmedUser($facebook_user_info['email'], $facebook_user_info['name']);
		AuthService::createFacebookProfile($user->id, $facebook_user_info['id'], $access_token);
		return Response::json(array(
						'status' => 'success',
						'code' => '200',
						'user_id' => $user->id,
						'token' => $user->api_token,
						'user' => $user->toArray()
						),
						200
					);	
	}

	
}
