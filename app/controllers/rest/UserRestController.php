<?php

include_once(app_path().'/utils.php');


class UserRestController extends BaseController {
	

	public function showProfile($id)
	{
		Log::info('UserController::showProfileRest('.$id.')');
		$auth_user_id = Input::get('user_id');
		if ($auth_user_id != $id)
			return Utils::create_json_response("error", 401, 'Access denied', 'You can only access info for the auth user', array());	
		$user = User::find($id);
		if ($user == null)
			return Utils::create_json_response("error", 500, 'Internal Server Error', '', array());
		$helped_ngos = User::getHelpedNgos($id);
		$brands2obolis = User::getBrands2Obolis($id);		
		return Utils::create_json_response("success", 200, null, null, 
									array('user' => $user->toArray(),
										  'helped_ngos'=>$helped_ngos,
										  'brands2obolis'=>$brands2obolis));
	}


	public function addPhoto()
	{
		Log::info('UserController::addPhotoRest');
		$auth_user_id = Input::get('user_id');
		if (!Input::hasFile('photo'))
			return Utils::create_json_response('error', 400, 'missing photo file', null, array());
		if (!Input::file('photo')->isValid())
			return Utils::create_json_response('error', 400, 'file not valid', null, array());
		$extension = Input::file('photo')->getClientOriginalExtension();
		//Log::info('addPhotoRest - $extension = '.$extension);
		if ($extension!='png' && $extension!='jpg')
			return Utils::create_json_response('error', 400, 'not a valid file extension, only png/jpg are allowed', null, array());
		$size = Input::file('photo')->getSize();	
		//Log::info('addPhotoRest - $size = '.$size);
		if ($size>1000000)
			return Utils::create_json_response('error', 400, 'image side is too large, max size is 1MB', null, array());
		$file = Input::file('photo');
		$destinationPath = public_path().'/img/users/';
		$filename = $auth_user_id.'_'.str_random(20).'.'.$extension; // example 1_ffgedsedfregfdrrthsf.jpg
		$upload_success = $file->move($destinationPath, $filename);	
	
		if( $upload_success ) 
		{
			$user = User::find($auth_user_id);
			$user->profile_image = $filename;
			$user->save();
			return Utils::create_json_response('success', 200, null, null, array('url' => Config::get('local-config')['host'].'/img/users/'.$filename ));
		}	
		else
			return Utils::create_json_response('error', 400, 'upload error', null, array());
	}
	
	
}
