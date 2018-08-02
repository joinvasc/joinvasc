<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAmbulatoryCareTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ambulatory_care', function(Blueprint $table)
		{
			$table->foreign('followup_id', 'ambulatory_cares_followup_id_foreign')->references('id')->on('followups')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ambulatory_care', function(Blueprint $table)
		{
			$table->dropForeign('ambulatory_cares_followup_id_foreign');
		});
	}

}
