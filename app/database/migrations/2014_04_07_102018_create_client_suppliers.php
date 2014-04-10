<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientSuppliers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('client_suppliers', function( $table)
        {
            $table->increments('id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',100)->unique();
            $table->boolean('sex');
            $table->string('phone',50);
            $table->string('company_name',100);
            $table->text('address');
            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedInteger('group_id');
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
        Schema::drop('client_suppliers');
    }


}
