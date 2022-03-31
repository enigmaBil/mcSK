<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected  $table="sequence";

    protected $fillable=['id','created_at','updated_at',
        'name','end_date','session_id','start_date','status',
       'percentage','user_updated_id','user_created_id', 'display'];
       
       public function courses ()
       {
           return $this->belongsToMany('App\Model\Configuration\Course')
        
                      ->using('App\Model\Mark\Course_sequence')
                            ->withPivot([
                               'sequence_id',
                               'course_id',
                               'percentage',
                               'display',
                              
                              
           ]);
       } 
       public function oneSession(){
        return $this->hasOne('App\Model\Scolarity\Session','id','session_id');
        }
    

}