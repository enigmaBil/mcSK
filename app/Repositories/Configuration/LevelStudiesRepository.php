<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Configuration;

use App\Model\Configuration\LevelStudy;
use App\Repositories\ResourceRepository;

class LevelStudiesRepository extends ResourceRepository{
    public function __construct(LevelStudy $level) {
        $this->model =$level;
    }

   public function getAll(){
       return $this->model->where('display', 1)->get();
   }
   public function getByDiscipline($id)
    {
        $result =$this->model
        ->Join('discipline_level_study', 'level_study.id', '=', 'discipline_level_study.level_study_id')
        ->where('discipline_level_study.discipline_id', $id)
        ->select('level_study.*')
        ->get();

        return $result;
    }

    public function getById($id){
       return $this->model->where([['display', 1], ['id', $id]])->first();
   }
}