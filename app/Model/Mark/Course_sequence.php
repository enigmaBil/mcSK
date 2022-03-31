<?php

namespace App\Model\Mark;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Course_sequence extends Pivot 
{
    protected  $table="course_sequence";

    protected $fillable=['id','percentage','sequence_id',
        'course_id',
       'user_updated_id','user_created_id', 'display'];
       public function onecourse(){ 
        return $this->hasOne('App\Model\Configuration\Course','id','course_id');
    }
    public function oneSequence(){
        return $this->hasOne('App\Model\Configuration\Sequence','id','sequence_id');
    }

}
