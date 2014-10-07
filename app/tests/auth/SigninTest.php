<?php

class SigninTest extends TestCase {

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
	
	
	
	public function testNameIsRequired()
	{
		$this->flushSession();
		$signin_data = array('email'=>'name@domain.com', 
							 'password'=>'password');	
		$response = $this->call('POST', 'signin', $signin_data);
		//dd($response);
		$this->assertRedirectedTo('/signin');
		$this->assertSessionHas('errors');	
		$this->assertFalse($this->client->getResponse()->isOk());	
	}
	
	public function testMailIsRequired()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'password'=>'password');
		$response = $this->call('POST', 'signin', $signin_data);
		//dd($response);
		$this->assertRedirectedTo('/signin');
		$this->assertSessionHas('errors');	
		$this->assertFalse($this->client->getResponse()->isOk());	
	}
	
	public function testPasswordIsRequired()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com');
		$response = $this->call('POST', 'signin', $signin_data);
		//dd($response);
		$this->assertRedirectedTo('/signin');
		$this->assertSessionHas('errors');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	
	public function testMailHasToBeLongerThanFourChars()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcd');
		$response = $this->call('POST', 'signin', $signin_data);
		//dd($response);
		$this->assertRedirectedTo('/signin');
		$this->assertSessionHas('errors');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	
	public function testSigninWithCorrectData()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcde');
		$response = $this->call('POST', 'signin', $signin_data);
		//dd($response);
		$this->assertTrue($this->client->getResponse()->isOk());
	}
	

}
