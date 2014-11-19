<?php

include_once(app_path().'/utils.php');


class DonationController extends BaseController {
	

	public function makeDonationWeb()
	{		
		$user_id = Auth::id();
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount');
		Log::info('DonationController::makeDonationWeb', array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount ));
		$return_array = DonationService::makeDonation($user_id, $ngo_id, $amount);
		if ($return_array['status']=='error')
			return Redirect::to('error')->withMessage($return_array['message']);
		if ($return_array['status']=='success')
			return Redirect::to('/donations/'.$return_array['data']['donation_id']); // this route calls DonationController@showDonationPage
		return Redirect::to('error')->withMessage('internal server error');	
	}

	public function makeDonationRest()
	{		
		Log::info('DonationController::makeDonationRest', Input::all());

		$user_id = Input::get('user_id');
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount');
		$return_array = DonationService::makeDonation($user_id, $ngo_id, $amount);
		if ($return_array['status']=='error')
			return Utils::create_json_response("error", 400, $return_array['message'], null, array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
		if ($return_array['status']=='success')
			return Utils::create_json_response("success", 200, 'a donation of '.$amount.' obolis to ngo '.$ngo_id.' has been made', null, array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
		
		$return_data = array('user_id'=>$user_id, 
							 'ngo_id'=>$ngo_id, 
							 'amount'=>$amount, 
							 'donation_id'=>$return_array['data']['donation_id'],
							 'obolis_count'=>$return_array['data']['obolis_count'],
							 'donors'=>$return_array['data']['donors']);
		return Utils::create_json_response("error", 500, 'internal server error', null, $return_data);
	}


	public function showDonationPage($id)
	{		
		Log::info('DonationController::showDonationPage('.$id.')');

		$donation = Donation::findOrFail($id);
		$user_name = User::findOrFail($donation->user_id)->name;
		$ngo = Ngo::findOrFail($donation->ngo_id);
		$data = array('user_name' => $user_name,
					  'amount' => $donation->amount,
					  'ngo' => $ngo);
		return View::make('donation', $data);
	}
	

}
