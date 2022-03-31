<?php

namespace App\Model\Scolarity;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{   protected  $table="inscription";

    protected $fillable=['code','status','id','reduction','cretaion_date','discipline_level_study_discipline_id',
    'discipline_level_study_level_study_id','academic_year_id','student_id',
    'discipline_level_study_id','user_updated_id','user_created_id','rest'];
    public function oneCreator(){
        return $this->hasOne('App\Model\Configuration\User','id','user_created_id');
    }
    public function payments()
{
    return $this->hasMany('App\Model\Scolarity\Payment');
}  
public function oneStudent(){
    return $this->hasOne('App\Model\Scolarity\Student','id','student_id');
}
public function oneClass(){
    return $this->hasOne('App\Model\Configuration\DisciplineLevelStudy','id','discipline_level_study_id');
}
public function oneAcademic_year(){
    return $this->hasOne('App\Model\Scolarity\Academic_year','id','academic_year_id');
}
    //
}
