<?php 

namespace App\Services;

use App\Repositories\Invoice\InvoiceRepositoryInterface;

class InvoiceService {
    protected $invoiceRepository;
    public function __construct(InvoiceRepositoryInterface $invoiceRepository){
        $this->invoiceRepository = $invoiceRepository; 
    }
    public function getAllInvoices() {
        return $this->invoiceRepository->all();
    }
    public function createInvoice($data = []){
        $this->invoiceRepository->create($data);
    }
    public function updateInvoice($id, $data = []){
        $this->invoiceRepository->update($id, $data);
    }
    public function deleteInvoice($id){
        $this->invoiceRepository->delete($id);
    }
}