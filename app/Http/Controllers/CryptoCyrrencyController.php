<?php

namespace App\Http\Controllers;

use App\Http\Repository\CoinMarketCapRepository;
use App\Models\Account;
use App\Models\CoinMarketRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CryptoCyrrencyController extends Controller
{

    public function showForm(Request $request): View
    {
        $userChoice = $request->get('search') ?? 'BTC,ETH,XRP,BCH,ZZZ,LTC,EOS,BNB,BSV,TRX';
        $coinMarketCap = new CoinMarketCapRepository($userChoice);
        return view('/crypto', [
            'crypt' => $coinMarketCap->getData(),
        ]);
    }

    public function userChoice(string $vars): View
    {
        $userSymbol = Account::where('user_id', Auth::id())->get();

        $valuteSymbol = $userSymbol[0]['valute'];
        $fromRequest = new CoinMarketRequest(
            $vars,
            $valuteSymbol,
        );
//        var_dump($fromRequest);die;
        $coinMarketCap = new CoinMarketCapRepository($vars);
        return view('/crypto', [
            'crypt' => $coinMarketCap->getData(),
        ]);
    }
    public function buyCrypto(Request $request)
    {

        return view('/crypto');
    }

    public function sellCrypto(Request $request)
    {
var_dump("hello");
        var_dump($request->get('sellAmount'));
        die;
    }
}







