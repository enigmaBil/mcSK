<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teacher', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 15)->unique();
			$table->string('name');
			$table->string('address', 100)->nullable()->default(' ');
			$table->string('sex', 1)->nullable()->default('M');
			$table->string('contact', 25)->nullable();
			$table->string('email', 50)->nullable();
			$table->integer('number_of_hour')->nullable()->default(0);
			$table->string('content')->nullable()->default('');
			$table->tinyInteger('status')->default(0);
			$table->string('speciality')->nullable()->default('');
			$table->string('study_level')->nullable()->default('');
			$table->integer('salary')->nullable()->default(0);
			$table->integer('department_id')->nullable();
           //ON DOIT L AJOUTER A LA MAIN $table->foreign('department_id')->references('id')->on('department');
            $table->integer('user_updated_id')->nullable();
            $table->integer('user_created_id')->nullable();
			$table->timestamps();
            $table->boolean('display')->default(1);
		});

		DB::table('teacher')->insert(
			array(
				'code' => 'noTeacher',
				'name' => 'noTeacher',
				'email' => 'name@domain.com',
				//'verified' => true
			)
		);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teacher');
	}

}
