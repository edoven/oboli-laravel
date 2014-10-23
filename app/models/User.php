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

}
