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
			$table->string('id')->unique();
			$table->integer('user')->unsigned()->nullable()->default(null);
			$table->integer('product');
			$table->integer('oboli');
			$table->dateTime('activated_at')->nullable();
			$table->timestamps();
			
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
