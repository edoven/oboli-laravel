<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationLinesTable extends Migration {

	public function up()
	{
		Schema::create('donation_lines', function($table)
		{
			$table->increments('id');
			$table->integer('donation')->unsigned();
			$table->string('code');
			$table->integer('obolis');
			$table->timestamps();
		});

		Schema::table('donation_lines', function($table)
        {
            $table->foreign('donation')->references('id')->on('donations');
			$table->foreign('code')->references('id')->on('codes');
        });
	}

	public function down()
	{
		Schema::drop('donation_lines');
	}

}
