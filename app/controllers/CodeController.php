<?php

use Carbon\Carbon;

include_once(app_path().'/utils.php');



class CodeController extends BaseController {
	
		
	public function useCodeWeb($id)
	{
		if (Auth::guest())
		{
			Log::info('CodeController::useCodeWeb('.$id.') as guest');
			Session::put('code', $id);
			return Redirect::to('/');
		}
		$user_id = Auth::user()->id;
		$return_object = CodeService::useCode($user_id, $id);
		Log::info('CodeController::useCodeWeb('.$id.') as user: '.Auth::user()->email, array('return_object'=>$return_object));
		if ($return_object['status'] == 'error')
			return Redirect::to('error')->withMessage($return_object['message']);
		if ($return_object['status'] == 'success')
		{
			if (Session::has('code') && (Session::get('code') == $id))
				Session::forget('code');
			Session::put('obolis', $return_object['data']['user_obolis_count']);
			return Redirect::to('/ngos')->with('new_code', 1)
										->with('amount', $return_object['data']['code_obolis']);
		}			
		return Redirect::to('error')->withMessage('Internal Server Error');
	}

	// auth needed
	public function useCodeRest($id)
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


	public function showAll()
	{
		$codes = Code::all();
		return View::make('codes')->with('codes', $codes);
	}
}
