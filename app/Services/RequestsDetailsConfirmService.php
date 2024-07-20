<?php

namespace App\Services;

use App\Events\StatusEvent;
use App\Interfaces\GlobalVariablesInterface;
use App\Repositories\CategoriesConfirmRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductsConfirmRepository;
use App\Repositories\RequestDetailRepository;
use App\Repositories\RequestRepository;
use App\Repositories\RequestsDetailsConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class RequestsDetailsConfirmService
 * @package App\Services
 */
class RequestsDetailsConfirmService
{
    protected $requestsDetailsConfirmRepository;
    protected $productsConfirmRepository;
    protected $productRepository;
    protected $categoriesConfirmRepository;
    protected $requestDetailRepository;
    protected $requestRepository;

    public function __construct()
    {
        $this->requestsDetailsConfirmRepository = new RequestsDetailsConfirmRepository();
        $this->productsConfirmRepository = new ProductsConfirmRepository();
        $this->productRepository = new ProductRepository();
        $this->categoriesConfirmRepository = new CategoriesConfirmRepository();
        $this->requestDetailRepository = new RequestDetailRepository();
        $this->requestRepository = new RequestRepository();
    }

    public function getAll()
    {
        return ResponsesService::success($this->requestsDetailsConfirmRepository->getAll());
    }

    public function store(array $data):array
    {
        if ($this->checkConfirmsIsUnique($data) == false)
            return ResponsesService::error($data, 'This confirmation has already been given to this request or one of the sub-requests! ');
        $result = [];
        foreach ($data as $datum) {
            $requestDetailData = $this->requestDetailRepository->getRequestIdByRequestDetailsId($datum['requests_detail_id']);
            $requestId = $requestDetailData->request_id;
            if ($this->checkStatusBeInThem($requestId, [GlobalVariablesInterface::CONFIRMING_STEP, GlobalVariablesInterface::FIRST_STEP]) == false) {
                return ResponsesService::error($requestId, 'In this situation, it is not possible to refer and register confirmation!');
            }
            StatusEvent::dispatch(
                $requestId,
                $datum['requests_detail_id'],
                GlobalVariablesInterface::CONFIRMING_STEP
            );
            array_push($result, $this->requestsDetailsConfirmRepository->store($datum));
        }

        return ResponsesService::success($result);
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->requestsDetailsConfirmRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->requestsDetailsConfirmRepository->update($data));
    }

    public function getRequestsDetailsByConfirmUserId(array $data)
    {
        return $this->requestsDetailsConfirmRepository->getRequestsDetailsByConfirmUserId($data['user_id']);
    }

    public function confirmsOfRequestDetail(array $data)
    {
        return ResponsesService::success($this->requestsDetailsConfirmRepository->confirmsOfRequestDetail($data['requests_detail_id']));
    }

    public function confirmsOfRequest(array $data)
    {
        $requestDetailsData = $this->requestDetailRepository->getByRequestId($data['request_id']);
        return ResponsesService::success($this->requestsDetailsConfirmRepository->confirmsOfRequestDetails(array_column($requestDetailsData->all(), 'id')));
    }

    public function updateByRequestDetailIdUserIdAndConfirmId(array $data)
    {
        $result = [];
        foreach ($data as $validate) {
            $validate['user_id'] = isset($validate['user_id']) ? $validate['user_id'] : UserService::getUserId();
            array_push($result, $this->requestsDetailsConfirmRepository->updateByRequestDetailIdUserIdAndConfirmId($validate));
        }
        return ResponsesService::success($result);
    }

    public function storeConfirmsForProductId($productId, $requestDetailId)
    {
        $productConfirms = $this->productsConfirmRepository->getByProductId($productId);
        $data['requests_detail_id'] = $requestDetailId;
        $result = [];
        foreach ($productConfirms as $productConfirm) {
            $data['product_id'] = $productConfirm->product_id;
            $data['confirm_id'] = $productConfirm->confirm_id;
            array_push($result, $this->store([$data]));
        }
        return $result;
    }

    public function storeConfirmsForCategoryId($categoryId, $requestDetailId)
    {
        $categoryConfirms = $this->categoriesConfirmRepository->getByCategory($categoryId);
        $data['requests_detail_id'] = $requestDetailId;
        $result = [];
        foreach ($categoryConfirms as $categoryConfirm) {
            $data['category_id'] = $categoryConfirm->category_id;
            $data['confirm_id'] = $categoryConfirm->confirm_id;
            array_push($result, $this->store([$data]));
        }
        return $result;
    }

    public function storeDefinesConfirmsForRequestDetail($productId, $requestDetailsId)
    {
        return [
            'productConfirms' => $this->storeConfirmsForProductId($productId, $requestDetailsId),
            'categoryConfirms' => $this->storeConfirmsForCategoryId($this->productRepository->getById($productId)['category_id'], $requestDetailsId)
        ];
    }

    public function requestIsConfirmed($requestId)
    {
        $requestDetailsData = $this->requestDetailRepository->getByRequestId($requestId);
        return $this->requestDetailsIsConfirmed(array_column($requestDetailsData->all(), 'id'));
    }

    public function requestDetailsIsConfirmed($requestDetailId)
    {
        return ($this->requestsDetailsConfirmRepository->confirmOfRequestDetailIsNull($requestDetailId) == true) ? null : (!$this->requestsDetailsConfirmRepository->confirmOfRequestDetailIsFalse($requestDetailId));
    }

    public function requestDetailIsConfirmed($requestDetailId)
    {
        return ($this->requestsDetailsConfirmRepository->confirmOfRequestDetailIsNull([$requestDetailId]) == true) ? null : (!$this->requestsDetailsConfirmRepository->confirmOfRequestDetailIsFalse([$requestDetailId]));
    }

    public function checkConfirmsIsUnique(array $data)
    {
        return $this->requestsDetailsConfirmRepository->checkConfirmsIsUnique(array_column($data, 'requests_detail_id'), array_column($data, 'confirm_id'), array_column($data, 'user_id'));
    }

    public function checkStatusBeInThem(int $requestId, array $statusesId): bool
    {
        return (array_search($this->requestRepository->getById($requestId)->status_id, $statusesId) === false) ? false : true;
    }
}
