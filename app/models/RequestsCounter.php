<?php

use Carbon\Carbon;

class RequestsCounter extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'requests_counters';



	public static function addUser($user_id)
	{
		$rc = new RequestsCounter;
		$rc->user = $user_id;
		$rc->code_bad_requests_counter = 0;
		$rc->code_bad_requests_last = Carbon::now();
		$rc->code_bad_requests_counter_total = 0;
		$rc->save();
	}

	
}
