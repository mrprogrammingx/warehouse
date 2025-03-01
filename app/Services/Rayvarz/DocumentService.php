<?php

namespace App\Services\Rayvarz;

use App\Services\Globals\ResponsesService;
use Exception;
use Illuminate\Support\Facades\Http;

/**
 * Class DocumentService
 * @package App\Services
 */
class DocumentService
{
    public function getLastDocumentNumber($fiscalYear,$warehouseId,$token = null)
    {
        try {
            $response = Http::withHeaders([
                'access_token' => $_COOKIE['rayvarz_access_token'] ?? $token ?? AuthService::getToken(),
                'Content-Type' => env('RAYVARZ_HEADER_CONTENT_TYPE_DEFAULT'),
            ])->get(
                env('RAYVARZ_NEXT_DOCUMENT_NUMBER_API'),
                [
                    'warehouseId' => $warehouseId,
                    'fiscalyear' => $fiscalYear
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
}
