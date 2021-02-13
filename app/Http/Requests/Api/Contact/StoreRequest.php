<?php

namespace App\Http\Requests\Api\Contact;

use App\Helpers\Functions;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

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
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ];
    }

    public function run(): JsonResponse
    {
        $user = User::where('mobile',$this->mobile)->where('email', $this->email)->first();
        $message = $this->message;

        if($user){
            Functions::SendNotification($user,'Message sent','Message Sent, we will reply soon !','تم ارسال الرسالة !','تم ارسال الرسالة، و سيتم الرد في أقرب وقت ممكن', $user->getId(),Constant::NOTIFICATION_TYPE['Message']);
            return $this->successJsonResponse([__('messages.Message Sent, we will reply soon')]);
        }

            return $this->failJsonResponse([__('messages.Message Can not be send')]);
    }
}
