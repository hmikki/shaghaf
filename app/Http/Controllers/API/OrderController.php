<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
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
        
    }
}
