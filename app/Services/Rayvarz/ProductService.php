<?php

namespace App\Services\Rayvarz;

use App\Interfaces\GlobalVariablesInterface;
use App\Interfaces\RayvarzInterface;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Services\Globals\ResponsesService;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\FuncCall;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    protected $settingRepository, $productRepository;
    public function __construct()
    {
        $this->settingRepository = new SettingRepository();
        $this->productRepository = new ProductRepository();
    }
    public function getLastProducts($token = null): array
    {
        try {
            $response = Http::withHeaders([
                'access_token' => $_COOKIE['rayvarz_access_token'] ?? $token ?? AuthService::getToken(),
                'Content-Type' => env('RAYVARZ_HEADER_CONTENT_TYPE_DEFAULT'),
            ])->post(
                env('RAYVARZ_PRODUCT_LIST_API'),
                [
                    'Index' => $this->settingRepository->getLastRayvarzProductIndex()->value ?? 1
                ]
            );
            if ((200 <= $response->status()) && ($response->status() < 300)) {
                return ResponsesService::success($response->json() ?? null);
            } else {
                return ResponsesService::error($response->json() ?? null, $response->json()['message'] ?? '');
            }
        } catch (Exception $e) {
            return ResponsesService::exception($e);
        }
    }

    public function addNewRayvarzProductsToProductsTable(): array
    {
        $token = AuthService::getToken();
        do {
            $responseLastProducts = $this->checkLastProductsForAddToroductsTable($token);
            $lastProducts = $responseLastProducts['data'];
            $result = ($lastProducts == null) ? $this->processOfStopAddingToProductsTable($responseLastProducts) : $this->processOfAddToProductsTable($lastProducts);
        } while ($result['success'] == true && $result['data'] != null);

        return $result;
    }

    public function processOfStopAddingToProductsTable(array $responseLastProducts): array
    {
        $lastProductsMessage = $responseLastProducts['message'];
        return ($responseLastProducts['success']) ? ResponsesService::success(null, $lastProductsMessage) : ResponsesService::error(null, $lastProductsMessage);
    }

    public function processOfAddToProductsTable($lastProducts): array
    {
        $this->addProductsToProductsTable($lastProducts)['data'];
        return ResponsesService::success($this->settingRepository->incrementLastRayvarzProductIndex());
    }

    public function checkLastProductsForAddToroductsTable(string $token): array
    {
        $response = $this->getLastProducts($token);
        $lastIndex = $this->settingRepository->getLastRayvarzProductIndex()['value'];
        Log::info(['last index: ' => $lastIndex]);

        if (!((200 <= $response['status']) && ($response['status'] < 300))) {
            Log::info($response['message'] . ' - ' . now());
            return ResponsesService::error(null, $response['message']);
        }

        $products = $response["data"];
        if ($products == null) {
            $this->settingRepository->decrementLastRayvarzProductIndex();
            return ResponsesService::success(null, ' In the page of ' . $lastIndex . ' there is no any product ');
        }

        return ResponsesService::success($products);
    }

    public function addProductsToProductsTable(array $products): array
    {
        foreach ($products as $product) {
            $store = ($this->productRepository->isItemDataId($product['itemDataId'])) ? true : $this->productRepository->store($product);
            if (!$store) {
                Log::info($store . ' - ' . $product['itemDataId'] . ' - ' . now());
            }
        }
        return ResponsesService::success($store);
    }

    public function syncWarehouseProductTableWithRayvarz(array $data): array
    {
        try {
            $itemDataId = $data['itemDataId'];
            $rayvarzProductResponse = $this->getRayvarzProductWithItemDataId($itemDataId);
            $rayvarzProduct = $this->removeWhitespaceInRayvarzResponse(
                ($rayvarzProductResponse['status'] == 400) ? $this->getRayvarzProductWithItemDataId($itemDataId, AuthService::getToken())['data'] : $rayvarzProductResponse['data']
            );

            return $this->processOfSyncWarehouseProductWithRayvarzProduct($rayvarzProduct, $this->productRepository->getWarehouseProductWithItemDataId($itemDataId));
        } catch (Exception $e) {
            return ResponsesService::exception($e);
        }
    }

    public function keepSharedFieldsFromTwoArray(array $firstArray, array $secondArray): array
    {
        return [
            array_intersect_key($firstArray, $secondArray), array_intersect_key($secondArray, $firstArray)
        ];
    }

    public function removeWhitespaceInRayvarzResponse(?array $rayvarzProduct): array
    {
        $rayvarzProductFields = [];
        foreach ($rayvarzProduct as $data) {
            foreach ($data as $index => $datum) {
                $rayvarzProductFields[$index] = (is_string($datum)) ?  trim($datum) : $datum;
            }
        }
        return $rayvarzProductFields;
    }

    public function processOfSyncWarehouseProductWithRayvarzProduct($rayvarzProduct, $warehouseProduct): array
    {

        if (!isset($rayvarzProduct['itemDataId']) || $rayvarzProduct['itemDataId'] == null) {
            return ResponsesService::error(null, 'Product not found!');
        } else if ($warehouseProduct == null) {
            return ResponsesService::success($this->productRepository->store($rayvarzProduct), 'Added successfully!');
        }
        list($warehouseProductArray, $rayvarzProductArray) = $this->keepSharedFieldsFromTwoArray(
            ($warehouseProduct) ? $warehouseProduct->toArray() : [],
            $rayvarzProduct
        );

        return ($rayvarzProductArray == $warehouseProductArray) ? ResponsesService::success(null) : ResponsesService::success($this->productRepository->updateProductByItemDataId($rayvarzProduct), 'Updated successfully!');
    }

    public function getRayvarzProductWithItemDataId(int $itemDataId, $token = null): array
    {
        $response = Http::withHeaders([
            'access_token' => $_COOKIE['rayvarz_access_token'] ?? $token ?? AuthService::getToken(),
            'Content-Type' => env('RAYVARZ_HEADER_CONTENT_TYPE_DEFAULT'),
        ])->post(
            env('RAYVARZ_PRODUCT_LIST_API'),
            [
                "WhereClause" => "itemDataId== \"$itemDataId\""
            ]
        );
        return ((200 <= $response->status()) && ($response->status() < 300)) ? ResponsesService::success($response->json() ?? null) : ResponsesService::error($response->json() ?? null, $response->json()['message'] ?? '');
    }

    public function checkAmountOfEachProduct($data)
    {
        try {
            return $this->checkAmountOfEachProductIsEnough(
                $this->getAmountOfRayvarzProduct($data['itemDataId'], $data['warehouseId'])["data"][0]["currentStock"] ?? null
            );
        } catch (Exception $e) {
            return ResponsesService::exception($e);
        }
    }

    public function getAmountOfRayvarzProduct($itemDataId, $warehouseId, $token = null)
    {
        $response = Http::withHeaders([
            'access_token' => $_COOKIE['rayvarz_access_token'] ?? $token ?? AuthService::getToken(),
            'Content-Type' => env('RAYVARZ_HEADER_CONTENT_TYPE_DEFAULT'),
        ])->get(
            env('RAYVARZ_PRODUCT_AMOUNT_API'),
            [
                "partNo" => $itemDataId,
                "warehouseId" => $warehouseId
            ]
        );
        return ((200 <= $response->status()) && ($response->status() < 300)) ? ResponsesService::success($response->json() ?? null) : ResponsesService::error($response->json() ?? null, $response->json()['message'] ?? '');
    }

    public function checkAmountOfEachProductIsEnough(?int $amount)
    {
        return ($amount > 0) ? ResponsesService::success($amount, 'Enough stock to order!') : ResponsesService::error($amount, 'There is not enough stock for the order!');
    }
}
