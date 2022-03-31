<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Student;

use App\Repositories\ResourceRepository;

class StudentRepository extends ResourceRepository{
    public function __construct(Student $Student) {
        $this->model =$Student;
    }

   public function getAll(){
       return $this->model->where('display', 1) ->get();
   }

    public function getStudentsByDiscipline($discipline_id){
        if($discipline_id == null){
            return $this->model->with('discipline','inscription')
                ->get();
        }

        return $this->model->with('discipline','inscription')
            ->where('chosen_discipline', $discipline_id)
            ->get();
    }

	public function getById($id){
       return $this->model->with('discipline')->where([['display', 1], ['id', $id]])->first();
   }   


     
}