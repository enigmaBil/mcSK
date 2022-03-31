<?php

namespace App\Model\Configuration;
use App\Model\Configuration\Module;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use CoenJacobs\EloquentCompositePrimaryKeys\HasCompositePrimaryKey;

class DisciplineLevelStudy extends Pivot
{  protected  $table="discipline_level_study";

    protected $fillable=['discipline_id','level_study_id','id','education_amount',
    'inscription_amount','user_updated_id','user_created_id', 'display'];
    
    public function oneDiscipline(){
        return $this->hasOne('App\Model\Configuration\Discipline','id','discipline_id');
    }
    public function oneLevel(){
        return $this->hasOne('App\Model\Configuration\LevelStudy','id','level_study_id');
    }

    public function modules()
    {
        return $this->hasMany('App\Model\Configuration\Module','discipline_level_study_id'
        );
        
    } 
    public function inscriptions()
    {
        return $this->hasMany('App\Model\Scolarity\Inscription','discipline_level_study_id'
        );
        
    } 
    public function courses()
{
    return $this->hasManyThrough('App\Model\Configuration\Course','App\Model\Configuration\Module'
    ,'discipline_level_study_id','module_id','id','id'
    );
    
} 
public function students ()
{
    return $this->belongsToMany('App\Model\Scolarity\Student','App\Model\Scolarity\Inscription','discipline_level_study_id')
 
              ;
}  



}
