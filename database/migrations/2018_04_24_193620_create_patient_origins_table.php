<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientOriginsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient_origins', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('ecocarotidas_doctor')->nullable();
			$table->dateTime('ecocarotidas_date')->nullable();
			$table->string('immediate_origin')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('patient_origins_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('patient_origins');
	}

}
