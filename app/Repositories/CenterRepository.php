<?php

namespace App\Repositories;

use App\Models\Center;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CenterRepository.
 */
class CenterRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Center::class;
    }

    public function getAll()
    {
        return $this->model()::all();
    }

    public function getAllActive()
    {
        return $this->model()::where([
            'active' => true
        ])->get();
    }
}
