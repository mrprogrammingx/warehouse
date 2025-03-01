<?php

namespace App\Services\Rayvarz;

use App\Interfaces\RayvarzInterface;
use App\Services\Globals\ResponsesService;
use App\Services\RequestDetailService;
use App\Services\RequestService;
use Exception;
use Illuminate\Support\Facades\Http;

/**
 * Class RemittanceService
 * @package App\Services
 */
class RemittanceService
{
    protected $documentService, $requestDetailService, $requestService;

    public function __construct(RequestDetailService $requestDetailService, RequestService $requestService)
    {
        $this->documentService = new DocumentService();
        $this->requestDetailService = $requestDetailService;
        $this->requestService = $requestService;
    }

    public function createRemittance(array $data)
    {
        try {
            if (($this->requestDetailService->hasRemittanceIsZeroForRequestId($data) && $this->requestService->hasRemittanceIsZeroForRequestId($data)) == false) {
                return ResponsesService::error($data, 'Already registered for this remittance request!');
            }

            $lastDocumentNumber = $this->documentService->getLastDocumentNumber($data['fiscalYear'], $data['warehouseId']);
            if ($lastDocumentNumber['success'] == false) {
                return ResponsesService::error($lastDocumentNumber, 'There was an error getting the document number!');
            }

            $inventoryJournalItems = [];
            foreach ($data['inventoryJournalItems'] as $inventoryJournalItem) {
                $inventoryJournalItems['fiscalYear'] = $data['fiscalYear'];
                $inventoryJournalItems['warehouseId'] = $data['warehouseId'];
                $inventoryJournalItems['inventoryDocumentTypeId'] = RayvarzInterface::DEFAULT_INVENTORY_DOCUMENT_TYPE_ID;
                $inventoryJournalItems['documentRow'] = RayvarzInterface::DEFAULT_DOCUMENT_ROW;
                $inventoryJournalItems['itemDataId'] = $inventoryJournalItem['itemDataId'];
                $inventoryJournalItems['centerId'] = $inventoryJournalItem['centerId'];
                $inventoryJournalItems['inventoryOrderId'] = RayvarzInterface::DEFAULT_INVENTORY_ORDER_ID;
                $inventoryJournalItems['itemConsumptionTypeId'] = RayvarzInterface::DEFAULT_ITEM_CONSUMPTION_TYPE_ID;
                $inventoryJournalItems['qty'] = $inventoryJournalItem['qty'];
                $inventoryJournalItems['unitId'] = RayvarzInterface::DEFAULT_UNIT_ID;
            }

            $params = [
                'fiscalYear' => $data['fiscalYear'],
                'warehouseId' => $data['warehouseId'],
                'inventoryDocumentTypeId' => RayvarzInterface::DEFAULT_INVENTORY_DOCUMENT_TYPE_ID,
                'documentNo' => $lastDocumentNumber['data'],
                'createDate' => $data['createDate'],
                'userId' => RayvarzInterface::DEFAULT_USER_ID,
                'inventoryJournalItems' => [
                    $inventoryJournalItems
                ]
            ];

            //die;
            $response = Http::withHeaders([
                'access_token' => $_COOKIE['rayvarz_access_token'] ?? $token ?? AuthService::getToken(),
                'Content-Type' => env('RAYVARZ_HEADER_CONTENT_TYPE_DEFAULT'),
            ])->post(
                env('RAYVARZ_CREATE_REMITTANCE_API'),
                $params
            );
            if ((200 <= $response->status()) && ($response->status() < 300)) {
                $this->requestDetailService->updateHasRemittanceByRequestId($data);
                $this->requestService->updateHasRemittanceByRequestId($data);
                return ResponsesService::success($response->json() ?? null);
            } else {
                return ResponsesService::error($response->json() ?? null, $response->json()['message'] ?? '');
            }
        } catch (Exception $e) {
            return ResponsesService::exception($e);
        }
    }
}
