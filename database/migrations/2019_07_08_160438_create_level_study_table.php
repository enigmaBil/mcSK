<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLevelStudyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('level_study', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 10)->nullable();
			$table->mediumText('description')->nullable();
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
		Schema::drop('level_study');
	}

}
