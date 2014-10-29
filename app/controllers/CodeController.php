<?php

use Carbon\Carbon;

include_once(app_path().'/utils.php');



class CodeController extends BaseController {
	
	public function useCode($id)
	{
		if (Request::is("api/*") === false)
			if (Auth::guest())
			{
				Session::put('code_id', $id);
				return Redirect::to('/login');
			}

		if (Request::is("api/*"))
			$user_id = Input::get('user_id');
		else	
			$user_id = Auth::user()->id;
		$return_object = CodeService::useCode($user_id, $id);

		if ($return_object['status'] == 'error')
			switch ($return_object['message']) 
			{
				case 'missing_user_id':
					if (Request::is("api/*"))
						return Utils::create_json_response('error', 400, 'missing_user_id', 'some data is missing', null);
					else
			    		return "Error: some data is missing";
			    case 'missing_code_id':
					if (Request::is("api/*"))
						return Utils::create_json_response('error', 400, 'missing_code_id', 'some data is missing', null);
					else
			    		return "Error: some data is missing";
				case 'unknown_code':
					if (Request::is("api/*"))
						return Utils::create_json_response('error', 404, 'unexisting_code', 'the code does not exist', null);
					else
			    		return "Error: unexisting code";
				case 'unknown_user':
					if (Request::is("api/*"))
						return Utils::create_json_response('error', 500, 'internal server error: unexisting user (the user is authenticated)', null, null);
			    	else
			    		return "Error: an account associated with ".$return_object['data']['email']." already exists";
			    case 'already_used_code':
					if (Request::is("api/*"))
						return Utils::create_json_response('error', 400, 'already_used_code', null, null);
			    	else
			    		return "Error: the code has already been used.";
			    default:
			    	if (Request::is("api/*"))
						return Utils::create_json_response('error', 500, 'internal server error: unknown $return_object[message]', null, null);
			    	else
			    		return "Internal Server Error: unknown $return_object[message]";
			}

		if ($return_object['status'] == 'success')
			if (Request::is("api/*"))
				return Utils::create_json_response("success", 
											200, 
											'You have just earned '.$return_object['data']['code_obolis'].' oboli! Now you have '.$return_object['data']['user_obolis_count'].' oboli.', 
											null, 
											array('code_obolis' => $return_object['data']['code_obolis'],
												  'user_obolis_count_old' => $return_object['data']['user_obolis_count_old'],
												  'user_obolis_count' => $return_object['data']['user_obolis_count']));
			else
				echo "Success! You have just earned ".$return_object['data']['code_obolis']." oboli! Now you have ".$return_object['data']['user_obolis_count']." oboli. <a href=\"/codes\">GO BACK</a>";

		if (Request::is("api/*"))
			return Utils::create_json_response('error', 500, 'internal server error', null, null);
    	else
    		return "Internal Server Error";
	}

	// public function useCode($id)
	// {

	// 	$code = Code::find($id);
	// 	if ($code==null)
	// 		if (Request::is("api/*"))
	// 			return Utils::create_json_response("error", 404, "code does not exist", null, array("code"=>$id));
	// 		else
	// 			return "Error: this code does not exist.";
	// 	if ($code->user!=null)
	// 		if (Request::is("api/*"))
	// 			return Utils::create_json_response("error", 400, "code already used", null, array("code"=>$id));
	// 		else
	// 			return "Error: this code has already been used.";	
	// 	if (Request::is("api/*"))
	// 		$user = User::find(Input::get('user_id'));
	// 	else	
	// 		$user = Auth::user();
	// 	DB::table('users')->where('id', $user->id)->update(array('oboli_count' => ($user->oboli_count + $code->oboli) ));
	// 	if ($id!='000')  //TODO: REMOVE 000 code
	// 		DB::table('codes')->where('id', $id)->update(array('user' => $user->id, 'activated_at' => Carbon::now()));

	// 	if (Request::is("api/*"))
	// 		return Utils::create_json_response("success", 
	// 									200, 
	// 									'You have just earned '.$code->oboli.' oboli! Now you have '.($user->oboli_count + $code->oboli).' oboli.', 
	// 									null, 
	// 									array('code_obolis' => $code->oboli,
	// 										  'user_obolis_count_old' => $user->oboli_count,
	// 										  'user_obolis_count' => ($user->oboli_count + $code->oboli)));
	// 	else
	// 		echo "Success! You have just earned ".$code->oboli." oboli! Now you have ".($user->oboli_count + $code->oboli)." oboli. <a href=\"/codes\">GO BACK</a>";
	// }

	public function showAll()
	{
		$codes = Code::all();
		return View::make('codes')->with('codes', $codes);
	}
}
