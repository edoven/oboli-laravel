<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

	public function up()
	{
		Schema::create('sales', function($table)
		{
			$table->increments('id');
			$table->string('email');
			$table->integer('obolis');
			$table->string('ip');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sales');
	}

}
