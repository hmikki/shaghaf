<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Contact\StoreRequest;


class ContactController extends Controller
{
    public function store(StoreRequest $request){
        return $request->run();
    }
}
