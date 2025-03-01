<?php

namespace App\Services;

use App\Interfaces\GlobalVariablesInterface;
use App\Models\UsersUnit;
use App\Repositories\UsersUnitRepository;

/**
 * Class UsersUnitService
 * @package App\Services
 */
class UsersUnitService
{
    protected $usersUnitRepository;
    public function __construct(UsersUnitRepository $usersUnitRepository)
    {
        $this->usersUnitRepository = $usersUnitRepository;
    }

    public function getUnitIdByUserId($userId)
    {
        return $this->usersUnitRepository->getUnitIdByUserId($userId)->unit_id ?? GlobalVariablesInterface::DEFAULT_UNIT_ID;
    }
}
