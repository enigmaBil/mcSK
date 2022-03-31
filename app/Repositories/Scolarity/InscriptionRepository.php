<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Inscription;

use App\Repositories\ResourceRepository;
use App\Model\Scolarity\Student;
use DateTime;
use DateInterval;
class InscriptionRepository extends ResourceRepository{
    public function __construct(Inscription $inscription) {
        $this->model =$inscription;
    }

   public function getAll(){
       return $this->model->with('oneStudent')
           ->where('display', 1) ->get();
   }

   public function getTop(){
    return $this->model->where('display', 1)->orderBy("id", 'desc')->limit(10)->with("oneClass")->get();
    }

    public function getByAcademic_year($id){
        return $this->model->where('display', 1)->where('academic_year_id', $id)->get();
    }
    public function getByDepartment($id){
        $result =$this->model
        ->Join('discipline_level_study', 'discipline_level_study_id', '=', 'discipline_level_study.id')
        ->Join('discipline', 'discipline_id', '=', 'discipline.id')
        ->where('department_id', $id)
        ->select('inscription.*')
        ->get();
        return $result;
    }
    public function getByDiscipline($discipline_id,$academic_year_id,$level_id,$remainderCheck = null){
        if($discipline_id == 0 && $academic_year_id == null && $level_id == null ){

            return $this->model->with('oneStudent','oneClass')
                ->where('rest','>',0)
                ->select('inscription.*')
                ->get();
        }


        if($remainderCheck){
            if($discipline_id == 0 && $academic_year_id == null ){

                return $this->model->with('oneStudent','oneClass','oneAcademic_year')
                    ->where('rest','>',0)
                    ->select('inscription.*')
                    ->get();
            }

            return $this->model->with('oneStudent','oneClass','oneAcademic_year')
                ->Join('discipline_level_study', 'discipline_level_study_id', '=', 'discipline_level_study.id')
                ->where('discipline_id', $discipline_id)
                ->where('academic_year_id', $academic_year_id)
                ->where('rest','>',0)
                ->select('inscription.*')
                ->get();
        }
        return $this->model->with('oneStudent')
        ->Join('discipline_level_study', 'discipline_level_study_id', '=', 'discipline_level_study.id')
        ->where('discipline_id', $discipline_id)
        ->select('inscription.*')
        ->get();
    }
    
    public function getByLevel($id){
        $result =$this->model
        ->Join('discipline_level_study', 'discipline_level_study_id', '=', 'discipline_level_study.id')
        ->where('level_study_id', $id)
        ->select('inscription.*')
        ->get();
        return $result;
    }
    public function getByClassroom($id){
        $result =$this->model
        ->where('discipline_level_study_id', $id)
        ->get();
        return $result;
    }
   public function getWithPayments($id){
      $depart=$this->model->with("payments");//->find($id);//
        return $depart->find($id);
    }
     
   
    public function inscriptionPeriode($periode){
        $date=new DateTime;
        if($periode=="mois"){
           $interval = new DateInterval('P1M');

        }else if($periode=="semaine"){
           $interval = new DateInterval('P7D');

        }
        $date->sub($interval);
        $date=$date->format('Y-m-d');
       $depart=$this->model->where('display', 1)
        ->where('created_at','>=',$date);
       return $depart->get()->count();
    }

}