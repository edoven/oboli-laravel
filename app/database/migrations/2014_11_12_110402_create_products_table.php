<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('brand')->unsigned();
			$table->timestamps();

			
		});

		Schema::table('products', function($table)
		{
		    $table->foreign('brand')
		    	  ->references('id')
		    	  ->on('brands');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
