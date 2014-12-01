<?php

class UserFactory {

	public static function createUnconfirmedUser($email, $name, $password)
	{
		$user = User::createUnconfirmedUser($email, $name, $password);	
		RequestsCounter::addUser($user->id);
		return $user;
	}
}

?>