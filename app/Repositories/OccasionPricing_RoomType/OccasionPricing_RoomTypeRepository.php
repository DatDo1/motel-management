<?php

namespace App\Repositories\OccasionPricing_RoomType;

use App\Models\OccasionPricing_RoomType;
use App\Repositories\BaseRepository;
use App\Repositories\OccasionPricing_RoomType\OccasionPricing_RoomTypeRepositoryInterface;


class OccasionPricing_RoomTypeRepository extends BaseRepository implements OccasionPricing_RoomTypeRepositoryInterface{
    public function __construct(OccasionPricing_RoomType $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\OccasionPricing_RoomType::class;
    }
}
