<?php

use Carbon\Carbon;

include_once(app_path().'/utils.php');



class CodeRestController extends BaseController {
	
	
	// auth needed
	public function useCode($id)
	{
		$user_id = Input::get('user_id');
		$return_object = CodeService::useCode($user_id, $id);
		Log::info('CodeController::useCodeRest('.$id.') as user '.$user_id, array('return_object'=>$return_object));
		if ($return_object['status'] == 'error')
			switch ($return_object['message']) 
			{
				case 'missing_user_id':
					return Utils::create_json_response('error', 400, 'missing_user_id', 'some data is missing', null);
			    case 'missing_code_id':
					return Utils::create_json_response('error', 400, 'missing_code_id', 'some data is missing', null);
				case 'unknown_code':
					return Utils::create_json_response('error', 404, 'unexisting_code', 'the code does not exist', null);
				case 'unknown_user':
					return Utils::create_json_response('error', 500, 'internal server error: unexisting user (but the user is authenticated)', null, null);
			    case 'already_used_code':
					return Utils::create_json_response('error', 400, 'already_used_code', null, null);
				case 'requests_limit_reached':
					return Utils::create_json_response('error', 400, 'requests_limit_reached', null, null);			
			    default:
			    	return Utils::create_json_response('error', 500, 'internal server error: unknown $return_object[message]', null, null);
			}

		if ($return_object['status'] == 'success')
				return Utils::create_json_response("success", 
											200, 
											'Hai appena guadagnato '.$return_object['data']['code_obolis'].' Oboli!', 
											null, 
											array('code_obolis' => $return_object['data']['code_obolis'],
												  'user_obolis_count_old' => $return_object['data']['user_obolis_count_old'],
												  'user_obolis_count' => $return_object['data']['user_obolis_count']));

		return Utils::create_json_response('error', 500, 'internal server error', null, null);
	}
	
}
