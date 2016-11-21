<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSfusiStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sfusiStock', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('cartonbox');
			$table->string('po', 24);
			$table->string('style', 12);
			$table->string('color', 12);
			$table->string('size', 8);

			$table->integer('qty');
			$table->integer('standard_qty');
			
			$table->string('location', 32)->nullable();

			$table->string('status', 32)->nullable();
			$table->string('coloumn', 32)->nullable();

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
		Schema::drop('sfusiStock');
	}

}
