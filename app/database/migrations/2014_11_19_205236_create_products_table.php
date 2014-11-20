<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('products');

		Schema::create('products', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->string('name', 255);
			$table->float('price');
			$table->float('quantity');
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
		Schema::dropIfExists('products');
	}
}