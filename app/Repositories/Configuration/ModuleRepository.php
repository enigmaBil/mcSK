<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Configuration;

use App\Model\Configuration\Module;


use App\Repositories\ResourceRepository;

class ModuleRepository extends ResourceRepository{
    public function __construct(Module $department) {
        $this->model =$department;
    }

   public function getAll(){ 
       return $this->model->where('display',1)->get();
   }
   public function getWithCourses($id){
        $courses = $this->model->where('display',1)->with("courses");
        return $courses->find($id);
    }
    public function getByClassroom($id){
        $result =$this->model
        ->where('discipline_level_study_id', $id)
        ->get();
        return $result;
    }
}