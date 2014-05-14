<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title',200);
            $table->text('description');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->float('price',10,2);
            $table->float('commission',10,2);
            $table->integer('quantity');
            $table->float('line_total',15,2);
            $table->string('attachment',200);
            $table->boolean('pi');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('client_suppliers');
            $table->integer('created_by');
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
        Schema::drop('offers');
    }

}