<?php


class AuthServiceTest extends TestCase {



	/*
	 *		SIGNUP
	 */


	public function testSignupWithMissingEmail()
	{
		$data = array('name'=>'name', 'password'=>'password');
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$validator_message = $return_object['data']['validator']->messages()->first('email');
		$this->assertTrue($validator_message == 'The email field is required.');
	}

	public function testSignupWithMissingName()
	{
		$data = array('email'=>'name@domain.com', 'password'=>'password');
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$validator_message = $return_object['data']['validator']->messages()->first('name');
		$this->assertTrue($validator_message == 'The name field is required.');
	}

	public function testSignupWithMissingPassword()
	{
		$data = array('email'=>'name@domain.com', 'name'=>'name');
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$validator_message = $return_object['data']['validator']->messages()->first('password');
		$this->assertTrue($validator_message == 'The password field is required.');
	}

	public function testSignupWithTooShortPassword()
	{
		$data = array('email'=>'name@domain.com', 'name'=>'name', 'password'=>'0123');
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$validator_message = $return_object['data']['validator']->messages()->first('password');
		//Log::info('testSignupWithTooShortPassword: '.$validator_message);
		$this->assertTrue($validator_message == 'The password must be at least 5 characters.');
	}

	public function testSignupWithNotAlphanumericPassword()
	{
		$data = array('email'=>'name@domain.com', 'name'=>'name', 'password'=>'0123_.,+è65');
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$validator_message = $return_object['data']['validator']->messages()->first('password');
		//Log::info('testSignupWithTooShortPassword: '.$validator_message);
		$this->assertTrue($validator_message == 'The password may only contain letters and numbers.');
	}


	public function testSignupWithAlreadyExistingEmail()
	{
		$email ='AuthServiceTestUser1@domain.com';
		$name = 'edoardo';
		$password = '01234567';

		$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);

		// first user
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'success');
		$this->assertTrue($return_object['message'] == 'account_created');
		$this->assertTrue(User::where('email', $email)->first() != null);

		// second user
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'account_exists');

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}

	public function testSignupWithAlreadyExistingEmailRelatedToFacebookAccount()
	{
		$email ='AuthServiceTestUser1@domain.com';
		$name = 'edoardo';
		$password = '01234567';

		$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);

		// first user
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'success');
		$this->assertTrue($return_object['message'] == 'account_created');
		$user = User::where('email', $email)->first();
		$this->assertTrue($user != null);

		FacebookProfile::create(array('user_id'=>$user->id, 'username'=>'username', 'uid'=>000, 'access_token'=>000));

		// second user
		$return_object = AuthService::doSignup($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'facebook_account_exists');

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}
	
	
	public function testSignupWithValidData()
	{
		$email ='AuthServiceTestUser2@domain.com';
		$name = 'edoardo';
		$password = '01234567';

		$data = array('name'=>$name, 'email'=>$email, 'password'=>$password);

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);

		$return_object = AuthService::doSignup($data);

		$this->assertTrue($return_object['status'] == 'success');
		$this->assertTrue($return_object['message'] == 'account_created');

		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}


	/*
	 *		LOGIN
	 */


	public function testLoginWithMissingEmail()
	{
		$data = array('password'=>'password');
		$return_object = AuthService::doLogin($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$messages = $return_object['data']['validator']->messages();
		$this->assertTrue($messages->first('password') == null);
		$this->assertTrue($messages->first('email') == 'The email field is required.');
	}

	public function testLoginWithMissingPassword()
	{
		$data = array('email'=>'email@domain.com');
		$return_object = AuthService::doLogin($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$messages = $return_object['data']['validator']->messages();
		$this->assertTrue($messages->first('password') == 'The password field is required.');
		$this->assertTrue($messages->first('email') == null);
	}

	public function testLoginWithInvalidEmail()
	{
		$data = array('email'=>'email', 'password'=>'password');
		$return_object = AuthService::doLogin($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'validator_error');
		$messages = $return_object['data']['validator']->messages();
		$this->assertTrue($messages->first('password') == null);
		$this->assertTrue($messages->first('email') == 'The email must be a valid email address.');
	}

	public function testLoginWithWrongPassword()
	{
		$email = 'name@domain.com';
		$password = 'password';
		$wrong_password = 'wrong_password';

		$this->assertTrue(User::where('email',$email)->first() == null);
		User::createUnconfirmedUser($email, 'name', $password);
		$this->assertTrue(User::where('email',$email)->first() != null);

		$data = array('email'=>$email, 'password'=>$wrong_password);
		$return_object = AuthService::doLogin($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'wrong_credentials');
	}

	public function testLoginWithUnknownEmail()
	{
		$email = 'name@domain.com';
		$password = 'password';

		$this->assertTrue(User::where('email',$email)->first() == null);
		$data = array('email'=>$email, 'password'=>$password);
		$return_object = AuthService::doLogin($data);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'unknown_email');
	}

	public function testLoginWithRightData()
	{
		$email = 'name@domain.com';
		$password = 'password';

		$this->assertTrue(User::where('email',$email)->first() == null);
		$user = User::createUnconfirmedUser($email, 'name', $password);
		$this->assertTrue(User::where('email',$email)->first() != null);

		$data = array('email'=>$email, 'password'=>$password);
		$return_object = AuthService::doLogin($data);
		$this->assertTrue($return_object['status'] == 'success');
		$this->assertTrue($return_object['message'] == 'success_login');
		$this->assertTrue($return_object['data']['user']->email === $user->email);
		//Log::debug('testLoginWithRightData', array('original_user_id'=>$user->id, 'returned_user_id'=>$return_object['data']['user']->id));
		$this->assertTrue($return_object['data']['user']->id == $user->id);
	}


	/*
	 *		CONFIRMATION
	 */
	public function testConfirmNonExistingEmail()
	{
		$email ='AuthServiceTestUser3@domain.com';
		$confirmation_token = 'dgfdfgasegrzadsfgE54YTGRZFDKKjk';
		$this->assertTrue(User::where('email', $email)->first() == null);
		$return_object = AuthService::confirmEmail($email, $confirmation_token);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'unknown_email');
	}

	public function testConfirmWrongCode()
	{

		$email ='AuthServiceTestUser4@domain.com';
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

		$return_object = AuthService::confirmEmail('AuthServiceTestUser5@domain.com', null);
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'data_missing');

		$return_object = AuthService::confirmEmail(null, 'code');
		$this->assertTrue($return_object['status'] == 'error');
		$this->assertTrue($return_object['message'] == 'data_missing');
	}

}
