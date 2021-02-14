<?php

namespace App\Http\Resources\Api\Order;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['created_at'] = Carbon::parse($this->created_at)->format('Y-m-d h:i A');
        $Objects['status'] = $this->getStatus();
        return $Objects;
    }
}
