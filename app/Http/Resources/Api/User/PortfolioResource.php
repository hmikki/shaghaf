<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
        $Objects['title'] = (app()->getLocale() == 'ar')?$this->title_ar : $this->title;
        $Objects['user_id'] = $this->getUserId();
        $Objects['Media'] = MediaResource::collection($this->media);
        return $Objects;
    }
}
