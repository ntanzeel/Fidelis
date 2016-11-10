<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
	    	$table->integer('user_id');
			$table->integer('comment_id');
			$table->string('type');
            $table->timestamps();
	    	$table->softDeletes();

			/*
             * Foreign key constraint
             */
            
            /*
             * $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			 * $table->foreign('comment_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('votes');
    }
}
