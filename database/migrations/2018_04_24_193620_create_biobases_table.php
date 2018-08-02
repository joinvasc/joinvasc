<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBiobasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('biobases', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->dateTime('receipt_date')->nullable();
			$table->dateTime('extraction_date')->nullable();
			$table->bigInteger('dna_quantification')->nullable();
			$table->dateTime('storage_date')->nullable();
			$table->string('freezer_location')->nullable();
			$table->string('note')->nullable();
			$table->text('control_1')->nullable();
			$table->text('control_2')->nullable();
			$table->text('control_3')->nullable();
			$table->text('control_4')->nullable();
			$table->text('control_5')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('biobases_followup_id_foreign');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('biobases');
	}

}
