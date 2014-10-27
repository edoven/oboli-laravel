<?php

class AuthRestControllerTest extends TestCase {

	/**
	 * SETUP
	 */
	public function setUp()
	{
		parent::setUp();
		$this->prepareForTests();
	}
	 
  
	private function prepareForTests()
	{
		//Artisan::call('migrate');
	}
	/**
	 * SETUP - end
	 */
	
	

	
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

	public function testRestSignupWithValidData()
	{
		$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
		$email ='test123@domain.com';
		$name = 'gigi';
		$password = '01234567';
		$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);


		$return = Utils::createCurlPostCall($url, $data);
		$return_object = json_decode($return);
		echo var_dump($return_object);
		$this->assertTrue($return_object->status=='success');
		$this->assertTrue($return_object->code=='200');
		
	}




	// public function testRestSignupWithValidData()
	// {
	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
	// 	$email ='test6@domain.com';
	// 	$name = 'edoardo';
	// 	$password = '01234567';

	// 	User::where('email', $email)->delete();
	// 	$this->assertTrue(User::where('email', $email)->first() == null);

	// 	$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);
	// 	$return = Utils::createCurlPostCall($url, $data);
	// 	$return_object = json_decode($return);

	// 	//$this->assertTrue(User::where('email', $email)->first() != null);

	// 	$this->assertTrue($return_object->status == 'success');
	// 	$this->assertTrue($return_object->code == '200');
	// 	$this->assertTrue($return_object->message == 'An email was sent to '.$email.'. Please read it to activate your account.');
	// 	echo var_dump($return_object->data);
	// }

	// public function testRestSignupWithValidData()
	// {
	// 	$url = Config::get('local-config')['https_host'].'/api/v0.1/signup';
	// 	$email ='hgjbgkofdfhkkjhi@domain.com';
	// 	$name = 'edoardo';
	// 	$password = '01234';

	// 	User::where('email', $email)->delete();
	// 	$this->assertTrue(User::where('email', $email)->first() == null);

	// 	$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);
	// 	$return = Utils::createCurlPostCall($url, $data);
	// 	$return_object = json_decode($return);

	// 	echo '------->'.$return_object->message;
	// 	$this->assertTrue($return_object->status == 'success');
	// 	$this->assertTrue($return_object->code == '200');

	// 	$user = User::where('email', $email)->first();
	// 	echo '--->'.var_dump($user);
	// 	//$this->assertTrue($user != null);

		
	// 	$this->assertTrue($user->name == $name);
	// 	$this->assertTrue($user->password == Hash::make($password));
	// 	$user->delete();
	// 	$this->assertTrue(User::where('email', $email)->first() == null);
	// }
	

}
