<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('user_id');
            $table->string('text');
            $table->integer('up_votes')->unsigned();
            $table->integer('down_votes')->unsigned();
            $table->boolean('root');
            $table->timestamps();
            $table->softDeletes();

            /*
             * FK constraint
             *
             * $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
             * $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('comments');
    }
}
