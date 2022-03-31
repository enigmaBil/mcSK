<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Mark;

use App\Model\Mark\Course_sequence;

use App\Repositories\ResourceRepository;

class Course_sequenceRepository extends ResourceRepository{
    public function __construct(Course_sequence $Course_sequence) {
        $this->model =$Course_sequence;
    }

   public function getAll(){
    return $this->model->get();
}
   
}