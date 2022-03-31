<?php

namespace App\Repositories\Scolarity;

use App\Model\Scolarity\Slice;

use App\Repositories\ResourceRepository;

class SliceRepository extends ResourceRepository
{
    public function __construct(Slice $Slice)
    {
        $this->model = $Slice;
    }

    public function getAll()
    {
        return $this->model->where('display', 1)->get();
    }
    public function getLast()
    {
        return $this->model->where('display', 1)->orderBy("id", 'desc')->first();
    }
}
