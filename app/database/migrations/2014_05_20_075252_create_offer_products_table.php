<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

    public function up()
    {
        Schema::create('offer_products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->float('price',10,2);
            $table->float('commission',10,2);
            $table->integer('quantity');
            $table->float('line_total',15,2);
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
        Schema::drop('offer_products');
    }

}
