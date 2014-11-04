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
	
	public function showDetails($id)
	{
		Log::info('NgoController::showDetails('.$id.')');
		$ngo = Ngo::findOrFail($id);	
		if (Request::is("api/*"))
		{
			$user_donations = Donation::where('ngo_id', $id)->where('user_id', Input::get('user_id'))->get();
			return Utils::create_json_response("success",200,null, null, array('ngo'=>$ngo, 'user_donations'=>$user_donations));
		}			
		else
			$donations = Donation::where('ngo_id', $id)->get();
			return View::make('ngo')->with('ngo', $ngo)->with('donations', $donations); 
	}
	
}
