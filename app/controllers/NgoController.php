<?php

class NgoController extends BaseController {
		
	public function showAll()
	{
		$ngos = Ngo::all();	
		
		if (Request::is('api/v1/*'))
		{
			return Response::json(array(
				'status' => 'success',
				'projects' => $ngos->toArray()),
				200
			);	
		}
		return View::make('ngos')->with('ngos', $ngos);
	}
	
	public function showDetails($id)
	{
		$ngo = Ngo::findOrFail($id);	
		$donations = Donation::where('ngo_id', $id)->get();
		
		if (Request::is('api/v1/*'))
		{
			return Response::json(array(
				'status' => 'success',
				'ngo' => $ngo->toArray(),
				'donations' => $donations->toArray()),
				//'donations' => $donations->toArray()),
				200
			);	
		}
		return View::make('ngo')->with('ngo', $ngo)
									->with('donations', $donations); 
	}
	
}
