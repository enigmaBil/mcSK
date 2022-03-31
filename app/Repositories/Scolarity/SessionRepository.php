<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Session;

use App\Repositories\ResourceRepository;

class SessionRepository extends ResourceRepository{
    public function __construct(Session $Session) {
        $this->model =$Session;
    }

   public function getAll(){
       return $this->model->where('display', 1) ->get();
   }
   
   public function getWithPayments($id){
      $depart=$this->model->with("payments");//->find($id);//
        return $depart->find($id);
    }
     
    public function getCourses($id){
        $course=$this->model->with("courses");//->find($id);//
        return $course->find($id);
    }
}