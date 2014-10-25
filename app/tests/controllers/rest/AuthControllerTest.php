<?php

class AuthControllerRestTest extends TestCase {

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
		$url = 'https://edoventurini.com/api/v0.1/signup';
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
		$url = 'https://edoventurini.com/api/v0.1/signup';
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
		$url = 'https://edoventurini.com/api/v0.1/signup';
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
		$url = 'https://edoventurini.com/api/v0.1/signup';
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
		$url = 'https://edoventurini.com/api/v0.1/signup';
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
		$url = 'https://edoventurini.com/api/v0.1/signup';
		$email ='name@domain.com';
		$name = 'edoardo';
		$data = array('name'=>$name, 'email'=>$email, 'password'=>'01_23');
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

	// public function testAccountExistsForRestSignup()
	// {
	// 	$user = User::where('email', 'name@domain.com')->delete();
	// 	//echo $user->name;

	// 	$url = 'https://edoventurini.com/api/v0.1/signup';
	// 	$data = array('name'=>'edoardo', 'email'=>'name@domain.com', 'password'=>'01234');
	// 	$return1 = Utils::createCurlPostCall($url, $data);
	// 	$return_object1 = json_decode($return1);

	// 	$return2 = Utils::createCurlPostCall($url, $data);
	// 	$return_object2 = json_decode($return2);

	// 	echo $return1;
	// 	$this->assertTrue($return_object1->status=='success');
	// 	$this->assertTrue($return_object1->code=='200');

	// 	echo $return2;
	// 	$this->assertTrue($return_object2->status=='error');
	// 	$this->assertTrue($return_object2->code=='400');
	// 	$this->assertTrue($return_object2->message=='a user with this email already exist');
		
	// }
	
	
	
	// public function testMailHasToBeLongerThanFourCharsForSignup()
	// {
	// 	$this->flushSession();
	// 	$signin_data = array('name'=>'name', 
	// 						 'email'=>'name@domain.com',
	// 						 'password'=>'abcd');
	// 	$response = $this->call('POST', 'signup', $signin_data);
	// 	$this->assertRedirectedTo('/signup/email');
	// 	$this->assertSessionHas('errors');		
	// 	$this->assertFalse($this->client->getResponse()->isOk());
	// }
	
	// public function testSigninWithCorrectData()
	// {
	// 	$this->flushSession();
	// 	$signin_data = array('name'=>'name', 
	// 						 'email'=>'name@domain.com',
	// 						 'password'=>'abcde');
	// 	$response = $this->call('POST', 'signup', $signin_data);
	// 	$this->assertTrue($this->client->getResponse()->isOk());
	// }
	

}
