<?php

namespace App\Http\Resources\Api\Provider;

use App\Http\Resources\Api\Category\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['user_id'] = $this->getUserId();
        $Objects['category_id'] = $this->getCategoryId();
        $Objects['Category'] = new CategoryResource($this->category);
        $Objects['name'] = $this->getName();
        $Objects['description'] = $this->getDescription();
        $Objects['price'] = $this->getPrice();
        $Objects['type'] = $this->getType();
        $Objects['size'] = $this->getSize();
        $Objects['is_active'] = $this->isIsActive();
         $Objects['Media'] = MediaResource::collection($this->media);
        return $Objects;
    }
}
