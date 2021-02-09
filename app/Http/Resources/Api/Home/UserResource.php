<?php

namespace App\Http\Resources\Api\Home;

use App\Helpers\Constant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Object['id'] = $this->getId();
        $Object['name'] = $this->getName();
        $Object['mobile'] = $this->getMobile();
        $Object['city_id'] = $this->getCityId();
        $Object['City'] = new CityResource($this->city);
        $Object['email'] = $this->getEmail();
        $Object['avatar'] = $this->getAvatar();
        $Object['lat'] = $this->getLat();
        $Object['lng'] = $this->getLng();
        return $Object;
    }

}