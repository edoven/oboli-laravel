<?php

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;
use Facebook\Entities\AccessToken;


class FacebookService {


	private static function verifyFacebookToken($access_token)
	{
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$accessToken = new AccessToken($access_token);
		$accessTokenInfo = null;
		try {
			$accessTokenInfo = $accessToken->getInfo()->asArray();
			Log::info('FacebookService::verifyFacebookToken('.$access_token.'): accessTokenInfo', array('accessTokenInfo' => $accessTokenInfo));
		} catch(Exception $e) {
			return null;
		}
		if ($accessTokenInfo == null)
			return Utils::returnError('token_info_retrieving_error', null);
		if ($accessTokenInfo['is_valid']==true)
			if ($accessTokenInfo['app_id'] == Config::get('facebook')['appId'])
				return Utils::returnSuccess("new_user_created", null);
			else
				return Utils::returnError("token is valid but not related to this app", null);		
		if ($accessTokenInfo['is_valid']==false)
			return Utils::returnError('invalid_token', null);
		return Utils::returnError('$accessTokenInfo[\'is_valid\'] is neither true or false', null);		
	}


	private static function getUserInfoFromToken($access_token)
	{
		session_start();
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$session = new FacebookSession($access_token);
		$me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
		return array('id'=>$me->getId(),
		 			 'name'=>$me->getName(),
		 			 'email'=>$me->getProperty('email')); //this can be null
	}




	/*
	*
	* Manage the facebook callback. This is used only for the web login/signup.
	*
	*/
	public static function manageFacebookCallback() {
		Log::info('FacebookService::manageFacebookCallback', Input::all());

		session_start();
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$helper = new FacebookRedirectLoginHelper(Config::get('local-config')['host'].'/login/fb/callback');
		try {
			$session = $helper->getSessionFromRedirect();
			if ($session) {
			  	$me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className())->asArray();
			 	$uid = $me['id'];
				if ($uid == 0) 
					return Utils::returnError('facebook_error', null);
				if (!array_key_exists('email', $me) || $me['email'] == null)
					return Utils::returnError('email_access_forbidden', null);
				$facebook_profile = FacebookProfile::where('uid',  $uid)->first();		
				if ($facebook_profile != Null) 
					return Utils::returnSuccess("facebook_profile_exists", array("user_id"=>$facebook_profile->user_id));

				$user = User::where('email', $me['email'])->first(); //TODO: check if email exists!!!
				if ($user!=Null) //a user with the email associated with this facebook account already exist
				{
					$user->confirmed = 1;
					$user->save();
					FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>$session->getAccessToken() ));
					return Utils::returnSuccess("facebook_profile_added", array("user_id"=>$user->id));			
				}
				$user = User::createConfirmedUser($me['email'], $me['name']);
				FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$uid, "access_token"=>$session->getAccessToken() ));
				return Utils::returnSuccess("new_user_created", array("user_id"=>$user->id));
			}
		} catch(Exception $ex) {
			return Utils::returnError('facebook_error', array('message'=>$ex->getMessage()));
		}		
		return Utils::returnError('facebook_error', array('message'=>''));
	}


	/*
	*
	* Manage the facebook access_token. This is used only for the REST login/signup.
	*
	*/
	public static function manageToken($access_token)
	{
		Log::info('FacebookService::manageToken', array('access_token'=>$access_token));
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
		$return_object = FacebookService::verifyFacebookToken($access_token);		
		if ($return_object['status'] == 'error')
			return Utils::returnError($return_object['message'], null);					
		//let's create the facebook_profile and the user (if it does not yet exist)			
		$facebook_user_info = FacebookService::getUserInfoFromToken($access_token);
		if ($facebook_user_info['email'] == null)
			return Utils::returnError('email_access_forbidden', null);	
		$user = User::where('email', $facebook_user_info['email'])->first(); 
		if ($user == null)
			$user = User::createConfirmedUser($facebook_user_info['email'], $facebook_user_info['name']);
		FacebookProfile::create(array("user_id"=>($user->id), "uid"=>$facebook_user_info['id'], "access_token"=>($access_token) ));
		return Utils::returnSuccess("facebook_profile_created", array('user' => $user));
	}


}

?>