<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Note extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note', function(Blueprint $table)
		{
			$table->integer('id', true);
            $table->float('note');
			$table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('student');
			$table->integer('sequence_id');
            $table->foreign('sequence_id')->references('id')->on('sequence');
            $table->integer('session_academic_year_id');
            $table->foreign('session_academic_year_id')->references('id')->on('session_academic_year');
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('course');
			$table->integer('user_updated_id')->nullable();
			$table->integer('user_created_id')->nullable();
			$table->timestamps();
            $table->boolean('display')->default(1);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
