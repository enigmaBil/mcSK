<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('last_name');
			$table->string('first_name')->nullable();
			$table->string('sex', 1)->nullable();
			$table->dateTime('birth_date')->nullable();
			$table->string('telephone', 25)->nullable();
			$table->string('adress', 50)->nullable();
			$table->string('nationality')->nullable();
			$table->string('birth_place')->nullable();
			$table->string('particular_disease', 2550)->nullable();
			$table->string('photo', 2550)->nullable();


			$table->string('tutor_name')->nullable();
			$table->string('tutor_contact', 25);
			$table->string('tutor_address')->nullable();
			$table->string('tutor_occupation')->nullable();
			$table->string('tutor_email')->nullable();


			$table->string('code')->nullable();
			$table->boolean('assurance')->default(0);
			$table->string('entrance_diploma')->nullable();
			$table->integer('entrance_diploma_year')->nullable();
			$table->integer('chosen_discipline')->nullable();
            $table->foreign('chosen_discipline')->references('id')->on('discipline');
			$table->integer('diploma_average')->nullable();
            $table->integer('user_updated_id')->nullable();
            $table->integer('user_created_id')->nullable();
			$table->timestamps();
			$table->boolean('display')->default(1);
			$table->boolean('status')->default(0);

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student');
	}

}
