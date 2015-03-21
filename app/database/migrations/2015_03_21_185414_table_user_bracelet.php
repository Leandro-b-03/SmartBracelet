<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUserBracelet extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('user_bracelet');

		Schema::create('user_bracelet', function (Blueprint $table)
		{
			//create the table user
			$table->increments('id');

			$table->integer('id_user')->references('id')->on('users');
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
		Schema::dropIfExists('user_bracelet');
	}
}
