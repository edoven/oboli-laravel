<?php

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;
use Facebook\Entities\AccessToken;


class FacebookService {


	// private static function verifyFacebookToken($access_token)
	// {
	// 	$facebook = new Facebook(Config::get('facebook'));
	// 	$token_debug = $facebook->api('debug_token', array(
	// 								  'input_token' => $access_token,
	// 								  'access_token' => $facebook->getAccessToken() //this is related to the app
	// 								  ));
	// 	if ($token_debug['data']['is_valid']!=true)
	// 		return array('status'=>'error', 
	// 					 'message'=>'token is not valid');					
	// 	if ($token_debug['data']['app_id']!=$facebook->getAppId())
	// 		return array('status'=>'error', 
	// 					 'message'=>'token is not related to this app');
	// 	return array('status'=>'success');
	// }

	private static function verifyFacebookToken($access_token)
	{
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$accessToken = new AccessToken(Input::get('access_token'));
		try {
			$accessTokenInfo = $accessToken->getInfo();
		} catch(FacebookSDKException $e) {
			echo 'Error getting access token info: ' . $e->getMessage();
			exit;
		}
		$accessTokenInfo = $accessTokenInfo->asArray();
		if ($accessTokenInfo['is_valid'] && $accessTokenInfo['app_id']!=$facebook->getAppId())
			return array('status'=>'success');
		if ($accessTokenInfo['is_valid']==false)
			return array('status'=>'error', 
						 'message'=>'token is not valid');					
		if ($accessTokenInfo['app_id']!=$facebook->getAppId())
			return array('status'=>'error', 
						 'message'=>'token is not related to this app');
		return array('status'=>'error', 
					 'message'=>'internal server errror');
		
	}

	
	private static function getUserInfoFromToken($access_token)
	{
		session_start();
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$session = new FacebookSession($access_token);
		$me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
		return array('id'=>$me->getId(),
		 			 'email'=>$me->getEmail(),
		 			 'name'=>$me->getName());
		// $facebook = new Facebook(Config::get('facebook'));
		// $me = $facebook->api('/me', 'get', array('access_token' => $access_token));
		// return array('id'=>$me['id'],
		// 			 'email'=>$me['email'],
		// 			 'name'=>$me['name']);
	}


	// public static function manageFacebookCallback() {
	// 	$code = Input::get('code');
	// 	if (strlen($code) == 0) 
	// 		return Utils::returnError('facebook_error', null);
	// 	$facebook = new Facebook(Config::get('facebook'));


	// 	$uid = $facebook->getUser();
	// 	if ($uid == 0) 
	// 		return Utils::returnError('facebook_error', null);
	// 	$facebook_profile = FacebookProfile::where('uid',  $uid)->first();		
	// 	//if user already exist, just log him in
	// 	if ($facebook_profile != Null) 
	// 		return Utils::returnSuccess("facebook_profile_exists", array("user_id"=>$facebook_profile->user_id));				
	// 	$me = $facebook->api('/me');		
	// 	$user = User::where('email', $me['email'])->first(); //TODO: check if email exists!!!
	// 	if ($user!=Null) //a user with the email associated with this facebook account already exist
	// 	{
	// 		FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>($facebook->getAccessToken()) ));
	// 		return Utils::returnSuccess("facebook_profile_added", array("user_id"=>$user->id));			
	// 	}
	// 	$user = User::createConfirmedUser($me['email'], $me['name']);
	// 	FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>($facebook->getAccessToken()) ));
	// 	return Utils::returnSuccess("new_user_created", array("user_id"=>$user->id));
	// }

	// public static function manageFacebookCallback() {
	// 	session_start();
	// 	FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
	// 	$helper = new FacebookRedirectLoginHelper('http://edoventurini.com/login/fb');
	// 	$session = null;
	// 	try {
	// 		$session = $helper->getSessionFromRedirect();
	// 	} catch(FacebookRequestException $ex) {
	// 	  // When Facebook returns an error
	// 	} catch(Exception $ex) {
	// 	  // When validation fails or other local issues
	// 	}
	// 	if ($session!=null) {
	// 	  $me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
	// 	  return $me->toJson();
	// 	}
	// 	return $session;


