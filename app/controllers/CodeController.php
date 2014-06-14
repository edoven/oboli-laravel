<?php

class CodeController extends BaseController {
	
	public function useCode($id)
	{
		$code = Code::findOrFail($id);
		if ($code->getUser()!=null)
			echo "Sorry, this code is no loger valid!";
		else
		{
			if (Auth::check())
			{			
				$user = Auth::user();
				DB::table('users')
					->where('id', $user->getId())
					->update(array('oboli_count' => ($user->getOboliCount() + $code->getOboli()) ));
				DB::table('codes')
					->where('id', $id)
					->update(array('user' => $user->getId() ));
				echo "Very good! You have just earned ".$code->getOboli()." oboli! Now you have ".($user->getOboliCount() + $code->getOboli())." oboli.";
			}
			else
			{
				return Redirect::to('login');
			}
		}	
	}
}
