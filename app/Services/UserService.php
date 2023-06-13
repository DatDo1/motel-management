<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class UserService {
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function createUser($data = []){
        return $this->userRepository->create($data);
    }
    public function getAllUsers() {
        return $this->userRepository->all();
    }
}