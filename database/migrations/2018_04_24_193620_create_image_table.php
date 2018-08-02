<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cranial_tomography')->nullable();
			$table->string('magnetic_resonance')->nullable();
			$table->string('hemorrhagic_stroke')->nullable();
			$table->string('intraparenchymal')->nullable();
			$table->string('lobar_topography')->nullable();
			$table->string('deep_topography')->nullable();
			$table->string('subarachnoid_hemorrhage')->nullable();
			$table->string('hemorrhage_side')->nullable();
			$table->string('fisher')->nullable();
			$table->string('hydrocephalus')->nullable();
			$table->string('angiography')->nullable();
			$table->string('angio_resonance')->nullable();
			$table->string('DSA')->nullable();
			$table->string('radiation_control')->nullable();
			$table->string('tomography_aspects')->nullable();
			$table->string('tomography_side')->nullable();
			$table->string('tomography_topography')->nullable();
			$table->string('tomography_cerebellum')->nullable();
			$table->string('tomography_vascular_territory')->nullable();
			$table->string('tomography_swelling')->nullable();
			$table->string('mr_AVC_ischemic_detected')->nullable();
			$table->string('mr_dwi_restriction')->nullable();
			$table->string('mr_side')->nullable();
			$table->string('mr_topography')->nullable();
			$table->string('mr_cerebellum')->nullable();
			$table->string('mr_vascular_territory')->nullable();
			$table->string('mr_swelling')->nullable();
			$table->string('radiation_research')->nullable();
			$table->string('swelling')->nullable();
			$table->string('AVC_ischemic')->nullable();
			$table->string('hemorrhage_transform')->nullable();
			$table->bigInteger('followup_id')->unsigned()->index('image_followup_id_foreign');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('image');
	}

}
