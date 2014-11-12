<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('donations', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('ngo_id')->unsigned();
			$table->integer('amount');
			$table->timestamps();
		});

		Schema::table('donations', function($table)
        {
            $table->foreign('user_id')->references('id')->on('users');
			$table->foreign('ngo_id')->references('id')->on('ngos');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('donations');
	}

}
