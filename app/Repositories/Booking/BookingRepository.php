<?php

namespace App\Repositories\Booking;

use App\Models\Booking;
use App\Repositories\BaseRepository;
use App\Repositories\Booking\BookingRepositoryInterface;


class BookingRepository extends BaseRepository implements BookingRepositoryInterface{
    public function __construct(Booking $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\Booking::class;
    }
}
