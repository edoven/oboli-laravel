<?php

class UserController extends BaseController {
	
	public function showAll()
	{
		return View::make('users')->with('users', User::all()); 
	}
	
	public function showProfile($user_id)
	{
		if (Auth::id() != $user_id) //TODO handle this with exceptions
			App::abort(403, 'Access denied');
		
		$user = User::findOrFail($user_id);	//findOrFail also manages the web vs rest response (look at errors.php)
		$donations = Donation::where('user_id', $user_id)->get();
		$redeems = Codes::where('user', $user_id)->get();
		return View::make('user')
						->with('user', $user)
						->with('donations', $donations)
						->with('redeems', $redeems); ; 
	}
	
	
	public function makeDonation()
	{		
		$user_id = Auth::user()->id;
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount'); //CHECK >0
		if ($amount<1)
			App::abort(400, 'The donation amount cannot be smaller than 1');
		$ngo = Ngo::findOrFail($ngo_id);	
		$user = User::findOrFail($user_id);	
		try {
			DB::beginTransaction();		
			$user_oboli_count = $user['oboli_count'];
			if ($user_oboli_count<$amount)
			{
				DB::connection()->getPdo()->rollBack();
				App::abort(400, 'The donation amount is greater than the user obolis count');
			}
			DB::table('users')
				->where('id', $user_id)
				->update(array('oboli_count' => ($user_oboli_count-$amount), 
							   'donated_oboli_count' => (($user->donated_oboli_count)+$amount)));
			DB::table('ngos')
				->where('id', $ngo_id)
				->update(array('oboli_count' => ($ngo['oboli_count']+$amount)));
			DB::table('donations')
				->insert(array('user_id' => $user_id, 
							   'ngo_id' => $ngo_id, 
							   'amount' => $amount));		
			DB::commit();
		} catch (PDOException $e) {
			DB::rollBack();
		}	
		return Redirect::to('ngos/'.$ngo_id);
	}
	

}
