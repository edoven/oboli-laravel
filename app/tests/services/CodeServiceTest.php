<?php


class CodeServiceTest extends TestCase {

	public function testNullUserId()
	{
		$user_id = null;
		$code_id = 0;
		$return = CodeService::useCode($user_id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		$this->assertTrue($return['message'] ==	'missing_user_id');
	}

	public function testNullCodeId()
	{
		$user_id = 0;
		$code_id = null;
		$return = CodeService::useCode($user_id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		$this->assertTrue($return['message'] ==	'missing_code_id');
	}

	
	public function testUnknownUser()
	{
		$user_id = 99999999;
		$this->assertTrue(User::find($user_id) == null);
		$code_id = 123;
		$return = CodeService::useCode($user_id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		$this->assertTrue($return['message'] ==	'unknown_user');
	}

	public function testUnknownCode()
	{
		$user = UserFactory::createUnconfirmedUser('CodeServiceTestUser1@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);

		$code_id = 10;
		$this->assertTrue(Code::find($code_id) == null);
		$return = CodeService::useCode($user->id, $code_id);
		$this->assertTrue($return['status'] == 'error');	
		$this->assertTrue($return['message'] == 'unknown_code');
	}

	public function testAlreadyUsedCode()
	{
		$user = UserFactory::createUnconfirmedUser('CodeServiceTestUser2@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);

		$code_id = 0;
		Code::create(array('id'=>$code_id, 'product'=>0, 'oboli'=>1, 'user'=>$user->id));
		$this->assertTrue(Code::find($code_id) != null);
		$return = CodeService::useCode($user->id, $code_id);
		$this->assertTrue($return['status'] == 'error');
		$this->assertTrue($return['message'] == 'already_used_code');
	}

	public function testUseCodeWithRightData()
	{
		$user = UserFactory::createUnconfirmedUser('CodeServiceTestUser2@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);

		$code_id = 0;
		$obolis_amount = 1;
		Code::create(array('id'=>$code_id, 'product'=>0, 'oboli'=>$obolis_amount, 'user'=>null));
		$this->assertTrue(Code::find($code_id) != null);

		$return = CodeService::useCode($user->id, $code_id);
		$this->assertTrue($return['status'] == 'success');
		$this->assertTrue($return['data']['code_obolis'] == $obolis_amount);
		$this->assertTrue($return['data']['user_obolis_count_old'] == 0);
		$this->assertTrue($return['data']['user_obolis_count'] == (0+$obolis_amount) );
	}


	public function testCodeCantBeUsedTwice()
	{
		$user = UserFactory::createUnconfirmedUser('CodeServiceTestUser2@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);

		$code_id = 9876543;
		$obolis_amount = 1;
		Code::create(array('id'=>$code_id, 'product'=>0, 'oboli'=>$obolis_amount, 'user'=>null));
		$this->assertTrue(Code::find($code_id) != null);

		$return1 = CodeService::useCode($user->id, $code_id);
		$this->assertTrue($return1['status'] == 'success');
		$this->assertTrue($return1['data']['code_obolis'] == $obolis_amount);
		$this->assertTrue($return1['data']['user_obolis_count_old'] == 0);
		$this->assertTrue($return1['data']['user_obolis_count'] == (0+$obolis_amount) );

		$return2 = CodeService::useCode($user->id, $code_id);
		$this->assertTrue($return2['status'] == 'error');
		$this->assertTrue($return2['message'] == 'already_used_code');
	}

	
	
}
