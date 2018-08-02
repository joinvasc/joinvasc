<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFollow4aTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follow4a', function(Blueprint $table)
		{
			$table->integer('id')->nullable();
			$table->string('avc_monitoring', 5)->nullable();
			$table->text('health_center', 65535)->nullable();
			$table->string('frequency_health_center', 30)->nullable();
			$table->string('blood_pressure', 30)->nullable();
			$table->integer('hba1c_value')->nullable();
			$table->string('hba1c_answer', 10)->nullable();
			$table->integer('ldl_value')->nullable();
			$table->string('ldl_answer', 10)->nullable();
			$table->string('smoking', 10)->nullable();
			$table->integer('follow_rankin30')->nullable();
			$table->integer('capilar_value')->nullable();
			$table->string('capillar_answer', 10)->nullable();
			$table->string('especialities', 50);
			$table->text('note', 65535);
			$table->text('postname', 65535);
			$table->string('fuespecialities', 50)->nullable();
			$table->string('nbperiods', 50)->nullable();
			$table->string('presencacrises', 50)->nullable();
			$table->string('antiepiletic', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('follow4a');
	}

}
