<?php

namespace App\Repositories;

use App\Models\Setting;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class SettingRepository.
 */
class SettingRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Setting::class;
    }

    public function getLastRayvarzProductIndex(){
        return $this->model()::where([
            'key' => 'last_rayvarz_product_index'
        ])->first();
    }

    public function incrementLastRayvarzProductIndex(){
        return $this->model()::where([
            'key' => 'last_rayvarz_product_index'
        ])->increment('value');
    }

    public function decrementLastRayvarzProductIndex(){
        return $this->model()::where([
            'key' => 'last_rayvarz_product_index'
        ])->decrement('value');
    }
}
