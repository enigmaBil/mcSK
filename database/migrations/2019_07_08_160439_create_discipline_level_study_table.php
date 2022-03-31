<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDisciplineLevelStudyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discipline_level_study', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('discipline_id')->index('FKdiscipline926265');
            $table->foreign('discipline_id')->references('id')->on('discipline');
			$table->integer('level_study_id')->index('FKdiscipline980280');
            $table->foreign('level_study_id')->references('id')->on('level_study');
			$table->integer('education_amount')->nullable()->default(0);
			$table->integer('inscription_amount')->nullable()->default(0);
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
		Schema::drop('discipline_level_study');
	}

}
