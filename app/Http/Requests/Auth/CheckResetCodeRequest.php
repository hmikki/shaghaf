<?php

namespace App\Http\Requests\Auth;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class CheckResetCodeRequest extends FormRequest
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
            'code' => 'required|string',
        ];
    }

    public function run(){
        $user = User::where('email',$this->email)->first();
        $passwordReset = PasswordReset::where('user_id',$user->getId())->first();
        if($passwordReset &&$passwordReset->code == $this->code){
            return $this->successJsonResponse([('تم ارسال رمز التأكيد')]);
        }
        else{
            return $this->failJsonResponse([('رمز التأكيد غير صحيح')]);
        }
    }
}
