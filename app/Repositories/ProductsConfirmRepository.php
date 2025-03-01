<?php

namespace App\Repositories;

use App\Models\ProductsConfirm;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductsConfirmRepository.
 */
class ProductsConfirmRepository
{

    public function getAll()
    {
        return ProductsConfirm::with('product', 'confirm')->get();
    }

    public function store($data)
    {
        return ProductsConfirm::create([
            'confirm_id' => $data['confirm_id'],
            'product_id' => $data['product_id'],
        ]);
    }

    public function getByProductId($productId)
    {
        return ProductsConfirm::where([
            'product_id' => $productId
        ])->get();
    }

    public function checkIsNotRepetitious(array $data): bool
    {
        return ProductsConfirm::where([
            'confirm_id' => $data['confirm_id'],
            'product_id' => $data['product_id'],
        ])->exists();
    }
}
