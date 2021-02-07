<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\SendNotificationRequest;
use App\Http\Requests\Home\InstallRequest;
use App\Http\Requests\Api\Home\ProviderRequest;
use App\Http\Requests\Api\Home\SubscribeRequest;
use App\Http\Requests\Api\Home\FavouriteToggleRequest;
use App\Http\Requests\Api\Home\FavouriteRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    use ResponseTrait;

    /**
     * @param ProviderRequest $request
     * @return JsonResponse
     */
    public function providers(ProviderRequest $request): JsonResponse
    {
        return $request->run();
    }
    /**
     * @param InstallRequest $request
     * @return JsonResponse
     */
    public function install(InstallRequest $request): JsonResponse
    {
        return $request->run();
    }
    /**
     * @param SubscribeRequest $request
     * @return JsonResponse
     */
    public function subscribe(SubscribeRequest $request): JsonResponse
    {
        return $request->run();
    }
    /**
     * @param SendNotificationRequest $request
     * @return JsonResponse
     */
    public function send_notification(SendNotificationRequest $request): JsonResponse
    {
        return $request->run();
    }
    /**
     * @param FavouriteToggleRequest $request
     * @return JsonResponse
     */
    public function favourite_toggle(FavouriteToggleRequest $request): JsonResponse
    {
        return $request->run();
    }
    /**
     * @param FavouriteRequest $request
     * @return JsonResponse
     */
    public function favourites(FavouriteRequest $request): JsonResponse
    {
        return $request->run();
    }
}
