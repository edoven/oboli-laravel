<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ngos', function($table)
		{
			$table->increments('id');
			$table->string('name_short');
			$table->string('name');
			$table->string('short_description');	
			$table->text('middle_description');
			$table->text('long_description');
			$table->string('cover_image');
			$table->integer('oboli_count');
			$table->integer('donations_count');
			$table->integer('donors');
			$table->string('website');	
			$table->string('phone');
			$table->string('email');
			$table->string('address');
			$table->string('area'); //tematic area
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
		Schema::drop('ngos');
	}

}
