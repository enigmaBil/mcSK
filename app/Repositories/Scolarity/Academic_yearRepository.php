<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Academic_year;

use App\Repositories\ResourceRepository;

class Academic_yearRepository extends ResourceRepository{
    public function __construct(Academic_year $Academic_year) {
        $this->model =$Academic_year;
    }

   public function getAll(){
       return $this->model->where('display', 1)->orderBy("id", 'desc')->get();
   }
   
   public function getCurrent(){
    return $this->model->where('display', 1)->orderBy("id", 'desc')->first();
}
   public function getWithPayments($id){
      $depart=$this->model->with("payments")->where('display', 1);//->find($id);//
        return $depart->find($id);
    }
    public function getSession($id){
      $depart=$this->model->with("sessions")->where('display', 1);//->find($id);//
        return $depart->find($id);
    }
     
}