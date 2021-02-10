<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Constant;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends FormRequest
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
            'order_id'=>'required|exists:orders,id',
            'status'=>'required|in:'.Constant::ORDER_STATUSES_RULES
        ];
    }

    public function run(): JsonResponse
    {
        $Object = (new Order)->find($this->order_id);
        switch ($this->status){
            case Constant::ORDER_STATUSES['Accept']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['Awaiting payment']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Accept']);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Accept']);
                Functions::SendNotification($Object->user,'Order Approved','Provider Approved your order !','الموافقة على الطلب !','قام المزود بالموافقة على طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Rejected']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['PendingApproval']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Rejected']);
                $Object->setRejectReason(@$this->reject_reason);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Rejected']);
                Functions::SendNotification($Object->user,'Order Rejected','Provider Rejected your order !','الرفض على الطلب !','قام المزود برفض طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Canceled']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['PendingApproval']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Canceled']);
                $Object->setCancelReason(@$this->cancel_reason);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Canceled']);
                Functions::SendNotification($Object->provider,'Order Canceled','Customer Canceled the order !','إلغاء الطلب !','قام المستخدم بإلغاء الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['NotReceived']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['Approved']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['NotReceived']);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['NotReceived']);
                Functions::SendNotification($Object->user,'Order Not Received','Customer did not receive the order !','لم يتم استلام الطلب !','لم يقم المستخدم باستلام الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['NotDelivered']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['Approved']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['NotDelivered']);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['NotDelivered']);
                Functions::SendNotification($Object->provider,'Order Not Delivered','Provider did not deliver the order !','لم يتم توصيل الطلب !','لم يقم المزود بتوصيل الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Finished']:{
                if (($Object->getStatus() !=Constant::ORDER_STATUSES['Approved']) || ($Object->getStatus() !=Constant::ORDER_STATUSES['NotDelivered'])|| ($Object->getStatus() !=Constant::ORDER_STATUSES['NotReceived'])) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Finished']);
                $Object->save();
                OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['Finished']);
                Functions::SendNotification($Object->provider,'Order Not Delivered','Provider did not deliver the order !','لم يتم توصيل الطلب !','لم يقم المزود بتوصيل الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
        }
        $Object->save();
        return $this->successJsonResponse([__('messages.updated_successful')],new OrderResource($Object),'Order');

    }
}
