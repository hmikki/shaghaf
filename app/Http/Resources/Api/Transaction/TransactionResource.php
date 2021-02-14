<?php

namespace App\Http\Resources\Api\Transaction;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['type'] = $this->getType();
        $Objects['value'] = $this->getValue();
        $Objects['payment_token'] = $this->getPaymentToken();
        $Objects['status'] = $this->getStatus();
        $Objects['created_at'] = ($this->created_at)?Carbon::parse($this->created_at)->format('Y-m-d h:i A'):null;
        return $Objects;
    }
}
