<?php

use Carbon\Carbon;

class CodeController extends BaseController {
	
	public function useCode($id)
	{
		$code = Code::findOrFail($id);
		if ($code->user!=null)
			echo "Sorry, this code is no loger valid!";
		else
		{
			if (Auth::check())
			{			
				$user = Auth::user();
				DB::table('users')->where('id', $user->id)->update(array('oboli_count' => ($user->oboli_count + $code->oboli) ));
				DB::table('codes')->where('id', $id)->update(array('user' => $user->id, 'activated_at' => Carbon::now()));
				echo "Very good! You have just earned ".$code->oboli." oboli! Now you have ".($user->oboli_count + $code->oboli)." oboli. <a href=\"/codes\">GO BACK</a>";
			}
			else
			{
				return Redirect::to('/login');
			}
		}	
	}

	public function showAll()
	{
		$codes = Code::all();
		return View::make('codes')->with('codes', $codes);
	}
}
