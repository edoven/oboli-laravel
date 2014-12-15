<?php


class DonationService
{

	private static function validateInput($user_id, $ngo_id, $amount)
	{
		$user = User::find($user_id);
		if ($user == null)
				return Utils::returnError('unexisting_user', null);
		$ngo = Ngo::find($ngo_id);	
		if ($ngo == null)
			return Utils::returnError('unexisting_ngo', null);
		if ($user->confirmed == 0 && (FacebookProfile::where('user_id', $user_id)->first()==null) )
			return Utils::returnError('user_not_activated', null);
		if ($amount<1)
			return Utils::returnError('donation_amount_error', null);		
		$user_oboli_count = $user->oboli_count;
		if ($user_oboli_count<$amount)
			return Utils::returnError('The donation amount is greater than the user obolis count', null);	
		return Utils::returnSuccess(null,null);
	}

	//This methoss add a new donation, it does not check if the donator and the authenticated user are the same
	public static function makeDonation($user_id, $ngo_id, $amount)
	{
		Log::info('DonationService::makeDonation', array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount) );

		$validation = DonationService::validateInput($user_id, $ngo_id, $amount);
		if ($validation['status']=='error')
			return Utils::returnError($validation['message'],null);
		$user = User::find($user_id);
		$ngo = Ngo::find($ngo_id);	
		$user_oboli_count = $user->oboli_count;

		$new_obolis_count = $ngo->oboli_count + $amount;
		$new_donors_count = null;
		try {
			DB::beginTransaction();											
			DB::table('users')
				->where('id', $user_id)
				->update(array('oboli_count' => ($user_oboli_count-$amount), 
							   'donated_oboli_count' => (($user->donated_oboli_count)+$amount)));
			$already_donated = (DB::table('donations')->where('user_id', $user_id)->where('ngo_id', $ngo_id)->first() != null);
			if ($already_donated == true)
			{
				$new_donors_count = $ngo->donors;
				DB::table('ngos')
					->where('id', $ngo_id)
					->update(array('oboli_count' => $new_obolis_count,
								   'donations_count' => $ngo->donations_count +1));
			}
			else
			{
				$new_donors_count = $ngo->donors + 1;
				DB::table('ngos')
					->where('id', $ngo_id)
					->update(array('oboli_count' => $new_obolis_count,
								   'donations_count' => ($ngo->donations_count +1),
								   'donors' => ($ngo->donors +1) ));
			}
				
			$created_at = date('y-m-d h:i:s');
			$donation_id = DB::table('donations')
							->insertGetId(array('user_id' => $user_id, 
										   'ngo_id' => $ngo_id, 
										   'amount' => $amount,
										   'created_at' => $created_at,
										   'updated_at' => $created_at));	
			DB::commit();
		} catch (PDOException $e) {
			DB::rollBack();
			return Utils::returnError($e->getMessage(), null);
		}	
		$return_data = array('donation_id'=>$donation_id, 
							 'obolis_count'=>$new_obolis_count, 
							 'donors'=>$new_donors_count,
							 'ngo_name'=>$ngo->name);
		return Utils::returnSuccess('donation_made', $return_data);
	}
	
		
}

?>
