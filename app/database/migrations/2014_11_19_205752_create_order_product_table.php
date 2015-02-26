<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('order_bracelet', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->integer('id_order')->references('id')->on('orders');
			$table->integer('id_product')->references('id')->on('products');
			$table->integer('id_bracelet')->references('id')->on('bracelets');
			$table->integer('quantity');
			$table->float('price');

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
		Schema::dropIfExists('order_bracelet');
	}
}