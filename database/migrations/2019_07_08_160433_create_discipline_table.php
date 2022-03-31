<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDisciplineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discipline', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 70)->unique('name');
			$table->string('code', 70)->unique('code');
			$table->boolean('status')->nullable()->default(0);
			$table->mediumText('description')->nullable();
			$table->integer('department_id')->index('FKdiscipline249612');
            $table->foreign('department_id')->references('id')->on('department');
			$table->integer('responsible');
            $table->foreign('responsible')->references('id')->on('teacher');
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
		Schema::drop('discipline');
	}

}
