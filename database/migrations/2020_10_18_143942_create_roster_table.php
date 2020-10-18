<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRosterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roster', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('team_code');
            $table->integer('number');
            $table->string('name');
            $table->string('pos');
            $table->string('height');
            $table->string('weight');
            $table->string('dob');
            $table->string('nationality');
            $table->string('year_exp');
            $table->string('college');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roster');
    }
}
