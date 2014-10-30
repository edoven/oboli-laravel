<?php


class CodeServiceTest extends TestCase {

	
	
	public function testUnexistingUser()
	{
		$user_id = 99999999;
		$this->assertTrue(User::find($user_id) == null);
		$code_id = 123;
		$return = CodeService::useCode($user_id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		$this->assertTrue($return['message'] ==	'unknown_user');
	}

	public function testUnexistingCode()
	{
		$user = User::createUnconfirmedUser('CodeServiceTestUser1@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);

		$code_id = 10;
		$this->assertTrue(Code::find($code_id) == null);
		$return = CodeService::useCode($user->id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		
		$this->assertTrue($return['message'] == 'unknown_code');
	}

	public function testUsedCode()
	{
		$user = User::createUnconfirmedUser('CodeServiceTestUser2@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);

		$code_id = 0;
		Code::create(array('id'=>$code_id, 'product'=>0, 'oboli'=>1, 'user'=>$user->id));
		$this->assertTrue(Code::find($code_id) != null);
		$return = CodeService::useCode($user->id, $code_id);
		$this->assertTrue($return['status'] == 'error');

		$this->assertTrue($return['message'] == 'already_used_code');

	}

	public function testMissingCode()
	{
		$user_id = 0;
		$code_id = null;
		$return = CodeService::useCode($user_id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		$this->assertTrue($return['message'] ==	'missing_code_id');

	}

	public function testMissingUser()
	{
		$user_id = null;
		$code_id = 0;
		$return = CodeService::useCode($user_id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		$this->assertTrue($return['message'] ==	'missing_user_id');

	}
	
}
