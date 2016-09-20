<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
			 $table->increments('id');
			 $table->integer('user_id')->unsigned(); 
			 $table->foreign('user_id')->references('id')->on('users');
			 $table->string('email', 200);
			 $table->string('phone', 200);
			 $table->string('website', 400);
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
        Schema::drop('profiles');
    }
}
