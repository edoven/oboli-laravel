<?php

class CodeControllerTest extends TestCase {
	

	public function testSessionHasCodeIdIfUserIsGuest()
	{
		$this->flushSession();
		$login_data = array('password'=>'password');
		$code_id = '4567';
		$route = 'codes/'.$code_id;
		$response = $this->call('GET', $route);
		$this->assertRedirectedTo('/login');
		$this->assertSessionHas('code_id');	
		$this->assertTrue(Session::get('code_id') === $code_id);
	}
	
	
}
