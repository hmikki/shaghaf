<?php
namespace App\Http\Controllers\API;


use App\Http\Requests\Auth\CheckResetCodeRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ChangeasswordRequest;
use App\Http\Resources\User\UserResource;
use App\Models\PasswordReset;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UsersController extends Controller
{
    use ResponseTrait;
    /**
     * login user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request):JsonResponse
    {
        return $request->run();
    }
    /**
     * Register user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request):JsonResponse
    {
        return $request->run();
    }
    /**
     * show user details
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function details(Request $request):JsonResponse
    {
        return $this->successJsonResponse([],new UserResource($request->user(),$request->bearerToken()),'User');
    }

    /**
     * logout user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request){
        $request->user()->update(['device_token'=>null,'device_type'=>null]);
        $request->user()->token()->revoke();
        $request->user()->token()->delete();
        return $this->successJsonResponse([__('auth.logout')]);
    }

    /**
     * forget password
     *
     * @param ForgetPasswordRequest $request
     * @return JsonResponse
     */
    public function forget_password(ForgetPasswordRequest $request):JsonResponse
    {
        return $request->run();
    }

    /**
     * check reset code
     *
     * @param ChangeasswordRequest $request
     * @return JsonResponse
     */
    public function change_password(ChangeasswordRequest $request){
        return $request->run();

    }


    /**
     * check reset code
     *
     * @param CheckResetCodeRequest $request
     * @return JsonResponse
     */
    public function check_reset_code(CheckResetCodeRequest $request):JsonResponse
    {
        return $request->run();
    }

    /**
     * reset password
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function reset_password(ResetPasswordRequest $request):JsonResponse
    {
        return $request->run();
    }

}
