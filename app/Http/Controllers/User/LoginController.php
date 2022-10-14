<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{

    public function formLogin()
    {
        $key = "login.".request()->ip();
        return view('login',[
            'key'=>$key,
            'retries'=>RateLimiter::retriesLeft($key, 5),
            'seconds'=>RateLimiter::availableIn($key),

        ]);

        $userKey = "login.".request()->email();
        return view('login',[
            
            'userKey'=>$userKey,
            'retries'=>RateLimiter::retriesLeft($userKey, 2),
            'seconds'=>RateLimiter::availableIn($userKey),
        ]);
    }



    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        // dd($credentials);
        $remember = $request->input('remember');
        // dd($remember);
        if (Auth::attempt($credentials, $remember)) {
            $user = User::where('email', $credentials['email'])->first();
            $data = [
                'id', $request->input('id'),
                'user_id ', $user->id,
                'ip_address ', $request->input('ip_address'),
                'user_agent ', $request->input('user_agent'),
                'payload ', $request->input('payload'),
                'last_activity  ', $request->input('last_activity'),
            ];
            $request->session()->put($data);
            // return redirect()->intended('personal-account');
            RateLimiter::clear("login.".$request->ip());
            RateLimiter::clear("login.".$request->email);

            return [
                'status' => true,
                'message' => 'You have successfully logged in!',
                'redirect' => url('transcation')
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
