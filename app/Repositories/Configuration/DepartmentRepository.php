<?php

/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Configuration;

use App\Model\Configuration\Department;

use App\Repositories\ResourceRepository;

class DepartmentRepository extends ResourceRepository
{
    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    public function getAll()
    {
        return $this->model->where('display', 1)->get();
    }
    public function getActive()
    {
        return $this->model
            ->where('display', 1)
            ->where('status', 1)
            ->get();
    }

    public function getSomeDepartement($n)
    {
        return $this->model->where('display', 1)->orderBy('id', 'desc')->take($n)->get();
    }

    public function getDisciplines($id)
    {
        $depart = $this->model->with("disciplines"); //->find($id);//
        return $depart->find($id);
    }
}
