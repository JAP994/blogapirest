<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ApiCode;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(['user'=> 'Reset password link sent on your email id.'], 200);
    }


    public function reset(ResetPasswordRequest $request) {
        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password =bcrypt($password) ;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return $this->respondBadRequest(ApiCode::INVALID_RESET_PASSWORD_TOKEN);
        }

        return response()->json(['user'=> 'Password has been successfully changed'], 200);
    }
}