<?php

include_once(app_path().'/utils.php');


class NgoRestController extends BaseController {
		
	public function showAll()
	{
		Log::info('NgoController::showAll');
		$ngos = Ngo::all()->toArray();
		Log::info('NgoRestController::showAll', array($ngos));
		$enriched_ngos = array();
		foreach ($ngos as $ngo)
		{
			$ngo['img_url'] = Config::get('local-config')['host'].'/img/mobile/ngos/'.$ngo['name_short'].'.jpg';
			array_push($enriched_ngos, $ngo);
		}
			
		return Utils::create_json_response("success", 200, null, null, array('ngos' => $enriched_ngos));
	}
	
	public function showDetails($id)
	{
		Log::info('NgoController::showDetails('.$id.')');
		$ngo = Ngo::findOrFail($id);	
		$user_donations = Donation::where('ngo_id', $id)->where('user_id', Input::get('user_id'))->get();
		return Utils::create_json_response("success",200,null, null, array('ngo'=>$ngo, 'user_donations'=>$user_donations));
	}
	
}
