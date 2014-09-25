<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public function	getAuthPassword() { return $this->password; }
	public function	getAuthIdentifier() { return $this->id; }
	public function	getRememberToken() { return $this->remember_token; }
	public function	setRememberToken($remember_token) { $this->remember_token = $remember_token; }
	public function	getRememberTokenName() {return "remember_token";}
	public function	getReminderEmail() {return $this->email;}

	/**
	 * Get the facebook profile associated with the user
	 *
	 * @return a facebook_profile object
	 */
	public function facebook_profile()
    {
        return $this->belongsTo('FacebookProfile', 'id', 'user_id'); //connection between users(id) and facebook_profiles(user_id)
    }

}
