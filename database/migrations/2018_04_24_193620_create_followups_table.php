<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('followups', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->dateTime('interview_date')->nullable();
			$table->dateTime('admission_date')->nullable();
			$table->string('treatment_type')->nullable();
			$table->string('hospital')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('patient_cpf')->unsigned();
			$table->integer('PersonID')->index('followups_patient_id_person_foreign_idx');
			$table->integer('disabled')->nullable();
			$table->string('reason', 100)->nullable();
			$table->integer('event')->nullable();
			$table->string('group')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('followups');
	}

}
