<?php

use Carbon\Carbon;

class CodeService {

	public static function useCode($user_id, $code_id)
	{
		//Log::info('useCode: $user_id='.$user_id.' $code_id='.$code_id);

		if ($user_id === null)
			return Utils::returnError('missing_user_id', null);

		if ($code_id === null)
			return Utils::returnError('missing_code_id', null);

		$user = User::find($user_id);
		if ($user === null)
			return Utils::returnError('unknown_user', null);

		$code = Code::find($code_id);
		if ($code === null)
			return Utils::returnError('unknown_code', null);

		if ($code->user !== null )
			return Utils::returnError('already_used_code', null);

		DB::table('users')->where('id', $user->id)->update(array('oboli_count' => ($user->oboli_count + $code->oboli) ));
	 	DB::table('codes')->where('id', $id)->update(array('user' => $user->id, 'activated_at' => Carbon::now()));
	 	$data = array('code_obolis' => $code->oboli,
					  'user_obolis_count_old' => $user->oboli_count,
					  'user_obolis_count' => ($user->oboli_count + $code->oboli));
		return Utils::returnSuccess('success', $data);
	}

}

?>