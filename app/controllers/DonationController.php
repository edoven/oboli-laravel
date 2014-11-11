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
			return View::make('error')->withMessage($return_array['message']);
		if ($return_array['status']=='success')
			return Redirect::to('/donations/'.$return_array['data']['donation_id']);	
		return View::make('error')->withMessage('internal server error');	
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
			return Utils::create_json_response("success", 200, 'a donation of '.$amount.' obolis to ngo '.$ngo_id.' has been made',null,array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
		return Utils::create_json_response("error", 500, 'internal server error', null, array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount));
	}


	public function showDonationPage($id)
	{		
		Log::info('DonationController::showDonationPage('.$id.')');

		$donation = Donation::findOrFail($id);
		$user_name = User::findOrFail($donation->user_id)->name;
		$ngo_name = Ngo::findOrFail($donation->ngo_id)->name;
		$data = array('user_name' => $user_name,
					  'amount' => $donation->amount,
					  'ngo_name' => $ngo_name);
		return View::make('donation', $data);
	}
	

}
