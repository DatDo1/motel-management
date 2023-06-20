<?php

namespace App\Repositories\FacilityType;

use App\Models\FacilityType;
use App\Repositories\BaseRepository;
use App\Repositories\FacilityType\FacilityTypeRepositoryInterface;


class FacilityTypeRepository extends BaseRepository implements FacilityTypeRepositoryInterface{
    public function __construct(FacilityType $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\FacilityType::class;
    }
}
