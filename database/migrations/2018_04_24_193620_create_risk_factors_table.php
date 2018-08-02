<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRiskFactorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('risk_factors', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('years')->nullable();
			$table->text('avc')->nullable();
			$table->text('hypertension')->nullable();
			$table->text('diabetes')->nullable();
			$table->text('alcohol')->nullable();
			$table->text('dyslipidemia')->nullable();
			$table->text('cardiopathy')->nullable();
			$table->text('antitrombotic')->nullable();
			$table->text('drugs')->nullable();
			$table->text('smoking')->nullable();
			$table->text('sedentary')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('risk_factors_followup_id_foreign');
			$table->string('other', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('risk_factors');
	}

}
