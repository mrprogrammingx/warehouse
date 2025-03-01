<?php

namespace App\Repositories;

use App\Models\FilesCategory;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class FilesCategoryRepository.
 */
class FilesCategoryRepository
{
    public function getAll(){
        return FilesCategory::all();
    }

    public function getById($id){
        return FilesCategory::find($id);
    }
}
