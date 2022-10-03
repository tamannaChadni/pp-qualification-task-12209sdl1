<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // validation check
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create(array_merge($request->all(), ['password' => Hash::make($request->password)]));

        if ($user) {
            return [
                'success' => true,
                'message' =>  'You have successfully Resisterd!',  
                'redirect' => url('login')
            ];
        }
    }
}
