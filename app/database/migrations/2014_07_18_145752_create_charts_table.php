<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartsTable extends Migration {

	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('', function(Blueprint $table) {
			$table->increments('id');
			$table->string('empresa');
			$table->integer('año');
			$table->integer('mes');
			$table->integer('monto');
			$table->string('categoria');
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
		//
	}

}
