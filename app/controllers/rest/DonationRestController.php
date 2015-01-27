<?php

include_once(app_path().'/utils.php');


class DonationRestController extends BaseController {
	

	public function makeDonation()
	{		
		Log::info('DonationController::makeDonationRest', Input::all());

		$user_id = Input::get('user_id');
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount');
		$return_array = DonationService::makeDonation($user_id, $ngo_id, $amount);
		if ($return_array['status']=='error')
			return Utils::create_json_response("error", 400, $return_array['message'], null, array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
		if ($return_array['status']=='success')
		{
			$hashed_id = Hashids::encode($return_array['data']['donation_id']);
			$return_data = array('user_id'=>$user_id, 
							 'ngo_id'=>$ngo_id, 
							 'amount'=>$amount, 
							 'ngo_name'=>$return_array['data']['ngo_name'], 
							 'donation_id'=> $hashed_id,
							 'donation_url'=> Config::get('local-config')['host'].'/donations/'.$hashed_id,
							 'ngo_obolis_count'=> strval( $return_array['data']['ngo_obolis_count'] ),
							 'user_obolis_count'=> strval( $return_array['data']['user_obolis_count'] ),
							 'donors'=> strval( $return_array['data']['donors']),
							 'fb_sharing_link'=> 'https://www.facebook.com/dialog/share?app_id='.Config::get('facebook')['appId'].'&display=popup&href='.Config::get('local-config')['host'].'/donations/'.$hashed_id.'&redirect_uri='.Config::get('local-config')['host'].'/ngos'
							  );
			return Utils::create_json_response("success", 200, 'a donation of '.$amount.' obolis to ngo '.$ngo_id.' has been made', null, $return_data);
		}	
		return Utils::create_json_response("error", 500, 'internal server error', null, array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
	}


}
