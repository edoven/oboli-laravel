<?php

include_once(app_path().'/utils.php');


class NgoController extends BaseController {
		
	public function showAll()
	{
		Log::info('NgoController::showAll');
		return View::make('ngos')->with('ngos', Ngo::all());
	}
	
	
	public function showDetails($id)
	{
		Log::info('NgoController::showDetailsFromId('.$id.')');
		$ngo = Ngo::find($id);
		if ($ngo == null)
			return Redirect::to('/404');
		return Redirect::to('/ngos/'.$ngo->name_short);
	}

	public function showDetailsFromName($name_short)
	{
		Log::info('NgoController::showDetailsFromName('.$name_short.')');
		$ngo = Ngo::where('name_short', $name_short)->first();
		if ($ngo == null)
			return Redirect::to('/404');
		return View::make('ngo')->with('ngo', $ngo); 
	}
	
}
