<?php

namespace App\Repositories\Globals;

use Illuminate\Support\Facades\Schema;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class fieldRepository.
 */
class fieldRepository
{
    static function tableFields($data,$table,$ignore=['id','created_at','updated_at']){
        $tableFields = Schema::getColumnListing($table);
        $tableCreateFields = array_diff($tableFields, $ignore);
        $result = [];
        foreach($tableCreateFields as $field){
            $result[$field] = $data[$field] ?? null;
        }
        return $result;
    }
}
