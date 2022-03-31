<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SessionAcademicYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_academic_year', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('session_id');
            $table->foreign('session_id')->references('id')->on('session');
			$table->integer('academic_year_id');
            $table->foreign('academic_year_id')->references('id')->on('academic_year');
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
        Schema::drop('session_academic_year');
    }
}
