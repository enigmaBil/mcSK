<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected  $table="module";

    protected $fillable=['id','name','decription', 'status','user_updated_id','user_created_id','discipline_level_study_id',
'created_at','updated_at', 'display'];
    //
    public function courses()
{
    return $this->hasMany('App\Model\Configuration\Course');
}  

public function classroom()
{
    return $this->hasOne('App\Model\Configuration\DisciplineLevelStudy','id','discipline_level_study_id');
}  



}
