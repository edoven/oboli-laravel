<?php

use Carbon\Carbon;

include_once(app_path().'/utils.php');



class AdminController extends BaseController {
	

	public function showCodes()
	{
		$codes = Code::all();
		return View::make('admin.codes')->with('codes', $codes)
										->with('codes_count', count($codes))
										->with('unused_codes_count', DB::table('codes')->where('user', '=', null)->count() );
	}

	public function showUsers()
	{
		$users = User::all();
		return View::make('admin.users')->with('users', $users)
										->with('users_count', count($users));
	}


	public function addCode()
	{
		$user = Input::get('user');
		$secret = Input::get('secret');
		if ($user!='EdoErMejoDerColosseo' || $secret!='EdoErFigoDeRoma00')
			return Utils::create_json_response('error', 403, 'wrong credentials', null, Input::all());
		$obolis = Input::get('obolis');
		$product_id = Input::get('product_id');
		$code = Input::get('code');
		if ($code==null || $obolis==null || $product_id==null)
			return Utils::create_json_response('error', 400, 'code or obolis or product_id missing', null, Input::all());		
		if (Code::find($code) != null)
			return Utils::create_json_response('error', 400, 'code already exists', null, Input::all());
		if (Product::find($product_id) == null)
			return Utils::create_json_response('error', 400, 'product does not exists', null, Input::all());
		$notes = (Input::get('notes')!=null) ? Input::get('notes') : '';
		try {
			Code::create(array('id' => $code, 'product' => $product_id, 'oboli' => $obolis, 'remaining_obolis' => $obolis, 'notes'=>$notes));
			return Utils::create_json_response('success', 200, 'code added', null, Input::all());
		}
		catch (Exception $e) {
			return Utils::create_json_response('error', 400, 'error adding code', $e->getMessage(), Input::all());
		}
		
	}



	private function updateNewFields()
	{
		$codes = Code::all();
		foreach ($codes as $code)
		{
			Log::info('AdminController::updateNewFields - code '.$code->id);
			$code->remaining_obolis = $code->oboli;
			$code->donated_obolis = 0;
			$code->save();
		}

	}

	public function updateUsedCodes()
	{
		$users = User::all();
		foreach ($users as $user)
		{
			Log::info('AdminController::updateUsedCodes - user ', array('email'=>$user->email, 'obolis'=>$user->oboli_count, 'donated_obolis'=>$user->donated_oboli_count));
			$amount = $user->donated_oboli_count;
			$codes = Code::where('user', '=', $user->id)->get();
			foreach ($codes as $code)
			{
				Log::info('    AdminController::updateUsedCodes - code', array('id'=>$code->id, 'obolis'=>$code->obolis, 'donate_obolis'=>$code->donated_obolis, 'remaining_obolis'=>$code->remaining_obolis) );
				if ($amount>0)
					if ($code->remaining_obolis >= $amount)
					{
						$code->remaining_obolis = $code->remaining_obolis - $amount;
						$code->donated_obolis = $code->donated_obolis + $amount;	
						$amount = 0;				
					}
					else
					{
						$code->remaining_obolis = 0;
						$code->donated_obolis = $code->oboli;
						$amount = $amount - $code->oboli;
					}
				else
				{
					$code->remaining_obolis = $code->oboli;
					$code->donated_obolis = 0;
				}
				Log::info('        AdminController::updateUsedCodes - code saved ', array('obolis'=>$code->obolis, 'donate_obolis'=>$code->donated_obolis, 'remaining_obolis'=>$code->remaining_obolis));
				$code->save();

			}
		}
	}

	private function isIntegrityOk($codes2donated, $donations)
	{
		//Log::info('AdminController::isIntegrityOk - count(codes2donated)='.count($codes2donated).' - count(donations)='.count($donations));
		$sum1 = 0;
		foreach (array_keys($codes2donated) as $code)
			$sum1 = $sum1 + $codes2donated[$code];
		$sum2 = 0;
		foreach ($donations as $donation)
			$sum2 = $sum2 + $donation->amount;
		//Log::info('AdminController::isIntegrityOk - sum1='.$sum1.' - sum2='.$sum2);
		if ($sum1==$sum2)
			return true;
		else
			return false;
	}


	private function createDonationLines()
	{
		$users = User::all();
		foreach ($users as $user)
		{
			$sum_donation_lines = 0;
			$counter_donation_lines = 0;
			$sum_donations = 0;


			if ($user->donated_oboli_count > 0)
			{
				Log::info('AdminController::createDonationLines - user='.$user->email);
				$used_codes = Code::whereRaw('user = '.$user->id.' and donated_obolis > 0')->get();
				$codes2donated = array();
				foreach ($used_codes as $used_code)
					$codes2donated[$used_code->id] = $used_code->donated_obolis;
				$donations = Donation::where('user_id', '=', $user->id)->get();
				if (!$this->isIntegrityOk($codes2donated, $donations))
					throw new Exception('Integrity violation!');

				
				foreach ($donations as $donation)
				{
					Log::info('    donation = '.$donation->amount);
					$sum_donations = $sum_donations + $donation->amount;
					$donation_lines = array();
					$remaining_amount = $donation->amount; //obolis of the donation to assign to codes
					foreach (array_keys($codes2donated) as $code)
					{
						if ($codes2donated[$code] > 0)
						{
							if ($remaining_amount > $codes2donated[$code]) //se gli oboli della donazione che rimangono sono >= degli oboli donati del codice
							{
								array_push($donation_lines, array($user->id, $donation->id, $codes2donated[$code], $code) );
								Log::info('        donation_line = '.$codes2donated[$code]);

								$remaining_amount = $remaining_amount - $codes2donated[$code];
								$codes2donated[$code] = 0;
								$counter_donation_lines = $counter_donation_lines + 1;
								
							}
							else //gli oboli che devo assegnare della donazione sono < del numero di oboli donati del codice
							{
								array_push($donation_lines, array($user->id, $donation->id, $remaining_amount, $code) );
								Log::info('        donation_line = '.$remaining_amount);

								$codes2donated[$code] = $codes2donated[$code] - $remaining_amount;
								$remaining_amount = 0;
								$counter_donation_lines = $counter_donation_lines + 1;
								break; //no more obolis to assign for this donation 
							}
						}	
					}	

					foreach ($donation_lines as $donation_line){
						$sum_donation_lines = $sum_donation_lines + $donation_line[2];
						$dl = new DonationLine($donation_line[1], $donation_line[3], $donation_line[2]);
						Log::info('            dl = ', array($dl));
						$dl->save();
					}		
				}
				Log::info('    sum_donation_lines/sum_donations = '.$sum_donation_lines.'/'.$sum_donations);
				Log::info('    donations = '.Donation::where('user_id', $user->id)->count());
				Log::info('    donation_lines = '.count($counter_donation_lines));
				Log::info('    codes = '.Code::where('user', $user->id)->count());
			}
			
		}
	}

	public function makeChange() 
	{
		$this->updateNewFields();
		$this->updateUsedCodes();
		$this->createDonationLines();
	}
}
