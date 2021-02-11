<?php

namespace App\Http\Controllers\ApiOld;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ticket\IndexRequest;
use App\Http\Requests\Api\Ticket\ShowRequest;
use App\Http\Requests\Api\Ticket\StoreRequest;
use App\Http\Requests\Api\Ticket\ResponseRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
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
     * @param ResponseRequest $request
     * @return JsonResponse
     */
    public function response(ResponseRequest $request){
        return $request->run();
    }
}