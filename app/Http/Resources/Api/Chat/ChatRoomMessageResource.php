<?php

namespace App\Http\Resources\Api\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomMessageResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['message'] = $this->getMessage();
        $Objects['type'] = $this->getType();
        $Objects['user_id'] = $this->getUserId();
        $Objects['read_at'] = $this->getReadAt();
        $Objects['user_name'] = $this->user->getName();
        return $Objects;
    }
}
