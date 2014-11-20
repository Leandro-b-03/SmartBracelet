<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('orders');

		Schema::create('orders', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->integer('id_user')->references('id')->on('users');
			$table->integer('id_custumer')->references('id')->on('custumers');
			$table->float('discount');
			$table->float('amount');
			$table->string('order_number', 255);
			$table->boolean('status');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('orders');
	}
}