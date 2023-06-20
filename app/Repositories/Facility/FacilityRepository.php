<?php

namespace App\Repositories\Facility;

use App\Models\Facility;
use App\Repositories\BaseRepository;
use App\Repositories\Facility\FacilityRepositoryInterface;


class FacilityRepository extends BaseRepository implements FacilityRepositoryInterface{
    public function __construct(Facility $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\Facility::class;
    }
}
