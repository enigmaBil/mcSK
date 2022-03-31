<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected  $table="course";

    protected $fillable=['id','created_at',
        'name','status','session_id','teacher_id','module_id','amount_hour',
       'coefficient','user_updated_id','user_created_id', 'display'];
    public function oneteacher()
    {
        return $this->hasOne('App\Model\Configuration\teacher','id','teacher_id');
    } 
    public function oneModule(){
        return $this->hasOne('App\Model\Configuration\Module','id','module_id');
    }
    public function course_sequences(){
        return $this->hasMany('App\Model\Mark\Course_sequence');
    }

    public function sequences ()
{
    return $this->belongsToMany('App\Model\Configuration\Sequence')
 
               ->using('App\Model\Mark\Course_sequence')
                     ->withPivot([
                        'sequence_id',
                        'course_id',
                        'display',
                        'percentage',
                       
                       
    ]);
}  
}
