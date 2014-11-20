<?php

include_once(app_path().'/utils.php');


class NgoController extends BaseController {
		
	public function showAll()
	{
		Log::info('NgoController::showAll');
		$ngos = Ngo::all();		
		if (Request::is("api/*"))
			return Utils::create_json_response("success", 
										200, 
										null, 
										null, 
										array('ngos' => $ngos->toArray()));
		else
			return View::make('ngos')->with('ngos', $ngos);
	}
	
	public function showDetailsFromIdRest($id)
	{
		Log::info('NgoController::showDetailsFromId('.$id.')');
		$ngo = Ngo::findOrFail($id);	
		$user_donations = Donation::where('ngo_id', $id)->where('user_id', Input::get('user_id'))->get();
		return Utils::create_json_response("success",200,null, null, array('ngo'=>$ngo, 'user_donations'=>$user_donations));
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
