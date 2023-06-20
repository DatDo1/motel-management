<?php 

namespace App\Services;

use App\Repositories\RoomBooking\RoomBookingRepositoryInterface;

class RoomBookingService {
    protected $roomBookingRepository;
    public function __construct(RoomBookingRepositoryInterface $roomBookingRepository){
        $this->roomBookingRepository = $roomBookingRepository; 
    }
    public function getAllRoomBookings() {
        return $this->roomBookingRepository->all();
    }
    public function createRoomBooking($data = []){
        $this->roomBookingRepository->create($data);
    }
    public function updateRoomBooking($id, $data = []){
        $this->roomBookingRepository->update($id, $data);
    }
    public function deleteRoomBooking($id){
        $this->roomBookingRepository->delete($id);
    }
}