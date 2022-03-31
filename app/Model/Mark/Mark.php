<?php

namespace App\Model\Mark;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected  $table = "note";

    protected $fillable = [
        'id', 'created_at', 'updated_at',
        'sequence_id', 'student_id', 'course_id', 'note', 'session_academic_year_id',
        'user_updated_id', 'user_created_id', 'display'
    ];
    public function oneCourse()
    {
        return $this->hasOne('App\Model\Configuration\Course', 'id', 'course_id');
    }
    public function note_rattrapage()
    {
        return $this->hasMany('App\Model\Mark\Notes_rattrapage','note_id');
    } 

    public function session_academic_year()
    {
        return $this->hasOne('App\Model\Scolarity\Session_academic_year', 'id', 'session_academic_year_id');
    } 
}
