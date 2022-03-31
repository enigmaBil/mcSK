<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->boolean('status')->nullable()->default(0);
			$table->integer('amount')->nullable()->default(0);
			$table->integer('inscription_id')->index('FKpayment347528');
            $table->foreign('inscription_id')->references('id')->on('inscription');
			$table->integer('slice_id');
            $table->foreign('slice_id')->references('id')->on('slice');
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
	{		Schema::drop('slice');

		Schema::drop('payment');
	}

}
