<?php

namespace App\Repositories;

use App\Interfaces\RayvarzInterface;
use App\Models\Product;
use App\Repositories\Globals\fieldRepository;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class ProductRepository.
 */
class ProductRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Product::class;
    }

    public function getAll()
    {
        return Product::select('id', 'name', 'itemDataId')->take(13000)->get(); //temporary
    }

    public function store($data)
    {
        $fields = fieldRepository::tableFields($data, $table = 'products');
        return Product::create($fields);
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }

    public function update($data)
    {
        $fields = fieldRepository::tableFields($data, $table = 'products');
        return Product::where([
            'id' => $data['id']
        ])->update($fields);
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function isItemDataId($itemDataId)
    {
        return Product::where([
            'itemDataId' => $itemDataId
        ])->exists();
    }

    public function getWarehouseProductWithItemDataId($itemDataId)
    {
        return Product::where([
            'itemDataId' => $itemDataId
        ])->first();
    }

    public function updateProductByItemDataId($rayvarzProduct)
    {
        $ignoreFields = array_merge((new Product())->getOurFields(), ['id', 'created_at', 'updated_at', 'itemDataId']);
        $fields = fieldRepository::tableFields($rayvarzProduct, $table = 'products', $ignoreFields);
        return Product::where([
            'itemDataId' => $rayvarzProduct['itemDataId']
        ])->update($fields);
    }

    public function getProductsByWarehouseId(int $warehouseId)
    {
        return Product::select('id', 'name', 'itemDataId')->where(
            'itemDataId',
            'LIKE',
            "{$warehouseId}%"
        )->get();
    }

    public function getAllRecordsOfProductById($id)
    {
        return Product::where([
            'id' => $id
        ])->first();
    }
}
