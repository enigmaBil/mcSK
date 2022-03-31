<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{  protected $table="teacher";
    protected $fillable=[
       'id','name','department_id','number_of_hour','address','sex','contact','content','status','speciality','salary','code',
       'study_level','user_updated_id','user_created_id', 'display','email'];
    //
    public function department()
    {
        return $this->hasOne('App\Model\Configuration\Department','id','department_id');
    }  
    
    public function Courses()
    {
        return $this->hasMany('App\Model\Configuration\Course');
    }  
  
}
