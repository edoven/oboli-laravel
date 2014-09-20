<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class FacebookProfile extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'facebook_profiles';

	public function user()
    {
        return $this->belongsTo('User'); //connection between facebok_profiles(user_id) and users(id)
    }
}
