<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersMutedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_muted', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('muted_user_id');
            $table->timestamp('expired_at');

            $table->unique(['user_id','muted_user_id'],'user_mute_pk');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('muted_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_muted');
    }
}