	// 	$uid = $facebook->getUser();
	// 	if ($uid == 0) 
	// 		return Utils::returnError('facebook_error', null);
	// 	$facebook_profile = FacebookProfile::where('uid',  $uid)->first();		
	// 	//if user already exist, just log him in
	// 	if ($facebook_profile != Null) 
	// 		return Utils::returnSuccess("facebook_profile_exists", array("user_id"=>$facebook_profile->user_id));				
	// 	$me = $facebook->api('/me');		
	// 	$user = User::where('email', $me['email'])->first(); //TODO: check if email exists!!!
	// 	if ($user!=Null) //a user with the email associated with this facebook account already exist
	// 	{
	// 		FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>($facebook->getAccessToken()) ));
	// 		return Utils::returnSuccess("facebook_profile_added", array("user_id"=>$user->id));			
	// 	}
	// 	$user = User::createConfirmedUser($me['email'], $me['name']);
	// 	FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>($facebook->getAccessToken()) ));
	// 	return Utils::returnSuccess("new_user_created", array("user_id"=>$user->id));
	// }


	public static function manageFacebookCallback() {
		session_start();
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$helper = new FacebookRedirectLoginHelper(Config::get('local-config')['host'].'/login/fb/callback');
		try {
			$session = $helper->getSessionFromRedirect();
			//return var_dump($helper->getSessionFromRedirect());
		} catch(FacebookRequestException $ex) {
		 	return Utils::returnError('facebook_error', null);
		} catch(Exception $ex) {
			return Utils::returnError('facebook_error', null);
		}

		if ($session) {
		  	$me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className())->asArray();
		 	$uid = $me['id'];
			if ($uid == 0) 
				return Utils::returnError('facebook_error', null);
			$facebook_profile = FacebookProfile::where('uid',  $uid)->first();		
			//if user already exist, just log him in
			if ($facebook_profile != Null) 
				return Utils::returnSuccess("facebook_profile_exists", array("user_id"=>$facebook_profile->user_id));						
			$user = User::where('email', $me['email'])->first(); //TODO: check if email exists!!!
			if ($user!=Null) //a user with the email associated with this facebook account already exist
			{
				FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>$session->getAccessToken() ));
				return Utils::returnSuccess("facebook_profile_added", array("user_id"=>$user->id));			
			}
			$user = User::createConfirmedUser($me['email'], $me['name']);
			FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>$session->getAccessToken() ));
			return Utils::returnSuccess("new_user_created", array("user_id"=>$user->id));
		}
		
		return Utils::returnError('facebook_error', null);;	


		
	}


	public static function manageToken($access_token)
	{
		$facebook_profile = FacebookProfile::where('access_token', $access_token)->first();
		
		//if this token already exists just acts as a normal login 
		if ($facebook_profile!=null)
		{
			/*
			 * TODO: CHECK IF THE TOKEN IS VALID OR IS EXPIRED
			 */
			$user = User::where('id', $facebook_profile->user_id)->first();
			if ($user == null)
				return Utils::returnError("no_user_related", null);
			return Utils::returnSuccess("facebook_profile_exists", array('user' => $user));
		}
		//let's verify the token
		$token_status = FacebookService::verifyFacebookToken($access_token);


		if ($token_status['status'] == 'error')
			return Utils::returnError("token_status_error", array('token_status' => $token_status));					
		//let's create the facebook_profile and the user (if it does not yet exist)			
		$facebook_user_info = FacebookService::getUserInfoFromToken($access_token);
		$user = User::where('email', $facebook_user_info['email'])->first(); 
		if ($user == null)
			$user = User::createConfirmedUser($facebook_user_info['email'], $facebook_user_info['name']);
		//FacebookProfile::create($user->id, $facebook_user_info['id'], $access_token);
		FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$facebook_user_info['id'], "access_token"=>($access_token) ));
		return Utils::returnSuccess("facebook_profile_created", array('user' => $user));
	}


	// public static function createPost()
	// {
	// 	FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);

	// 	$session = new FacebookSession('CAAK4mMgz54ABAPqKMyJSFc6ieZCum9TThw3yfSrxwjsNOKvdNU7a7cX1fXVyvX7EEHvre5ttvYcDLDwR3IvAHFmQQMQdtDZAupPjiRlcCTc0ij3ZBvHZARaLXg9jWPuilmlUU05q41eYziuX5fatqE2pU7aottUpRZBaSp3vNpRp84ZB0nPmYggmBFfKuSw6ZBNRNymnyMABlWZC6hZAcHzHo');
	// 	if($session) {
	// 		try {
	// 			$data = array('link' => 'www.example.com', 'message' => 'test');
	// 			$request = new FacebookRequest($session, 'POST', '/me/feed', $data);
	// 	    	$response = $request->execute()->getGraphObject();
	// 	    	echo "Posted with id: " . $response->getProperty('id');
	// 	  	} catch(FacebookRequestException $e) {
	// 	    	echo "Exception occured, code: " . $e->getCode();
	// 	   		echo " with message: " . $e->getMessage();
	// 	  	}   
	// 	}
	// }


}

?>