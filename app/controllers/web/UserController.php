<?php


class UserController extends BaseController {
	

	public function showProfile($hashed_id)
	{
		$ids = Hashids::decode($hashed_id);
		if (count($ids)>0)
			$user_id = $ids[0];
		else
			return Redirect::to('404');
		Log::info('UserController::showProfile('.$user_id.')');
		if (Auth::id() != $user_id)
			return Redirect::to('error')->withMessage('Access denied');
		$user = User::findOrFail($user_id);
		//$donations = Donation::where('user_id', $user_id)->get();
		$donations = DB::table('donations')
						->where('user_id', $user_id)
						->join('ngos', 'donations.ngo_id', '=', 'ngos.id')
						->select('ngos.name', 'donations.amount', 'donations.id')
						->get();
		$helped_ngos = User::getHelpedNgos($user_id);
		$brands2obolis = User::getBrands2Obolis($user_id);	
		return View::make('user')->with('user', $user)
								 ->with('helped_ngos', $helped_ngos)
								 ->with('brands2obolis', $brands2obolis)
								 ->with('donations', $donations);
	}

	
}
