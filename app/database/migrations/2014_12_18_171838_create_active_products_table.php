<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveProductsTable extends Migration {

	public function up()
	{
		Schema::create('active_products', function($table)
		{
			$table->increments('id');
			$table->string('brand_name_short');
			$table->string('brand_name');
			$table->string('product_descritption');
			$table->string('url');
			$table->integer('obolis_count');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('active_products');
	}

}
