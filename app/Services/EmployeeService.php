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
        $this->employeeRepository->create($data);
    }
    public function updateEmployee($id, $data = []){
        $this->employeeRepository->update($id, $data);
    }
    public function deleteEmployee($id){
        $this->employeeRepository->delete($id);
    }
}