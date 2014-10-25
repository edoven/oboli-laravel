<?php


class DonationServiceTest extends TestCase {

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
	
	
	
	public function testAmountIsGreaterThanOne()
	{
		$this->flushSession();
		$amount = 0;
		$return = DonationService::makeDonation(0,0,$amount);
		$this->assertTrue($return['status']=='error');
		$this->assertTrue($return['message']==	'donation_amount_error');
	}
	
	//public function testUserHasEnoughObolis()
	//{
		////$user = new User();
		////$user->id = 100000;
		////$user->email = "user@domain.com";
		////$user->name = "name";
		////$user->password = "password";
		////$user->donated_oboli_count = 0;
		////$user->confirmed = 0;
		////$user->confirmation_code = 0;
		////$user->facebook_profile = 0;
		////$user->api_token = 0;
		////$user->oboli_count = 5;
		////$user->save();
		
		
		//$this->flushSession();
		//$utils = new Utils;
		//$amount = 10;
		//$return = (new Utils)->makeDonation(1,1,$amount);
		//$this->assertTrue($return['code']==400);
		//$this->assertTrue($return['message']==	'The donation amount is greater than the user obolis count');
	//}
	

}
