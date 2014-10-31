<?php

class CodeControllerTest extends TestCase {
	

	public function testSessionHasCodeIdIfUserIsGuest()
	{
		$login_data = array('password'=>'password');
		$code_id = '4567';
		$route = 'codes/'.$code_id;
		$response = $this->call('GET', $route);
		$this->assertSessionHas('code');	
		$this->assertTrue(Session::get('code') === $code_id);
	}


	public function testSessionRedirectToAccessPageIfUserIsGuest()
	{
		$login_data = array('password'=>'password');
		$code_id = '4567';
		$route = 'codes/'.$code_id;
		$response = $this->call('GET', $route);
		$this->assertRedirectedTo('/access');
	}

	

	public function testUnknownCodeRedirection()
	{
		$user = User::createUnconfirmedUser('CodeServiceTestUser1@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);
		$this->be($user);
		$this->assertFalse(Auth::guest());

		$code_id = 10;
		$this->assertTrue(Code::find($code_id) == null);

		$route = 'codes/'.$code_id;
		$response = $this->call('GET', $route);
		$this->assertRedirectedTo('/');
	}

	public function testUnknownCodeRedirectHasMessage()
	{
		$user = User::createUnconfirmedUser('CodeServiceTestUser1@domain.com', 'name', 'password');
		$this->assertTrue(User::find($user->id) != null);
		$this->be($user);
		$this->assertFalse(Auth::guest());

		$code_id = 10;
		$this->assertTrue(Code::find($code_id) == null);

		$route = 'codes/'.$code_id;
		$response = $this->call('GET', $route);
		$this->assertTrue(Session::has('message'));
	}


	
	
}
