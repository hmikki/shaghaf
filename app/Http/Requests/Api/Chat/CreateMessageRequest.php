<?php

namespace App\Http\Requests\Api\Chat;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Chat\ChatRoomMessageResource;
use App\Models\ChatRoom;
use App\Models\ChatRoomMessage;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed per_page
 * @property mixed chat_room_id
 * @property mixed type
 * @property mixed message
 */
class CreateMessageRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'chat_room_id'=>'required|exists:chats_rooms,id',
            'type'=>'required|in:'.Constant::CHAT_MESSAGE_TYPE,
            'message'=>'required'
        ];
    }
    public function run(): JsonResponse
    {
        $logged = auth()->user();
        $ChatRoom = (new ChatRoom())->find($this->chat_room_id);
        $Object = new ChatRoomMessage();
        $Object->setChatRoomId($ChatRoom->getId());
        $Object->setUserId($logged->getId());
        $Object->setType($this->type);
        $Object->setMessage($this->message);
        $Object->save();
        $ChatRoom->setLatestMessage($this->message);
        $ChatRoom->setLatestType($this->type);
        $ChatRoom->setLatestUserId($logged->getId());
        $ChatRoom->setUnreadMessages($ChatRoom->getLatestMessage()+1);
        $ChatRoom->save();
        return $this->successJsonResponse([],new ChatRoomMessageResource($Object),'ChatRoomMessage');
    }
}
