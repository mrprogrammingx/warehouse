<?php

namespace App\Repositories;

use App\Models\Center3;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class Center3Repository.
 */
class Center3Repository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Center3::class;
    }
    
    public function getAllActive()
    {
        return $this->model()::where([
            'active' => true
        ])->get();
    }
}
