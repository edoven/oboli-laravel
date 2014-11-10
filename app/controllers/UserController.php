<?php

include_once(app_path().'/utils.php');


class UserController extends BaseController {
	

	public function showProfile($user_id)
	{
		Log::info('UserController::showProfile('.$user_id.')');
		if (Auth::id() != $user_id)
			App::abort(403, 'Access denied');		
		$user = User::find($user_id);
		if ($user == null)
			App::abort(500, 'Internal Server Error');
		$donations = Donation::where('user_id', $user_id)->get();
		$redeems = Code::where('user', $user_id)->get();
		return View::make('user')->with('user', $user)->with('donations', $donations)->with('redeems', $redeems);
	}


	public function showProfileRest($id)
	{
		Log::info('UserController::showProfileRest('.$id.')');
		$auth_user_id = Input::get('user_id');
		if ($auth_user_id != $id)
			return Utils::create_json_response("error", 401, 'Access denied', 'You can only access info for the auth user', null);	
		$user = User::find($id);
		if ($user == null)
			return Utils::create_json_response("error", 500, 'Internal Server Error', '', null);	
		$donations = Donation::where('user_id', $id)->get();
		$redeems = Code::where('user', $id)->get();
		
		return Utils::create_json_response("success", 200, null, null, 
									array('user' => $user->toArray(),
										  'donations' => $donations->toArray(),
										  'redeems'=>$redeems->toArray()));
	}


	public function addPhotoRest()
	{
		Log::info('UserController::addPhotoRest');
		$auth_user_id = Input::get('user_id');
		if (!Input::hasFile('photo'))
			return Utils::create_json_response('error', 400, 'missing photo file', null, null);
		if (!Input::file('photo')->isValid())
			return Utils::create_json_response('error', 400, 'file not valid', null, null);
		$extension = Input::file('photo')->getClientOriginalExtension();
		//Log::info('addPhotoRest - $extension = '.$extension);
		if ($extension!='png' && $extension!='jpg')
			return Utils::create_json_response('error', 400, 'not a valid file extension, only png/jpg are allowed', null, null);
		$size = Input::file('photo')->getSize();	
		//Log::info('addPhotoRest - $size = '.$size);
		if ($size>1000000)
			return Utils::create_json_response('error', 400, 'image side is too large, max size is 1MB', null, null);
		$file = Input::file('photo');
		$destinationPath = public_path().'/img/users/';
		$filename = $auth_user_id.'.'.$extension;
		$upload_success = $file->move($destinationPath, $filename);	
		if( $upload_success ) 
			return Utils::create_json_response('success', 200, null, null, array('url' => Config::get('local-config')['host'].'/img/users/'.$filename ));
		else
			return Utils::create_json_response('error', 400, 'upload error', null, null);
	}
	
	
}
