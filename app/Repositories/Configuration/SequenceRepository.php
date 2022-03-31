<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Configuration;

use App\Model\Configuration\Sequence;

use App\Repositories\ResourceRepository;

class SequenceRepository extends ResourceRepository{
    public function __construct(sequence $sequence) {
        $this->model =$sequence;
    }

   public function getAll(){ 
        return $this->model->where('display', 1)->get();

   }
   public function getbyId_with_level_studies($id){
   
    $sequence = $this->model->where('display', 1)->with('level_studies')->find($id);
    return $sequence;

}
}