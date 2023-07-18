<?php 

namespace App\Services;

use App\Repositories\Room\RoomRepositoryInterface;

class RoomService {
    protected $roomRepository;
    public function __construct(RoomRepositoryInterface $roomRepository){
        $this->roomRepository = $roomRepository; 
    }
    public function getAllRooms() {
        return $this->roomRepository->all();
    }
    public function findById($id) {
        return $this->roomRepository->findById($id);
    }
    public function createRoom($data = []){
        return $this->roomRepository->create($data);
    }
    public function updateRoom($id, $data = []){
        return $this->roomRepository->update($id, $data);
    }
    public function deleteRoom($id){
        return $this->roomRepository->delete($id);
    }
}