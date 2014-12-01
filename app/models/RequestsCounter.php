<?php


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
		//$rc->code_requests_counter = 0;
		//$rc->code_requests_date = null;
		$rc->save();
	}

	
}
