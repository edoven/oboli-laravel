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
			$table->integer('product')->unsigned();
			$table->integer('oboli');
			$table->dateTime('activated_at')->nullable();
			$table->timestamps();
		});

		 Schema::table('codes', function($table)
        {
            $table->foreign('user')->references('id')->on('users');
			$table->foreign('product')->references('id')->on('products');
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
