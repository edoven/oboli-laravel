<?php

include_once app_path().'/utils.php';

class AuthRestController extends BaseController {

	
	public function doSignup()
	{
		$input = array(
						'name'     => Input::get('name'),
						'email'    => Input::get('email'),
						'password' => Input::get('password')
						);
		$rules = array(
						'name'     => 'required|alphaNum',
						'email'    => 'required|email',
						'password' => 'required|alphaNum|min:5'
						);
		$validator = Validator::make($input, $rules);
		if ($validator->fails()) 
			return Response::json(array(
						'status' => 'error',
						'code' => '200',
						'message' => 'unauthorized request',
						'message_verbose' => 'there are some missing or malformed credentials, see at errors for more details',
						'data' => array(
									'name'=>Input::get('name'), 
									'email'=>Input::get('email')
									),
						'errors' => array(
									'name'=>$validator->messages()->first('name'), 
									'email'=>$validator->messages()->first('email'),  
									'password'=>$validator->messages()->first('password') 
									),
						200)
					);
		if (User::where('email', Input::get('email'))->first() != Null)
		{
			$id = User::where('email', Input::get('email'))->first()->id;
			if (FacebookProfile::where('user_id', $id)->first() == Null)
				return Response::json(array(
						'status' => 'error',
						'code' => '200',
						'message' => 'a user with this email already exist'
						),
						200
					);
			else //a facebook account connected with this email already exist
			{
				return Response::json(array(
						'status' => 'error',
						'code' => '200',
						'message' => 'a user with this email already registered via facebook'
						),
						200
					);
			}
		}					
		$confirmation_code = str_random(45);
		$api_token = str_random(60);
		//create a new user
		$user = new User;
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->oboli_count = 0;
		$user->confirmation_code = $confirmation_code;
		$user->confirmed = 0; //email has not been confirmed yet
		$user->api_token = $api_token;
		$user->facebook_profile = 0;
		$user->save();	
		
		//$this->sendConfirmationEmail(Input::get('name'), Input::get('email'), $confirmation_code);	
		(new Utils)->sendConfirmationEmail(Input::get('name'), Input::get('email'), $confirmation_code);	
		return Response::json(array(
						'status' => 'success',
						'code' => '200',
						'message' => 'An email was sent to '.Input::get('email').'. Please read it to activate your account.'
						),
						200
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
						'code' => '200',
						'message' => 'unauthorized request',
						'data' => array(
									'email'=>Input::get('email')
									),
						'errors' => array(
									'email'=>$validator->messages()->first('email'),  
									'password'=>$validator->messages()->first('password') 
									),
						),
						200
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
								'code' => '200',
								'message' => 'email not activated'
											),
						200
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
						'code' => '200',
						'message' => 'error with credentials'
									),
						200
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
						'message' => 'Internal Server Error. A facebook_profiles related with this token exist but the is no relation with an existing user.'),
						400
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
