<?php 

namespace App\Services;

use App\Repositories\Customer\CustomerRepositoryInterface;

class CustomerService {
    protected $customerRepository;
    public function __construct(CustomerRepositoryInterface $customerRepository) {
        $this->customerRepository = $customerRepository;
    }
    public function getAllCustomers() {
        return $this->customerRepository->all();
    }
    public function createCustomer($data = []){
        return $this->customerRepository->create($data);
    }
    public function findCustomerById($id){
        return $this->customerRepository->findByID($id);
    }
    public function updateCustomer($id, $data = []){
        return $this->customerRepository->update($id, $data);
    }
    public function deleteCustomer($id){
        return $this->customerRepository->delete($id);
    }
}