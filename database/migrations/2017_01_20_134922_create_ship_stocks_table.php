<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipStock', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('cartonbox');
			$table->string('cartonbox_old')->nullable(); //added latter
			$table->string('po', 24);
			$table->string('po_status', 24);
			$table->string('style', 12);
			$table->string('color', 12);
			$table->string('colordesc', 64);
			$table->string('size', 8);

			$table->integer('qty');
			$table->integer('standard_qty');
			
			$table->string('location', 32)->nullable();

			$table->string('coment', 64)->nullable();

			$table->dateTime('lastused', 32)->nullable();
			$table->string('flash', 32)->nullable();
			$table->string('status', 32)->nullable();
			$table->string('flag', 32)->nullable();

			$table->string('coloumn1', 32)->nullable();
			$table->string('coloumn2', 32)->nullable();
			$table->string('coloumn3', 32)->nullable();

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
		Schema::drop('shipStock');
	}

}
