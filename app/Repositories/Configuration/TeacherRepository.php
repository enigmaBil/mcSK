<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Configuration;

use App\Model\Configuration\Teacher;

use App\Repositories\ResourceRepository;

class TeacherRepository extends ResourceRepository{
    public function __construct(Teacher $teacher) {
        $this->model =$teacher;
    }

   public function getAllWithCourses(){
       return $this->model->with("courses")->where('display', 1)->get();
   }
   public function getAll(){
    return $this->model->where('display', 1)->get();

   }
   
}