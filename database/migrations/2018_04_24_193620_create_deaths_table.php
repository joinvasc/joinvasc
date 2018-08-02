<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeathsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deaths', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('other', 100)->nullable();
			$table->date('date')->nullable();
			$table->string('place')->nullable();
			$table->string('cause')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('deaths_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('deaths');
	}

}
