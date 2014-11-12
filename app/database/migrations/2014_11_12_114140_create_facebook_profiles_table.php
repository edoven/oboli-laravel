<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacebookProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('facebook_profiles', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('username');
            $table->biginteger('uid')->unsigned();
            $table->string('access_token');
            $table->timestamps();

            
        });

        Schema::table('facebook_profiles', function($table)
        {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
    public function down()
    {
        Schema::drop('facebook_profiles');
    }

}
