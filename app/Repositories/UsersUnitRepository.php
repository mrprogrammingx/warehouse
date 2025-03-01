<?php

namespace App\Repositories;

use App\Models\UsersUnit;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class UsersUnitRepository
{
    public function getUnitIdByUserId($userId){
        return UsersUnit::where([
            'user_id' => $userId
        ])->first();
    }
}
