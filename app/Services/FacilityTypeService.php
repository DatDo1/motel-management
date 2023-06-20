<?php 

namespace App\Services;

use App\Repositories\FacilityType\FacilityTypeRepositoryInterface;

class FacilityTypeService {
    protected $facilityTypeRepository;
    public function __construct(FacilityTypeRepositoryInterface $facilityTypeRepository){
        $this->facilityTypeRepository = $facilityTypeRepository; 
    }
    public function getAllFacilityTypes() {
        return $this->facilityTypeRepository->all();
    }
    public function createFacilityType($data = []){
        $this->facilityTypeRepository->create($data);
    }
    public function updateFacilityType($id, $data = []){
        $this->facilityTypeRepository->update($id, $data);
    }
    public function deleteFacilityType($id){
        $this->facilityTypeRepository->delete($id);
    }
}