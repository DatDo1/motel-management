<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;


class UserRepository extends BaseRepository implements UserRepositoryInterface{
    public function __construct(User $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\User::class;
    }
}
