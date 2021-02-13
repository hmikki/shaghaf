<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Order\DestroyRequest;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Order\IndexRequest;
use App\Http\Requests\Api\Order\ShowRequest;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use ResponseTrait;

    /**
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request){
        return $request->run();
    }

    /**
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request){
        return $request->run();
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request){
        return $request->run();
    }

    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request){
        return $request->run();
    }

    /**
     * @param ReviewRequest $request
     * @return JsonResponse
     */
    public function review(ReviewRequest $request): JsonResponse
    {
        return $request->run();
    }

}
