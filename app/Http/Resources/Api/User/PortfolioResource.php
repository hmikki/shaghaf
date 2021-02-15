<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['description'] = $this->getDescription();
        $Objects['type'] = $this->getType();
        $Objects['media'] = $this->getMedia();
        return $Objects;
    }
}
