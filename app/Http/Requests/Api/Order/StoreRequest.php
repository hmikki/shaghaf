<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed product_id
 * @property mixed quantity
 * @property mixed note
 * @property mixed delivered_date
 * @property mixed delivered_time
 */
class StoreRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'delivered_date'=>'required|date',
            'delivered_time'=>'required|time',
            'product_id'=>'required|exists:products,id',
            'quantity'=>'required|numeric',
            'note'=>'sometimes|string'
        ];
    }

    public function run(): JsonResponse
    {
        $Product = (new Product())->find($this->product_id);
        $Object = new Order();
        $Object->setUserId(auth()->user()->getId());
        $Object->setFreelancerId($Product->getUserId());
        $Object->setPrice($Product->getPrice());
        $Object->setQuantity($this->quantity);
        $Object->setDeliveredDate($this->delivered_date);
        $Object->setDeliveredTime($this->delivered_time);
        $Object->setNote(@$this->note);
        $Object->save();
        $Object->refresh();
        $Freelancer = (new User)->find($Product->getUserId());
        $Freelancer->setOrderCount($Freelancer->getOrderCount()+1);
        $Freelancer->save();
        Functions::ChangeOrderStatus($Object->getId(),Constant::ORDER_STATUSES['New']);
        return $this->successJsonResponse([__('messages.created_successful')],new OrderResource($Object),'Order');

    }
}
