<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title',200);
            $table->text('description');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->float('price',10,2);
            $table->float('commission',10,2);
            $table->string('attachment',200);
            $table->integer('pi');
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
		Schema::drop('files');
	}

}