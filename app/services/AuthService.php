<?php

class AuthService {
	
	public static function verifyFacebookToken($access_token)
	{
		$facebook = new Facebook(Config::get('facebook'));
		$token_debug = $facebook->api('debug_token', array(
									  'input_token' => $access_token,
									  'access_token' => $facebook->getAccessToken() //this is related to the app
									  ));
		if ($token_debug['data']['is_valid']!=true)
			return array('status'=>'error', 
						 'message'=>'token is not valid');					
		if ($token_debug['data']['app_id']!=$facebook->getAppId())
			return array('status'=>'error', 
						 'message'=>'token is not related to this app');
		return array('status'=>'success');
	}

	
	public static function getUserInfoFromToken($access_token)
	{
		$facebook = new Facebook(Config::get('facebook'));
		$me = $facebook->api('/me', 'get', array(
			'access_token' => $access_token
		));
		return array('id'=>$me['id'],
					 'email'=>$me['email'],
					 'name'=>$me['name']);
	}
	
	
	/*
	 *  TODO: move to model
	 */
	public static function createFacebookProfile($user_id, $uid, $access_token)
	{
		$facebook_profile = new FacebookProfile;
		$facebook_profile->uid = $uid;
		$facebook_profile->user_id = $user_id;
		$facebook_profile->access_token = $access_token;
		$facebook_profile->save();
	}
	
	/*
	 *  TODO: move to model
	 */
	public static function createConfirmedUser($email, $name)
	{
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->oboli_count = 0;
		$user->confirmation_code = str_random(45);
		$user->confirmed = 1; //email is confirmed because is connected with fb
		$user->facebook_profile = 1; //email is confirmed because is connected with fb
		$user->api_token = str_random(60);
		$user->save();	
		return $user;
	}
	
		
		
}


?>
