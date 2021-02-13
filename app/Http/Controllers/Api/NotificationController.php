<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notification\ReadAllRequest;
use App\Http\Requests\Api\Notification\ReadRequest;
use App\Http\Requests\Api\Notification\SearchRequest;
use App\Http\Requests\Api\Notification\SendRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    use ResponseTrait;

    /**
     * @param SearchRequest $form
     * @return JsonResponse
     */
    public function index(SearchRequest $form): JsonResponse
    {
        return $form->run();
    }

    /**
     * @param ReadRequest $form
     * @return JsonResponse
     */
    public function read(ReadRequest $form): JsonResponse
    {
        return $form->run();
    }

    /**
     * @param ReadAllRequest $form
     * @return JsonResponse
     */
    public function read_all(ReadAllRequest $form): JsonResponse
    {
        return $form->run();
    }

    /**
     * @param SendRequest $request
     * @return JsonResponse
     */
    public function send(SendRequest $request): JsonResponse
    {
        return $request->run();
    }
}
