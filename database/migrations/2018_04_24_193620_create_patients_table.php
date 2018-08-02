<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->bigInteger('id')->nullable();
			$table->string('name');
			$table->bigInteger('cpf')->nullable();
			$table->date('birth_date')->nullable();
			$table->string('gender')->nullable();
			$table->text('telefone', 65535)->nullable();
			$table->integer('id_person', true);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('patients');
	}

}
