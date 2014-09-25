<?php

class UserController extends BaseController {
	
	public function showAll()
	{
		$users = User::all();
		
		if (Request::is('api/v1/*'))
		{
			return Response::json(array(
				'status' => 'success',
				'users' => $users->toArray()),
				200
			);	
		}
		return View::make('users')->with('users', $users); 
	}
	
	public function showProfile($id)
	{
		if (Auth::id() != $id) //TODO handle this with exceptions
			App::abort(403, 'Access denied');
		
		$user = User::findOrFail($id);	//this already manage the web vs rest response (look at errors.php)
		$donations = Donation::where('user_id', '=', $id)->get();
		
		if (Request::is('api/v1/*'))
		{
			return Response::json(array(
				'status' => 'success',
				'user' => $user->toArray(),
				'donations' => $donations->toArray()),
				200
			);	
		}
		return View::make('user')->with('user', $user)->with('donations', $donations); 
	}
	
	
	public function makeDonation()
	{		
		$user_id = Auth::user()->id;
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount'); //CHECK >0
		if ($amount<1)
			return "error with amount";
		$ngo = Ngo::findOrFail($ngo_id);	
		try {
			DB::beginTransaction();
			$user = User::findOrFail($user_id);	
			$user_oboli_count = $user['oboli_count'];
			if ($user_oboli_count<$amount)
			{
				DB::connection()->getPdo()->rollBack();
				return "not enought money";
			}
			DB::table('users')->where('id', $user_id)->update(array('oboli_count' => ($user_oboli_count-$amount)));
			DB::table('ngos')->where('id', $ngo_id)->update(array('oboli_count' => ($ngo['oboli_count']+$amount)));
			DB::table('donations')->insert(array('user_id' => $user_id, 'ngo_id' => $ngo_id, 'amount' => $amount));		
			DB::commit();
		} catch (PDOException $e) {
			DB::rollBack();
		}	
		return Redirect::to('ngos/'.$ngo_id);
	}
	

}
