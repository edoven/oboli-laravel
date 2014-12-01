<?php

use Carbon\Carbon;

include_once(app_path().'/utils.php');



class CodeController extends BaseController {
	
	// //auth not needed
	// public function useCodeWeb($id)
	// {
	// 	if (Auth::guest())
	// 	{
	// 		Session::put('code', $id);
	// 		return Redirect::to('/access');
	// 	}
	// 	$user_id = Auth::user()->id;
	// 	$return_object = CodeService::useCode($user_id, $id);
	// 	if ($return_object['status'] == 'error')
	// 		return Redirect::to('/')->with('message', 'Error: '.$return_object['message']);
	// 		// switch ($return_object['message']) 
	// 		// {
	// 		// 	case 'missing_user_id':
	// 		// 		return Redirect::to('/')->with('message', 'Error: missing_user_id');
	// 		//     case 'missing_code_id':
	// 		//     	return Redirect::to('/')->with('message', 'Error: missing_code_id');
	// 		// 	case 'unknown_code':
	// 		//     	return Redirect::to('/')->with('message', 'Error: unknown_code');
	// 		// 	case 'unknown_user':
	// 		// 		return Redirect::to('/')->with('message', 'Error: unknown_user');
	// 		//     case 'already_used_code':
	// 		//     	return Redirect::to('/')->with('message', 'Error: already_used_code');
	// 		//     default:
	// 		//    		return Redirect::to('/')->with('message', 'Internal Server Error');
	// 		// }
	// 	if ($return_object['status'] == 'success')
	// 	{
	// 		if (Session::has('code') && (Session::get('code') == $id))
	// 			Session::forget('code');
	// 		Session::put('obolis', $return_object['data']['user_obolis_count']);
	// 		return "Success! You have just earned ".$return_object['data']['code_obolis']." obolis! 
	// 				Now you have ".$return_object['data']['user_obolis_count']." oboli. 
	// 				<a href=\"/codes\">GO BACK</a>";
	// 	}			
	// 	return "Internal Server Error";
	// }


	//auth not needed
	public function useCodeWeb($id)
	{
		if (Auth::guest())
		{
			Log::info('CodeController::useCodeWeb('.$id.') as guest');
			Session::put('code', $id);
			return Redirect::to('/access');
		}
		$user_id = Auth::user()->id;
		Log::info('CodeController::useCodeWeb('.$id.') as user '.$user_id);
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
			// return "Success! You have just earned ".$return_object['data']['code_obolis']." obolis! 
			// 		Now you have ".$return_object['data']['user_obolis_count']." oboli. 
			// 		<a href=\"/codes\">GO BACK</a>";
		}			
		return Redirect::to('error')->withMessage('Internal Server Error');
	}

	// auth needed
	public function useCodeRest($id)
	{
		$user_id = Input::get('user_id');
		Log::info('CodeController::useCodeRest('.$id.') as user '.$user_id);
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
				case 'already_used_code':
					return Utils::create_json_response('error', 400, 'requests_limit_reached', null, null);
					
			    default:
			    	return Utils::create_json_response('error', 500, 'internal server error: unknown $return_object[message]', null, null);
			}

		if ($return_object['status'] == 'success')
				return Utils::create_json_response("success", 
											200, 
											'You have just earned '.$return_object['data']['code_obolis'].' oboli! Now you have '.$return_object['data']['user_obolis_count'].' oboli.', 
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
