<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\FaqRequest;
use App\Http\Requests\Api\Home\FreelancerRequest;
use App\Http\Requests\Api\Home\InstallRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    use ResponseTrait;
    public function install(InstallRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function get_freelancers(FreelancerRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function faqs(FaqRequest $request): JsonResponse
    {
        return $request->run();
    }
}
