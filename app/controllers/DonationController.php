<?php

include_once(app_path().'/utils.php');


class DonationController extends BaseController {
	

	
	
	public function makeDonation()
	{		
		if (Request::is("api/*"))
			$user_id = Input::get('user_id');
		else
			$user_id = Auth::id();
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount');
		$return_array = DonationService::makeDonation($user_id, $ngo_id, $amount);
		if ($return_array['status']=='error')
			if (Request::is("api/*"))
				return Utils::create_json_response("error", 400, $return_array['message'],null,array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
			else 
				return 'Error: '.$return_array['message'];
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
