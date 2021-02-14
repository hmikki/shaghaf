<?php

namespace App\Http\Requests\Api\Transaction;

use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class MyBalanceRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        return $this->successJsonResponse([],Functions::UserBalance(auth()->user()->getId()),'Balance');
    }
}
