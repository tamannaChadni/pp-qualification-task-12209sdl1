<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        $request->session()->put('id', 'user_id');
        dd( $request->session()->put('user_id', $request));


        $credentials = $request->only('email', 'password');
        // dd($credentials);
        $remember = $request->input('remember');
        // dd($remember);
        if (Auth::attempt($credentials,$remember)) {
            // return redirect()->intended('personal-account');
            return [
                'status' => true,
                'message' => 'You have successfully logged in!',
                'redirect' => url('personal-account')
            ];
        } else {
            return [
                'status' => 'failed',
                'message' => 'You have entered invalid credentials!',
                // 'redirect' => url('dashboard/index')
            ];
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
