<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',100)->unique();
            $table->string('password',255);
            $table->string('phone',50);

            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('company_name',100);
            $table->text('address');
            $table->unsignedInteger('group_id');
            $table->boolean('sex');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');

    }

}