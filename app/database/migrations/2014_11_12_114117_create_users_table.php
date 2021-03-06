<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('name');
			$table->string('password', 64);
			$table->integer('oboli_count');
			$table->integer('donated_oboli_count');
			$table->string('remember_token')->nullable();
			$table->integer('confirmed'); //1 or 0
			$table->string('confirmation_code');
			$table->integer('facebook_profile'); //1 or 0
			$table->string('api_token');
			$table->string('profile_image')->default('unknown.jpg');
			$table->string('title')->default('apprendista donatore');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
