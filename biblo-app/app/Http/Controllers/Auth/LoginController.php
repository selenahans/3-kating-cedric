<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // 🚫 BLOCK IF NOT VERIFIED
            if (!Auth::user()->hasVerifiedEmail()) {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Email belum diverifikasi. Silakan cek inbox Anda.'
                ]);
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }
    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {

            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Email belum diverifikasi. Silakan cek inbox Anda.'
                ]);
        }
    }

}
