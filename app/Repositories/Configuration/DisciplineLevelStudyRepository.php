<?php

/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Configuration;

use App\Model\Configuration\DisciplineLevelStudy;
use Illuminate\Support\Facades\DB;


use App\Repositories\ResourceRepository;

class DisciplineLevelStudyRepository extends ResourceRepository
{
    public function __construct(DisciplineLevelStudy $disciplineLevelStudy)
    {
        $this->model = $disciplineLevelStudy;
    }

    public function getAll()
    {
        return $this->model->get();
    }
    public function getLast()
    {
        return $this->model->where('display', 1)->orderBy("id", 'desc')->first();
    }

    public function getbyIdEModules($id)
    {
        $modules = $this->model->with("emodules");
        return $modules->find($id);
        // return $modules=$this->model::find($id)->with("modules");// Discipline_level_study::find($id)->modules;
        // return $classe;

    }
    public function getbyIdModules($id)
    {
        $modules = $this->model->with("modules");
        return $modules->find($id);
        // return $modules=$this->model::find($id)->with("modules");// Discipline_level_study::find($id)->modules;
        // return $classe;

    }
    public function is_it_in($discipline_id, $level_id)
    {
        $flag = DB::table('discipline_level_study')
            ->where('display', 1)
            ->whereDiscipline_idAndLevel_study_id($discipline_id, $level_id)
            ->first();
        if ($flag == null) return false;
        else return true;
    }

}
