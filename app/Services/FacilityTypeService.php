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
        return $this->facilityTypeRepository->create($data);
    }
    public function updateFacilityType($id, $data = []){
        return $this->facilityTypeRepository->update($id, $data);
    }
    public function deleteFacilityType($id){
        return $this->facilityTypeRepository->delete($id);
    }
    public function findFacilityTypeByID($id){
        return $this->facilityTypeRepository->findByID($id);
    }
    
}