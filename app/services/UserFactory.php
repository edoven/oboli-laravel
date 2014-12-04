<?php

class UserFactory {

	public static function createUnconfirmedUser($email, $name, $password)
	{
		$user = User::createUnconfirmedUser($email, $name, $password);	
		RequestsCounter::addUser($user->id);
		return $user;
	}


	public static function createConfirmedUser($email, $name)
	{
		$user = User::createConfirmedUser($email, $name);	
		RequestsCounter::addUser($user->id);
		return $user;
	}
}

?>