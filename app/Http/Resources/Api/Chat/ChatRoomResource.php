<?php

namespace App\Http\Resources\Api\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['unread_messages'] = $this->getUnreadMessages();
        $Objects['latest_user_id'] = $this->getLatestUserId();
        $Objects['latest_message'] = $this->getLatestMessage();
        $Objects['latest_type'] = $this->getLatestType();
        return $Objects;
    }
}
