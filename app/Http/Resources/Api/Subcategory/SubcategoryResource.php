<?php

namespace App\Http\Resources\Api\Subcategory;

use App\Http\Resources\Api\Category\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class SubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Objects = array();

        $Objects['id'] = $this->id;
        $Objects['title'] = (App::getLocale() == 'ar')? $this->title_ar : $this->title;
        $Objects['image'] = asset($this->image);
        $Objects['category_id'] = $this->category_id;
        return $Objects;
    }
}
