<?php


class DonationService
{

	//This methos add a new donation, it does not check if the donator and the authenticated user are the same
	public static function makeDonation($user_id, $ngo_id,	$amount)
	{
		if (User::find($user_id)->activated == 0)
			return Utils::returnError('user_not_activated', null);

		if ($amount<1)
			return Utils::returnError('donation_amount_error', null);		
		try {
			DB::beginTransaction();		
			$ngo = Ngo::find($ngo_id);	
			if ($ngo == null)
				return Utils::returnError('unexisting_ngo', null);
			$user = User::find($user_id);
			if ($user == null)
				return Utils::returnError('unexisting_user', null);
			$user_oboli_count = $user['oboli_count'];
			
			if ($user_oboli_count<$amount)
			{
				DB::connection()->getPdo()->rollBack();
				return Utils::returnError('The donation amount is greater than the user obolis count', null);
			}
			DB::table('users')
				->where('id', $user_id)
				->update(array('oboli_count' => ($user_oboli_count-$amount), 
							   'donated_oboli_count' => (($user->donated_oboli_count)+$amount)));
			$already_donated = (DB::table('donations')->where('user_id', $user_id)->where('ngo_id', $ngo_id)->first() != null);
			if ($already_donated==true)
				DB::table('ngos')
					->where('id', $ngo_id)
					->update(array('oboli_count' => ($ngo['oboli_count']+$amount),
								   'donations_count' => $ngo['donations_count']+1));
			else
				DB::table('ngos')
					->where('id', $ngo_id)
					->update(array('oboli_count' => ($ngo['oboli_count']+$amount),
								   'donations_count' => ($ngo['donations_count']+1),
								   'donors' => ($ngo['donors']+1) ));
			$created_at = date('y-m-d h:i:s');
			DB::table('donations')
				->insert(array('user_id' => $user_id, 
							   'ngo_id' => $ngo_id, 
							   'amount' => $amount,
							   'created_at' => $created_at,
							   'updated_at' => $created_at));	
			DB::commit();
		} catch (PDOException $e) {
			DB::rollBack();
			return Utils::returnError($e->getMessage(), null);
		}	
		return Utils::returnSuccess('donation_made', null);
	}
	
		
}

?>