<?php



class AuthWebController extends BaseController {


	public function doSignup()
	{
		Log::info('AuthController::doSignup', array('email'=>Input::get('email')) );

		$data = Input::all();
		$return_object = AuthService::doSignup($data);
		Log::info('AuthController::doSignupWeb', array('return_object'=>$return_object) );
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
			    	return Redirect::back()->with('signup-errors', $return_object['data']['validator']->messages())
			    										->with('input', Input::all());
				case 'account_exists':
					$errors = new Illuminate\Support\MessageBag( array('account' => 'un account associato a questa email gia esiste') );
					return Redirect::back()->with('signup-errors', $errors)
			    										->with('input', Input::all());
				case 'facebook_account_exists':
					$errors = new Illuminate\Support\MessageBag( array('account' => 'un account associato a questa email gia esiste') );
					return Redirect::back()->with('signup-errors', $errors)
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


	

	public function doLogin()
	{
		Log::info('AuthController::doLoginWeb', array('email'=>Input::get('email')) );
		$return_object = AuthService::doLogin(Input::all());
		Log::info('AuthController::doLoginWeb', array('return_object'=>$return_object) );
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'validator_error':
			    	return Redirect::back()->with('login-errors', $return_object['data']['validator']->messages())->withInput($return_object['data']['input']);
				case 'wrong_credentials':
		    		$messageBag = new Illuminate\Support\MessageBag;
					$messageBag->add('error', 'error with credentials');
					return Redirect::back()->with('login-errors', $messageBag);
			    case 'unknown_email':
		    		$messageBag = new Illuminate\Support\MessageBag;
					$messageBag->add('error', 'nessun account associato a questa email');
					return Redirect::back()->with('login-errors', $messageBag);		    		
			    default:
			    	return Redirect::to('error')->withMessage('Internal Server Error');	
			}
		}
		if ($return_object['status'] == 'success')
		{
			Event::fire('auth.login.web', array($return_object['data']['user']->id));
			return Redirect::back();
		}
		return Redirect::to('error')->withMessage('Internal Server Error');
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


	
	public function doLogout()
	{
		if (!Auth::guest())
		{
			Log::info('AuthController::doLogout', array('user_email'=>Auth::user()->email) );
			Session::flush();
			Auth::logout();
		}		
		return Redirect::to('/');
	}
	
	
}