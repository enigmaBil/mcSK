<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReneAddColumnsOnTableStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student',function(Blueprint $table){
            $table->string('student_email', 80)->nullable()->after('first_name');
            $table->string('student_residence', 191)->nullable()->after('student_email');
            $table->string('region_of_origin', 80)->nullable()->after('student_residence');
            $table->string('department_of_origin', 80)->nullable()->after('region_of_origin');
            $table->string('present_diploma', 50)->nullable()->after('department_of_origin');
            $table->string('previous_school', 500)->nullable()->after('present_diploma');
            $table->string('first_language', 50)->nullable()->after('previous_school');
            $table->string('professional_activity', 50)->nullable()->after('first_language');
            $table->string('marital_status', 25)->nullable()->after('professional_activity');
            $table->date('diploma_year_obtained')->nullable()->after('marital_status');
            $table->date('release_year_prev_school')->nullable()->after('diploma_year_obtained');
            $table->string('second_language', 25)->nullable()->after('release_year_prev_school');
            $table->string('country_obtained_diploma', 25)->nullable()->after('second_language');
            $table->string('diploma_obtained', 50)->nullable()->after('country_obtained_diploma');
            $table->string('other_languages', 25)->nullable()->after('diploma_obtained');
            $table->string('relationship_with_teacher', 50)->nullable()->after('other_languages');
            $table->dropColumn('entrance_diploma');
            $table->dropColumn('entrance_diploma_year');
            $table->dropColumn('diploma_average');
            $table->string('tutor_town', 25)->nullable()->after('tutor_name');
            $table->string('tutor_professional_activity', 50)->nullable()->after('tutor_town');
            $table->string('tutor_phone_1', 25)->nullable()->after('tutor_professional_activity');
            $table->string('tutor_phone_2', 25)->nullable()->after('tutor_phone_1');
            $table->string('tutor_phone_2', 25)->nullable()->after('tutor_phone_1');
            $table->dropColumn('tutor_contact');
            $table->dropColumn('tutor_occupation');
            $table->string('father_name', 191)->nullable()->after('tutor_phone_2');
            $table->string('father_town', 25)->nullable()->after('father_name');
            $table->string('father_profession', 200)->nullable()->after('father_town');
            $table->string('father_address', 50)->nullable()->after('father_profession');
            $table->string('father_phone_1', 25)->nullable()->after('father_address');
            $table->string('father_phone_2', 25)->nullable()->after('father_phone_1');
            $table->string('mother_name', 200)->nullable()->after('father_phone_2');
            $table->string('mother_town', 50)->nullable()->after('mother_name');
            $table->string('mother_profession', 200)->nullable()->after('mother_town');
            $table->string('mother_address', 50)->nullable()->after('mother_profession');
            $table->string('mother_phone_1', 25)->nullable()->after('mother_address');
            $table->string('mother_phone_2', 25)->nullable()->after('mother_phone_1');
            $table->dropColumn('adress');
            $table->date('birth_date')->nullable()->change();
            $table->date('birth_date')->nullable()->after('sex')->change();
            $table->integer('diploma_year_obtained')->nullable()->after('marital_status')->change();
            $table->integer('release_year_prev_school')->nullable()->after('diploma_year_obtained')->change();
            $table->integer('inscription_id')->nullable()->after('chosen_discipline');
            $table->foreign('inscription_id', 'FK_student_inscription_id')->references('id')->on('inscription')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

}
