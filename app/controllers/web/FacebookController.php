<?php

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;

include_once(app_path().'/utils.php');



class FacebookController extends BaseController {
	
	
	public function redirectToFacebook() {
		Log::info('FacebookController::redirectToFacebook');
		session_start();
		FacebookSession::setDefaultApplication(Config::get('facebook')['appId'], Config::get('facebook')['secret']);
		$helper = new FacebookRedirectLoginHelper(Config::get('local-config')['host'].'/login/fb/callback');
		$loginUrl = $helper->getLoginUrl( array('email') );
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
					// $message_bag = new MessageBag;
					// $message_bag->add('facebook', 'Accesso con facebook impossibile, serve l\'accesso all\'indirizzo email');
			  		// return Redirect::to('/signup/email')->withErrors($message_bag);
					return Redirect::to('error')->withMessage('Accesso con facebook impossibile, serve l\'accesso all\'indirizzo email');
			    case 'uid_zero_error':
			    	return Redirect::to('error')->withMessage('Facebook error: uid_zero_error');
			    case 'facebook_error':
			    	return Redirect::to('error')->withMessage('Facebook error: '.$return_object['data']['message']);
			    default:
			    	return Redirect::to('error')->withMessage('Internal Server Error');
			}
		}
		if ($return_object['status'] == 'success')
		{
			$user_id = $return_object['data']['user_id'];
			Auth::loginUsingId($user_id);
			Event::fire('auth.login.web', array($user_id));
			return Redirect::to('/ngos');
		}
		return Redirect::to('error')->withMessage('Internal Server Error');
	}

}