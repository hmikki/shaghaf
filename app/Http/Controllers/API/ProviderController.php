<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\DestroyMediaRequest;
use App\Http\Requests\Provider\DestroyRequest;
use App\Http\Requests\Provider\IndexRequest;
use App\Http\Requests\Provider\ShowRequest;
use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class ProviderController extends Controller
{
    use ResponseTrait;

    /**
     *
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        return $request->run();
    }

    /**
     *
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request): JsonResponse
    {
        return $request->run();
    }

    /**
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return $request->run();
    }
    /**
     *
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        return $request->run();
    }

    /**
     *
     * @param DestroyRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request): JsonResponse
    {
        return $request->run();
    }

    /**
     *
     * @param DestroyMediaRequest $request
     * @return JsonResponse
     */
    public function destroy_media(DestroyMediaRequest $request): JsonResponse
    {
        return $request->run();
    }

}
