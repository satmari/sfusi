<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addlogs', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('cartonbox');
			$table->string('cartonbox_old')->nullable(); //added latter
			$table->string('po', 24)->nullable();
			$table->string('style', 12)->nullable();
			$table->string('color', 12)->nullable();
			$table->string('colordesc', 64)->nullable();
			$table->string('size', 8)->nullable();

			$table->integer('qty')->nullable();
			$table->integer('standard_qty')->nullable();
			
			$table->string('module', 32)->nullable();

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
		Schema::drop('addlogs');
	}

}
