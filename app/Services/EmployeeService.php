<?php 

namespace App\Services;

use App\Repositories\Employee\EmployeeRepositoryInterface;

class EmployeeService {
    protected $employeeRepository;
    public function __construct(EmployeeRepositoryInterface $employeeRepository) {
        $this->employeeRepository = $employeeRepository;
    }
    public function getAllEmployees() {
        return $this->employeeRepository->all();
    }
    public function createEmployee($data = []){
        return $this->employeeRepository->create($data);
    }
    public function updateEmployee($id, $data = []){
        return $this->employeeRepository->update($id, $data);
    }
    public function deleteEmployee($id){
        return $this->employeeRepository->delete($id);
    }
    public function findEmployeeById($id){
        return $this->employeeRepository->findByID($id);
    }
}