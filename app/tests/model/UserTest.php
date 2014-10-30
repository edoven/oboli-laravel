<?php


class UserTest extends TestCase {

	
	
	
	public function testInsertAndDelete()
	{
		$email = "a3@domain.com";
		$this->assertTrue(User::where('email', $email)->first() == null);
		User::createUnconfirmedUser($email, 'edoardo', 'password');
		$this->assertTrue(User::where('email', $email)->first() != null);
		User::where('email', $email)->delete();
		$this->assertTrue(User::where('email', $email)->first() == null);
	}
	

	

}
