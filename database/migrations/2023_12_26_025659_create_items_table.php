<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('image', 250);
            $table->enum('rank', ['common', 'uncommon', 'rare', 'epic', 'legendary']);
            $table->enum('type', ['shirt', 'trouser', 'weapon', 'shield', 'prize','point']);
            $table->boolean('status')->default(1);
            $table->boolean('is_limit')->default(0);
            $table->boolean('can_sell')->default(1);
            $table->string('note', 250)->nullable();
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
        Schema::dropIfExists('items');
    }
}
