<?php


namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Class_slice;

use App\Repositories\ResourceRepository;

class Class_sliceRepository extends ResourceRepository
{
    public function __construct(Class_slice $class_slice)
    {
        $this->model = $class_slice;
    }

    public function getAll()
    {
        return $this->model->get();
    }
    public function getWithSlice($id){
        $depart=$this->model->with("oneSlice")->where('discipline_level_study_id', $id)->get();//->find($id);//
          return $depart;
      }
    public function getBySliceClass($class, $slice){

      return $this->model->where('discipline_level_study_id', $class)->where('slice_id', $slice)->First();
    }
}
