<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('post_id');
			$table->string('path');
            $table->timestamps();
			$table->softDeletes();


			/*
             * Foreign key constraint
             */
            
            /*
             * $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
             */

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
