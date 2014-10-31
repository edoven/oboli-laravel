<?php

include_once(app_path().'/utils.php');


class UserController extends BaseController {
	

	public function showProfile($user_id)
	{
		if (Auth::id() != $user_id)
			if (Request::is("api/*"))
				return Utils::create_json_response("error",401,'Access denied','You can only access info for the auth user',null);
			else 
				App::abort(403, 'Access denied');		
		$user = User::findOrFail($user_id);
		$donations = Donation::where('user_id', $user_id)->get();
		$redeems = Code::where('user', $user_id)->get();
		if (Request::is("api/*"))
			return Utils::create_json_response("success", 
										200, 
										null, 
										null, 
										array('user' => $user->toArray(),
											  'donations' => $donations->toArray(),
											  'redeems'=>$redeems->toArray()));
		else
			return View::make('user')->with('user', $user)->with('donations', $donations)->with('redeems', $redeems); ; 
	}
	
	
}
