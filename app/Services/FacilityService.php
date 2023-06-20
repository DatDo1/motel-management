<?php 

namespace App\Services;

use App\Repositories\Facility\FacilityRepositoryInterface;

class FacilityService {
    protected $facilityRepository;
    public function __construct(FacilityRepositoryInterface $facilityRepository){
        $this->facilityRepository = $facilityRepository; 
    }
    public function getAllFacilitys() {
        return $this->facilityRepository->all();
    }
    public function createFacility($data = []){
        $this->facilityRepository->create($data);
    }
    public function updateFacility($id, $data = []){
        $this->facilityRepository->update($id, $data);
    }
    public function deleteFacility($id){
        $this->facilityRepository->delete($id);
    }
}