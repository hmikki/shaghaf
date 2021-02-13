<?php

namespace App\Http\Resources\Api\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Home\FreelancerResource;


class OrderResource extends JsonResource
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
        $Objects['user_id'] = $this->getUserId();
        $Objects['User'] = new FreelancerResource($this->user);
        $Objects['Freelancer_id'] = $this->getProviderId();
        $Objects['Freelancer'] = new FreelancerResource($this->Freelancer);
        $Objects['price'] = $this->getAmount();
        $Objects['order_date'] = $this->getOrderDate();
        $Objects['delivered_date'] = $this->getDeliveredDate();
        $Objects['reject_reason'] = $this->getRejectReason();
        $Objects['cancel_reason'] = $this->getCancelReason();
        $Objects['rate'] = $this->review()->avg('rate')??0;
        $Objects['status'] = $this->getStatus();
        $Objects['OrderStatuses'] = OrderStatusResource::collection($this->order_statuses);
        return $Objects;
    }
}
