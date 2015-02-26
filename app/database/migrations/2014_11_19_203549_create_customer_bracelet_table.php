<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBraceletTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('customer_bracelet');

		Schema::create('customer_bracelet', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->integer('id_customer')->references('id')->on('customers');
			$table->integer('id_bracelet')->references('id')->on('bracelets');
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
		Schema::dropIfExists('customer_bracelet');
	}
}