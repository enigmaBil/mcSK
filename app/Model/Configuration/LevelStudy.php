<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class LevelStudy extends Model
{
    protected  $table="level_study";

    protected $fillable =['id', 'name','description','user_updated_id','user_created_id', 'display'];
    //
    public function Disciplines_level_studys()
    {
        return $this->hasMany('App\Model\Configuration\DisciplineLevelStudy');
    }  
    public function disciplines ()
    {
        return $this->belongsToMany('App\Model\Configuration\Discipline')
     
                   ->using('App\Model\Configuration\DisciplineLevelStudy')
                         ->withPivot([
                            'discipline_id',
                            'level_study_id',
                        'education_amount',
                        'inscription_amount',
        ]);
    } 
}
