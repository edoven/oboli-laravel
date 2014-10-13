<?php

use Carbon\Carbon;

class CodeRestController extends BaseController {
	
	public function useCode($id)
	{
		$code = Code::findOrFail($id);
		if ($code->user!=null)
			return Response::json(array(
				'status' => 'error',
				'message' => 'this code was already been used'),
				400
			);
		$user_id = Input::get('user_id');
		$user = User::findOrFail($user_id);
		DB::table('users')->where('id', $user_id)->update(array('oboli_count' => ($user->oboli_count + $code->oboli) ));
		DB::table('codes')->where('id', $id)->update(array('user' => $user_id, 'activated_at' => Carbon::now()));
		return Response::json(array(
				'status' => 'success',
				'message' => 'You have just earned '.$code->oboli.' oboli! Now you have '.($user->oboli_count + $code->oboli).' oboli.',
				'oboli_count' => ($user->oboli_count + $code->oboli)),
				200
			);
	}
	
}
