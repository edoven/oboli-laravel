<?php

class LoginTest extends TestCase {

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
	
	

	
	public function testMailIsRequired()
	{
		$this->flushSession();
		$login_data = array('password'=>'password');
		$response = $this->call('POST', 'login', $login_data);
		$this->assertRedirectedTo('/login');
		$this->assertSessionHas('errors');	
		$this->assertFalse($this->client->getResponse()->isOk());	
	}
	
	public function testPasswordIsRequired()
	{
		$this->flushSession();
		$login_data = array('email'=>'name@domain.com');
		$response = $this->call('POST', 'login', $login_data);
		$this->assertRedirectedTo('/login');
		$this->assertSessionHas('errors');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	

	public function testLoginWithCorrectData()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcde');
		$response = $this->call('POST', 'login', $signin_data);
		$this->assertTrue($this->client->getResponse()->isOk());
	}
	
	//public function testFacebookLoginRedirectsToFacebookWebsite()
	//{
		//$this->flushSession();
		//$response = $this->call('GET', 'login/fb');
		//$this->assertRedirectedTo('www.facebook.com');
	//}
	

}
