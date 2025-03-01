<?php

namespace App\Repositories;

use App\Models\ProductPersianField;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductPersianFieldsRepository.
 */
class ProductPersianFieldsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ProductPersianField::class;
    }

    public function getAll(){
        return $this->model()::all();
    }
}
