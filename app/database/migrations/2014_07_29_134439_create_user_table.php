<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::dropIfExists('users');

		Schema::create('users', function (Blueprint $table) {
			//create the table user
			$table->increments('id');

			$table->string('username', 255);
			$table->string('password', 255);
			$table->string('name', 255);
			$table->string('cpf', 255);
			$table->string('rg', 255);
			$table->string('email', 255);
			$table->string('mobile', 19);
			$table->string('phone', 19);
			$table->string('address', 255);

			$table->rememberToken();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}