<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateMessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $chat_room_id;

    public function __construct($message,$chat_room_id)
    {
        $this->message = $message;
        $this->chat_room_id = $chat_room_id;
        $this->dontBroadcastToCurrentUser();
    }

    public function broadcastOn(): Channel
    {
        return new Channel('chat_room.'.$this->chat_room_id.'.new_message');
    }
}
