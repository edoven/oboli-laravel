
	
<?php

class SigninController extends BaseController {

	public function showSignin() 
	{ 
		return View::make('signin'); 
	}


	private function userExists($email)
	{
		$user = User::where('email' , '=', $email)->first();
		if ($user==Null)
			return false;
		else
			return true;			
	}

	private function createNewUser($name, $email, $password, $confirmation_code)
	{
		if ($this->userExists($email))
			return 0; //ERROR
		else
		{
			$user = new User;
			$user->name = $name;
			$user->email = $email;
			$user->password = $password;
			$user->oboli_count = 0;
			$user->confirmation_code = $confirmation_code;
			$user->confirmed = 0;
			$user->save();
			return 1;
		}			
	}
	
	
	public function doSignin()
	{
		$rules = array(
			'name'    => 'required|alphaNum',
			'email'    => 'required|email',
			'password' => 'required|alphaNum|min:5'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) 
			return Redirect::to('/signin')->withErrors($validator)->withInput(Input::except('password'));

		$confirmation_code = $this->createRandomString(45);
		$result = $this->createNewUser(Input::get('name'), Input::get('email'), Input::get('password'), $confirmation_code);
		if ($result == 0)
			#return Redirect::to('/signin')->with('message', 'user already exist');
			return "account associated with ".Input::get('email')." already exists";
		else
		{
			$messageData = array(
				'title' => 'Email',
				'name' => Input::get('name'),
				'link' => 'http://edoventurini.com/signin/confirm?email='.Input::get('email').'&confirmation_code='.$confirmation_code
			);	
			Mail::send('emails.confirmation', $messageData, function($message)
			{
				$message->to('edoardo.venturini@gmail.com')->subject('mailgun laraver');
			});
			return 'An email was sent to '.Input::get('email').'. Please read it to confirm your account.';
		}
			

		 #Mail::send('emails.test', [], function($message)
		#{
		#	$message->to('edoardo.venturini@gmail.com', 'John Smith')->subject('test!');
		#});
	}
	
	private function createRandomString($length)
	{
		return substr(str_shuffle(md5(time())),0,$length);
	}
	
	public function confirmEmail()
	{
		$email = Input::get('email');
		$confirmation_code = Input::get('confirmation_code');
		//if ($email == null ....) CHECK!
		$user = User::where('email' , '=', $email)->first();
		//if CHECK
		if ($user->getConfirmationCode() == $confirmation_code)
		{
			$user->confirmed = 1;
			$user->save();
			return "email confirmed!";
		}
		else
			return "error";
		
	}
	
	
	
	
}
