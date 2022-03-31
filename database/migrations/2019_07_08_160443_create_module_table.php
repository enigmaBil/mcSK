<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('module', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->mediumText('description')->nullable();
			$table->boolean('status')->default(0);
            $table->integer('discipline_level_study_id');
            $table->foreign('discipline_level_study_id')->references('id')->on('discipline_level_study');
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
		Schema::drop('module');
	}

}
