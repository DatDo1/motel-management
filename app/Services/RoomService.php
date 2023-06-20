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
    public function createRoom($data = []){
        $this->roomRepository->create($data);
    }
    public function updateRoom($id, $data = []){
        $this->roomRepository->update($id, $data);
    }
    public function deleteRoom($id){
        $this->roomRepository->delete($id);
    }
}