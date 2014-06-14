<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('project_id');
			$table->integer('amount');		
			$table->timestamps();
				
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('project_id')->references('id')->on('projects');			
		});
		
		Schema::table('users', function($table)
		{
			$table->string('short_description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
