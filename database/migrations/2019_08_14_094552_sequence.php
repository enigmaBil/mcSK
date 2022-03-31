<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sequence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence', function(Blueprint $table)
		{
			$table->integer('id', true);
            $table->string('name');
			$table->date('start_date');
            $table->date('end_date');
            $table->integer('session_id');
            $table->integer('percentage')->nullable()->default(0);
            $table->foreign('session_id')->references('id')->on('session');
			$table->integer('user_updated_id')->nullable();
			$table->integer('user_created_id')->nullable();
			$table->timestamps();
            $table->boolean('display')->default(1);
            //$table->boolean('status');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {       //Schema::drop('course_sequence');
        Schema::drop('note');

        Schema::drop('sequence');
    }
}
