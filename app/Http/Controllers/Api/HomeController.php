<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\FreelancerRequest;
use App\Http\Requests\Api\Home\InstallRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    use ResponseTrait;


    /**
     * @param InstallRequest $request
     * @return JsonResponse
     */
    public function install(InstallRequest $request): JsonResponse
    {
        return $request->run();
    }

    /**
     * @param FreelancerRequest $request
     * @return JsonResponse
     */
    public function get_freelancers(FreelancerRequest $request): JsonResponse
    {
        return $request->run();
    }
}
