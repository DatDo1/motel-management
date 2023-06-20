<?php

namespace App\Repositories\RoomType;

use App\Models\RoomType;
use App\Repositories\BaseRepository;
use App\Repositories\RoomType\RoomTypeRepositoryInterface;


class RoomTypeRepository extends BaseRepository implements RoomTypeRepositoryInterface{
    public function __construct(RoomType $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\RoomType::class;
    }
}
