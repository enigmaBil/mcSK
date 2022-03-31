<?php
namespace App\Repositories\Configuration;

use App\Model\Configuration\User;

use App\Repositories\ResourceRepository;

class UserRepository extends ResourceRepository{
    public function __construct(User $user) {
        $this->model =$user;
    }
 
   public function getAll(){
       return $this->model->where('institution_id', \Auth::user()->institution_id)->where('display', 1)->get();
   }

   public function getProfile($id){
       return $this->model->with('profile')->where('id', $id)->get();
   }
}