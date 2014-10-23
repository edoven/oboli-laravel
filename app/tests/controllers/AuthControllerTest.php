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
		Artisan::call('migrate');
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
		$this->assertFalse($this->client->getResponse()->isOk());	
	}
	
	public function testPasswordIsRequiredForLogin()
	{
		$this->flushSession();
		$login_data = array('email'=>'name@domain.com');
		$response = $this->call('POST', 'login', $login_data);
		$this->assertRedirectedTo('/login');
		$this->assertSessionHas('errors');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	

	public function testLoginWithCorrectDataForLogin()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcde');
		$response = $this->call('POST', 'login', $signin_data);
		$this->assertTrue($this->client->getResponse()->isOk());
	}


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
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	
	public function testMailHasToBeLongerThanFourCharsForSignup()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcd');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertRedirectedTo('/signup/email');
		$this->assertSessionHas('errors');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	
	public function testSigninWithCorrectData()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcde');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertTrue($this->client->getResponse()->isOk());
	}



	/*
	 *
	 *  REST SIGNUP
	 *
	 */
	public function testNameIsRequiredForRestSignup()
	{
		$url = 'https://edoventurini.com/api/v0.1/signup';
		$data = array();
		$return = Utils::createCurlPostCall($url, $data);
		$array = json_decode($return);
		echo $return;
	}
	
	// public function testMailIsRequiredForSignup()
	// {
	// 	$this->flushSession();
	// 	$signin_data = array('name'=>'name', 
	// 						 'password'=>'password');
	// 	$response = $this->call('POST', 'signup', $signin_data);
	// 	$this->assertRedirectedTo('/signup/email');
	// 	$this->assertSessionHas('errors');	
	// 	$this->assertFalse($this->client->getResponse()->isOk());	
	// }
	
	// public function testPasswordIsRequiredForSignup()
	// {
	// 	$this->flushSession();
	// 	$signin_data = array('name'=>'name', 
	// 						 'email'=>'name@domain.com');
	// 	$response = $this->call('POST', 'signup', $signin_data);
	// 	$this->assertRedirectedTo('/signup/email');
	// 	$this->assertSessionHas('errors');		
	// 	$this->assertFalse($this->client->getResponse()->isOk());
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
