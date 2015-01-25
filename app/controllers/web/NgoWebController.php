<?php

include_once(app_path().'/utils.php');


class NgoWebController extends BaseController {
		
	public function show()
	{
		$category = Input::get('category');
		if ($category == null)
			$ngos = Ngo::all();
		else
			$ngos = Ngo::where('area', $category)->get();
		Log::info('NgoController::show');
		$recent_ngos = Ngo::where('oboli_count', '>', 0)->orderByRaw("RAND()")->take(3)->remember(30)->get();
		return View::make('ngos')->with('ngos', $ngos)->with('recent_ngos',$recent_ngos);
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
		$same_area_ngos = DB::table('ngos')->where('area', $ngo->area)->where('name_short', '<>', $name_short)->orderByRaw("RAND()")->take(3)->remember(500)->get();
		$recent_ngos = Ngo::where('oboli_count', '>', 0)->orderByRaw("RAND()")->take(3)->get();

		//$areas2ngos = Ngo::all()->groupBy("RAND()")->take(3)->remember(30)->get();
		// $areas2ngos = DB::table('ngos')
  //                    ->select(DB::raw('area, count(*) as area_count'))
  //                    ->groupBy('area')
  //                    ->remember(500)
  //                    ->get();
  //       Log::info('########showDetails', array($areas2ngos));

		return View::make('ngo')->with('ngo', $ngo)
								->with('same_area_ngos', $same_area_ngos)
								->with('recent_ngos', $recent_ngos);
	}
	
}
