<?php

namespace App\Repositories\Room;

use App\Models\Room;
use App\Repositories\BaseRepository;
use App\Repositories\Room\RoomRepositoryInterface;


class RoomRepository extends BaseRepository implements RoomRepositoryInterface{
    public function __construct(Room $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\Room::class;
    }
}
