<?php


class EloquentTest extends TestCase {

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
	
	
	
	public function testInsertAndDelete()
	{
		$email = "user12345789sdfhgdshgdgdxghxdgh@domain.com";

		$user = User::where('email', $email)->first();
		// echo var_dump($user);
		$this->assertTrue(User::where('email', $email)->first() == null);

		$user = new User();
		$user->id = 10000000;
		$user->email = $email;
		$user->name = "name";
		$user->password = "password";
		$user->donated_oboli_count = 0;
		$user->confirmed = 0;
		$user->confirmation_code = 0;
		$user->facebook_profile = 0;
		$user->api_token = 0;
		$user->oboli_count = 5;
		$user->save();

		$this->assertTrue(User::where('email', $email)->first() != null);
		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);

	}
	

	

}
