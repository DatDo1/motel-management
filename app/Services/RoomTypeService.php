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
        $this->roomTypeRoomTypeRepository->create($data);
    }
    public function updateRoomType($id, $data = []){
        $this->roomTypeRoomTypeRepository->update($id, $data);
    }
    public function deleteRoomType($id){
        $this->roomTypeRoomTypeRepository->delete($id);
    }
}