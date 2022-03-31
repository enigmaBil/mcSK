<?php

namespace App\Repositories\Configuration;

use App\Model\Configuration\Discipline;

use App\Repositories\ResourceRepository;

class DisciplineRepository extends ResourceRepository
{
    public function __construct(Discipline $discipline)
    {
        $this->model = $discipline;
    }

    public function getAll()
    {
        $result = $this->model->with('level_studies')->where('display', 1)->get();
        return $result;
    }

    public function getActive(){
        return $this->model
            ->where('display', 1)
            ->where('status', 1)
            ->get();
    }
    public function getDisciplineByDepartment($department)
    {
        $result = $this->model
            ->where('display', 1)
            ->where('department_id', $department)
            ->get();

        return $result;
    }

    public function getbyId_with_level_studies($id)
    {
        $discipline = $this->model->where('display', 1)->with('level_studies')->find($id);
        return $discipline;
    }
    public function getWithStudyLevel($discipline_id)
    {
        if($discipline_id == null ){
            $result = $this->model->with('level_studies')
                ->where('display', 1)
                ->get();
            return $result;
        }

        $result = $this->model->with('level_studies')
            ->where('id', $discipline_id)
            ->where('display', 1)
            ->get();
        return $result;
    }
}
