<?php

namespace App\Repositories\Invoice;

use App\Models\Invoice;
use App\Repositories\BaseRepository;
use App\Repositories\Invoice\InvoiceRepositoryInterface;


class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface{
    public function __construct(Invoice $model){
        $this->setModel($model);
    }
    public function getModel()
    {
        return \App\Models\Invoice::class;
    }
}
