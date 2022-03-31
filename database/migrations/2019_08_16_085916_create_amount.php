<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_slice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('value');
            $table->integer('discipline_level_study_id');
            $table->foreign('discipline_level_study_id')->references('id')->on('discipline_level_study');
            $table->integer('slice_id');
            $table->foreign('slice_id')->references('id')->on('slice');
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
        Schema::dropIfExists('class_slice');
    }
}
