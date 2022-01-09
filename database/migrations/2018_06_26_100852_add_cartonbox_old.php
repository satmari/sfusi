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
			
    		$table->string('sku')->nullable();
    		
		});

		Schema::table('shipStock', function($table)
		{
			
    		$table->string('sku')->nullable();
    		
		});
		
		Schema::table('addlogs', function($table)
		{
			
    		$table->string('sku')->nullable();
    		
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
