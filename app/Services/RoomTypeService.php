<?php 

namespace App\Services;

use App\Repositories\RoomType\RoomTypeRepositoryInterface;

class RoomTypeService {
    protected $roomTypeRoomTypeRepository;
    public function __construct(RoomTypeRepositoryInterface $roomTypeRoomTypeRepository){
        $this->roomTypeRoomTypeRepository = $roomTypeRoomTypeRepository; 
    }
    public function getAllRoomTypes() {
        return $this->roomTypeRoomTypeRepository->all();
    }
    public function createRoomType($data = []){
        return $this->roomTypeRoomTypeRepository->create($data);
    }
    public function updateRoomType($id, $data = []){
        return $this->roomTypeRoomTypeRepository->update($id, $data);
    }
    public function deleteRoomType($id){
        return $this->roomTypeRoomTypeRepository->delete($id);
    }
    public function findRoomTypeById($id){
        return $this->roomTypeRoomTypeRepository->findById($id);
    }
}