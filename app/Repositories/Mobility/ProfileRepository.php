<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Mobility;

use App\Model\Mobility\Profile;

use App\Repositories\ResourceRepository;

class ProfileRepository extends ResourceRepository{
    public function __construct(Profile $profile) {
        $this->model =$profile;
    }

   public function getAll(){
       return $this->model->get();
   }
}