<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        dd(Carbon::month());
        $account = Account::select('*')->get();
       return view('dashboard.account',compact('account'));
   }

//    public function store(Request $request){
//        dd($request);
//        $balance = 0;

//        if($request->status=="send_money") {
//            $balance += $request->amount;
//        } else {
//           $balance -= $request->amount;
//        }

//    }
}
