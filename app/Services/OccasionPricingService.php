<?php 

namespace App\Services;

use App\Repositories\OccasionPricing\OccasionPricingRepositoryInterface;

class OccasionPricingService {
    protected $occasionPricingRepository;
    public function __construct(OccasionPricingRepositoryInterface $occasionPricingRepository){
        $this->occasionPricingRepository = $occasionPricingRepository; 
    }
    public function getAllOccasionPricings() {
        return $this->occasionPricingRepository->all();
    }
    public function createOccasionPricing($data = []){
        return $this->occasionPricingRepository->create($data);
    }
    public function updateOccasionPricing($id, $data = []){
        return $this->occasionPricingRepository->update($id, $data);
    }
    public function deleteOccasionPricing($id){
        return $this->occasionPricingRepository->delete($id);
    }

    public function findOccasionPricingById($id){
        return $this->occasionPricingRepository->findByID($id);
    }
}