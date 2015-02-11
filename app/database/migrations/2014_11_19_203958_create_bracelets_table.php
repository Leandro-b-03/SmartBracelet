<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBraceletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('bracelets');

		Schema::create('bracelets', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->string('tag', 255);
			$table->integer('id_user')->references('id')->on('users');
			$table->string('color');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('bracelets');
	}
}