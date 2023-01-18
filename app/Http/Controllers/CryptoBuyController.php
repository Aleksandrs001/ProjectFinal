<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoBuyController extends Controller
{
    public function buyCrypto(Request $request)
    {

    var_dump('buyController',(int)$request->get('buyAmount'));die;
        return view('/crypto');
    }
}
