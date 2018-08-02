<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImageEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('image_evaluations', function(Blueprint $table)
		{
			$table->foreign('followup_id')->references('id')->on('followups')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('image_evaluations', function(Blueprint $table)
		{
			$table->dropForeign('image_evaluations_followup_id_foreign');
		});
	}

}
