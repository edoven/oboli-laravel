
	
<?php

class SigninController extends BaseController {

//	private function createRandomString($length)
//	{
//		return substr(str_shuffle(md5(time())),0,$length);
//	}
	
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

	private function userExists($email)
	{
		$user = User::where('email' , '=', $email)->first();
		if ($user!=Null)
			return true;
		else
			return false;			
	}

	private function createNewUnconfimedUser($name, $email, $password, $confirmation_code)
	{
		if ($this->userExists($email))
			throw new Exception('This email is already associated with an account!'); //TODO: create custom exception
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->password = $password;
		$user->oboli_count = 0;
		$user->confirmation_code = $confirmation_code;
		$user->confirmed = 0; //email has not been confirmed yet
		$user->save();		
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

		$confirmation_code = str_random(45);
		try 
		{
			$this->createNewUnconfimedUser(Input::get('name'), Input::get('email'), Input::get('password'), $confirmation_code);
		}
		catch (Exception $e)
		{
			return "An account associated with ".Input::get('email')." already exists";
		}
		$this->sendConfirmationEmail(Input::get('name'),Input::get('email'), $confirmation_code);		
		return 'An email was sent to '.Input::get('email').'. Please read it to confirm your account.';
	}
		
	public function confirmEmail()
	{
		$email = Input::get('email');
		$confirmation_code = Input::get('confirmation_code');
		if (($email == Null) or ($confirmation_code == Null))
			return "Error with the link: email or confirmation code missing.";
		$user = User::where('email' , '=', $email)->first();
		if ($user == Null)
			return 'Error: no user associated with '.$email.'.';
		if ($user->getConfirmationCode() == $confirmation_code)
		{
			$user->confirmed = 1;
			$user->save();
			return "Great! Your account has been activated!";
		}
		else
			return 'Error: no user associated with '.$user.'.';
	}
	
	
	
	
}
