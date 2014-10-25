<?php

class NgoRestController extends BaseController {
	
	public function showAll()
	{	
		return Response::json(array(
			'status' => 'success',
			'code' => '200',
			'ngos' => Ngo::all()->toArray()), //TODO: remove useless fields
			200
		);	
	}
	
	
	//it returns the NGO details + donations for the authenticated user
	public function showDetails($id)
	{
		$ngo = Ngo::findOrFail($id); //the fail is managed into errors.php to creare a json responses
		$user_id = Input::get('user_id');
		$user_donations = Donation::where('ngo_id', $id)->where('user_id', $user_id)->get();
		return Response::json(array(
			'status' => 'success',
			'code' => '200',
			'ngo' => $ngo->toArray(),
			'user_donations' => $user_donations->toArray()),
			200
		);	
	}
}
