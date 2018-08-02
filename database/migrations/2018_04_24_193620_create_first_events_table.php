<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFirstEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('first_events', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('previous')->nullable();
			$table->string('number_of_events')->nullable();
			$table->string('rehab')->nullable();
			$table->string('rehab_details')->nullable();
			$table->date('last_event_date')->nullable();
			$table->string('hospital')->nullable();
			$table->string('hospital_especialities')->nullable();
			$table->string('hmsj_uavc')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('first_events_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('first_events');
	}

}
