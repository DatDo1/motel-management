<?php

namespace App\Repositories\RoomBooking;

use App\Models\RoomBooking;
use App\Repositories\BaseRepository;
use App\Repositories\RoomBooking\RoomBookingRepositoryInterface;


class RoomBookingRepository extends BaseRepository implements RoomBookingRepositoryInterface{
    public function __construct(RoomBooking $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\RoomBooking::class;
    }
}
