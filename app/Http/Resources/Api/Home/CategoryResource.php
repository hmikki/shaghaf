<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->name_ar:$this->name;
        $Objects['image'] = asset($this->image);
        $Objects['has_product'] = $this->has_product;
        $Objects['has_service'] = $this->has_service;
        $Objects['SubCategories'] = CategoryResource::collection($this->sub_categories);
        return $Objects;
    }
}
