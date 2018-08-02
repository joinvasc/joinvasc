<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocioeconomicConditionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('socioeconomic_conditions', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('schooling')->nullable();
			$table->string('social_class', 5)->nullable();
			$table->string('child_health')->nullable();
			$table->string('healthcenter_attendance')->nullable();
			$table->boolean('piped_water')->nullable();
			$table->boolean('paved_street')->nullable();
			$table->text('assets')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('socioeconomic_conditions_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('socioeconomic_conditions');
	}

}
