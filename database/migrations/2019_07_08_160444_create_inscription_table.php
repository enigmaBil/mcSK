<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInscriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inscription', function(Blueprint $table)
		{

			$table->integer('id', true);
			$table->integer('reduction')->nullable()->default(0);
			$table->integer('rest');
			$table->dateTime('creation_date')->default(NOW());
			$table->integer('discipline_level_study_id');
            $table->foreign('discipline_level_study_id')->references('id')->on('discipline_level_study');
            $table->integer('academic_year_id')->index('FKinscriptio340131');
            $table->foreign('academic_year_id')->references('id')->on('academic_year');
			$table->integer('student_id')->index('FKinscriptio383051');
            $table->foreign('student_id')->references('id')->on('student');
			$table->string('status')->default(1);
			$table->string('code')->nullable();
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
	{		Schema::drop('payment');

		Schema::drop('inscription');
	}

}
