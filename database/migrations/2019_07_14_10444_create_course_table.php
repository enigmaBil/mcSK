
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->boolean('status')->nullable()->default(0);
			$table->string('content')->nullable()->default('');
			$table->integer('teacher_id')->index('FKcourse685099');
            $table->foreign('teacher_id')->references('id')->on('teacher');
			$table->integer('module_id')->index('FKcourse358044');
            $table->foreign('module_id')->references('id')->on('module');
			$table->integer('amount_hour')->nullable()->default(0);
			
			$table->smallInteger('coefficient')->nullable()->default(0);
			$table->integer('session_id')->nullable()->index('FKcourse218451');
            $table->foreign('session_id')->references('id')->on('session');
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
		Schema::drop('course');
	}

}
