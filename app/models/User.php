<?php

use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;

class User extends Eloquent implements RemindableInterface, UserInterface {


	use RemindableTrait;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	//use UserTrait, RemindableTrait;
	//use RemindableTrait;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public function	getAuthPassword() { return $this->password; }
	public function	getAuthIdentifier() { return $this->id; }
	
	public function getReminderEmail() {return $this->email; }
	public function	getRememberToken() { return $this->remember_token; }
	public function	setRememberToken($remember_token) { $this->remember_token = $remember_token; }
	public function	getRememberTokenName() {return "remember_token";}
	
	
	
	//public function	getReminderEmail() {return $this->email;}

	/**
	 * Get the facebook profile associated with the user
	 *
	 * @return a facebook_profile object
	 */
	public function facebook_profile()
    {
        return $this->belongsTo('FacebookProfile', 'id', 'user_id'); //connection between users(id) and facebook_profiles(user_id)
    }


    public static function createUnconfirmedUser($email, $name, $password)
	{
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->password = Hash::make($password);
		$user->oboli_count = 0;
		$user->donated_oboli_count = 0;
		$user->confirmation_code = str_random(45);
		$user->confirmed = 0; //email has not been confirmed yet
		$user->api_token = str_random(60);
		$user->facebook_profile = 0;
		$user->save();	
		return $user;
	}


	public static function createConfirmedUser($email, $name)
	{
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->oboli_count = 0;
		$user->confirmation_code = str_random(45);
		$user->confirmed = 1; //email is confirmed because is connected with fb
		$user->facebook_profile = 1; //email is confirmed because is connected with fb
		$user->api_token = str_random(60);
		$user->save();	
		return $user;
	}

	public static function exists($email)
	{
		return (User::where('email', $email)->first() != Null);
	}



	public static function getBrands2Obolis($user_id)
	{
		$brands2obolis = DB::table('codes')->where('user', '=', $user_id)
								            ->join('products', 'codes.product', '=', 'products.id')
								            ->join('brands', 'products.brand', '=', 'brands.id')
								            ->select('brands.id as brand_id','brands.name as brand_name', DB::raw('sum(codes.oboli) as oboli'))
								            ->groupBy('brands.id')
								            ->get();
        $enriched_brands2obolis = array();
		foreach ($brands2obolis as $item) 
		{
			$enriched_item = array('brand_id' => $item->brand_id, 
								   'brand_name' => $item->brand_name, 
								   'oboli' => $item->oboli,
								   'brand_image_url' => Config::get('local-config')['host'].'/img/mobile/brands/'.$item->brand_id.'.jpg');
			array_push($enriched_brands2obolis, $enriched_item);
		}
	    return $enriched_brands2obolis;
	}


	public static function getHelpedNgos($user_id)
	{
		$helped_ngos = DB::table('donations')
						->where('user_id', '=', $user_id)
						->join('ngos', 'donations.ngo_id', '=', 'ngos.id')
						->select('ngos.id as ngo_id', 'ngos.name as ngo_name', DB::raw('sum(donations.amount) as amount') )
						->groupBy('ngos.id')
						->get();
		$formatted_helped_ngos = array();
		foreach ($helped_ngos as $helped_ngo) 
		{
			$ngo = array('id'=>$helped_ngo->ngo_id,
						 'name'=>$helped_ngo->ngo_name,
						 'img_url'=>Config::get('local-config')['host'].'/img/mobile/ngos/'.$helped_ngo->ngo_id.'.jpg');
			$enriched_helped_ngo = array('ngo' => $ngo, 
								   		 'amount' => $helped_ngo->amount);
			array_push($formatted_helped_ngos, $enriched_helped_ngo);
		}
		return $formatted_helped_ngos;
	}


}
