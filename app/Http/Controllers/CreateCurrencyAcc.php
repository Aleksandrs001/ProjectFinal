<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateCurrencyAcc extends Controller
{
    private const TABLE_NAME = 'accounts';
    public function createCurrencyAcc(Request $request)
    {
        if($request->get('valute')== DB::table('accounts')->where('valute', $request->get('valute'))->where('user_id', Auth::id())->exists()){
            return redirect()->route('dashboard')->with('status', 'currency-exists');
        }
        else {
            DB::table(self::TABLE_NAME)->insert([
                'user_id' => Auth::id(),
                'number' => $request->get('valute') . rand(1000000000, 9999999999),
                'valute' => $request->get('valute'),
                'balance' => 0,
                time

            ]);
        }
        return redirect()->route('dashboard');
    }
}
