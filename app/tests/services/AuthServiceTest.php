<?php


class AuthServiceTest extends TestCase {

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
	

	public function testSignupWithMissingEmail()
	{
		$name = 'edoardo';
		$password = '01234567';
		$data = array('name'=>$name, 'password'=>$password);

		$return_object = AuthService::doSignup($data);

		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$validator_message = $return_object['data']['validator']->messages()->first('email');
		$this->assertTrue($validator_message == 'The email field is required.');
	}


	public function testSignupWithAlreadyExistingEmail()
	{
		$email ='test6@domain.com';
		$name = 'edoardo';
		$password = '01234567';

		$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);

		// first user
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'success');
		$this->assertTrue($return_object['message'] == 'mail_sent');
		$this->assertTrue(User::where('email', $email)->first() != null);

		// second user
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'account_exists');

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}
	
	
	public function testSignupWithValidData()
	{
		$email ='test6@domain.com';
		$name = 'edoardo';
		$password = '01234567';

		$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);

		$return_object = AuthService::doSignup($data);

		$this->assertTrue($return_object['status'] == 'success');
		$this->assertTrue($return_object['message'] == 'mail_sent');

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}


	public function testConfirmNonExistingEmail()
	{
		$email ='test8@domain.com';
		$confirmation_token = 'dgfdfgasegrzadsfgE54YTGRZFDKKjk';
		$this->assertTrue(User::where('email', $email)->first() == null);
		$return_object = AuthService::confirmEmail($email, $confirmation_token);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'unknown_email');
	}

	public function testConfirmWrongCode()
	{

		$email ='test8@domain.com';
		$name = 'name';
		$password = 'password';

		$this->assertTrue(User::where('email', $email)->first() == null);
		User::createUnconfirmedUser($email, $name, $password);
		$this->assertTrue(User::where('email', $email)->first() != null);

		$confirmation_code = User::where('email', $email)->first()->confirmation_code;

		$wrowng_token = 'aaa';

		$this->assertTrue($confirmation_code != $wrowng_token);

		$return_object = AuthService::confirmEmail($email, $wrowng_token);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'wrong_code');

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}
	

	public function testConfirmWithMissingData()
	{

		$return_object = AuthService::confirmEmail('user@domain.com', null);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'data_missing');

		$return_object = AuthService::confirmEmail(null, 'code');
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'data_missing');
	}

}
