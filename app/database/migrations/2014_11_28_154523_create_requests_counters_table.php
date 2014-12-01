<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsCountersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests_counters', function($table)
		{
			$table->increments('id');
			$table->integer('user')->unsigned();
		//	$table->integer('code_requests_counter'); //number of request made in the last time slot (each slot= 15mins)
		//	$table->dateTime('code_requests_last'); //last request made in the last time slot (each slot= 15mins)
			$table->integer('code_bad_requests_counter'); //number of request for a wrong code made in the last time slot (each slot= 15mins)
			$table->dateTime('code_bad_requests_last'); //last request for a wrong code made in the last time slot (each slot= 15mins)
			$table->integer('code_bad_requests_counter_total'); //total counter for requests for a wrong code
			$table->timestamps();
		});

		Schema::table('requests_counters', function($table)
        {
            $table->foreign('user')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests_counters');
	}
}
