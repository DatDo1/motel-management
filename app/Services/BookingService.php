<?php 

namespace App\Services;

use App\Repositories\Booking\BookingRepositoryInterface;

class BookingService {
    protected $bookingRepository;
    public function __construct(BookingRepositoryInterface $bookingRepository) {
        $this->bookingRepository = $bookingRepository;
    }
    public function getAllBookings() {
        return $this->bookingRepository->all();
    }
    public function createBooking($data = []){
         return $this->bookingRepository->create($data);
    }
    public function updateBooking($id, $data = []){
         return $this->bookingRepository->update($id, $data);
    }
    public function deleteBooking($id){
         return $this->bookingRepository->delete($id);
    }
    public function findBookingByID($id){
        return $this->bookingRepository->findByID($id);
    }
}