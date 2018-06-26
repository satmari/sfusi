<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCartonboxOld extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('sfusiStock', function($table)
		{
			
    		$table->string('cartonbox_old')->nullable();
    		
		});

		Schema::table('shipStock', function($table)
		{
			
    		$table->string('cartonbox_old')->nullable();
    		
		});
		
		Schema::table('addlogs', function($table)
		{
			
    		$table->string('cartonbox_old')->nullable();
    		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		
	}

}
