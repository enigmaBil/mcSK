<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Mark;

use App\Model\Mark\Notes_rattrapage;

use App\Repositories\ResourceRepository;

class Notes_rattrapageRepository extends ResourceRepository{
    public function __construct(Notes_rattrapage $Mark) {
        $this->model =$Mark;
    }

   public function getAll(){
    return $this->model->get();
}
   
}