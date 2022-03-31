<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('head_of_department')->default(1);
            $table->foreign('head_of_department')->references('id')->on('teacher');
			$table->string('name')->nullable();
			$table->boolean('status')->nullable()->default(0);
			$table->integer('scolarity')->nullable()->default(0);
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
		Schema::drop('department');
	}

}
