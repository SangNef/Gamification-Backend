<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnemiesInGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enemies_in_game', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enemy_id');
            $table->unsignedBigInteger('game_id');
            $table->foreign('enemy_id')->references('id')->on('enemies');
            $table->foreign('game_id')->references('id')->on('games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enemies_in_game');
    }
}
