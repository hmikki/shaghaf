<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AhmedPanel\DestroyRequest;
use App\Http\Requests\Api\Portfolio\IndexRequest;
use App\Http\Requests\Api\Portfolio\StoreRequest;
use App\Http\Requests\Api\Portfolio\UpdateRequest;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class PortfolioController extends Controller
{
    use ResponseTrait;

    public function index(IndexRequest $request){
        return $request->run();
    }
    public function store(StoreRequest $request){
        return $request->run();
    }
    public function update(UpdateRequest $request){
        return $request->run();
    }
    public function destroy(DestroyRequest $request){
        return $request->run();
    }
}
