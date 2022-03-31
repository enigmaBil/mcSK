<?php
/**
 * Created by PhpStorm.
 * User: chopgwe
 * Date: 18/04/2017
 * Time: 14:25
 */

namespace App\Repositories;

use App\User;
use Illuminate\Support\Collection;


class UserRepository extends ResourceRepository {

    /**
     * @param User $user
     */
    public function __construct(User $user) {
        $this->model = $user;
    }

    /**
     * @param $company
     * @param $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateWithAccreditation($company, $perPage) {
        return $this->model->with('accreditation', 'profile')
            ->whereHas('profile', function($query) {
                $query->where('profile.name', '!=', 'SUPER-ADMIN');
            })
            ->where('company_id', '=', $company->id)
            ->where('status', '=', 1)
            ->paginate($perPage);
    }

    /**
     * @param $companyId
     * @return Collection
     */
    public function getAll($companyId) {
        return $this->model->with('profile')
            ->whereHas('profile', function($query) {
                $query->where('profile.name', '!=', 'SUPER-ADMIN');
            })
            ->where('company_id', $companyId)->get();
    }

     /**
     * @param $companyId
     * @return Collection
     */
    public function getAllUser($companyId) {
        return $this->model->with('profile')
            ->where('company_id', $companyId)->get();
    }

    /**
     * @param $userId
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function getUserCompany($userId){
        return $this->model->with('company')
            ->where('id',$userId)
            ->first();
    }

    public function getUserById($id){
        toggleDatabase(false);
        $result = $this->model->select('name')->where('id',$id)->first();

        if(is_null($result)){
            $result = array('name' => null);
        }else{
            $result = $result->toArray();
        }
        toggleDatabase();
        return  $result;
    }

    /**
     * @param $userId
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function getUserWithAccreditation($userId){
        return $this->model->with('company', 'accreditation')
            ->where('id', $userId)
            ->first();
    }
}