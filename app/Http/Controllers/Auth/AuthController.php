<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Invalid2AuthCodeException;
use App\Exceptions\SendToManyCodeException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\TwoAuthRequest;
use App\Models\Token;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request, AuthService $authService)
    {
        $redirect = $request->has('redirectTo') ?  ['redirectTo' => $request->redirectTo] : [];
        try {
            if ($user = $authService->login($request->phone))
                return redirect()->route('auth.showVerify' , $redirect)->with([
                    'phone' => $user->phone,
                    'id' => $user->id,
                ]);
            return redirect()->route('auth.showLogin' , $redirect)->withInput()->withErrors([
                "ارسال کد ناموفق بود"
            ]);
        } catch (SendToManyCodeException $exception) {
            return redirect()->route('auth.showLogin',$redirect)->withInput()->withErrors([
                "تعداد درخواست های ارسال پیامک شما، از حد مجاز بیشتر شده است!"
            ]);
        }
    }

    public function showVerifyForm()
    {
        return view('verify');
    }

    public function verify(TwoAuthRequest $request, AuthService $authService)
    {
        $redirect = $request->has('redirectTo') ?  ['redirectTo' => $request->redirectTo] : [];
        try {
            if ($user = $authService->check2AuthCode($request->phone, $request->code)) {
                auth()->login($user);
                if ( $request->has('redirectTo') )
                    return redirect($request->redirectTo);
                return redirect()->route('home');
            }
        } catch (Invalid2AuthCodeException $exception) {
            return redirect()->route('auth.showVerify',$redirect)->withInput()->withErrors([
                "کد نامعتبر است!"
            ]);
        }
        return redirect()->route('auth.showLogin',$redirect)->withInput();
    }

    public function logout(AuthService $authService)
    {
        if ($authService->logout()) {
            auth()->logout();
            return redirect()->route('auth.showLogin');
        }
        return redirect()->back();
    }
}
