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
	
	public function showDetails($id)
	{
		$ngo = Ngo::findOrFail($id); //the fail is managed into errors.php to creare a json responses
		$donations = Donation::where('ngo_id', $id)->get();
		return Response::json(array(
			'status' => 'success',
			'ngo' => $ngo->toArray(),
			'donations' => $donations->toArray()),
			200
		);	
	}
}
