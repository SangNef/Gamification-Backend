<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnemiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enemies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->unsignedInteger('hp');
            $table->unsignedInteger('dame');
            $table->unsignedInteger('def');
            $table->string('access', 250);
            $table->enum('type', ['Normal', 'Elite ', 'Boss', 'Legendary']);
            $table->enum('rank', ['1', '2', '3', '4', '5']);
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
        Schema::dropIfExists('enemies');
    }
}
