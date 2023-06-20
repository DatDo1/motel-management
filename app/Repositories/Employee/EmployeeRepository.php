<?php

namespace App\Repositories\Employee;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Repositories\Employee\EmployeeRepositoryInterface;


class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface{
    public function __construct(Employee $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\Employee::class;
    }
}
