<?php

use Carbon\Carbon;

class CodeController extends BaseController {
	
	public function useCode($id)
	{
		$code = Code::findOrFail($id);
		if ($code->user!=null)
			if (Request::is("api/*"))
				return Utils::create_json_response("error", 400, "code already used", null, array("code"=>$id));
			else
				return "Error: this code has already been used.";		
		$user = Auth::user();
		DB::table('users')->where('id', $user->id)->update(array('oboli_count' => ($user->oboli_count + $code->oboli) ));
		if ($id!='000')  //TODO: REMOVE 000 code
			DB::table('codes')->where('id', $id)->update(array('user' => $user->id, 'activated_at' => Carbon::now()));

		if (Request::is("api/*"))
			return Utils::create_json_response("success", 
										200, 
										'You have just earned '.$code->oboli.' oboli! Now you have '.($user->oboli_count + $code->oboli).' oboli.', 
										null, 
										array('code_obolis' => $code->oboli,
											  'user_obolis_count_old' => $user->oboli_count,
											  'user_obolis_count' => ($user->oboli_count + $code->oboli)));
		else
			echo "Success! You have just earned ".$code->oboli." oboli! Now you have ".($user->oboli_count + $code->oboli)." oboli. <a href=\"/codes\">GO BACK</a>";
	}

	public function showAll()
	{
		$codes = Code::all();
		return View::make('codes')->with('codes', $codes);
	}
}
