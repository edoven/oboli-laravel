<?php

class NgoRestController extends BaseController {
	
	public function showAll()
	{	
		return Response::json(array(
			'status' => 'success',
			'ngos' => Ngo::all()->toArray()),
			200
		);	
	}
	
	
	//it returns the NGO details + donations for the authenticated user
	public function showDetails($id)
	{
		$ngo = Ngo::findOrFail($id); //the fail is managed into errors.php to creare a json responses
		$user_id = Input::get('user_id');
		$user_donations = DB::table('donations')->where('ngo_id', $id)->where('user_id', $user_id)->get();
		if ($user_donations == null)
			$user_donations = array();
		return Response::json(array(
			'status' => 'success',
			'ngo' => $ngo->toArray(),
			'user_donations' => $user_donations->toArray()),
			200
		);	
	}
}
