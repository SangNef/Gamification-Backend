<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->string('phone', 250)->unique();
            $table->string('password', 250);
            $table->string('invite_code', 50)->unique();
            $table->unsignedInteger('point')->default(0);
            $table->string('avatar',250)->nullable();
            $table->string('avatar_frame',250)->nullable();
            $table->string('skin_color',20);
            $table->unsignedInteger('count')->default(0);
            $table->unsignedInteger('level')->default(1);
            $table->unsignedInteger('exp')->default(0);
            $table->unsignedInteger('hp')->default(100);
            $table->unsignedInteger('dame')->default(10);
            $table->unsignedInteger('def')->default(10);
            $table->boolean('is_admin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
