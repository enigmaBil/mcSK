<?php

namespace App\Model\Scolarity;

use Illuminate\Database\Eloquent\Model;

class Class_slice extends Model
{
    protected  $table="class_slice";
    
    protected $fillable=['id','value','discipline_level_study_id','slice_id','user_updated_id','user_created_id','display'];
    //
    public function oneClass(){
        return $this->hasOne('App\Model\Configuration\DisciplineLevelStudy','id','discipline_level_study_id');
    }
    public function oneSlice(){
        return $this->hasOne('App\Model\Scolarity\Slice','id','slice_id');
    }
    public function oneCreator(){
        return $this->hasOne('App\Model\Configuration\User','id','user_created_id');
    }
}
