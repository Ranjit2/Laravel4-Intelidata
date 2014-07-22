<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ahir_velocity', function($table)
		{
			# General fields
			$table->increments('id');
			$table->string('url', 255);	
			$table->string('method', 6);	
			$table->string('controller', 100);	
			$table->text('post_data');	
			$table->float('response_time');	
			$table->bigInteger('memory_usage');	
			$table->timestamps();
			# Table options
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ahir_velocity');
	}

}
