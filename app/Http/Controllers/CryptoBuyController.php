<?php

namespace App\Http\Controllers;

use App\Http\Repository\CoinMarketCapRepository;
use App\Models\Account;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CryptoBuyController extends Controller
{
    private const TABLE_NAME = 'crypto';

    public function buyCrypto(Request $request)
    {
        $buyAmount = $request->get('buyAmount');
        $symbol = $request->get('symbol');
        $coinMarketCap = (new CoinMarketCapRepository($symbol))->getData();
        $account = Account::where('user_id', Auth::id());
        if ($account->user_id = Auth::id()) {
            DB::table(self::TABLE_NAME)->insert([
                'crypto_amount' => $buyAmount,
                'crypto_symbol' => $symbol,
                'crypto_buy_price' => $coinMarketCap[0]->price,
                'crypto_buy_price*amount' => $coinMarketCap[0]->price * $buyAmount,
            ]);
        }

        return view('/crypto', [
            'crypt' => $coinMarketCap,
        ]);
    }

}

