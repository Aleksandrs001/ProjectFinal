<?php

namespace App\Http\Controllers;

use App\Http\Repository\CoinMarketCapRepository;
use App\Http\Repository\XMLRepository;
use App\Models\Account;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CryptoSellController extends Controller
{
    private const CRYPTO_TABLE = 'cryptos';
    private const ACCOUNT_TABLE = 'accounts';
    public function sellCrypto(Request $request,XMLRepository $currency)
    {
        $currency = $currency->index();
        $fromRate= ['EUR' => 1];
        foreach ($currency as $value) {
            $fromRate[$value['ID']] = $value['Rate'];
        }
        $accounts = Account::where('user_id', Auth::id())->get();
        $buyAmount = $request->get('sellAmount');
        $symbol = $request->get('symbol');
        $accNumber = $request->get('from_account');
        $coinMarketCap = (new CoinMarketCapRepository($symbol))->getData();
        $cryptoAmount = Crypto::where('crypto_symbol', $symbol)->get();
        $DBamount = 0;
        foreach ($cryptoAmount as $v) {
            if($v->symbol = $symbol){
                $DBamount +=(int) $v->crypto_amount;
            }
        }

        if ($accounts->user_id = Auth::id() && $DBamount >= $buyAmount){
            DB::table(self::CRYPTO_TABLE)->insert([
                'acc_id' => Auth::id(),
                'acc_number' => $accNumber,
                'crypto_sell_amount' => '-'.$buyAmount,
                'crypto_sell_valute'=> preg_replace("/[^a-zA-Z]+/", "",$accNumber),
                'crypto_amount' => '-'.$buyAmount,
                'crypto_symbol' => $symbol,
                'crypto_sell_price' => '-'.$coinMarketCap[0]->price,
                'crypto_sell_price*amount' => '-'.$coinMarketCap[0]->price * $buyAmount,
                'created_at' => now(),
            ]);
            $account = DB::table(self::ACCOUNT_TABLE)->where('user_id',Auth::id())->get();
            foreach ($account as $acc) {
                if ($acc->number == $accNumber) {
                    $acc= $acc->balance + $coinMarketCap[0]->price * $buyAmount * 100 * $fromRate[preg_replace("/[^a-zA-Z]+/", "",$accNumber)];

                    DB::table(self::ACCOUNT_TABLE)->where('number',$accNumber)->update([
                        'balance' =>  $acc,
                    ]);

                }}
            $message = 'You have successfully sold ' . $buyAmount . ' ' . $symbol . ' for ' . $coinMarketCap[0]->price * $buyAmount . ' ' . preg_replace("/[^a-zA-Z]+/", "",$accNumber);
        }else{
            $message = 'You do not have enough ' . $symbol . ' to sell';
        }

        return view('/crypto', [
            'crypt' => $coinMarketCap,
            'accounts' => $accounts,
            'message' => $message,
        ]);
    }
}
