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
	
	
	public function makeDonation()
	{		
		$user_id = Auth::id();
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount'); //CHECK >0
		$return_array = DonationService::makeDonation($user_id, $ngo_id, $amount);
		if ($return_array['status']=='error')
			if (Request::is("api/*"))
				return Utils::create_json_response("error",400,$return_array['message'],null,array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
			else 
				App::abort(400, $return_array['message']);
		if ($return_array['status']=='success')
			if (Request::is("api/*"))
				return Utils::create_json_response("success", 200, 'a donation of '.$amount.' obolis to ngo '.$ngo_id.' has been made',null,array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
			else
				return Redirect::to('ngos/'.$ngo_id);

		if (Request::is("api/*"))
					return Utils::create_json_response("error", 500, 'internal server error',null,array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
			else
				App::abort(500, 'internal server error');
	}
	

}
