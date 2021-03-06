<?php


class DonationService
{

	private static function validateInput($user, $ngo, $amount)
	{
		if ($user == null)
			return Utils::returnError('unexisting_user', null);	
		if ($ngo == null)
			return Utils::returnError('unexisting_ngo', null);
		if ($user->confirmed == 0 && (FacebookProfile::where('user_id', $user_id)->first()==null) )
			return Utils::returnError('user_not_activated', null);
		if ($amount<1)
			return Utils::returnError('donation_amount_error', null);		
		if ($amount > $user->oboli_count)
			return Utils::returnError('The donation amount is greater than the user obolis count', null);	
		/*
		* ADD VALIDATION FOR CODES ARRAY
		*/
		return Utils::returnSuccess(null,null);
	}

	// WORKING ONE!!!
	//This method add a new donation, it does not check if the donator and the authenticated user are the same
	// public static function makeDonation($user_id, $ngo_id, $amount)
	// {
	// 	Log::info('DonationService::makeDonation', array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount) );

	// 	DB::beginTransaction();

	// 	try{
	// 		$user = User::find($user_id);
	// 		$ngo = Ngo::find($ngo_id);
	// 		$user_is_new_donor = (DB::table('donations')->where('user_id', $user_id)->where('ngo_id', $ngo_id)->first() == null);
	// 	} catch (Exception $e) {
	// 		DB::rollback();
	// 		return Utils::returnError($e->getMessage(), null);
	// 	}

	// 	$validation = DonationService::validateInput($user, $ngo, $amount);
	// 	if ($validation['status']=='error')
	// 		return Utils::returnError($validation['message'],null);

	// 	//update user
	//  	$user->oboli_count = $user->oboli_count - $amount;
	// 	$user->donated_oboli_count = $user->donated_oboli_count + $amount;
	// 	//update ngo
	// 	if ($user_is_new_donor) 
	// 		$ngo->donors = $ngo->donors + 1; //add a new donors to the ngo
	// 	$ngo->oboli_count = $ngo->oboli_count + $amount;
	// 	$ngo->donations_count = $ngo->donations_count + 1;
	// 	//create donation
	// 	$donation = new Donation;
	// 	$donation->user_id = $user_id;
	// 	$donation->amount = $amount;
	// 	$donation->ngo_id = $ngo_id;

	// 	try{
	// 		$user->save();
	// 		$ngo->save();
	// 		$donation->save();
	// 	} catch (Exception $e) {
	// 		DB::rollback();
	// 		return Utils::returnError($e->getMessage(), null);
	// 	}

	// 	DB::commit();

	// 	$return_data = array('donation_id'=>$donation->id, 
	// 						 'ngo_obolis_count'=>$ngo->oboli_count, 
	// 						 'donors'=>$ngo->donors,
	// 						 'ngo_name'=>$ngo->name,
	// 						 'user_obolis_count'=> $user->oboli_count );
	// 	return Utils::returnSuccess('donation_made', $return_data);
	// }

	public static function makeDonation($user_id, $ngo_id, $amount)
	{
		Log::info('DonationService::makeDonation', array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount) );

		DB::beginTransaction();

		try{
			$user = User::find($user_id);		
			$ngo = Ngo::find($ngo_id);		
			$user_is_new_donor = (DB::table('donations')->where('user_id', $user_id)->where('ngo_id', $ngo_id)->first() == null);
			
			$validation = DonationService::validateInput($user, $ngo, $amount);
			if ($validation['status']=='error')
				return Utils::returnError($validation['message'],null);	

		 	$user->oboli_count = $user->oboli_count - $amount;
			$user->donated_oboli_count = $user->donated_oboli_count + $amount;
			$user->save();

			if ($user_is_new_donor) 
				$ngo->donors = $ngo->donors + 1; //add a new donors to the ngo
			$ngo->oboli_count = $ngo->oboli_count + $amount;
			$ngo->donations_count = $ngo->donations_count + 1;
			$ngo->save();

			$donation = new Donation;
			$donation->user_id = $user_id;
			$donation->ngo_id = $ngo_id;
			$donation->amount = $amount;
			$donation->save();

			$codes = Code::whereRaw('user = '.$user_id.' and remaining_obolis > 0')->orderBy('activated_at')->get();
			$to_donate = $amount;
			foreach ($codes as $code)
			{
				$donation_for_this_line = ($to_donate <= $code->remaining_obolis ? $to_donate : $code->remaining_obolis);
				$donation_line = new DonationLine($donation->id, $code->id, $donation_for_this_line);
				$donation_line->save();

				$code->remaining_obolis = $code->remaining_obolis - $donation_for_this_line;	// zero	
				$code->donated_obolis = $code->donated_obolis + $donation_for_this_line; //this should be equal to $code->oboli							
				$code->save();

				$to_donate = $to_donate - $donation_for_this_line;

				if ($to_donate==0) break;
			}
		} catch (Exception $e) {
			DB::rollback();
			return Utils::returnError($e->getMessage(), null);
		}

