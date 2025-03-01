<?php

namespace App\Repositories;

use App\Models\ItemConsumptionType;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ItemConsumptionTypeRepository.
 */
class ItemConsumptionTypeRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ItemConsumptionType::class;
    }

    public function getAllActive()
    {
        return $this->model()::where([
            'active' => true
        ])->get();
    }
}
