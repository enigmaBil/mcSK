<?php

namespace App\Model\Scolarity;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   protected  $table="student";

   protected $fillable=['status','id','code','last_name','first_name','sex','birth_place','birth_date','telephone','nationality','particular_disease'
   , 'tutor_name','tutor_address','student_residence','region_of_origin','student_email','assurance','present_diploma', 'inscription_id'
   ,'previous_school','first_language','user_updated_id','user_created_id','address','chosen_discipline','professional_activity','marital_status','diploma_year_obtained','release_year_prev_school'
   ,'second_language','country_obtained_diploma','diploma_obtained','other_languages','relationship_with_teacher','tutor_town','tutor_professional_activity','tutor_phone_1','tutor_phone_2'
   ,'father_name','father_town','father_profession','father_address','father_phone_1','father_phone_2','mother_name','mother_town','mother_profession','mother_address','mother_phone_1','mother_phone_2','department_of_origin'];

   public function sequences ()
{
    return $this->belongsToMany('App\Model\Configuration\Sequence','App\Model\Scolarity\Inscription','discipline_level_study_id')
 
              ;
}  
public function notes()
{
    return $this->hasMany('App\Model\Mark\Mark');
}

public function discipline(){
       return $this->belongsTo('App\Model\Configuration\Discipline','chosen_discipline');
}

    public function inscription(){
        return $this->hasOne('App\Model\Scolarity\Inscription','id');
    }
}
