<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

class LoginRequest extends FormRequest
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
            'mobile' => 'required',
            'password' => 'required',
            'device_token' => 'string|required_with:device_type',
            'device_type' => 'string|required_with:device_token',
        ];
    }

    public function run()
    {
        $credentials = request(['mobile', 'password']);
        if (!Auth::attempt($credentials))
            return $this->failJsonResponse([__('auth.failed')]);
        $user = $this->user();
        DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        if ($this->input('device_token')) {
            $user->device_token = $this->device_token;
            $user->device_type = $this->device_type;
            $user->save();
        }
        return $this->successJsonResponse( [__('auth.login')], new UserResource($user,$tokenResult->accessToken),'User');
    }
}
