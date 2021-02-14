<?php

namespace App\Http\Resources\Api\Product;

use App\Http\Resources\Api\Home\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['name'] = $this->getName();
        $Objects['description'] = $this->getDescription();
        $Objects['category_id'] = $this->getCategoryId();
        $Objects['category_name'] = Category::where('id', $this->category_id)->first()->name;
        $Objects['sub_category_id'] = $this->getSubCategoryId();
        $Objects['price'] = $this->getPrice();
        $Objects['type'] = $this->getType();
        $Objects['is_active'] = $this->isIsActive();
        $Objects['Media'] = MediaResource::collection($this->media);
        return $Objects;
    }
}
