<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected  $table="discipline";
 
    protected $fillable=[
       'code','responsible','id','name','status','description','department_id','user_updated_id','user_created_id','display'];
    public function discipline_level_studies()
{
    return $this->hasMany('App\Model\Configuration\DisciplineLevelStudy');
}  

public function level_studies ()
{
    return $this->belongsToMany('App\Model\Configuration\LevelStudy')
 
               ->using('App\Model\Configuration\DisciplineLevelStudy')
                     ->withPivot([
                        'discipline_id',
                        'level_study_id',
                        'education_amount',
                        'inscription_amount',
                        'id',
                        'display',
    ]);
}  


public function level_modules(){
    return $this->hasManyThrough('App\App\Model\Configuration\Module', 'App\Model\Configuration\DisciplineLevelStudy',
            'discipline_id', // Foreign key on users table...
    '(discipline_level_study_discipline_id ,discipline_level_study_discipline_id)', // Foreign key on posts table...
    'id', // Local key on countries table...
    'id' // Local key on users table...
);

}

public function oneDepartment(){
    return $this->hasOne('App\Model\Configuration\Department','id','department_id');
}

}
