<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
        $Objects['file'] = $this->getFile();
        $Objects['video'] = $this->getVideo;
        return $Objects;
    }
}
