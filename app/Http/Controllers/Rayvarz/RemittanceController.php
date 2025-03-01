<?php

namespace App\Http\Controllers\Rayvarz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rayvarz\Remittance\CreateRemittanceRequest;
use App\Services\Rayvarz\RemittanceService;
use Illuminate\Http\Request;

class RemittanceController extends Controller
{
    protected $remittanceService;
    public function __construct(RemittanceService $remittanceService)
    {
        $this->remittanceService = $remittanceService;
    }

    public function createRemittance(CreateRemittanceRequest $request)
    {
        return $this->remittanceService->createRemittance($request->validated());
    }
}
