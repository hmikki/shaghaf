<?php

namespace App\Http\Requests\Auth;

use App\Helpers\Functions;
use App\Http\Requests\ApiRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class ForgetPasswordRequest extends FormRequest
{
    use ResponseTrait;
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
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function run(){
        $user = User::where('email',$this->email)->first();

        if($user){
            Functions::SendForget($user);
            return $this->successJsonResponse([__('auth.code_sent')] );
        }
        return $this->failJsonResponse([__('messages.object_not_found')]);
    }
}
