<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormaltaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formalta', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('medhas')->nullable();
			$table->text('meddm')->nullable();
			$table->text('meddis')->nullable();
			$table->text('medanti')->nullable();
			$table->text('medantico')->nullable();
			$table->text('enca')->nullable();
			$table->text('encseg')->nullable();
			$table->text('medepilepsia')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('formalta_followup_id_foreign');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('formalta');
	}

}
