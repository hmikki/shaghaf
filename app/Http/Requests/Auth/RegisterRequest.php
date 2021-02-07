<?php

namespace App\Http\Requests\Auth;

use App\Helpers\Functions;
use App\Http\Requests\ApiRequest;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\User\UserResource;
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
            'mobile' => 'required',
            //'city_id' => 'required|exists:cities,id',
            'type' => 'required',
            'device_token' => 'string|required_with:device_type',
            'device_type' => 'string|required_with:device_token',
            'app_locale' => 'sometimes|in:en,ar',


        ];
    }
    public function run(){
        $user = new User();
        $user->setName($this->name);
        $user->setPassword($this->password);
        $user->setEmail($this->email);
        $user->setMobile($this->mobile);
        $user->setType($this->type);
        $user->setAppLocale($this->filled('app_locale')?$this->app_locale:'ar');
        if ($this->filled('device_token') && $this->filled('device_type')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
        }
        $user->save();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        $user->refresh();
        /*try {
            Functions::SendVerification($user);
        }catch (\Exception $e){

        }*/
        return $this->successJsonResponse( [__('messages.saved_successfully')],new UserResource($user,$tokenResult->accessToken),'User');
    }
}
