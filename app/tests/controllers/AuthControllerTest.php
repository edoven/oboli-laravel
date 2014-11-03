<?php

class AuthControllerTest extends TestCase {
	

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
		$login_data = array('email'=>'AuthControllerTest1@domain.com',
							'name'=>'username');
		$response = $this->call('POST', 'login', $login_data);
		$this->assertRedirectedTo('/login');
		$this->assertSessionHas('errors');		
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['password'][0] == 'The password field is required.');
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	

	public function testLoginWithCorrectData()
	{
		$this->flushSession();
		$email = 'AuthControllerTest2@domain.com';
		$name = 'name';
		$password = 'pasword';

		$this->assertTrue(User::where('email', $email)->first() == null);
		User::createUnconfirmedUser($email, $name, $password);
		$this->assertTrue(User::where('email', $email)->first() != null);

		$data = array('email'=>$email, 'password'=>$password);
		$response = $this->call('POST', 'login', $data);
		//Log::debug('testLoginWithCorrectData '.$response);
		//$this->assertTrue($this->client->getResponse()->isOk());
		
		$this->assertRedirectedTo('/');

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}

	public function testLoginWithWrongData()
	{
		$this->flushSession();
		$email = 'AuthControllerTest2@domain.com';
		$name = 'name';
		$password = 'password';
		$wrong_password = 'wrong_password';

		$this->assertTrue(User::where('email', $email)->first() == null);
		User::createUnconfirmedUser($email, $name, $password);
		$this->assertTrue(User::where('email', $email)->first() != null);

		$data = array('email'=>$email, 'password'=>$wrong_password);
		$response = $this->call('POST', 'login', $data);
		//Log::debug('testLoginWithCorrectData '.$response);
		//$this->assertTrue($this->client->getResponse()->isOk());
		
		$this->assertRedirectedTo('/login');
		$this->assertSessionHasErrors();

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}


	/*
	 *
	 *  WEB SIGNUP
	 *
	 */
	public function testNameIsRequiredForSignup()
	{
		$this->flushSession();
		$signup_data = array('email'=>'AuthControllerTest3@domain.com', 
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
							 'email'=>'AuthControllerTest4@domain.com');
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
							 'email'=>'AuthControllerTest5@domain.com',
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
							 'email'=>'AuthControllerTest6@domain.com',
							 'password'=>'abc_def');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertRedirectedTo('/signup/email');
		$this->assertSessionHas('errors');	
		$errors = Session::get('errors')->toArray();
		$this->assertTrue($errors['password'][0] == 'The password may only contain letters and numbers.');		
		$this->assertFalse($this->client->getResponse()->isOk());
	}
	
	public function testSigninWithCorrectData()
	{
		$this->flushSession();
		$signin_data = array('name'=>'name', 
							 'email'=>'name@domain.com',
							 'password'=>'abcde');
		$response = $this->call('POST', 'signup', $signin_data);
		$this->assertRedirectedTo('/');
		$this->assertFalse(Session::has('errors'));
	}

	public function testSignupWithCorrectDataRedirectAndSession()
	{
		$this->flushSession();
		$signup_data = array('name'=>'name', 
							 'email'=>'AuthControllerTest7@domain.com',
							 'password'=>'0123456789');
		$response = $this->call('POST', 'signup', $signup_data);
		//$this->assertTrue($this->client->getResponse()->isOk());
		$this->assertRedirectedTo('/');
		$this->assertSessionHas('activated');	
		$this->assertSessionHas('obolis');
	}


	

}
