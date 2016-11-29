<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockedUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('blocked', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blocker_id')->unsigned();
            $table->integer('blocked_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('blocker_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('blocked_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('blocked');
    }
}
