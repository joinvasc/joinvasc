<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDeathsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('deaths', function(Blueprint $table)
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
		Schema::table('deaths', function(Blueprint $table)
		{
			$table->dropForeign('deaths_followup_id_foreign');
		});
	}

}
