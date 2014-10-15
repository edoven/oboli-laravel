<?php


class Utils
{

	
	
    public function sendConfirmationEmail($name, $email, $confirmation_code)
	{
		$configs = include(app_path().'/config/local-config.php');
		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'link' => $configs['host'].'/signin/confirm?email='.$email.'&confirmation_code='.$confirmation_code
			);	
		Mail::send('emails.confirmation', 
				   $messageData, 
				   function($message) use($email) {$message->to($email)->subject('oboli account confirmation');}
				   );
	}
	
	
	//This methos add a new donation, it does not check if the donator and the authenticated user are the same
	public function makeDonation($user_id, $ngo_id,	$amount)
	{
		if ($amount<1)
			//App::abort(400, 'The donation amount cannot be smaller than 1');
			return array('code'=>400, 
						 'message'=>'The donation amount cannot be smaller than 1');
		
		
		try {
			DB::beginTransaction();		
			$ngo = Ngo::findOrFail($ngo_id);	
			$user = User::findOrFail($user_id);
			$user_oboli_count = $user['oboli_count'];
			$already_donated = (DB::table('donations')->where('user_id', $user_id)->where('ngo_id', $ngo_id)->first() != null);
			if ($user_oboli_count<$amount)
			{
				DB::connection()->getPdo()->rollBack();
				return array('code'=>400, 
							 'message'=>'The donation amount is greater than the user obolis count');
				//App::abort(400, 'The donation amount is greater than the user obolis count');
			}
			DB::table('users')
				->where('id', $user_id)
				->update(array('oboli_count' => ($user_oboli_count-$amount), 
							   'donated_oboli_count' => (($user->donated_oboli_count)+$amount)));
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
			//App::abort(400, $e->getMessage());
			return array('code'=>400, 
						 'message'=>$e->getMessage());
		}	
		return array('code'=>200);
	}
	
	
	public function verifyFacebookToken($token)
	{
	
		$facebook = new Facebook(Config::get('facebook'));
		$token_debug = $facebook->api('debug_token', array(
									 'input_token' => $token,
									 'access_token' => $facebook->getAccessToken()
									));
		//$user_id = $tokenDebug['data']['user_id'];
		if ($token_debug['data']['is_valid']!=true || $token_debug['data']['app_id']!=$facebook->getAppId())
			return "token is not verified";

		$me = $facebook->api('/me', 'get', array(
			'access_token' => $token
		));
		//$me = $facebook->api('/me')->with('access_token', $token);	
		return $me;
	}
	

	
}

?>
