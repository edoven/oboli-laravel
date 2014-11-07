<?php


use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\GraphUser;

require_once(app_path().'/utils.php');



class FacebookController extends BaseController {
	
	
	public function redirectToFacebook() {
		Log::info('FacebookController::redirectToFacebook');
		session_start();
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$helper = new FacebookRedirectLoginHelper(Config::get('local-config')['host'].'/login/fb/callback');

		$loginUrl = $helper->getLoginUrl( array( 'email' ) );
		return Redirect::to($loginUrl); 
	}


	public function manageFacebookCallback() {
		$return_object = FacebookService::manageFacebookCallback();
		Log::info('FacebookController::manageFacebookCallback', array('return_object'=>$return_object) );
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'email_access_forbidden':
					$message_bag = new MessageBag();
					$message_bag.add('facebook', 'access to email address is forbidden');
			    	return Redirect::to('/signup')->withErrors($message_bag);
			    case 'uid_zero_error':
			    	return 'Facebook error: uid_zero_error ';
			    case 'facebook_error':
			    	return 'Facebook error: '.$return_object['data']['message'];
			    case 'facebook_email_access_forbidden':
			    	return 'Facebook error: email access forbidden';
			    default:
			    	return 'Internal Server Error';	
			}
		}
		if ($return_object['status'] == 'success')
		{
			$user_id = $return_object['data']['user_id'];
			Auth::loginUsingId($user_id);
			Event::fire('auth.login.web', array($user_id));
			return Redirect::to('/');
		}
		return 'Internal Server Error';	
	}


	public function doFacebookRestLogin()
	{
		$access_token = Input::get('access_token');
		$return_object = FacebookService::manageToken($access_token);
		Log::info('FacebookController::doFacebookRestLogin', array('access_token'=>$access_token, 'return_object'=>$return_object) );
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'token_info_retrieving_error':
					return Utils::create_json_response("error", 400, 'token_info_retrieving_error', 'problems retireving info from token', Input::get('access_token'));				
				case 'no_user_related':
					return Utils::create_json_response("error", 500, 'internal server error', 'a facebook profile already exists but it is not related to any user', Input::get('access_token'));
				case 'token_status_error':
					return Utils::create_json_response("error", 400, 'token status = error', null,  Input::get('access_token'));
				case 'invalid_token':
					return Utils::create_json_response("error", 400, 'invalid_token', null,  Input::get('access_token'));
			    default:
			    	return Utils::create_json_response("error", 500, "internal server error", $return_object['message'], null);
			}
		}
		
		if ($return_object['status'] == 'success')
		{
			//FacebookService::createPost();
			$user = $return_object['data']['user'];
			$data =  array('user_id' => $user->id,
						   'token' => $user->api_token,
						   'user' => $user->toArray()
						  );
			return Utils::create_json_response("success", 200, 'successful login', null, $data);
		}
		
		return Utils::create_json_response("error", 500, "internal server error: return status is neither error nor success", null, null);
	}
	
	
}