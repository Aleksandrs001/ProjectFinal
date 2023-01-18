<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoSellController extends Controller
{
    public function sellCrypto(Request $request)
    {
        var_dump('sellController',$request->get('sellAmount'));
        die;
    }
}
