<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;


class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface{
    public function __construct(Customer $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\Customer::class;
    }
}
