<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      Schema::create('users', function($table) {
        $table->increments('id');
        $table->string('email');
        $table->string('password');
        $table->string('first_name');
        $table->string('last_name');
        $table->timestamps();
        $table->unique('email');
      });
    
      Schema::create('posts', function($table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->longText('post_data');
        $table->timestamps();
        $table->index('user_id');
        $table->foreign('user_id')
          ->references('id')
          ->on('users')
          ->onDelete('cascade');
      });

     Schema::create('friends', function($table) {
       $table->increments('id');
       $table->integer('user_id')->unsigned();
       $table->integer('friend_user_id')->unsigned();
       $table->timestamps();
       $table->index(array('user_id', 'friend_user_id'));
     });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
     Schema::drop('friends');
     Schema::drop('posts');
     Schema:;drop('users');
	}

}