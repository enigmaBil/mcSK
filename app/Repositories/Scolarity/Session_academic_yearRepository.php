<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Session_academic_year;

use App\Repositories\ResourceRepository;

class Session_academic_yearRepository extends ResourceRepository{
    public function __construct(Session_academic_year $Session) {
        $this->model =$Session;
    }

   public function getAll(){
       return $this->model->where('display', 1) ->get();
   }
   
}