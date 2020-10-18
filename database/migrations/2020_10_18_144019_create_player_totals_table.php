<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_total', function (Blueprint $table) {
            $table->uuid('player_id');
            $table->integer('age');
            $table->integer('games');
            $table->integer('games_started');
            $table->integer('minutes_played');
            $table->integer('field_goals');
            $table->integer('field_goals_attempted');
            $table->integer('3pt');
            $table->integer('3pt_attempted');
            $table->integer('2pt');
            $table->integer('2pt_attempted');
            $table->integer('free_throws');
            $table->integer('free_throws_attempted');
            $table->integer('offensive_rebounds');
            $table->integer('defensive_rebounds');
            $table->integer('assits');
            $table->integer('steals');
            $table->integer('blocks');
            $table->integer('turnovers');
            $table->integer('personal_fouls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_totals');
    }
}
