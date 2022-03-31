<?php

namespace App\Repositories\Configuration;

use App\Model\Configuration\Course;
use App\Model\Mark\Mark;


use App\Repositories\ResourceRepository;

class CourseRepository extends ResourceRepository{
    public function __construct(Course $course) {
        $this->model =$course;
    }

   public function getAllWithModule(){
       return $this->model->where('display',1)->with('oneModule')->get();
   }
   public function getAll(){
    return $this->model->get();
    }
   public function getDisciplines($id){
        $depart=$this->model->where('display',1)->with("disciplines");//->find($id);//
        return $depart->find($id);
    }
    public function getByClassroom($id){
        $result =$this->model
        ->Join('module', 'module_id', '=', 'module.id')
        ->where('discipline_level_study_id', $id)
        ->select('course.*')
        ->get();
        return $result;
    }

}