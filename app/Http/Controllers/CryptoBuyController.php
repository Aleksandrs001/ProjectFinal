<?php

namespace App\Http\Controllers;

use App\Http\Repository\CoinMarketCapRepository;
use App\Http\Repository\XMLRepository;
use App\Models\Account;
use App\Models\Crypto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CryptoBuyController extends Controller
{
    private const CRYPTO_TABLE = 'cryptos';
    private const ACCOUNT_TABLE = 'accounts';

    public function buyCrypto(Request $request, XMLRepository $currency): View
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        $currency = $currency->index();
        $fromRate = [];
        $fromRate= ['EUR' => 1];
        $balanceRequest= $accounts->where('number',$request['from_account'])->first();
        foreach ($currency as $value) {
            $fromRate[$value['ID']] = $value['Rate'];
        }

        $account = DB::table(self::ACCOUNT_TABLE)->where('user_id',Auth::id())->get();
//        echo '<pre>';
//        var_dump($account);die;
        $buyAmount = $request['buyAmount'];
        $symbol = $request['symbol'];
        $accNumber = $request['from_account'];
        $coinMarketCap = (new CoinMarketCapRepository($symbol))->getData();

        if ($accounts->user_id = Auth::id() && $balanceRequest['balance'] >= $coinMarketCap[0]->price * $buyAmount) {
            DB::table(self::CRYPTO_TABLE)->insert([
                'acc_id' => Auth::id(),
                'acc_number' => $accNumber,
                'crypto_buy_amount' => '+'. $buyAmount,
                'crypto_buy_valute'=> preg_replace("/[^a-zA-Z]+/", "",$accNumber),
                'crypto_amount' => '+'.$buyAmount,
                'crypto_symbol' => $symbol,
                'crypto_buy_price' => '+'. $coinMarketCap[0]->price,
                'crypto_buy_price*amount' => '+'.$coinMarketCap[0]->price * $buyAmount,
                'created_at' => now(),
            ]);
            foreach ($account as $acc) {
                if ($acc->number == $accNumber) {
                    $acc= $acc->balance - $coinMarketCap[0]->price * $buyAmount * 100 * $fromRate[preg_replace("/[^a-zA-Z]+/", "",$accNumber)];

              DB::table(self::ACCOUNT_TABLE)->where('number',$accNumber)->update([
                 'balance' =>  $acc,
                ]);

                }}
            $message = 'You have successfully bought ' . $buyAmount . ' ' . $symbol . ' for ' . $coinMarketCap[0]->price * $buyAmount . ' ' . preg_replace("/[^a-zA-Z]+/", "",$accNumber);
        }else {
            $message = 'You do not have enough ' . preg_replace("/[^a-zA-Z]+/", "",$accNumber) . ' to buy ' . $symbol;
        }

        $accounts = Account::where('user_id', Auth::id())->get();
        return view('/crypto', [
            'crypt' => $coinMarketCap,
            'accounts' => $accounts,
            'message' => $message
        ]);
    }

}

