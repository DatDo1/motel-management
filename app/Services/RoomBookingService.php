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
        return $this->roomBookingRepository->create($data);
    }
    public function updateRoomBooking($id, $data = []){
        return $this->roomBookingRepository->update($id, $data);
    }
    public function deleteRoomBooking($id){
        return $this->roomBookingRepository->delete($id);
    }
    public function findRoomBookingByID($id){
        return $this->roomBookingRepository->findByID($id);
    }
}