<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/07/2018
 * Time: 15:20
 */

namespace App\Repositories\Mobility;

use App\Model\Mobility\Institution;

use App\Repositories\ResourceRepository;

class InstitutionRepository extends ResourceRepository
{
    public function __construct(Institution $course)
    {
        $this->model = $course;
    }


    public function getAll($status = 2) {
        return $this->model
            ->where('status', $status)
            ->orderBy('created_at', 'asc')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function findByDomain($domain, $status = 2) {
        return $this->model
            ->where('domain', '=', $domain)
            ->where('status', $status)
            ->first();
    }
}