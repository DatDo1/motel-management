<?php

namespace App\Repositories\OccasionPricing;

use App\Models\OccasionPricing;
use App\Repositories\BaseRepository;
use App\Repositories\OccasionPricing\OccasionPricingRepositoryInterface;


class OccasionPricingRepository extends BaseRepository implements OccasionPricingRepositoryInterface{
    public function __construct(OccasionPricing $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\OccasionPricing::class;
    }
}