		DB::commit();

		$return_data = array('donation_id'=>$donation->id, 
							 'ngo_obolis_count'=>$ngo->oboli_count, 
							 'donors'=>$ngo->donors,
							 'ngo_name'=>$ngo->name,
							 'user_obolis_count'=> $user->oboli_count );
		return Utils::returnSuccess('donation_made', $return_data);		
	}





	// WORKING ONE!!!
	//This methoss add a new donation, it does not check if the donator and the authenticated user are the same
	// public static function makeDonation($user_id, $ngo_id, $amount)
	// {
	// 	Log::info('DonationService::makeDonation', array('user_id'=>$user_id, 'ngo_id'=>$ngo_id, 'amount'=>$amount) );
	// 	$validation = DonationService::validateInput($user_id, $ngo_id, $amount);
	// 	if ($validation['status']=='error')
	// 		return Utils::returnError($validation['message'],null);
	// 	$user = User::find($user_id);
	// 	$ngo = Ngo::find($ngo_id);	
	// 	$user_oboli_count = $user->oboli_count;

	// 	$new_obolis_count = $ngo->oboli_count + $amount;
	// 	$new_donors_count = null;
	// 	try {
	// 		DB::beginTransaction();											
	// 		DB::table('users')
	// 			->where('id', $user_id)
	// 			->update(array('oboli_count' => ($user_oboli_count-$amount), 
	// 						   'donated_oboli_count' => (($user->donated_oboli_count)+$amount)));
	// 		$already_donated = (DB::table('donations')->where('user_id', $user_id)->where('ngo_id', $ngo_id)->first() != null);
	// 		if ($already_donated == true)
	// 		{
	// 			$new_donors_count = $ngo->donors;
	// 			DB::table('ngos')
	// 				->where('id', $ngo_id)
	// 				->update(array('oboli_count' => $new_obolis_count,
	// 							   'donations_count' => $ngo->donations_count +1));
	// 		}
	// 		else
	// 		{
	// 			$new_donors_count = $ngo->donors + 1;
	// 			DB::table('ngos')
	// 				->where('id', $ngo_id)
	// 				->update(array('oboli_count' => $new_obolis_count,
	// 							   'donations_count' => ($ngo->donations_count +1),
	// 							   'donors' => ($ngo->donors +1) ));
	// 		}
				
	// 		$created_at = date('y-m-d h:i:s');
	// 		$donation_id = DB::table('donations')
	// 						->insertGetId(array('user_id' => $user_id, 
	// 									   'ngo_id' => $ngo_id, 
	// 									   'amount' => $amount,
	// 									   'created_at' => $created_at,
	// 									   'updated_at' => $created_at));	
	// 		DB::commit();
	// 	} catch (PDOException $e) {
	// 		DB::rollBack();
	// 		return Utils::returnError($e->getMessage(), null);
	// 	}	
	// 	$return_data = array('donation_id'=>$donation_id, 
	// 						 'ngo_obolis_count'=>$new_obolis_count, 
	// 						 'donors'=>$new_donors_count,
	// 						 'ngo_name'=>$ngo->name,
	// 						 'user_obolis_count'=> ($user_oboli_count-$amount) );
	// 	return Utils::returnSuccess('donation_made', $return_data);
	// }

		
}

?>
