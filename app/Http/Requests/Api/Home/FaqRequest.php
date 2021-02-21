<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\FaqCategoryResource;
use App\Models\FaqCategory;
use Illuminate\Http\JsonResponse;

class FaqRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        return $this->successJsonResponse([],FaqCategoryResource::collection(FaqCategory::all()),'FaqsCategories');
    }
}
