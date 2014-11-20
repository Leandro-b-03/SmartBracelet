<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustumersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('custumers');

		Schema::create('custumers', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->string('name', 255);
			$table->string('address', 255);
			$table->string('phone', 255);
			$table->string('rg', 2500);
			$table->string('cpf', 255);
			$table->string('birthday', 255);

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('custumers');
	}
}