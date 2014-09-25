<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codes', function($table)
		{
			$table->string('id')->primaryKey;
			$table->integer('user')->unsigned()->nullable()->default(null);
			$table->integer('product');
			$table->integer('oboli');
			$table->timestamps();
			
			$table->primary('id');
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
		Schema::drop('codes');
	}

}
