<?php


class UserController extends BaseController {
	

	public function showProfile($user_id)
	{
		Log::info('UserController::showProfile('.$user_id.')');
		if (Auth::id() != $user_id)
			return Redirect::to('error')->withMessage('Access denied');
		$user = User::find($user_id);
		if ($user == null)
			return Redirect::to('error')->withMessage('Internal Server Error');
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
