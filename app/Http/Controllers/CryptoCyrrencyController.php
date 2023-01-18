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

    public function userChoice(string $vars, Request $request): View
    {
        var_dump($request->get('buyAmount'));
        var_dump($request->get('sellAmount'));
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
}







