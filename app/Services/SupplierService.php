<?php

namespace App\Services;

use App\Repositories\SupplierRepository;

/**
 * Class SupplierService
 * @package App\Services
 */
class SupplierService
{
    protected $supplierRepository;
    public function __construct(SupplierRepository $supplierRepository) {
        $this->supplierRepository = $supplierRepository;
    }

}
