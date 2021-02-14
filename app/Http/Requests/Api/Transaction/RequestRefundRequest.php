<?php

namespace App\Http\Requests\Api\Transaction;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Http\JsonResponse;

class RequestRefundRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
//        $logged = auth()->user();
//        $Object = new RefundRequest();
//        $Object->setUserId($logged->getId());
//        $Object->save();
        return $this->successJsonResponse([__('messages.saved_successfully')]);
    }
}
