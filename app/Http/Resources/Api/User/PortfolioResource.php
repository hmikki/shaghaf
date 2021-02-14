<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['title'] = (app()->getLocale() == 'ar')?$this->getTitleAr() : $this->getTitle();
        $Objects['user_id'] = $this->getUserId();
        $Objects['Media'] = MediaResource::collection($this->media);
        return $Objects;
    }
}
