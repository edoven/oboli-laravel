<?php

use Carbon\Carbon;

include_once(app_path().'/utils.php');



class CodeWebController extends BaseController {
	
		
	public function useCode($id)
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

}
