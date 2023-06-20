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
        $this->customerRepository->create($data);
    }
    public function updateCustomer($id, $data = []){
        $this->customerRepository->update($id, $data);
    }
    public function deleteCustomer($id){
        $this->customerRepository->delete($id);
    }
}