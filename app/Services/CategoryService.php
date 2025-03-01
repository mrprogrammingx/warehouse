<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Services\Globals\ResponsesService;

class CategoryService
{
    protected $categoryrepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryrepository = $categoryRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->categoryrepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->categoryrepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->categoryrepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->categoryrepository->update($data));
    }
}
