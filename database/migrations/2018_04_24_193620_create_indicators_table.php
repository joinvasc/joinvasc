<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('indicators', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('indicators_followup_id_foreign');
			$table->string('protocol_answer', 5);
			$table->string('protocol_value', 50);
			$table->float('hospital_time', 10, 0);
			$table->string('tomography_answer', 5);
			$table->string('tomography_value', 50);
			$table->integer('tomography_time');
			$table->string('carotida_answer', 5);
			$table->string('carotida_value', 50);
			$table->string('ecg_answer', 5);
			$table->string('ecg_value', 50);
			$table->string('fisio_answer', 5);
			$table->string('fisio_value', 50);
			$table->string('humor_answer', 5);
			$table->string('humor_value', 50);
			$table->string('aspirina_answer', 5);
			$table->string('aspirina_value', 50);
			$table->string('trombo_answer', 5);
			$table->string('trombo_value', 50);
			$table->integer('pintool_answer');
			$table->string('deglutation_answer', 5);
			$table->string('deglutation_value', 50);
			$table->string('antiplaquetary_answer', 5);
			$table->string('antiplaquetary_value', 50);
			$table->string('dischargeanti_answer', 5);
			$table->string('dischargeanti_value', 50);
			$table->string('anticoag_answer', 5);
			$table->string('anticoag_value', 50);
			$table->string('estatina_answer', 5);
			$table->string('estatina_value', 50);
			$table->string('dischagent_answer', 5);
			$table->string('dischagent_value', 50);
			$table->string('smokecontrol_answer', 5);
			$table->string('smokecontrol_value', 50);
			$table->integer('carotime_answer');
			$table->string('carotime_value', 50);
			$table->string('catocirurgy_time', 5);
			$table->string('hemorragy_answer', 5);
			$table->string('death_internation', 5);
			$table->string('death_30days', 5);
			$table->string('death_sequela', 5);
			$table->string('early_mobilization', 5);
			$table->integer('patient_age');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('indicators');
	}

}
