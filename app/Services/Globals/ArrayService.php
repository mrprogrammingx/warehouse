<?php

namespace App\Services\Globals;

/**
 * Class ArrayService
 * @package App\Services
 */
class ArrayService
{
    public function removeNullFromArray(array $fields) :array
    {
        return array_diff($fields,array(null));
    }
}
