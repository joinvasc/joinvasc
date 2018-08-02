<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDemographicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('demographics', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('health')->nullable();
			$table->text('schooling')->nullable();
			$table->text('profession')->nullable();
			$table->text('city')->nullable();
			$table->text('address')->nullable();
			$table->text('contact')->nullable();
			$table->string('note')->nullable();
			$table->string('race')->nullable();
			$table->string('weight', 6)->nullable();
			$table->string('height', 3)->nullable();
			$table->string('imc')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('age')->nullable();
			$table->bigInteger('followup_id')->unsigned()->index('demographics_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('demographics');
	}

}
