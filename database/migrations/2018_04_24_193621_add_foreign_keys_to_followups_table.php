<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('followups', function(Blueprint $table)
		{
			$table->foreign('PersonID', 'followups_patient_id_person_foreign')->references('id_person')->on('patients')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('followups', function(Blueprint $table)
		{
			$table->dropForeign('followups_patient_id_person_foreign');
		});
	}

}
