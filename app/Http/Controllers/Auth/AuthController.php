<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:login,0.5'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $user->createToken('cms-login')->plainTextToken;

            session(['api_token' => $token, 'user_name' => $user->name, 'email' => $user->email]);
            Log::info($user);

            return redirect()->route('home')
                ->with('success', ['Login Successfully']);
        }

        return back()->withErrors([
            'email' => 'Email or password is wrong.',
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user) {
            $user->tokens()->delete();
        }

        return redirect('/login')->with('success', ['Logout Successfully']);
    }
}
