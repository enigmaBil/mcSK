<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicYearTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('academic_year', function(Blueprint $table)
		{
			$table->integer('id', true);
            $table->string('name');
			$table->boolean('status')->nullable()->default(0);
			$table->date('start_date');
			$table->date('end_date');
			$table->date('deadline')->nullable();
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
		Schema::drop('academic_year');
	}

}
