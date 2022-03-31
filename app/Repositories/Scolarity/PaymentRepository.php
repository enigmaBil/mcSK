<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Payment;

use App\Repositories\ResourceRepository;
use DateTime;
use DateInterval;
class PaymentRepository extends ResourceRepository{
    public function __construct(Payment $Payment) {
        $this->model =$Payment;
    }

   public function getAll(){
       return $this->model->where('display', 1) ->get();
   }
   
   public function getWithInscription($id){
      $depart=$this->model->where('display', 1)->with("oneInscription");//->find($id);//
        return $depart->find($id);
    }
     public function paymentTranche($tranche_id){
        $depart=$this->model->where('display', 1)->where('slice_id',$tranche_id);
        return $depart->get()->count();
     }
     public function paymentTranchePeriode($tranche_id,$periode){
         $date=new DateTime;
         if($periode=="mois"){
            $interval = new DateInterval('P1M');

         }else if($periode=="semaine"){
            $interval = new DateInterval('P7D');

         }
         $date->sub($interval);
         $date=$date->format('Y-m-d');
        $depart=$this->model->where('display', 1)->where('slice_id',$tranche_id)
         ->where('created_at','>=',$date);
        return $depart->get()->count();
     }
    public function paymentDisciplineAcademicYearLevel($payment_type_key){
        if($payment_type_key==null){
            $result =$this->model->with('oneInscription')
                ->select('payment.*')
                ->get();
            return $result;

        }
        $result =$this->model->with('oneInscription')
            ->Join('inscription', 'inscription_id', '=', 'inscription.id')
            ->Join('student', 'inscription.student_id', '=', 'student.id')
            ->where('payment_reason', $payment_type_key)
            ->select('payment.*')
           ->get();
        return $result;
    }
     public function paymentDiscipline($didcipline_id){
         
     }
}