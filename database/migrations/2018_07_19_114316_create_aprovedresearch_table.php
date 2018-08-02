<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAprovedresearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprovedresearch', function(Blueprint $table)
        {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name')->nullable();
            $table->string('university')->nullable();
            $table->string('email')->nullable();
            $table->string('code')->nullable();
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
        //
    }
}


