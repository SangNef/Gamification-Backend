<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->enum('type', ['daily', 'one_time', 'story']);
            $table->unsignedInteger('max_completion');
            $table->unsignedInteger('point');
            $table->unsignedInteger('exp');
            $table->unsignedInteger('gold');
            $table->unsignedInteger('level_requirement');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('quests');
    }
}
