<?php

use Carbon\Carbon;

class CodeService {




	//every timeslot is 15 min so
	//0-14 = slot1
	//15-29 = slot2
	//30-44 = slot3
	//45-60 = slot5
	// slot string format yyyymmdd_hhmm_SLOT
	private static function createSlotString($dateTime)
	{
		if ($dateTime->minute>=0 && $dateTime->minute<=14)
			$minute_slot = 1;
		if ($dateTime->minute>=15 && $dateTime->minute<=29)
			$minute_slot = 2;
		if ($dateTime->minute>=30 && $dateTime->minute<=44)
			$minute_slot = 3;
		if ($dateTime->minute>=45 && $dateTime->minute<=59)
			$minute_slot = 4;
		$slotString = "$dateTime->year"."$dateTime->month"."$dateTime->day".'_'."$dateTime->month"."$dateTime->day".'_'.$minute_slot;
		return $slotString;
	}




	public static function useCode($user_id, $code_id)
	{
		Log::info('CodeService::useCode', array('user_id'=>$user_id, 'code_id'=>$code_id) );
		
		if ($user_id === null)
			return Utils::returnError('missing_user_id', null);
		if ($code_id === null)
			return Utils::returnError('missing_code_id', null);
		
		$user = User::find($user_id);
		if ($user === null)
			return Utils::returnError('unknown_user', null);








		$now = Carbon::now();
		$nowSlotString = CodeService::createSlotString($now);
		$requests_counter = RequestsCounter::where('user', $user_id)->first();
		$lastBadRequestSlotString = CodeService::createSlotString( Carbon::parse($requests_counter->code_bad_requests_last) );	
		$isSameSlotOfNow = ($lastBadRequestSlotString == $nowSlotString);
		

		if ($isSameSlotOfNow && ($requests_counter->code_bad_requests_counter  >= 15))
			return Utils::returnError('requests_limit_reached', null);

		$code = Code::find($code_id);			
		if ($code == null)
		{
			$requests_counter->code_bad_requests_counter = 1 + ($isSameSlotOfNow ? $requests_counter->code_bad_requests_counter : 0);
			$requests_counter->code_bad_requests_counter_total = $requests_counter->code_bad_requests_counter_total + 1;
			$requests_counter->code_bad_requests_last = $now;
			$requests_counter->save();
			return Utils::returnError('unknown_code', null);
		}	
		if ($code->user !== null )
		{
			$requests_counter->code_bad_requests_counter = 1 + ($isSameSlotOfNow ? $requests_counter->code_bad_requests_counter : 0);
			$requests_counter->code_bad_requests_counter_total = $requests_counter->code_bad_requests_counter_total + 1;
			$requests_counter->code_bad_requests_last = $now;
			$requests_counter->save();
			return Utils::returnError('already_used_code', null);
		}
				








		$new_obolis_count = $user->oboli_count + $code->oboli;
		DB::table('users')->where('id', $user->id)->update(array('oboli_count' => $new_obolis_count ));

		// TODO: REMOVE!
		if ($code_id != '000')
	 		DB::table('codes')->where('id', $code_id)->update(array('user' => $user->id, 'activated_at' => Carbon::now()));

	 	$data = array('code_obolis' => $code->oboli,
					  'user_obolis_count_old' => $user->oboli_count,
					  'user_obolis_count' => $new_obolis_count);
		return Utils::returnSuccess('success', $data);
	}

}

?>