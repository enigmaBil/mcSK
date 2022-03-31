<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Mark;

use App\Model\Mark\Mark;

use App\Repositories\ResourceRepository;

class MarkRepository extends ResourceRepository{
    public function __construct(Mark $Mark) {
        $this->model =$Mark;
    }

   public function getAll(){
    return $this->model->get();
}
function getcurrentnote_student_course($student_id,$course_id,$session_academic_year_id,$sequence_id){
    return $this->model
    ->where("student_id",$student_id)
    ->where("course_id",$course_id)
    ->where("session_academic_year_id",$session_academic_year_id)
    ->where("sequence_id",$sequence_id)->get();

}
public function getByStudent($id){
    return $this->model
    ->with('session_academic_year')
    ->where("student_id",$id)
    ->get();
}

   
}