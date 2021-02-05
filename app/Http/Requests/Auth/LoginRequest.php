<?php

namespace App\Http\Requests\Auth;

use App\Http\Resources\user\UserResource;
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function run()
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return $this->failJsonResponse([('لم يتم تسجيل الدخول')]);
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
        return $this->successJsonResponse( [('تم تسجيل الدخول بنجاح')], new UserResource($user,$tokenResult->accessToken),'User');
    }
}
