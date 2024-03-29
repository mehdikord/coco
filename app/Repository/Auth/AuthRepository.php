<?php
namespace App\Repository\Auth;

use App\Interfaces\Auth\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{
    public function manage_login($request)
    {

        $credentials = request(['email', 'password']);
        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function manage_logout()
    {

    }

    public function user_login($request)
    {
        if (helpers_check_auth_sms_time($request->phone)){
            return response_custom_error("پیام ارسال شده قبلی تا دو دقیقه معتبر است!");
        }
        $user = User::where('phone',$request->phone)->first();
        if ($user === null){
            $user = User::create([
                'name' => 'کاربر کوکو',
                'phone' => $request->phone,
            ]);
        }
        helpers_auth_make($request->phone);
        return response_success(['phone' => $request->phone],'پیام تائید هویت باموفقیت ارسال شد');
    }

    public function user_check($request)
    {
        if (helpers_check_auth_code($request->phone,$request->code)){
            if (!helpers_check_auth_sms_time($request->phone)){
                return response_custom_error("مدت زمان ارسال پیام به پایان رسیده است");
            }
            $user = User::where('phone',$request->phone)->select(['id','name','email','phone','profile','is_active'])->first();
            $token =  Auth::guard('users')->login($user);
            helper_remove_auth_code($request->phone);
            return response_success(
                [
                    'user' => $user,
                    'token' => $token,
                    'token_type'=> 'bearer'
                ]
            );

        }
        return response_custom_error("کد ارسال شده نادرست است");
    }





    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth('admin')->user(),
        ]);
    }

}
