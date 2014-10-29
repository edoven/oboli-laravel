<?php

class AuthControllerTest extends TestCase {

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
	 *  WEB LOGIN
	 *
	 */
	public function testMailIsRequiredForLogin()
	{
		$this->flushSession();
		$login_data = array('password'=>'password');
		$response = $this->call('POST', 'login', $login_data);
		$this->assertRedirectedTo('/login');
		$this->assertSessionHas('errors');	
		$errors = Session::get('errors')->toArray();
		//echo 'testMailIsRequiredForLogin ---> '.$errors['email'][0];
		$this->assertTrue($errors['email'][0] == 'The email field is required.');	
		$this->assertFalse($this->client->getResponse()->isOk());	
	}
	
	public function testPasswordIsRequiredForLogin()
	{
		$this->flushSession();
		$login_data = array('email'=>'name@domain.com',
							'name'=>'username');
		$response = $this->call('POST', 'login', $login_data);
		$this->assertRedirectedTo('/login');
		$this->assertSessionHas('errors');		
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['password'][0] == 'The password field is required.');
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	

	// public function testLoginWithCorrectDataForLogin()
	// {
	// 	$this->flushSession();
	// 	$email = 'user1@domain.com';
	// 	$data = array('name'=>'user1', 'email'=>$email, 'password'=>'password');
	// 	User::create($data);

	// 	$response = $this->call('POST', 'login', $data);
	// 	$this->assertTrue($this->client->getResponse()->isOk());

	// 	User::where('email',$email)->delete();
	// }


	/*
	 *
	 *  WEB SIGNUP
	 *
	 */
	public function testNameIsRequiredForSignup()
	{
		$this->flushSession();
		$signup_data = array('email'=>'name@domain.com', 
							 'password'=>'password');	
		$response = $this->call('POST', 'signup', $signup_data);
		$this->assertRedirectedTo('/signup/email');
		$this->assertSessionHas('errors');	
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['name'][0] == 'The name field is required.');
		$this->assertFalse($this->client->getResponse()->isOk());	
	}
	
	public function testMailIsRequiredForSignup()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'password'=>'password');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertRedirectedTo('/signup/email');
		$this->assertSessionHas('errors');
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['email'][0] == 'The email field is required.');
		$this->assertFalse($this->client->getResponse()->isOk());	
	}
	
	public function testPasswordIsRequiredForSignup()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertRedirectedTo('/signup/email');
		$this->assertSessionHas('errors');	
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['password'][0] == 'The password field is required.');	
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	
	public function testPasswordHasToBeLongerThanFourCharsForSignup()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcd');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertRedirectedTo('/signup/email');
		$this->assertSessionHas('errors');	
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['password'][0] == 'The password must be at least 5 characters.');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}

	public function testPasswordCannotContainStrangeCharsForSignup()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abc_def');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertRedirectedTo('/signup/email');
		$this->assertSessionHas('errors');	
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['password'][0] == 'The password may only contain letters and numbers.');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	
	// public function testSigninWithCorrectData()
	// {
	// 	$this->flushSession();
	// 	$signin_data = array('name'=>'name', 
	// 						 'email'=>'name@domain.com',
	// 						 'password'=>'abcde');
	// 	$response = $this->call('POST', 'signup', $signin_data);
	// 	$this->assertTrue($this->client->getResponse()->isOk());
	// }

	public function testSignupWithCorrectDataRedirectAndSession()
	{
		$this->flushSession();
		$signup_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcde');
		$response = $this->call('POST', 'signup', $signup_data);
		$this->assertTrue($this->client->getResponse()->isOk());
		$this->assertRedirectedTo('/');
		$this->assertSessionHas('activated');	
		$this->assertSessionHas('obolis');
	}


	

}
