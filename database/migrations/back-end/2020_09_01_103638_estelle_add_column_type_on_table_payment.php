<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstelleAddColumnTypeOnTablePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment',function(Blueprint $table){
            $table->integer('payment_reason')->nullable()->after('status');
            $table->integer('slice_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment',function(Blueprint $table){
            $table->dropColumn('payment_reason');
            $table->integer('user_id')->unsigned()->nullable(false)->change();
        });
    }
}
