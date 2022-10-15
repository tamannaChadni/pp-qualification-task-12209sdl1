<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transcation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TranscationController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function store(Request $request)
    {

        $sender = User::find(Auth::id());
        $reciver = User::where('email', $request->email)->first();
        // dd($reciver);
        $amount = $request->amount;
        // dd($amount);
        $transcation_type = $request->transcation_type;
        if ($transcation_type = "add_money") {

            $per_day_total_transcation_amount = Transcation::where('created_at', Carbon::today())->where('sender', $sender)->where('transcation_type', 'add_money')->sum('amount');

            if (!($per_day_total_transcation_amount + $amount) < 10000000) {
                return [
                    'status' => false,
                    'message' => 'Your Per day add money limit cross!'
                ];
            }
            $per_month_total_transcation_amount = Transcation::where('created_at', Carbon::now()->addMonth())->where('sender', $sender)->where('transcation_type', 'add_money')->sum('amount');

            if (!($per_month_total_transcation_amount + $amount) < 10000000) {
                return [
                    'status' => false,
                    'message' => 'Your Per month add money limit cross!'
                ];
            }

            if (!($amount > 10 && $amount < 99999.99)) {
                return [
                    'status' => false,
                    'message' => 'The amount is less then 10 or greater than 99999.99!'
                ];
            }
            $monthlyAttempt = Transcation::where('sender', $sender)->where('created_at', Carbon::now()->addMonth())->where('transcation_type', 'add_money')->count();

            if (!($monthlyAttempt < 30)) {
                return [
                    'status' => false,
                    'message' => 'Your Per month add money limit cross!'
                ];
            }
        } 
        
        // elseif (condition) {
        //     # code...
        // }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        else {
            return [
                'success' => false,
                'message' => 'Server error please try again after some times',
            ];
        }

        $transaction_id = time() . uniqid(mt_rand(), true);
        $data = array_merge($request->all(), ['TXID' => $transaction_id]);
        $wallet = Transcation::create($data, $transcation_type);
        //  dd($wallet);
        if ($wallet) {
            return [
                'success' => true,
                'message' => 'Your transcation is completed successfully!',
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Server error please try again after some times',
            ];
        }
        return Response::json($wallet);
        // dd($wallet);
    }
}
