<?php


require_once(app_path().'/utils.php');



class FacebookRestController extends BaseController {
	
	
	public function doFacebookLogin()
	{
		$access_token = Input::get('access_token');
		$return_object = FacebookService::manageToken($access_token);
		Log::info('FacebookController::doFacebookRestLogin', array('access_token'=>$access_token, 'return_object'=>$return_object) );
		if ($return_object['status'] == 'error')
		{
			switch ($return_object['message']) 
			{
				case 'token_info_retrieving_error':
					return Utils::create_json_response("error", 400, 'token_info_retrieving_error', 'problems retireving info from token', array(Input::get('access_token')));				
				case 'no_user_related':
					return Utils::create_json_response("error", 500, 'internal server error', 'a facebook profile already exists but it is not related to any user', array(Input::get('access_token')));
				case 'token_status_error':
					return Utils::create_json_response("error", 400, 'token status = error', null,  array(Input::get('access_token')));
				case 'invalid_token':
					return Utils::create_json_response("error", 400, 'invalid_token', null,  array(Input::get('access_token')));
				case 'email_access_forbidden':
					return Utils::create_json_response("error", 400, 'email_access_forbidden', null,  array(Input::get('access_token')));
				case 'facebook_token_error':
					return Utils::create_json_response("error", 400, 'facebook_token_error', null,  array(Input::get('access_token')));	
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