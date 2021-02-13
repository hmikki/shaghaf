<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\IndexRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(IndexRequest $request){
        return $request->run();
    }
}
