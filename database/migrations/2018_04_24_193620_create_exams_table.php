<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exams', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('banford')->nullable();
			$table->string('nih', 2)->nullable();
			$table->string('previous_rankin')->nullable();
			$table->string('admission_rankin')->nullable();
			$table->string('barthel', 3)->nullable();
			$table->text('list')->nullable();
			$table->string('fasting_blood_glicose', 4)->nullable();
			$table->string('triglycerides', 4)->nullable();
			$table->string('total_cholesterol', 4)->nullable();
			$table->string('hdl', 4)->nullable();
			$table->string('ldl', 4)->nullable();
			$table->string('uric_acid', 4)->nullable();
			$table->string('creatinine', 4)->nullable();
			$table->string('ecg')->nullable();
			$table->string('ecg_description', 40)->nullable();
			$table->string('actilyise')->nullable();
			$table->dateTime('actilyise_date')->nullable();
			$table->string('vhs', 4)->nullable();
			$table->text('admission_pa')->nullable();
			$table->dateTime('tomography_datetime')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('exams_followup_id_foreign');
			$table->dateTime('holter24')->nullable();
			$table->dateTime('holter3')->nullable();
			$table->dateTime('holter7')->nullable();
			$table->string('note_telemetry_holter')->nullable();
			$table->dateTime('echocardiogram_transthoracic')->nullable();
			$table->dateTime('echocardiogram_transesophageal')->nullable();
			$table->string('echocardiogram_note')->nullable();
			$table->dateTime('doppler_data_vertebral')->nullable();
			$table->string('doppler_vertebral_note')->nullable();
			$table->dateTime('doppler_data_transcranial')->nullable();
			$table->string('doppler_transcranial_note')->nullable();
			$table->string('cardiac_area', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exams');
	}

}
