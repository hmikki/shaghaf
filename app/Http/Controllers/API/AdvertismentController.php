<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Advertisment\IndexRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseTrait;

class AdvertismentController extends Controller
{
    use ResponseTrait;


    /**
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request){
        return $request->run();
    }
}
