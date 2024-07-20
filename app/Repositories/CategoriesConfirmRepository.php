<?php

namespace App\Repositories;

use App\Models\CategoriesConfirm;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class CategoriesConfirmRepository
{
    public function getAll(): ?object
    {
        return CategoriesConfirm::with('confirm', 'category')->get();
    }

    public function store(array $data): ?object
    {
        return CategoriesConfirm::create([
            'category_id' => $data['category_id'],
            'confirm_id' => $data['confirm_id'],
        ]);
    }

    public function delete(int $id)
    {
        return CategoriesConfirm::destroy($id);
    }

    public function update(array $data):?int
    {
        return CategoriesConfirm::where([
            'id' => $data['id']
        ])->update([
            'category_id' => $data['category_id'],
            'confirm_id' => $data['confirm_id'],
        ]);
    }

    public function getByCategory(?int $categoryId): ?object
    {
        return CategoriesConfirm::where([
            'category_id' => $categoryId
        ])->get();
    }

    public function checkIsNotRepetitious(array $data): ?bool
    {
        return CategoriesConfirm::where([
            'category_id' => $data['category_id'],
            'confirm_id' => $data['confirm_id'],
        ])->exists();
    }
}
