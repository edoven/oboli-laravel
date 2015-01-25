<?php

include_once(app_path().'/utils.php');


class DonationWebController extends BaseController {
	

	public function makeDonation()
	{		
		$user_id = Auth::id();
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount');
		Log::info('DonationController::makeDonationWeb', array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount ));
		$return_array = DonationService::makeDonation($user_id, $ngo_id, $amount);
		if ($return_array['status']=='error')
			return Redirect::to('error')->withMessage($return_array['message']);
		if ($return_array['status']=='success'){
			$hashed_id = Hashids::encode($return_array['data']['donation_id']);
			return Redirect::to('/donations/'.$hashed_id); // this route calls DonationController@showDonationPage			
		}		
		return Redirect::to('error')->withMessage('internal server error');	
	}



	public function showDonationPage($hashed_id)
	{		
		Log::info('DonationController::showDonationPage('.$hashed_id.')');

		$ids = Hashids::decode($hashed_id);
		if (count($ids)>0)
			$id = $ids[0];
		else
			return Redirect::to('404');
		$donation = Donation::findOrFail($id);
		$user_name = User::findOrFail($donation->user_id)->name;
		$ngo = Ngo::findOrFail($donation->ngo_id);
		$data = array('user_name' => $user_name,
					  'amount' => $donation->amount,
					  'ngo' => $ngo,
					  'recent_ngos' => Ngo::where('oboli_count', '>', 0)->orderByRaw("RAND()")->take(3)->remember(30)->get());
		return View::make('donation', $data);
	}
	

}
