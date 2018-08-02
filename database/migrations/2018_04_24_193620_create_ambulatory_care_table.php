<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAmbulatoryCareTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ambulatory_care', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('time')->default('30dias');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('ambulatory_cares_followup_id_foreign');
			$table->text('follow30')->nullable();
			$table->text('follow3m')->nullable();
			$table->text('follow5a')->nullable();
			$table->text('follow4a')->nullable();
			$table->text('follow3a')->nullable();
			$table->text('follow2a')->nullable();
			$table->text('follow1a')->nullable();
			$table->string('dead_in')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ambulatory_care');
	}

}
