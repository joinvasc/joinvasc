<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDischargesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discharges', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('other', 50)->nullable();
			$table->string('date_now', 150)->nullable();
			$table->date('date')->nullable();
			$table->string('image_capture')->nullable();
			$table->string('avc_type')->nullable();
			$table->string('avc_h')->nullable();
			$table->string('avc_itoast')->nullable();
			$table->string('avc_ait')->nullable();
			$table->string('avc_hsa')->nullable();
			$table->string('rankin', 255)->nullable();
			$table->integer('barthel')->nullable();
			$table->text('hmsj_uavc')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('discharges_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('discharges');
	}

}
