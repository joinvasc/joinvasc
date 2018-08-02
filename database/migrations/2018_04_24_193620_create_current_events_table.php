<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrentEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('current_events', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->dateTime('event_datetime')->nullable();
			$table->dateTime('help_datetime')->nullable();
			$table->dateTime('arrival_datetime')->nullable();
			$table->string('transportation')->nullable();
			$table->string('immediate_origin')->nullable();
			$table->string('note')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('current_events_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('current_events');
	}

}
