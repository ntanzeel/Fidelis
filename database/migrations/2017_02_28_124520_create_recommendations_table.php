<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recommendee_id')->unsigned();
            $table->integer('recommendation_id')->unsigned();
            $table->integer('response');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('recommendee_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('recommendation_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
}
