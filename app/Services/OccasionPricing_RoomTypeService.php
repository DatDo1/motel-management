<?php 

namespace App\Services;

use App\Repositories\OccasionPricing_RoomType\OccasionPricing_RoomTypeRepositoryInterface;

class OccasionPricing_RoomTypeService {
    protected $occasionPricing_RoomTypeRepository;
    public function __construct(OccasionPricing_RoomTypeRepositoryInterface $occasionPricing_RoomTypeRepository){
        $this->occasionPricing_RoomTypeRepository = $occasionPricing_RoomTypeRepository; 
    }
    public function getAllOccasionPricing_RoomTypes() {
        return $this->occasionPricing_RoomTypeRepository->all();
    }
    public function createOccasionPricing_RoomType($data = []){
        $this->occasionPricing_RoomTypeRepository->create($data);
    }
    public function updateOccasionPricing_RoomType($id, $data = []){
        $this->occasionPricing_RoomTypeRepository->update($id, $data);
    }
    public function deleteOccasionPricing_RoomType($id){
        $this->occasionPricing_RoomTypeRepository->delete($id);
    }
}