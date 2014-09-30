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
		$ngo = Ngo::find($id);
		if ($ngo==Null)
		{
			return Response::json(array(
				'status' => 'error',
				'message' => 'no NGO found with this id'),
				404
			);
		}
		$donations = Donation::where('ngo_id', $id)->get();
		return Response::json(array(
			'status' => 'success',
			'ngo' => $ngo->toArray(),
			'donations' => $donations->toArray()),
			200
		);	
	}
}
