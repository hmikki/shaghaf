<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use NunoMaduro\Collision\Provider;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delivered_date'=>'sometimes|date_format:Y-m-d H:i:s',
            'code'=>'sometimes|string',
            'products'=>'required|array',
            'products.*.product_id'=>'required|exists:foods,id',
            'products.*.quantity'=>'required|numeric',
        ];
    }

    public function run(): JsonResponse
    {
        $provider_id = null;
        $amount = 0;
        $discount = 0;
        foreach ($this->products as $product){
            $Product = (new Provider())->find($product['product_id']);
            if ($provider_id == null) {
                $provider_id = $Product->getUserId();
            }else{
                if ($provider_id != $Product->getUserId()) {
                    return $this->failJsonResponse([__('messages.you_cannot_add_products_from_several_provider_at_the_same_time')]);
                }
            }
            $amount += ($Product->getPrice() * $product['quantity']);
        }

        $Object = new Order();
        $Object->setUserId(auth()->user()->getId());
        $Object->setProviderId($provider_id);
        $Object->setAmount($amount);
        $Object->setDiscountAmount($discount);
        $Object->setOrderDate(Carbon::today());
        if($this->filled('delivered_date')){
            $Object->setDeliveredDate(Carbon::parse($this->delivered_date));
        }
        $Object->save();
        $Object->refresh();
        foreach ($this->products as $product){
            $OrderProduct = new OrderProduct();
            $OrderProduct->setOrderId($Object->getId());
            $OrderProduct->setProductId($product['product_id']);
            $OrderProduct->setQuantity($product['quantity']);
            $OrderProduct->save();
        }
        OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['PendingApproval']);
        return $this->successJsonResponse([__('messages.created_successful')],new OrderResource($Object),'Order');

    }
}
