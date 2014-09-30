<?php

class AuthRestController extends BaseController {

	
	//TODO: check if the email is sent
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
						'code' => '400',
						'message' => 'unauthorized request',
						'errors' => array(
									'name'=>$validator->messages()->first('name'), 
									'email'=>$validator->messages()->first('email'),  
									'password'=>$validator->messages()->first('password') 
									),
						400)
					);
		if (User::where('email', Input::get('email'))->first() != Null)
		{
			$id = User::where('email', Input::get('email'))->first()->id;
			if (FacebookProfile::where('user_id', $id)->first() == Null)
				return Response::json(array(
						'status' => 'error',
						'code' => '400',
						'message' => 'a user with this email already exist'
						),
						400
					);
			else //a facebook account connected with this email already exist
			{
				return Response::json(array(
						'status' => 'error',
						'code' => '400',
						'message' => 'a user with this email already registered via facebook'
						),
						400
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
		
		$this->sendConfirmationEmail(Input::get('name'), Input::get('email'), $confirmation_code);		
		return Response::json(array(
						'status' => 'success',
						'code' => '200',
						'user_id' => $user->id,
						'api_token' => $api_token,
						'message' => 'An email was sent to '.Input::get('email').'. Please read it to activate your account.'
						),
						400
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
			return Redirect::to('/login')->withErrors($validator)->withInput(Input::except('password'));
		$userdata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
		);
		if (Auth::attempt($userdata))
		{
			$user = Auth::user();	
			//se l'utente si è collegato con facebook non gli faccio fare l'attivazione tramite email
			if ($user->confirmed==0)
			{
				$facebook_profile=FacebookProfile::where('uid',  $user->id)->first();
				if ($facebook_profile==Null)
				{
					Auth::logout();
					return "You have not activated your account, please check the email we have sent.";
				}			
			}
			return Redirect::to('/');
		}
		else 
			echo 'error with credentials';
	}
	
	
	public function doLoginWithFacebook() {
		$facebook = new Facebook(Config::get('facebook'));
		$params = array(
			'redirect_uri' => url('/login/fb/callback'),
			'scope' => 'email',
		);
		return Redirect::to($facebook->getLoginUrl($params));
	}

	
}
