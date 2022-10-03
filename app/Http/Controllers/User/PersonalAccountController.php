<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalAccountController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }
}
