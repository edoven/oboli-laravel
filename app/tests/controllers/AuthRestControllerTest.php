<?php

class AuthRestControllerTest extends TestCase {



	
	/*
	 *
	 *  SIGNUP
	 *
	 */
	public function testEmptyRequestForRestSignup()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$data = array();
		$return = Utils::createCurlPostCall($url, $data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->name=='');
		$this->assertTrue($return_object->data->email=='');
		$this->assertTrue($return_object->data->errors->name=='The name field is required.');
		$this->assertTrue($return_object->data->errors->email=='The email field is required.');
		$this->assertTrue($return_object->data->errors->password=='The password field is required.');
	}

	public function testMailIsRequiredForRestSignup()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$name = 'edoardo';
		$data = array('name'=>$name, 'password'=>'password');
		$return = Utils::createCurlPostCall($url, $data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->name==$name);
		$this->assertTrue($return_object->data->email=='');
		$this->assertTrue($return_object->data->errors->name=='');
		$this->assertTrue($return_object->data->errors->email=='The email field is required.');
		$this->assertTrue($return_object->data->errors->password=='');
	}


	public function testNameIsRequiredForRestSignup()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$email='name@domain.com';
		$data = array('email'=>$email, 'password'=>'password');
		$return = Utils::createCurlPostCall($url, $data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->name=='');
		$this->assertTrue($return_object->data->email==$email);
		$this->assertTrue($return_object->data->errors->name=='The name field is required.');
		$this->assertTrue($return_object->data->errors->email=='');
		$this->assertTrue($return_object->data->errors->password=='');
	}


	public function testPasswordIsRequiredForRestSignup()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$email ='name@domain.com';
		$name = 'edoardo';
		$data = array('name'=>$name, 'email'=>$email);
		$return = Utils::createCurlPostCall($url, $data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->name==$name);
		$this->assertTrue($return_object->data->email==$email);
		$this->assertTrue($return_object->data->errors->name=='');
		$this->assertTrue($return_object->data->errors->email=='');
		$this->assertTrue($return_object->data->errors->password=='The password field is required.');
	}

	public function testPasswordHasToBeLongerThanFourCharsForRestSignup()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$email ='name@domain.com';
		$name = 'edoardo';
		$data = array('name'=>$name, 'email'=>$email, 'password'=>'0123');
		$return = Utils::createCurlPostCall($url, $data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');		
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->name==$name);
		$this->assertTrue($return_object->data->email==$email);
		$this->assertTrue($return_object->data->errors->name=='');
		$this->assertTrue($return_object->data->errors->email=='');
		$this->assertTrue($return_object->data->errors->password=='The password must be at least 5 characters.');
	}

	public function testPasswordCannotContainsStrangeCharsForRestSignup()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$email ='name@domain.com';
		$name = 'gigi';
		$password = '01_34';
		$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);
		$return = Utils::createCurlPostCall($url, $data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->name==$name);
		$this->assertTrue($return_object->data->email==$email);
		$this->assertTrue($return_object->data->errors->name=='');
		$this->assertTrue($return_object->data->errors->email=='');
		$this->assertTrue($return_object->data->errors->password=='The password may only contain letters and numbers.');
	}


	public function testSignupWithCorrectData()
	{
		$email = 'testSignupWithCorrectData111@domain.com';
		$name = 'name';
		$password = 'password';

		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$signup_data = array('name'=>$name, 
							 'email'=>$email, 
							 'password'=>$password);

		$this->assertTrue(User::where('email', $email)->first() == null);

		$return = Utils::createCurlPostCall($url, $signup_data);
		$return_object = json_decode($return);

		Log::debug('AuthRestControllerTest::testSignupWithCorrectData', array($return_object) );

		$this->assertTrue($return_object->status == 'success');
		$this->assertTrue($return_object->code == '200');
		$this->assertTrue(User::where('email', $email)->first() != null);
	}


	/*
	 *    LOGIN
	 */
	public function testMailIsRequiredForLogin()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/login';
		$login_data = array('password'=>'password');
		$return = Utils::createCurlPostCall($url, $login_data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->errors->email=='The email field is required.');
	}
	
	public function testPasswordIsRequiredForLogin()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/login';
		$login_data = array('email'=>'email@domain.com');
		$return = Utils::createCurlPostCall($url, $login_data);
		$return_object = json_decode($return);
		$this->assertTrue($return_object->status=='error');
		$this->assertTrue($return_object->code=='400');
		$this->assertTrue($return_object->message=='error with credentials');
		$this->assertTrue($return_object->data->errors->password=='The password field is required.');
	}
	

	// public function testLoginWithCorrectData()
	// {
	// 	$email = 'testLoginWithCorrectData@domain.com';
	// 	$name = 'name';
	// 	$password = 'password';

	// 	$this->assertTrue(User::where('email', $email)->first() == null);
	// 	User::createUnconfirmedUser($email, $name, $password);
	// 	$this->assertTrue(User::where('email', $email)->first() != null);

	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/login';
	// 	$login_data = array('email'=>$email, 'password'=>$password);
	// 	$return = Utils::createCurlPostCall($url, $login_data);
	// 	$return_object = json_decode($return);
	// 	Log::debug('testLoginWithCorrectData', array($return_object) );
	// 	$this->assertTrue($return_object->status=='success');
	// 	$this->assertTrue($return_object->code=='200');
	// }

	// public function testLoginWithCorrectDataWithUserCreationThroughSignup()
	// {
	// 	$email = 'testLoginWithCorrectDataWithUserCreationThroughSignup@domain.com';
	// 	$name = 'name';
	// 	$password = 'password';

	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
	// 	$login_data = array('name'=>$name, 'email'=>$email, 'password'=>$password);
	// 	$return = Utils::createCurlPostCall($url, $login_data);
	// 	$return_object = json_decode($return);


	// 	Log::debug('AuthRestControllerTest::testLoginWithCorrectDataWithUserCreationThroughSignup', array($return_object) );

	// 	$this->assertTrue($return_object->status=='success');
	// 	$this->assertTrue($return_object->code=='200');

		

	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/login';
	// 	$login_data = array('email'=>$email, 'password'=>$password);
	// 	$return = Utils::createCurlPostCall($url, $login_data);
	// 	$return_object = json_decode($return);
		
	// 	$this->assertTrue($return_object->status=='success');
	// 	$this->assertTrue($return_object->code=='200');
	// }

	public function testLoginWithWrongData()
	{
		
	}


	/*
	 *    EMAIL CONFIRMATION
	 */
	
	// public function testConfirmEmailWithMissingData()
	// {
	// 	$email = 'test321@domain.com';
	// 	$this->assertTrue(User::where('email', $email)->first() == null);

	// 	User::createUnconfirmedUser($email, 'name', 'password');
	// 	$user = User::where('email', $email)->first();
	// 	$this->assertTrue($user != null);

	// 	$confirmation_code = $user->confirmation_code;
	// 	$this->assertTrue($confirmation_code != null);

	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/signup/confirm';
	// 	$data = array('email'=>$email);
	// 	$return = Utils::createCurlGetCall($url, $data);
	// 	$return_object = json_decode($return);
	// 	$this->assertTrue($return_object->status=='error');
	// 	$this->assertTrue($return_object->code=='400');
	// 	$this->assertTrue($return_object->message=='missing data');
	// }


	// public function testConfirmEmailWithUnknownEmail()
	// {
	// 	$email = 'unknown_mail@domain.com';
	// 	$confirmation_code = 'a_code';
	// 	$this->assertTrue(User::where('email', $email)->first() == null);
	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/signup/confirm?email='.$email.'&confirmation_code='.$confirmation_code;
	// 	$return = Utils::createCurlGetCall($url);
	// 	$return_object = json_decode($return);
	// 	$this->assertTrue($return_object->status=='error');
	// 	$this->assertTrue($return_object->code=='400');
	// 	$this->assertTrue($return_object->message=='unknown_email');
	// }


	// public function testConfirmEmailWithWrongCode()
	// {
	// 	$email = 'test654@domain.com';

	// 	$this->assertTrue(User::where('email', $email)->first() == null);
	// 	$user = User::createUnconfirmedUser($email, 'name', 'password');
	// 	$this->assertTrue(User::where('email', $email)->first() != null);
	// 	$this->assertTrue($user->confirmation_code != null);
	// 	$this->assertTrue($user->confirmed == 0);

	// 	$wrong_confirmation_code = 'a_wrong_code';
	// 	$this->assertTrue($user->confirmation_code != $wrong_confirmation_code);

	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/signup/confirm?email='.$email.'&confirmation_code='.$wrong_confirmation_code;
	// 	$this->assertTrue(User::where('email', $email)->first()->confirmed == 0);

	// 	$return = Utils::createCurlGetCall($url);
	// 	$return_object = json_decode($return);

	// 	$this->assertTrue(User::where('email', $return_object->data->email)->first() != null);

	// 	echo ':::::: test:'.App::environment().' ::::::';
	// 	echo ':::::: authservice:'.$return_object->data->environment.' ::::::';

	// 	$this->assertTrue($return_object->data->user != null);

	// 	$this->assertTrue($return_object->status=='error');
	// 	$this->assertTrue($return_object->code=='400');

	// 	echo '######## '.$return_object->message.' #######';

	// 	$this->assertTrue($return_object->message == 'wrong_confirmation_code');
	// }

}
