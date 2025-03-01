<?php

namespace App\Repositories;

use App\Models\Confirm;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ConfirmRepository.
 */
class ConfirmRepository
{
    public function getAll()
    {
        return Confirm::all();
    }

    public function store($data)
    {
        return Confirm::create([
            'name' => $data['name'],
        ]);
    }

    public function delete($id)
    {
        return Confirm::destroy($id);
    }

    public function update($data)
    {
        return Confirm::where([
            'id' => $data['id']
        ])->update([
            'name' => $data['name'],
        ]);
    }

    public function checkIsNotRepetitious(array $data): bool
    {
        return Confirm::where([
            'name' => $data['name']
        ])->exists();
    }
}
