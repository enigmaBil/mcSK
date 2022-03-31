<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReneChangeColumnCreationDateOnTableInscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscription',function(Blueprint $table){
            $table->dateTime('creation_date')->nullable()->change();
        });
    }

}
