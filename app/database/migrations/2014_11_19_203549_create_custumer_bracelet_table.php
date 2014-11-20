<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustumerBraceletTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('custumer_bracelet');

		Schema::create('custumer_bracelet', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->integer('id_custumer')->references('id')->on('custumers');
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
		Schema::dropIfExists('custumer_bracelet');
	}
}