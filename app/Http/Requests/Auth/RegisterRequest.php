<?php

namespace App\Http\Requests\Auth;

use App\Traits\ResponseTrait;
use App\Http\Resources\user\UserResource;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'type' => 'required',
        ];
    }
    public function run(){
        $user = new User();
        $user->setName($this->name);
        $user->setPassword($this->password);
        $user->setEmail($this->email);
        $user->setType($this->type);
        if ($this->filled('device_token') && $this->filled('device_type')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
        }
        $user->save();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        $user->refresh();

        return $this->successJsonResponse( [('تم التسجيل بنجاح')],new UserResource($user,$tokenResult->accessToken),'User');
    }
}
