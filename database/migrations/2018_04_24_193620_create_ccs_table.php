<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCcsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ccs', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('laa')->nullable();
			$table->string('cae')->nullable();
			$table->string('sao')->nullable();
			$table->string('other_causes')->nullable();
			$table->string('undefined_causes')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('ccs_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ccs');
	}

}
