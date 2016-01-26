<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shortanswers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('text');
            $table->integer('question_id')->unsigned();
            $table->integer('lesson_id')->unsigned();
            $table->integer('rating');
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shortanswers');
    }
}
