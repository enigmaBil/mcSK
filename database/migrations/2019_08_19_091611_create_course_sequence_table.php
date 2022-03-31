<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSequenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_sequence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('percentage');
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('course');
            $table->integer('sequence_id');
            $table->foreign('sequence_id')->references('id')->on('sequence');
            $table->integer('user_updated_id')->nullable();
			$table->integer('user_created_id')->nullable();
            $table->boolean('display')->default(1);
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
        Schema::dropIfExists('course_sequence');
    }
}
